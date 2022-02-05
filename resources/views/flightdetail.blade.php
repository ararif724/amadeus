<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>B2B Travel Portal Bangladesh | zooFamily | Home</title>
    <link rel="icon" href="{{ asset('/front_asset/img/logo.png') }}" type="image/gif">
    <link rel="stylesheet" href="{{ asset('/front_asset/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('/front_asset/css/lightslider.css') }}">
    <link rel="stylesheet" href="{{ asset('/front_asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/front_asset/css/custom.css') }}">
</head>

<body>
    <div id="wrap">
        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="pull-left">
                            <div id="logo">
                                <a href="{{ url('/') }}" title="">
                                    <img src="{{ asset('/front_asset/img/60212eabb970e.png') }}"
                                        class="img-responsive" alt="Logo" style="width:55px;margin-top: 2px;">
                                </a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </header>

        <section class="result-container">
            <div class="container">

                @foreach ($resp->data->flightOffers as $row)

                    <div class="search-list">
                        <div class="round-multi-city-wrapper">
                            <div class="round-multi-city-left">

                                @foreach ($row->itineraries as $itineraries)

                                    {{-- itineraries Start --}}
                                    <div class="one-round-multi-city" id="round-multi-city-one"
                                        data-stopage="stop-{{ count($itineraries->segments) - 1 }}"
                                        data-carrier="{{ $itineraries->segments[0]->carrierCode }}"
                                        data-cabin="{{ isset($row->travelerPricings[0]->fareDetailsBySegment[0]->cabin) ? ucfirst(strtolower($row->travelerPricings[0]->fareDetailsBySegment[0]->cabin)) : '' }}">
                                        <div id="search-header">
                                            <p>{{ date('l, d F', strtotime($itineraries->segments[0]->departure->at)) }}
                                            </p>
                                            <div id="search-header-middle">
                                                <h3>{{ $itineraries->segments[0]->departure->iataCode }}
                                                </h3>
                                                &nbsp;
                                                <img src="https://b2b.zoo.family/public/front_asset/img/plane-flight.png"
                                                    class="img-responsive" />
                                                &nbsp;
                                                <h3>{{ end($itineraries->segments)->arrival->iataCode }}
                                                </h3>
                                            </div>
                                            <p></p>
                                        </div>
                                        <div class="search-content">
                                            <div>
                                                <img src="https://goprivate.wspan.com/sharedservices/images/airlineimages/logoAir{{ $itineraries->segments[0]->operating->carrierCode }}.gif"
                                                    class="img-responsive"
                                                    alt="{{ $itineraries->segments[0]->operating->carrierCode }}">
                                                <small>{{ $itineraries->segments[0]->operating->carrierCode }}
                                                    ({{ $itineraries->segments[0]->number }})</small>
                                                <br>
                                                <small>Operated By:
                                                    {{ isset($resp->dictionaries->carriers->{$itineraries->segments[0]->operating->carrierCode}) ? $resp->dictionaries->carriers->{$itineraries->segments[0]->operating->carrierCode} : $itineraries->segments[0]->operating->carrierCode }}
                                                </small>
                                            </div>
                                            <div>
                                                <h3>{{ date('H:i', strtotime($itineraries->segments[0]->departure->at)) }}
                                                </h3>
                                                <small>{{ $itineraries->segments[0]->departure->iataCode }}</small>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li>
                                                        {{ $numberToWord(count($itineraries->segments) - 1) }}
                                                        Stop
                                                    </li>
                                                    <li>
                                                        {{ isset($row->travelerPricings[0]->fareDetailsBySegment[0]->cabin) ? ucfirst(strtolower($row->travelerPricings[0]->fareDetailsBySegment[0]->cabin)) : '' }}
                                                    </li>
                                                    <li>
                                                        @php
                                                            $duration = new DateInterval($itineraries->duration);
                                                            echo $duration->format('%h h %i m');
                                                        @endphp
                                                    </li>
                                                </ul>
                                            </div>
                                            <div>
                                                <h3>{{ date('H:i', strtotime(end($itineraries->segments)->arrival->at)) }}
                                                </h3>
                                                <small>{{ end($itineraries->segments)->arrival->iataCode }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- itineraries End --}}

                                @endforeach

                            </div>
                            <!-- Price and Book btn component start -->
                            <div class="round-multi-city-right">
                                <div class="binfo">
                                    <div id="center-align-div">
                                        <h4 style="text-align: center">
                                            {{ $row->price->currency }}
                                            {{ $row->price->grandTotal }}
                                        </h4>
                                        <button type="button" class="price-details-btn">Book Now</button>
                                    </div>
                                    <div>
                                        <span class="booking-info">
                                            <i class="glyphicon glyphicon-question-sign bii"></i>
                                            <div class="booking-info-data">
                                                <i class="glyphicon glyphicon-triangle-top bii-down"></i>
                                                <div class="bi-info">
                                                    <p>Base Fare</p>
                                                    <p>
                                                        {{ $row->price->currency }}
                                                        {{ $row->price->base }}
                                                    </p>
                                                </div>
                                                <div class="bi-info">
                                                    <p>Taxes and Fees</p>
                                                    <p>
                                                        {{ $row->price->currency }}
                                                        {{ $row->price->grandTotal - $row->price->base }}
                                                    </p>
                                                </div>
                                                <div class="bi-info">
                                                    <p>
                                                        <b class="bi-total">Total</b>
                                                    </p>
                                                    <p>
                                                        {{ $row->price->currency }}
                                                        {{ $row->price->grandTotal }}
                                                    </p>
                                                </div>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- Price and Book btn component start -->
                        </div>
                        <!-- Flight Details component start -->
                        <div class="search-details">
                            <div class="search-detail-link">
                                <p class="text-success-ref">
                                    {{ $row->pricingOptions->refundableFare ? 'Refundable' : 'Non Refundable' }}
                                </p>
                                <p class="slide-detail">
                                    flight details
                                    <i class="glyphicon glyphicon-menu-down"></i>
                                </p>
                            </div>
                            <div class="flight-details">
                                <div style="padding: 10px;">
                                    <ul class="nav nav-tabs asdf" role="tablist">
                                        @foreach ($row->itineraries as $itineraries)

                                            <li role="presentation" class="{{ $loop->first ? 'active' : '' }}">
                                                <a href="#fly-{{ $loop->parent->iteration }}-{{ $loop->iteration }}"
                                                    aria-controls="fly-{{ $loop->parent->iteration }}-{{ $loop->iteration }}"
                                                    role="tab" data-toggle="tab">
                                                    <div class="fd-tabs {{ $loop->first ? 'mytabActive' : '' }}">
                                                        <p>{{ $itineraries->segments[0]->departure->iataCode }}
                                                        </p>
                                                        <img src="https://b2b.zoo.family/public/front_asset/img/aro-icon.png"
                                                            style="width: 13px;" />
                                                        <p>{{ end($itineraries->segments)->arrival->iataCode }}
                                                        </p>
                                                    </div>
                                                </a>
                                            </li>

                                        @endforeach

                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">

                                        @foreach ($row->itineraries as $itineraries)

                                            <div role="tabpanel" class="tab-pane {{ $loop->first ? 'active' : '' }}"
                                                id="fly-{{ $loop->parent->iteration }}-{{ $loop->iteration }}">

                                                @foreach ($itineraries->segments as $segments)

                                                    <div class="multiple-stopage-list">
                                                        <div>
                                                            <img src="https://goprivate.wspan.com/sharedservices/images/airlineimages/logoAir{{ $segments->operating->carrierCode }}.gif"
                                                                class="img-responsive"
                                                                alt="{{ $segments->operating->carrierCode }}">
                                                        </div>
                                                        <div>
                                                            <h3>{{ isset($resp->dictionaries->carriers->{$segments->operating->carrierCode}) ? $resp->dictionaries->carriers->{$segments->operating->carrierCode} : $segments->operating->carrierCode }}
                                                            </h3>
                                                            <p>Aircraft:
                                                                {{ isset($resp->dictionaries->aircraft->{$segments->aircraft->code}) ? $resp->dictionaries->aircraft->{$segments->aircraft->code} : $segments->aircraft->code }}
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <h3>{{ date('d F H:i', strtotime($segments->departure->at)) }}
                                                            </h3>
                                                            <p>{{ $segments->departure->iataCode }}
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <ul>
                                                                <li>
                                                                    {{ isset($row->travelerPricings[0]->fareDetailsBySegment[$loop->index]->cabin) ? ucfirst(strtolower($row->travelerPricings[0]->fareDetailsBySegment[$loop->index]->cabin)) : '' }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div>
                                                            <h3>{{ date('d F H:i', strtotime($segments->arrival->at)) }}
                                                            </h3>
                                                            <p>{{ $segments->arrival->iataCode }}
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <h3>{{ $segments->operating->carrierCode }}
                                                            </h3>
                                                            <p>{{ $segments->number }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="multiple-stopage-list-foot">
                                                        <h4 class="layover"></h4>
                                                        <div class="multiple-stopage-list-foot-right">
                                                            <div>
                                                                <h4>Available seat</h4>
                                                                <small>
                                                                    <i class="fas fa-couch"></i>
                                                                    {{ $row->numberOfBookableSeats }}
                                                                </small>
                                                            </div>
                                                            <div>
                                                                <h4>Baggage</h4>
                                                                <small>
                                                                    <i class="fas fa-suitcase-rolling"></i>
                                                                    {{ isset($row->travelerPricings[0]->fareDetailsBySegment[$loop->index]->includedCheckedBags->weight) ? $row->travelerPricings[0]->fareDetailsBySegment[$loop->index]->includedCheckedBags->weight : '' }}
                                                                    {{ isset($row->travelerPricings[0]->fareDetailsBySegment[$loop->index]->includedCheckedBags->weightUnit) ? $row->travelerPricings[0]->fareDetailsBySegment[$loop->index]->includedCheckedBags->weightUnit : '' }}

                                                                </small>
                                                            </div>
                                                            {{-- <div>
                                                                <a href="#" id="fare-rule" class="fare-rules-btn" data-fareinfo="WZuhjpsxnDKAz7FMYBAAAA==" data-toggle="modal" data-target="#fare-modal">Fare
                                                                Rules</a>
                                                            </div> --}}
                                                        </div>
                                                    </div>

                                                @endforeach

                                            </div>

                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Flight Details component end -->
                    </div>

                @endforeach

                <!--Generate passengers form-->
                <form action="{{ url('pnr/' . $sessionId) }}" method="post">

                    @csrf

                    <h2 class="page-title">Travelers Information</h2>

                    {{-- Form for adults --}}
                    @foreach ($resp->data->flightOffers[0]->travelerPricings as $traveler)

                        <div class="traveler-info">

                            <p style="font-size: 20px" class="font-weight-bold">
                                Pessenger ({{ $traveler->travelerId }})
                                <span
                                    class="badge badge-danger">{{ $traveler->travelerType == 'HELD_INFANT' ? 'INFANT' : $traveler->travelerType }}</span>
                                @if ($traveler->travelerId == 1)
                                    <small>Primary Contact</small>
                                @endif
                            </p>
                            <input type="hidden" name="passenger[{{ $traveler->travelerId }}][type]"
                                value="{{ $traveler->travelerType }}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="FirstName">First Name</label>
                                        <input type="text" name="passenger[{{ $traveler->travelerId }}][firstName]"
                                            id="FirstName" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="LastName">Last Name</label>
                                        <input type="text" name="passenger[{{ $traveler->travelerId }}][lastName]"
                                            id="LastName" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="DateOfBirth">Date Of Birth</label>
                                        <input type="date" name="passenger[{{ $traveler->travelerId }}][dateOfBirth]"
                                            id="DateOfBirth" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="Gender">Gender</label>
                                        <select name="passenger[{{ $traveler->travelerId }}][gender]" id="Gender"
                                            class="form-control" required>
                                            <option value="MALE">Male</option>
                                            <option value="FEMALE">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="Street">Street</label>
                                        <input type="text" name="passenger[{{ $traveler->travelerId }}][street]"
                                            id="Street" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="City">City</label>
                                    <input type="text" name="passenger[{{ $traveler->travelerId }}][city]" id="City"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="Zip">Zip Code</label>
                                        <input type="text" name="passenger[{{ $traveler->travelerId }}][zip]"
                                            id="Zip" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="CountryCode">Country</label>
                                        <select name="passenger[{{ $traveler->travelerId }}][countryCode]"
                                            id="CountryCode" required>
                                            <option value="">Select Country</option>
                                            <option value="AF">Afghanistan</option>
                                            <option value="AX">Aland Islands</option>
                                            <option value="AL">Albania</option>
                                            <option value="DZ">Algeria</option>
                                            <option value="AD">Andorra</option>
                                            <option value="AO">Angola</option>
                                            <option value="AI">Anguilla</option>
                                            <option value="AQ">Antartica</option>
                                            <option value="AG">Antigua And Barbuda</option>
                                            <option value="AR">Argentina</option>
                                            <option value="AM">Armenia</option>
                                            <option value="AW">Aruba</option>
                                            <option value="SH">Ascension Island/St. Helena</option>
                                            <option value="AU">Australia</option>
                                            <option value="AT">Austria</option>
                                            <option value="AZ">Azerbaijan</option>
                                            <option value="BS">Bahamas</option>
                                            <option value="BH">Bahrain</option>
                                            <option value="BD">Bangladesh</option>
                                            <option value="BB">Barbados</option>
                                            <option value="BY">Belarus</option>
                                            <option value="BE">Belgium</option>
                                            <option value="BZ">Belize</option>
                                            <option value="BJ">Benin</option>
                                            <option value="BM">Bermuda</option>
                                            <option value="BT">Bhutan</option>
                                            <option value="BO">Bolivia</option>
                                            <option value="BQ">Bonaire</option>
                                            <option value="BA">Bosnia Herzegowina</option>
                                            <option value="BW">Botswana</option>
                                            <option value="BV">Bouvet Island</option>
                                            <option value="BR">Brazil</option>
                                            <option value="IO">British Indian Ocean Territory</option>
                                            <option value="VG">British Virgin Islands</option>
                                            <option value="BN">Brunei</option>
                                            <option value="BG">Bulgaria</option>
                                            <option value="BF">Burkina Faso</option>
                                            <option value="BI">Burundi</option>
                                            <option value="KH">Cambodia</option>
                                            <option value="CM">Cameroon</option>
                                            <option value="CA">Canada</option>
                                            <option value="CV">Cape Verde</option>
                                            <option value="KY">Cayman Islands</option>
                                            <option value="CF">Central African Republic</option>
                                            <option value="TD">Chad</option>
                                            <option value="CL">Chile</option>
                                            <option value="CN">China</option>
                                            <option value="CX">Christmas Island</option>
                                            <option value="CC">Cocos Islands</option>
                                            <option value="CO">Colombia</option>
                                            <option value="KM">Comoros</option>
                                            <option value="CG">Congo</option>
                                            <option value="CD">Congo Democratic Republic Of</option>
                                            <option value="CK">Cook Islands</option>
                                            <option value="CR">Costa Rica</option>
                                            <option value="HR">Croatia</option>
                                            <option value="CU">Cuba</option>
                                            <option value="CW">Curacao</option>
                                            <option value="CY">Cyprus</option>
                                            <option value="CZ">Czech Republic</option>
                                            <option value="DK">Denmark</option>
                                            <option value="DJ">Djibouti</option>
                                            <option value="DM">Dominica</option>
                                            <option value="DO">Dominican Republic</option>
                                            <option value="EC">Ecuador</option>
                                            <option value="EG">Egypt</option>
                                            <option value="SV">El Salvador</option>
                                            <option value="GQ">Equatorial Guinea</option>
                                            <option value="ER">Eritrea</option>
                                            <option value="EE">Estonia</option>
                                            <option value="ET">Ethiopia</option>
                                            <option value="FK">Falkland Islands</option>
                                            <option value="FO">Faroe Islands</option>
                                            <option value="FJ">Fiji Islands</option>
                                            <option value="FI">Finland</option>
                                            <option value="FR">France</option>
                                            <option value="GF">French Guiana</option>
                                            <option value="PF">French Polynesia</option>
                                            <option value="TF">French Southern Territories</option>
                                            <option value="GA">Gabon</option>
                                            <option value="GM">Gambia</option>
                                            <option value="GE">Georgia</option>
                                            <option value="DE">Germany</option>
                                            <option value="GH">Ghana</option>
                                            <option value="GI">Gibraltar</option>
                                            <option value="GR">Greece</option>
                                            <option value="GL">Greenland</option>
                                            <option value="GD">Grenada</option>
                                            <option value="GP">Guadeloupe</option>
                                            <option value="GU">Guam</option>
                                            <option value="GT">Guatemala</option>
                                            <option value="GG">Guernsey</option>
                                            <option value="GN">Guinea</option>
                                            <option value="GW">Guinea Bissau</option>
                                            <option value="GY">Guyana</option>
                                            <option value="HT">Haiti</option>
                                            <option value="HM">Heard Island And McDonald Islands</option>
                                            <option value="HN">Honduras</option>
                                            <option value="HK">Hong Kong</option>
                                            <option value="HU">Hungary</option>
                                            <option value="IS">Iceland</option>
                                            <option value="IN">India</option>
                                            <option value="ID">Indonesia</option>
                                            <option value="IR">Iran</option>
                                            <option value="IQ">Iraq</option>
                                            <option value="IE">Ireland</option>
                                            <option value="IM">Isle Of Man</option>
                                            <option value="IL">Israel</option>
                                            <option value="IT">Italy</option>
                                            <option value="CI">Ivory Coast</option>
                                            <option value="JM">Jamaica</option>
                                            <option value="JP">Japan</option>
                                            <option value="JE">Jersey</option>
                                            <option value="JO">Jordan</option>
                                            <option value="KZ">Kazakhstan</option>
                                            <option value="KE">Kenya</option>
                                            <option value="KI">Kiribati</option>
                                            <option value="KP">Korea</option>
                                            <option value="KR">Korea</option>
                                            <option value="XK">Kosovo</option>
                                            <option value="KW">Kuwait</option>
                                            <option value="KG">Kyrgyzstan</option>
                                            <option value="LA">Lao People's Dem. Rep.</option>
                                            <option value="LV">Latvia</option>
                                            <option value="LB">Lebanon</option>
                                            <option value="LS">Lesotho</option>
                                            <option value="LR">Liberia</option>
                                            <option value="LY">Libyan Arab Jamahiriya</option>
                                            <option value="LI">Liechtenstein</option>
                                            <option value="LT">Lithuania</option>
                                            <option value="LU">Luxembourg</option>
                                            <option value="MO">Macau</option>
                                            <option value="MK">Macedonia</option>
                                            <option value="MG">Madagascar (Malagasy)</option>
                                            <option value="MW">Malawi</option>
                                            <option value="MY">Malaysia</option>
                                            <option value="MV">Maldives</option>
                                            <option value="ML">Mali</option>
                                            <option value="MT">Malta</option>
                                            <option value="MH">Marshall Islands</option>
                                            <option value="MQ">Martinique</option>
                                            <option value="MR">Mauritania</option>
                                            <option value="MU">Mauritius</option>
                                            <option value="YT">Mayotte</option>
                                            <option value="MX">Mexico</option>
                                            <option value="FM">Micronesia</option>
                                            <option value="MD">Moldova Republic Of</option>
                                            <option value="MC">Monaco</option>
                                            <option value="MN">Mongolia</option>
                                            <option value="ME">Montenegro</option>
                                            <option value="MS">Montserrat</option>
                                            <option value="MA">Morocco</option>
                                            <option value="MZ">Mozambique</option>
                                            <option value="MM">Myanmar</option>
                                            <option value="NA">Namibia</option>
                                            <option value="NR">Nauru</option>
                                            <option value="NP">Nepal</option>
                                            <option value="NL">Netherlands</option>
                                            <option value="AN">Netherlands Antilles</option>
                                            <option value="NC">New Caledonia</option>
                                            <option value="NZ">New Zealand</option>
                                            <option value="NI">Nicaragua</option>
                                            <option value="NE">Niger</option>
                                            <option value="NG">Nigeria</option>
                                            <option value="NU">Niue</option>
                                            <option value="NF">Norfolk Island</option>
                                            <option value="MP">Northern Marianna Islands</option>
                                            <option value="NO">Norway</option>
                                            <option value="OM">Oman</option>
                                            <option value="PK">Pakistan</option>
                                            <option value="PW">Palau</option>
                                            <option value="PA">Panama</option>
                                            <option value="PG">Papua New Guinea</option>
                                            <option value="PY">Paraguay</option>
                                            <option value="PE">Peru</option>
                                            <option value="PH">Philippines</option>
                                            <option value="PN">Pitcairn</option>
                                            <option value="PL">Poland</option>
                                            <option value="PT">Portugal</option>
                                            <option value="PR">Puerto Rico</option>
                                            <option value="QA">Qatar</option>
                                            <option value="RE">Reunion</option>
                                            <option value="RO">Romania</option>
                                            <option value="RU">Russian Federation</option>
                                            <option value="RW">Rwanda</option>
                                            <option value="LC">Saint Lucia</option>
                                            <option value="VC">Saint Vincent And The Grenadines</option>
                                            <option value="AS">Samoa</option>
                                            <option value="WS">Samoa</option>
                                            <option value="SM">San Marino</option>
                                            <option value="ST">Sao Tome and Principe</option>
                                            <option value="SA">Saudi Arabia</option>
                                            <option value="SN">Senegal</option>
                                            <option value="RS">Serbia</option>
                                            <option value="CS">Serbia and Montenegro</option>
                                            <option value="SC">Seychelles</option>
                                            <option value="SL">Sierra Leone</option>
                                            <option value="SG">Singapore</option>
                                            <option value="SK">Slovakia</option>
                                            <option value="SI">Slovenia</option>
                                            <option value="SB">Solomon Islands</option>
                                            <option value="SO">Somalia</option>
                                            <option value="ZA">South Africa</option>
                                            <option value="GS">South Georgia And S Sandwich Island</option>
                                            <option value="SS">South Sudan</option>
                                            <option value="ES">Spain</option>
                                            <option value="LK">Sri Lanka</option>
                                            <option value="BL">St Barthelemy</option>
                                            <option value="SX">St Maarten</option>
                                            <option value="MF">St Martin</option>
                                            <option value="PM">St Pierre and Miquelon</option>
                                            <option value="KN">St. Kitts - Nevis</option>
                                            <option value="PS">State of Palestine</option>
                                            <option value="SD">Sudan</option>
                                            <option value="SR">Suriname</option>
                                            <option value="SJ">Svalbard And Jan Mayen Is</option>
                                            <option value="SZ">Swaziland</option>
                                            <option value="SE">Sweden</option>
                                            <option value="CH">Switzerland</option>
                                            <option value="SY">Syrian Arab Republic</option>
                                            <option value="TW">Taiwan</option>
                                            <option value="TJ">Tajikistan</option>
                                            <option value="TZ">Tanzania United Republic Of</option>
                                            <option value="TH">Thailand</option>
                                            <option value="TL">Timor Leste</option>
                                            <option value="TG">Togo</option>
                                            <option value="TK">Tokelau</option>
                                            <option value="TO">Tonga</option>
                                            <option value="TT">Trinidad and Tobago</option>
                                            <option value="TN">Tunisia</option>
                                            <option value="TR">Turkey</option>
                                            <option value="TM">Turkmenistan</option>
                                            <option value="TC">Turks And Caicos Islands</option>
                                            <option value="TV">Tuvalu</option>
                                            <option value="UG">Uganda</option>
                                            <option value="UA">Ukraine</option>
                                            <option value="AE">United Arab Emirates</option>
                                            <option value="GB">United Kingdom</option>
                                            <option value="US">United States</option>
                                            <option value="UM">United States Minor Outlying Islnds</option>
                                            <option value="UY">Uruguay</option>
                                            <option value="VI">Us Virgin Isalnds</option>
                                            <option value="UZ">Uzbekistan</option>
                                            <option value="VU">Vanuatu</option>
                                            <option value="VA">Vatican City State</option>
                                            <option value="VE">Venezuela</option>
                                            <option value="VN">Vietnam</option>
                                            <option value="WF">Wallis and Futuna Islands</option>
                                            <option value="EH">Western Sahara</option>
                                            <option value="YE">Yemen</option>
                                            <option value="ZM">Zambia</option>
                                            <option value="ZW">Zimbabwe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="PassportNumber">Passport Number</label>
                                        <input type="text"
                                            name="passenger[{{ $traveler->travelerId }}][passportNumber]"
                                            id="PassportNumber" class="form-control" @if ($resp->data->bookingRequirements->travelerRequirements[$loop->index]->documentRequired) required @endif>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="PassportExpiryDate">Passport Expiry Date</label>
                                        <input type="date"
                                            name="passenger[{{ $traveler->travelerId }}][passportExpiryDate]"
                                            id="PassportExpiryDate" class="form-control" @if ($resp->data->bookingRequirements->travelerRequirements[$loop->index]->documentRequired) required @endif>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="PassportNationality">Passport Nationality</label>
                                        <select name="passenger[{{ $traveler->travelerId }}][passportNationality]"
                                            id="PassportNationality" @if ($resp->data->bookingRequirements->travelerRequirements[$loop->index]->documentRequired) required @endif>
                                            <option value="">Select Country</option>
                                            <option value="AF">Afghanistan</option>
                                            <option value="AX">Aland Islands</option>
                                            <option value="AL">Albania</option>
                                            <option value="DZ">Algeria</option>
                                            <option value="AD">Andorra</option>
                                            <option value="AO">Angola</option>
                                            <option value="AI">Anguilla</option>
                                            <option value="AQ">Antartica</option>
                                            <option value="AG">Antigua And Barbuda</option>
                                            <option value="AR">Argentina</option>
                                            <option value="AM">Armenia</option>
                                            <option value="AW">Aruba</option>
                                            <option value="SH">Ascension Island/St. Helena</option>
                                            <option value="AU">Australia</option>
                                            <option value="AT">Austria</option>
                                            <option value="AZ">Azerbaijan</option>
                                            <option value="BS">Bahamas</option>
                                            <option value="BH">Bahrain</option>
                                            <option value="BD">Bangladesh</option>
                                            <option value="BB">Barbados</option>
                                            <option value="BY">Belarus</option>
                                            <option value="BE">Belgium</option>
                                            <option value="BZ">Belize</option>
                                            <option value="BJ">Benin</option>
                                            <option value="BM">Bermuda</option>
                                            <option value="BT">Bhutan</option>
                                            <option value="BO">Bolivia</option>
                                            <option value="BQ">Bonaire</option>
                                            <option value="BA">Bosnia Herzegowina</option>
                                            <option value="BW">Botswana</option>
                                            <option value="BV">Bouvet Island</option>
                                            <option value="BR">Brazil</option>
                                            <option value="IO">British Indian Ocean Territory</option>
                                            <option value="VG">British Virgin Islands</option>
                                            <option value="BN">Brunei</option>
                                            <option value="BG">Bulgaria</option>
                                            <option value="BF">Burkina Faso</option>
                                            <option value="BI">Burundi</option>
                                            <option value="KH">Cambodia</option>
                                            <option value="CM">Cameroon</option>
                                            <option value="CA">Canada</option>
                                            <option value="CV">Cape Verde</option>
                                            <option value="KY">Cayman Islands</option>
                                            <option value="CF">Central African Republic</option>
                                            <option value="TD">Chad</option>
                                            <option value="CL">Chile</option>
                                            <option value="CN">China</option>
                                            <option value="CX">Christmas Island</option>
                                            <option value="CC">Cocos Islands</option>
                                            <option value="CO">Colombia</option>
                                            <option value="KM">Comoros</option>
                                            <option value="CG">Congo</option>
                                            <option value="CD">Congo Democratic Republic Of</option>
                                            <option value="CK">Cook Islands</option>
                                            <option value="CR">Costa Rica</option>
                                            <option value="HR">Croatia</option>
                                            <option value="CU">Cuba</option>
                                            <option value="CW">Curacao</option>
                                            <option value="CY">Cyprus</option>
                                            <option value="CZ">Czech Republic</option>
                                            <option value="DK">Denmark</option>
                                            <option value="DJ">Djibouti</option>
                                            <option value="DM">Dominica</option>
                                            <option value="DO">Dominican Republic</option>
                                            <option value="EC">Ecuador</option>
                                            <option value="EG">Egypt</option>
                                            <option value="SV">El Salvador</option>
                                            <option value="GQ">Equatorial Guinea</option>
                                            <option value="ER">Eritrea</option>
                                            <option value="EE">Estonia</option>
                                            <option value="ET">Ethiopia</option>
                                            <option value="FK">Falkland Islands</option>
                                            <option value="FO">Faroe Islands</option>
                                            <option value="FJ">Fiji Islands</option>
                                            <option value="FI">Finland</option>
                                            <option value="FR">France</option>
                                            <option value="GF">French Guiana</option>
                                            <option value="PF">French Polynesia</option>
                                            <option value="TF">French Southern Territories</option>
                                            <option value="GA">Gabon</option>
                                            <option value="GM">Gambia</option>
                                            <option value="GE">Georgia</option>
                                            <option value="DE">Germany</option>
                                            <option value="GH">Ghana</option>
                                            <option value="GI">Gibraltar</option>
                                            <option value="GR">Greece</option>
                                            <option value="GL">Greenland</option>
                                            <option value="GD">Grenada</option>
                                            <option value="GP">Guadeloupe</option>
                                            <option value="GU">Guam</option>
                                            <option value="GT">Guatemala</option>
                                            <option value="GG">Guernsey</option>
                                            <option value="GN">Guinea</option>
                                            <option value="GW">Guinea Bissau</option>
                                            <option value="GY">Guyana</option>
                                            <option value="HT">Haiti</option>
                                            <option value="HM">Heard Island And McDonald Islands</option>
                                            <option value="HN">Honduras</option>
                                            <option value="HK">Hong Kong</option>
                                            <option value="HU">Hungary</option>
                                            <option value="IS">Iceland</option>
                                            <option value="IN">India</option>
                                            <option value="ID">Indonesia</option>
                                            <option value="IR">Iran</option>
                                            <option value="IQ">Iraq</option>
                                            <option value="IE">Ireland</option>
                                            <option value="IM">Isle Of Man</option>
                                            <option value="IL">Israel</option>
                                            <option value="IT">Italy</option>
                                            <option value="CI">Ivory Coast</option>
                                            <option value="JM">Jamaica</option>
                                            <option value="JP">Japan</option>
                                            <option value="JE">Jersey</option>
                                            <option value="JO">Jordan</option>
                                            <option value="KZ">Kazakhstan</option>
                                            <option value="KE">Kenya</option>
                                            <option value="KI">Kiribati</option>
                                            <option value="KP">Korea</option>
                                            <option value="KR">Korea</option>
                                            <option value="XK">Kosovo</option>
                                            <option value="KW">Kuwait</option>
                                            <option value="KG">Kyrgyzstan</option>
                                            <option value="LA">Lao People's Dem. Rep.</option>
                                            <option value="LV">Latvia</option>
                                            <option value="LB">Lebanon</option>
                                            <option value="LS">Lesotho</option>
                                            <option value="LR">Liberia</option>
                                            <option value="LY">Libyan Arab Jamahiriya</option>
                                            <option value="LI">Liechtenstein</option>
                                            <option value="LT">Lithuania</option>
                                            <option value="LU">Luxembourg</option>
                                            <option value="MO">Macau</option>
                                            <option value="MK">Macedonia</option>
                                            <option value="MG">Madagascar (Malagasy)</option>
                                            <option value="MW">Malawi</option>
                                            <option value="MY">Malaysia</option>
                                            <option value="MV">Maldives</option>
                                            <option value="ML">Mali</option>
                                            <option value="MT">Malta</option>
                                            <option value="MH">Marshall Islands</option>
                                            <option value="MQ">Martinique</option>
                                            <option value="MR">Mauritania</option>
                                            <option value="MU">Mauritius</option>
                                            <option value="YT">Mayotte</option>
                                            <option value="MX">Mexico</option>
                                            <option value="FM">Micronesia</option>
                                            <option value="MD">Moldova Republic Of</option>
                                            <option value="MC">Monaco</option>
                                            <option value="MN">Mongolia</option>
                                            <option value="ME">Montenegro</option>
                                            <option value="MS">Montserrat</option>
                                            <option value="MA">Morocco</option>
                                            <option value="MZ">Mozambique</option>
                                            <option value="MM">Myanmar</option>
                                            <option value="NA">Namibia</option>
                                            <option value="NR">Nauru</option>
                                            <option value="NP">Nepal</option>
                                            <option value="NL">Netherlands</option>
                                            <option value="AN">Netherlands Antilles</option>
                                            <option value="NC">New Caledonia</option>
                                            <option value="NZ">New Zealand</option>
                                            <option value="NI">Nicaragua</option>
                                            <option value="NE">Niger</option>
                                            <option value="NG">Nigeria</option>
                                            <option value="NU">Niue</option>
                                            <option value="NF">Norfolk Island</option>
                                            <option value="MP">Northern Marianna Islands</option>
                                            <option value="NO">Norway</option>
                                            <option value="OM">Oman</option>
                                            <option value="PK">Pakistan</option>
                                            <option value="PW">Palau</option>
                                            <option value="PA">Panama</option>
                                            <option value="PG">Papua New Guinea</option>
                                            <option value="PY">Paraguay</option>
                                            <option value="PE">Peru</option>
                                            <option value="PH">Philippines</option>
                                            <option value="PN">Pitcairn</option>
                                            <option value="PL">Poland</option>
                                            <option value="PT">Portugal</option>
                                            <option value="PR">Puerto Rico</option>
                                            <option value="QA">Qatar</option>
                                            <option value="RE">Reunion</option>
                                            <option value="RO">Romania</option>
                                            <option value="RU">Russian Federation</option>
                                            <option value="RW">Rwanda</option>
                                            <option value="LC">Saint Lucia</option>
                                            <option value="VC">Saint Vincent And The Grenadines</option>
                                            <option value="AS">Samoa</option>
                                            <option value="WS">Samoa</option>
                                            <option value="SM">San Marino</option>
                                            <option value="ST">Sao Tome and Principe</option>
                                            <option value="SA">Saudi Arabia</option>
                                            <option value="SN">Senegal</option>
                                            <option value="RS">Serbia</option>
                                            <option value="CS">Serbia and Montenegro</option>
                                            <option value="SC">Seychelles</option>
                                            <option value="SL">Sierra Leone</option>
                                            <option value="SG">Singapore</option>
                                            <option value="SK">Slovakia</option>
                                            <option value="SI">Slovenia</option>
                                            <option value="SB">Solomon Islands</option>
                                            <option value="SO">Somalia</option>
                                            <option value="ZA">South Africa</option>
                                            <option value="GS">South Georgia And S Sandwich Island</option>
                                            <option value="SS">South Sudan</option>
                                            <option value="ES">Spain</option>
                                            <option value="LK">Sri Lanka</option>
                                            <option value="BL">St Barthelemy</option>
                                            <option value="SX">St Maarten</option>
                                            <option value="MF">St Martin</option>
                                            <option value="PM">St Pierre and Miquelon</option>
                                            <option value="KN">St. Kitts - Nevis</option>
                                            <option value="PS">State of Palestine</option>
                                            <option value="SD">Sudan</option>
                                            <option value="SR">Suriname</option>
                                            <option value="SJ">Svalbard And Jan Mayen Is</option>
                                            <option value="SZ">Swaziland</option>
                                            <option value="SE">Sweden</option>
                                            <option value="CH">Switzerland</option>
                                            <option value="SY">Syrian Arab Republic</option>
                                            <option value="TW">Taiwan</option>
                                            <option value="TJ">Tajikistan</option>
                                            <option value="TZ">Tanzania United Republic Of</option>
                                            <option value="TH">Thailand</option>
                                            <option value="TL">Timor Leste</option>
                                            <option value="TG">Togo</option>
                                            <option value="TK">Tokelau</option>
                                            <option value="TO">Tonga</option>
                                            <option value="TT">Trinidad and Tobago</option>
                                            <option value="TN">Tunisia</option>
                                            <option value="TR">Turkey</option>
                                            <option value="TM">Turkmenistan</option>
                                            <option value="TC">Turks And Caicos Islands</option>
                                            <option value="TV">Tuvalu</option>
                                            <option value="UG">Uganda</option>
                                            <option value="UA">Ukraine</option>
                                            <option value="AE">United Arab Emirates</option>
                                            <option value="GB">United Kingdom</option>
                                            <option value="US">United States</option>
                                            <option value="UM">United States Minor Outlying Islnds</option>
                                            <option value="UY">Uruguay</option>
                                            <option value="VI">Us Virgin Isalnds</option>
                                            <option value="UZ">Uzbekistan</option>
                                            <option value="VU">Vanuatu</option>
                                            <option value="VA">Vatican City State</option>
                                            <option value="VE">Venezuela</option>
                                            <option value="VN">Vietnam</option>
                                            <option value="WF">Wallis and Futuna Islands</option>
                                            <option value="EH">Western Sahara</option>
                                            <option value="YE">Yemen</option>
                                            <option value="ZM">Zambia</option>
                                            <option value="ZW">Zimbabwe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="ContactNumber">Contact Number</label>
                                        <input type="text"
                                            name="passenger[{{ $traveler->travelerId }}][contactNumber]"
                                            id="ContactNumber" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="Email">Email</label>
                                        <input type="email" name="passenger[{{ $traveler->travelerId }}][email]"
                                            id="Email" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                        </div>

                    @endforeach
                    {{-- End Form for adults --}}

                    <div class="form-group">
                        <button id="ps-submit" type="submit">Continue</button>
                    </div>

                </form>

            </div>
        </section>

        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-xs-8 col-sm-4 col-md-4">
                        <div class="footer-widget">
                            <h1>
                                Corporate Office
                            </h1>
                            <address>
                                <span><i class="glyphicon glyphicon-home"></i>
                                    Happy Arcade Shopping Mall, 2nd FLR, Suite 34, Holding 3 Rd No. 3, Dhaka 1205
                                </span>
                                <br />
                                <span><i class="glyphicon glyphicon-envelope"></i>
                                    support@zoo.family
                                </span>
                                <br />
                                <span><i class="glyphicon glyphicon-earphone"></i>
                                    +880197-7569292
                                </span>
                            </address>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-2 col-md-2">
                        <div class="footer-widget">
                            <h1> About Company</h1>
                            <ul>
                                <!-- <li><a target="_blank" href="http://www.zoo.family/">About us</a></li> -->
                                <li><a href=" http://localhost/b2b/about"> About us</a></li>
                                <li><a href=" http://localhost/b2b/contact"> Contact us</a></li>
                                <li><a href=" http://localhost/b2b/privacy-policy"> Privacy Policy</a></li>
                                <li><a href=" http://localhost/b2b/terms-conditions"> Terms &amp; Condition</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-2 col-md-2">
                        <div class="footer-widget">
                            <h1> Important Link</h1>
                            <ul>


                                <li><a href="https://zoo.family/bank-payments/">Bank &amp; Payments</a></li>


                                <li><a href="https://zoo.family/make-partnership-with-us/">Partnership with us</a></li>


                                <li><a href="https://zoo.family/group-request/">Group request</a></li>


                                <li><a href="https://zoo.family/solutions/">Our Solutions</a></li>
                            </ul>

                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-4">
                        <div class="footer-widget">
                            <div id="autho">
                                <h1> We are on social</h1>
                                <div id="social-img">

                                    <a style="padding:5px" href="https://www.facebook.com/ " target="_blank"><img
                                            style="max-height: 40px;"
                                            src="{{ asset('/front_asset/img/icon/fb.png') }}"
                                            class="img-responsive" /></a>


                                    <a style="padding:5px" href="https://www.linkedin.com/ " target="_blank"><img
                                            style="max-height: 40px;"
                                            src="{{ asset('/front_asset/img/icon/linkedin.png') }}"
                                            class="img-responsive" /></a>


                                    <a style="padding:5px" href="https://www.instagram.com/itszoofamily/ "
                                        target="_blank"><img style="max-height: 40px;"
                                            src="{{ asset('/front_asset/img/icon/instagram.png') }}"
                                            class="img-responsive" /></a>



                                    <a style="padding:5px" href="https://twitter.com/zoofamilia " target="_blank"><img
                                            style="max-height: 40px;"
                                            src="{{ asset('/front_asset/img/icon/twetter.png') }}"
                                            class="img-responsive" /></a>



                                </div>
                                <div id="autho-img">

                                    <a style="padding:5px"
                                        href="https://apps.apple.com/tt/app/b2b-travel-portal/id1550469568?ign-mpt=uo%3D2"
                                        target="_blank"><img style="max-height: 40px;"
                                            src="{{ asset('/front_asset/img/ios.png') }}"
                                            class="img-responsive" /></a>


                                    <a style="padding:5px"
                                        href="https://play.google.com/store/apps/details?id=com.zoofamily.mainb2bflightportal&amp;hl=en"
                                        target="_blank"><img style="max-height: 40px;"
                                            src="{{ asset('/front_asset/img/gplay.png') }}"
                                            class="img-responsive" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script type="text/javascript" src="{{ asset('/front_asset/js/jquery-3.5.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/front_asset/js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/front_asset/js/typeahead.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/front_asset/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/front_asset/js/lightslider.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/front_asset/js/event.js') }}"></script>

    <script>
        @if ($errors->any())
            alert(`{{ implode("\n", $errors->all()) }}`);
        @endif

        @foreach (old('passenger', []) as $key => $value)
        
            @foreach ($value as $name => $input)
        
                $("[name='passenger[{{ $key }}][{!! $name !!}]']").val('{!! $input !!}');
        
            @endforeach
        
        @endforeach

    </script>

</body>

</html>
