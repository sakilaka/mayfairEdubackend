<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Expo Join Page for '{{ $expo->title }}'</title>

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
                            Join Page for '{{ $expo->title }}'
                        </h3>

                        <nav aria-label="breadcrumb" class="d-flex justify-content-around align-items-center">
                            <a href="{{ route('admin.expo.index') }}" class="btn btn-secondary-bg btn-fw"
                                style="margin-right: 5px">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View Expo
                            </a>
                            <a href="{{ route('expo.join', ['unique_id' => $expo->unique_id]) }}"
                                class="btn btn-primary-bg btn-fw" target="_blank">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View Page
                            </a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="tab-content tab-content-vertical bg-white rounded">
                                <div class="tab-pane fade show active" id="program-info-tab-content" role="tabpanel"
                                    aria-labelledby="home-tab-vertical">

                                    <form method="post"
                                        action="{{ route('admin.expo.media.gallery.update', ['expo_id' => $expo->unique_id]) }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-12 mb-3 px-4">
                                                <div class="row justify-content-between">
                                                    <h5 class="d-inline">How to join (Steps)</h5>
                                                </div>
                                            </div>
                                            <div class="col-12">

                                            </div>

                                            <div class="col-12 mb-3 px-4">
                                                <div class="row justify-content-between align-self-center">
                                                    <h5 class="d-inline">Contact References</h5>

                                                    <div class="d-flex justify-content-end">
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary-bg"
                                                            id="add-gallery">
                                                            <i class="fa fa-plus"></i>
                                                            Add
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 row" id="galleries-container" style="padding-right: 0">
                                                @php
                                                    $contents = [];
                                                    if ($expo && $expo['gallery']) {
                                                        $contents = json_decode($expo->gallery, true);
                                                    }
                                                @endphp

                                                @forelse ($contents as $galleryKey => $content)
                                                    <div class="col-sm-12 mb-3" style="padding-right: 0;">
                                                        @php
                                                            $random = rand();
                                                        @endphp

                                                        <div class="card-header" data-toggle="collapse"
                                                            data-target="#activity_single_collapse_{{ $galleryKey }}">
                                                            <div class="d-flex justify-content-between">
                                                                <h5 class="card-title mb-0 py-2 gallery-title">
                                                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                                                    &nbsp;
                                                                    {{ $content['title'] ?? 'Gallery' }}
                                                                </h5>

                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-sm btn-danger remove-gallery">
                                                                    <i class="fa fa-minus"></i>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="collapse"
                                                            id="activity_single_collapse_{{ $galleryKey }}">
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
                                                                                name="galleries[{{ $galleryKey }}][gallery_title]"
                                                                                placeholder="Enter Gallery Title"
                                                                                value="{{ $content['title'] }}"
                                                                                required>
                                                                        </div>
                                                                        <div class="col-sm-12 px-0">
                                                                            <label class="form-label">
                                                                                Description
                                                                            </label>
                                                                            <textarea class="form-control form-control-lg" rows="4"
                                                                                name="galleries[{{ $galleryKey }}][gallery_description]" placeholder="Write Gallery Description">{{ $content['description'] }}</textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="d-flex justify-content-between mt-4">
                                                                        <h5 class="d-inline">Gallery Image</h5>
                                                                        <a href="javascript:void(0)"
                                                                            class="btn btn-sm btn-primary add-gallery-image"
                                                                            data-gallery-key="{{ $galleryKey }}">
                                                                            <i class="fa fa-plus"></i>
                                                                            Add
                                                                        </a>
                                                                    </div>

                                                                    <div class="gallery-image-container">

                                                                        @forelse ($content['images'] as $imageKey => $image)
                                                                            <div class="row align-items-center mt-2">
                                                                                <div class="col-12 mt-3">
                                                                                    <div class="form-group">
                                                                                        <label>Image Title</label>
                                                                                        <input type="text"
                                                                                            class="form-control form-control-lg"
                                                                                            placeholder="Enter image alt title"
                                                                                            name="galleries[{{ $galleryKey }}][image_title][{{ $imageKey }}]"
                                                                                            value="{{ $content['image_titles'][$imageKey] ?? '' }}">
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
                                                                                            name="galleries[{{ $galleryKey }}][gallery_image][{{ $imageKey }}]"
                                                                                            accept="image/*">
                                                                                        <input type="hidden"
                                                                                            name="galleries[{{ $galleryKey }}][old_gallery_image][{{ $imageKey }}]"
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
                                                                                            name="galleries[{{ $galleryKey }}][image_title][{{ $random }}]"
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
                                                                                            name="galleries[{{ $galleryKey }}][gallery_image][{{ $random }}]"
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
                                                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                                                    Gallery
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
                                                                                name="galleries[{{ $random }}][gallery_title]"
                                                                                placeholder="Enter Gallery Title"
                                                                                required>
                                                                        </div>
                                                                        <div class="col-sm-12 px-0">
                                                                            <label class="form-label">
                                                                                Description
                                                                            </label>
                                                                            <textarea class="form-control form-control-lg" rows="4"
                                                                                name="galleries[{{ $random }}][gallery_description]" placeholder="Write Gallery Description"></textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="d-flex justify-content-between mt-4">
                                                                        <h5 class="d-inline">Gallery Image</h5>
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
                                                                                        name="galleries[{{ $random }}][image_title][{{ $random }}]"
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
                                                                                        name="galleries[{{ $random }}][gallery_image][{{ $random }}]"
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

                                            <div class="col-12 mt-3">
                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" class="btn blue-btn btn-secondary-bg"
                                                        style="margin-right: 8px">Save</button>
                                                </div>
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
                                name="galleries[${activityKey}][image_title][${randomNumber}]"
                                value="">
                        </div>
                    </div>
                    
                    <div
                        class="col-sm-12 col-md-5 mt-3 img-upload-container">
                        <label class="form-control-label">Add
                            Image:</label>
                        <div class="dropify-wrapper"
                            style="border: none">
                            <div class="dropify-loader"></div>
                            <div class="dropify-errors-container">
                                <ul></ul>
                            </div>
                            <input type="file" class="dropify"
                                name="galleries[${activityKey}][gallery_image][${randomNumber}]"
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
                                <i class="fa fa-camera" aria-hidden="true"></i>&nbsp;
                                Gallery
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
                                            name="galleries[${randomNumber}][gallery_title]"
                                            placeholder="Enter Gallery Title" required>
                                    </div>
                                    <div class="col-sm-12 px-0">
                                        <label class="form-label">
                                            Description
                                        </label>
                                        <textarea class="form-control form-control-lg" rows="4"
                                            name="galleries[${randomNumber}][gallery_description]" placeholder="Write Gallery Description"></textarea>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <h5 class="d-inline">Gallery Image</h5>
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
                                                    name="galleries[${randomNumber}][image_title][${randomNumber}]"
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
                                                    name="galleries[${randomNumber}][gallery_image][${randomNumber}]"
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

            $('#galleries-container').prepend(myvar);
            $(`.dropify`).dropify();
        });

        $(document).on('click', '.remove-gallery', function() {
            $(this).parent().parent().parent().remove();
        });
    </script>
</body>

</html>
