<script>
    $('#search_input').keypress(function(e) {
        // Enter pressed?
        if (e.which == 10 || e.which == 13) {
            this.form.submit();
        }
    });

    // if(jQuery('.sticky-content')){
    //     jQuery('.sticky-content').theiaStickySidebar({
    //         // Settings
    //         additionalMarginTop: 70
    //     });
    // }


    // if($(".about_carousel")){
    //     $(".about_carousel").owlCarousel({
    //     loop: true,
    //     margin: 10,
    //     nav: true,
    //     dots: false,
    //     navText: [
    //         "<i class='fas fa-caret-left'></i>",
    //         "<i class='fas fa-caret-right'></i>",
    //     ],
    //     items: 1,
    //     });
    // }

    // if($(".mess-carousel")){
    //     $(".mess-carousel").owlCarousel({
    //     loop: true,
    //     margin: 15,
    //     nav: true,
    //     dots: false,
    //     navText: [
    //         "<i class='fas fa-caret-left'></i>",
    //         "<i class='fas fa-caret-right'></i>",
    //     ],
    //     items: 3,
    //     });
    // }
</script>

<script>
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    $('#accept_cookies').click(function() {
        let reff = $('#reff').val();
        // let std_id = $('#student_id').val();
        // if(reff == std_id){
        //     sessionStorage.setItem('acceptCookies','yes');
        //     $('#cookies_inner').hide();
        //     // alert('ref='+user_id);
        //     setCookie("cname", "", 30);
        // }else{
        sessionStorage.setItem('acceptCookies', 'yes');
        $('#cookies_inner').hide();
        // alert('ref='+user_id);
        setCookie("cname", reff, 30);
        // }

    });
    if (sessionStorage.getItem('acceptCookies') == 'yes') {
        $('#cookies_inner').hide();
    } else {
        $('#cookies_inner').show();
    }
</script>

<script
    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/plugins/bootstrap/js/bootstrap.bundle.min.js">
</script>
<script
    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/plugins/Sortable/Sortable.min.js">
</script>
<script
    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/plugins/feather-font/feather.min.js">
</script>
<script
    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/plugins/mmenu-light/dist/mmenu-light.js">
</script>
<script
    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/plugins/jquery.counterup/jquery.waypoints.min.js">
</script>
<script
    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/plugins/jquery.counterup/jquery.counterup.min.js">
</script>
<script
    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/plugins/OwlCarousel2/owl.carousel.min.js">
</script>
<script
    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/plugins/video-popup/videoPopUp.jquery.js">
</script>
<script
    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/plugins/Magnific-Popup/dist/jquery.magnific-popup.min.js">
</script>
<script
    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/plugins/scrolling-tabs/dist/jquery.bs4-scrolling-tabs.min.js">
</script>
<script
    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/plugins/modernizr/modernizr.min.js">
</script>
<script
    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/plugins/sweetalert/sweet-alert.min.js">
</script>
<script
    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/plugins/theia-sticky-sidebar/dist/ResizeSensor.min.js">
</script>
<script
    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/plugins/theia-sticky-sidebar/dist/theia-sticky-sidebar.min.js">
</script>
<script
    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/plugins/ckeditor5-classic/ckeditorjss.js"
    type="text/javascript"></script>

<script
    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js">
</script>
<script
    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/plugins/raty/lib/jquery.raty.js">
</script>
<script src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/jquery.easing.min.js">
</script>
<script
    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/plugins/toastr/toastr.min.js">
</script>

<script src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/upload.js"></script>
<script src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/custom.js"></script>
<script src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/frontends.js">
</script>
{{-- <script type="text/javascript"
    src="http://cdn.rawgit.com/bassjobsen/Bootstrap-3-Typeahead/master/bootstrap3-typeahead.min.js"></script> --}}
<script src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/jquery-ui.min.js">
</script>


<!-- <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/decoupled-document/ckeditor.js"></script> -->

<input type="hidden" id="security_character" value="@!#$%^&amp;*()_+[]{}?;|&#039;`/&gt;&lt;">
<input type="hidden" id="mail_specialcharacter_remove" value="!#$%^&amp;*()_+[]{}?:;|&#039;`/&gt;&lt;">
<input type="hidden" id="onlynumber_allow" value="@!#$%^&amp;*()_+[]{}?:;|\/~`-=abcdefghijklmnopqrstuvwxyz&gt;&lt;">
<input type="hidden" id="coursespecial_character" value="@$^*_[]{}`&gt;&lt;">

