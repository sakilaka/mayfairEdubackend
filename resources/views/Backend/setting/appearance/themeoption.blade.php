<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Theme Color</title>
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
                            {{ __('Theme Color') }}
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
                                        action="{{ route('backend.theme-options-color-save') }}" data-validate="parsley"
                                        id="DataEntry_formId" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">
                                                        Primary Color
                                                        <div class="asColorPicker-wrap">
                                                            <input type="text" name="primary_color"
                                                                class="form-control color-picker asColorPicker-input"
                                                                value="{{ $theme_color['primary_color'] ?? '#068b76' }}">
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">
                                                        Secondary Color
                                                        <div class="asColorPicker-wrap">
                                                            <input type="text" name="secondary_color"
                                                                class="form-control color-picker asColorPicker-input"
                                                                value="{{ $theme_color['secondary_color'] ?? '#1e565c' }}">
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">
                                                        Tertiary Color
                                                        <div class="asColorPicker-wrap">
                                                            <input type="text" name="tertiary_color"
                                                                class="form-control color-picker asColorPicker-input"
                                                                value="{{ $theme_color['tertiary_color'] ?? '#f40000' }}">
                                                        </div>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">
                                                        Button Primary Color
                                                        <div class="asColorPicker-wrap">
                                                            <input type="text" name="btn_primary_color"
                                                                class="form-control color-picker asColorPicker-input"
                                                                value="{{ $theme_color['btn_primary_color'] ?? '#1e565c' }}">
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">
                                                        Button Secondary Color
                                                        <div class="asColorPicker-wrap">
                                                            <input type="text" name="btn_secondary_color"
                                                                class="form-control color-picker asColorPicker-input"
                                                                value="{{ $theme_color['btn_secondary_color'] ?? '#068b76' }}">
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">
                                                        Button Tertiary Color
                                                        <div class="asColorPicker-wrap">
                                                            <input type="text" name="btn_tertiary_color"
                                                                class="form-control color-picker asColorPicker-input"
                                                                value="{{ $theme_color['btn_tertiary_color'] ?? '#c10000' }}">
                                                        </div>
                                                </div>
                                            </div> --}}
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
    <script src="{{ asset('backend/assets/js/form-addons.js') }}"></script>
    <script src="{{ asset('backend/assets/js/formpickers.js') }}"></script>

</body>

</html>
