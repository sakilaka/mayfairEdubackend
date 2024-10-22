@extends('Frontend.layouts.master-layout')
@section('title', ' - Service details ')
@section('head')
    <style>
        .content_search {
            margin-top: 5rem;
        }

        .img_style {
            width: 60%;
            height: 500px;
        }

        .border {
            border: 1px solid black;
            border-radius: 5px;
        }

        .fs {
            padding-left: 20px;
            padding-right: 20px;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('frontend/ckeditor5-rendered.css') }}">
@endsection
@section('main_content')

    <div class="content_search">
        <div class="container p-4 border">
            <h1 class="text-center">{{ $serviceDetails['title'] }}</h1>

            <div class="mt-5 ckeditor5-rendered">
                {!! $serviceDetails['long_description'] ?? 'No description' !!}
            </div>
        </div>

        @include('Frontend.layouts.parts.news-letter')
    </div>


@endsection