{{-- <script src="{{ asset('frontend') }}/cdn.jsdelivr.net/npm/js-cookie%403.0.0-rc.1/dist/js.cookie.min.js"></script> --}}

<script>
    if ($('.note-carousel')) {
        $('.note-carousel').owlCarousel({
            loop: false,
            margin: 20,
            dots: false,
            items: 1,
            nav: true,
            navText: ["<i class='fas fa-caret-left'></i>", "<i class='fas fa-caret-right'></i>"]
        })
    }

    if ($('.project-carousel')) {
        $('.project-carousel').owlCarousel({
            loop: false,
            margin: 20,
            dots: false,
            nav: true,
            navText: ["<i class='fas fa-caret-left'></i>", "<i class='fas fa-caret-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 2
                },
                768: {
                    items: 4
                },
                992: {
                    items: 5
                },
                1200: {
                    items: 6
                }
            }
        })
    }

    if ($('.blog-carousel')) {
        $('.blog-carousel').owlCarousel({
            loop: false,
            margin: 20,
            dots: false,
            nav: true,
            navText: ["<i class='fas fa-caret-left'></i>", "<i class='fas fa-caret-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                }
            }
        })
    }

    if ($('.news-carousel')) {
        $('.news-carousel').owlCarousel({
            loop: true,
            margin: 20,
            items: 1,
            dots: false,
            nav: true,
            navText: ["<i class='fas fa-caret-left'></i>", "<i class='fas fa-caret-right'></i>"]
        })
    }
    if ($('.class-carousel')) {
        $('.class-carousel').owlCarousel({
            loop: true,
            margin: 20,
            items: 1,
            dots: false,
            nav: true,
            navText: ["<i class='fas fa-caret-left'></i>", "<i class='fas fa-caret-right'></i>"]
        })
    }

    if ($('.project-carousel')) {
        $('.project-carousel').owlCarousel({
            loop: true,
            margin: 20,
            items: 1,
            dots: false,
            nav: true,
            navText: ["<i class='fas fa-caret-right'></i>", "<i class='fas fa-caret-left'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1200: {
                    items: 3
                }
            }
        })
    }

    if ($('.certificate-carousel')) {
        $('.certificate-carousel').owlCarousel({
            loop: false,
            margin: 20,
            dots: false,
            mouseDrag: false,
            nav: true,
            navText: ["<i class='fas fa-caret-left'></i>", "<i class='fas fa-caret-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                }
            }
        })
    }

    if ($('.brand-carousel')) {
        $('.brand-carousel').owlCarousel({
            loop: false,
            margin: 10,
            dots: false,
            mouseDrag: false,
            nav: true,
            navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
            responsive: {
                0: {
                    items: 2
                },
                520: {
                    items: 3
                },
                720: {
                    items: 4
                },
                1200: {
                    items: 5
                }
            }
        })
    }

    if ($('.collaborate-carousel')) {
        $('.collaborate-carousel').owlCarousel({
            loop: true,
            // margin: 20,
            mouseDrag: false,
            nav: false,
            autoplay: false,
            dots: true,
            navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
            responsive: {
                0: {
                    items: 2
                },
                520: {
                    items: 3
                },
                720: {
                    items: 4
                },
                1200: {
                    items: 5
                }
            }
        })
    }

    if ($('.collaborate2-carousel')) {
        $('.collaborate2-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            mouseDrag: true,
            dots: true,
            responsive: {
                0: {
                    items: 1
                },
                460: {
                    items: 2
                },
                900: {
                    items: 3
                },
                1200: {
                    items: 4
                },
                1450: {
                    items: 5
                }
            }
        });
    }

    if ($('.brand2-carousel')) {
        $('.brand2-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                460: {
                    items: 2
                },
                900: {
                    items: 3
                },
                1200: {
                    items: 4
                },
                1450: {
                    items: 5
                }
            }
        });
    }

    $('.instructor-carousel').owlCarousel({
        autoplay: true,
        autoplayTimeout: 2000,
        smartSpeed: 500,
        loop: true,
        margin: 0,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1100: {
                items: 3
            }
        }
    });

    if ($('.testimonial-carousel')) {
        $('.testimonial-carousel').owlCarousel({
            loop: false,
            margin: 20,
            dots: false,
            mouseDrag: false,
            touchDrag: false,
            // autoplay: true,
            nav: true,
            navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
            responsive: {
                0: {
                    items: 1,
                    margin: 0
                },
                650: {
                    items: 2,
                },
                930: {
                    items: 3
                },

            }
        });
    }


    if ($('.courses-carousel')) {
        $('.courses-carousel').owlCarousel({
            loop: false,
            margin: 20,
            dots: false,
            nav: true,
            navText: ["<i class='fas fa-caret-left'></i>", "<i class='fas fa-caret-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        })
    }



    if ($('.vBlog-carousel')) {
        $('.vBlog-carousel').owlCarousel({
            autoplay: true,
            loop: true,
            margin: 25,
            dots: true,
            // nav: true,
            // navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                992: {
                    items: 3
                }
            }
        });
    }

    if ($(".popup-youtube")) {
        $(".popup-youtube").YouTubePopUp();
    }
    $('.live_list').owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

    if ($("input.proficiency-typeahead")) {
        $("input.proficiency-typeahead").typeahead({
            highlight: true,
            minLength: 1,
            source: function(query, result) {
                $.ajax({
                    url: base_url +
                        enterprise_shortname +
                        "/autocomplete-proficiency-search",
                    data: {
                        csrf_test_name: CSRF_TOKEN,
                        query: query,
                        enterprise_id: enterprise_id,
                    },
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        result(
                            $.map(data, function(item) {
                                return item.title;
                                // return item.title+"->"+item.proficiency_id;
                            })
                        );
                    },
                });
            },
            autoSelect: false,
        });
    }
