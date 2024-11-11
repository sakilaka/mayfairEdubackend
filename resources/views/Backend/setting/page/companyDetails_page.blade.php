<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Company Details Page</title>

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
                            Company Details Page
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('frontend.company_details') }}" target="_blank"
                                class="btn btn-primary btn-fw">
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

                                    <form method="post" action="{{ route('admin.companyDetails_page_setup') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        @php
                                            $contents = [];
                                            if ($page && $page['contents']) {
                                                $contents = json_decode($page->contents, true);
                                            }
                                        @endphp

                                        <div class="row">
                                            <div class="col-6 col-md-4 mb-2">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Since (Year)
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control-lg"
                                                        name="since_year" placeholder="Enter Year" value="{{ $contents['since_year'] ?? '' }}" required>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-8 mb-2">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Title
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control-lg"
                                                        name="title" placeholder="Enter Title" value="{{ $contents['title'] ?? '' }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Description
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea type="text" class="form-control form-control-lg editor" name="description" rows="5"
                                                        placeholder="Enter Description">{{ $contents['description'] ?? '' }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 mb-3">
                                                <div class="card-header" data-toggle="collapse"
                                                    data-target="#photo_gallery_image">
                                                    <h5 class="card-title mb-0 py-2">
                                                        <i class="fa fa-solid fa-plus"></i>
                                                        Photos
                                                    </h5>
                                                </div>

                                                <div class="collapse" id="photo_gallery_image">
                                                    <div class="card-body">
                                                        <div class="col-sm-12 mt-3">
                                                            <div class="d-flex justify-content-between">
                                                                <h5 class="d-inline">Photos (Max: 4 Images)</h5>
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-sm btn-primary"
                                                                    id="add-photo-gallery-image">
                                                                    <i class="fa fa-plus"></i>
                                                                    Add
                                                                </a>
                                                            </div>

                                                            <div class="photo-gallery-container">
                                                                @php
                                                                    $galleryImages = $contents['images'] ?? [];
                                                                @endphp

                                                                @forelse ($galleryImages as $key => $image)
                                                                    <div class="row align-items-center mt-2">
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
                                                                                    name="photo_gallery_image[{{ $random }}]"
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
                                                </div>
                                            </div>

                                            <div class="col-sm-12 mb-3">
                                                <div class="card-header" data-toggle="collapse"
                                                    data-target="#media_partner_image">
                                                    <h5 class="card-title mb-0 py-2">
                                                        <i class="fa fa-solid fa-plus"></i>
                                                        Media Partners
                                                    </h5>
                                                </div>

                                                <div class="collapse" id="media_partner_image">
                                                    <div class="card-body">
                                                        <div class="col-sm-12 mt-3">
                                                            <div class="d-flex justify-content-between">
                                                                <h5 class="d-inline">Media Partners</h5>
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-sm btn-primary"
                                                                    id="add-media-partner">
                                                                    <i class="fa fa-plus"></i>
                                                                    Add
                                                                </a>
                                                            </div>

                                                            <div class="col-sm-12 px-0">
                                                                <label class="form-label">
                                                                    Title
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control form-control-lg"
                                                                    name="media_partner_title" value="{{ $contents['mediaPartners']['title'] ?? '' }}" required>
                                                            </div>

                                                            <div class="media-partner-container">
                                                                @php
                                                                    $mediaPartnerImages = $contents['mediaPartners']['partners'] ?? [];
                                                                @endphp

                                                                @forelse ($mediaPartnerImages as $key => $image)
                                                                    <div class="row align-items-center mt-2">
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
                                                                                    name="media_partner_image[{{ $key }}]"
                                                                                    accept="image/*">
                                                                                <input type="hidden"
                                                                                    name="old_media_partner_image[{{ $key }}]"
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
                                                                                    alt="" class="img-fluid"
                                                                                    style="border-radius: 10px; max-height: 200px !important;">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-1">
                                                                            <a href="javascript:void(0)"
                                                                                class="remove-media-partner btn btn-danger btn-sm m-0 ml-2">
                                                                                <i class="fas fa-minus-circle"> </i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @empty
                                                                    <div class="row align-items-center mt-2">
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
                                                                                    name="media_partner_image[{{ rand(10000, 99999) }}]"
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

                                                                        <div class="col-1">
                                                                            <a href="javascript:void(0)"
                                                                                class="remove-media-partner btn btn-danger btn-sm m-0 ml-2">
                                                                                <i class="fas fa-minus-circle"> </i>
                                                                            </a>
                                                                        </div>

                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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

        /* add photo gallery image */
        $('#add-photo-gallery-image').on('click', function() {
            var randomNumber = Math.floor(10000 + Math.random() * 90000);

            var myvar = `
                <div class="row align-items-center mt-2">
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

        /* add media partner */
        $('#add-media-partner').on('click', function() {
            var randomNumber = Math.floor(10000 + Math.random() * 90000);

            var myvar = `
                <div class="row align-items-center mt-2">
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
                                name="media_partner_image[${randomNumber}]"
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
                            class="remove-media-partner btn btn-danger btn-sm m-0 ml-2">
                            <i class="fas fa-minus-circle"> </i>
                        </a>
                    </div>

                </div>
            `;
            $('.media-partner-container').prepend(myvar);
            $(`.dropify`).dropify();
        });

        $(document).on('click', '.remove-media-partner', function() {
            $(this).parent().parent().remove();
        });
    </script>
</body>

</html>
