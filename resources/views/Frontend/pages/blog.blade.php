@extends('Frontend.layouts.master-layout')
@section('title', ' - Blogs')
@section('head')
    <style>
        .content_search {
            margin-top: 3.5rem;
        }

        /* @media screen and (min-width:391px) {
                .content_search {
                    margin-top: 6rem;
                }
            } */

        .service-card {
            border-radius: 8px;
            overflow: hidden;
            background-color: #166D4D0A;
            border: 0.5px solid #eaeaea;
            box-shadow: 1px 4px 23px -15px rgb(120 200 159);
            transition: 0.35s;
        }

        .service-card:hover {
            border: 0.5px solid #e1e1e1;
            box-shadow: 1px 4px 50px -18px rgb(120 200 159);
        }

        .service-card img {
            height: 250px !important;
            object-fit: cover;
        }

        .details-link {
            cursor: pointer;
        }

        .details-link span {
            font-size: 1rem;
            color: var(--secondary_background);
            white-space: nowrap;
        }

        .details-link svg {
            margin-left: 5px;
            transition: transform 0.35s ease-in-out;
        }

        .details-link:hover svg {
            transform: translateX(7px);
        }

        .card-title {
            height: 3rem;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            line-height: 1.5rem;
            max-height: 3rem;
            font-weight: 600;
        }
    </style>

    <style>
        .category-banner {
            position: relative;
            height: 30vh !important;
            background-image: url(@json($banner?->image_show));
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            border-radius: 8px;
        }

        .category-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0, 29, 18, 0.7) 0%, rgba(15, 29, 65, 0.35) 100%);
            z-index: 0;
            border-radius: inherit;
        }
    </style>
