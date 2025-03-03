@extends('Frontend.layouts.master-layout-app')
@section('title', ' - Apply Success.')
@section('main_content')


<div class="main-panel">

    <div class="pt-5 d-flex flex-column justify-content-center align-items-center" style="margin-top: 100px;">
        <img src="{{ asset('frontend/images/done.png') }}" alt="" width="80px">
        <h5 class="text-center mt-3">Successfully Submitted</h5>

        <a href="{{ env('FRONTEND_URL') }}" class="mt-2 btn btn-primary-bg">
            Return To Home Page
        </a>
    </div>
</div>
@endsection
