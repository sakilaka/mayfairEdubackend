<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Add Office</title>
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
                            Add Office
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('backend.admin.office.index') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All</a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-md-12 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample" action="{{ route('backend.admin.office.store') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row mb-3">
                                            <div class="col-sm-12 col-md-6 col-lg-8">
                                                <div class="row">
                                                    <div class="col-sm-12 mb-2">
                                                        <h4>Office Details</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Office Name:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Enter Office Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Country:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="country"
                                                            placeholder="Enter Country Name" class="form-control"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">City:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="city"
                                                            placeholder="Enter City Name" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Address:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="address" class="form-control"
                                                            placeholder="Enter Office Address" required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Google Map Embed:
                                                    </label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="map_link" class="form-control"
                                                            placeholder="Enter Google Map Embed Code">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Contact (Phone/Email).:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    </label>
                                                    <div class="row mt-2">
                                                        <div class="col-6 col-md-3">
                                                            <input type="text" name="contact_no[]"
                                                                class="mr-1 form-control" placeholder="Contact info 1"
                                                                required>
                                                        </div>
                                                        <div class="col-6 col-md-3">
                                                            <input type="text" name="contact_no[]"
                                                                class="mr-1 form-control" placeholder="Contact info 2"
                                                                required>
                                                        </div>
                                                        <div class="col-6 col-md-3">
                                                            <input type="text" name="contact_no[]"
                                                                class="mr-1 form-control"
                                                                placeholder="Contact info 3 (Optional)">
                                                        </div>
                                                        <div class="col-6 col-md-3">
                                                            <input type="text" name="contact_no[]"
                                                                class="mr-1 form-control"
                                                                placeholder="Contact info 4 (Optional)">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Others:</label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <textarea name="others" class="editor form-control"></textarea>
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
                                                            <div
                                                                class="mg-t-10 mg-sm-t-0 add-data-content-gallery_image">
                                                                <div class="d-flex align-items-center mt-2 row">
                                                                    <div class="col-sm-12 col-md-6 mt-3">
                                                                        <label class="form-control-label">Add
                                                                            Image:</label>
                                                                        <div class="dropify-wrapper"
                                                                            style="border: none">
                                                                            <div class="dropify-loader"></div>
                                                                            <div class="dropify-errors-container">
                                                                                <ul></ul>
                                                                            </div>
                                                                            <input type="file" class="dropify"
                                                                                name="gallery_image[]"
                                                                                accept="image/*"
                                                                                id="gallery_image_upload">
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
                                                                            <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                                                                alt="" class="img-fluid"
                                                                                style="border-radius: 10px; max-height: 200px !important;"
                                                                                id="gallery_image_preview">
                                                                        </div>
                                                                    </div>
                                                                    <a id="plus-btn-data-content-gallery_image"
                                                                        href="javascript:void(0)"
                                                                        class="plus-btn-data-content-gallery_image px-1 p-0 m-0 ml-2"><i
                                                                            class="fas fa-plus"></i></a>
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
        $('#video_upload').on('change', function(e) {
            var fileInput = $(this)[0];

            if (fileInput.files && fileInput.files[0]) {
                var fileURL = URL.createObjectURL(fileInput.files[0]);
                $('#video_preview').attr('src', fileURL);
            }
        });

        $('#gallery_image_upload').on('change', function(e) {
            var fileInput = $(this)[0];

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#gallery_image_preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        });

        $('#plus-btn-data-content-gallery_image').on('click', function() {
            var timestamp = Date.now();

            var myvar = `
                <div class="d-flex align-items-center mt-2 row">
                    <div class="col-sm-12 col-md-6 mt-3">
                        <label class="form-control-label">Add Image:</label>
                        <div class="dropify-wrapper" style="border: none">
                            <div class="dropify-loader"></div>
                            <div class="dropify-errors-container">
                                <ul></ul>
                            </div>
                            <input type="file" class="dropify"
                                name="gallery_image[]" accept="image/*"
                                id="gallery_image_upload_${timestamp}"> <!-- Unique ID -->
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
                    <div
                        class="col-sm-12 col-md-5 d-flex justify-content-center align-items-center">
                        <div class="px-3 mt-3">
                            <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                alt="" class="img-fluid"
                                style="border-radius: 10px; max-height: 200px !important;"
                                id="gallery_image_preview_${timestamp}"> <!-- Unique ID -->
                        </div>
                    </div>
                    <a href="javascript:void(0)"
                        class="minus-btn-data-content-gallery_image px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"> </i></a>
                </div>
            `;
            $('.add-data-content-gallery_image').prepend(myvar);
            $(`#gallery_image_upload_${timestamp}`).dropify();

            $(document).on('change', `#gallery_image_upload_${timestamp}`, function() {
                var fileInput = $(this)[0];

                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $(`#gallery_image_preview_${timestamp}`).attr('src', e.target.result);
                    };

                    reader.readAsDataURL(fileInput.files[0]);
                }
            });
        });

        $(document).on('click', '.minus-btn-data-content-gallery_image', function() {
            $(this).parent().remove();
        });
        $(document).on('click', '.minus-btn-data-old-gallery_image', function() {
            $(this).parent().remove();
        });
    </script>
</body>

</html>
