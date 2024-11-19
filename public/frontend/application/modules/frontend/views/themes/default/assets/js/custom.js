$(document).ready(function () {
    'use strict';
    var segment1 = $("#segment1").val();

    //navbar add remove calss
    var header = $(".fixed-top");
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 1) {
            header.removeClass('navbar-transfarent').addClass("navbar-bg");
        } else {
            header.removeClass("navbar-bg").addClass('navbar-transfarent');
        }
    });

    $(window).on("load", function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 1) {
            header.removeClass('navbar-transfarent').addClass("navbar-bg");
        } else {
            header.removeClass("navbar-bg").addClass('navbar-transfarent');
        }
    });
    //Back to top button
    //Get the button
    if (segment1 != '') {
        let mybutton = document.getElementById("btn-back-to-top");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
            scrollFunction();
        };

        function scrollFunction() {
            if (
                document.body.scrollTop > 20 ||
                document.documentElement.scrollTop > 20
            ) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
        // When the user clicks on the button, scroll to the top of the document
        mybutton.addEventListener("click", backToTop);

        function backToTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    }

    //Background Image
    $(".bg-img").css("backgroundImage", function () {
        var bg = "url(" + $(this).data("image-src") + ")";
        return bg;
    });

    //Counter
    // $('.counter').counterUp({
    //     delay: 1,
    //     time: 500,
    // });

    //Testimonial carousel
    // console.log($('.testimonial-carousel'));






    //Quiz Form Check Input
    $('.quiz-form-check-input').on('click', function () {
        $('.quiz-overlay').toggleClass('current');
        $("html, body").animate({
            scrollTop: 0
        }, 0);
    });

    //Notifation Scroll
    $('.notifications-scroll').each(function () {
        const ps = new PerfectScrollbar($(this)[0]);
    });
    //lesson content  Scroll
    $('.lesson-content-scroll').each(function () {
        const ps = new PerfectScrollbar($(this)[0]);
    });
    //quiz and project  Scroll
    $('.quiz-project-scroll').each(function () {
        const ps = new PerfectScrollbar($(this)[0]);
    });

    //Scroll Triger
    // $('a.js-scroll-trigger[href*="#"]:not([href="#"])').on("click", function () {
    //     if (location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") && location.hostname === this.hostname) {
    //         var target = $(this.hash);
    //         target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
    //         if (target.length) {
    //             $("html, body").animate({
    //                 scrollTop: target.offset().top - 124
    //             }, 0, "easeInOutExpo");
    //             return false;
    //         }
    //     }
    // });

    // Closes responsive menu when a scroll trigger link is clicked
    $('.js-scroll-trigger').click(function () {
        //        $('.navbar-collapse', '.metismenu').collapse('hide');
    });

    // Activate scrollspy to add active class to navbar items on scroll
    //    $('body').scrollspy({
    //        target: '#navbar_top',
    //        offset: 70
    //    });

    //Pricing Table
    $(function () {
        //hide the subtle gradient layer (.pricing-list > li::after) when pricing table has been scrolled to the end (mobile version only)
        checkScrolling($('.pricing-body'));
        $(window).on('resize', function () {
            window.requestAnimationFrame(function () {
                checkScrolling($('.pricing-body'))
            });
        });
        $('.pricing-body').on('scroll', function () {
            var selected = $(this);
            window.requestAnimationFrame(function () {
                checkScrolling(selected)
            });
        });

        function checkScrolling(tables) {
            tables.each(function () {
                var table = $(this),
                    totalTableWidth = parseInt(table.children('.pricing-features list-unstyled').width()),
                    tableViewport = parseInt(table.width());
                if (table.scrollLeft() >= totalTableWidth - tableViewport - 1) {
                    table.parent('li').addClass('is-ended');
                } else {
                    table.parent('li').removeClass('is-ended');
                }
            });
        }

        //switch from monthly to annual pricing tables
        bouncy_filter($('.pricing-container'));

        function bouncy_filter(container) {
            container.each(function () {
                var pricing_table = $(this);
                var filter_list_container = pricing_table.children('.pricing-switcher'),
                    filter_radios = filter_list_container.find('input[type="radio"]'),
                    pricing_table_wrapper = pricing_table.find('.pricing-wrapper');

                //store pricing table items
                var table_elements = {};
                filter_radios.each(function () {
                    var filter_type = $(this).val();
                    table_elements[filter_type] = pricing_table_wrapper.find('li[data-type="' + filter_type + '"]');
                });

                //detect input change event
                filter_radios.on('change', function (event) {
                    event.preventDefault();
                    //detect which radio input item was checked
                    var selected_filter = $(event.target).val();

                    //give higher z-index to the pricing table items selected by the radio input
                    show_selected_items(table_elements[selected_filter]);

                    //rotate each pricing-wrapper 
                    //at the end of the animation hide the not-selected pricing tables and rotate back the .pricing-wrapper

                    if (!Modernizr.cssanimations) {
                        hide_not_selected_items(table_elements, selected_filter);
                        pricing_table_wrapper.removeClass('is-switched');
                    } else {
                        pricing_table_wrapper.addClass('is-switched').eq(0).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function () {
                            hide_not_selected_items(table_elements, selected_filter);
                            pricing_table_wrapper.removeClass('is-switched');
                            //change rotation direction if .pricing-list has the .bounce-invert class
                            if (pricing_table.find('.pricing-list').hasClass('bounce-invert'))
                                pricing_table_wrapper.toggleClass('reverse-animation');
                        });
                    }
                });
            });
        }

        function show_selected_items(selected_elements) {
            selected_elements.addClass('is-selected');
        }

        function hide_not_selected_items(table_containers, filter) {
            $.each(table_containers, function (key, value) {
                if (key != filter) {
                    $(this).removeClass('is-visible is-selected').addClass('is-hidden');

                } else {
                    $(this).addClass('is-visible').removeClass('is-hidden is-selected');
                }
            });
        }
    });

    // if(segment1 != ''){
    //     $(".popup-youtube").YouTubePopUp();
    // }


    // course_details after login 
});








(function () {
    $('.course-tabs').scrollingTabs({
        enableSwiping: true,
        scrollToTabEdge: true,
        disableScrollArrowsOnFullyScrolled: true
    }).on('ready.scrtabs', function () {
        $('.tab-content').show();
    });

}(jQuery));

//Feather Icon
feather.replace()