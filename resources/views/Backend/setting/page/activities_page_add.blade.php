<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Add Activity</title>

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
                            Add Activity
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.activities_page') }}" target="_blank" class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All Activity
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

                                        <div class="row px-2">
                                            @php
                                                $random = rand();
                                            @endphp

                                            <div class="col-12 row align-items-center mb-2">
                                                <div class="col-sm-12 col-md-6 mt-3 img-upload-container">
                                                    <label class="form-control-label">Upload
                                                        Activity Banner:</label>
                                                    <div class="dropify-wrapper" style="border: none">
                                                        <div class="dropify-loader">
                                                        </div>
                                                        <div class="dropify-errors-container">
                                                            <ul></ul>
                                                        </div>
                                                        <input type="file" class="dropify"
                                                            name="activities[{{ $random }}][activity_image][{{ $random }}]"
                                                            accept="image/*">
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
                                                            alt="" class="img-fluid"
                                                            style="border-radius: 10px; max-height: 200px !important;">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-9 mb-2">
                                                <label class="form-label">
                                                    Title
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control"
                                                    name="activities[{{ $random }}][activity_title]"
                                                    placeholder="Enter Activity Title" required>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-label">
                                                    Date
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="date" class="form-control"
                                                    name="activities[{{ $random }}][activity_date]"
                                                    placeholder="Enter Activity Date" required>
                                            </div>
                                            <div class="col-sm-12">
                                                <label class="form-label">
                                                    Description
                                                </label>
                                                <textarea class="form-control form-control-lg editor" rows="4"
                                                    name="activities[{{ $random }}][activity_description]" placeholder="Write Activity Description"></textarea>
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
    </script>
</body>

</html>
