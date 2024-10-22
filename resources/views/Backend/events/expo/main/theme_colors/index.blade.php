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

                        <nav aria-label="breadcrumb" class="d-flex justify-content-around align-items-center">
                            <a href="{{ route('admin.expo.index') }}" class="btn btn-secondary-bg"
                                style="margin-right:5px;">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All Expo
                            </a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="tab-content tab-content-vertical bg-white rounded">
                                <div class="tab-pane fade show active" id="program-info-tab-content" role="tabpanel"
                                    aria-labelledby="home-tab-vertical">

                                    <form novalidate="" method="post"
                                        action="{{ route('admin.expo.theme_colors.update', ['expo_id' => $expo->unique_id]) }}"
                                        data-validate="parsley" id="DataEntry_formId" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-6 col-lg-3">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">
                                                        Primary Color
                                                        <div class="asColorPicker-wrap">
                                                            <input type="text" name="primary_color"
                                                                class="form-control color-picker asColorPicker-input"
                                                                value="{{ $theme_color['primary_color'] ?? '#0c4493' }}">
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">
                                                        Primary Hover Color
                                                        <div class="asColorPicker-wrap">
                                                            <input type="text" name="primary_hover_color"
                                                                class="form-control color-picker asColorPicker-input"
                                                                value="{{ $theme_color['primary_hover_color'] ?? '#3a62a0' }}">
                                                        </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-lg-3">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">
                                                        Secondary Color
                                                        <div class="asColorPicker-wrap">
                                                            <input type="text" name="secondary_color"
                                                                class="form-control color-picker asColorPicker-input"
                                                                value="{{ $theme_color['secondary_color'] ?? '#58b135' }}">
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">
                                                        Secondary Hover Color
                                                        <div class="asColorPicker-wrap">
                                                            <input type="text" name="secondary_hover_color"
                                                                class="form-control color-picker asColorPicker-input"
                                                                value="{{ $theme_color['secondary_hover_color'] ?? '#357e61' }}">
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
    <script src="{{ asset('backend/assets/js/form-addons.js') }}"></script>
    <script src="{{ asset('backend/assets/js/formpickers.js') }}"></script>

</body>

</html>
