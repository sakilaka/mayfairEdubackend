<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Our Services Page</title>

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
                            Our Services Page
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('frontend.our_services') }}" target="_blank" class="btn btn-primary btn-fw">
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

                                    <form method="post" action="{{ route('admin.ourServices_page_setup') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            {{-- <div class="col-sm-12 mb-3">
                                                <div class="card-header" data-toggle="collapse"
                                                    data-target="#services_mini_image">
                                                    <h5 class="card-title mb-0 py-2">
                                                        <i class="fa fa-solid fa-plus"></i>
                                                        Services (Mini Cards)
                                                    </h5>
                                                </div>

                                                <div class="collapse" id="services_mini_image">
                                                    <div class="card-body">
                                                        <div class="col-sm-12 mt-3">
                                                            <div class="d-flex justify-content-between">
                                                                <h5 class="d-inline">Services (Mini)</h5>
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-sm btn-primary"
                                                                    id="add-services-mini">
                                                                    <i class="fa fa-plus"></i>
                                                                    Add
                                                                </a>
                                                            </div>

                                                            <div class="services-mini-container">
                                                                @php
                                                                    $servicesMini = [];
                                                                    if ($page && $page['contents']) {
                                                                        $otherContents = json_decode(
                                                                            $page['contents'],
                                                                            true,
                                                                        );
                                                                        $servicesMini =
                                                                            $otherContents['servicesMini'] ?? [];
                                                                    }
                                                                @endphp

                                                                @forelse ($servicesMini as $key => $service)
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
                                                                                    name="services_mini_image[{{ $key }}]"
                                                                                    accept="image/*">
                                                                                <input type="hidden"
                                                                                    name="old_services_mini_image[{{ $key }}]"
                                                                                    value="{{ $service['image'] }}">
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
                                                                                <img src="{{ $service['image'] ?? asset('frontend/images/No-image.jpg') }}"
                                                                                    alt="" class="img-fluid"
                                                                                    style="border-radius: 10px; max-height: 200px !important;">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-11 mt-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Description
                                                                                    (7-8 Words)
                                                                                    <span class="text-danger">*</span>
                                                                                </label>
                                                                                <input type="text"
                                                                                    class="form-control form-control-lg"
                                                                                    name="service_mini_description[]"
                                                                                    value="{{ $service['description'] }}"
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <a href="javascript:void(0)"
                                                                                class="remove-services-mini btn btn-danger btn-sm m-0 ml-2">
                                                                                <i class="fas fa-minus-circle"> </i>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-12 border-top"></div>
                                                                    </div>
                                                                @empty
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
                                                                                    name="services_mini_image[{{ rand(10000, 99999) }}]"
                                                                                    accept="image/*">
                                                                                <button type="button"
                                                                                    class="dropify-clear">Remove</button>
                                                                                <div class="dropify-preview">
                                                                                    <span class="dropify-render"></span>
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

                                                                        <div class="col-11 mt-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Description
                                                                                    (7-8 Words)
                                                                                    <span class="text-danger">*</span>
                                                                                </label>
                                                                                <input type="text"
                                                                                    class="form-control form-control-lg"
                                                                                    name="service_mini_description[]"
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <a href="javascript:void(0)"
                                                                                class="remove-services-mini btn btn-danger btn-sm m-0 ml-2">
                                                                                <i class="fas fa-minus-circle"> </i>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-12 border-top"></div>
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}

                                            <div class="col-sm-12 mb-3">
                                                {{-- <div class="card-header" data-toggle="collapse"
                                                    data-target="#services_large_image">
                                                    <h5 class="card-title mb-0 py-2">
                                                        <i class="fa fa-solid fa-plus"></i>
                                                        Services (Large Cards)
                                                    </h5>
                                                </div> --}}

                                                <div class="{{-- collapse --}}" id="services_large_image">
                                                    <div class="card-body">
                                                        <div class="col-sm-12 {{-- mt-3 --}}">
                                                            <div class="d-flex justify-content-between">
                                                                <h5 class="d-inline">Our Services {{-- (Large) --}}</h5>
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-sm btn-primary"
                                                                    id="add-services-large">
                                                                    <i class="fa fa-plus"></i>
                                                                    Add
                                                                </a>
                                                            </div>

                                                            <div class="services-large-container">
                                                                @php
                                                                    $servicesLarge = [];
                                                                    if ($page && $page['contents']) {
                                                                        $otherContents = json_decode(
                                                                            $page['contents'],
                                                                            true,
                                                                        );
                                                                        $servicesLarge =
                                                                            $otherContents['servicesLarge'] ?? [];
                                                                    }
                                                                @endphp

                                                                @forelse ($servicesLarge as $key => $service)
                                                                    <div class="row align-items-center mt-2">
                                                                        <div class="col-12 row align-items-center">
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
                                                                                        name="services_large_image[{{ $key }}]"
                                                                                        accept="image/*">
                                                                                    <input type="hidden"
                                                                                        name="old_services_large_image[{{ $key }}]"
                                                                                        value="{{ $service['image'] }}">
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
                                                                                class="img-preview-container col-sm-11 col-md-5 d-flex justify-content-center align-items-center">
                                                                                <div class="px-3 mt-3">
                                                                                    <img src="{{ $service['image'] ?? asset('frontend/images/No-image.jpg') }}"
                                                                                        alt=""
                                                                                        class="img-fluid"
                                                                                        style="border-radius: 10px; max-height: 200px !important;">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-1">
                                                                                <a href="javascript:void(0)"
                                                                                    class="remove-services-large btn btn-danger btn-sm m-0 ml-2">
                                                                                    <i class="fas fa-minus-circle">
                                                                                    </i>
                                                                                </a>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-11 mt-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label fw-bold">Title
                                                                                    (2-3 Words)
                                                                                    <span class="text-danger">*</span>
                                                                                </label>
                                                                                <input type="text"
                                                                                    class="form-control form-control-lg"
                                                                                    name="service_large_title[]"
                                                                                    value="{{ $service['title'] }}"
                                                                                    required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="form-label fw-bold">Description
                                                                                    (10 Words)
                                                                                    <span class="text-danger">*</span>
                                                                                </label>
                                                                                <input type="text"
                                                                                    class="form-control form-control-lg"
                                                                                    name="service_large_description[]"
                                                                                    value="{{ $service['description'] }}"
                                                                                    required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 border-top"></div>
                                                                    </div>
                                                                @empty
                                                                    <div class="row align-items-center mt-2">
                                                                        <div class="col-12 row align-items-center">
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
                                                                                        name="services_large_image[{{ rand(10000, 99999) }}]"
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
                                                                                class="img-preview-container col-sm-11 col-md-5 d-flex justify-content-center align-items-center">
                                                                                <div class="px-3 mt-3">
                                                                                    <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                                                                        alt=""
                                                                                        class="img-fluid"
                                                                                        style="border-radius: 10px; max-height: 200px !important;">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-1">
                                                                                <a href="javascript:void(0)"
                                                                                    class="remove-services-large btn btn-danger btn-sm m-0 ml-2">
                                                                                    <i class="fas fa-minus-circle">
                                                                                    </i>
                                                                                </a>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-11 mt-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label fw-bold">Title
                                                                                    (2-3 Words)
                                                                                    <span class="text-danger">*</span>
                                                                                </label>
                                                                                <input type="text"
                                                                                    class="form-control form-control-lg"
                                                                                    name="service_large_title[]"
                                                                                    required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="form-label fw-bold">Description
                                                                                    (15 Words)
                                                                                    <span class="text-danger">*</span>
                                                                                </label>
                                                                                <input type="text"
                                                                                    class="form-control form-control-lg"
                                                                                    name="service_large_description[]"
                                                                                    required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 border-top"></div>
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

        /* add service mini */
        $('#add-services-mini').on('click', function() {
            var randomNumber = Math.floor(10000 + Math.random() * 90000);

            var myvar = `
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
                                name="services_mini_image[${randomNumber}]"
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

                    <div class="col-11 mt-2">
                        <div class="form-group">
                            <label class="form-label">Description
                                (7-8 Words)
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                class="form-control form-control-lg"
                                name="service_mini_description[]" required>
                        </div>
                    </div>
                    <div class="col-1">
                        <a href="javascript:void(0)"
                            class="remove-services-mini btn btn-danger btn-sm m-0 ml-2">
                            <i class="fas fa-minus-circle"> </i>
                        </a>
                    </div>

                    <div class="col-12 border-top"></div>
                </div>
            `;
            $('.services-mini-container').prepend(myvar);
            $(`.dropify`).dropify();
        });

        $(document).on('click', '.remove-services-mini', function() {
            $(this).parent().parent().remove();
        });

        /* add service large */
        $('#add-services-large').on('click', function() {
            var randomNumber = Math.floor(10000 + Math.random() * 90000);

            var myvar = `
                <div class="row align-items-center mt-2">
                    <div class="col-12 row align-items-center">
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
                                    name="services_large_image[${randomNumber}]"
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
                            class="img-preview-container col-sm-11 col-md-5 d-flex justify-content-center align-items-center">
                            <div class="px-3 mt-3">
                                <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                    alt="" class="img-fluid"
                                    style="border-radius: 10px; max-height: 200px !important;">
                            </div>
                        </div>

                        <div class="col-1">
                            <a href="javascript:void(0)"
                                class="remove-services-large btn btn-danger btn-sm m-0 ml-2">
                                <i class="fas fa-minus-circle"> </i>
                            </a>
                        </div>
                    </div>

                    <div class="col-11 mt-2">
                        <div class="form-group">
                            <label class="form-label fw-bold">Title
                                (2-3 Words)
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                class="form-control form-control-lg"
                                name="service_large_title[]" required>
                        </div>
                        <div class="form-group">
                            <label
                                class="form-label fw-bold">Description
                                (10 Words)
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                class="form-control form-control-lg"
                                name="service_large_description[]" required>
                        </div>
                    </div>

                    <div class="col-12 border-top"></div>
                </div>
            `;
            $('.services-large-container').prepend(myvar);
            $(`.dropify`).dropify();
        });

        $(document).on('click', '.remove-services-large', function() {
            $(this).parent().parent().parent().remove();
        });
    </script>
</body>

</html>
