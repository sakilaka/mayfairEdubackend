<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Add Expo</title>
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
                            Add Expo
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.expo.index') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All</a>
                        </nav>
                    </div>

                    {{-- <div class="row">
                        <div class="col-md-12 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample" action="{{ route('admin.expo.store') }}" method="POST"
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
                                                        <input type="text" name="title" class="form-control"
                                                            placeholder="Enter Expo Title" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Date:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="date" name="date" class="form-control"
                                                            required>
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
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Place:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="place" class="form-control"
                                                            placeholder="Enter Address" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Participated Universities:</label>
                                                    <select class="form-control form-control-lg multipleSelect2Search"
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
                                                                            class="mr-1 form-control" accept="image/*"
                                                                            onchange="previewImage(this)">
                                                                    </div>
                                                                </div>
                                                                <div style="width: 24.5%;">
                                                                    <input type="text" name="guestDesignation[]"
                                                                        class="mr-1 form-control"
                                                                        placeholder="Designation">
                                                                </div>
                                                                <div style="width: 24.5%;">
                                                                    <input type="text" name="guestOrganization[]"
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
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary"
                                                        id="add-media-partner">
                                                        <i class="fa fa-plus"></i>
                                                        Add
                                                    </a>
                                                </div>

                                                <div class="media-partner-container">
                                                    <div class="d-flex align-items-center">
                                                        <div class="row align-items-center">
                                                            <div class="col-sm-12 col-md-6 mt-3 img-upload-container">
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
                                                                            <label class="form-control-label">Add
                                                                                Image:</label>
                                                                            <div class="dropify-wrapper"
                                                                                style="border: none">
                                                                                <div class="dropify-loader"></div>
                                                                                <div class="dropify-errors-container">
                                                                                    <ul></ul>
                                                                                </div>
                                                                                <input type="file" class="dropify"
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

                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">jquery-steps wizard</h4>
                                    <form id="example-form" action="#">
                                        <div role="application" class="wizard clearfix" id="steps-uid-0">
                                            <div class="steps clearfix">
                                                <ul role="tablist">
                                                    <li role="tab" class="first current" aria-disabled="false"
                                                        aria-selected="true"><a id="steps-uid-0-t-0"
                                                            href="#steps-uid-0-h-0"
                                                            aria-controls="steps-uid-0-p-0"><span
                                                                class="current-info audible">current step: </span><span
                                                                class="number">1.</span> Account</a></li>
                                                    <li role="tab" class="done" aria-disabled="false"
                                                        aria-selected="false"><a id="steps-uid-0-t-1"
                                                            href="#steps-uid-0-h-1"
                                                            aria-controls="steps-uid-0-p-1"><span
                                                                class="number">2.</span> Profile</a></li>
                                                    <li role="tab" class="done" aria-disabled="false"
                                                        aria-selected="false"><a id="steps-uid-0-t-2"
                                                            href="#steps-uid-0-h-2"
                                                            aria-controls="steps-uid-0-p-2"><span
                                                                class="number">3.</span> Comments</a></li>
                                                    <li role="tab" class="last done" aria-disabled="false"
                                                        aria-selected="false"><a id="steps-uid-0-t-3"
                                                            href="#steps-uid-0-h-3"
                                                            aria-controls="steps-uid-0-p-3"><span
                                                                class="number">4.</span> Finish</a></li>
                                                </ul>
                                            </div>
                                            <div class="content clearfix">
                                                <h3 id="steps-uid-0-h-0" tabindex="-1" class="title current">Account
                                                </h3>
                                                <section id="steps-uid-0-p-0" role="tabpanel"
                                                    aria-labelledby="steps-uid-0-h-0" class="body current"
                                                    aria-hidden="false" style="left: 0px;">
                                                    <h4>Account</h4>
                                                    <div class="form-group">
                                                        <label>Email address</label>
                                                        <input type="email" class="form-control"
                                                            aria-describedby="emailHelp" placeholder="Enter email">
                                                        <small id="emailHelp" class="form-text text-muted">We'll never
                                                            share your email with anyone
                                                            else.</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" class="form-control"
                                                            placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Confirm Password</label>
                                                        <input type="password" class="form-control"
                                                            placeholder="Confirm password">
                                                    </div>
                                                </section>

                                                <h3 id="steps-uid-0-h-1" tabindex="-1" class="title">Profile</h3>
                                                <section id="steps-uid-0-p-1" role="tabpanel"
                                                    aria-labelledby="steps-uid-0-h-1" class="body" aria-hidden="true"
                                                    style="left: -1012.25px; display: none;">
                                                    <h4>Profile</h4>
                                                    <div class="form-group">
                                                        <label>First name</label>
                                                        <input type="email" class="form-control"
                                                            aria-describedby="emailHelp" placeholder="Enter first name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Last name</label>
                                                        <input type="password" class="form-control"
                                                            placeholder="Last name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Profession</label>
                                                        <input type="password" class="form-control"
                                                            placeholder="Profession">
                                                    </div>
                                                </section>

                                                <h3 id="steps-uid-0-h-2" tabindex="-1" class="title">Comments</h3>
                                                <section id="steps-uid-0-p-2" role="tabpanel"
                                                    aria-labelledby="steps-uid-0-h-2" class="body"
                                                    aria-hidden="true" style="left: -1012.25px; display: none;">
                                                    <h4>Comments</h4>
                                                    <div class="form-group">
                                                        <label>Comments</label>
                                                        <textarea class="form-control" rows="3"></textarea>
                                                    </div>
                                                </section>

                                                <h3 id="steps-uid-0-h-3" tabindex="-1" class="title">Finish</h3>
                                                <section id="steps-uid-0-p-3" role="tabpanel"
                                                    aria-labelledby="steps-uid-0-h-3" class="body"
                                                    aria-hidden="true" style="left: 1012.25px; display: none;">
                                                    <h4>Finish</h4>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="checkbox" type="checkbox">
                                                            I agree with the Terms and Conditions.
                                                            <i class="input-helper"></i></label>
                                                    </div>
                                                </section>
                                            </div>

                                            <div class="actions clearfix">
                                                <ul role="menu" aria-label="Pagination">
                                                    <li class="disabled" aria-disabled="true"><a href="#previous"
                                                            role="menuitem">Previous</a></li>
                                                    <li aria-hidden="false" aria-disabled="false" class=""
                                                        style=""><a href="#next" role="menuitem">Next</a>
                                                    </li>
                                                    <li aria-hidden="true" style="display: none;"><a href="#finish"
                                                            role="menuitem">Finish</a></li>
                                                </ul>
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
    
    {{-- <script src="{{ asset('backend/assets/js/wizard.js') }}"></script> --}}

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
                                    onchange="previewImage(this)">
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
