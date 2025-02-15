@extends('Frontend.layouts.master-layout')
@section('title', ' - Exhibitor Details of ' . $exhibitor->name)
@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/ckeditor5-rendered.css') }}">
@endsection
@section('main_content')

    <div class="content_search" style="margin-top:70px">
        <div class="" style="margin-top: 7rem; margin-bottom:3rem">
            <div class="container-lg">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <h2 class="h3 mb-4 mb-sm-5 text-center" style="font-weight: bold">{{ $exhibitor->name ?? '' }}</h2>

                        <div class="row mx-0 align-items-center justify-content-center rounded-3">
                            <div class="col-md-10 {{-- p-4 p-sm-5 --}} ckeditor5-rendered">
                                @if ($type === 'main')
                                    {!! $exhibitor->exhibitor_desc ?? 'No Content Found!' !!}
                                @elseif ($type === 'site')
                                    {!! $exhibitor->exhibitor_site_desc ?? 'No Content Found!' !!}
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
