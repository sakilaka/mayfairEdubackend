<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Edit Continent</title>
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
                            Edit Continent
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-md-9 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample" action="{{ route('continent.update', $continent->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="menu_type" class=" col-form-label">Continent Image</label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-8 col-lg-6">
                                                        <div class="dropify-wrapper" style="border: none">
                                                            <div class="dropify-loader"></div>
                                                            <div class="dropify-errors-container">
                                                                <ul></ul>
                                                            </div>
                                                            <input type="file" class="dropify" name="image"
                                                                accept="image/*" id="thumbnail_upload">
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
                                                                            Drag and drop or click to replace
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-sm-12 col-md-4 col-lg-6 d-flex justify-content-center align-items-center">
                                                        <div class="px-3">
                                                            <img src="{{ $continent->image_show ?? asset('frontend/images/No-image.jpg') }}"
                                                                alt="" class="img-fluid"
                                                                style="border-radius: 10px; max-height: 200px !important;"
                                                                id="thumbnail_preview">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="continent_name" class=" col-form-label">Continent Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input id="continent_name" type="text" name="name"
                                                    class="form-control" placeholder="Enter Continent Name"
                                                    value="{{ $continent->name }}" required>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary mr-2">Update</button>
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
        $('#thumbnail_upload').on('change', function(e) {
            var fileInput = $(this)[0];

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#thumbnail_preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        });
    </script>

</body>

</html>
