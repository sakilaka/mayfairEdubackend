<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Google Map</title>
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
                            {{ __('Google Map') }}
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
                                        action="{{ route('backend.theme-options-google-map-save') }}"
                                        data-validate="parsley" id="DataEntry_formId" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label
                                                        class="font-weight-bold text-muted">{{ __('Google Map Embed URL') }}</label>
                                                    <input value="{{ old('g_location', $datalist['g_location']) }}"
                                                        type="text" name="g_location" class="form-control">
                                                    @error('g_location')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label
                                                        class="font-weight-bold text-muted">{{ __('Status') }}</label>
                                                    <div class="d-flex">
                                                        <div class="form-check form-check-success ">
                                                            <label class="form-check-label" style="font-size: 0.9rem">
                                                                <input type="radio" class="form-check-input"
                                                                    name="status" value="1"
                                                                    @if (old('status', $datalist['status']) == 1) checked @endif>
                                                                Active
                                                                <i class="input-helper"></i></label>
                                                        </div>
                                                        <div class="form-check form-check-danger ml-3">
                                                            <label class="form-check-label" style="font-size: 0.9rem">
                                                                <input type="radio" class="form-check-input"
                                                                    name="status" value="0"
                                                                    @if (old('status', $datalist['status']) == 0) checked @endif>
                                                                Inactive
                                                                <i class="input-helper"></i></label>
                                                        </div>
                                                    </div>
													@error('status')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
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

</body>

</html>
