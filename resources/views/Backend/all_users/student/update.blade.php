<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/summernote/dist/summernote-bs4.css') }}">
    <title>{{ env('APP_NAME') }} | Edit Student</title>
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
                            Edit Student
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.student.index') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All Student</a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-md-12 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample"
                                        action="{{ route('admin.student.update', $student->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row mb-3">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="row">
                                                    <div class="col-sm-12 mb-2">
                                                        <h4>Personal Details</h4>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Student Photo</label>
                                                            <div class="dropify-wrapper" style="border: none">
                                                                <div class="dropify-loader"></div>
                                                                <div class="dropify-errors-container">
                                                                    <ul></ul>
                                                                </div>
                                                                <input type="file" class="dropify" name="image"
                                                                    accept="image/*" id="avatar_upload">
                                                                <button type="button"
                                                                    class="dropify-clear">Remove</button>
                                                                <div class="dropify-preview">
                                                                    <span class="dropify-render"></span>
                                                                    <div class="dropify-infos">
                                                                        <div class="dropify-infos-inner">
                                                                            <p class="dropify-filename">
                                                                                <span class="file-icon"></span>
                                                                                <span
                                                                                    class="dropify-filename-inner"></span>
                                                                            </p>
                                                                            <p class="dropify-infos-message">
                                                                                Drag and drop or click to replace
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-sm-6 d-flex justify-content-center align-items-center">
                                                        <div class="px-3">
                                                            <img src="{{ $student->image_show ?? asset('frontend/images/No-image.jpg') }}"
                                                                alt="" class="img-fluid"
                                                                style="border-radius: 10px; max-height: 200px !important;"
                                                                id="avatar_preview">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Student Name:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Enter Name" value="{{ $student->name }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Mobile Number:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="mobile" class="form-control"
                                                            placeholder="Enter Mobile Number"
                                                            value="{{ $student->mobile }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Email:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="email" name="email" class="form-control"
                                                            placeholder="Enter Email" value="{{ $student->email }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">NID:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="nid" class="form-control"
                                                            placeholder="Enter NID" value="{{ $student->nid }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Gender <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <select class="form-control form-control-lg" name="gender"
                                                        required>
                                                        <option value="">Select Gender</option>
                                                        <option value="0"
                                                            @if ($student->gender == '0') Selected @endif>Male
                                                        </option>
                                                        <option value="1"
                                                            @if ($student->gender == '1') Selected @endif>Female
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Date of Birth:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="date" name="dob"
                                                            value="{{ date('Y-m-d', strtotime($student->dob)) }}"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Qualification:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="qualification"
                                                            class="form-control"
                                                            value="{{ $student->qualification }}"
                                                            placeholder="Enter Qualification" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Experience:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="experience" class="form-control"
                                                            placeholder="Enter Experience"
                                                            value="{{ $student->experience }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Language
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span>
                                                    </label>
                                                    <select id="language" class="form-control form-control-lg"
                                                        name="language" id="phar_cat" required>
                                                        <option value="">Select Language</option>
                                                        <option @if ($student->language == '1') Selected @endif
                                                            value="1"> Bangla </option>
                                                        <option @if ($student->language == '2') Selected @endif
                                                            value="2">English </option>
                                                        <option @if ($student->language == '3') Selected @endif
                                                            value="3">Hindi </option>
                                                        <option @if ($student->language == '4') Selected @endif
                                                            value="4">Arabic </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Continent
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span>
                                                    </label>
                                                    <select id="continent" class="form-control form-control-lg"
                                                        name="continent_id" id="phar_cat" required>
                                                        <option value="">Select Continent</option>
                                                        @foreach ($continents as $continent)
                                                            <option @if ($continent->id == $student->continent_id) Selected @endif
                                                                value="{{ $continent->id }}">{{ $continent->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Country <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <select class="form-control form-control-lg" name="country"
                                                        id="country" required>
                                                        <option value="">Select Continent First</option>
                                                        @foreach ($countries as $country)
                                                            <option @if ($country->id == $student->country) Selected @endif
                                                                value="{{ $country->id }}">{{ $country->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Province <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <select class="form-control form-control-lg" name="state_id"
                                                        id="state" required>
                                                        <option value="">Select Country First</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>City <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <select class="form-control form-control-lg" name="city_id"
                                                        id="city" required>
                                                        <option value="">Select Province First</option>
                                                    </select>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" name="address" class="form-control"
                                                        placeholder="Enter Address" value="{{ $student->address }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea type="text" name="description" class="form-control" placeholder="Enter description">{{ $student->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-sm-12 mb-2">
                                                <h4>Certificates</h4>
                                            </div>

                                            <div class="col-md-12 add-data-content">
                                                @if ($student->certificate->count() == 0)
                                                    <div class="d-flex align-items-center mt-2 row">
                                                        <div class="col-md-7">
                                                            <label class="form-control-label"><b>Certificate
                                                                    Name:</b></label>
                                                            <div
                                                                class="d-flex  align-items-center select-add-section ">
                                                                <input type="text" name="certificates_name[]"
                                                                    value="{{ old('$certificates_name') }}"
                                                                    class=" form-control"
                                                                    placeholder="Certificate Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-control-label"><b>Certificate
                                                                    File:</b></label>
                                                            <div class="d-flex  align-items-center select-add-section">
                                                                <input type="file" name="certificates_file[]"
                                                                    accept="image/jpeg,image/gif,image/png,application/pdf"
                                                                    value="{{ old('$certificates_file') }}"
                                                                    class=" form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-1">
                                                            <a id="plus-btn-data-content" href="javascript:void(0)"
                                                                class="plus-btn-data-content px-1 p-0 m-0 ml-2"><i
                                                                    class="fas fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                @else
                                                    @foreach ($student->certificate as $k => $item)
                                                        <div class="d-flex align-items-center mt-2 row">
                                                            <div class="col-md-7">
                                                                <label class="form-control-label"><b>Certificate
                                                                        Name:</b></label>
                                                                <div
                                                                    class="d-flex  align-items-center select-add-section ">
                                                                    <input type="text"
                                                                        name="old_certificates_name[{{ $item->id }}]"
                                                                        value="{{ $item->certificates_name }}"
                                                                        class=" form-control"
                                                                        placeholder="Certificate Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-control-label"><b>Certificate
                                                                        File:</b></label>
                                                                <div
                                                                    class="d-flex  align-items-center select-add-section">
                                                                    <input type="file"
                                                                        name="old_certificates_file[{{ $item->id }}]"
                                                                        accept="image/jpeg,image/gif,image/png,application/pdf"
                                                                        value="{{ $item->certificates_file }}"
                                                                        class=" form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="form-control-label"><b>View:</b></label>
                                                                <div
                                                                    class="d-flex  align-items-center select-add-section">
                                                                    <a class="btn btn-primary" data-toggle="modal"
                                                                        data-target="#certificateModal{{ $k }}">
                                                                        &nbsp;<i class="fa fa-solid fa-eye"
                                                                            style="color: white"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                @if ($k == $student->certificate->count() - 1)
                                                                    <a id="plus-btn-data-content"
                                                                        href="javascript:void(0)"
                                                                        class="plus-btn-data-content px-1 p-0 m-0 ml-2"><i
                                                                            class="fas fa-plus"></i></a>
                                                                @else
                                                                    <a audio_file_id="{{ $item->id }}"
                                                                        href="javascript:void(0)"
                                                                        class="minus-btn-data-old-audio px-1 p-0 m-0 ml-2"><i
                                                                            class="fas fa-minus-circle"></i></a>
                                                                @endif
                                                            </div>
                                                        </div>



                                                        <!-- Modal -->
                                                        <div class="modal fade"
                                                            id="certificateModal{{ $k }}" tabindex="-1"
                                                            role="dialog" aria-labelledby="audioModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="audioModalLabel"
                                                                            style="color: black">
                                                                            {{ $item->certificates_name }}</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        @if ($item->extension == 'pdf')
                                                                            <iframe
                                                                                src="{{ $item->certificates_file_show }}"
                                                                                width="100%"
                                                                                height="500"></iframe>
                                                                        @else
                                                                            <img src="{{ $item->certificates_file_show }}"
                                                                                alt="image"
                                                                                style="height: 300px; width:450px">
                                                                        @endif
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-primary"
                                                                            data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary mr-2">Update</button>
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
        $('#avatar_upload').on('change', function(e) {
            var fileInput = $(this)[0];

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#avatar_preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        });
    </script>
    <script>
        $('#continent').on("change", function() {
            let id = $(this).val();
            let url = '{{ url('get/country/') }}/' + id;

            if (id == null || id == '') {
                $('#country').empty();
                let html = '<option value="">Select Continent First</option>';
                $('#country').append(html);
            }

            $.ajax({
                url: url,
                type: 'GET',
                success: function(res) {
                    $('#country').empty();

                    let html = '<option value="">Select Country</option>';
                    $.each(res, function(index, element) {
                        html += "<option value=" + element.id + ">" + element.name +
                            "</option>";
                    });
                    $('#country').append(html);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('#country').on("change", function() {
            let id = $(this).val();
            let url = '{{ url('/get/state/') }}/' + id;

            if (id == null || id == '') {
                $('#state').empty();
                let html = '<option value="">Select Country First</option>';
                $('#state').append(html);
            }

            $.ajax({
                url: url,
                type: 'GET',
                success: function(res) {

                    $('#state').empty();
                    let html = '<option value="">Select Province</option>';
                    $.each(res, function(index, element) {
                        html += "<option value=" + element.id + ">" + element.name +
                            "</option>";
                    });
                    $('#state').append(html);
                    $('#state').val("").change();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('#state').on("change", function() {
            let id = $(this).val();
            let url = '{{ url('/get/city/') }}/' + id;

            if (id == null || id == '') {
                $('#city').empty();
                let html = '<option value="">Select Province First</option>';
                $('#city').append(html);
            }

            $.ajax({
                url: url,
                type: 'GET',
                success: function(res) {

                    $('#city').empty();
                    let html = '<option value="">Select City</option>';
                    $.each(res, function(index, element) {
                        html += "<option value=" + element.id + ">" + element.name +
                            "</option>";
                    });
                    $('#city').append(html);
                    $('#city').val("").change();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '#plus-btn-data-content', function() {

            var myvar = '<div class="d-flex align-items-center mt-2 row">' +
                '    <div class="col-md-7">' +
                '        <label class="form-control-label"><b>Certificate Name:</b></label>' +
                '        <div class="d-flex  align-items-center select-add-section " >' +
                '            <input type="text" name="certificates_name[]" value="{{ old('$certificates_name') }}" class=" form-control" placeholder="Certificate Name">' +
                '        </div>' +
                '    </div>' +
                '    <div class="col-md-4">' +
                '        <label class="form-control-label"><b>Certificate File:</b></label>' +
                '        <div class="d-flex  align-items-center select-add-section">' +
                '            <input type="file"  name="certificates_file[]" accept="image/jpeg,image/gif,image/png,application/pdf" value="{{ old('$certificates_file') }}" class=" form-control">' +
                '        </div>' +
                '    </div>' +
                '    <div class="col-md-1">' +
                '     <a href="javascript:void(0)" class="minus-btn-data-content px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>' +
                '    </div>' +
                '</div>';

            $('.add-data-content').prepend(myvar);
        });

        $(document).on('click', '.minus-btn-data-content', function() {
            $(this).parent().parent().remove();
        });

        $(document).on('click', '.minus-btn-data-old-audio', function() {
            $(this).parent().parent().parent().append(
                '<input type="hidden" name="delete_certificates_file[]" value="' + $(this).attr(
                    'audio_file_id') + '">');
            $(this).parent().parent().remove();
        });
    </script>
</body>

</html>
