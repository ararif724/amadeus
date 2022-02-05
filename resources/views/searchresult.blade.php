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

                @foreach ($resp->data as $row)

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
                                                <img src="https://goprivate.wspan.com/sharedservices/images/airlineimages/logoAir{{ $itineraries->segments[0]->carrierCode }}.gif"
                                                    class="img-responsive"
                                                    alt="{{ $itineraries->segments[0]->carrierCode }}">
                                                <small>{{ $itineraries->segments[0]->carrierCode }}
                                                    ({{ $itineraries->segments[0]->number }})</small>
                                                <br>
                                                <small>Operated By:
                                                    {{ isset($resp->dictionaries->carriers->{$itineraries->segments[0]->carrierCode}) ? $resp->dictionaries->carriers->{$itineraries->segments[0]->carrierCode} : $itineraries->segments[0]->carrierCode }}
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
                                        <button type="button" class="price-details-btn"
                                            onclick="amadeusBook({{ $loop->index }});">Book Now</button>
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
                                                            <img src="https://goprivate.wspan.com/sharedservices/images/airlineimages/logoAir{{ $segments->carrierCode }}.gif"
                                                                class="img-responsive"
                                                                alt="{{ $segments->carrierCode }}">
                                                        </div>
                                                        <div>
                                                            <h3>{{ isset($resp->dictionaries->carriers->{$segments->carrierCode}) ? $resp->dictionaries->carriers->{$segments->carrierCode} : $segments->carrierCode }}
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
                                                            <h3>{{ $segments->carrierCode }}
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
        var amadeusResult = {!! json_encode($resp->data) !!};
        @if ($errors->any())
            alert(`{{ implode("\n", $errors->all()) }}`);
        @endif

        function amadeusBook(id) {

            form = $(
                    "<form method='post' action='{{ url('/store-flight') }}' target='_blank' style='display:none;'>")
                .append('@csrf')
                .append(($('<input name="data">').val(JSON.stringify(amadeusResult[id]))));
            $("body").append(form);
            form.submit();

        }

    </script>

</body>

</html>
