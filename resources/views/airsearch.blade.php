<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>B2B Travel Portal Bangladesh | zooFamily | Home</title>
    <link rel="icon" href="{{asset('/front_asset/img/logo.png')}}" type="image/gif">
    <link rel="stylesheet" href="{{asset('/front_asset/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{asset('/front_asset/css/lightslider.css')}}">
    <link rel="stylesheet" href="{{asset('/front_asset/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/front_asset/css/custom.css')}}">
</head>

<body>
    <div id="wrap">
        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="pull-left">
                            <div id="logo">
                                <a href="{{url('/')}}" title="">
                                    <img src="{{asset('/front_asset/img/60212eabb970e.png')}}" class="img-responsive"
                                        alt="Logo" style="width:55px;margin-top: 2px;">
                                </a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </header>
        <section id="home-banner">
            <div id="banner-radius"></div>
            <div id="search-engine">
                <div id="">

                    <div id="tab-output">
                        <div class="my-tab show_tab">
                            <div class="flights">
                                <ul class="tabs-trip">
                                    <li class="gatRadioActive"><input type="radio" name="trip" value="One Way"
                                            checked /> One Way</li>
                                    <li><input type="radio" name="trip" value="Round Trip" /> Round Trip</li>
                                    <li class=""><input type="radio" name="trip" value="Multi City" /> Multi City</li>
                                </ul>

                                <div id="tabs-trip-output">
                                    <div class="my-trip-tab show_tab">
                                        <form action="{{url('/flights-search')}}" method="post">
                                            @csrf
                                            <div class="search-box-one-round one-way">
                                                <div class="ow-first">
                                                    <span class="ow-place">From</span>
                                                    <input type="text" class="travel-input tv-from" name="travel_from"
                                                        id="ow-from" placeholder="City or Airport" autocomplete="off"
                                                        value="DAC" />
                                                    <img class="toggle-plane"
                                                        src="{{asset('/front_asset/img/toggle-plane.jpg')}}"
                                                        data-p=".ow" />
                                                </div>
                                                <div class="ow-second">
                                                    <span class="ow-place">To</span>
                                                    <input type="text" class="travel-input tv-to" name="travel_to"
                                                        id="ow-to" placeholder="City or Airport" autocomplete="off" />
                                                </div>
                                                <div class="ow-third">
                                                    <span class="ow-place">Depart</span>
                                                    <input type="text" name="from_date" class="date-input" id="ow-dep"
                                                        placeholder="Wednesday, 03 March, 2021" autocomplete="off" />
                                                </div>
                                                <div class="ow-forth hidden">
                                                    <span class="ow-place">Return</span>
                                                    <input type="text" name="to_date" class="date-input" id="rw-ret"
                                                        placeholder="Saturday, 13 March, 2021" autocomplete="off" />
                                                </div>
                                                <div>
                                                    <span class="ow-place">Passenger & Classes</span>
                                                    <input type="text" name="" id="ow-pass-class"
                                                        placeholder="1 Adult Any" />
                                                    <div id="ow-travel-passenger-list" class="pass-list-p hidden">
                                                        <div class="ow-adult-qty">
                                                            <div class="ow-per-title">
                                                                <h3>Adult</h3>
                                                            </div>
                                                            <div class="ow-per-inc qtySelector">
                                                                <i class="glyphicon glyphicon-minus decreaseQty"></i>
                                                                <input type="text" value="1" size="1" name="adults"
                                                                    maxlength="9" class="qtyValue adult">
                                                                <i class="glyphicon glyphicon-plus increaseQty"></i>
                                                            </div>
                                                        </div>

                                                        <div class="ow-adult-qty">
                                                            <div class="ow-per-title">
                                                                <h3>Children</h3>
                                                            </div>
                                                            <div class="ow-per-inc qtySelector">
                                                                <i class="glyphicon glyphicon-minus decreaseQty"></i>
                                                                <input type="text" value="0" size="1" name="childrens"
                                                                    maxlength="9" class="qtyValue child">
                                                                <i class="glyphicon glyphicon-plus increaseQty"></i>
                                                            </div>
                                                        </div>

                                                        <div class="ow-adult-qty">
                                                            <div class="ow-per-title">
                                                                <h3>Infants</h3>
                                                            </div>
                                                            <div class="ow-per-inc qtySelector">
                                                                <i class="glyphicon glyphicon-minus decreaseQty"></i>
                                                                <input type="text" value="0" size="1" name="infants"
                                                                    maxlength="9" class="qtyValue infant">
                                                                <i class="glyphicon glyphicon-plus increaseQty"></i>
                                                            </div>
                                                        </div>

                                                        <div class="ow-grade-type">
                                                            <h3>Class</h3>
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="seat_class"
                                                                        id="any_class" value="Any" checked>
                                                                    Any
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="seat_class"
                                                                        id="economy_class" value="Economy">
                                                                    Economy
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="seat_class"
                                                                        id="business_class" value="Business"> Business
                                                                </label>
                                                            </div>
                                                            <div class="radio disabled">
                                                                <label>
                                                                    <input type="radio" name="seat_class"
                                                                        id="first_class" value="First"> First
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <span class="qty-box-remove">Done</span>
                                                    </div>

                                                    <button class="search-flight-btn" type="submit"><i
                                                            class="glyphicon glyphicon-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="my-trip-tab">
                                        <form action="{{url('/multi-search')}}" method="post">
                                            @csrf
                                            <div class="multi-city">
                                                <div id="multy-left">
                                                    <div class="ml-way ml-city-form">
                                                        <div class="ml-first">
                                                            <span class="ml-place">From</span>
                                                            <input type="text" class="travel-input tv-from"
                                                                name="travel_from[]" id="ml-from"
                                                                placeholder="City or Airport" autocomplete="off"
                                                                value="DAC" />
                                                            <img class="toggle-plane"
                                                                src="{{asset('/front_asset/img/toggle-plane.jpg')}}"
                                                                data-p=".ml" />
                                                        </div>
                                                        <div class="ml-second">
                                                            <span class="ml-place">To</span>
                                                            <input type="text" class="travel-input tv-to"
                                                                name="travel_to[]" id="ml-to"
                                                                placeholder="City or Airport" autocomplete="off" />
                                                        </div>
                                                        <div>
                                                            <span class="ml-place">Depart</span>
                                                            <input type="text" name="from_date[]" class="ml-dep"
                                                                id="ml-dep" placeholder="Wednesday, 03 March, 2021"
                                                                autocomplete="off" />
                                                        </div>
                                                    </div>
                                                    <div class="clone-ml-way"></div>
                                                </div>
                                                <div id="multy-right">
                                                    <div id="multy-right-div">
                                                        <span class="ml-place">Passenger & Classes</span>
                                                        <input type="text" name="" id="ml-pass-class"
                                                            placeholder="1 Adult Economy" />

                                                        <div id="ml-travel-passenger-list" class="pass-list-p hidden">
                                                            <div class="ml-adult-qty">
                                                                <div class="ml-per-title">
                                                                    <h3>Adult</h3>
                                                                </div>
                                                                <div class="ml-per-inc qtySelector">
                                                                    <i
                                                                        class="glyphicon glyphicon-minus decreaseQty"></i>
                                                                    <input type="text" value="1" size="1" name="adults"
                                                                        maxlength="9" class="qtyValue adult">
                                                                    <i class="glyphicon glyphicon-plus increaseQty"></i>
                                                                </div>
                                                            </div>

                                                            <div class="ml-adult-qty">
                                                                <div class="ml-per-title">
                                                                    <h3>Children</h3>
                                                                </div>
                                                                <div class="ml-per-inc qtySelector">
                                                                    <i
                                                                        class="glyphicon glyphicon-minus decreaseQty"></i>
                                                                    <input type="text" value="0" size="1"
                                                                        name="childrens" maxlength="9"
                                                                        class="qtyValue child">
                                                                    <i class="glyphicon glyphicon-plus increaseQty"></i>
                                                                </div>
                                                            </div>

                                                            <div class="ml-adult-qty">
                                                                <div class="ml-per-title">
                                                                    <h3>Infants</h3>
                                                                </div>
                                                                <div class="ml-per-inc qtySelector">
                                                                    <i
                                                                        class="glyphicon glyphicon-minus decreaseQty"></i>
                                                                    <input type="text" value="0" size="1" name="infants"
                                                                        maxlength="9" class="qtyValue infant">
                                                                    <i class="glyphicon glyphicon-plus increaseQty"></i>
                                                                </div>
                                                            </div>

                                                            <div class="ml-grade-type">
                                                                <h3>Class</h3>
                                                                <div class="radio">
                                                                    <label>
                                                                        <input type="radio" name="seat_class"
                                                                            id="economy_class" value="Economy" checked>
                                                                        Economy
                                                                    </label>
                                                                </div>
                                                                <div class="radio">
                                                                    <label>
                                                                        <input type="radio" name="seat_class"
                                                                            id="business_class" value="Business">
                                                                        Business
                                                                    </label>
                                                                </div>
                                                                <div class="radio disabled">
                                                                    <label>
                                                                        <input type="radio" name="seat_class"
                                                                            id="first_class" value="First"> First
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <span class="qty-box-remove">Done</span>
                                                        </div>
                                                    </div>

                                                    <button type="button" id="btn-ml-add-city"><i
                                                            class="glyphicon glyphicon-plus"></i> Add City
                                                    </button>
                                                    <button type="submit" class="search-flight-btn"
                                                        id="btn-ml-search"><i class="glyphicon glyphicon-search"></i>
                                                        Search Flight
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="my-tab dont_show_tab">-->
                        <!--    <div class="import-pnr">-->

                        <!--        <form action="https://b2b.zoo.family/share-pnr" method="post">-->
                        <!--            <input type="hidden" name="_token" value="xu0LFKJHy2Srb889mHZPmwhjIUFBtm3YLk37ofkI">-->
                        <!--            <div class="pnr">-->
                        <!--                <div class="pnr-first">-->
                        <!--                    <span class="pnr-place">Provider</span>-->
                        <!--                    <select name="provider">-->
                        <!--                        <option value="Galilio">Galilio</option>-->
                        <!--                    </select>-->
                        <!--                    -->
                        <!--                </div>-->
                        <!--                <div class="pnr-second">-->
                        <!--                    <span class="pnr-place">PNR</span>-->
                        <!--                    <input type="text" name="pnr" id="" placeholder="PNR" />-->
                        <!--                    -->
                        <!--                </div>-->
                        <!--                <div class="pnr-third">-->
                        <!--                    <span class="pnr-place">Agency ID</span>-->
                        <!--                    <input type="text" name="agency_id" id="" placeholder="Agency ID" />-->
                        <!--                    -->
                        <!--                </div>-->
                        <!--                <div>-->
                        <!--                    <span class="pnr-place">Queue Number</span>-->
                        <!--                    <input type="text" name="queue_number" id="" placeholder="Queue Number" />-->
                        <!--                    -->
                        <!--                    <button type="submit"><i class="glyphicon glyphicon-search"></i></button>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </form>-->

                        <!--    </div>-->
                        <!--</div>-->
                        <div class="my-tab">
                            <div class="launch">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">

                    <div class="col-sm-4">
                        <div class="features-widget">
                            <i class="glyphicon glyphicon-bookmark"></i>
                            <h3>Competitive Pricing</h3>
                            <div class="fetre-txt">
                                <p>“zooFamily” is a community of Aviation and Travel Industries which working with the
                                    Global B2B Travel market place. We provide FREE Flight API, Hotel API, Holiday API
                                    for Travel agents.</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-4">
                        <div class="features-widget">
                            <i class="glyphicon glyphicon-gift"></i>
                            <h3>Award Winning Service</h3>
                            <div class="fetre-txt">
                                <p>We ensure to provide better services in a short time frame, which makes a difference
                                    to other travel agents. And we won several awards for our global standard services.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="features-widget">
                            <i class="glyphicon glyphicon-globe"></i>
                            <h3>Wordwide Coverage</h3>
                            <div class="fetre-txt">
                                <p>Since 2012 our team working with “Travel Technology” &amp; “Travel Inventory”. We not
                                    only grow tourism activities but also we have taken the challenge to develop the
                                    travel &amp; aviation industry.</p>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>



        <div class="devider-cls">
            <hr />
        </div>

        <div class="container" style="margin-bottom: 50px;">
            <h3 id="top-deal-title">Todays Top Deals</h3>
            <div class="row deal-slider">
                <div class="col-sm-4 pack-p ">
                    <div class="">
                        <img class="img-responsive" src="{{asset('/front_asset/img/packages/5fa45fd6274c3.jpg')}}" />
                    </div>
                </div>
                <div class="col-sm-4 pack-p ">
                    <div class="">
                        <img class="img-responsive" src="{{asset('/front_asset/img/packages/5f630dc387ec9.jpg')}}" />
                    </div>
                </div>
                <div class="col-sm-4 pack-p ">
                    <div class="">
                        <img class="img-responsive" src="{{asset('/front_asset/img/packages/5f630da8d9f60.jpg')}}" />
                    </div>
                </div>
                <div class="col-sm-4 pack-p hidden">
                    <div class="">
                        <img class="img-responsive" src="{{asset('/front_asset/img/packages/5f630d70dbca1.jpg')}}" />
                    </div>
                </div>
                <div class="col-sm-4 pack-p hidden">
                    <div class="">
                        <img class="img-responsive" src="{{asset('/front_asset/img/packages/5e8afc1fdd3d8.jpg')}}" />
                    </div>
                </div>
                <div class="col-sm-4 pack-p hidden">
                    <div class="">
                        <img class="img-responsive" src="{{asset('/front_asset/img/packages/5e8afc01b49a7.jpg')}}" />
                    </div>
                </div>
                <div class="col-sm-4 pack-p hidden">
                    <div class="">
                        <img class="img-responsive" src="{{asset('/front_asset/img/packages/5e8af920b337e.jpg')}}" />
                    </div>
                </div>
                <div class="col-sm-4 pack-p hidden">
                    <div class="">
                        <img class="img-responsive" src="{{asset('/front_asset/img/packages/5e8af64541f93.jpg')}}" />
                    </div>
                </div>
                <div class="col-sm-4 pack-p hidden">
                    <div class="">
                        <img class="img-responsive" src="{{asset('/front_asset/img/packages/5e8af637d2e72.jpg')}}" />
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="subs_mem">
                        <div class="subs_mem_icon">
                            <i class="glyphicon glyphicon-user"></i>
                        </div>
                        <div class="subs_mem_con">
                            <h3>Not a member yet</h3>
                            <p>By &quot;zooFamily&quot;, a person can develop his/her career in the aviation and travel
                                industry. Travel Agents get the best deal for Cheap Air Tickets - Hotels - Holiday
                                Packages.</p>
                            <a class="btn btn-default" href="https://b2b.zoo.family/register">Register</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="subs_mem">
                        <div class="subs_mem_icon">
                            <i class="glyphicon glyphicon-envelope"></i>
                        </div>
                        <div class="subs_mem_con" id="subs-section">
                            <h3>Subscribe for secret deal</h3>
                            <p>our organizers are few travel agents and zooIT Information Technolgy Company and
                                “zooFamily” is a NON-Profitable B2B Travel Business Module.</p>
                            <input type="email" name="email" id="email-text-field" placeholder="Email" /> &nbsp;<a
                                class="sgpr" href="#">Sign In</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="searchModal" class="modal fade" role="dialog" style="margin-top: 10%">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <!--<img class="img-responsive" src="https://b2b.zoo.family/public/front_asset/img/500.500"/>-->
                        <img class="img-responsive" src="{{asset('/front_asset/img/search.gif')}}" />
                    </div>
                </div>
            </div>
        </div>
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
                                            style="max-height: 40px;" src="{{asset('/front_asset/img/icon/fb.png')}}"
                                            class="img-responsive" /></a>


                                    <a style="padding:5px" href="https://www.linkedin.com/ " target="_blank"><img
                                            style="max-height: 40px;"
                                            src="{{asset('/front_asset/img/icon/linkedin.png')}}"
                                            class="img-responsive" /></a>


                                    <a style="padding:5px" href="https://www.instagram.com/itszoofamily/ "
                                        target="_blank"><img style="max-height: 40px;"
                                            src="{{asset('/front_asset/img/icon/instagram.png')}}"
                                            class="img-responsive" /></a>



                                    <a style="padding:5px" href="https://twitter.com/zoofamilia " target="_blank"><img
                                            style="max-height: 40px;"
                                            src="{{asset('/front_asset/img/icon/twetter.png')}}"
                                            class="img-responsive" /></a>



                                </div>
                                <div id="autho-img">

                                    <a style="padding:5px"
                                        href="https://apps.apple.com/tt/app/b2b-travel-portal/id1550469568?ign-mpt=uo%3D2"
                                        target="_blank"><img style="max-height: 40px;"
                                            src="{{asset('/front_asset/img/ios.png')}}" class="img-responsive" /></a>


                                    <a style="padding:5px"
                                        href="https://play.google.com/store/apps/details?id=com.zoofamily.mainb2bflightportal&amp;hl=en"
                                        target="_blank"><img style="max-height: 40px;"
                                            src="{{asset('/front_asset/img/gplay.png')}}" class="img-responsive" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        homePage = true;
    </script>

    <script type="text/javascript" src="{{asset('/front_asset/js/jquery-3.5.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/front_asset/js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/front_asset/js/typeahead.bundle.js')}}"></script>
    <script type="text/javascript" src="{{asset('/front_asset/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/front_asset/js/lightslider.js')}}"></script>
    <script type="text/javascript" src="{{asset('/front_asset/js/event.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('.nav-c').css('display', 'block');
            $('#ui-datepicker-div').css('display', 'none');
            $('.pack-p').removeClass('hidden');
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });

        @if($errors -> any())
            alert(`{{implode("\n", $errors -> all())}}`);
        @endif

    </script>
</body>

</html>
