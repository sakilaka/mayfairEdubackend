@extends('Frontend.layouts.master-layout')
@section('title', ' - ' . $page->title)
@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/ckeditor5-rendered.css') }}">
@endsection
@section('main_content')

    <div class="content_search" style="margin-top:70px">
        <div class="" style="margin-top: 7rem; margin-bottom:3rem">
            <div class="container-lg">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="row mx-0 align-items-center justify-content-center border-md rounded-3">
                            <div class="col-md-10 p-4 p-sm-5">
                                {{-- <h2 class="h3 mb-4 mb-sm-5" style="font-weight: bold">{{ $page->title ?? '' }}</h2> --}}
                                <div class="ckeditor5-rendered">
                                    {!! $page->content ?? '' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('Frontend.layouts.parts.news-letter')

@endsection
