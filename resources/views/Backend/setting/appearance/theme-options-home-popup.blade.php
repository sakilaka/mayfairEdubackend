<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Home Popup</title>
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
                            {{ __('Home Popup') }}
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-2">
                            @include('Backend.setting.appearance.theme_options_appearance_nav_tabs')
                        </div>

                        <div class="col-10">
                            <div class="tab-content tab-content-vertical bg-white rounded">
                                <div class="tab-pane fade show active" id="program-info-tab-content" role="tabpanel"
                                    aria-labelledby="home-tab-vertical">

                                    <form novalidate="" method="post"
                                        action="{{ route('backend.save-theme-home-popup') }}" data-validate="parsley"
                                        id="DataEntry_formId" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row my-3">
                                            <div class="col-md-6 col-lg-4">
                                                <label class="form-control-label">Show/Hide Popup:</label>
                                                <select name="show_hide" class="form-control form-control-lg">
                                                    <option value="show"
                                                        {{ json_decode($results->option_value, true)['show_hide'] == 'show' ? 'selected' : '' }}>
                                                        Show
                                                    </option>
                                                    <option value="hide"
                                                        {{ json_decode($results->option_value, true)['show_hide'] == 'hide' ? 'selected' : '' }}>
                                                        Hide
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 col-lg-8">
                                                <label class="form-control-label">Redirection URL:</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter Redirect URL" name="redirect_url" value="{{ json_decode($results->option_value, true)['redirect_url'] ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">Add Image</label>
                                                    <div class="dropify-wrapper" style="border: none">
                                                        <div class="dropify-loader"></div>
                                                        <div class="dropify-errors-container">
                                                            <ul></ul>
                                                        </div>
                                                        <input type="file" class="dropify" name="popup_image"
                                                            accept="image/*" id="popup_image_upload" required>
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
                                            </div>

                                            <div class="col-sm-6 d-flex justify-content-center align-items-center">
                                                <div class="px-3">
                                                    <img src="{{ json_decode($results->option_value, true)['photo'] ?? asset('frontend/images/No-image.jpg') }}"
                                                        alt="Popup Image" class="img-fluid"
                                                        style="border-radius: 10px; max-height: 200px !important;"
                                                        id="popup_image_preview">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row tabs-footer mt-15">
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
        $('#popup_image_upload').on('change', function(e) {
            var fileInput = $(this)[0];

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#popup_image_preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        });
    </script>
</body>

</html>
