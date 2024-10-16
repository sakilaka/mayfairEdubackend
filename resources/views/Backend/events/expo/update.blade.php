<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Edit Expo</title>
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
                            Edit Expo
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.expo.index') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All</a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <form id="expo-form-wizard" action="{{ route('admin.expo.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div>
                                            <h3>Expo Details</h3>
                                            <section>
                                                <h4 class="mb-3">Expo Details</h4>

                                                <div class="row mb-3">
                                                    <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <div class="row">
                                                            <div class="col-sm-6 img-upload-container">
                                                                <div class="form-group">
                                                                    <label class="form-control-label">Banner</label>
                                                                    <div class="dropify-wrapper" style="border: none">
                                                                        <div class="dropify-loader"></div>
                                                                        <div class="dropify-errors-container">
                                                                            <ul></ul>
                                                                        </div>
                                                                        <input type="file" class="dropify"
                                                                            name="banner" accept="image/*">
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
                                                            </div>
                                                            <div
                                                                class="img-preview-container col-sm-6 d-flex justify-content-center align-items-center">
                                                                <div class="px-3">
                                                                    <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                                                        alt="" class="img-fluid"
                                                                        style="border-radius: 10px; max-height: 200px !important;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Expo Title:
                                                                <span class="text-danger"
                                                                    style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                            <div class="mg-t-10 mg-sm-t-0">
                                                                <input type="text" name="title"
                                                                    class="form-control" placeholder="Enter Expo Title"
                                                                    required>
                                                                @error('title')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Date:
                                                                <span class="text-danger"
                                                                    style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                            <div class="mg-t-10 mg-sm-t-0">
                                                                <input type="date" name="date"
                                                                    class="form-control" required>
                                                                @error('date')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Time:
                                                                <span class="text-danger"
                                                                    style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                            <div class="mg-t-10 mg-sm-t-0">
                                                                <input type="time" name="time"
                                                                    class="form-control" required>
                                                                @error('time')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Place:
                                                                <span class="text-danger"
                                                                    style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                            <div class="mg-t-10 mg-sm-t-0">
                                                                <input type="text" name="place"
                                                                    class="form-control" placeholder="Enter Address"
                                                                    required>
                                                                @error('place')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Participated Universities:</label>
                                                            <select
                                                                class="form-control form-control-lg multipleSelect2Search"
                                                                name="universities[]" multiple>
                                                                <option value="">Select University</option>
                                                                @foreach ($universities as $university)
                                                                    <option value="{{ $university->id }}">
                                                                        {{ $university->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="row expo-location-container">
                                                            <div class="col-md-12 expo-location-select-container">
                                                                <div class="form-group">
                                                                    <label>Expo Location:
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <select class="form-control form-control-lg"
                                                                        name="location[type]" id="expoLocationSelect"
                                                                        required>
                                                                        <option value="">Select Location</option>
                                                                        <option value="china">China</option>
                                                                        <option value="overseas">Overseas</option>
                                                                    </select>
                                                                    @error('location[]')
                                                                        <span
                                                                            class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 expo-country-container"
                                                                style="display:none;">
                                                                <div class="form-group">
                                                                    <label>Country:</label>
                                                                    <input type="text" class="form-control"
                                                                        name="location[country]"
                                                                        placeholder="Enter Country Name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label">
                                                                Expo Description:
                                                            </label>
                                                            <div class="mg-t-10 mg-sm-t-0">
                                                                <textarea name="description" class="editor form-control"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <div class="d-flex justify-content-between">
                                                            <h5 class="d-inline">Special Guest(s)</h5>
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-sm btn-primary" id="add-special-guest">
                                                                <i class="fa fa-plus"></i>
                                                                Add
                                                            </a>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <tr class="text-center bg-primary text-white">
                                                                        <th>Name</th>
                                                                        <th>Image</th>
                                                                        <th>Designation</th>
                                                                        <th>Organization</th>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="mg-t-10 mg-sm-t-0 special-guest-container">
                                                                <div class="d-flex align-items-center mt-2">
                                                                    <div class="d-flex align-items-center justify-content-between select-add-section"
                                                                        style="width: 97%;">
                                                                        <div style="width: 25%;">
                                                                            <input type="text" name="guestName[]"
                                                                                class="mr-1 form-control"
                                                                                placeholder="Guest Name">
                                                                        </div>
                                                                        <div style="width: 24.5%;">
                                                                            <div
                                                                                class="d-flex align-items-center justify-content-between">
                                                                                <img src="{{ asset('frontend/images/no-profile.jpg') }}"
                                                                                    alt=""
                                                                                    style="width: 48px; height:auto;">
                                                                                <input type="file"
                                                                                    name="guestImage[{{ rand(10000, 99999) }}]"
                                                                                    class="mr-1 form-control"
                                                                                    accept="image/*"
                                                                                    onchange="previewImage(this)">
                                                                            </div>
                                                                        </div>
                                                                        <div style="width: 24.5%;">
                                                                            <input type="text"
                                                                                name="guestDesignation[]"
                                                                                class="mr-1 form-control"
                                                                                placeholder="Designation">
                                                                        </div>
                                                                        <div style="width: 24.5%;">
                                                                            <input type="text"
                                                                                name="guestOrganization[]"
                                                                                class="mr-1 form-control"
                                                                                placeholder="Organization">
                                                                        </div>
                                                                    </div>

                                                                    <a href="javascript:void(0)"
                                                                        class="remove-special-guest px-1 p-0 m-0 ml-2"><i
                                                                            class="fas fa-minus"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 my-3">
                                                        <div class="d-flex justify-content-between">
                                                            <h5 class="d-inline">Media Partner</h5>
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-sm btn-primary" id="add-media-partner">
                                                                <i class="fa fa-plus"></i>
                                                                Add
                                                            </a>
                                                        </div>

                                                        <div class="media-partner-container">
                                                            <div class="d-flex align-items-center">
                                                                <div class="row align-items-center">
                                                                    <div
                                                                        class="col-sm-12 col-md-6 mt-3 img-upload-container">
                                                                        <label class="form-control-label">Add
                                                                            Image:</label>
                                                                        <div class="dropify-wrapper"
                                                                            style="border: none">
                                                                            <div class="dropify-loader"></div>
                                                                            <div class="dropify-errors-container">
                                                                                <ul></ul>
                                                                            </div>
                                                                            <input type="file" class="dropify"
                                                                                name="media_partner_logo[{{ rand(10000, 99999) }}]"
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
                                                                </div>

                                                                <a href="javascript:void(0)"
                                                                    class="remove-media-partner px-1 p-0 m-0 ml-2">
                                                                    <i class="fas fa-minus-circle"> </i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 mb-3">
                                                        <div class="card-header" data-toggle="collapse"
                                                            data-target="#gallery_image_gallery">
                                                            <h5 class="card-title mb-0 py-2">
                                                                <i class="fa fa-solid fa-plus"></i>
                                                                Media Gallery
                                                            </h5>
                                                        </div>

                                                        <div class="collapse" id="gallery_image_gallery">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="d-flex justify-content-between">
                                                                        <h5 class="d-inline">Video</h5>
                                                                    </div>

                                                                    <div class="col-sm-12 col-md-6 mt-3">
                                                                        <label class="form-control-label">Add
                                                                            Video:</label>
                                                                        <div class="dropify-wrapper"
                                                                            style="border: none">
                                                                            <div class="dropify-loader"></div>
                                                                            <div class="dropify-errors-container">
                                                                                <ul></ul>
                                                                            </div>
                                                                            <input type="file" class="dropify"
                                                                                name="video[]" id="video_upload">
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
                                                                        class="col-sm-12 col-md-5 d-flex justify-content-center align-items-center">
                                                                        <div class="px-3 mt-3">
                                                                            <video id="video_preview" width="320"
                                                                                height="240" controls
                                                                                style="border-radius: 8px"></video>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <hr>

                                                                <div class="col-sm-12 mt-3">
                                                                    <div class="d-flex justify-content-between">
                                                                        <h5 class="d-inline">Photo Gallery</h5>
                                                                        <a href="javascript:void(0)"
                                                                            class="btn btn-sm btn-primary"
                                                                            id="add-photo-gallery">
                                                                            <i class="fa fa-plus"></i>
                                                                            Add
                                                                        </a>
                                                                    </div>

                                                                    <div class="photo-gallery-container">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="row align-items-center mt-2">
                                                                                <div
                                                                                    class="col-sm-12 col-md-6 mt-3 img-upload-container">
                                                                                    <label
                                                                                        class="form-control-label">Add
                                                                                        Image:</label>
                                                                                    <div class="dropify-wrapper"
                                                                                        style="border: none">
                                                                                        <div class="dropify-loader">
                                                                                        </div>
                                                                                        <div
                                                                                            class="dropify-errors-container">
                                                                                            <ul></ul>
                                                                                        </div>
                                                                                        <input type="file"
                                                                                            class="dropify"
                                                                                            name="gallery_image[{{ rand(10000, 99999) }}]"
                                                                                            accept="image/*">
                                                                                        <button type="button"
                                                                                            class="dropify-clear">Remove</button>
                                                                                        <div class="dropify-preview">
                                                                                            <span
                                                                                                class="dropify-render"></span>
                                                                                            <div class="dropify-infos">
                                                                                                <div
                                                                                                    class="dropify-infos-inner">
                                                                                                    <p
                                                                                                        class="dropify-filename">
                                                                                                        <span
                                                                                                            class="file-icon"></span>
                                                                                                        <span
                                                                                                            class="dropify-filename-inner"></span>
                                                                                                    </p>
                                                                                                    <p
                                                                                                        class="dropify-infos-message">
                                                                                                        Drag
                                                                                                        and drop or
                                                                                                        click to
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
                                                                                            alt=""
                                                                                            class="img-fluid"
                                                                                            style="border-radius: 10px; max-height: 200px !important;">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <a href="javascript:void(0)"
                                                                                class="remove-photo-gallery px-1 p-0 m-0 ml-2">
                                                                                <i class="fas fa-minus-circle"> </i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>

                                            <h3>Additional Contents</h3>
                                            <section>
                                                
                                                <h4>Nav Logo</h4>
                                                <div class="row mb-3">
                                                    <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <div class="row">
                                                            <div class="col-sm-6 img-upload-container">
                                                                <div class="form-group">
                                                                    <label class="form-control-label">Upload
                                                                        Logo</label>
                                                                    <div class="dropify-wrapper" style="border: none">
                                                                        <div class="dropify-loader"></div>
                                                                        <div class="dropify-errors-container">
                                                                            <ul></ul>
                                                                        </div>
                                                                        <input type="file" class="dropify"
                                                                            name="additional_contents[nav_logo]"
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
                                                                                        Drag and drop or click to
                                                                                        replace
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="img-preview-container col-sm-6 d-flex justify-content-center align-items-center">
                                                                <div class="px-3">
                                                                    <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                                                        alt="" class="img-fluid"
                                                                        style="border-radius: 10px; max-height: 200px !important;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h4>Hero Section Background</h4>
                                                <div class="row mb-3">
                                                    <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <div class="row">
                                                            <div class="col-sm-6 img-upload-container">
                                                                <div class="form-group">
                                                                    <label class="form-control-label">Upload
                                                                        Background</label>
                                                                    <div class="dropify-wrapper" style="border: none">
                                                                        <div class="dropify-loader"></div>
                                                                        <div class="dropify-errors-container">
                                                                            <ul></ul>
                                                                        </div>
                                                                        <input type="file" class="dropify"
                                                                            name="additional_contents[hero_bg]"
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
                                                                                        Drag and drop or click to
                                                                                        replace
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="img-preview-container col-sm-6 d-flex justify-content-center align-items-center">
                                                                <div class="px-3">
                                                                    <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                                                        alt="" class="img-fluid"
                                                                        style="border-radius: 10px; max-height: 200px !important;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h4>Why Should Attent... Image</h4>
                                                <div class="row mb-3">
                                                    <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <div class="row">
                                                            <div class="col-sm-6 img-upload-container">
                                                                <div class="form-group">
                                                                    <label class="form-control-label">Upload
                                                                        Image</label>
                                                                    <div class="dropify-wrapper" style="border: none">
                                                                        <div class="dropify-loader"></div>
                                                                        <div class="dropify-errors-container">
                                                                            <ul></ul>
                                                                        </div>
                                                                        <input type="file" class="dropify"
                                                                            name="additional_contents[why_should_attend]"
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
                                                                                        Drag and drop or click to
                                                                                        replace
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="img-preview-container col-sm-6 d-flex justify-content-center align-items-center">
                                                                <div class="px-3">
                                                                    <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                                                        alt="" class="img-fluid"
                                                                        style="border-radius: 10px; max-height: 200px !important;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row">
                        <div class="col-md-12 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample"
                                        action="{{ route('admin.expo.update', ['id' => $expo->id]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row mb-3">
                                            <div class="col-sm-12 col-md-6 col-lg-8">
                                                <div class="row">
                                                    <div class="col-sm-12 mb-2">
                                                        <h4>Expo Details</h4>
                                                    </div>

                                                    <div class="col-sm-6 img-upload-container">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Banner</label>
                                                            <div class="dropify-wrapper" style="border: none">
                                                                <div class="dropify-loader"></div>
                                                                <div class="dropify-errors-container">
                                                                    <ul></ul>
                                                                </div>
                                                                <input type="file" class="dropify" name="banner"
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
                                                                                Drag and drop or click to replace
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="img-preview-container col-sm-6 d-flex justify-content-center align-items-center">
                                                        <div class="px-3">
                                                            <img src="{{ $expo->banner ?? asset('frontend/images/No-image.jpg') }}"
                                                                alt="" class="img-fluid"
                                                                style="border-radius: 10px; max-height: 200px !important;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Expo Title:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="title" class="form-control"
                                                            placeholder="Enter Expo Title" value="{{ $expo->title }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Date:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="date" name="date"
                                                            value="{{ Carbon\Carbon::createFromFormat('d M Y h:i A', str_replace(',', '', $expo->datetime))->format('Y-m-d') }}"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Time:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="time" name="time" class="form-control"
                                                            value="{{ Carbon\Carbon::createFromFormat('d M Y h:i A', str_replace(',', '', $expo->datetime))->format('H:i') }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">Place:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="place" class="form-control"
                                                            placeholder="Enter Address" value="{{ $expo->place }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                @php
                                                    $location = json_decode($expo['location'], true) ?? [];
                                                    $locationType = isset($location['type']) ? $location['type'] : '';
                                                    $isOverseas = $locationType === 'overseas';
                                                @endphp
                                                <div class="row expo-location-container">
                                                    <div
                                                        class="{{ $isOverseas ? 'col-md-6' : 'col-md-12' }} expo-location-select-container">
                                                        <div class="form-group">
                                                            <label>Expo Location: <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-control form-control-lg"
                                                                name="location[type]" id="expoLocationSelect"
                                                                required>
                                                                <option value="">Select Location</option>
                                                                <option value="china"
                                                                    {{ $locationType === 'china' ? 'selected' : '' }}>
                                                                    China</option>
                                                                <option value="overseas"
                                                                    {{ $isOverseas ? 'selected' : '' }}>Overseas
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 expo-country-container"
                                                        style="{{ $isOverseas ? '' : 'display:none;' }}">
                                                        <div class="form-group">
                                                            <label>Country:</label>
                                                            <input type="text" class="form-control"
                                                                name="location[country]"
                                                                value="{{ $location['country'] ?? '' }}"
                                                                placeholder="Enter Country Name">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">
                                                        Expo Description:
                                                    </label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <textarea name="description" class="editor form-control">{{ $expo->description }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Participated Universities:</label>
                                                    <select class="form-control form-control-lg multipleSelect2Search"
                                                        name="universities[]" multiple>
                                                        <option value="">Select University</option>
                                                        @php
                                                            $selectedUniversities =
                                                                json_decode($expo->universities, true) ?? [];
                                                        @endphp
                                                        @foreach ($universities as $university)
                                                            <option value="{{ $university->id }}"
                                                                {{ in_array($university->id, $selectedUniversities) ? 'selected' : '' }}>
                                                                {{ $university->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="d-inline">Special Guest(s)</h5>
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary"
                                                        id="add-special-guest">
                                                        <i class="fa fa-plus"></i>
                                                        Add
                                                    </a>
                                                </div>

                                                <div class="form-group">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <tr class="text-center bg-primary text-white">
                                                                <th>Name</th>
                                                                <th>Image</th>
                                                                <th>Designation</th>
                                                                <th>Organization</th>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="mg-t-10 mg-sm-t-0 special-guest-container">
                                                        @php
                                                            $guests = json_decode($expo->guests, true) ?? [];
                                                        @endphp

                                                        @forelse ($guests as $key => $guest)
                                                            <div class="d-flex align-items-center mt-2">
                                                                <div class="d-flex align-items-center justify-content-between select-add-section"
                                                                    style="width: 97%;">
                                                                    <div style="width: 25%;">
                                                                        <input type="text" name="guestName[]"
                                                                            class="mr-1 form-control"
                                                                            placeholder="Guest Name"
                                                                            value="{{ $guest['name'] }}" required>
                                                                    </div>
                                                                    <div style="width: 24.5%;">
                                                                        <div
                                                                            class="d-flex align-items-center justify-content-between">
                                                                            <img src="{{ $guest['image'] ?? asset('frontend/images/no-profile.jpg') }}"
                                                                                alt=""
                                                                                style="width: 48px; height:auto;">
                                                                            <input type="file"
                                                                                name="guestImage[{{ $key }}]"
                                                                                class="mr-1 form-control"
                                                                                accept="image/*"
                                                                                onchange="previewImage(this)" required>
                                                                            <input type="hidden"
                                                                                name="oldGuestImage[{{ $key }}]"
                                                                                value="{{ $guest['image'] }}">
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 24.5%;">
                                                                        <input type="text"
                                                                            name="guestDesignation[]"
                                                                            class="mr-1 form-control"
                                                                            placeholder="Designation"
                                                                            value="{{ $guest['designation'] }}"
                                                                            required>
                                                                    </div>
                                                                    <div style="width: 24.5%;">
                                                                        <input type="text"
                                                                            name="guestOrganization[]"
                                                                            class="mr-1 form-control"
                                                                            placeholder="Organization"
                                                                            value="{{ $guest['organization'] }}"
                                                                            required>
                                                                    </div>
                                                                </div>

                                                                <a href="javascript:void(0)"
                                                                    class="remove-special-guest px-1 p-0 m-0 ml-2"><i
                                                                        class="fas fa-minus"></i></a>
                                                            </div>
                                                        @empty
                                                            <div class="d-flex align-items-center mt-2">
                                                                <div class="d-flex align-items-center justify-content-between select-add-section"
                                                                    style="width: 97%;">
                                                                    <div style="width: 25%;">
                                                                        <input type="text" name="guestName[]"
                                                                            class="mr-1 form-control"
                                                                            placeholder="Guest Name">
                                                                    </div>
                                                                    <div style="width: 24.5%;">
                                                                        <div
                                                                            class="d-flex align-items-center justify-content-between">
                                                                            <img src="{{ asset('frontend/images/no-profile.jpg') }}"
                                                                                alt=""
                                                                                style="width: 48px; height:auto;">
                                                                            <input type="file"
                                                                                name="guestImage[{{ rand(10000, 99999) }}]"
                                                                                class="mr-1 form-control"
                                                                                accept="image/*"
                                                                                onchange="previewImage(this)">
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 24.5%;">
                                                                        <input type="text"
                                                                            name="guestDesignation[]"
                                                                            class="mr-1 form-control"
                                                                            placeholder="Designation">
                                                                    </div>
                                                                    <div style="width: 24.5%;">
                                                                        <input type="text"
                                                                            name="guestOrganization[]"
                                                                            class="mr-1 form-control"
                                                                            placeholder="Organization">
                                                                    </div>
                                                                </div>

                                                                <a href="javascript:void(0)"
                                                                    class="remove-special-guest px-1 p-0 m-0 ml-2"><i
                                                                        class="fas fa-minus"></i></a>
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 my-3">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="d-inline">Media Partner</h5>
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary"
                                                        id="add-media-partner">
                                                        <i class="fa fa-plus"></i>
                                                        Add
                                                    </a>
                                                </div>

                                                <div class="media-partner-container">
                                                    @php
                                                        $mediaPartnerImages =
                                                            json_decode($expo->media_partner, true) ?? [];
                                                    @endphp

                                                    @forelse ($mediaPartnerImages as $key => $image)
                                                        <div class="d-flex align-items-center">
                                                            <div class="row align-items-center">
                                                                <div
                                                                    class="col-sm-12 col-md-6 mt-3 img-upload-container">
                                                                    <label class="form-control-label">Edit
                                                                        Image:</label>
                                                                    <div class="dropify-wrapper" style="border: none">
                                                                        <div class="dropify-loader"></div>
                                                                        <div class="dropify-errors-container">
                                                                            <ul></ul>
                                                                        </div>
                                                                        <input type="file" class="dropify"
                                                                            name="media_partner_logo[{{ $key }}]"
                                                                            accept="image/*">
                                                                        <input type="hidden"
                                                                            name="old_media_partner_logo[{{ $key }}]"
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
                                                            </div>

                                                            <a href="javascript:void(0)"
                                                                class="remove-media-partner px-1 p-0 m-0 ml-2">
                                                                <i class="fas fa-minus-circle"> </i>
                                                            </a>
                                                        </div>
                                                    @empty
                                                        <div class="d-flex align-items-center">
                                                            <div class="row align-items-center">
                                                                <div
                                                                    class="col-sm-12 col-md-6 mt-3 img-upload-container">
                                                                    <label class="form-control-label">Add
                                                                        Image:</label>
                                                                    <div class="dropify-wrapper" style="border: none">
                                                                        <div class="dropify-loader"></div>
                                                                        <div class="dropify-errors-container">
                                                                            <ul></ul>
                                                                        </div>
                                                                        <input type="file" class="dropify"
                                                                            name="media_partner_logo[{{ rand(10000, 99999) }}]"
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
                                                            </div>

                                                            <a href="javascript:void(0)"
                                                                class="remove-media-partner px-1 p-0 m-0 ml-2">
                                                                <i class="fas fa-minus-circle"> </i>
                                                            </a>
                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>

                                            <div class="col-sm-12 mb-3">
                                                <div class="card-header" data-toggle="collapse"
                                                    data-target="#gallery_image_gallery">
                                                    <h5 class="card-title mb-0 py-2">
                                                        <i class="fa fa-solid fa-plus"></i>
                                                        Media Gallery
                                                    </h5>
                                                </div>

                                                <div class="collapse" id="gallery_image_gallery">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="d-flex justify-content-between">
                                                                <h5 class="d-inline">Video</h5>
                                                            </div>

                                                            <div class="col-sm-12 col-md-6 mt-3">
                                                                <label class="form-control-label">Add
                                                                    Video:</label>
                                                                <div class="dropify-wrapper" style="border: none">
                                                                    <div class="dropify-loader"></div>
                                                                    <div class="dropify-errors-container">
                                                                        <ul></ul>
                                                                    </div>
                                                                    <input type="file" class="dropify"
                                                                        name="video[]" id="video_upload">
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
                                                                class="col-sm-12 col-md-5 d-flex justify-content-center align-items-center">
                                                                <div class="px-3 mt-3">
                                                                    <video id="video_preview"
                                                                        src="{{ json_decode($expo->videos, true)[0] ?? '' }}"
                                                                        width="320" height="240" controls
                                                                        style="border-radius: 8px"></video>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr>

                                                        <div class="col-sm-12 mt-3">
                                                            <div class="d-flex justify-content-between">
                                                                <h5 class="d-inline">Photo Gallery</h5>
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-sm btn-primary"
                                                                    id="add-photo-gallery">
                                                                    <i class="fa fa-plus"></i>
                                                                    Add
                                                                </a>
                                                            </div>

                                                            <div class="photo-gallery-container">
                                                                @php
                                                                    $galleryImages =
                                                                        json_decode($expo->photos, true) ?? [];
                                                                @endphp

                                                                @forelse ($galleryImages as $key => $image)
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="row align-items-center mt-2">
                                                                            <div
                                                                                class="col-sm-12 col-md-6 mt-3 img-upload-container">
                                                                                <label class="form-control-label">Add
                                                                                    Image:</label>
                                                                                <div class="dropify-wrapper"
                                                                                    style="border: none">
                                                                                    <div class="dropify-loader"></div>
                                                                                    <div
                                                                                        class="dropify-errors-container">
                                                                                        <ul></ul>
                                                                                    </div>
                                                                                    <input type="file"
                                                                                        class="dropify"
                                                                                        name="gallery_image[{{ $key }}]"
                                                                                        accept="image/*">
                                                                                    <input type="hidden"
                                                                                        name="old_gallery_image[{{ $key }}]"
                                                                                        value="{{ $image }}">
                                                                                    <button type="button"
                                                                                        class="dropify-clear">Remove</button>
                                                                                    <div class="dropify-preview">
                                                                                        <span
                                                                                            class="dropify-render"></span>
                                                                                        <div class="dropify-infos">
                                                                                            <div
                                                                                                class="dropify-infos-inner">
                                                                                                <p
                                                                                                    class="dropify-filename">
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
                                                                                    <img src="{{ $image ?? asset('frontend/images/No-image.jpg') }}"
                                                                                        alt=""
                                                                                        class="img-fluid"
                                                                                        style="border-radius: 10px; max-height: 200px !important;">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <a href="javascript:void(0)"
                                                                            class="remove-photo-gallery px-1 p-0 m-0 ml-2">
                                                                            <i class="fas fa-minus-circle"> </i>
                                                                        </a>
                                                                    </div>
                                                                @empty
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="row align-items-center mt-2">
                                                                            <div
                                                                                class="col-sm-12 col-md-6 mt-3 img-upload-container">
                                                                                <label class="form-control-label">Add
                                                                                    Image:</label>
                                                                                <div class="dropify-wrapper"
                                                                                    style="border: none">
                                                                                    <div class="dropify-loader"></div>
                                                                                    <div
                                                                                        class="dropify-errors-container">
                                                                                        <ul></ul>
                                                                                    </div>
                                                                                    <input type="file"
                                                                                        class="dropify"
                                                                                        name="gallery_image[{{ rand(10000, 99999) }}]"
                                                                                        accept="image/*">
                                                                                    <button type="button"
                                                                                        class="dropify-clear">Remove</button>
                                                                                    <div class="dropify-preview">
                                                                                        <span
                                                                                            class="dropify-render"></span>
                                                                                        <div class="dropify-infos">
                                                                                            <div
                                                                                                class="dropify-infos-inner">
                                                                                                <p
                                                                                                    class="dropify-filename">
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
                                                                                        alt=""
                                                                                        class="img-fluid"
                                                                                        style="border-radius: 10px; max-height: 200px !important;">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <a href="javascript:void(0)"
                                                                            class="remove-photo-gallery px-1 p-0 m-0 ml-2">
                                                                            <i class="fas fa-minus-circle"> </i>
                                                                        </a>
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>

                @include('Backend.components.footer')
            </div>
        </div>
    </div>

    @include('Backend.components.script')
    @include('Backend.components.ckeditor5-config')

    <script>
        $('.multipleSelect2Search').select2();
    </script>

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

        $('#video_upload').on('change', function(e) {
            var fileInput = $(this)[0];

            if (fileInput.files && fileInput.files[0]) {
                var fileURL = URL.createObjectURL(fileInput.files[0]);
                $('#video_preview').attr('src', fileURL);
            }
        });

        function previewImage(input) {
            var fileInput = $(input)[0];

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(input).siblings('img').attr('src', e.target.result);
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>

    <script>
        /* special guest */
        $('#add-special-guest').on('click', function() {
            var randomNumber = Math.floor(10000 + Math.random() * 90000);

            let specialGuest = `
                <div class="d-flex align-items-center mt-2">
                    <div class="d-flex align-items-center justify-content-between select-add-section"
                        style="width: 97%;">
                        <div style="width: 25%;">
                            <input type="text" name="guestName[]"
                                class="mr-1 form-control"
                                placeholder="Guest Name" required>
                        </div>
                        <div style="width: 24.5%;">
                            <div
                                class="d-flex align-items-center justify-content-between">
                                <img src="{{ asset('frontend/images/no-profile.jpg') }}"
                                    alt=""
                                    style="width: 48px; height:auto;">
                                <input type="file" name="guestImage[${randomNumber}]"
                                    class="mr-1 form-control" accept="image/*"
                                    onchange="previewImage(this)" required>
                            </div>
                        </div>
                        <div style="width: 24.5%;">
                            <input type="text" name="guestDesignation[]"
                                class="mr-1 form-control"
                                placeholder="Designation" required>
                        </div>
                        <div style="width: 24.5%;">
                            <input type="text" name="guestOrganization[]"
                                class="mr-1 form-control"
                                placeholder="Organization" required>
                        </div>
                    </div>

                    <a href="javascript:void(0)"
                        class="remove-special-guest px-1 p-0 m-0 ml-2"><i
                            class="fas fa-minus"></i></a>
                </div>
            `;

            $('.special-guest-container').append(specialGuest);
        });

        $(document).on('click', '.remove-special-guest', function() {
            $(this).parent().remove();
        });

        /* media partner */
        $('#add-media-partner').on('click', function() {
            var randomNumber = Math.floor(10000 + Math.random() * 90000);

            var myvar = `
                <div class="d-flex align-items-center">
                    <div class="row align-items-center mt-2">
                        <div class="col-sm-12 col-md-6 mt-3 img-upload-container">
                            <label class="form-control-label">Add
                                Image:</label>
                            <div class="dropify-wrapper" style="border: none">
                                <div class="dropify-loader"></div>
                                <div class="dropify-errors-container">
                                    <ul></ul>
                                </div>
                                <input type="file" class="dropify"
                                    name="media_partner_logo[${randomNumber}]"
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
                    </div>

                    <a href="javascript:void(0)"
                        class="remove-media-partner px-1 p-0 m-0 ml-2">
                        <i class="fas fa-minus-circle"> </i>
                    </a>
                </div>
            `;
            $('.media-partner-container').prepend(myvar);
            $(`.dropify`).dropify();
        });

        $(document).on('click', '.remove-media-partner', function() {
            $(this).parent().remove();
        });

        /* media gallery */
        $('#add-photo-gallery').on('click', function() {
            var randomNumber = Math.floor(10000 + Math.random() * 90000);

            var myvar = `
                <div class="d-flex align-items-center">
                    <div class="row align-items-center mt-2">
                        <div
                            class="col-sm-12 col-md-6 mt-3 img-upload-container">
                            <label class="form-control-label">Add
                                Image:</label>
                            <div class="dropify-wrapper"
                                style="border: none">
                                <div class="dropify-loader"></div>
                                <div class="dropify-errors-container">
                                    <ul></ul>
                                </div>
                                <input type="file" class="dropify"
                                    name="gallery_image[${randomNumber}]"
                                    accept="image/*">
                                <button type="button"
                                    class="dropify-clear">Remove</button>
                                <div class="dropify-preview">
                                    <span
                                        class="dropify-render"></span>
                                    <div class="dropify-infos">
                                        <div
                                            class="dropify-infos-inner">
                                            <p
                                                class="dropify-filename">
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
                    </div>

                    <a href="javascript:void(0)"
                        class="remove-photo-gallery px-1 p-0 m-0 ml-2">
                        <i class="fas fa-minus-circle"> </i>
                    </a>
                </div>
            `;
            $('.photo-gallery-container').prepend(myvar);
            $(`.dropify`).dropify();
        });

        $(document).on('click', '.remove-photo-gallery', function() {
            $(this).parent().remove();
        });
    </script>

    <script>
        $('#expoLocationSelect').on('change', function() {
            var selectedLocation = $(this).val();
            if (selectedLocation === 'overseas') {
                $('.expo-location-select-container').removeClass('col-md-12').addClass('col-md-6');
                $('.expo-country-container').show();
            } else {
                $('.expo-location-select-container').removeClass('col-md-6').addClass('col-md-12');
                $('.expo-country-container').hide();
            }
        });
    </script>
</body>

</html>
