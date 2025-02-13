<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    {{-- <link rel="stylesheet" href="{{ asset('backend/assets/vendors/summernote/dist/summernote-bs4.css') }}"> --}}
    <title>{{ env('APP_NAME') }} | Home Content Setup</title>
</head>

<body>
    <div class="container-scroller">
        @include('Backend.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('Backend.components.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            {{ __('Home Content Setup') }}
                        </h3>
                    </div>

                    <div class="row">
                        <div class="card card-body col-md-12">
                            <div class="rounded">
                                <div class="card-header" data-toggle="collapse" data-target="#collapseContent">
                                    <h5 class="card-title mb-0 py-2">
                                        <i class="fa fa-solid fa-plus"></i>
                                        Banner Section
                                    </h5>
                                </div>
                                <div class="collapse" id="collapseContent">
                                    <form action="{{ route('backend.home_banner_section.update') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row my-3">
                                            <div class="col-md-6 col-lg-4">
                                                <label class="form-control-label">Select Banner Type:</label>
                                                <select name="banner_type" class="form-control form-control-lg"
                                                    id="bannerTypeSelect">
                                                    <option value="photo"
                                                        {{ $home_content->banner_type == 'photo' ? 'selected' : '' }}>
                                                        Photo</option>
                                                    <option value="video"
                                                        {{ $home_content->banner_type == 'video' ? 'selected' : '' }}>
                                                        Video</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row my-3" id="banner_video_type" style="display: none">
                                            <div class="col-12 d-flex justify-content-between">
                                                <h5 class="d-inline">Video</h5>
                                            </div>

                                            <div class="col-sm-12 col-md-6 mt-3">
                                                <label class="form-control-label">Banner
                                                    Video:</label>
                                                <div class="dropify-wrapper" style="border: none">
                                                    <div class="dropify-loader"></div>
                                                    <div class="dropify-errors-container">
                                                        <ul></ul>
                                                    </div>
                                                    <input type="file" class="dropify" name="banner_video[]"
                                                        id="video_upload">
                                                    <button type="button" class="dropify-clear">Remove</button>
                                                    <div class="dropify-preview">
                                                        <span class="dropify-render"></span>
                                                        <div class="dropify-infos">
                                                            <div class="dropify-infos-inner">
                                                                <p class="dropify-filename">
                                                                    <span class="file-icon"></span>
                                                                    <span class="dropify-filename-inner"></span>
                                                                </p>
                                                                <p class="dropify-infos-message">
                                                                    Drag
                                                                    and drop or click to
                                                                    replace</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="col-sm-12 col-md-5 d-flex justify-content-center align-items-center">
                                                <div class="px-3 mt-3">
                                                    <video id="video_preview"
                                                        src="{{ json_decode($home_content->banner_video)[0] ?? '' }}"
                                                        width="320" height="240" controls
                                                        style="border-radius: 8px"></video>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="row my-4" id="banner_photo_type" style="display: none">
                                            <div class="col-sm-12 mt-3">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="d-inline">Photos</h5>
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary"
                                                        id="add-banner-image">
                                                        <i class="fa fa-plus"></i>
                                                        Add
                                                    </a>
                                                </div>

                                                <div class="mg-t-10 mg-sm-t-0 banner-image-container">
                                                    @php
                                                        $hero_content = json_decode($home_content->hero_content, true);
                                                        $random = rand(10000, 90000);
                                                    @endphp

                                                    @if (empty($hero_content))

                                                        <div class="row mt-4 mb-4">
                                                            <div class="col-sm-12">
                                                                <label class=" form-control-label">Banner Short Text:<span
                                                                        class="tx-danger"></span></label>
                                                                <div class="mg-t-10 mg-sm-t-0">
                                                                    <input type="text"
                                                                        class="form-control form-control-lg"
                                                                        name="hero_content[{{ $random }}][banner_short_text]"
                                                                        value="">
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        </div>

                                                        <div class="row mt-4 mb-4">
                                                            <div class="col-sm-12">
                                                                <label class=" form-control-label">Banner Text:<span
                                                                        class="tx-danger"></span></label>
                                                                <div class="mg-t-10 mg-sm-t-0">
                                                                    <input type="text"
                                                                        class="form-control form-control-lg"
                                                                        name="hero_content[{{ $random }}][banner_text]"
                                                                        value="">
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        </div>

                                                        <div class="row mt-4 mb-4">
                                                            <div class="col-sm-12">
                                                                <label class=" form-control-label">Button Url:<span
                                                                        class="tx-danger"></span></label>
                                                                <div class="mg-t-10 mg-sm-t-0">
                                                                    <input type="text"
                                                                        class="form-control form-control-lg"
                                                                        name="hero_content[{{ $random }}][button_url]"
                                                                        value="">
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        </div>

                                                        <div class="d-flex align-items-center mt-2 row">
                                                            <div class="col-12 mt-3 form-group">
                                                                <label for="">Image URL</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Enter Image Redirection URL"
                                                                    name="hero_content[{{ $random }}][image_url]">
                                                            </div>

                                                            <div class="col-sm-12 col-md-6 img-upload-container">
                                                                <label class="form-control-label">Add Banner
                                                                    Image:</label>
                                                                <div class="dropify-wrapper" style="border: none">
                                                                    <div class="dropify-loader"></div>
                                                                    <div class="dropify-errors-container">
                                                                        <ul></ul>
                                                                    </div>
                                                                    <input type="file" class="dropify"
                                                                        name="hero_content[{{ $random }}][banner_image]"
                                                                        accept="image/*">
                                                                    <button type="button"
                                                                        class="dropify-clear">Remove</button>
                                                                    <div class="dropify-preview">
                                                                        <span class="dropify-render"></span>
                                                                        <div class="dropify-infos">
                                                                            <div class="dropify-infos-inner">
                                                                                <p class="dropify-filename">
                                                                                    <span class="file-icon"></span>
                                                                                    <span
                                                                                        class="dropify-filename-inner"></span>
                                                                                </p>
                                                                                <p class="dropify-infos-message">
                                                                                    Drag and drop or click
                                                                                    to replace</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="img-preview-container col-sm-11 col-md-5 d-flex justify-content-center align-items-center">
                                                                <div class="px-3 mt-3">
                                                                    <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                                                        alt="" class="img-fluid"
                                                                        style="border-radius: 10px; max-height: 200px !important;">
                                                                </div>
                                                            </div>
                                                            <div class="col-1">
                                                                <a href="javascript:void(0)"
                                                                    class="remove-banner-image btn btn-danger btn-sm m-0 ml-2">
                                                                    <i class="fas fa-minus-circle"> </i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @else
                                                        @foreach ($hero_content as $key => $item)
                                                            <div>
                                                                <div class="row mt-4 mb-4">
                                                                <div class="col-sm-12">
                                                                    <label class="form-control-label">Banner short Text:<span
                                                                            class="tx-danger"></span></label>
                                                                    <div class="mg-t-10 mg-sm-t-0">
                                                                        <input type="text"
                                                                            class="form-control form-control-lg"
                                                                            name="hero_content[{{ $key }}][banner_short_text]"
                                                                            value="{{ $item['banner_short_text'] ?? '' }}">
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                            </div>
                                                            <div class="row mt-4 mb-4">
                                                                <div class="col-sm-12">
                                                                    <label class="form-control-label">Banner Text:<span
                                                                            class="tx-danger"></span></label>
                                                                    <div class="mg-t-10 mg-sm-t-0">
                                                                        <input type="text"
                                                                            class="form-control form-control-lg"
                                                                            name="hero_content[{{ $key }}][banner_text]"
                                                                            value="{{ $item['banner_text'] ?? '' }}">
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                            </div>

                                                            <div class="row mt-4 mb-4">
                                                                <div class="col-sm-12">
                                                                    <label class="form-control-label">Button Url:<span
                                                                            class="tx-danger"></span></label>
                                                                    <div class="mg-t-10 mg-sm-t-0">
                                                                        <input type="text"
                                                                            class="form-control form-control-lg"
                                                                            name="hero_content[{{ $key }}][button_url]"
                                                                            value="{{ $item['button_url'] ?? '' }}">
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                            </div>

                                                            <div class="d-flex align-items-center mt-2 row">
                                                                <div class="col-12 mt-3 form-group">
                                                                    <label for="">Image URL</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Enter Image Redirection URL"
                                                                        name="hero_content[{{ $key }}][image_url]"
                                                                        value="{{ $item['image_url'] ?? '' }}">
                                                                </div>

                                                                <div class="col-sm-12 col-md-6 img-upload-container">
                                                                    <label class="form-control-label">Update Banner
                                                                        Image:</label>
                                                                    <div class="dropify-wrapper" style="border: none">
                                                                        <div class="dropify-loader"></div>
                                                                        <div class="dropify-errors-container">
                                                                            <ul></ul>
                                                                        </div>
                                                                        <input type="file" class="dropify"
                                                                            name="hero_content[{{ $key }}][banner_image]"
                                                                            accept="image/*"
                                                                            data-default-file="{{ asset($item['banner_image']) ?? asset('frontend/images/No-image.jpg') }}">
                                                                        <!-- Add hidden input for old image -->
                                                                        <input type="hidden"
                                                                            name="hero_content[{{ $key }}][old_banner_image]"
                                                                            value="{{ $item['banner_image'] ?? '' }}">
                                                                        <button type="button"
                                                                            class="dropify-clear">Remove</button>
                                                                        <div class="dropify-preview">
                                                                            <span class="dropify-render"></span>
                                                                            <div class="dropify-infos">
                                                                                <div class="dropify-infos-inner">
                                                                                    <p class="dropify-filename">
                                                                                        <span class="file-icon"></span>
                                                                                        <span
                                                                                            class="dropify-filename-inner"></span>
                                                                                    </p>
                                                                                    <p class="dropify-infos-message">
                                                                                        Drag and drop or click to
                                                                                        replace
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="img-preview-container col-sm-11 col-md-5 d-flex justify-content-center align-items-center">
                                                                    <div class="px-3 mt-3">
                                                                        <img src="{{ $item['banner_image'] ?? asset('frontend/images/No-image.jpg') }}"
                                                                            alt="" class="img-fluid"
                                                                            style="border-radius: 10px; max-height: 200px !important;">
                                                                    </div>
                                                                </div>
                                                                <div class="col-1">
                                                                    <a href="javascript:void(0)"
                                                                        class="remove-banner-image btn btn-danger btn-sm m-0 ml-2">
                                                                        <i class="fas fa-minus-circle"> </i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                </div>
                                            </div>
                                        </div>



                                        <div class="row mt-4">
                                            <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-center">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="mt-3 rounded">
                                <div class="card-header" data-toggle="collapse"
                                    data-target="#university_location_section">
                                    <h5 class="card-title mb-0 py-2">
                                        <i class="fa fa-solid fa-plus"></i>
                                        University Location Section
                                    </h5>
                                </div>
                                <div class="collapse" id="university_location_section">
                                    <form action="{{ route('backend.home_location_section.update') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row mt-4">
                                                <div class="col-sm-12 ">
                                                    <label class=" form-control-label">University Location Title:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->university_location_title ?? '' }}"
                                                            name="university_location_title" class="form-control"
                                                            placeholder="Enter Location Title" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <label class=" form-control-label mt-4">
                                                Location:
                                                <span class="tx-danger"></span>
                                            </label>
                                            <div class="col-sm-12 mt-3">
                                                <div class="mg-t-10 mg-sm-t-0 add-data-content">
                                                    @if ($home_content_locations->count() == 0)
                                                        <div class="d-flex align-items-center mt-2 row">
                                                            <div class="col-md-6">
                                                                <label class="form-control-label"><b>Type:</b></label>
                                                                <div class="d-flex  align-items-center">
                                                                    <select class="form-control on_change_u_lo_type"
                                                                        name="type_loction_id[]" required>
                                                                        <option value="">Select type</option>
                                                                        <option value="1">Continent</option>
                                                                        <option value="2">Country</option>
                                                                        <option value="3">Province</option>
                                                                        <option value="4">City</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-5">
                                                                <label
                                                                    class="form-control-label"><b>Location:</b></label>
                                                                <div class="d-flex  align-items-center">
                                                                    <select class="form-control" id="location"
                                                                        name="location_id[]" required>
                                                                        <option value="">Select Location</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <a id="plus-btn-data-content" href="javascript:void(0)"
                                                                class="plus-btn-data-content px-1 p-0 m-0 ml-2"><i
                                                                    class="fas fa-plus"></i></a>
                                                        </div>
                                                    @else
                                                        @foreach ($home_content_locations as $k => $home_content_location)
                                                            <div class="d-flex align-items-center mt-2 row">
                                                                <div class="col-md-6">
                                                                    <label
                                                                        class="form-control-label"><b>Type:</b></label>
                                                                    <div class="d-flex align-items-center">
                                                                        <select
                                                                            class="form-control form-control-lg on_change_u_lo_type"
                                                                            name="old_type_loction_id[{{ $home_content_location->id }}]"
                                                                            required>
                                                                            <option value="">Select type</option>
                                                                            <option
                                                                                @if ($home_content_location->type_loction_id == '1') selected @endif
                                                                                value="1">Continent</option>
                                                                            <option
                                                                                @if ($home_content_location->type_loction_id == '2') selected @endif
                                                                                value="2">Country</option>
                                                                            <option
                                                                                @if ($home_content_location->type_loction_id == '3') selected @endif
                                                                                value="3">Province</option>
                                                                            <option
                                                                                @if ($home_content_location->type_loction_id == '4') selected @endif
                                                                                value="4">City</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-5">
                                                                    <label
                                                                        class="form-control-label"><b>Location:</b></label>
                                                                    <div class="d-flex  align-items-center">
                                                                        <select class="form-control form-control-lg"
                                                                            id="location"
                                                                            name="old_location_id[{{ $home_content_location->id }}]"
                                                                            required>
                                                                            <option value="">Select Location
                                                                            </option>
                                                                            @if ($home_content_location->type_loction_id == '1')
                                                                                @foreach ($continents as $continent)
                                                                                    <option
                                                                                        @if ($continent->id == $home_content_location->location_id) selected @endif
                                                                                        value="{{ $continent->id }}">
                                                                                        {{ $continent->name }}</option>
                                                                                @endforeach
                                                                            @elseif ($home_content_location->type_loction_id == '2')
                                                                                @foreach ($countrys as $country)
                                                                                    <option
                                                                                        @if ($country->id == $home_content_location->location_id) selected @endif
                                                                                        value="{{ $country->id }}">
                                                                                        {{ $country->name }}</option>
                                                                                @endforeach
                                                                            @elseif ($home_content_location->type_loction_id == '3')
                                                                                @foreach ($states as $state)
                                                                                    <option
                                                                                        @if ($state->id == $home_content_location->location_id) selected @endif
                                                                                        value="{{ $state->id }}">
                                                                                        {{ $state->name }}</option>
                                                                                @endforeach
                                                                            @elseif ($home_content_location->type_loction_id == '4')
                                                                                @foreach ($citys as $city)
                                                                                    <option
                                                                                        @if ($city->id == $home_content_location->location_id) selected @endif
                                                                                        value="{{ $city->id }}">
                                                                                        {{ $city->name }}</option>
                                                                                @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                @if ($k == $home_content_locations->count() - 1)
                                                                    <a id="plus-btn-data-content"
                                                                        href="javascript:void(0)"
                                                                        class="plus-btn-data-content px-1 p-0 m-0 ml-2"><i
                                                                            class="fas fa-plus"></i></a>
                                                                @else
                                                                    <a home_content_location_id="{{ $home_content_location->id }}"
                                                                        href="javascript:void(0)"
                                                                        class="minus-btn-data-old-audio px-1 p-0 m-0 ml-2"><i
                                                                            class="fas fa-minus-circle"></i></a>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-center">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="mt-3 rounded">
                                <div class="card-header" data-toggle="collapse"
                                    data-target="#collapseContent_university">
                                    <h5 class="card-title mb-0 py-2">
                                        <i class="fa fa-solid fa-plus"></i>
                                        University Section
                                    </h5>
                                </div>
                                <div class="collapse" id="collapseContent_university">
                                    <form action="{{ route('backend.home_university_section.update') }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">

                                            <div class="row mt-4">
                                                <div class="col-sm-12 ">
                                                    <label class=" form-control-label">University Title:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->university_title ?? '' }}"
                                                            name="sub_banner_title" class="form-control"
                                                            placeholder="Enter Title" required>
                                                    </div>
                                                </div>

                                                <div class="img-upload-container col-sm-12 col-md-6 mt-3">
                                                    <label class="form-control-label">Background Image:</label>
                                                    <div class="dropify-wrapper" style="border: none">
                                                        <div class="dropify-loader"></div>
                                                        <div class="dropify-errors-container">
                                                            <ul></ul>
                                                        </div>
                                                        <input type="file" class="dropify" name="university_image"
                                                            accept="image/*" id="university_image_upload">
                                                        <button type="button" class="dropify-clear">Remove</button>
                                                        <div class="dropify-preview">
                                                            <span class="dropify-render"></span>
                                                            <div class="dropify-infos">
                                                                <div class="dropify-infos-inner">
                                                                    <p class="dropify-filename">
                                                                        <span class="file-icon"></span>
                                                                        <span class="dropify-filename-inner"></span>
                                                                    </p>
                                                                    <p class="dropify-infos-message">
                                                                        Drag and drop or click to replace
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="img-preview-container col-sm-12 col-md-5 d-flex justify-content-center align-items-center">
                                                    <div class="px-3 mt-3">
                                                        <img src="{{ $home_content->university_image_show ?? asset('frontend/images/No-image.jpg') }}"
                                                            alt="" class="img-fluid"
                                                            style="border-radius: 10px; max-height: 200px !important;"
                                                            id="university_image_preview">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-center">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="mt-3 rounded">
                                <div class="card-header" data-toggle="collapse" data-target="#collapseContent_3">
                                    <h5 class="card-title mb-0 py-2">
                                        <i class="fa fa-solid fa-plus"></i>
                                        Course Section
                                    </h5>
                                </div>
                                <div class="collapse" id="collapseContent_3">
                                    <div class="card-body">
                                        <form action="{{ route('backend.home_course_section.update') }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mt-4">
                                                <div class="col-sm-12 ">
                                                    <label class=" form-control-label">Title:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->course_title }}"
                                                            name="course_title" class="form-control"
                                                            placeholder="Enter Title" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-center">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 rounded">
                                <div class="card-header" data-toggle="collapse" data-target="#collapseContent_4">
                                    <h5 class="card-title mb-0 py-2">
                                        <i class="fa fa-solid fa-plus"></i>
                                        Partner Section
                                    </h5>
                                </div>
                                <div class="collapse" id="collapseContent_4">
                                    <div class="card-body">
                                        <form action="{{ route('backend.home_partner_section.update') }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mt-4">
                                                <div class="col-sm-12 ">
                                                    <label class=" form-control-label">Title:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->partner_title }}"
                                                            name="partner_title" class="form-control"
                                                            placeholder="Enter Title" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-center">
                                                    <button type="submit" class="btn btn-primary ">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 rounded">
                                <div class="card-header" data-toggle="collapse" data-target="#collapseContent_5">
                                    <h5 class="card-title mb-0 py-2">
                                        <i class="fa fa-solid fa-plus"></i>
                                        Learn Anything Section
                                    </h5>
                                </div>
                                <div class="collapse" id="collapseContent_5">
                                    <form action="{{ route('backend.home_learn_section.update') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row mt-4">
                                                <div class="col-sm-12 col-md-6 mt-3">
                                                    <label class="form-control-label">Image:</label>
                                                    <div class="dropify-wrapper" style="border: none">
                                                        <div class="dropify-loader"></div>
                                                        <div class="dropify-errors-container">
                                                            <ul></ul>
                                                        </div>
                                                        <input type="file" class="dropify" name="learn_image"
                                                            accept="image/*" id="learn_image_upload">
                                                        <button type="button" class="dropify-clear">Remove</button>
                                                        <div class="dropify-preview">
                                                            <span class="dropify-render"></span>
                                                            <div class="dropify-infos">
                                                                <div class="dropify-infos-inner">
                                                                    <p class="dropify-filename">
                                                                        <span class="file-icon"></span>
                                                                        <span class="dropify-filename-inner"></span>
                                                                    </p>
                                                                    <p class="dropify-infos-message">
                                                                        Drag and drop or click to replace
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-sm-12 col-md-5 d-flex justify-content-center align-items-center">
                                                    <div class="px-3 mt-3">
                                                        <img src="{{ $home_content->learn_image_show ?? asset('frontend/images/No-image.jpg') }}"
                                                            alt="" class="img-fluid"
                                                            style="border-radius: 10px; max-height: 200px !important;"
                                                            id="learn_image_preview">
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 mt-4">
                                                    <label class=" form-control-label">Title:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <textarea type="text" name="learn_title" class="form-control editor">{{ $home_content->learn_title }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($learn_texts->count() == 0)
                                                <div class="mt-4">
                                                    <div class="col-sm-12 show-add-tagline-data">
                                                        <div class="d-flex mt-3">
                                                            <div class="" style="padding:10px;width: 97%;">
                                                                <div class="row mt-3">
                                                                    <label class="col-sm-2 mt-3">Title</label>
                                                                    <div class="col-sm-10">
                                                                        <input value="" type="text"
                                                                            name="title[]" class="form-control"
                                                                            placeholder="Enter Title">
                                                                    </div>
                                                                    <label class="col-sm-2 mt-3">URL</label>
                                                                    <div class="col-sm-10 mt-2">
                                                                        <input value="" type="text"
                                                                            name="url[]" class="form-control"
                                                                            placeholder="Enter URL">
                                                                    </div>
                                                                    <label class="col-sm-2 mt-3">Description</label>
                                                                    <div class="col-sm-10 mt-2">
                                                                        <textarea value="" type="text" name="description[]" class="form-control"
                                                                            placeholder="Enter Short Description"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a id="plus-btn-data-tagline" href="javascript:void(0)"
                                                                class="plus-btn-data px-1 p-0 m-0 ml-2"><i
                                                                    class="fas fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                            @else
                                                <div class="add-question-data-show">

                                                    <div class="mt-4">
                                                        <div class="col-sm-12 show-add-tagline-data">
                                                            @foreach ($learn_texts as $k => $learn_text)
                                                                <div class="d-flex mt-3">
                                                                    <div class=""
                                                                        style="padding:10px;width: 97%;">
                                                                        <div class="row mt-3">
                                                                            <label class="col-sm-2 mt-3">Title</label>
                                                                            <div class="col-sm-10">
                                                                                <input
                                                                                    value="{{ $learn_text->title }}"
                                                                                    type="text"
                                                                                    name="title_old[{{ $learn_text->id }}]"
                                                                                    class="form-control"
                                                                                    placeholder="Enter Title">
                                                                            </div>
                                                                            <label class="col-sm-2 mt-3">URL</label>
                                                                            <div class="col-sm-10 mt-2">
                                                                                <input value="{{ $learn_text->url }}"
                                                                                    type="text"
                                                                                    name="url_old[{{ $learn_text->id }}]"
                                                                                    class="form-control"
                                                                                    placeholder="Enter URL">
                                                                            </div>
                                                                            <label
                                                                                class="col-sm-2 mt-3">Description</label>
                                                                            <div class="col-sm-10 mt-2">
                                                                                <textarea type="text" name="description_old[{{ $learn_text->id }}]" class="form-control"
                                                                                    placeholder="Enter Short Description">{{ $learn_text->description }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <label class=" form-control-label"></label>
                                                                    @if ($k == 0)
                                                                        <a id="plus-btn-data-tagline"
                                                                            href="javascript:void(0)"
                                                                            class="plus-btn-data px-1 p-0 m-0 ml-2"><i
                                                                                class="fas fa-plus"></i></a>
                                                                    @else
                                                                        <a learn_id="{{ $learn_text->id }}"
                                                                            href="javascript:void(0)"
                                                                            class="minus-btn-learn-old-data px-1 p-0 m-0 ml-2"><i
                                                                                class="fas fa-minus-circle"></i></a>
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                </div>
                                            @endif

                                            <div class="row mt-4">
                                                <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-center">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="mt-3 rounded">
                                <div class="card-header" data-toggle="collapse" data-target="#collapseContent_6">
                                    <h5 class="card-title mb-0 py-2">
                                        <i class="fa fa-solid fa-plus"></i>
                                        Media Partner Section
                                    </h5>
                                </div>
                                <div class="collapse" id="collapseContent_6">
                                    <div class="card-body">
                                        <form action="{{ route('backend.home_media_partner_section.update') }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mt-4">
                                                <div class="col-sm-12 ">
                                                    <label class=" form-control-label">Title:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->client_title }}"
                                                            name="client_title" class="form-control"
                                                            placeholder="Enter Title" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-center">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 rounded">
                                <div class="card-header" data-toggle="collapse" data-target="#collapseContent_7">
                                    <h5 class="card-title mb-0 py-2">
                                        <i class="fa fa-solid fa-plus"></i>
                                        Counting Section
                                    </h5>
                                </div>
                                <div class="collapse" id="collapseContent_7">
                                    <div class="card-body">
                                        <form action="{{ route('backend.home_counting_section.update') }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mt-4">
                                                <div class="col-sm-12 ">
                                                    <label class=" form-control-label">Title:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->counting_title }}"
                                                            name="counting_title" class="form-control"
                                                            placeholder="Enter Title" required>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 mt-3">
                                                    <label class=" form-control-label">Text 1:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->count_text_1 }}"
                                                            name="count_text_1" class="form-control"
                                                            placeholder="Enter Text 1">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mt-3">
                                                    <label class=" form-control-label">Count Number 1:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->count_num_1 }}"
                                                            name="count_num_1" class="form-control"
                                                            placeholder="Enter Number 1">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mt-3">
                                                    <label class=" form-control-label">Text 2:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->count_text_2 }}"
                                                            name="count_text_2" class="form-control"
                                                            placeholder="Enter Text 2">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mt-3">
                                                    <label class=" form-control-label">Count Number 2:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->count_num_2 }}"
                                                            name="count_num_2" class="form-control"
                                                            placeholder="Enter Number 2">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mt-3">
                                                    <label class=" form-control-label">Text 3:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->count_text_3 }}"
                                                            name="count_text_3" class="form-control"
                                                            placeholder="Enter Text 3">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mt-3">
                                                    <label class=" form-control-label">Count Number 3:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->count_num_3 }}"
                                                            name="count_num_3" class="form-control"
                                                            placeholder="Enter Number 3">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mt-3">
                                                    <label class=" form-control-label">Text 4:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->count_text_4 }}"
                                                            name="count_text_4" class="form-control"
                                                            placeholder="Enter Text 4">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mt-3">
                                                    <label class=" form-control-label">Count Number 4:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->count_num_4 }}"
                                                            name="count_num_4" class="form-control"
                                                            placeholder="Enter Number 4">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-center">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            {{-- <div class="mt-3 rounded">
                                <div class="card-header" data-toggle="collapse" data-target="#collapseContent_8">
                                    <h5 class="card-title mb-0 py-2">
                                        <i class="fa fa-solid fa-plus"></i>
                                        Testimonials Section
                                    </h5>
                                </div>
                                <div class="collapse" id="collapseContent_8">
                                    <form action="{{ route('backend.home_testimonials_section.update') }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">

                                            <div class="row mt-4">
                                                <div class="col-sm-6 ">
                                                    <label class=" form-control-label">Title 1:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->review_title1 }}"
                                                            name="review_title1" class="form-control"
                                                            placeholder="Enter Title" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <label class=" form-control-label">Title 2:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->review_title2 }}"
                                                            name="review_title2" class="form-control"
                                                            placeholder="Enter Title" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-center">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div> --}}

                            <div class="mt-3 rounded">
                                <div class="card-header" data-toggle="collapse" data-target="#collapseContent_10">
                                    <h5 class="card-title mb-0 py-2">
                                        <i class="fa fa-solid fa-plus"></i>
                                        Question Section
                                    </h5>
                                </div>
                                <div class="collapse" id="collapseContent_10">
                                    <form action="{{ route('backend.home_question_section.update') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row mt-4">

                                                <div class="col-sm-12 col-md-6 mt-3">
                                                    <label class="form-control-label">Image:</label>
                                                    <div class="dropify-wrapper" style="border: none">
                                                        <div class="dropify-loader"></div>
                                                        <div class="dropify-errors-container">
                                                            <ul></ul>
                                                        </div>
                                                        <input type="file" class="dropify" name="question_image"
                                                            accept="image/*" id="question_image_upload">
                                                        <button type="button" class="dropify-clear">Remove</button>
                                                        <div class="dropify-preview">
                                                            <span class="dropify-render"></span>
                                                            <div class="dropify-infos">
                                                                <div class="dropify-infos-inner">
                                                                    <p class="dropify-filename">
                                                                        <span class="file-icon"></span>
                                                                        <span class="dropify-filename-inner"></span>
                                                                    </p>
                                                                    <p class="dropify-infos-message">
                                                                        Drag and drop or click to replace
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-sm-12 col-md-5 d-flex justify-content-center align-items-center">
                                                    <div class="px-3 mt-3">
                                                        <img src="{{ $home_content->question_image_show ?? asset('frontend/images/No-image.jpg') }}"
                                                            alt="" class="img-fluid"
                                                            style="border-radius: 10px; max-height: 200px !important;"
                                                            id="question_image_preview">
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 mt-4">
                                                    <label class=" form-control-label">Title:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->question_title }}"
                                                            name="question_title" class="form-control"
                                                            placeholder="Enter Title" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mt-4">
                                                    <label class=" form-control-label">Short Description:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <textarea type="text" name="ques_short_des" class="form-control" placeholder="Enter Title 1">{{ $home_content->ques_short_des }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mt-4">
                                                    <label class=" form-control-label">Button Text:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->question_button_text }}"
                                                            name="question_button_text" class="form-control"
                                                            placeholder="Enter Title 1">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mt-4">
                                                    <label class=" form-control-label">Button URL:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->question_button_url }}"
                                                            name="question_button_url" class="form-control"
                                                            placeholder="Enter Title 1">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-center">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="mt-3 rounded">
                                <div class="card-header" data-toggle="collapse" data-target="#collapseContent_11">
                                    <h5 class="card-title mb-0 py-2">
                                        <i class="fa fa-solid fa-plus"></i>
                                        Register Page Section
                                    </h5>
                                </div>
                                <div class="collapse" id="collapseContent_11">
                                    <div class="card-body">
                                        <form action="{{ route('backend.home_register_section.update') }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mt-4">
                                                <div class="col-sm-12 col-md-6 mt-3">
                                                    <label class="form-control-label">Image:</label>
                                                    <div class="dropify-wrapper" style="border: none">
                                                        <div class="dropify-loader"></div>
                                                        <div class="dropify-errors-container">
                                                            <ul></ul>
                                                        </div>
                                                        <input type="file" class="dropify" name="register_image"
                                                            accept="image/*" id="register_image_upload">
                                                        <button type="button" class="dropify-clear">Remove</button>
                                                        <div class="dropify-preview">
                                                            <span class="dropify-render"></span>
                                                            <div class="dropify-infos">
                                                                <div class="dropify-infos-inner">
                                                                    <p class="dropify-filename">
                                                                        <span class="file-icon"></span>
                                                                        <span class="dropify-filename-inner"></span>
                                                                    </p>
                                                                    <p class="dropify-infos-message">
                                                                        Drag and drop or click to replace
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-sm-12 col-md-5 d-flex justify-content-center align-items-center">
                                                    <div class="px-3 mt-3">
                                                        <img src="{{ $home_content->register_image_show ?? asset('frontend/images/No-image.jpg') }}"
                                                            alt="" class="img-fluid"
                                                            style="border-radius: 10px; max-height: 200px !important;"
                                                            id="register_image_preview">
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 mt-4">
                                                    <label class=" form-control-label">Title:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text"
                                                            value="{{ $home_content->register_title }}"
                                                            name="register_title" class="form-control"
                                                            placeholder="Enter Title" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mt-4">
                                                    <label class=" form-control-label">Short Description:<span
                                                            class="tx-danger"></span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <textarea type="text" name="register_des" class="form-control" placeholder="Enter Short Description">{{ $home_content->register_des }}</textarea>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-center">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 rounded">
                                <div class="card-header" data-toggle="collapse"
                                    data-target="#collapseContent_latest_updates">
                                    <h5 class="card-title mb-0 py-2">
                                        <i class="fa fa-solid fa-plus"></i>
                                        Latest Updates
                                    </h5>
                                </div>
                                <div class="collapse" id="collapseContent_latest_updates">
                                    <div class="card-body">
                                        <form action="{{ route('backend.home_latest_updates.update') }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="d-flex justify-content-between">
                                                <h5>Choose items to show on Latest Updates Section</h5>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-sm btn-primary-bg add-latest-updates">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                    Add
                                                </a>
                                            </div>

                                            <div class="latest-updates-container">
                                                @php
                                                    $latest_updates = json_decode(
                                                        $home_content['latest_updates'],
                                                        true,
                                                    );
                                                @endphp

                                                @if (!empty($latest_updates))
                                                    @foreach ($latest_updates as $latest_update)
                                                        @foreach ($latest_update as $category => $item_id)
                                                            <div class="row align-items-center">
                                                                <div class="col-5 mt-3">
                                                                    <label class="form-control-label">Category:<span
                                                                            class="tx-danger"></span></label>
                                                                    <div class="mg-t-10 mg-sm-t-0">
                                                                        <select name="latest_updates_category[]"
                                                                            class="form-control form-control-lg category-select"
                                                                            required>
                                                                            <option value="">Choose an option
                                                                            </option>
                                                                            <option value="blog"
                                                                                {{ $category == 'blog' ? 'selected' : '' }}>
                                                                                Blog</option>
                                                                            <option value="event"
                                                                                {{ $category == 'event' ? 'selected' : '' }}>
                                                                                Event</option>
                                                                            <option value="expo"
                                                                                {{ $category == 'expo' ? 'selected' : '' }}>
                                                                                Expo</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-5 mt-3">
                                                                    <label class="form-control-label">Item:<span
                                                                            class="tx-danger"></span></label>
                                                                    <div class="mg-t-10 mg-sm-t-0">
                                                                        <select name="latest_updates_item[]"
                                                                            class="form-control form-control-lg item-select"
                                                                            required>
                                                                            @if ($category == 'blog')
                                                                                @foreach ($blogItems as $blog)
                                                                                    <option
                                                                                        value="{{ $blog->id }}"
                                                                                        {{ $item_id == $blog->id ? 'selected' : '' }}>
                                                                                        {{ $blog->title }}
                                                                                    </option>
                                                                                @endforeach
                                                                            @elseif ($category == 'event')
                                                                                @foreach ($eventItems as $event)
                                                                                    <option
                                                                                        value="{{ $event->id }}"
                                                                                        {{ $item_id == $event->id ? 'selected' : '' }}>
                                                                                        {{ $event->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            @elseif ($category == 'expo')
                                                                                @foreach ($expoItems as $expo)
                                                                                    <option
                                                                                        value="{{ $expo->id }}"
                                                                                        {{ $item_id == $expo->id ? 'selected' : '' }}>
                                                                                        {{ $expo->title }}
                                                                                    </option>
                                                                                @endforeach
                                                                            @else
                                                                                <option value="">Choose category
                                                                                    first</option>
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-1 mt-5">
                                                                    <div class="mg-t-10 mg-sm-t-0">
                                                                        <a href="javascript:void(0)"
                                                                            class="btn btn-sm btn-danger remove-row">
                                                                            <i class="fa fa-minus"
                                                                                aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endforeach
                                                @else
                                                    <div class="row align-items-center">
                                                        <div class="col-5 mt-3">
                                                            <label class="form-control-label">Category:<span
                                                                    class="tx-danger"></span></label>
                                                            <div class="mg-t-10 mg-sm-t-0">
                                                                <select name="latest_updates_category[]"
                                                                    class="form-control form-control-lg category-select"
                                                                    required>
                                                                    <option value="">Choose an option</option>
                                                                    <option value="blog">Blog</option>
                                                                    <option value="event">Event</option>
                                                                    <option value="expo">Expo</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-5 mt-3">
                                                            <label class="form-control-label">Item:<span
                                                                    class="tx-danger"></span></label>
                                                            <div class="mg-t-10 mg-sm-t-0">
                                                                <select name="latest_updates_item[]"
                                                                    class="form-control form-control-lg item-select"
                                                                    required>
                                                                    <option value="">Choose category first
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-1 mt-5">
                                                            <div class="mg-t-10 mg-sm-t-0">
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-sm btn-danger remove-row">
                                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-center">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 rounded">
                                <div class="card-header" data-toggle="collapse" data-target="#footer_image_gallery">
                                    <h5 class="card-title mb-0 py-2">
                                        <i class="fa fa-solid fa-plus"></i>
                                        Footer Activity Gallery
                                    </h5>
                                </div>

                                <div class="collapse" id="footer_image_gallery">
                                    <form action="{{ route('backend.home_footer_activity_gallery.update') }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="col-sm-12 mt-3">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="d-inline">Activity Photos</h5>
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary"
                                                        id="add-photo-gallery-image">
                                                        <i class="fa fa-plus"></i>
                                                        Add
                                                    </a>
                                                </div>

                                                <div class="photo-gallery-container">
                                                    @php
                                                        $galleryImages = [];
                                                        $imageTitles = [];
                                                        if (!empty($footer_gallery)) {
                                                            $galleryImages =
                                                                json_decode($footer_gallery['footer_image'], true)[
                                                                    'images'
                                                                ] ?? [];
                                                            $imageTitles =
                                                                json_decode($footer_gallery['footer_image'], true)[
                                                                    'image_titles'
                                                                ] ?? [];
                                                            $imagePosition =
                                                                json_decode($footer_gallery['footer_image'], true)[
                                                                    'image_positions'
                                                                ] ?? [];
                                                        }
                                                    @endphp

                                                    @forelse ($galleryImages as $key => $image)
                                                        <div class="row align-items-center mt-2">

                                                            <div class="col-12 mt-3">
                                                                <div class="form-group">
                                                                    <label>Image Position</label>
                                                                    <input type="text"
                                                                        class="form-control form-control-lg"
                                                                        placeholder="Enter image alt position"
                                                                        name="image_position[{{ $key }}]"
                                                                        value="{{ $imagePosition[$key] ?? '' }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mt-3">
                                                                <div class="form-group">
                                                                    <label>Image Title</label>
                                                                    <input type="text"
                                                                        class="form-control form-control-lg"
                                                                        placeholder="Enter image alt title"
                                                                        name="image_title[{{ $key }}]"
                                                                        value="{{ $imageTitles[$key] ?? '' }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-md-5 img-upload-container">
                                                                <label class="form-control-label">Add
                                                                    Image:</label>
                                                                <div class="dropify-wrapper" style="border: none">
                                                                    <div class="dropify-loader"></div>
                                                                    <div class="dropify-errors-container">
                                                                        <ul></ul>
                                                                    </div>
                                                                    <input type="file" class="dropify"
                                                                        name="photo_gallery_image[{{ $key }}]"
                                                                        accept="image/*">
                                                                    <input type="hidden"
                                                                        name="old_photo_gallery_image[{{ $key }}]"
                                                                        value="{{ $image }}">
                                                                    <button type="button"
                                                                        class="dropify-clear">Remove</button>
                                                                    <div class="dropify-preview">
                                                                        <span class="dropify-render"></span>
                                                                        <div class="dropify-infos">
                                                                            <div class="dropify-infos-inner">
                                                                                <p class="dropify-filename">
                                                                                    <span class="file-icon"></span>
                                                                                    <span
                                                                                        class="dropify-filename-inner"></span>
                                                                                </p>
                                                                                <p class="dropify-infos-message">
                                                                                    Drag
                                                                                    and drop or click to
                                                                                    replace</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="img-preview-container col-sm-12 col-md-6 d-flex justify-content-center align-items-center">
                                                                <div class="px-3 mt-3">
                                                                    <img src="{{ $image ?? asset('frontend/images/No-image.jpg') }}"
                                                                        alt="" class="img-fluid"
                                                                        style="border-radius: 10px; max-height: 200px !important;">
                                                                </div>
                                                            </div>

                                                            <div class="col-1">
                                                                <a href="javascript:void(0)"
                                                                    class="remove-photo-gallery-image btn btn-danger btn-sm m-0 ml-2">
                                                                    <i class="fas fa-minus-circle"> </i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="row align-items-center mt-2">
                                                            @php
                                                                $random = rand(10000, 99999);
                                                            @endphp

                                                            <div class="col-12 mt-3">
                                                                <div class="form-group">
                                                                    <label>Image Position</label>
                                                                    <input type="text"
                                                                        class="form-control form-control-lg"
                                                                        placeholder="Enter image alt position"
                                                                        name="image_position[{{ $random }}]">
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mt-3">
                                                                <div class="form-group">
                                                                    <label>Image Title</label>
                                                                    <input type="text"
                                                                        class="form-control form-control-lg"
                                                                        placeholder="Enter image alt title"
                                                                        name="image_title[{{ $random }}]">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-md-5 img-upload-container">
                                                                <label class="form-control-label">Add
                                                                    Image:</label>
                                                                <div class="dropify-wrapper" style="border: none">
                                                                    <div class="dropify-loader"></div>
                                                                    <div class="dropify-errors-container">
                                                                        <ul></ul>
                                                                    </div>
                                                                    <input type="file" class="dropify"
                                                                        name="photo_gallery_image[{{ $random }}]"
                                                                        accept="image/*">
                                                                    <button type="button"
                                                                        class="dropify-clear">Remove</button>
                                                                    <div class="dropify-preview">
                                                                        <span class="dropify-render"></span>
                                                                        <div class="dropify-infos">
                                                                            <div class="dropify-infos-inner">
                                                                                <p class="dropify-filename">
                                                                                    <span class="file-icon"></span>
                                                                                    <span
                                                                                        class="dropify-filename-inner"></span>
                                                                                </p>
                                                                                <p class="dropify-infos-message">
                                                                                    Drag
                                                                                    and drop or click to
                                                                                    replace</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="img-preview-container col-sm-12 col-md-6 d-flex justify-content-center align-items-center">
                                                                <div class="px-3 mt-3">
                                                                    <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                                                        alt="" class="img-fluid"
                                                                        style="border-radius: 10px; max-height: 200px !important;">
                                                                </div>
                                                            </div>

                                                            <div class="col-1">
                                                                <a href="javascript:void(0)"
                                                                    class="remove-photo-gallery-image btn btn-danger btn-sm m-0 ml-2">
                                                                    <i class="fas fa-minus-circle"> </i>
                                                                </a>
                                                            </div>

                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-center">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                @include('Backend.components.footer')
            </div>
        </div>
    </div>

    @include('Backend.components.script')
    @include('Backend.components.ckeditor5-config')

    <script src="{{ asset('backend/assets/js/dropify.js') }}"></script>

    <script>
        $(document).on('change', `.dropify`, function() {
            var fileInput = $(this)[0];
            var uploadSelector = $(this);

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(uploadSelector).closest('.img-upload-container')
                        .siblings('.img-preview-container')
                        .find('img')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        });

        $('#question_image_upload').on('change', function(e) {
            var fileInput = $(this)[0];

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#question_image_preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        });
        $('#register_image_upload').on('change', function(e) {
            var fileInput = $(this)[0];

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#register_image_preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        });
        $('#learn_image_upload').on('change', function(e) {
            var fileInput = $(this)[0];

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#learn_image_preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        });
    </script>

    <script>
        $('#plus-btn-data-question').on('click', function() {
            var out = '<div class="row">' +
                '<div class="col-sm-5 mt-3">' +
                '<label class=" form-control-label">Button Text:<span class="tx-danger"></span></label>' +
                '<div class="mg-t-10 mg-sm-t-0">' +
                '<input  value="" type="text" name="home_content_ques[]" class="form-control" placeholder="Enter Text">' +
                '</div></div>' +
                ' <div class="col-sm-7 mt-3 d-flex align-items-center ">' +
                '<div style="width: 97%;">' +
                ' <label class=" form-control-label">Button URL:<span class="tx-danger"></span></label>' +
                ' <div class="mg-t-10 mg-sm-t-0">' +
                '<input type="text"  value="" name="home_content_ans[]" class="form-control" placeholder="Enter URL ">' +
                '</div>' +
                '</div><div>' +
                '<label class=" form-control-label"></label>' +
                '<a href="javascript:void(0)" class="minus-btn-question-data px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>' +
                '</div></div></div>';

            $('.add-question-data-show').append(out);

        });
        $(document).on('click', '.minus-btn-question-data', function() {
            $(this).parent().parent().parent().remove();
        });
        $(document).on('click', '.minus-btn-question-old-data', function() {
            $(this).parent().parent().parent().parent().append(
                "<input type='hidden' name='old_delete_faq_data[]' value='" + $(this).attr('faq_id') + "'>");
            $(this).parent().parent().parent().remove();
        });


        $('#plus-btn-data-content').on('click', function() {
            var myvar = `
                <div class="d-flex align-items-center row">
                    <div class="col-md-6">
                        <label class="form-control-label"><b>Type:</b></label>
                        <div class="d-flex  align-items-center">
                            <select class="form-control form-control-lg on_change_u_lo_type"
                                name="type_loction_id[]" required>
                                <option value="">Select type</option>
                                <option value="1">Continent</option>
                                <option value="2">Country</option>
                                <option value="3">Province</option>
                                <option value="4">City</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <label
                            class="form-control-label"><b>Location:</b></label>
                        <div class="d-flex  align-items-center">
                            <select class="form-control form-control-lg" id="location"
                                name="location_id[]" required>
                                <option value="">Select Location</option>
                            </select>
                        </div>
                    </div>
                    <a href="javascript:void(0)"
                        class="minus-btn-data-content px-1 p-0 m-0 ml-2"><i
                            class="fas fa-minus-circle"></i></a>
                </div>
            `;

            $('.add-data-content').prepend(myvar);
        });
        $(document).on('click', '.minus-btn-data-content', function() {
            $(this).parent().remove();
        });
        $(document).on('click', '.minus-btn-data-old-audio', function() {
            $(this).parent().parent().append('<input type="hidden" name="delete_home_content_location[]" value="' +
                $(this).attr('home_content_location_id') + '">');
            $(this).parent().remove();
        });


        /* add photo gallery image */
        $('#add-photo-gallery-image').on('click', function() {
            var randomNumber = Math.floor(10000 + Math.random() * 90000);

            var myvar = `
                <div class="row align-items-center mt-2">

                    <div class="col-12 mt-3">
                        <div class="form-group">
                            <label>Image Position</label>
                            <input type="text"
                                class="form-control form-control-lg"
                                placeholder="Enter image alt position"
                                name="image_position[${randomNumber}]">
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="form-group">
                            <label>Image Title</label>
                            <input type="text"
                                class="form-control form-control-lg"
                                placeholder="Enter image alt title"
                                name="image_title[${randomNumber}]">
                        </div>
                    </div>

                    <div
                        class="col-sm-12 col-md-5 img-upload-container">
                        <label class="form-control-label">Add
                            Image:</label>
                        <div class="dropify-wrapper"
                            style="border: none">
                            <div class="dropify-loader"></div>
                            <div class="dropify-errors-container">
                                <ul></ul>
                            </div>
                            <input type="file" class="dropify"
                                name="photo_gallery_image[${randomNumber}]"
                                accept="image/*">
                            <button type="button"
                                class="dropify-clear">Remove</button>
                            <div class="dropify-preview">
                                <span class="dropify-render"></span>
                                <div class="dropify-infos">
                                    <div class="dropify-infos-inner">
                                        <p class="dropify-filename">
                                            <span
                                                class="file-icon"></span>
                                            <span
                                                class="dropify-filename-inner"></span>
                                        </p>
                                        <p
                                            class="dropify-infos-message">
                                            Drag
                                            and drop or click to
                                            replace</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="img-preview-container col-sm-12 col-md-6 d-flex justify-content-center align-items-center">
                        <div class="px-3 mt-3">
                            <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                alt="" class="img-fluid"
                                style="border-radius: 10px; max-height: 200px !important;">
                        </div>
                    </div>

                    <div class="col-1">
                        <a href="javascript:void(0)"
                            class="remove-photo-gallery-image btn btn-danger btn-sm m-0 ml-2">
                            <i class="fas fa-minus-circle"> </i>
                        </a>
                    </div>

                </div>
            `;
            $('.photo-gallery-container').prepend(myvar);
            $(`.dropify`).dropify();
        });

        $(document).on('click', '.remove-photo-gallery-image', function() {
            $(this).parent().parent().remove();
        });


        $('#plus-btn-data-tagline').on('click', function() {
            var myvar = '<div class="d-flex mt-3">' +
                '     <div class="" style="padding:10px;width: 97%;">' +
                '         <div class="row mt-3">' +
                '             <label class="col-sm-2 mt-3">Title</label>' +
                '             <div class="col-sm-10">' +
                '                 <input  value="" type="text" name="title[]" class="form-control" placeholder="Enter Title">' +
                '             </div>' +
                '             <label class="col-sm-2 mt-3">URL</label>' +
                '             <div class="col-sm-10 mt-2">' +
                '                 <input  value="" type="text" name="url[]" class="form-control" placeholder="Enter URL">' +
                '             </div>' +
                '             <label class="col-sm-2 mt-3">Description</label>' +
                '             <div class="col-sm-10 mt-2">' +
                '                 <textarea  value="" type="text" name="description[]" class="form-control" placeholder="Enter Short Description"></textarea>' +
                '            </div>' +
                '      </div>' +
                '   </div>' +
                '    <a href="javascript:void(0)" class="minus-btn-data-tagline px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>' +
                '</div>';

            $('.show-add-tagline-data').append(myvar);
            tagline++;
            $(this).focus();
        });
        $(document).on('click', '.minus-btn-data-tagline', function() {
            $(this).parent().remove();
        });
        $(document).on('click', '.minus-btn-learn-old-data', function() {
            $(this).parent().parent().parent().parent().append(
                "<input type='hidden' name='old_delete_learn_data[]' value='" + $(this).attr('learn_id') + "'>");
            $(this).parent().remove();
        });
    </script>

    <script>
        $(document).on('change', '.on_change_u_lo_type', function() {
            let id = $(this).val();
            let url = '{{ url('/get_location_u/') }}/' + id;

            let location = $(this).closest('.row').find('#location');

            $.ajax({
                url: url,
                type: 'GET',
                success: function(res) {
                    location.empty();

                    let html = '<option value="">Select Location</option>';
                    $.each(res, function(index, element) {
                        html += "<option value=" + element.id + ">" + element.name +
                            "</option>";
                    });

                    location.append(html);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>

    <script>
        $('#video_upload').on('change', function(e) {
            var fileInput = $(this)[0];

            if (fileInput.files && fileInput.files[0]) {
                var fileURL = URL.createObjectURL(fileInput.files[0]);
                $('#video_preview').attr('src', fileURL);
            }
        });

        $(document).ready(function() {
            function toggleBannerSections(selectedType) {
                $('#banner_photo_type').toggle(selectedType === 'photo');
                $('#banner_video_type').toggle(selectedType === 'video');
            }

            toggleBannerSections($('#bannerTypeSelect').val());

            $('#bannerTypeSelect').on('change', function() {
                toggleBannerSections(this.value);
            });
        });


        $('#add-banner-image').on('click', function() {
            var randomNumber = Math.floor(10000 + Math.random() * 90000);

            var myvar = `
                <div>
                    <div class="row mt-4 mb-4">
                    <div class="col-sm-12">
                        <label class=" form-control-label">Banner Text:<span
                                class="tx-danger"></span></label>
                        <div class="mg-t-10 mg-sm-t-0">
                            <input type="text"
                                class="form-control form-control-lg"
                                name="hero_content[${randomNumber}][banner_text]"
                                value="">
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="row mt-4 mb-4">
                    <div class="col-sm-12">
                        <label class=" form-control-label">Banner Short Text:<span
                                class="tx-danger"></span></label>
                        <div class="mg-t-10 mg-sm-t-0">
                            <input type="text"
                                class="form-control form-control-lg"
                                name="hero_content[${randomNumber}][banner_short_text]"
                                value="">
                        </div>
                    </div>
                    <hr>
                </div>

                    <div class="row mt-4 mb-4">
                    <div class="col-sm-12">
                        <label class=" form-control-label">Button Url:<span
                                class="tx-danger"></span></label>
                        <div class="mg-t-10 mg-sm-t-0">
                            <input type="text"
                                class="form-control form-control-lg"
                                name="hero_content[${randomNumber}][button_url]"
                                value="">
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="d-flex align-items-center mt-2 row">
                    <div class="col-12 mt-3 form-group">
                        <label for="">Image URL</label>
                        <input type="text" class="form-control"
                            placeholder="Enter Image Redirection URL"
                            name="hero_content[${randomNumber}][image_url]">
                    </div>

                    <div class="col-sm-12 col-md-6 img-upload-container">
                        <label class="form-control-label">Add Banner
                            Image:</label>
                        <div class="dropify-wrapper" style="border: none">
                            <div class="dropify-loader"></div>
                            <div class="dropify-errors-container">
                                <ul></ul>
                            </div>
                            <input type="file" class="dropify"
                                name="hero_content[${randomNumber}][banner_image]"
                                accept="image/*">
                            <button type="button"
                                class="dropify-clear">Remove</button>
                            <div class="dropify-preview">
                                <span class="dropify-render"></span>
                                <div class="dropify-infos">
                                    <div class="dropify-infos-inner">
                                        <p class="dropify-filename">
                                            <span class="file-icon"></span>
                                            <span
                                                class="dropify-filename-inner"></span>
                                        </p>
                                        <p class="dropify-infos-message">
                                            Drag and drop or click
                                            to replace</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="img-preview-container col-sm-11 col-md-5 d-flex justify-content-center align-items-center">
                        <div class="px-3 mt-3">
                            <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                alt="" class="img-fluid"
                                style="border-radius: 10px; max-height: 200px !important;">
                        </div>
                    </div>
                    <div class="col-1">
                        <a href="javascript:void(0)"
                            class="remove-banner-image btn btn-danger btn-sm m-0 ml-2">
                            <i class="fas fa-minus-circle"> </i>
                        </a>
                    </div>
                </div>
                </div>
            `;

            $('.banner-image-container').prepend(myvar);
            $(`.dropify`).dropify();
        });

        $(document).on('click', '.remove-banner-image', function() {
            $(this).parent().parent().parent().remove();
        });
    </script>

    <script>
        $(document).ready(function() {
            let rowCount = 10;

            function updateSelectNames() {
                $('.latest-updates-container .row').each(function(index, element) {
                    $(this).find('select[name="latest_updates_category"]').attr('name',
                        `latest_updates_category[${index}]`);
                    $(this).find('select[name="latest_updates_item"]').attr('name',
                        `latest_updates_item[${index}]`);
                });
            }

            $('.add-latest-updates').click(function() {
                rowCount++;
                let newRow = `
                    <div class="row align-items-center">
                        <div class="col-5 mt-3">
                            <label class=" form-control-label">Category:<span class="tx-danger"></span></label>
                            <div class="mg-t-10 mg-sm-t-0">
                                <select name="latest_updates_category[${rowCount}]" class="form-control form-control-lg category-select" required>
                                    <option value="">Choose an option</option>
                                    <option value="blog">Blog</option>
                                    <option value="event">Event</option>
                                    <option value="expo">Expo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-5 mt-3">
                            <label class=" form-control-label">Item:<span class="tx-danger"></span></label>
                            <div class="mg-t-10 mg-sm-t-0">
                                <select name="latest_updates_item[${rowCount}]" class="form-control form-control-lg item-select" required>
                                    <option value="">Choose category first</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-1 mt-5">
                            <div class="mg-t-10 mg-sm-t-0">
                                <a href="javascript:void(0)" class="btn btn-sm btn-danger remove-row">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>`;

                $('.latest-updates-container').append(newRow);
                updateSelectNames();
            });

            $(document).on('click', '.remove-row', function() {
                $(this).closest('.row').remove();
                updateSelectNames();
            });

            // Fetch items based on category selection
            $(document).on('change', '.category-select', function() {
                let category = $(this).val();
                let $itemSelect = $(this).closest('.row').find(
                    '.item-select');

                if (category !== "") {
                    $.ajax({
                        url: "{{ route('admin.ajax.getBlogItems') }}",
                        type: 'GET',
                        data: {
                            category: category
                        },
                        success: function(response) {
                            $itemSelect.empty();
                            $itemSelect.append('<option value="">Choose an option</option>');

                            $.each(response.items, function(index, item) {
                                let itemName = item.name ? item.name : item.title;
                                $itemSelect.append(
                                    `<option value="${item.id}">${itemName}</option>`
                                );
                            });
                        },
                        error: function(xhr) {
                            console.log("Error:", xhr);
                        }
                    });

                } else {
                    $itemSelect.empty();
                    $itemSelect.append('<option value="">Choose category first</option>');
                }
            });
        });
    </script>
</body>

</html>
