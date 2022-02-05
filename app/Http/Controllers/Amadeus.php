<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Api\Amadeus as AmadeusApi;

class Amadeus extends Controller
{

    private $amadeus;
    public $numberToWord;

    public function __construct()
    {
        $clientId = 'hzusG7jo9bAmHFDxJxL58953BcNQteLv';
        $clientSecret = 'A1AhgDuvb2gL0Yh7';
        $this->amadeus = new AmadeusApi($clientId, $clientSecret);

        $this->numberToWord = function ($number) {

            $words = ['Non', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten'];

            if (isset($words[$number]))
                return $words[$number];

            return $number;
        };
    }

    public function flightSearch(Request $request)
    {

        $validataionRules = [
            'travel_from' => 'required',
            'travel_to' => 'required',
            'from_date' => 'required',
            'adults' => 'required',
            'childrens' => 'required',
            'infants' => 'required',
            'seat_class' => 'required'
        ];

        if ($request->filled('to_date')) {
            $validataionRules['to_date'] = 'after_or_equal:from_date';
        }

        $request->validate($validataionRules, [
            'travel_from.required' => 'Travel from field is required',
            'travel_to.required' => 'Travel to field is required',
            'from_date.required' => 'Travel from date field is required',
            'adults.required' => 'Adult quantity field is required',
            'childrens.required' => 'Children quantity field is required',
            'infants.required' => 'Infants quantity field is required',
            'seat_class.required' => 'Seat class field is required'
        ]);

        $adt = intval($request->input('adults'));
        $chld = intval($request->input('childrens'));
        $inft = intval($request->input('infants'));
        $travelClass = $request->input('seat_class');
        $originDestinationId = 1;

        $originDestinations = [
            [
                'id' => $originDestinationId++,
                'originLocationCode' => $request->input('travel_from'),
                'destinationLocationCode' => $request->input('travel_to'),
                'departureDateTimeRange' => [
                    'date' => $request->input('from_date')
                ]
            ]
        ];

        if ($request->filled('to_date')) {
            array_push($originDestinations, [
                'id' => $originDestinationId++,
                'originLocationCode' => $request->input('travel_to'),
                'destinationLocationCode' => $request->input('travel_from'),
                'departureDateTimeRange' => [
                    'date' => $request->input('to_date')
                ]
            ]);
        }
        $resp = json_decode($this->amadeus->search($adt, $chld, $inft, $travelClass, $originDestinations));

        if (isset($resp->data) && count($resp->data) > 0) {
            if (isset($resp->dictionaries->carriers)) {
                foreach ($resp->dictionaries->carriers as &$carrier) {
                    $carrier = ucwords(strtolower($carrier));
                }
                unset($carrier);
            }
            if (isset($resp->dictionaries->aircraft)) {
                foreach ($resp->dictionaries->aircraft as &$aircraft) {
                    $aircraft = ucwords(strtolower($aircraft));
                }
                unset($aircraft);
            }
            return view('searchresult', [
                'resp' => $resp,
                'numberToWord' => $this->numberToWord
            ]);
        } else {
            return back()->withErrors('No Result Found!');
        }
    }

    public function multiSearch(Request $request)
    {

        $request->validate(
            [
                'travel_from.*' => 'required',
                'travel_to.*' => 'required',
                'from_date.*' => 'required',
                'adults' => 'required',
                'childrens' => 'required',
                'infants' => 'required',
                'seat_class' => 'required'
            ],
            [
                'travel_from.required' => 'Travel from field is required',
                'travel_to.required' => 'Travel to field is required',
                'from_date.required' => 'Travel from date field is required',
                'adults.required' => 'Adult quantity field is required',
                'childrens.required' => 'Children quantity field is required',
                'infants.required' => 'Infants quantity field is required',
                'seat_class.required' => 'Seat class field is required'
            ]
        );

        $adt = intval($request->input('adults'));
        $chld = intval($request->input('childrens'));
        $inft = intval($request->input('infants'));
        $travelClass = $request->input('seat_class');
        $originDestinationId = 1;

        $originDestinations = [];

        for ($i = 0; $i < count($request->input('travel_from')); $i++) {

            array_push($originDestinations, [
                'id' => $originDestinationId++,
                'originLocationCode' => $request->input('travel_from')[$i],
                'destinationLocationCode' => $request->input('travel_to')[$i],
                'departureDateTimeRange' => [
                    'date' => $request->input('from_date')[$i]
                ]
            ]);
        }

        $resp = json_decode($this->amadeus->search($adt, $chld, $inft, $travelClass, $originDestinations));

        if (isset($resp->data) && count($resp->data) > 0) {
            if (isset($resp->dictionaries->carriers)) {
                foreach ($resp->dictionaries->carriers as &$carrier) {
                    $carrier = ucwords(strtolower($carrier));
                }
                unset($carrier);
            }
            if (isset($resp->dictionaries->aircraft)) {
                foreach ($resp->dictionaries->aircraft as &$aircraft) {
                    $aircraft = ucwords(strtolower($aircraft));
                }
                unset($aircraft);
            }
            return view('searchresult', [
                'resp' => $resp,
                'numberToWord' => $this->numberToWord
            ]);
        } else {
            return back()->withErrors('No Result Found!');
        }
    }

    public function storeFlight(Request $request)
    {

        if (!$request->filled('data')) {
            return redirect('/');
        }

        $data = $request->session()->get('amadeus', []);
        array_push($data, $request->input('data'));
        $request->session()->put('amadeus', $data);

        return redirect('validate/' . count($data));
    }

    public function flightValidate(Request $request, $sessionId)
    {

        $amadeus = $request->session()->get('amadeus');

        if (!isset($amadeus[$sessionId - 1])) {
            return redirect('/');
        }

        $flightOffers = json_decode($amadeus[$sessionId - 1]);
        $resp = json_decode($this->amadeus->price($flightOffers));

        if (isset($resp->data)) {

            $resp->data->flightOffers[0]->numberOfBookableSeats = $flightOffers->numberOfBookableSeats;

            foreach ($resp->data->flightOffers[0]->itineraries as $key => &$val) {
                $val->duration = $flightOffers->itineraries[$key]->duration;
            }

            return view('flightdetail', [
                'resp' => $resp,
                'numberToWord' => $this->numberToWord,
                'sessionId' => $sessionId
            ]);
        }

        return redirect('/')->withErrors('Fare unavailable. Please try again.');
    }

    public function generatepnr(Request $request, $sessionId)
    {

        $amadeus = $request->session()->get('amadeus');

        if (!isset($amadeus[$sessionId - 1])) {
            return abort(400);
        }

        $request->validate([
            'passenger.*.firstName' => 'required|regex:/^[a-zA-Z\s]*$/',
            'passenger.*.lastName' => 'required|alpha',
            'passenger.*.type' => 'required|in:ADULT,CHILD,HELD_INFANT',
            'passenger.*.dateOfBirth' => 'required|before:today',
            'passenger.*.gender' => 'required|in:MALE,FEMALE',
            'passenger.*.street' => 'required',
            'passenger.*.city' => 'required',
            'passenger.*.zip' => 'required',
            'passenger.*.countryCode' => 'required',
            'passenger.*.passportNumber' => 'nullable|alpha_num',
            'passenger.*.passportExpiryDate' => 'nullable|required_with:passenger.*.passportNumber|after:today',
            'passenger.*.passportNationality' => 'nullable|required_with:passenger.*.passportNumber',
            'passenger.*.contactNumber' => 'required|numeric',
            'passenger.*.email' => 'required'
        ]);

        $travelers = [];

        foreach ($request->input('passenger') as $passengerId => $passenger) {

            if ($passenger['type'] == 'CHILD' && strtotime($passenger['dateOfBirth']) < strtotime('- 12 year')) {
                return back()->withInput()->withErrors("passenger $passengerId age should be less then 12 years");
            }

            if ($passenger['type'] == 'HELD_INFANT' && strtotime($passenger['dateOfBirth']) < strtotime('- 2 year')) {
                return back()->withInput()->withErrors("passenger $passengerId age should be less then 2 years");
            }

            $traveler = [
                'id' => $passengerId,
                'dateOfBirth' => $passenger['dateOfBirth'],
                'name' => [
                    'firstName' => $passenger['firstName'],
                    'lastName' => $passenger['lastName'],
                ],
                'gender' => $passenger['gender'],
                'contact' => [
                    'emailAddress' => $passenger['email'],
                    'phones' => [
                        [
                            'deviceType' => 'MOBILE',
                            'number' => $passenger['contactNumber']
                        ]
                    ],
                    'address' => [
                        'postalCode' => $passenger['zip'],
                        'countryCode' => $passenger['countryCode'],
                        'cityName' => $passenger['city'],
                        'lines' => [$passenger['street']]
                    ]
                ]
            ];

            if (isset($passenger['passportNumber']) && $passenger['passportNumber'] != '') {
                $traveler['documents'] = [
                    [
                        'documentType' => 'PASSPORT',
                        'number' => $passenger['passportNumber'],
                        'expiryDate' => $passenger['passportExpiryDate'],
                        'issuanceCountry' => $passenger['passportNationality'],
                        'nationality' => $passenger['passportNationality'],
                        'holder' => true
                    ]
                ];
            }

            array_push($travelers, $traveler);
        }

        $flightOffers = json_decode($amadeus[$sessionId - 1]);

        $resp = json_decode($this->amadeus->order($flightOffers, $travelers));

        if (isset($resp->data->id)) {
            return view('pnrdetails', ['resp' => $resp]);
        }

        return back()->withInput()->withErrors('Fare Not Available!');
    }
}
