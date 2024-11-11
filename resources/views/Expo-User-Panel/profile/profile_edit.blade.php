<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ env('APP_NAME') }} | Edit Profile</title>
    @include('Expo-User-Panel.components.head')
    <link rel="stylesheet"
        href="{{ asset('frontend/application/modules/frontend/views/themes/default/assets/css/select2.min.css') }}">
</head>

<body>
    <div class="container-scroller">
        @include('Expo-User-Panel.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('Expo-User-Panel.components.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            Edit Profile
                        </h3>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0"><b>Personal Information</b></h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('expo.user.profile_info_update', Auth::guard('expo')->user()->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="menu_type" class=" col-form-label">Profile Photo</label>
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
                                                            <img src="{{ $userData->photo ?? asset('frontend/images/No-image.jpg') }}"
                                                                alt="" class="img-fluid"
                                                                style="border-radius: 10px; max-height: 200px !important;"
                                                                id="thumbnail_preview">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ID Type -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="id_type" class="col-form-label">
                                                <span class="text-danger">*</span> ID Type:
                                            </label>
                                            <select name="id_type" id="id_type" class="form-control form-control-lg"
                                                required>
                                                <option value="">Select an option</option>
                                                <option value="Passport"
                                                    {{ $userData->id_type == 'Passport' ? 'selected' : '' }}>
                                                    Passport
                                                </option>
                                                <option value="ID/NID"
                                                    {{ $userData->id_type == 'ID/NID' ? 'selected' : '' }}>
                                                    ID/NID
                                                </option>
                                                <option value="Other"
                                                    {{ $userData->id_type == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                            <div class="invalid-feedback">Please select an ID Type.</div>
                                        </div>
                                    </div>

                                    <!-- ID Number -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="id_no" class="col-form-label">
                                                <span class="text-danger">*</span> ID No.:
                                            </label>
                                            <input type="text" id="id_no" name="id_no"
                                                class="form-control form-control-lg" value="{{ $userData->id_no }}"
                                                required placeholder="Enter your ID number">
                                            <div class="invalid-feedback">Please provide your ID number.</div>
                                        </div>
                                    </div>

                                    <!-- First Name -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="first_name" class="col-form-label">
                                                <span class="text-danger">*</span> First Name:
                                            </label>
                                            <input type="text" id="first_name" name="first_name"
                                                class="form-control form-control-lg" value="{{ $userData->first_name }}"
                                                required placeholder="Enter your first name">
                                            <div class="invalid-feedback">Please provide your first name.</div>
                                        </div>
                                    </div>

                                    <!-- Last Name -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="last_name" class="col-form-label">
                                                <span class="text-danger">*</span> Last Name:
                                            </label>
                                            <input type="text" id="last_name" name="last_name"
                                                class="form-control form-control-lg" value="{{ $userData->last_name }}"
                                                required placeholder="Enter your last name">
                                            <div class="invalid-feedback">Please provide your last name.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Email Address</label>
                                            <input type="email" class="form-control"
                                                value="{{ Auth::guard('expo')->user()->email }}" name="email"
                                                placeholder="Email Address" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Mobile Number</label>
                                            <input type="text" class="form-control"
                                                value="{{ Auth::guard('expo')->user()->phone }}" name="phone"
                                                placeholder="Mobile Number" />
                                        </div>
                                    </div>

                                    <!-- Nationality -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="nationality" class="col-form-label">
                                                Nationality:
                                            </label>
                                            <input type="text" id="nationality" name="nationality"
                                                class="form-control form-control-lg"
                                                value="{{ $userData->nationality }}" 
                                                placeholder="Enter your nationality">
                                            <div class="invalid-feedback">Please provide your nationality.</div>
                                        </div>
                                    </div>

                                    <!-- Sex -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="sex" class="col-form-label">
                                                Sex:
                                            </label>
                                            <select id="sex" name="sex"
                                                class="form-control form-control-lg">
                                                <option value="">Select an option</option>
                                                <option value="Male"
                                                    {{ $userData->sex == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female"
                                                    {{ $userData->sex == 'Female' ? 'selected' : '' }}>Female</option>
                                                <option value="Other"
                                                    {{ $userData->sex == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                            <div class="invalid-feedback">Please select your sex.</div>
                                        </div>
                                    </div>

                                    <!-- Date of Birth -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="dob" class="col-form-label">
                                                <span class="text-danger">*</span> Date of Birth:
                                            </label>
                                            <input type="date" id="dob" name="dob"
                                                class="form-control form-control-lg" value="{{ $userData->dob }}"
                                                required>
                                            <div class="invalid-feedback">Please select your date of birth.</div>
                                        </div>
                                    </div>

                                    <!-- Profession -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="profession" class="col-form-label">
                                                 Profession:
                                            </label>
                                            <input type="text" id="profession" name="profession"
                                                class="form-control form-control-lg"
                                                value="{{ $userData->profession }}" 
                                                placeholder="Enter your profession">
                                            <div class="invalid-feedback">Please provide a valid profession.</div>
                                        </div>
                                    </div>

                                    <!-- Name of Institution/Organization -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="institution" class="col-form-label">Name of
                                                Institution/Organization</label>
                                            <input type="text" id="institution" name="institution"
                                                class="form-control" value="{{ $userData->institution }}" required
                                                placeholder="Enter the name of your institution" />
                                        </div>
                                    </div>

                                    <!-- Interested Program -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="program" class="col-form-label">Interested Program</label>
                                            <input type="text" id="program" name="program" class="form-control"
                                                value="{{ $userData->program }}" required
                                                placeholder="Enter the interested program" />
                                        </div>
                                    </div>

                                    <!-- Interested Degree -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="degree" class="col-form-label">Interested Degree</label>
                                            <input type="text" id="degree" name="degree" class="form-control"
                                                value="{{ $userData->degree }}" required
                                                placeholder="Enter the interested degree" />
                                        </div>
                                    </div>

                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-5">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Change Password</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.password_change', Auth::guard('expo')->user()->id) }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="current_password">Current Password</label>
                                            <div class="input-group">
                                                <input type="password" id="current_password" name="current_password"
                                                    class="form-control" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        onclick="togglePassword('current_password')">
                                                        <i class="fa fa-eye" id="current_password_eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="new_password">New Password</label>
                                            <div class="input-group">
                                                <input type="password" id="new_password" name="new_password"
                                                    class="form-control @error('new_password') is-invalid @enderror"
                                                    required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        onclick="togglePassword('new_password')">
                                                        <i class="fa fa-eye" id="new_password_eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @error('new_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="new_password_confirmation">Confirm
                                                Password</label>
                                            <div class="input-group">
                                                <input type="password" id="new_password_confirmation"
                                                    name="new_password_confirmation" class="form-control" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        onclick="togglePassword('new_password_confirmation')">
                                                        <i class="fa fa-eye" id="new_password_confirmation_eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @include('Expo-User-Panel.components.footer')
            </div>
        </div>

        @include('Expo-User-Panel.components.wrapper-footer')
    </div>

    @include('Expo-User-Panel.components.script')
    <script src="{{ asset('backend/assets/js/dropify.js') }}"></script>
    <script src="{{ asset('backend/lib/select2/js/select2.min.js') }}"></script>

    <script>
        /* $('select').select2({
                                                placeholder: 'Select an option'
                                            }); */
    </script>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const eyeIcon = document.getElementById(inputId + '_eye');

            if (input.type === "password") {
                input.type = "text";
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

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
