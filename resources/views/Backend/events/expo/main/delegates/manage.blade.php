<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')

    @php
        $delegate = [];
        if ($delegate_key) {
            $delegate = json_decode($expo->delegates, true)[$delegate_key] ?? [];
        }
    @endphp

    <title>{{ env('APP_NAME') }} | {{ $delegate ? 'Edit' : 'Add' }} Delegate</title>
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
                            {{ $delegate ? 'Edit' : 'Add' }} Delegate
                            {{ $delegate ? "from '" . e($delegate['name']) . "'" : '' }}
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.expo.delegate.index', ['expo_id' => $expo->unique_id]) }}"
                                class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All</a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-md-10 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    @php
                                        if ($delegate) {
                                            $actionRoute = route('admin.expo.delegate.update', [
                                                'expo_id' => $expo->unique_id,
                                                'delegate_key' => $delegate_key,
                                            ]);
                                        } else {
                                            $actionRoute = route('admin.expo.delegate.update', [
                                                'expo_id' => $expo->unique_id,
                                            ]);
                                        }
                                    @endphp
                                    <form class="forms-sample" action="{{ $actionRoute }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="menu_type" class="col-form-label">Photo</label>
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
                                                            <input type="file" class="dropify"
                                                                name="delegate_{{ $delegate_key }}[photo]"
                                                                accept="image/*" id="photo">
                                                            <button type="button" class="dropify-clear">Remove</button>
                                                            <div class="dropify-preview">
                                                                <span class="dropify-render"></span>
                                                                <div class="dropify-infos">
                                                                    <div class="dropify-infos-inner">
                                                                        <p class="dropify-filename">
                                                                            <span class="file-icon"></span>
                                                                            <span class="dropify-filename-inner"></span>
                                                                        </p>
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
                                                            <img src="{{ $delegate['photo'] ?? asset('frontend/images/No-image.jpg') }}"
                                                                alt="" class="img-fluid"
                                                                style="border-radius: 10px; max-height: 200px !important;"
                                                                id="thumbnail_preview">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="delegate_{{ $delegate_key }}[name]"
                                                    class="form-control" value="{{ $delegate['name'] ?? '' }}"
                                                    placeholder="Enter Name" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">Designation
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="delegate_{{ $delegate_key }}[designation]"
                                                    class="form-control" value="{{ $delegate['designation'] ?? '' }}"
                                                    placeholder="Enter Designation" required>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label class="col-form-label pt-0">Description
                                                </label>

                                                <textarea name="delegate_{{ $delegate_key }}[description]" class="form-control editor">{!! $delegate['description'] ?? '' !!}</textarea>
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
    @include('Backend.components.ckeditor5-config')

    <script src="{{ asset('backend/assets/js/dropify.js') }}"></script>
    <script>
        $('#photo').on('change', function(e) {
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
