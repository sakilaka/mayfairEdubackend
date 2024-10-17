@extends('Frontend.layouts.master-layout')
@section('title', ' - Exhibitor Details of ' . $exhibitor->name)
@section('head')

@endsection
@section('main_content')

    <div class="content_search" style="margin-top:70px">
        <div class="" style="margin-top: 7rem; margin-bottom:3rem">
            <div class="container-lg">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <h2 class="h3 mb-4 mb-sm-5 text-center" style="font-weight: bold">{{ $exhibitor->name ?? '' }}</h2>

                        <div class="row mx-0 align-items-center justify-content-center border-md rounded-3">
                            <div class="col-md-10 p-4 p-sm-5">
                                @if ($exhibitor->exhibitor_desc)
                                    {!! $exhibitor->exhibitor_desc !!}
                                @else
                                    <p class="text-center">
                                        No Content Found
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
