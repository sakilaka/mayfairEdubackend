<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Edit Dormitory</title>
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
                            Edit Dormitory
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-md-9 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample"
                                        action="{{ route('admin.dormitory.update', ['id' => $dormitory->id]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Dormitory Name <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input id="dormitory_name" type="text" name="name"
                                                        class="form-control" value="{{ $dormitory->name }}"
                                                        placeholder="Enter Dormitory Name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Persons Per Room <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input id="persons_in_room" type="number" name="persons_in_room"
                                                        class="form-control" value="{{ $dormitory->persons_in_room }}"
                                                        placeholder="Enter Persons Per Room" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Rent Cost <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input id="rent" type="number" name="rent"
                                                        class="form-control" value="{{ $dormitory->rent }}"
                                                        placeholder="Enter Rent Cost" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Introduction </label>
                                                    <input id="introduction" type="text" name="introduction"
                                                        class="form-control" value="{{ $dormitory->introduction }}" placeholder="Enter Introduction">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Video URL (Embeded Code Only)</label>
                                                    <input id="video_url" type="text" name="video_url"
                                                        class="form-control" value="{{ $dormitory->video_url }}" placeholder="Enter Video URL">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Off Campus
                                                        Facility <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <select name="off_campus_facility" id="off_campus_facility"
                                                        class="form-control form-control-lg">
                                                        <option value="yes"
                                                            {{ $dormitory->off_campus_facility == 'yes' ? 'selected' : '' }}>
                                                            Yes</option>
                                                        <option value="no"
                                                            {{ $dormitory->off_campus_facility == 'no' ? 'selected' : '' }}>
                                                            No</option>
                                                        <option value="gallery"
                                                            {{ $dormitory->off_campus_facility == 'gallery' ? 'selected' : '' }}>
                                                            Gallery</option>
                                                    </select>
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
                                                                    $galleryImages = json_decode(
                                                                        $dormitory->photos,
                                                                        true,
                                                                    ) ?? [];
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

</body>

</html>
