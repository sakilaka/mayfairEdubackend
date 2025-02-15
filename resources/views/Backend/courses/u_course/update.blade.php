<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Edit University Program</title>

    <style>
        /* .select2-container--default .select2-selection--single {
            padding: 17px 5px;
        } */

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding: 2px 0px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 12px;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__rendered{
            overflow-y: auto;
        }
    </style>
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
                            Edit University Program
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-md-12 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample"
                                        action="{{ route('admin.u_course.update', $course->id) }}" method="POST">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>University <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <select class="form-control form-control-lg" name="university_id"
                                                        required>
                                                        <option value="">Select University</option>
                                                        @foreach ($universities as $university)
                                                            <option @if ($university->id == $course->university_id) Selected @endif
                                                                value="{{ $university->id }}">{{ $university->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                             {{-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Universities <span class="text-danger">*</span></label>
                                                    <select id="university-select" class="form-control form-control-lg select2" name="university_id" multiple="multiple" required>
                                                        <option value="all">Select All</option>
                                                        @foreach ($universities as $university)
                                                            <option value="{{ $university->id }}"
                                                                @if(in_array($university->id, explode(',', $course->university_id))) selected @endif>
                                                                {{ $university->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> --}}

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Major <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <select class="form-control form-control-lg" id="department"
                                                        name="department_id" required>
                                                        <option value="">Select Department</option>
                                                        @foreach ($departments as $department)
                                                            <option value="{{ $department->id }}"
                                                                {{ $department->id == $course->department_id ? 'selected' : '' }}>
                                                                {{ $department->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Degree <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <select class="form-control form-control-lg" id="degree"
                                                        name="degree_id" required>
                                                        <option value="">Select Degree</option>
                                                        @foreach ($degrees as $degree)
                                                            <option value="{{ $degree->id }}"
                                                                @if ($degree->id == $course->degree_id) selected @endif>
                                                                {{ $degree->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Dormitory
                                                    </label>
                                                    <select class="form-control form-control-lg dormitorySelect2"
                                                        name="dormitory_id[]" multiple>
                                                        <option value="">Select Dormitory</option>
                                                        @php
                                                            $selectedDormitories =
                                                                json_decode($course->dormitories, true) ?? [];
                                                        @endphp

                                                        @foreach ($dormitories as $dormitory)
                                                            <option value="{{ $dormitory->id }}"
                                                                @if (in_array($dormitory->id, $selectedDormitories)) selected @endif>
                                                                {{ $dormitory->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Primary Scholarship</label>
                                                    <select class="form-control form-control-lg" name="scholarship_id">
                                                        <option value="">Select Scholarships</option>
                                                        <option value="free">Full Scholarship</option>
                                                        @foreach ($scholarships as $scholarship)
                                                            <option value="{{ $scholarship->id }}"
                                                                {{ $scholarship->id == $course->scholarship_id ? 'selected' : '' }}>
                                                                {{ $scholarship->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    @php
                                                        $scholarship_ids = [];
                                                        foreach (
                                                            json_decode($course->additional_scholarships, true) ?? []
                                                            as $id
                                                        ) {
                                                            $scholarship_ids[] = $id;
                                                        }
                                                    @endphp
                                                    <label>Additional Scholarships</label>
                                                    <select class="form-control form-control-lg multipleSelect2Search"
                                                        name="optional_scholarship_id[]" multiple>
                                                        <option value="">Select Scholarships</option>
                                                        <option value="free"
                                                            @if ($course->scholarship_id == 'free') Selected @endif>
                                                            Full Scholarship
                                                        </option>
                                                        @foreach ($scholarships as $scholarship)
                                                            <option value="{{ $scholarship->id }}"
                                                                @if (in_array($scholarship->id, $scholarship_ids)) selected @endif>
                                                                {{ $scholarship->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Course Name <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="text" name="course_name"
                                                        placeholder="Enter Course Name" value="{{ $course->name }}"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Intake <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <select class="form-control form-control-lg" name="section_id"
                                                        required>
                                                        <option value="">Select Intake</option>
                                                        @foreach ($sections as $section)
                                                            <option @if ($section->id == $course->section_id) Selected @endif
                                                                value="{{ $section->id }}">{{ $section->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Application Fees ($)</label>
                                                    <input type="number" min="0" name="application_charge"
                                                        placeholder="Enter Application Fees"
                                                        value="{{ $course->application_charge }}" class="form-control"
                                                        >
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge ($)</label>
                                                    <input type="number" min="0" name="service_charge"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $course->service_charge }}" class="form-control"
                                                        >
                                                </div>
                                            </div> --}}

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge (Beginner)</label>
                                                    <input type="number" min="0" name="service_charge_beginner"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $course->service_charge_beginner }}" class="form-control"
                                                        >
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge 1 ($)</label>
                                                    <input type="number" min="0" name="service_charge_1"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $course->service_charge_1 }}" class="form-control"
                                                        >
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge 2 ($)</label>
                                                    <input type="number" min="0" name="service_charge_2"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $course->service_charge_2 }}" class="form-control"
                                                        >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge 3 ($)</label>
                                                    <input type="number" min="0" name="service_charge_3"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $course->service_charge_3 }}" class="form-control"
                                                        >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge 4 ($)</label>
                                                    <input type="number" min="0" name="service_charge_4"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $course->service_charge_4 }}" class="form-control"
                                                        >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge 5 ($)</label>
                                                    <input type="number" min="0" name="service_charge_5"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $course->service_charge_5 }}" class="form-control"
                                                        >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge 6 ($)</label>
                                                    <input type="number" min="0" name="service_charge_6"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $course->service_charge_6 }}" class="form-control"
                                                        >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge 7 ($)</label>
                                                    <input type="number" min="0" name="service_charge_7"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $course->service_charge_7 }}" class="form-control"
                                                        >
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Yearly Fee ($)</label>
                                                    <input type="number" min="0" name="year_fee"
                                                        placeholder="Enter Yearly Course Fee"
                                                        value="{{ $course->year_fee }}" class="form-control"
                                                        >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Accommodation Fee ($)</label>
                                                    <input type="number" min="0" name="accommodation_fee"
                                                        placeholder="Enter Accommodation Fee" class="form-control"
                                                        value="{{ $course->accommodation_fee }}" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Yearly Insurance Fee ($)</label>
                                                    <input type="number" min="0" name="insurance_fee"
                                                        placeholder="Enter Insurance Fee" class="form-control"
                                                        value="{{ $course->insurance_fee }}" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Visa Extension Fee ($)</label>
                                                    <input type="number" min="0" name="visa_extension_fee"
                                                        placeholder="Enter Visa Extension Fee" class="form-control"
                                                        value="{{ $course->visa_extension_fee }}" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Medical In China Fee ($)</label>
                                                    <input type="number" min="0" name="medical_in_china_fee"
                                                        placeholder="Enter Medical In China Fee" class="form-control"
                                                        value="{{ $course->medical_in_china_fee }}" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Others Fee (Logistics)</label>
                                                    <input type="number" min="0" name="others_fee"
                                                        placeholder="Enter Others Fee ($)"
                                                        value="{{ $course->others_fee }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Program Type </label>
                                                    <select class="form-control form-control-lg" name="course_type"
                                                        >
                                                        <option @if ($course->coursetype == '1') Selected @endif
                                                            value="1">Our Top Picks</option>
                                                        <option @if ($course->coursetype == '2') Selected @endif
                                                            value="2">Most Popular</option>
                                                        <option @if ($course->coursetype == '3') Selected @endif
                                                            value="3">Fastest Admissions</option>
                                                        <option @if ($course->coursetype == '4') Selected @endif
                                                            value="4">Highest Rating</option>
                                                        <option @if ($course->coursetype == '5') Selected @endif
                                                            value="5">Top Ranked</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Course Duration (Yearly) </label>
                                                    <input type="text" min="0" name="course_duration"
                                                        placeholder="Enter Course Duration In Yearly"
                                                        value="{{ $course->course_duration }}" class="form-control"
                                                        >
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Application Start Date </label>
                                                    <input type="date" name="next_start_date"
                                                        value="{{ $course->next_start_date }}" class="form-control"
                                                        >
                                                </div>
                                            </div> --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Application Deadline </label>
                                                    <input type="date" name="application_deadline"
                                                        value="{{ $course->application_deadline }}"
                                                        class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Course Language </label>
                                                    <select class="form-control form-control-lg" name="language_id"
                                                        >
                                                        <option value="">Select Course Language</option>
                                                        @foreach ($languages as $language)
                                                            <option @if ($course->language_id == $language->id) Selected @endif
                                                                value="{{ $language->id }}">{{ $language->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Category </label>
                                                    <select id="cat" class="form-control form-control-lg"
                                                        name="category_id" >
                                                        <option value="">Select Category</option>
                                                        @foreach ($categories as $category)
                                                            @php
                                                                $is_selected = '';
                                                                if ($category->id == $course->category_id) {
                                                                    $is_selected = 'selected';
                                                                    // Fetch sub category for the selected category
                                                                    $sub_categories = App\Models\Category::where(
                                                                        'parent_id',
                                                                        $course->category_id,
                                                                    )
                                                                        ->orderBy('id', 'desc')
                                                                        ->get();
                                                                }
                                                            @endphp
                                                            <option value="{{ $category->id }}" {{ $is_selected }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Sub Category </label>
                                                    <select id="subCat" class="form-control form-control-lg"
                                                        name="sub_category_id">
                                                        <option value="">Select Category First</option>
                                                        @isset($sub_categories)
                                                            @foreach ($sub_categories as $sub_category)
                                                                <option value="{{ $sub_category->id }}"
                                                                    @if ($sub_category->id == $course->sub_category_id) selected @endif>
                                                                    {{ $sub_category->name }}
                                                                </option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Related Programs</label>
                                                    <select class="form-control form-control-lg multipleSelect2Search"
                                                        name="relatedcourse_id[]" multiple>
                                                        <option value="">Select Programs</option>
                                                        @foreach ($courses as $selected_course)
                                                            <option @if ($selected_course->relatedcourses->where('course_id', $course->id)->all()) Selected @endif
                                                                value="{{ $selected_course->id }}">
                                                                {{ $selected_course->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Pre Requisites </label>
                                                    <textarea class="form-control editor" name="requisites" style="height: 150px">{!! $course->requisites !!}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>About This Program / Overview </label>
                                                    <textarea class="form-control editor" name="about" style="height: 150px">{!! $course->about !!}</textarea>
                                                </div>
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
    @include('Backend.components.ckeditor5-config')

    <script src="{{ asset('backend/assets/js/select2.js') }}"></script>
    <script src="{{ asset('backend/assets/js/dropify.js') }}"></script>
    <script>
        $(document).ready(function () {
            var selectElement = $('#university-select');

            // Initialize Select2
            selectElement.select2({
                placeholder: "Select Universities",
                allowClear: true
            });

            // Handle "Select All" functionality
            selectElement.on('change', function () {
                var selectedValues = $(this).val(); // Get selected values

                if (selectedValues && selectedValues.includes("all")) {
                    // Select all universities
                    $(this).find("option").prop("selected", true);
                } else {
                    // If "Select All" is deselected, remove all selections
                    $(this).find("option[value='all']").prop("selected", false);
                }

                $(this).trigger("change.select2"); // Update Select2 UI
            });
        });
    </script>
    <script>
        $('select').select2();
        // $('.multipleSelect2Search').select2();
        // $('.dormitorySelect2').select2();

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

        // fetch degrees based on department selection
        /* $('#department').on("change", function() {
            let id = $(this).val();
            let url = '/get/degree/' + id;

            if (id == null || id == '') {
                $('#degree').empty();
                let html = '<option value="">Select Department First</option>';
                $('#degree').append(html);
            }

            $.ajax({
                url: url,
                type: 'GET',
                success: function(res) {
                    $('#degree').empty();
                    let html = '<option value="">Select Degree</option>';

                    res.forEach(function(element) {
                        html += '<option value="' + element.id + '">' + element.name +
                            '</option>';
                    });
                    $('#degree').append(html);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }); */
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('change', 'select[name="university_id"]', function() {
                let university_id = $(this).val();

                $('input[name="year_fee"]').val('');
                $('input[name="service_charge_beginner"]').val('');
                $('input[name="service_charge_1"]').val('');
                $('input[name="service_charge_2"]').val('');
                $('input[name="service_charge_3"]').val('');
                $('input[name="service_charge_4"]').val('');
                $('input[name="service_charge_5"]').val('');
                $('input[name="service_charge_6"]').val('');
                $('input[name="service_charge_7"]').val('');
                $('input[name="application_charge"]').val('');
                $('input[name="accommodation_fee"]').val('');
                $('input[name="insurance_fee"]').val('');
                $('input[name="medical_in_china_fee"]').val('');
                $('input[name="visa_extension_fee"]').val('');

                let $scholarshipSelect = $('select[name="scholarship_id"]');
                $scholarshipSelect.empty();

                let $additionalScholarshipSelect = $('select[name="optional_scholarship_id[]"]');
                $additionalScholarshipSelect.empty();

                let $majorSelect = $('select[name="department_id"]');
                $majorSelect.empty();

                if (!university_id) {
                    $scholarshipSelect.append(
                        $('<option></option>').val('').text('No scholarship available')
                    );

                    $additionalScholarshipSelect.append(
                        $('<option></option>').val('').text('No scholarship available')
                    );

                    $majorSelect.append(
                        $('<option></option>').val('').text('No major available')
                    );
                    return;
                }

                $.ajax({
                    type: 'GET',
                    url: '{{ route('admin.ajax.getChargesData') }}',
                    data: {
                        university_id: university_id
                    },
                    success: function(response) {
                        $('input[name="year_fee"]').val(response.university.year_fee);

                        $('input[name="service_charge_beginner"]').val(response.university
                            .service_charge_beginner);
                            $('input[name="service_charge_1"]').val(response.university
                            .service_charge_1);
                        $('input[name="service_charge_2"]').val(response.university
                            .service_charge_2);
                        $('input[name="service_charge_3"]').val(response.university
                            .service_charge_3);
                        $('input[name="service_charge_4"]').val(response.university
                            .service_charge_4);
                        $('input[name="service_charge_5"]').val(response.university
                            .service_charge_5);
                        $('input[name="service_charge_6"]').val(response.university
                            .service_charge_6);
                        $('input[name="service_charge_7"]').val(response.university
                            .service_charge_7);

                        $('input[name="application_charge"]').val(response.university
                            .application_charge);
                        $('input[name="accommodation_fee"]').val(response.university
                            .accommodation_fee);
                        $('input[name="insurance_fee"]').val(response.university.insurance_fee);
                        $('input[name="medical_in_china_fee"]').val(response.university
                            .medical_in_china_fee);
                        $('input[name="visa_extension_fee"]').val(response.university
                            .visa_extension_fee);

                        // primary scholarship
                        if (response.scholarships.length > 0) {

                            if (response.scholarships.length > 1) {
                                $scholarshipSelect.append(
                                    $('<option></option>').val('').text(
                                        'Select Scholarship')
                                );
                            }

                            $.each(response.scholarships, function(index, scholarship) {
                                $scholarshipSelect.append(
                                    $('<option></option>').val(scholarship.id).text(
                                        scholarship
                                        .title)
                                );
                            });
                        } else {
                            $scholarshipSelect.append(
                                $('<option></option>').val('').text(
                                    'No scholarships available')
                            );
                        }

                        // additional scholarships
                        if (response.additional_scholarships.length > 0) {

                            if (response.additional_scholarships.length > 1) {
                                $additionalScholarshipSelect.append(
                                    $('<option></option>').val('').text(
                                        'Select Scholarships')
                                );
                            }

                            $.each(response.additional_scholarships, function(index,
                                scholarship) {

                                $additionalScholarshipSelect.append(
                                    $('<option  selected></option>').val(scholarship
                                        .id).text(
                                        scholarship
                                        .title)
                                );
                            });
                        } else {
                            $additionalScholarshipSelect.append(
                                $('<option></option>').val('').text(
                                    'No scholarship available')
                            );
                        }

                        // majors
                        if (response.university_majors.length > 0) {

                            if (response.university_majors.length > 1) {
                                $majorSelect.append(
                                    $('<option></option>').val('').text(
                                        'Select Major')
                                );
                            }

                            $.each(response.university_majors, function(index,
                                major) {

                                $majorSelect.append(
                                    $('<option></option>').val(major
                                        .id).text(
                                        major
                                        .name)
                                );
                            });
                        } else {
                            $majorSelect.append(
                                $('<option></option>').val('').text(
                                    'No scholarship available')
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('An error occurred:', error);
                    }
                });
            });

            $(document).on('change', 'select[name="department_id"]', function() {
                let major_id = $(this).val();
                const editorKey = 'about';

                if (!window.editorInstances || !window.editorInstances[editorKey]) {
                    console.error(`Editor instance for '${editorKey}' not found.`);
                } else {
                    const editorInstance = window.editorInstances[editorKey];
                    editorInstance.setData('');

                    $.ajax({
                        type: 'GET',
                        url: '{{ route('admin.fetch_major_overview') }}',
                        data: {
                            major_id: major_id
                        },
                        success: function(response) {
                            editorInstance.setData(response.major.overview);
                        },
                        error: function(xhr, status, error) {
                            console.log('An error occurred:', error);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