</script>

<!-- edit student  profile  -->
<script>
    if (document.getElementById('customhandle') != null) {
        new Sortable(document.getElementById('customhandle'), {
            handle: '.handle', // handle's class
            animation: 150
        });
    }
    if (document.getElementById('customhandle2') != null) {
        new Sortable(document.getElementById('customhandle2'), {
            handle: '.handle', // handle's class
            animation: 150
        });
    }
    if (document.getElementById('gridDemo') != null) {
        new Sortable(document.getElementById('gridDemo'), {
            animation: 150,
            ghostClass: 'blue-background-class'
        });
    }
</script>

<!-- student dashboard js  -->

<script>
    //========== its for typeahead autocomplete =============
    //====header and Home explore search input data get here =====

    (function($) {
        "use strict";
        $("document").ready(function() {
            var CSRF_TOKEN = $('#CSRF_TOKEN').val();
            $('input.typeahead').typeahead({
                highlight: true,
                minLength: 1,
                source: function(query, result) {
                    $.ajax({
                        url: base_url + enterprise_shortname +
                            "/autocomplete-course-search-ex",
                        data: {
                            'csrf_test_name': CSRF_TOKEN,
                            query: query
                        },
                        dataType: "json",
                        type: "POST",
                        success: function(data) {
                            result($.map(data, function(item) {
                                return item.name;
                            }));
                        },
                    });
                },
                autoSelect: false
            });
        });

    }(jQuery));
    (function($) {
        "use strict";

        $("document").ready(function() {
            var CSRF_TOKEN = $('#CSRF_TOKEN').val();
            // $('input.typeahead').typeahead({
            //     highlight: true,
            //     minLength: 1,
            //     source: function(query, result) {
            //         $.ajax({
            //             url: base_url + enterprise_shortname +
            //                 "/autocomplete-course-search-ex",
            //             data: {
            //                 'csrf_test_name': CSRF_TOKEN,
            //                 query: query
            //             },
            //             dataType: "json",
            //             type: "POST",
            //             success: function(data) {
            //                 result($.map(data, function(item) {
            //                     // console.log(item.name);
            //                     return item.value;
            //                 }));
            //             },
            //         });
            //     },
            //     autoSelect: false
            // });

            $(".uiautocomplete").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        type: "POST",
                        url: base_url + enterprise_shortname +
                            "/autocomplete-course-search",
                        dataType: "json",
                        data: {
                            'csrf_test_name': CSRF_TOKEN,
                            query: request.term,
                            enterprise_id: enterprise_id,
                        },
                        success: function(data) {
                            $("#ui-id-1").addClass("search_autocomplete");
                            // console.log(data);
                            response(data);
                        }
                    });
                },
                minLength: 1,
                select: function(event, ui) {
                    $("#uiitem").val(ui.item.value);
                    // $("#shapla").val(ui.item.course_id);
                }
            });

        });

    }(jQuery));
    //=================header search button  tigger ===============
    "use strict";

    function typeahead_search() {
        var item = $("#uiitem").val();
        var base_url = $("#base_url").val();
        var CSRF_TOKEN = $('#CSRF_TOKEN').val();
        var set_lang = $('#set_language').val();
        if (item == '') {
            toastrErrorMsg("Empty field not allow!");
            return false;
        }
        // location.href = base_url + enterprise_shortname + "/typeahead-search?keyward=" + item;
        if (set_lang === 'bn') {
            location.href = base_url + "typeahead-search/bn?keyward=" + item;
        } else {
            location.href = base_url + "typeahead-search?keyward=" + item;
        }
        // $.ajax({
        //     url: base_url + "typeahead-search",
        //     type: "POST",
        //     data: {
        //         'csrf_test_name' : CSRF_TOKEN,
        //         keyward : item
        //     },
        //     success: function(r) {
        //         alert(r);
        //     }
        // });
    }

    //=================Home explore search buttontigger========
    "use strict";

    function typeahead_explore_search() {
        var set_lang = $('#set_language').val();
        var item = $("#items").val();
        var base_url = $("#base_url").val();
        var CSRF_TOKEN = $('#CSRF_TOKEN').val();
        if (item == '') {
            toastrErrorMsg("Empty field not allow!");
            return false;
        }
        // location.href = base_url + enterprise_shortname + "/typeahead-search?keyward=" + item;
        // location.href = base_url + "typeahead-search?keyward=" + item;

        if (set_lang === 'bn') {
            location.href = base_url + "typeahead-search/bn?keyward=" + item;
        } else {
            location.href = base_url + "typeahead-search?keyward=" + item;
        }

        // $.ajax({
        //     url: base_url + "typeahead-search",
        //     type: "POST",
        //     data: {
        //         'csrf_test_name' : CSRF_TOKEN,
        //         keyward : item
        //     },
        //     success: function(r) {
        //         alert('OK');
        //     }
        // });

    }

    // course page filtering
    $('#course_filters').on('change', function() {
        var set_lang = $('#set_language').val();
        var course_type = this.value;
        var cat_id = $("#course_cat_id").val();
        $("#category_type").val(course_type);

        // if(set_lang === 'bn'){
        //     realUrl = base_url + enterprise_shortname + "/category-course-filtering/bn";
        // }else{
        //     realUrl = base_url + enterprise_shortname + "/category-course-filtering";
        // }

        $.ajax({
            url: base_url + enterprise_shortname + "/category-course-filtering",
            type: "POST",
            data: {
                'csrf_test_name': CSRF_TOKEN,
                course_type: course_type,
                category_id: cat_id,
                enterprise_shortname: enterprise_shortname,
                lang: set_lang
            },
            success: function(r) {

                $("#alldata").html(r);
                $('.popup-youtube').magnificPopup({
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: true,
                    fixedContentPos: true
                });

                $(".hideClass .course").each(function(index) {
                    var p_course_id = $(this).attr('id');
                    $("#course_subscription_" + p_course_id).first().hide();
                    $('#course_subscription_' + p_course_id).first().removeClass('d-flex');
                });

            }
        });


    });
    //===============category_course_search===input item===========
    (function($) {
        "use strict";
        $("document").ready(function() {
            var CSRF_TOKEN = $('#CSRF_TOKEN').val();
            var category_id = $('#category_id').val();
            $('input.typeaheads').typeahead({

                highlight: true,
                minLength: 1,
                source: function(query, result) {
                    $.ajax({
                        url: base_url + enterprise_shortname +
                            "/autocomplete-category-wise-course-search",
                        data: {
                            'csrf_test_name': CSRF_TOKEN,
                            query: query,
                            category_id: category_id
                        },
                        dataType: "json",
                        type: "POST",
                        success: function(data) {
                            result($.map(data, function(item) {
                                return item.name;
                            }));
                        },
                    });
                }
            });
        });

    }(jQuery));
    //===============category_course_search= button click=============
    "use strict";

    function typeahead_category_wise_search() {
        var set_lang = $('#set_language').val();
        var item = $("#items").val();
        var category_id = $('#category_id').val();
        var base_url = $("#base_url").val();
        var CSRF_TOKEN = $('#CSRF_TOKEN').val();
        if (item == '') {
            toastrErrorMsg("Empty field not allow!");
            return false;
        }
        $.ajax({
            url: base_url + enterprise_shortname + "/category-wise-typeahead-search",
            type: "POST",
            data: {
                'csrf_test_name': CSRF_TOKEN,
                item: item,
                category_id: category_id,
                enterprise_shortname: enterprise_shortname,
                lang: set_lang
            },
            success: function(r) {
                $("#alldata").html(r);
                //Popup Video
                $('.popup-youtube').magnificPopup({
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: true,
                    fixedContentPos: true
                });

                $(".hideClass .course").each(function(index) {
                    var p_course_id = $(this).attr('id');
                    $("#course_subscription_" + p_course_id).first().hide();
                    $('#course_subscription_' + p_course_id).first().removeClass('d-flex');
                });
            }
        });
    }

    //   course page filtering
    $('#daywise_filters').on('change', function() {
        var course_type = this.value;
        var cat_id = $("#course_cat_id").val();
        $("#category_type").val(course_type);
        $.ajax({
            url: base_url + enterprise_shortname + "/category-course-filtering",
            type: "POST",
            data: {
                'csrf_test_name': CSRF_TOKEN,
                course_type: course_type,
                category_id: cat_id,
                enterprise_shortname: enterprise_shortname
            },
            success: function(r) {
                $("#alldata").html(r);
                $('.popup-youtube').magnificPopup({
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: true,
                    fixedContentPos: true
                });
                $(".hideClass .course").each(function(index) {
                    var p_course_id = $(this).attr('id');
                    $("#course_subscription_" + p_course_id).first().hide();
                    $('#course_subscription_' + p_course_id).first().removeClass('d-flex');
                });
            }
        });


    });

    $(".uiautocomplete").on("keypress", function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            typeahead_search();
        }
    });
    $(".typeahead").on("keypress", function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            typeahead_explore_search();
        }
    });
    // category page
    $(".typeaheads").on("keypress", function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            typeahead_category_wise_search();
        }
    });

    //  savecourse remove
    function deleteSavecourse(status, id) {
        var user_type = $("#user_type").val();
        // var student_id = $("#student_id").val();
        var student_id = $("#user_id").val();
        var r = confirm("Do you want to delete?");
        if (r == true) {
            $.ajax({
                url: base_url + "/frontend/frontend/get_coursesavelandigpage",
                type: "POST",
                data: {
                    csrf_test_name: CSRF_TOKEN,
                    status: status,
                    student_id: student_id,
                    course_id: id,
                },
                success: function(r) {
                    // alert(course_id);
                    if (status == 0) {
                        setTimeout(function() {
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                                showMethod: "slideDown",
                                timeOut: 1500,
                                onHidden: function() {},
                            };
                            toastr.success('Delete successfully!');
                        }, 1000);
                    }
                    $("#deleteSavecourse").load(location.href + " #deleteSavecourse");
                    $("#countsavedcourse").load(location.href + " #countsavedcourse");
                },
            });
        }
    }
