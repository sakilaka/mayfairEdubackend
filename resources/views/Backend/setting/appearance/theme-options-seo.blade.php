<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | SEO</title>
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
                            {{ __('SEO') }}
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
                                        action="{{ route('backend.theme-options-seo-save') }}" data-validate="parsley"
                                        id="DataEntry_formId" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label  class="font-weight-bold text-muted">{{ __('SEO Title') }}</label>
                                                    <input name="og_title[]" class="form-control tags">
                                                    <em class="text-muted">Separate multiple title with comma ','</em>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label  class="font-weight-bold text-muted">{{ __('SEO Keywords') }}</label>
                                                    <input name="og_keywords[]" class="form-control tags">
                                                    <em class="text-muted">Separate multiple keyword with comma ','</em>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label  class="font-weight-bold text-muted">{{ __('SEO Description') }}</label>
                                                    <textarea name="og_description" class="form-control" style="height: 150px"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-12 mb-2">
                                                        <label  class="font-weight-bold text-muted">{{ __('OG Image') }}</label>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <div class="dropify-wrapper" style="border: none">
                                                                <div class="dropify-loader"></div>
                                                                <div class="dropify-errors-container">
                                                                    <ul></ul>
                                                                </div>
                                                                <input type="file" class="dropify" name="og_image"
                                                                    accept="image/*" id="og_image_upload">
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
                                                            <span class="text-muted">
                                                                <i>Recommended: .jpg/.jpeg/.png & 600x315 px</i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-sm-6 d-flex justify-content-center align-items-center">
                                                        <div class="px-3">
                                                            <img src="{{ asset('upload/seo/' . $datalist['og_image']) ?? asset('frontend/images/No-image.jpg') }}"
                                                                alt="" class="img-fluid"
                                                                style="border-radius: 10px; max-height: 200px !important;"
                                                                id="og_image_preview">
                                                        </div>
                                                    </div>
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

    <script src="{{ asset('backend/assets/js/dropify.js') }}"></script>
    <script>
        $('#og_image_upload').on('change', function(e) {
            var fileInput = $(this)[0];

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#og_image_preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        });

        $('.tags').tagsInput({
            'width': '100%',
            'height': '65%',
            'interactive': true,
            'defaultText': 'Title',
            'removeWithBackspace': true,
            'minChars': 0,
            'maxChars': 100,
            'placeholderColor': '#666666'
        });
    </script>

</body>

</html>
