<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Manage Expo UI - Contact</title>
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
                            Manage Expo UI - Contact
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-2">
                            @include('Backend.events.expo.external.ui-contents.expo-ui-manage-nav')
                        </div>

                        <div class="col-10">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{ route('admin.expo-site.ui.contact.update') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label class="form-control-label">Contents</label>
                                                <textarea name="contents" class="form-control form-control-lg editor">{{ optional($contents)->contents ? json_decode($contents->contents) : '' }}</textarea>
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

</body>

</html>
