<?php

namespace App\Api;

use Error;

class Amadeus
{
    private $baseUrl = "https://test.api.amadeus.com";
    private $token, $clientId, $clientSecret, $currencyCode;

    public function __construct($clientId, $clientSecret, $currencyCode = 'BDT')
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->currencyCode = $currencyCode;

        $this->authorize();
    }

    private function authorize()
    {
        $encryptionMethod = 'AES-128-CTR';
        $encryptionKey = 'jcX1Sxx73Xtlbn2lHOVB';
        $encryptionIv = 'VI29bGVmmwmkfzXF';

        $tokenFile = dirname(__FILE__) . '/amadeus_api_token_info.json';
        if (file_exists($tokenFile)) {

            $tokenFileData = json_decode(@file_get_contents($tokenFile));

            if (
                $tokenFileData->expireOn > time() &&
                $this->clientId == openssl_decrypt($tokenFileData->clientId, $encryptionMethod, $encryptionKey, 0, $encryptionIv) &&
                $this->clientSecret == openssl_decrypt($tokenFileData->clientSecret, $encryptionMethod, $encryptionKey, 0, $encryptionIv)
            ) {

                $this->token = openssl_decrypt($tokenFileData->token, $encryptionMethod, $encryptionKey, 0, $encryptionIv);

                /*
                --------------------------------------------------------------------------------
                |                                                                              |
                | Never forget return from function here. Otherwise a infinite loop will start |
                |                                                                              |
                --------------------------------------------------------------------------------
                */
                return true;
            }

            if (@unlink($tokenFile)) {
                return $this->authorize();
            }
        } else {

            $resp = json_decode($this->generateToken());

            if ($resp !== null) {

                if (isset($resp->state) && $resp->state === "approved") {

                    $this->token = $resp->access_token;

                    $tokenFileData = [
                        'clientId' => openssl_encrypt($this->clientId, $encryptionMethod, $encryptionKey, 0, $encryptionIv),
                        'clientSecret' => openssl_encrypt($this->clientSecret, $encryptionMethod, $encryptionKey, 0, $encryptionIv),
                        'token' => openssl_encrypt($resp->access_token, $encryptionMethod, $encryptionKey, 0, $encryptionIv),
                        'expireOn' => time() + $resp->expires_in
                    ];

                    if (@file_put_contents($tokenFile, json_encode($tokenFileData)) !== false) {
                        return true;
                    }
                } else if (isset($resp->error_description)) {
                    throw new Error($resp->error_description);
                }
            }
        }

        throw new Error('Unexpected error occurred when generating the authorization token');
    }

    private function generateToken()
    {

        $header = ['Content-Type: application/x-www-form-urlencoded'];

        $param = http_build_query([
            'grant_type' => 'client_credentials',
            'client_id' => 'hzusG7jo9bAmHFDxJxL58953BcNQteLv',
            'client_secret' => 'A1AhgDuvb2gL0Yh7'
        ]);

        return $this->callapi('/v1/security/oauth2/token', 'POST', $param, $header, false);
    }

    public function search($adults, $children, $infants, $travelClass, $originDestinations)
    {

        $travelers = [];
        $originDestinationIds = [];
        $travelerId = 1;
        for ($i = 1; $i <= $adults; $i++) {
            array_push($originDestinationIds, $travelerId);

            array_push($travelers, [
                'id' => $travelerId++,
                'travelerType' => 'ADULT'
            ]);
        }

        for ($i = 1; $i <= $children; $i++) {
            array_push($originDestinationIds, $travelerId);

            array_push($travelers, [
                'id' => $travelerId++,
                'travelerType' => 'CHILD'
            ]);
        }

        for ($i = 1; $i <= $infants; $i++) {
            array_push($originDestinationIds, $travelerId);

            array_push($travelers, [
                'id' => $travelerId++,
                'associatedAdultId' => 1,
                'travelerType' => 'HELD_INFANT'
            ]);
        }

        $param = [
            'currencyCode' => $this->currencyCode,
            'originDestinations' => $originDestinations,
            'travelers' => $travelers,
            'sources' => ['GDS'],
            'searchCriteria' => [
                'pricingOptions' => [
                    'refundableFare' => true
                ]
            ]
        ];

        if ($travelClass !== 'Any') {
            $param['searchCriteria']['flightFilters'] = [
                'cabinRestrictions' => [
                    [
                        'cabin' => strtoupper($travelClass),
                        'originDestinationIds' => $originDestinationIds
                    ]
                ]
            ];
        }
        $param = json_encode($param);

        return $this->callapi('/v2/shopping/flight-offers', 'POST', $param);
    }

    public function price($flightOffers)
    {
        $param = [
            'data' => [
                'type' => 'flight-offers-pricing',
                'flightOffers' => [$flightOffers]
            ]
        ];
        $param = json_encode($param);

        return $this->callapi('/v1/shopping/flight-offers/pricing', 'POST', $param);
    }

    public function order($flightOffers, $travelers)
    {
        $param = [
            'data' => [
                'type' => 'flight-offers-pricing',
                'flightOffers' => [$flightOffers],
                'travelers' => $travelers,
                'ticketingAgreement' => [
                    'option' => 'DELAY_TO_CANCEL',
                    'delay' => '6D'
                ]
            ]
        ];
        $param = json_encode($param);

        return $this->callapi('/v1/booking/flight-orders', 'POST', $param);
    }

    private function callapi($endPoint, $method, $param, $header = ['Content-Type: application/vnd.amadeus+json'], $attachToken = true)
    {

        $api = curl_init();

        if ($attachToken) {
            array_push($header, 'Authorization: Bearer ' . $this->token);
        }

        curl_setopt_array($api, [
            CURLOPT_URL =>  $this->baseUrl . $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $param
        ]);
        $resp = curl_exec($api);
        curl_close($api);

        return $resp;
    }
}
