<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Social Login</title>
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
                            {{ __('Social Login') }}
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
                                        action="{{ route('backend.theme-options-social-login-save') }}"
                                        data-validate="parsley" id="DataEntry_formId" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <h4 class="text-muted">{{ __('Google') }}</h4>
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        class="font-weight-bold text-muted">{{ __('Google Client ID') }}</label>
                                                    <input
                                                        value="{{ old('google_client_id', $datalist['google_client_id']) }}"
                                                        type="text" name="google_client_id" class="form-control">
                                                    @error('google_client_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        class="font-weight-bold text-muted">{{ __('Google Client Secret') }}</label>
                                                    <input
                                                        value="{{ old('google_secret_id', $datalist['google_secret_id']) }}"
                                                        type="text" name="google_secret_id" class="form-control">
                                                    @error('google_secret_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <em class="text-muted">Google Redirect URI :
                                                    {{ url('/google/callback') }}</em>
                                            </div>

                                            <div class="col-sm-12 my-4">
                                                <div class="border-top border-secondary"></div>
                                            </div>

                                            <div class="col-sm-12 mb-4">
                                                <div class="mb-3">
                                                    <h4 class="text-muted">{{ __('Facebook') }}</h4>
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        class="font-weight-bold text-muted">{{ __('Facebook Client ID') }}</label>
                                                    <input value="{{ old('fb_client_id', $datalist['fb_client_id']) }}"
                                                        type="text" name="fb_client_id" class="form-control">
                                                    @error('fb_client_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        class="font-weight-bold text-muted">{{ __('Facebook Client Secret') }}</label>
                                                    <input value="{{ old('fb_secret_id', $datalist['fb_secret_id']) }}"
                                                        type="text" name="fb_secret_id" class="form-control">
                                                    @error('fb_secret_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <em class="text-muted">Facebook Redirect URI :
                                                    {{ url('/facebook/callback') }}</em>
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
