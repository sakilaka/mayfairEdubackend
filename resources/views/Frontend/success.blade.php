@extends('Frontend.layouts.master-layout')
@section('title', ' - All Universities')
@section('main_content')


<div class="main-panel">

    <div class="mt-5 pt-5 d-flex flex-column justify-content-center align-items-center">
        <img src="{{ asset('frontend/images/done.png') }}" alt="" width="80px">
        <h5 class="text-center mt-3">Successfully Submitted</h5>

        <a href="{{ route('apply_admission_university') }}" class="mt-2 btn btn-primary-bg">
            Submit another application.
        </a>
    </div>
</div>
@endsection