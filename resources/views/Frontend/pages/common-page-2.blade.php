@extends('Frontend.layouts.master-layout')
@section('title', ' - ' . $page->title)
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

        .details-text-container p {
            color: rgba(16, 24, 40, 0.6);
            font-size: 1rem;
        }

        .page-banner {
            position: relative;
            height: 10rem;
            width: 100%;
            background-image: url('{{ json_decode($page->contents, true)["banner"] ?? asset('frontend/images/why-china.jpg') }}');
            background-position: bottom;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-bottom: 2rem;
        }

        .page-banner::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgb(0 29 18 / 70%) 0%, rgb(15 29 65 / 35%) 100%);
            pointer-events: none;
            z-index: 1;
        }

        .page-banner-title {
            margin: 0;
            z-index: 9;
            white-space: nowrap;
        }

        @media screen and (min-width:768px) {
            .page-banner {
                height: 12.5rem;
            }
        }

        @media screen and (min-width:992px) {
            .page-banner {
                height: 14rem;
            }
        }

        @media screen and (min-width:1200px) {
            .page-banner {
                height: 16.75rem;
            }
        }
    </style>
@endsection
@section('main_content')

    <div class="content_search">
        <div class="page-banner">
            <h2 class="page-banner-title py-2 fw-bold text-center text-capital py-5" style="color: #fff; letter-spacing:2px;">
                {{ $page->title }}
            </h2>
        </div>

        <div class="container">
            <div class="details-text-container ckeditor5-rendered">
                {!! json_decode($page->contents, true)['descriptions'] ?? '' !!}
            </div>
        </div>
        @include('Frontend.layouts.parts.news-letter')

    @endsection