</script>
<script>
    // drag and drop
    var el = document.getElementById('page_list');
    if (el != null) {
        var sortable = Sortable.create(el, {
            onUpdate: function(event, ui) {
                var page_id_array = new Array();
                $('#page_list .crtificate_order').each(function() {
                    page_id_array.push($(this).attr("id"));
                });
                console.log(page_id_array);
                var course_id = $("#course_id").val();
                var enterprise_id = $("#enterprise_id").val();
                var user_id = $("#user_id").val();
                $.ajax({
                    url: base_url + enterprise_shortname + "/socialIconOrdering",
                    method: "POST",
                    data: {
                        'csrf_test_name': CSRF_TOKEN,
                        page_id_array: page_id_array,
                        user_id: user_id,
                        enterprise_id: enterprise_id,
                        course_id: course_id
                    },
                    success: function(data) {
                        // alert(data);
                        console.log(data);
                    }
                });
            }

        });
        new Sortable(el, {
            placeholder: "ui-state-highlight",
            ghostClass: 'blue-background-class',
            sort: true,
            handle: ".handle",
            draggable: "id",

        });
    }
</script>



{{-- ---------------------------------Comment 09-01-2024 start--------------------------- --}}
<script type="text/javascript">
    //  $("document").ready(function() {
    //     var segment2 = $("#segment2").val();

    // function load_notify_counter() {
    //     if(segment2 == 'forum-details'){
    //         return false;
    //     }
    //     $.ajax({
    //         url: base_url + enterprise_shortname + '/nofity_counter',
    //         type: "POST",
    //         data: {
    //             csrf_test_name: CSRF_TOKEN,
    //             user_id: "",
    //             enterprise_id: "1",
    //         },
    //         success: function(r) {
    //             jQuery("#notify_counter").html(r);
    //         },
    //     });
    //     return false;
    // }
    // setInterval(function my_function() {
    //     console.log("sss");
    //     if(segment2 == 'forum-details'){
    //         return false;
    //     }
    //     // load_notify_counter();
    //     $("#notifications").load(window.location.href + " #notifications");
    //     $('.notifications-scroll').each(function() {
    //         const ps = new PerfectScrollbar($(this)[0]);
    //     });
    // }, 2000);
    // });
    // $("document").ready(function() {
    //     // load_notify_counter();
    //     if(segment2 == 'forum-details'){
    //         return false;
    //     }
    //     $("#notifications").load(window.location.href + " #notifications");
    //     $('.notifications-scroll').each(function() {
    //         const ps = new PerfectScrollbar($(this)[0]);
    //     });
    // });

    // $("body").on('click', "#read_notificaiton", function() {
    //     var id = $(this).attr("data-id");
    //     var userntype = $("#instructor").val();
    //     var typ = $("#typ").val();
    //     $.ajax({
    //         url: base_url + enterprise_shortname + '/nofity-read',
    //         type: "POST",
    //         data: {
    //             csrf_test_name: CSRF_TOKEN,
    //             user_id: "",
    //             enterprise_id: "1",
    //             id: id,
    //         },
    //         success: function(r) {
    //             if (typ == 1) {
    //                 if(userntype =="instructor"){
    //                     location.href = base_url + enterprise_shortname + '/instructor-notifications/';
    //                 }else{

    //                     // location.href = base_url + enterprise_shortname + '/course-details/' + id;
    //                     location.href = base_url + enterprise_shortname + '/student-notification/';
    //                 }
    //             } else if (typ == 2) {
    //                 location.href = base_url + enterprise_shortname + '/event-details/' + id;
    //             } else if (typ == 3) {
    //                 location.href = base_url + enterprise_shortname + '/forum-details/' + id;

    //             } else if (typ == 6) {

    //                 location.href = base_url + enterprise_shortname + '/student-notification/';

    //             }
    //             // load_notify_counter();
    //             // location.href = base_url + enterprise_shortname + '/forum-details/'+id;
    //         },
    //     });
    //     return false;

    // });


    // // course subscription and purchase maintanance
    // $(document).ready(function() {
    //     $(".hideClass .course").each(function(index) {
    //         var p_course_id = $(this).attr('id');
    //         $("#course_subscription_" + p_course_id).first().hide();
    //         $('#course_subscription_' + p_course_id).first().removeClass('d-flex');
    //     });
    // });

    // function coursechecedRadio(s) {

    //     if (!$('#flexRadioDefault2_' + s).is('.checked')) {
    //         $('#flexRadioDefault2_' + s).addClass('checked');
    //         $('#flexRadioDefault2_' + s).prop('checked', true);
    //         $('#flexRadioDefault2_' + s).val("1");

    //         $('#flexRadioDefault1_' + s).val("0");
    //         $('#flexRadioDefault1_' + s).removeClass('checked');
    //         $('#flexRadioDefault1_' + s).prop('checked', false);

    //         $("#course_subscription_" + s).hide();
    //         $('#course_subscription_' + s).removeClass('d-flex');
    //         $('#course_purchase_' + s).addClass('d-flex');
    //         $("#course_purchase_" + s).show();
    //     }

    // }

    // function subscriptionchecedRadio(s) {
    //     if (!$('#flexRadioDefault1_' + s).is('.checked')) {
    //         $('#flexRadioDefault1_' + s).addClass('checked');
    //         $('#flexRadioDefault1_' + s).prop('checked', true);
    //         $('#flexRadioDefault1_' + s).val("1");
    //         $('#flexRadioDefault2_' + s).val("0");
    //         $('#flexRadioDefault2_' + s).removeClass('checked');
    //         $('#flexRadioDefault2_' + s).prop('checked', false);
    //         $("#course_subscription_" + s).show();
    //         $('#course_subscription_' + s).addClass('d-flex');
    //         $('#course_purchase_' + s).removeClass('d-flex');
    //         $("#course_purchase_" + s).hide();
    //     }

    // }
</script>
{{-- ---------------------------------Comment 09-01-2024 end--------------------------- --}}
