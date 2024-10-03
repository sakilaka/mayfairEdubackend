<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Social Media</title>
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
                            {{ __('Social Media') }}
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

                                    <form method="post" action="{{ route('backend.social-media-save') }}">
                                        @csrf

                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">Facebook</label>
                                                    <input value="{{ $data['facebook'] ?? '' }}" type="text"
                                                        placeholder="Enter Facebook URL" name="facebook"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">Twitter</label>
                                                    <input value="{{ $data['twitter'] ?? '' }}" type="text"
                                                        placeholder="Enter Twitter URL" name="twitter"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">Instagram</label>
                                                    <input value="{{ $data['instagram'] ?? '' }}" type="text"
                                                        placeholder="Enter Instagram URL" name="instagram"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">YouTube</label>
                                                    <input value="{{ $data['youtube'] ?? '' }}" type="text"
                                                        placeholder="Enter YouTube URL" name="youtube"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">WeChat</label>
                                                    <input value="{{ $data['wechat'] ?? '' }}" type="text"
                                                        placeholder="Enter WeChat URL" name="wechat"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">Telegram</label>
                                                    <input value="{{ $data['telegram'] ?? '' }}" type="text"
                                                        placeholder="Enter Telegram URL" name="telegram"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">Line</label>
                                                    <input value="{{ $data['line'] ?? '' }}" type="text"
                                                        placeholder="Enter Line URL" name="line"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">TikTok</label>
                                                    <input value="{{ $data['tiktok'] ?? '' }}" type="text"
                                                        placeholder="Enter TikTok URL" name="tiktok"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold text-muted">Zalo</label>
                                                    <input value="{{ $data['zalo'] ?? '' }}" type="text"
                                                        placeholder="Enter Zalo URL" name="zalo"
                                                        class="form-control">
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
