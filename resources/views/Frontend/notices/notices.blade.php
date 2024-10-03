@extends('Frontend.layouts.master-layout')
@section('title', ' - All Notices')
@section('head')
    {{-- <style>
        .single-notice {
            border: 1px solid #eee;
            border-radius: 8px;
            transition: 0.45s;
        }

        .single-notice a {
            color: var(--primary_background);
            font-weight: 500;
            transition: 0.45s;
        }

        .single-notice:hover {
            background-color: #f5fff7
        }

        .single-notice:hover>a {
            color: var(--secondary_background);
        }
    </style> --}}

    <style>
        .blog-card {
            border-radius: 8px;
            overflow: hidden;
            transition: 0.35s;
            cursor: pointer;
            /* border: 1px solid #efefef; */
        }

        .blog-card:hover {
            box-shadow: 0px 0px 20px -10px rgb(120 200 159);
        }

        .blog-title {
            font-weight: bold !important;
            color: var(--secondary_background);
            font-size: 20px;
        }

        .latest-date {
            background-color: var(--primary_background);
            border-radius: 50%;
            height: 50px;
            width: 50px;
        }

        .latest-date span {
            color: #fff;
            font-size: 1.75rem;
            font-weight: 700;
        }

        .latest-month {
            margin: 8px auto 0;
            text-align: center;
        }

        .latest-month span {
            font-size: 1rem;
            font-weight: 600;
        }
    </style>
@endsection
@section('main_content')

    <div class="content_search" style="margin-top:70px">
        <div class="" style="margin-top: 7rem; margin-bottom:3rem">
            <div class="container-lg">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="row mx-0 align-items-center justify-content-center">
                            <div class="col-md-10">
                                <h2 class="h3 mb-4 mb-sm-5 text-center" style="font-weight: bold">Notices From
                                    {{ env('APP_NAME') }}
                                </h2>

                                @if (!empty($notices))
                                    <div class="row">
                                        @foreach ($notices as $notice)
                                            {{-- <div class="col-12 col-lg-6 p-2 single-notice">
                                                <a href="{{ route('landing_page.show_page', ['slug' => $notice->slug]) }}"
                                                    style="font-size: 1rem;">
                                                    {{ $notice->title }}
                                                </a>
                                            </div> --}}
                                            <div class="col-12 col-lg-6 row justify-content-between px-0 py-3 my-2 blog-card"
                                                onclick="location.href='{{ route('landing_page.show_page', ['slug' => $notice->slug]) }}'">
                                                <div class="col-2">
                                                    <div
                                                        class="mx-auto latest-date d-flex justify-content-center align-items-center">
                                                        <span>{{ \Carbon\Carbon::parse($notice->created_at)->format('d') }}</span>
                                                    </div>
                                                    <div class="mx-auto latest-month">
                                                        <span>{{ \Carbon\Carbon::parse($notice->created_at)->format('M') }}</span>
                                                    </div>
                                                </div>

                                                <div class="col-10">
                                                    <h4 class="blog-title">
                                                        {{ Illuminate\Support\Str::limit($notice->title, 100, '...') }}
                                                    </h4>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-center">
                                        No Notice Available!
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('Frontend.layouts.parts.news-letter')

@endsection
