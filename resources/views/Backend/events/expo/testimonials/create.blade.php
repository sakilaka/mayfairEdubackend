<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Add Testimonial</title>
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
                            Add Testimonial
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('backend.admin.manage_employee.index') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All Testimonial</a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-md-10 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample"
                                        action="{{ route('backend.admin.manage_employee.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="menu_type" class="col-form-label">Profile Photo</label>
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
                                                            <img src="{{ asset('frontend/images/No-image.jpg') }}"
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
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Enter Employee Name" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">Mobile
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="text" name="mobile" class="form-control"
                                                    placeholder="Enter Mobile Number" required>

                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">Email
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="email" name="email" class="form-control"
                                                    placeholder="Enter Email" required>

                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">Password
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="password" name="password" class="form-control"
                                                    placeholder="Enter Password" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">Passport No.
                                                </label>

                                                <input type="text" name="passport_no" class="form-control"
                                                    placeholder="Enter Passport No.">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">Role
                                                </label>

                                                <select name="role" class="form-control form-control-lg">
                                                    <option value="manager">Manager</option>
                                                    <option value="support">Support</option>
                                                    <option value="general_employee">General Stuff</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label class="col-form-label pt-0">Address
                                                </label>

                                                <input type="text" name="address" class="form-control"
                                                    placeholder="Enter Address">
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
