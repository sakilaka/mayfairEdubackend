@extends('Frontend.layouts.master-layout')
@section('title', ' - Blog Details')
@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/ckeditor5-rendered.css') }}">

    <style>
        .content_search {
            margin-top: 3.5rem;
        }

        /* @media screen and (min-width:391px) {
                .content_search {
                    margin-top: 6rem;
                }
            } */
    </style>
@endsection
@section('main_content')

    <!-- Main content -->

    <div class="content_search">
        <link rel="stylesheet"
            href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/ali.css">
        <link rel="stylesheet"
            href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/blog.css">

        <style type="text/css">
            .row {
                display: flex;
                position: relative;
            }

            .shadow-inner::before {
                border-radius: 0.75rem;
            }
        </style>

        <div class="bg-alice-blue py-5 py-sm-3">
            <div class="container-lg">
                <div class="row justify-content-center py-4">
                    <div class="col-md-12 px-0">
                        <!--Start Category Banner-->
                        <div class="category-banner shadow-inner bg-img text-white px-4 py-5 px-sm-5 position-relative">
                            <div class="bottom-0 end-0 overflow-hidden position-absolute start-0 top-0"
                                style="background-image: url('{{ $blog->image_show }}');border-radius:0.75rem;background-position: center;background-repeat: no-repeat;background-size: cover;">
                                {{-- <img src="{{ $blog->image_show }}"
                                    class="img-fluid" alt=""> --}}
                            </div>
                            <div class="row justify-content-center" style="z-index: 2">
                                <div class="col-xl-8">
                                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                        <ol class="breadcrumb blog-bread">
                                            <li class="breadcrumb-item"><a href="{{ url('/') }}"
                                                    style="color: #fff;">Home </a></li>
                                            <li class="breadcrumb-item" aria-current="page"><a href="{{ url('/blogs') }}"
                                                    style="color: #fff;">Blogs</a></li>
                                            <li class="breadcrumb-item active" aria-current="page" style="color: #fff;">
                                                {{ $blog->b_category->name ?? '' }}</li>
                                        </ol>
                                    </nav>
                                    <div class="align-items-start d-block d-md-flex">
                                        <div class="d-block dateTitle me-4 mt-2 pe-3"
                                            style="color: var(--header_text_color)">
                                            {{ $blog->created_at->format('d M') }}
                                        </div>
                                        <div class="d-block">
                                            <h2 class="fs-1 fw-semi-bold mb-0" style="color: var(--header_text_color)">
                                                {{ $blog->title }}</h2>
                                            <div class="d-flex mt-4">
                                                <!-- <div class="vSec">By </div> -->
                                                <div class="vSec" style="color: var(--header_text_color)">By
                                                    {{ $blog->author }}</div>
                                                <div class="vSec" style="color: var(--header_text_color)">
                                                    {{ $blog->b_category->name ?? '' }}</div>
                                                <!-- <div class="vSec">Marketing</div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Category Banner-->
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-alice-blue">
            <div class="container-lg">
                <div class="bg-white rounded justify-content-center row">
                    <div class="col-xl-8 pt-5 blog-des-area">

                        <div style="color: var(--text_color)" class="ckeditor5-rendered">
                            {!! $blog->description !!}
                        </div>

                        <div class="align-items-center d-flex flex-wrap tags mt-5 mb-4">
                            <h6 class="me-4 mb-0" style="color: var(--text_color)">
                                <i class="fa fa-tag me-2"></i>Tags:
                            </h6>
                            @foreach ($blog->tag as $item)
                                <span class="bg-white border d-inline-block fs-6 me-2 my-1 px-3 py-2 rounded shadow-sm"
                                    style="color: var(--text_color)">#{{ $item->name }}</span>
                            @endforeach
                        </div>


                    </div>

                    <div class="col-xl-10">
                        <div class="align-items-center border-top justify-content-between mx-0 py-4 row alabin">
                            <div class="col-lg-6">
                                <div class="align-items-center avatar d-flex mb-4 mb-lg-0">
                                    <div class="blog me-4">
                                        <img src="{{ $blog->author_image_show }}" alt=""
                                            class="img-fluid rounded-circle" style="width:80px; height:80">
                                    </div>
                                    <div class="avatar-text">
                                        <h6 class="vBlog_name avatar-name" style="color: var(--text_color)">By
                                            {{ $blog->author }}</h6>
                                        <!-- <h6 class="vBlog_name avatar-name">By </h6> -->
                                        <div class="avatar-designation font_open fs-5 text-muted"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">


                                <div class="row justify-content-lg-end justify-content-center align-items-center">
                                    <div class="col-6 col-lg-auto d-flex align-items-center mt-2 mt-lg-0"
                                        style="cursor: pointer;">
                                        <div class="likeunlike-area">
                                            @auth
                                                @if (auth()->user()->likedBlogs->contains($blog))
                                                    {{-- The user has already liked this blog --}}
                                                    <button class="like-btn border-0" data-blog-id="{{ $blog->id }}">
                                                        <svg aria-hidden="true" class="like-btn"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            fill="none" viewBox="0 0 24 24"
                                                            style="width: 35px; height:35px; fill:black;">
                                                            <path fill-rule="evenodd"
                                                                d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                @else
                                                    {{-- The user has not liked this blog yet --}}
                                                    <button class="like-btn border-0" data-blog-id="{{ $blog->id }}">
                                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="none" viewBox="0 0 24 24"
                                                            style="width: 35px; height:35px">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="1"
                                                                d="M7 11c.889-.086 1.416-.543 2.156-1.057a22.323 22.323 0 0 0 3.958-5.084 1.6 1.6 0 0 1 .582-.628 1.549 1.549 0 0 1 1.466-.087c.205.095.388.233.537.406a1.64 1.64 0 0 1 .384 1.279l-1.388 4.114M7 11H4v6.5A1.5 1.5 0 0 0 5.5 19v0A1.5 1.5 0 0 0 7 17.5V11Zm6.5-1h4.915c.286 0 .372.014.626.15.254.135.472.332.637.572a1.874 1.874 0 0 1 .215 1.673l-2.098 6.4C17.538 19.52 17.368 20 16.12 20c-2.303 0-4.79-.943-6.67-1.475" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            @endauth
                                        </div>

                                        <span class="fs-5" style="color: var(--text_color)">
                                            <svg aria-hidden="true" class="like-btn" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" fill="none" viewBox="0 0 24 24"
                                                style="width: 35px; height:35px" data-blog-id="{{ $blog->id }}">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1"
                                                    d="M7 11c.889-.086 1.416-.543 2.156-1.057a22.323 22.323 0 0 0 3.958-5.084 1.6 1.6 0 0 1 .582-.628 1.549 1.549 0 0 1 1.466-.087c.205.095.388.233.537.406a1.64 1.64 0 0 1 .384 1.279l-1.388 4.114M7 11H4v6.5A1.5 1.5 0 0 0 5.5 19v0A1.5 1.5 0 0 0 7 17.5V11Zm6.5-1h4.915c.286 0 .372.014.626.15.254.135.472.332.637.572a1.874 1.874 0 0 1 .215 1.673l-2.098 6.4C17.538 19.52 17.368 20 16.12 20c-2.303 0-4.79-.943-6.67-1.475" />
                                            </svg>

                                            {{ $blog->likers->count() }}
                                        </span>
                                    </div>
                                    <div class="col-6 col-lg-auto d-flex align-items-center mt-2 mt-lg-0">
                                        <svg width="24" height="24" viewBox="0 0 40 31" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1.65137 15.7862C1.65137 15.7862 8.26253 2.59534 19.8321 2.59534C31.4016 2.59534 38.0128 15.7862 38.0128 15.7862C38.0128 15.7862 31.4016 28.977 19.8321 28.977C8.26253 28.977 1.65137 15.7862 1.65137 15.7862Z"
                                                stroke="black" stroke-width="3.30557" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M19.8334 20.7327C22.5718 20.7327 24.7917 18.5181 24.7917 15.7862C24.7917 13.0543 22.5718 10.8396 19.8334 10.8396C17.0949 10.8396 14.875 13.0543 14.875 15.7862C14.875 18.5181 17.0949 20.7327 19.8334 20.7327Z"
                                                stroke="black" stroke-width="3.30557" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <span class="ms-2 fs-5"
                                            style="color: var(--text_color)">{{ $blog->views }}</span>
                                    </div>
                                    <div class="col-6 col-lg-auto d-flex align-items-center mt-2 mt-lg-0">
                                        <svg width="24" height="24" viewBox="0 0 30 31" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M21.9982 28.9273L29.8891 30.6812L28.1353 22.7903C29.2903 20.6298 29.8928 18.2172 29.8891 15.7674C29.8891 7.53044 23.2122 0.853516 14.9753 0.853516C6.73839 0.853516 0.0614586 7.53044 0.0614586 15.7674C0.0614586 24.0043 6.73839 30.6812 14.9753 30.6812C17.4251 30.6849 19.8378 30.0824 21.9982 28.9273ZM21.5657 25.776L20.5919 26.298C18.864 27.2214 16.9344 27.7025 14.9753 27.6984C12.6156 27.6984 10.3088 26.9987 8.34675 25.6877C6.3847 24.3767 4.85546 22.5133 3.95243 20.3332C3.04939 18.1531 2.81311 15.7541 3.27348 13.4397C3.73384 11.1253 4.87016 8.99941 6.53876 7.33081C8.20735 5.66222 10.3333 4.5259 12.6477 4.06554C14.9621 3.60517 17.361 3.84145 19.5411 4.74448C21.7212 5.64752 23.5846 7.17675 24.8956 9.13881C26.2066 11.1009 26.9064 13.4076 26.9064 15.7674C26.9064 17.7569 26.4217 19.6718 25.5045 21.3839L24.984 22.3578L25.9608 26.7529L21.5657 25.776Z"
                                                fill="black" />
                                        </svg>
                                        <span class="ms-2 fs-5" style="color: var(--text_color)">
                                            {{ $blog->comments->count() }}</span>
                                    </div>
                                    <div class="col-6 col-lg-auto d-flex align-items-center mt-2 mt-lg-0">
                                        <svg width="24" height="24" viewBox="0 0 30 36" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M27.4143 35.8381H3.17344C1.95479 35.8381 0.969727 34.853 0.969727 33.6365V11.5972C0.969727 10.3807 1.95479 9.39348 3.17344 9.39348H6.47902V11.5972H4.2753C3.66708 11.5972 3.17344 12.093 3.17344 12.6991V32.5325C3.17344 33.1429 3.66708 33.6365 4.2753 33.6365H26.3125C26.9185 33.6365 27.4143 33.1429 27.4143 32.5325V12.6991C27.4143 12.093 26.9185 11.5972 26.3125 11.5972H24.1087V9.39348H27.4143C28.6308 9.39348 29.618 10.3807 29.618 11.5972V33.6365C29.618 34.853 28.6308 35.8381 27.4143 35.8381ZM20.0672 7.97634L16.3957 4.30492V25.9213C16.3957 26.5296 15.8999 27.0232 15.2939 27.0232C14.6857 27.0232 14.192 26.5296 14.192 25.9213V4.30492L10.5184 7.97634C10.0997 8.39725 9.41645 8.39725 8.99774 7.97634C8.57904 7.55984 8.57904 6.87456 8.99774 6.45806L14.4411 1.01252C14.4477 1.00371 14.4609 0.999549 14.4675 0.990734C14.4917 0.962086 14.483 0.920118 14.5095 0.89147C14.5513 0.851803 14.6106 0.865023 14.6547 0.834171C14.8178 0.701948 15.0073 0.611525 15.2299 0.596099C15.2475 0.596099 15.2631 0.585069 15.2785 0.585069C15.2852 0.585069 15.2894 0.578613 15.296 0.578613C15.3026 0.578613 15.3072 0.582866 15.3138 0.585069C15.327 0.582866 15.3358 0.591795 15.349 0.591795C15.6113 0.605017 15.8491 0.708488 16.032 0.871563C16.0475 0.886989 16.0718 0.8804 16.085 0.893622C16.0983 0.911252 16.0917 0.935546 16.1071 0.948769C16.1159 0.957584 16.1136 0.975142 16.1224 0.986161L21.5922 6.45806C22.0131 6.87456 22.0131 7.55984 21.5922 7.97634C21.1691 8.39946 20.4881 8.39946 20.0672 7.97634Z"
                                                fill="#2A2A2A" />
                                        </svg>
                                        <span class="ms-2 fs-5" style="color: var(--text_color)"> 0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-alice-blue">
            <div class="container-lg">
                <div class="row pt-5">
                    <div class="col-xl-12 px-0">
                        <div class="vBlog-carousel owl-carousel">
                            @foreach ($blogs as $item)
                                <div class="p-5"
                                    style="background-color: rgb(255, 255, 255); border:0.5px solid #eee; border-radius:0.5rem;">
                                    <a href="{{ route('frontend.blog_details', $item->id) }}" class=""
                                        style="color: var(--btn_primary_color); z-index:11">
                                        <img src="{{ $item->image_show }}" alt=""
                                            style="width: 150px !important; height:80px !important; border-radius:0.5rem;margin-bottom:1rem;">
                                        <span class="fs-5 fw-medium">
                                            {{ \Illuminate\Support\Str::limit($item->title, 35, '...') }}
                                        </span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-alice-blue py-5">
            <div class="container-lg">
                <div class="bg-white rounded justify-content-center row py-5">
                    <div class="col-xl-10">
                        <div class="card border-0 rounded-0 mb-3">
                            <div class="card-body py-0">
                                <div class="section-header mb-4">
                                    <h5 class="fs-2 fw-bold" style="color: var(--text_color)">Leave comment:</h5>
                                </div>
                                {{-- @if (Auth::check()) --}}
                                <form action="{{ route('frontend.blog_comment') }}" method="post">
                                    @csrf
                                    <div class="align-items-center input-group">
                                        <input type="hidden" name="blog_id" value="{{ $blog->id }}" />

                                        <textarea class="bg-white form-control pe-5 box rounded" name="content" cols="30" rows="2"></textarea>
                                        <button class="btn btn-send end-0 position-absolute px-2 rounded-2 border-0"
                                            type="submit">
                                            <svg width="25" height="25" viewBox="0 0 44 38" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M41.1669 2L20.0835 20.6558" stroke="#A5A5A5"
                                                    stroke-width="3.83333" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M41.1669 2L27.7502 35.9204L20.0835 20.6562L2.8335 13.8721L41.1669 2Z"
                                                    stroke="#A5A5A5" stroke-width="3.83333" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </button>

                                    </div>
                                </form>
                                {{-- @else
							
							@endif --}}


                                @foreach ($blog->comments as $comment)
                                    <div class="load-comments"></div>
                                    <div class="d-block py-5 border-bottom">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="img-user width_55p">
                                                <img src="" class="rounded-circle img-fluid" alt="">
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="mb-1 fs-5" style="color: var(--text_color)">
                                                    {{ $comment->user->name ?? '' }}</h6>
                                                <p class="fs-15 mb-0 text-muted" style="color: var(--text_color)">
                                                    {{ $comment->content }}</p>
                                                <p class="fs-15 mb-0 text-muted" style="color: var(--text_color)">
                                                    {{ $comment->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <p class="font_open fs-5 text-muted"></p>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            $(document).ready(function() {
                // Handle like button click
                $('.like-btn').on('click', function() {
                    var blogId = $(this).data('blog-id');
                    toggleLike(blogId, this);
                });

                // Handle unlike button click
                $('.unlike-btn').on('click', function() {
                    var blogId = $(this).data('blog-id');
                    toggleLike(blogId, this);
                });
                // toggleLike();
                function toggleLike(blogId, arg) {
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('blog_like/') }}/' + blogId + '/toggle-like',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            console.log(data.message);
                            if (data == 1) {
                                $(arg).html(`
                                <svg aria-hidden="true" class="like-btn"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" viewBox="0 0 24 24" style="width: 35px; height:35px; fill:black;">
                                    <path fill-rule="evenodd"
                                        d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z"
                                        clip-rule="evenodd" />
                                </svg>
                                `);
                            } else {
                                $(arg).html(`
                                <svg aria-hidden="true" class="like-btn"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" viewBox="0 0 24 24" style="width: 35px; height:35px; fill:black;">
                                    <path fill-rule="evenodd"
                                        d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z"
                                        clip-rule="evenodd" />
                                </svg>
                                `);
                            }
                        },
                        error: function(error) {
                            console.error('Error toggling like: ', error);
                        }
                    });
                }
            });
        </script>

    </div>
    <!--======== main content close ==========-->


    @include('Frontend.layouts.parts.news-letter')

@endsection
