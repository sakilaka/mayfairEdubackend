<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Activities Page</title>

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
                            Activities Page
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('frontend.activities') }}" target="_blank" class="btn btn-primary btn-fw">
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

                                    <form method="post" action="{{ route('admin.activities_page_setup') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">

                                            <div class="col-12 mb-3 px-4">
                                                <div class="row justify-content-between">
                                                    <h4 class="d-inline">Activities</h4>
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary"
                                                        id="add-activity">
                                                        <i class="fa fa-plus"></i>
                                                        Add
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-12 row" id="activities-container" style="padding-right: 0">

                                                @php
                                                    $contents = [];
                                                    if ($page && $page['contents']) {
                                                        $contents = json_decode($page->contents, true);
                                                    }
                                                @endphp

                                                @forelse ($contents as $key => $content)
                                                    <div class="col-sm-12 mb-3" style="padding-right: 0;">
                                                        @php
                                                            $random = rand();
                                                        @endphp

                                                        <div class="card-header" data-toggle="collapse"
                                                            data-target="#activity_single_collapse_{{ $random }}">
                                                            <div class="d-flex justify-content-between">
                                                                <h5 class="card-title mb-0 py-2 activity-title">
                                                                    <i class="fa fa-solid fa-plus"></i>
                                                                    Activity
                                                                    ({{ date('d M, Y', strtotime($content['date'])) }})
                                                                </h5>

                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-sm btn-danger remove-activity">
                                                                    <i class="fa fa-minus"></i>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="collapse"
                                                            id="activity_single_collapse_{{ $random }}">
                                                            <div class="card-body">
                                                                <div class="col-sm-12 mt-3">
                                                                    <div class="row px-0">
                                                                        <div class="col-md-9 px-0 mb-2"
                                                                            style="padding-right: 5px !important;">
                                                                            <label class="form-label">
                                                                                Title
                                                                                <span class="text-danger">*</span>
                                                                            </label>
                                                                            <input type="text" class="form-control"
                                                                                name="activities[{{ $random }}][activity_title]"
                                                                                placeholder="Enter Activity Title"
                                                                                value="{{ $content['title'] }}"
                                                                                required>
                                                                        </div>
                                                                        <div class="col-md-3 px-0 mb-2"
                                                                            style="padding-left: 5px !important;">
                                                                            <label class="form-label">
                                                                                Date
                                                                                <span class="text-danger">*</span>
                                                                            </label>
                                                                            <input type="date" class="form-control"
                                                                                name="activities[{{ $random }}][activity_date]"
                                                                                placeholder="Enter Activity Date"
                                                                                value="{{ $content['date'] }}" required>
                                                                        </div>
                                                                        <div class="col-sm-12 px-0">
                                                                            <label class="form-label">
                                                                                Description
                                                                            </label>
                                                                            <textarea class="form-control form-control-lg" rows="4"
                                                                                name="activities[{{ $random }}][activity_description]" placeholder="Write Activity Description">{{ $content['description'] }}</textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="d-flex justify-content-between mt-4">
                                                                        <h5 class="d-inline">Activity Image</h5>
                                                                        <a href="javascript:void(0)"
                                                                            class="btn btn-sm btn-primary add-activity-image"
                                                                            data-activity-key="{{ $random }}">
                                                                            <i class="fa fa-plus"></i>
                                                                            Add
                                                                        </a>
                                                                    </div>

                                                                    <div class="activity-image-container">

                                                                        @forelse ($content['images'] as $key => $image)
                                                                            <div class="row align-items-center mt-2">
                                                                                <div class="col-12 mt-3">
                                                                                    <div class="form-group">
                                                                                        <label>Image Title</label>
                                                                                        <input type="text"
                                                                                            class="form-control form-control-lg"
                                                                                            placeholder="Enter image alt title"
                                                                                            name="activities[{{ $random }}][image_title][{{ $key }}]"
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
                                                                                            name="activities[{{ $random }}][activity_image][{{ $key }}]"
                                                                                            accept="image/*">
                                                                                        <input type="hidden"
                                                                                            name="activities[{{ $random }}][old_activity_image][{{ $key }}]"
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
                                                                                        class="remove-activity-image btn btn-danger btn-sm m-0 ml-2">
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
                                                                                            name="activities[{{ $random }}][image_title][{{ $random }}]"
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
                                                                                            name="activities[{{ $random }}][activity_image][{{ $random }}]"
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
                                                                                        class="remove-activity-image btn btn-danger btn-sm m-0 ml-2">
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
                                                                <h5 class="card-title mb-0 py-2 activity-title">
                                                                    <i class="fa fa-solid fa-plus"></i>
                                                                    Activity
                                                                </h5>

                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-sm btn-danger remove-activity">
                                                                    <i class="fa fa-minus"></i>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="collapse"
                                                            id="activity_single_collapse_{{ $random }}">
                                                            <div class="card-body">
                                                                <div class="col-sm-12 mt-3">
                                                                    <div class="row px-0">
                                                                        <div class="col-md-9 px-0 mb-2"
                                                                            style="padding-right: 5px !important;">
                                                                            <label class="form-label">
                                                                                Title
                                                                                <span class="text-danger">*</span>
                                                                            </label>
                                                                            <input type="text" class="form-control"
                                                                                name="activities[{{ $random }}][activity_title]"
                                                                                placeholder="Enter Activity Title"
                                                                                required>
                                                                        </div>
                                                                        <div class="col-md-3 px-0 mb-2"
                                                                            style="padding-left: 5px !important;">
                                                                            <label class="form-label">
                                                                                Date
                                                                                <span class="text-danger">*</span>
                                                                            </label>
                                                                            <input type="date" class="form-control"
                                                                                name="activities[{{ $random }}][activity_date]"
                                                                                placeholder="Enter Activity Date"
                                                                                required>
                                                                        </div>
                                                                        <div class="col-sm-12 px-0">
                                                                            <label class="form-label">
                                                                                Description
                                                                            </label>
                                                                            <textarea class="form-control form-control-lg" rows="4"
                                                                                name="activities[{{ $random }}][activity_description]" placeholder="Write Activity Description"></textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="d-flex justify-content-between mt-4">
                                                                        <h5 class="d-inline">Activity Image</h5>
                                                                        <a href="javascript:void(0)"
                                                                            class="btn btn-sm btn-primary add-activity-image"
                                                                            data-activity-key="{{ $random }}">
                                                                            <i class="fa fa-plus"></i>
                                                                            Add
                                                                        </a>
                                                                    </div>

                                                                    <div class="activity-image-container">

                                                                        <div class="row align-items-center mt-2">
                                                                            <div class="col-12 mt-3">
                                                                                <div class="form-group">
                                                                                    <label>Image Title</label>
                                                                                    <input type="text"
                                                                                        class="form-control form-control-lg"
                                                                                        placeholder="Enter image alt title"
                                                                                        name="activities[{{ $random }}][image_title][{{ $random }}]"
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
                                                                                        name="activities[{{ $random }}][activity_image][{{ $random }}]"
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
                                                                                    class="remove-activity-image btn btn-danger btn-sm m-0 ml-2">
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

        /* add activity image */
        $(document).on('click', '.add-activity-image', function() {
            var randomNumber = Math.floor(10000 + Math.random() * 90000);
            let activityKey = $(this).data('activity-key');

            var myvar = `
                <div class="row align-items-center mt-2">
                    <div class="col-12 mt-3">
                        <div class="form-group">
                            <label>Image Title</label>
                            <input type="text"
                                class="form-control form-control-lg"
                                placeholder="Enter image alt title"
                                name="activities[${activityKey}][image_title][${randomNumber}]"
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
                                name="activities[${activityKey}][activity_image][${randomNumber}]"
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
                            class="remove-activity-image btn btn-danger btn-sm m-0 ml-2">
                            <i class="fas fa-minus-circle"> </i>
                        </a>
                    </div>

                </div>
            `;
            $(this).parent().siblings('.activity-image-container').prepend(myvar);
            $(`.dropify`).dropify();
        });

        $(document).on('click', '.remove-activity-image', function() {
            $(this).parent().parent().remove();
        });

        /* add activity */
        $(document).on('click', '#add-activity', function() {
            var randomNumber = Math.floor(10000 + Math.random() * 90000);

            var myvar = `
                <div class="col-sm-12 mb-3" style="padding-right: 0;">
                    <div class="card-header" data-toggle="collapse"
                        data-target="#activity_single_collapse_${randomNumber}">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title mb-0 py-2 activity-title">
                                <i class="fa fa-solid fa-plus"></i>
                                Activity
                            </h5>

                            <a href="javascript:void(0)"
                                class="btn btn-sm btn-danger remove-activity">
                                <i class="fa fa-minus"></i>
                            </a>
                        </div>
                    </div>

                    <div class="collapse"
                        id="activity_single_collapse_${randomNumber}">
                        <div class="card-body">
                            <div class="col-sm-12 mt-3">
                                <div class="row px-0">
                                    <div class="col-md-9 px-0 mb-2" style="padding-right: 5px !important;">
                                        <label class="form-label">
                                            Title
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control"
                                            name="activities[${randomNumber}][activity_title]"
                                            placeholder="Enter Activity Title" required>
                                    </div>
                                    <div class="col-md-3 px-0 mb-2" style="padding-left: 5px !important;">
                                        <label class="form-label">
                                            Date
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="date" class="form-control"
                                            name="activities[${randomNumber}][activity_date]"
                                            placeholder="Enter Activity Date" required>
                                    </div>
                                    <div class="col-sm-12 px-0">
                                        <label class="form-label">
                                            Description
                                        </label>
                                        <textarea class="form-control form-control-lg" rows="4"
                                            name="activities[${randomNumber}][activity_description]" placeholder="Write Activity Description"></textarea>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <h5 class="d-inline">Activity Image</h5>
                                    <a href="javascript:void(0)"
                                        class="btn btn-sm btn-primary add-activity-image"
                                        data-activity-key="${randomNumber}">
                                        <i class="fa fa-plus"></i>
                                        Add
                                    </a>
                                </div>

                                <div class="activity-image-container">

                                    <div class="row align-items-center mt-2">
                                        <div
                                            class="col-sm-12 col-md-5 mt-3 img-upload-container">
                                            <label class="form-control-label">Upload
                                                Image:</label>
                                            <div class="dropify-wrapper"
                                                style="border: none">
                                                <div class="dropify-loader"></div>
                                                <div class="dropify-errors-container">
                                                    <ul></ul>
                                                </div>
                                                <input type="file" class="dropify"
                                                    name="activities[${randomNumber}][activity_image][${randomNumber}]"
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
                                                class="remove-activity-image btn btn-danger btn-sm m-0 ml-2">
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

            $('#activities-container').prepend(myvar);
            $(`.dropify`).dropify();
        });

        $(document).on('click', '.remove-activity', function() {
            $(this).parent().parent().parent().remove();
        });
    </script>
</body>

</html>
