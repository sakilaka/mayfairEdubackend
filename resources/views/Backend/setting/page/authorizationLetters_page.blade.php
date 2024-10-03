<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Authorization Page</title>

    <style>
        .form-label {
            font-weight: bold;
            color: rgb(94, 94, 94)
        }
    </style>
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
                            Authorization Page
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('frontend.authorization_letters') }}" target="_blank" class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View Page
                            </a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-2">
                            @include('Backend.setting.page.other_pages_nav_tabs')
                        </div>

                        <div class="col-10">
                            <div class="tab-content tab-content-vertical bg-white rounded">
                                <div class="tab-pane fade show active" id="program-info-tab-content" role="tabpanel"
                                    aria-labelledby="home-tab-vertical">

                                    <form method="post" action="{{ route('admin.authorizationLetters_page_setup') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">

                                            <div class="col-12 mb-3 px-4">
                                                <div class="row justify-content-between">
                                                    <h4 class="d-inline">Authorization Letters</h4>
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary"
                                                        id="add-gallery">
                                                        <i class="fa fa-plus"></i>
                                                        Add
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-12 row" id="authorization_letters-container" style="padding-right: 0">

                                                @php
                                                    $contents = [];
                                                    if ($page && $page['contents']) {
                                                        $contents = json_decode($page->contents, true);
                                                    }
                                                @endphp

                                                @forelse ($contents as $letterKey => $content)
                                                    <div class="col-sm-12 mb-3" style="padding-right: 0;">
                                                        @php
                                                            $random = rand();
                                                        @endphp

                                                        <div class="card-header" data-toggle="collapse"
                                                            data-target="#activity_single_collapse_{{ $letterKey }}">
                                                            <div class="d-flex justify-content-between">
                                                                <h5 class="card-title mb-0 py-2 gallery-title">
                                                                    <i class="fa fa-file" aria-hidden="true"></i> &nbsp;
                                                                    {{ $content['title'] ?? 'Authorization Letters' }}
                                                                </h5>

                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-sm btn-danger remove-gallery">
                                                                    <i class="fa fa-minus"></i>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="collapse"
                                                            id="activity_single_collapse_{{ $letterKey }}">
                                                            <div class="card-body">
                                                                <div class="col-sm-12 mt-3">
                                                                    <div class="row px-0">
                                                                        <div class="col-md-12 px-0 mb-2"
                                                                            style="padding-right: 5px !important;">
                                                                            <label class="form-label">
                                                                                Title
                                                                                <span class="text-danger">*</span>
                                                                            </label>
                                                                            <input type="text" class="form-control"
                                                                                name="authorization_letters[{{ $letterKey }}][authorization_letter_title]"
                                                                                placeholder="Enter Authorization Title"
                                                                                value="{{ $content['title'] }}"
                                                                                required>
                                                                        </div>
                                                                        <div class="col-sm-12 px-0">
                                                                            <label class="form-label">
                                                                                Description
                                                                            </label>
                                                                            <textarea class="form-control form-control-lg" rows="4"
                                                                                name="authorization_letters[{{ $letterKey }}][authorization_letter_description]" placeholder="Write Authorization Description">{{ $content['description'] }}</textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="d-flex justify-content-between mt-4">
                                                                        <h5 class="d-inline">Authorization Image</h5>
                                                                        <a href="javascript:void(0)"
                                                                            class="btn btn-sm btn-primary add-gallery-image"
                                                                            data-gallery-key="{{ $letterKey }}">
                                                                            <i class="fa fa-plus"></i>
                                                                            Add
                                                                        </a>
                                                                    </div>

                                                                    <div class="gallery-image-container">

                                                                        @forelse ($content['images'] as $key => $image)
                                                                            <div class="row align-items-center mt-2">
                                                                                <div class="col-12 mt-3">
                                                                                    <div class="form-group">
                                                                                        <label>Image Title</label>
                                                                                        <input type="text"
                                                                                            class="form-control form-control-lg"
                                                                                            placeholder="Enter image alt title"
                                                                                            name="authorization_letters[{{ $letterKey }}][image_title][{{ $key }}]"
                                                                                            value="{{ $content['image_titles'][$key] ?? '' }}">
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="col-sm-12 col-md-5 img-upload-container">
                                                                                    <label
                                                                                        class="form-control-label">Upload
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
                                                                                            name="authorization_letters[{{ $letterKey }}][authorization_letter_image][{{ $key }}]"
                                                                                            accept="image/*">
                                                                                        <input type="hidden"
                                                                                            name="authorization_letters[{{ $letterKey }}][old_authorization_letter_image][{{ $key }}]"
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
                                                                                        <img src="{{ $image ?? asset('frontend/images/No-image.jpg') }}"
                                                                                            alt=""
                                                                                            class="img-fluid"
                                                                                            style="border-radius: 10px; max-height: 200px !important;">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-1">
                                                                                    <a href="javascript:void(0)"
                                                                                        class="remove-gallery-image btn btn-danger btn-sm m-0 ml-2">
                                                                                        <i class="fas fa-minus-circle">
                                                                                        </i>
                                                                                    </a>
                                                                                </div>

                                                                            </div>
                                                                        @empty
                                                                            <div class="row align-items-center mt-2">
                                                                                <div class="col-12 mt-3">
                                                                                    <div class="form-group">
                                                                                        <label>Image Title</label>
                                                                                        <input type="text"
                                                                                            class="form-control form-control-lg"
                                                                                            placeholder="Enter image alt title"
                                                                                            name="authorization_letters[{{ $letterKey }}][image_title][{{ $random }}]"
                                                                                            value="">
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="col-sm-12 col-md-5 mt-3 img-upload-container">
                                                                                    <label
                                                                                        class="form-control-label">Upload
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
                                                                                            name="authorization_letters[{{ $letterKey }}][authorization_letter_image][{{ $random }}]"
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

                                                                                <div class="col-1">
                                                                                    <a href="javascript:void(0)"
                                                                                        class="remove-gallery-image btn btn-danger btn-sm m-0 ml-2">
                                                                                        <i class="fas fa-minus-circle">
                                                                                        </i>
                                                                                    </a>
                                                                                </div>

                                                                            </div>
                                                                        @endforelse

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="col-sm-12 mb-3" style="padding-right: 0;">
                                                        @php
                                                            $random = rand();
                                                        @endphp

                                                        <div class="card-header" data-toggle="collapse"
                                                            data-target="#activity_single_collapse_{{ $random }}">
                                                            <div class="d-flex justify-content-between">
                                                                <h5 class="card-title mb-0 py-2 gallery-title">
                                                                    <i class="fa fa-file" aria-hidden="true"></i>&nbsp;
                                                                    Authorization Letters
                                                                </h5>

                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-sm btn-danger remove-gallery">
                                                                    <i class="fa fa-minus"></i>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="collapse"
                                                            id="activity_single_collapse_{{ $random }}">
                                                            <div class="card-body">
                                                                <div class="col-sm-12 mt-3">
                                                                    <div class="row px-0">
                                                                        <div class="col-md-12 px-0 mb-2"
                                                                            style="padding-right: 5px !important;">
                                                                            <label class="form-label">
                                                                                Title
                                                                                <span class="text-danger">*</span>
                                                                            </label>
                                                                            <input type="text" class="form-control"
                                                                                name="authorization_letters[{{ $random }}][authorization_letter_title]"
                                                                                placeholder="Enter Authorization Title"
                                                                                required>
                                                                        </div>
                                                                        <div class="col-sm-12 px-0">
                                                                            <label class="form-label">
                                                                                Description
                                                                            </label>
                                                                            <textarea class="form-control form-control-lg" rows="4"
                                                                                name="authorization_letters[{{ $random }}][authorization_letter_description]" placeholder="Write Authorization Description"></textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="d-flex justify-content-between mt-4">
                                                                        <h5 class="d-inline">Authorization Image</h5>
                                                                        <a href="javascript:void(0)"
                                                                            class="btn btn-sm btn-primary add-gallery-image"
                                                                            data-gallery-key="{{ $random }}">
                                                                            <i class="fa fa-plus"></i>
                                                                            Add
                                                                        </a>
                                                                    </div>

                                                                    <div class="gallery-image-container">

                                                                        <div class="row align-items-center mt-2">
                                                                            <div class="col-12 mt-3">
                                                                                <div class="form-group">
                                                                                    <label>Image Title</label>
                                                                                    <input type="text"
                                                                                        class="form-control form-control-lg"
                                                                                        placeholder="Enter image alt title"
                                                                                        name="authorization_letters[{{ $random }}][image_title][{{ $random }}]"
                                                                                        value="">
                                                                                </div>
                                                                            </div>

                                                                            <div
                                                                                class="col-sm-12 col-md-5 img-upload-container">
                                                                                <label
                                                                                    class="form-control-label">Upload
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
                                                                                        name="authorization_letters[{{ $random }}][authorization_letter_image][{{ $random }}]"
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

                                                                            <div class="col-1">
                                                                                <a href="javascript:void(0)"
                                                                                    class="remove-gallery-image btn btn-danger btn-sm m-0 ml-2">
                                                                                    <i class="fas fa-minus-circle">
                                                                                    </i>
                                                                                </a>
                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforelse

                                            </div>
                                        </div>

                                        <div class="row tabs-footer mt-3">
                                            <div class="col-lg-12 text-center">
                                                <button type="submit" class="btn blue-btn btn-primary">Save</button>
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

        /* add gallery image */
        $(document).on('click', '.add-gallery-image', function() {
            var randomNumber = Math.floor(10000 + Math.random() * 90000);
            let activityKey = $(this).data('gallery-key');

            var myvar = `
                <div class="row align-items-center mt-2">
                    <div class="col-12 mt-3">
                        <div class="form-group">
                            <label>Image Title</label>
                            <input type="text"
                                class="form-control form-control-lg"
                                placeholder="Enter image alt title"
                                name="authorization_letters[${activityKey}][image_title][${randomNumber}]"
                                value="">
                        </div>
                    </div>
                    
                    <div
                        class="col-sm-12 col-md-5 img-upload-container">
                        <label class="form-control-label">Upload
                            Image:</label>
                        <div class="dropify-wrapper"
                            style="border: none">
                            <div class="dropify-loader"></div>
                            <div class="dropify-errors-container">
                                <ul></ul>
                            </div>
                            <input type="file" class="dropify"
                                name="authorization_letters[${activityKey}][authorization_letter_image][${randomNumber}]"
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
                            class="remove-gallery-image btn btn-danger btn-sm m-0 ml-2">
                            <i class="fas fa-minus-circle"> </i>
                        </a>
                    </div>

                </div>
            `;
            
            $(this).parent().siblings('.gallery-image-container').prepend(myvar);
            $(`.dropify`).dropify();
        });

        $(document).on('click', '.remove-gallery-image', function() {
            $(this).parent().parent().remove();
        });

        /* add gallery */
        $(document).on('click', '#add-gallery', function() {
            var randomNumber = Math.floor(10000 + Math.random() * 90000);

            var myvar = `
                <div class="col-sm-12 mb-3" style="padding-right: 0;">
                    <div class="card-header" data-toggle="collapse"
                        data-target="#activity_single_collapse_${randomNumber}">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title mb-0 py-2 gallery-title">
                                <i class="fa fa-file" aria-hidden="true"></i>&nbsp;
                                Authorization Letters
                            </h5>

                            <a href="javascript:void(0)"
                                class="btn btn-sm btn-danger remove-gallery">
                                <i class="fa fa-minus"></i>
                            </a>
                        </div>
                    </div>

                    <div class="collapse"
                        id="activity_single_collapse_${randomNumber}">
                        <div class="card-body">
                            <div class="col-sm-12 mt-3">
                                <div class="row px-0">
                                    <div class="col-md-12 px-0 mb-2" style="padding-right: 5px !important;">
                                        <label class="form-label">
                                            Title
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control"
                                            name="authorization_letters[${randomNumber}][authorization_letter_title]"
                                            placeholder="Enter Authorization Title" required>
                                    </div>
                                    <div class="col-sm-12 px-0">
                                        <label class="form-label">
                                            Description
                                        </label>
                                        <textarea class="form-control form-control-lg" rows="4"
                                            name="authorization_letters[${randomNumber}][authorization_letter_description]" placeholder="Write Authorization Description"></textarea>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <h5 class="d-inline">Authorization Image</h5>
                                    <a href="javascript:void(0)"
                                        class="btn btn-sm btn-primary add-gallery-image"
                                        data-gallery-key="${randomNumber}">
                                        <i class="fa fa-plus"></i>
                                        Add
                                    </a>
                                </div>

                                <div class="gallery-image-container">

                                    <div class="row align-items-center mt-2">
                                        <div class="col-12 mt-3">
                                            <div class="form-group">
                                                <label>Image Title</label>
                                                <input type="text"
                                                    class="form-control form-control-lg"
                                                    placeholder="Enter image alt title"
                                                    name="authorization_letters[${randomNumber}][image_title][${randomNumber}]"
                                                    value="">
                                            </div>
                                        </div>

                                        <div
                                            class="col-sm-12 col-md-5 img-upload-container">
                                            <label class="form-control-label">Upload
                                                Image:</label>
                                            <div class="dropify-wrapper"
                                                style="border: none">
                                                <div class="dropify-loader"></div>
                                                <div class="dropify-errors-container">
                                                    <ul></ul>
                                                </div>
                                                <input type="file" class="dropify"
                                                    name="authorization_letters[${randomNumber}][authorization_letter_image][${randomNumber}]"
                                                    accept="image/*">
                                                <button type="button"
                                                    class="dropify-clear">Remove</button>
                                                <div class="dropify-preview">
                                                    <span class="dropify-render"></span>
                                                    <div class="dropify-infos">
                                                        <div
                                                            class="dropify-infos-inner">
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
                                                class="remove-gallery-image btn btn-danger btn-sm m-0 ml-2">
                                                <i class="fas fa-minus-circle">
                                                </i>
                                            </a>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            $('#authorization_letters-container').prepend(myvar);
            $(`.dropify`).dropify();
        });

        $(document).on('click', '.remove-gallery', function() {
            $(this).parent().parent().parent().remove();
        });
    </script>
</body>

</html>
