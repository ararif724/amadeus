const tabItems = document.querySelectorAll('.tab-item');
const tabContentItems = document.querySelectorAll('.tab-content-item');

// Select tab content item
function selectItem(e) {
    // Remove all show and border classes
    removeBorder();
    removeShow();
    // Add border to current tab item
    this.classList.add('tab-background');
    this.classList.add('tab-background-result');
    // Grab content item from DOM
    const tabContentItem = document.querySelector(`#${this.id}-content`);
    // Add show class
    tabContentItem.classList.add('show');
}

// Remove bottom borders from all tab items
function removeBorder() {
    tabItems.forEach(item => {
        item.classList.remove('tab-background');
        item.classList.remove('tab-background-result');
    });
}

// Remove show class from all content items
function removeShow() {
    tabContentItems.forEach(item => {
        item.classList.remove('show');
    });
}

// Listen for tab item click
tabItems.forEach(item => {
    item.addEventListener('click', selectItem);
});


/* my jQuery */

$(document).ready(function () {
    var inputData;
    var dateToday = new Date();

    if (windowsize <= 500) {
        $('.date-input').datepicker({
            dateFormat: "yy-mm-dd",
            numberOfMonths: 1,
            duration: "fast",
            minDate: dateToday
        });
    } else {
        $('.date-input').datepicker({
            dateFormat: "yy-mm-dd",
            numberOfMonths: 2,
            duration: "fast",
            minDate: dateToday,
            // beforeShow: function (input, inst) {
            //     var rect = input.getBoundingClientRect();
            //     setTimeout(function () {
        	   //     inst.dpDiv.css({ top: rect.top + 40, left: rect.left + 0 });
            //     }, 0);
            // }
        });
    }


    $(document).on('focus', '.ml-dep', function () {
        if (windowsize <= 500) {
            $(this).datepicker({
                dateFormat: "yy-mm-dd",
                numberOfMonths: 1,
                duration: "fast",
                minDate: dateToday
            });
        } else {
            $(this).datepicker({
                dateFormat: "yy-mm-dd",
                numberOfMonths: 2,
                duration: "fast",
                minDate: dateToday
            });
        }
    });

    $("#ow-pass-class").click(function () {
        $("#ow-travel-passenger-list").css('display', 'block');
    });

    $("#rw-pass-class").click(function () {
        $("#rw-travel-passenger-list").css('display', 'block');
    });

    $("#ml-pass-class").click(function () {
        $("#ml-travel-passenger-list").css('display', 'block');
    });


    $(".qty-box-remove").click(function () {
        $("#ow-travel-passenger-list").addClass('hidden');
        $("#ml-travel-passenger-list").addClass('hidden');
    });

    $('#btn-ml-add-city').click(function () {
        var lengthMCity = $('.clone-ml-way').find('.ml-city-form').length;
        if (lengthMCity <= 3) {
            var markup = $('.ml-city-form:eq(0)').clone().css('margin-top', '5px');
            markup.find('input').val('').removeAttr('id');
            markup.find('.ml-dep').removeClass('hasDatepicker');
            markup.append('<span class="ml-city-delete" />');
            $('.clone-ml-way').append(markup);
            if (lengthMCity > 2) {
                $(this).attr('class', 'hidden');
            }
        } else {
            $(this).attr('class', 'hidden');
        }
    });

    $(document).on('click', '.ml-city-delete', function () {
        if ($(this).parents('.ml-city-form').length) {
            var lengthMCity = $('.clone-ml-way').find('.ml-city-form').length;
            $(this).parents('.ml-city-form').remove();
            if (lengthMCity <= 4) {
                $('#btn-ml-add-city').removeClass('hidden');
            }
        } else if ($(this).parents('.ml-city-form').length) {
            var lengthMCity = $('.clone-ml-way').find('.ml-city-form').length;
            $(this).parents('.ml-city-form').remove();
            if (lengthMCity <= 4) {
                $('#multi-city-add-result').removeClass('hidden');
            }
        }

        return false;
    });


    $('.my-tab:first').show();
    $('.tab-nav li').click(function (event) {
        index = $(this).index();
        $('.tab-nav li').removeClass('getMenuActive');
        $(this).addClass('getMenuActive');

        $('.my-tab').removeClass('show_tab').addClass('dont_show_tab');
        $('.my-tab').eq(index).removeClass('dont_show_tab').addClass('show_tab');
    });

    $('.my-trip-tab:first').show();
    $('.tabs-trip li:first').addClass('gatRadioActive').attr('checked');
    $('input:radio[name="trip"]').filter('[value="One Way"]').attr('checked', true);

    $('.tabs-trip li').click(function (event) {
        var tripType = $(this).find('input[name="trip"]').val();
        $('.tabs-trip li').removeClass('gatRadioActive');
        $(this).addClass('gatRadioActive');
        $('.my-trip-tab').hide();
        if (tripType == 'Multi City') {
            $('.my-trip-tab').eq(0).removeClass('show_tab');
            $('.my-trip-tab').eq(1).addClass('show_tab');
        } else {
            $('.my-trip-tab').eq(1).removeClass('show_tab');
            $('.my-trip-tab').eq(0).addClass('show_tab');
        }
        $(this).find('input[name="trip"]').prop('checked', true);
        if (tripType == 'Round Trip') {
            $('.search-box-one-round').removeClass('one-way').addClass('round-way');
            $('.round-way').find('.ow-forth').removeClass('hidden');
        } else {
            $('.search-box-one-round').removeClass('round-way').addClass('one-way');
            $('.one-way').find('.ow-forth').addClass('hidden');
        }
    });

    $(document).on('click', '.toggle-plane', function () {
        var dataP = $(this).data('p');
        var from = $(this).siblings('.tv-from').val();
        var to = $(this).parents(dataP+'-first').siblings(dataP+'-second').find('.tv-to').val();
        $(this).siblings('.tv-from').val(to);
        $(this).parents(dataP+'-first').siblings(dataP+'-second').find('.tv-to').val(from);
    });

    /**
     * Call airport data only when in index page
     */
    if(typeof(homePage) !== 'undefined'){
        $.ajax({
            url: "airports",
            type: "get"
        }).done(function (res) {
            $('.travel-input').typeahead({
                source: res,
                updater: function (item) {
                    var fullData = item.split(" ");
                    return fullData[0];
                }
            });
            inputData = res;
        }).fail(function (xhr) {
            }
        )
    }

    $(document).on('click', '.tab-one-way', function () {

        $('.return-to').addClass('hidden');
        $('.round-one-form').addClass('one-way-form').removeClass('round-way-form');
    });

    $(document).on('click', '.tab-round-trip', function () {
        $('.return-to').removeClass('hidden');
        $('.round-one-form').addClass('round-way-form').removeClass('one-way-form ');


    });

    $(document).on('click', '.tab-one-way-res', function () {
        $('.return-to-result').addClass('hidden');
        $('.round-one-form-result').addClass('one-way-form-result').removeClass('round-way-form-result');
    });
    $(document).on('click', '.tab-round-trip-res', function () {
        $('.return-to-result').removeClass('hidden');
        $('.round-one-form-result').addClass('round-way-form-result').removeClass('one-way-form-result');


    });

    $('#toggle_search').click(function () {
        $('#mob-search-res').slideToggle();
        $(this).find('i').toggleClass("glyphicon-chevron-up glyphicon-chevron-down");
    });

    var windowsize = $(window).width();


    $(document).on('focus', '.travel-input', function () {
        $('.travel-input').typeahead('destroy');
        $('.travel-input').typeahead({
            source: inputData,
            updater: function (item) {
                var fullData = item.split(" ");
                return fullData[0];
            }
        });
    })

    var dateToday = new Date();

    $("#round-way-travel-passenger-seat").click(function () {
        $("#round-way-travel-passenger-list").css('display', 'block');
        $("#round-way-travel-passenger-list-result").css('display', 'block');
    });

    $(document).on('click', '.qty-box-remove', function () {
        $("#round-way-travel-passenger-list").css('display', 'none');
        $("#round-way-travel-passenger-list-result").css('display', 'none');
    });

    var minVal = 1;
    var maxVal = 9; // Set Max and Min values

    // Increase product quantity on cart page
    $(".increaseQty").on('click', function () {
        var $parentElm = $(this).parents(".qtySelector");
        $(this).addClass("clicked");
        setTimeout(function () {
            $(".clicked").removeClass("clicked");
        }, 100);
        var value = $parentElm.find(".qtyValue").val();
        if (value < maxVal) {
            value++;
        }
        $parentElm.find(".qtyValue").val(value);
        var seat_class = $('input[name="seat_class"]:checked').val();

        var totalPass = 0;
        $(this).parents('.pass-list-p').find('.qtyValue').each(function (index, item) {
            var intItem = parseInt($(item).val());
            totalPass += intItem;
        });
        var strVal = totalPass + (totalPass > 1 ? ' Passengers, ' : ' Passenger, ') + seat_class;
        $(this).parents('.pass-list-p').siblings('input').attr('placeholder', strVal);
    });

    // Decrease product quantity on cart page
    $(".decreaseQty").on('click', function () {
        var $parentElm = $(this).parents(".qtySelector");
        $(this).addClass("clicked");
        setTimeout(function () {
            $(".clicked").removeClass("clicked");
        }, 100);
        var value = $parentElm.find(".qtyValue").val();
        if ($(this).siblings('input').hasClass('adult')) {
            if (value > 1) {
                value--;
            }
        } else {
            if (value >= 1) {
                value--;
            }
        }

        $parentElm.find(".qtyValue").val(value);
        var seat_class = $('input[name="seat_class"]:checked').val();
        var totalPass = 0;
        $(this).parents('.pass-list-p').find('.qtyValue').each(function (index, item) {
            var intItem = parseInt($(item).val());
            totalPass += intItem;
        });
        var strVal = totalPass + (totalPass > 1 ? ' Passengers, ' : ' Passenger, ') + seat_class;
        $(this).parents('.pass-list-p').siblings('input').attr('placeholder', strVal);
    });

    $(document).on('change', 'input[name="seat_class"]', function () {
        var seat_class = $('input[name="seat_class"]:checked').val();
        var totalPass = 0;
        $(this).parents('.pass-list-p').find('.qtyValue').each(function (index, item) {
            var intItem = parseInt($(item).val());
            totalPass += intItem;
        });
        var strVal = totalPass + (totalPass > 1 ? ' Passengers, ' : ' Passenger, ') + seat_class;
        $(this).parents('.pass-list-p').siblings('input').attr('placeholder', strVal);

    });

    $("#one-way-travel-passenger-seat").click(function () {
        $("#one-way-travel-passenger-list").css('display', 'block');
        $("#one-way-travel-passenger-list-result").css('display', 'block');
    });

    $(".qty-box-remove").click(function () {
        $("#one-way-travel-passenger-list").css('display', 'none');
        $("#one-way-travel-passenger-list-result").css('display', 'none');
    });

    $(document).on('focus', '.multi-city-travel-dep-date', function () {
        if (windowsize <= 500) {
            $(this).datepicker({
                dateFormat: "yy-mm-dd",
                numberOfMonths: 1,
                duration: "fast",
                minDate: dateToday
            });
        } else {
            $(this).datepicker({
                dateFormat: "yy-mm-dd",
                numberOfMonths: 2,
                duration: "fast",
                minDate: dateToday
            });
        }
    });


    $("#multi-city-travel-passenger-seat").click(function () {
        $("#multi-city-travel-passenger-list").css('display', 'block');
    });

    $(".qty-box-remove").click(function () {
        $("#multi-city-travel-passenger-list").css('display', 'none');
    });


    $('#multi-city-add').click(function () {
        var lengthMCity = $('.clone-multiple-city-form').find('.multiple-city-form').length;
        if (lengthMCity <= 3) {
            var markup = $('.multiple-city-form:eq(0)').clone();
            markup.find('input').val('').removeAttr('id');
            markup.find('.multi-city-travel-dep-date').removeClass('hasDatepicker');
            markup.append('<span class="multiple-city-delete" />');
            $('.clone-multiple-city-form').append(markup);
            if (lengthMCity > 2) {
                $(this).attr('class', 'hidden');
            }
        } else {
            $(this).attr('class', 'hidden');
        }

    });
    $('#multi-city-add-result').click(function () {
        var lengthMCity = $('.clone-multiple-city-form').find('.multiple-city-form-result').length;
        if (lengthMCity <= 3) {
            var markup = $('.multiple-city-form-result:eq(0)').clone();
            markup.find('input').val('').removeAttr('id');
            markup.find('.multi-city-travel-dep-date').removeClass('hasDatepicker');
            markup.append('<span class="multiple-city-delete" />');
            $('.clone-multiple-city-form').append(markup);
            if (lengthMCity > 2) {
                $(this).attr('class', 'hidden');
            }
        } else {
            $(this).attr('class', 'hidden');
        }
    });


    $(document).on('click', '.multiple-city-delete', function () {
        if ($(this).parents('.multiple-city-form').length) {
            var lengthMCity = $('.clone-multiple-city-form').find('.multiple-city-form').length;
            $(this).parents('.multiple-city-form').remove();
            if (lengthMCity <= 4) {
                $('#multi-city-add').removeClass('hidden');
            }
        } else if ($(this).parents('.multiple-city-form-result').length) {
            var lengthMCity = $('.clone-multiple-city-form').find('.multiple-city-form-result').length;
            $(this).parents('.multiple-city-form-result').remove();
            if (lengthMCity <= 4) {
                $('#multi-city-add-result').removeClass('hidden');
            }
        }

        return false;
    });

    $('#res-menu').click(function () {
        $('#menu').toggle();
    });


    $('.slide-detail').click(function () {
        $(this).parents('.search-detail-link').siblings('.flight-details').toggle();
        $(this).parents('.search-detail-link').toggleClass('search-detail-bg');
        $(this).find('i').toggleClass("glyphicon glyphicon-menu-up glyphicon glyphicon-menu-down");
        return false;
    });

    $(document).on('click', '.fd-tabs', function () {
        $(this).addClass('mytabActive');
        $(this).parents('li').siblings('li').find('.fd-tabs').removeClass('mytabActive');
    });

    //Filter search
    $(document).on('change', '.stop-check, .class-check, .cabin-check', function () {
        if (($('.stop-check:checked').length == 0 && $('.class-check:checked').length == 0 && $('.cabin-check:checked').length == 0) || ($('.stop-check:checked').length == $('.stop-check').length && $('.class-check:checked').length == $('.class-check').length && $('.cabin-check:checked').length == $('.cabin-check').length)) {
            $('.search-list').removeClass('hidden');
        } else {
            var stopVal = [];
            var classVal = [];
            var cabinVal = [];

            $(".stop-check:checked").each(function (k, v) {
                stopVal.push($(v).val());
            });

            $(".class-check:checked").each(function (q, r) {
                classVal.push($(r).val());
            });

            $(".cabin-check:checked").each(function (s, t) {
                cabinVal.push($(t).val());
            });

            $('.search-list').each(function (sk, sv) {
                var airStopage = $(sv).find('.one-round-multi-city').data('stopage');
                var airClass = $(sv).find('.one-round-multi-city').data('carrier');
                var airCabin = $(sv).find('.one-round-multi-city').data('cabin');
                if (stopVal.length > 0 && classVal.length > 0 && cabinVal.length > 0) {
                    if (stopVal.includes(airStopage) && classVal.includes(airClass) && cabinVal.includes(airCabin)) {
                        $(sv).removeClass('hidden');
                    } else {
                        $(sv).addClass('hidden');
                    }
                } else if (stopVal.length == 0 && classVal.length > 0 && cabinVal.length > 0) {
                    if (classVal.includes(airClass) && cabinVal.includes(airCabin)) {
                        $(sv).removeClass('hidden');
                    } else {
                        $(sv).addClass('hidden');
                    }
                } else if (stopVal.length > 0 && classVal.length > 0 && cabinVal.length == 0) {
                    if (stopVal.includes(airStopage) && classVal.includes(airClass)) {
                        $(sv).removeClass('hidden');
                    } else {
                        $(sv).addClass('hidden');
                    }
                } else if (stopVal.length > 0 && classVal.length == 0 && cabinVal.length > 0) {
                    if (stopVal.includes(airStopage) && cabinVal.includes(airCabin)) {
                        $(sv).removeClass('hidden');
                    } else {
                        $(sv).addClass('hidden');
                    }
                } else if (stopVal.length > 0 && classVal.length == 0 && cabinVal.length == 0) {
                    if (stopVal.includes(airStopage)) {
                        $(sv).removeClass('hidden');
                    } else {
                        $(sv).addClass('hidden');
                    }
                } else if (stopVal.length == 0 && classVal.length > 0 && cabinVal.length == 0) {
                    if (classVal.includes(airClass)) {
                        $(sv).removeClass('hidden');
                    } else {
                        $(sv).addClass('hidden');
                    }
                } else if (stopVal.length == 0 && classVal.length == 0 && cabinVal.length > 0) {
                    if (cabinVal.includes(airCabin)) {
                        $(sv).removeClass('hidden');
                    } else {
                        $(sv).addClass('hidden');
                    }
                }
            });
        }
    });

    $(document).on('click', '.search-flight-btn', function () {
        $('#searchModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });

    $('.bii').mouseenter(function () {
        $(this).siblings('.booking-info-data').css('display', 'block');
        return false;
    });
    $('.bii').mouseleave(function () {
        $(this).siblings('.booking-info-data').css('display', 'none');
        return false;
    });

    $('.deal-slider').lightSlider({
        item: 3,
        auto: true,
        loop: true,
        pauseOnHover: true,
    });

    $('body').click(function(evt){
        if(evt.target.id == "tacc" && $('#acc-Drop').hasClass('hidden')){
            $('#acc-Drop').removeClass("hidden");
        }else if(evt.target.id != "acc-Drop" && !$(evt.target).parents('#acc-Drop').hasClass('acc-Drop')){
            $('#acc-Drop').addClass("hidden");
        }

        if(evt.target.id == "ow-pass-class" && $('#ow-travel-passenger-list').hasClass('hidden')){
            $('#ow-travel-passenger-list').removeClass("hidden");
        }else if(evt.target.id != "ow-travel-passenger-list" && !$(evt.target).parents('#ow-travel-passenger-list').hasClass('pass-list-p')){
            $('#ow-travel-passenger-list').addClass("hidden");
        }

        if(evt.target.id == "ml-pass-class" && $('#ml-travel-passenger-list').hasClass('hidden')){
            $('#ml-travel-passenger-list').removeClass("hidden");
        }else if(evt.target.id != "ml-travel-passenger-list" && !$(evt.target).parents('#ml-travel-passenger-list').hasClass('pass-list-p')){
            $('#ml-travel-passenger-list').addClass("hidden");
        }
    });
    
    var pathname = window.location;
    if(pathname == "http://gdslogin.com/"){
        //$('#ui-datepicker-div').css('top', '409px !important');
        //$('#ui-datepicker-div').attr('style', 'top: 409px !important');
    }
});
