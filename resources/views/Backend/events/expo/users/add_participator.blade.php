<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Add Expo Participator</title>
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
                            Add Expo Participator
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.expo.users', ['type' => request()->type]) }}"
                                class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All Participator</a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-md-10 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample"
                                        action="{{ route('admin.expo.add_participator.store', ['type' => request()->type]) }}"
                                        method="POST" enctype="multipart/form-data">
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
                                                            <input type="file" class="dropify" name="photo"
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
                                                <label class="col-form-label pt-0">ID Type<span
                                                        class="text-danger">*</span></label>
                                                <select name="id_type" class="form-control form-control-lg" required>
                                                    <option value="">Select an option</option>
                                                    <option value="Passport">Passport</option>
                                                    <option value="ID/NID">ID/NID</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">ID No<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="id_no" class="form-control"
                                                    placeholder="Enter ID No" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">First Name<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="first_name" class="form-control"
                                                    placeholder="Enter First Name" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">Last Name<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="last_name" class="form-control"
                                                    placeholder="Enter Last Name" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">Mobile</label>
                                                <input type="text" name="mobile" class="form-control"
                                                    placeholder="Enter Mobile Number">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">Email<span
                                                        class="text-danger">*</span></label>
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="Enter Email" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">Nationality<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="nationality" class="form-control"
                                                    placeholder="Enter Nationality" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">Sex</label>
                                                <select name="sex" class="form-control form-control-lg">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">Password<span
                                                        class="text-danger">*</span></label>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="Enter Password" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">Date of Birth<span
                                                        class="text-danger">*</span></label>
                                                <input type="date" name="dob" class="form-control" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">Profession</label>
                                                <input type="text" name="profession" class="form-control"
                                                    placeholder="Enter Profession">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">Institution/Organization</label>
                                                <input type="text" name="institution" class="form-control"
                                                    placeholder="Enter Institution/Organization">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">Interested Program</label>
                                                <input type="text" name="program" class="form-control"
                                                    placeholder="Enter Interested Program">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-0">Interested Degree</label>
                                                <input type="text" name="degree" class="form-control"
                                                    placeholder="Enter Interested Degree">
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