@endsection
@section('main_content')

    <div class="content_search">
        <link
            href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/blog.css"rel="stylesheet">
        <div class="bg-alice-blue py-3 py-lg-4">
            <div class="container-lg p-2 p-md-5">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <!--Start Category Banner-->
                        <div
                            class="category-banner d-flex flex-column justify-content-center align-items-center position-relative text-white px-4 py-5 px-sm-5 mb-4">
                            <div class="py-2 px-3 py-lg-4 px-lg-5 position-relative" style="border-radius:8px;">
                                <h4 class="fw-bold fs-1 text-center" style="color: #fff">
                                    {{ @$banner->title }}
                                </h4>
                                <h4 class="fw-bold fs-4 text-center" style="color: #fff">
                                    Get the latest blogs and insights on various topics. Stay updated with fresh content!
                                </h4>
                            </div>
                        </div>
                        <!--End Category Banner-->

                        <div class="row blog_search mb-3">
                            <div class="col-lg-3 col-md-6">
                                <div class="d-block p-3">
                                    <form>
                                        <div class="input-group">

                                            <input type="text" name="search" value="{{ $search }}"
                                                class="bg-white form-control pe-5 box" placeholder="Search "
                                                aria-label="Recipient's username" id="search_item"
                                                style="border-radius: 6px !important">
                                            <button
                                                class="bg-gray btn end-0 m-1 position-absolute px-2 rounded-2 search-brt"
                                                type="submit" id="searchblog">
                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.74112 10.7266C9.57692 10.7266 11.8758 8.56674 11.8758 5.90242C11.8758 3.2381 9.57692 1.07825 6.74112 1.07825C3.90532 1.07825 1.60645 3.2381 1.60645 5.90242C1.60645 8.56674 3.90532 10.7266 6.74112 10.7266Z"
                                                        stroke="#07477D" stroke-width="1.28367" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M13.1592 11.9326L10.3672 9.30945" stroke="#07477D"
                                                        stroke-width="1.28367" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>

                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <form>
                                    <div class="d-block p-3">
                                        <select class="form-select rounded-0 box" aria-label="Default select example"
                                            id="on_click_blog_category" style="border-radius: 6px !important">
                                            <option value='0'>Category: All</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button id="search_btn" type="submit" style="border: 0; background: no-repeat"
                                        href="#"></button>
                                </form>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="d-block p-3">
                                    <select class="form-select rounded-0 box" id="on_click_blog_topic"
                                        aria-label="Default select example" style="border-radius: 6px !important">
                                        <option value="0">Topic: All</option>
                                        @foreach ($topics as $topic)
                                            <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="d-block p-3">
                                    <select class="form-select rounded-0 box" aria-label="Default select example"
                                        id="on_click_blog_sort_by" style="border-radius: 6px !important">
                                        <option value="latest">Sort By: Latest</option>
                                        <option value="like">Like</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 blog_cat_ajax-show blog_topic_ajax-show blog_sort_by_ajax-show" id="alldata">
                            @foreach ($blogs as $blog)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="card service-card">
                                        <a href="{{ route('frontend.blog_details', $blog->id) }}">
                                            <img src="{{ $blog->image_show }}" class="card-img-top"
                                                alt="{{ $blog->title }}">
                                        </a>
                                        <div class="card-body">
                                            <p class="card-subtitle text-capital text-muted">
                                                {{ $blog->b_category->name ?? '' }}&nbsp;</p>
                                            <a href="{{ route('frontend.blog_details', $blog->id) }}"
                                                style="color: var(--btn_primary_color)">
                                                <h5 class="card-title mb-2"
                                                    onclick="{{ route('frontend.blog_details', $blog->id) }}">
                                                    {{ Illuminate\Support\Str::limit($blog->title, 50, '...') }}
                                                </h5>
                                            </a>

                                            <div class="d-flex align-items-center justify-content-between">
                                                <p class="text-muted">
                                                    {{ date('d M, Y', strtotime($blog->created_at)) }}
                                                </p>
                                                <p class="text-muted">
                                                    <i class="fa fa-eye"></i>&nbsp;

                                                    {{ $blog->views }}
                                                </p>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-end">
                                                <a href="{{ route('frontend.blog_details', $blog->id) }}"
                                                    class="details-link d-flex align-items-center justify-content-end">
                                                    <span>Read More</span>
                                                    <svg width="16" height="16" viewBox="0 0 16 16"
                                                        class="duration-100 ease-in ml-2 group-hover:translate-x-2"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8 0L6.59 1.41L12.17 7H0V9H12.17L6.59 14.59L8 16L16 8L8 0Z"
                                                            fill="var(--secondary_background)"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="segment_route" value="">
        <input type="hidden" id="segment_id" value="">

        <script>
            // $('#status').on('change',function(){
            //     $('#search_btn').click();
            // })




            $("#on_click_blog_category").change(function(e) {
                console.log(this);
                e.preventDefault();
                let id = $(this).val();
                //var id = document.getElementsByClassName('on_click_blog_category').value

                console.log(id);
                $.ajax({

                    type: 'GET',

                    url: "{{ url('blog-category-show-ajax') }}/" + id,

                    // data:{id:id},

                    success: function(data) {
                        //  document.getElementById("home-proud-hide").style.visibility = "hidden";
                        $(".blog_cat_ajax-show").html(data);
                    }

                });



            });


            $("#on_click_blog_topic").change(function(e) {
                console.log(this);
                e.preventDefault();
                let id = $(this).val();
                //var id = document.getElementsByClassName('on_click_blog_category').value

                console.log(id);
                $.ajax({

                    type: 'GET',

                    url: "{{ url('blog-topic-show-ajax') }}/" + id,

                    // data:{id:id},

                    success: function(data) {
                        //  document.getElementById("home-proud-hide").style.visibility = "hidden";
                        $(".blog_topic_ajax-show").html(data);
                    }

                });



            });



            $("#on_click_blog_sort_by").change(function(e) {
                console.log(this);
                e.preventDefault();
                let id = $(this).val();
                //var id = document.getElementsByClassName('on_click_blog_category').value

                console.log(id);
                $.ajax({

                    type: 'GET',

                    url: "{{ url('blog-sort-by-show-ajax') }}/" + id,

                    // data:{id:id},

                    success: function(data) {
                        //  document.getElementById("home-proud-hide").style.visibility = "hidden";
                        $(".blog_sort_by_ajax-show").html(data);
                    }

                });



            });













            // $('#searchblog').on('click', function() {

            //     // var blog_category_id = this.value;
            //     $("#segment_route").attr('value',"blog-search");
            //     // $("#segment_id").attr('value',blog_category_id);
            // 	var enterprise_shortname = $("#enterprise_shortname").val();
            // 	var user_id = $("#user_id").val();
            // 	// var forum_id = $("#forum_id").val();
            // 	// if(blog_category_id !='cat_all'){
            // 	var segment_route = 'blog-search';
            // 	// }
            // 	// var segment_id = $("#segment_id").val();

            // 	var search_item = $("#search_item").val();
            // 	$.ajax({
            //         url: base_url + "frontend/blog_filter",
            //         type: "POST",
            //         data: {
            //             'csrf_test_name': CSRF_TOKEN,
            //             // segment_id: segment_id,
            //             segment_route: segment_route,
            //             search_item: search_item,
            //             user_id: user_id,
            //             // blog_category_id: blog_category_id,
            //             enterprise_shortname: enterprise_shortname,

            //         },
            //         success: function(r) {
            //           console.log(r);
            // 		  $("#alldata").html(r);
            // 		  $(".blog_filter_off").remove();

            //         }
            //     });
            // })

            // $('#blogcategory_filter').on('change', function() {
            //     var blog_category_id = this.value;
            // 	// alert(blog_category_id);
            //     $("#segment_route").attr('value',"blog-category");
            //     $("#segment_id").attr('value',blog_category_id);
            // 	var enterprise_shortname = $("#enterprise_shortname").val();
            // 	var user_id = $("#user_id").val();
            // 	var forum_id = $("#forum_id").val();

            // 	if(blog_category_id !='cat_all'){
            // 		var segment_route = 'category';
            // 	}
            // 	var segment_id = $("#segment_id").val();
            // 	$.ajax({
            //         url: base_url + "frontend/blog_filter",
            //         type: "POST",
            //         data: {
            //             'csrf_test_name' : CSRF_TOKEN,
            //             segment_id: segment_id,
            //             segment_route: segment_route,
            //             user_id: user_id,
            //             blog_category_id: blog_category_id,
            //             enterprise_shortname: enterprise_shortname,

            //         },
            //         success: function(r) {
            //         //   console.log(r);
            // 		  $("#alldata").html(r);
            // 		  $(".blog_filter_off").remove();

            //         }
            //     });
            // })
            // $('#blogtopic_filter').on('change', function() {
            //     var topic_id = this.value;
            // 	var enterprise_shortname = $("#enterprise_shortname").val();
            // 	$("#segment_route").attr('value',"blog-topic");
            // 	$("#segment_id").attr('value',topic_id);
            // 	var user_id = $("#user_id").val();
            // 	var forum_id = $("#forum_id").val();
            // 	if(topic_id !='topic_all'){
            // 	var segment_route = 'blogtopic';
            // 	}
            // 	var segment_id = $("#segment_id").val();
            // 	$.ajax({
            //         url: base_url + "frontend/blog_filter",
            //         type: "POST",
            //         data: {
            //             'csrf_test_name': CSRF_TOKEN,
            //             segment_id: segment_id,
            //             segment_route: segment_route,
            //             user_id: user_id,
            //             blog_category_id: topic_id,
            //             enterprise_shortname: enterprise_shortname,

            //         },
            //         success: function(r) {
            //           console.log(r);
            // 		  $("#alldata").html(r);
            // 		  $(".blog_filter_off").remove();

            //         }
            //     });
            // })
            // $('#latest_filter').on('change', function() {
            //     var topic_id = this.value;

            // 	var enterprise_shortname = $("#enterprise_shortname").val();
            // 	if(topic_id == 'like'){
            // 		$("#segment_route").attr('value',"blog-like");
            // 	}else{
            // 		$("#segment_route").attr('value',"desc");
            // 	}

            // 	var user_id = $("#user_id").val();
            // 	var forum_id = $("#forum_id").val();
            // 	// if(topic_id !='topic_all'){
            // 	// var segment_route = 'blogtopic';
            // 	// }
            // 	var segment_route = $("#segment_route").val();
            // 	var segment_id = $("#segment_id").val();
            // 	$.ajax({
            //         url: base_url + "frontend/blog_filter",
            //         type: "POST",
            //         data: {
            //             'csrf_test_name': CSRF_TOKEN,
            //             segment_id: segment_id,
            //             segment_route: segment_route,
            //             user_id: user_id,
            //             blog_category_id: topic_id,
            //             enterprise_shortname: enterprise_shortname,

            //         },
            //         success: function(r) {
            //         //   console.log(r);
            // 		  $("#alldata").html(r);
            // 		  $(".blog_filter_off").remove();

            //         }
            //     });
            // })


            // 	// load more index page
            // 	function loadmore_blog(id) {
            // 	// var course_type = $("#course_type").val();
            // 	var enterprise_shortname = $("#enterprise_shortname").val();
            // 	var user_id = $("#user_id").val();
            // 	var segment_route = $("#segment_route").val();
            // 	var segment_id = $("#segment_id").val();
            // 	var search_item = $("#search_item").val();
            // 		// $(".load").html('<img src="https://lead.academy/assets/source.gif" style="width: 40px;"/>');
            // 		// alert(search_item);
            // 		$.ajax({
            // 			type: "POST",
            // 			url: base_url + enterprise_shortname + "/loadmore-blog",
            // 			cache: false,
            // 			data: {
            // 			lastid: id,
            // 			enterprise_shortname: enterprise_shortname,
            // 			user_id: user_id,
            // 			segment_route:segment_route,
            // 			segment_id:segment_id,
            // 			search_item:search_item,
            // 			csrf_test_name: CSRF_TOKEN,
            // 			},
            // 			success: function (response) {
            // 				// console.log(response);
            // 			$("#alldata").append(response);

            // 			// $("#home_course_load" + ids).remove();
            // 			$(".removebuton_" + id).remove();

            // 			// $(".hideClass .course").each(function (index) {
            // 			// 	var p_course_id = $(this).attr("id");
            // 			// 	$("#course_subscription_" + p_course_id)
            // 			// 	.first()
            // 			// 	.hide();
            // 			// 	$("#course_subscription_" + p_course_id)
            // 			// 	.first()
            // 			// 	.removeClass("d-flex");
            // 			// });
            // 			// $(".popup-youtube").YouTubePopUp();
            // 			},
            // 		});
            // 	}
        </script>
    </div>

    @include('Frontend.layouts.parts.news-letter')

@endsection
