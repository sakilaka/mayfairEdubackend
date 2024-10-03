<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Edit University</title>

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
                            Edit University
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.university.index') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All University</a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-md-12 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample"
                                        action="{{ route('admin.university.update', $university->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row mb-3">
                                            <div class="col-sm-12 col-md-8 col-lg-6">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">University Icon <span
                                                                    class="text-danger"
                                                                    style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                            <div class="dropify-wrapper" style="border: none">
                                                                <div class="dropify-loader"></div>
                                                                <div class="dropify-errors-container">
                                                                    <ul></ul>
                                                                </div>
                                                                <input type="file" class="dropify" name="image"
                                                                    accept="image/*" id="icon_upload">
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
                                                            <img src="{{ $university->image_show ?? asset('frontend/images/No-image.jpg') }}"
                                                                alt="{{ $university->name }}-icon" class="img-fluid"
                                                                style="border-radius: 10px; max-height: 200px !important;"
                                                                id="icon_preview">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-8 col-lg-6">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">University Banner Image
                                                                <span class="text-danger"
                                                                    style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                            <div class="dropify-wrapper" style="border: none">
                                                                <div class="dropify-loader"></div>
                                                                <div class="dropify-errors-container">
                                                                    <ul></ul>
                                                                </div>
                                                                <input type="file" class="dropify"
                                                                    name="banner_image" accept="image/*"
                                                                    id="banner_upload">
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
                                                            <img src="{{ $university->banner_image_show ?? asset('frontend/images/No-image.jpg') }}"
                                                                alt="{{ $university->name }}-banner-image"
                                                                class="img-fluid"
                                                                style="border-radius: 10px; max-height: 200px !important;"
                                                                id="banner_preview">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">University Name:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Enter University Name"
                                                            value="{{ $university->name }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Short Name:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="short_name" class="form-control"
                                                            placeholder="Enter University Short Name"
                                                            value="{{ $university->short_name }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Major
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span>
                                                    </label>
                                                    <select class="form-control form-control-lg majorSelect2"
                                                        name="major_id[]" multiple required>
                                                        <option value="">Select Major(s)</option>
                                                        @php
                                                            $selectedMajors =
                                                                json_decode($university->major_id, true) ?? [];
                                                        @endphp

                                                        @foreach ($majors as $major)
                                                            <option value="{{ $major->id }}"
                                                                @if (in_array($major->id, $selectedMajors)) selected @endif>
                                                                {{ $major->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Scholarship
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span>
                                                    </label>
                                                    <select class="form-control form-control-lg scholarshipSelect2"
                                                        name="scholarship_id[]" multiple required>
                                                        <option value="">Select Scholarships</option>
                                                        @php
                                                            $selectedScholarships =
                                                                json_decode($university->scholarships, true) ?? [];
                                                        @endphp

                                                        @foreach ($scholarships as $scholarship)
                                                            <option value="{{ $scholarship->id }}"
                                                                @if (in_array($scholarship->id, $selectedScholarships)) selected @endif>
                                                                {{ $scholarship->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    @php
                                                        $scholarship_ids = [];
                                                        foreach (
                                                            json_decode($university->additional_scholarships, true) ??
                                                                []
                                                            as $id
                                                        ) {
                                                            $scholarship_ids[] = $id;
                                                        }
                                                    @endphp
                                                    <label>Additional Scholarships</label>
                                                    <select class="form-control form-control-lg scholarshipSelect2"
                                                        name="optional_scholarship_id[]" multiple>
                                                        <option value="">Select Scholarships</option>
                                                        <option value="free"
                                                            @if ($university->scholarship_id == 'free') Selected @endif>
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
                                                    <label>Dormitory
                                                    </label>
                                                    <select class="form-control form-control-lg dormitorySelect2"
                                                        name="dormitory_id[]" multiple>
                                                        <option value="">Select Dormitory</option>
                                                        @php
                                                            $selectedDormitories =
                                                                json_decode($university->dormitories, true) ?? [];
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
                                            {{-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Continent
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span>
                                                    </label>
                                                    <select id="continent" class="form-control form-control-lg"
                                                        name="continent_id" id="phar_cat" required>
                                                        <option value="">Select Continent</option>
                                                        @foreach ($continents as $continent)
                                                            <option @if ($continent->id == $university->continent_id) Selected @endif
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
                                                    <select class="form-control form-control-lg" name="country_id"
                                                        id="country" required>
                                                        <option value="">Select Continent First</option>
                                                        @foreach ($countries as $country)
                                                            <option @if ($country->id == $university->country_id) Selected @endif
                                                                value="{{ $country->id }}">{{ $country->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Province <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <select class="form-control form-control-lg" name="state_id"
                                                        id="state" required>
                                                        <option value="">Select Province</option>
                                                        @foreach ($states as $state)
                                                            <option @if ($state->id == $university->state_id) Selected @endif
                                                                value="{{ $state->id }}">{{ $state->name }}
                                                            </option>
                                                        @endforeach
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
                                                        @foreach ($cities as $city)
                                                            <option @if ($city->id == $university->city_id) Selected @endif
                                                                value="{{ $city->id }}">{{ $city->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Address <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="text" name="address" class="form-control"
                                                        placeholder="Enter Address"
                                                        value="{{ $university->address }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Application Fees (CNY)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="application_charge"
                                                        placeholder="Enter Application Fees"
                                                        value="{{ $university->application_charge }}"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Yearly Fee (CNY)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="year_fee"
                                                        placeholder="Enter Yearly Course Fee"
                                                        value="{{ $university->year_fee }}" class="form-control"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Accommodation Fee (CNY)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="accommodation_fee"
                                                        placeholder="Enter Accommodation Fee" class="form-control"
                                                        value="{{ $university->accommodation_fee }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Yearly Insurance Fee (CNY)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="insurance_fee"
                                                        placeholder="Enter Insurance Fee" class="form-control"
                                                        value="{{ $university->insurance_fee }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Visa Extension Fee (CNY)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="visa_extension_fee"
                                                        placeholder="Enter Visa Extension Fee" class="form-control"
                                                        value="{{ $university->visa_extension_fee }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Medical In China Fee (CNY)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="medical_in_china_fee"
                                                        placeholder="Enter Medical In China Fee" class="form-control"
                                                        value="{{ $university->medical_in_china_fee }}" required>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge (CNY)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="service_charge"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $university->service_charge }}"
                                                        class="form-control" required>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge 1 (CNY)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="service_charge_1"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $university->service_charge_1 }}"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge 2 (CNY)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="service_charge_2"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $university->service_charge_2 }}"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tags</label>
                                                    @php
                                                        $tags = json_decode($university->tags, true) ?? [];
                                                        $availableTags = [
                                                            '211 Projects',
                                                            '985 Projects',
                                                            'Double First Class',
                                                            'C9 League',
                                                        ];
                                                    @endphp

                                                    <select id="tags"
                                                        class="form-control form-control-lg tagsSelect2"
                                                        name="tags[]" multiple>
                                                        @foreach ($availableTags as $tag)
                                                            <option value="{{ $tag }}"
                                                                {{ in_array($tag, $tags) ? 'selected' : '' }}>
                                                                {{ $tag }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-sm text-muted">Maximum 3</p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Accommodation <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <textarea class="form-control editor" name="accommodation" style="height: 150px">{{ $university->accommodation }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Admissions Process <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <textarea class="form-control editor" name="admissions_process" style="height: 150px">{{ $university->admissions_process }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>About <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <textarea class="form-control editor" name="about" style="height: 150px">{{ $university->about }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <h5>Display Section</h5>
                                            </div>
                                            @php
                                                $display_data = json_decode($university->display_data, true);
                                            @endphp

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">University Type:</label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="university_type"
                                                            class="form-control" placeholder="Enter University Type"
                                                            value="{{ $display_data['university_type'] ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">World Rank:</label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="world_rank" class="form-control"
                                                            placeholder="Enter World Rank"
                                                            value="{{ $display_data['world_rank'] ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">National Rank:</label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="national_rank"
                                                            class="form-control" placeholder="Enter National Rank"
                                                            value="{{ $display_data['national_rank'] ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Total Students:</label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="total_students"
                                                            class="form-control" placeholder="Enter Total Students"
                                                            value="{{ $display_data['total_students'] ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">International Students:</label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="international_students"
                                                            class="form-control"
                                                            placeholder="Enter International Students"
                                                            value="{{ $display_data['international_students'] ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Student Enrolled:</label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="student_enrolled"
                                                            class="form-control" placeholder="Enter Student Enrolled"
                                                            value="{{ $display_data['student_enrolled'] ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Countdown Deadline:</label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="date" name="countdown_deadline"
                                                            class="form-control"
                                                            placeholder="Enter Countdown Deadline"
                                                            value="{{ $display_data['countdown_deadline'] ?? '' }}"
                                                            {{-- min="{{ date('Y-m-d') }}" --}}>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-12 mb-2">
                                                <h5>Fees Structure</h5>
                                            </div>
                                            @php
                                                $fees_structure = json_decode($university->fees_structure, true) ?? [];
                                                $total_groups = 4;
                                            @endphp

                                            @for ($index = 0; $index < $total_groups; $index++)
                                                <!-- Group for Each Degree -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Select Degree</label>
                                                        <select name="degree[]" class="form-control form-control-lg">
                                                            <option value="">Select Degree</option>
                                                            <option value="Bachelor"
                                                                {{ ($fees_structure['degrees'][$index] ?? '') == 'Bachelor' ? 'selected' : '' }}>
                                                                Bachelor</option>
                                                            <option value="Masters"
                                                                {{ ($fees_structure['degrees'][$index] ?? '') == 'Masters' ? 'selected' : '' }}>
                                                                Masters</option>
                                                            <option value="PhD"
                                                                {{ ($fees_structure['degrees'][$index] ?? '') == 'PhD' ? 'selected' : '' }}>
                                                                PhD</option>
                                                            <option value="Non-Degree"
                                                                {{ ($fees_structure['degrees'][$index] ?? '') == 'Non-Degree' ? 'selected' : '' }}>
                                                                Non-Degree</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Tuition Fee 1 (CNY)</label>
                                                        <input type="number" min="0"
                                                            name="fs_tuition_fee_1[]"
                                                            placeholder="Enter Yearly Tuition Fee"
                                                            class="form-control"
                                                            value="{{ $fees_structure['tuition_fees_1'][$index] ?? '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Tuition Fee 2 (CNY)</label>
                                                        <input type="number" min="0"
                                                            name="fs_tuition_fee_2[]"
                                                            placeholder="Enter Yearly Tuition Fee"
                                                            class="form-control"
                                                            value="{{ $fees_structure['tuition_fees_2'][$index] ?? '' }}">
                                                    </div>
                                                </div>
                                            @endfor

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Accommodation Fee 1 (CNY)</label>
                                                    <input type="number" min="0"
                                                        name="fs_accommodation_fee_1"
                                                        placeholder="Enter Accommodation Fee" class="form-control"
                                                        value="{{ $fees_structure['accommodation_fees_1'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Accommodation Fee 2 (CNY)</label>
                                                    <input type="number" min="0"
                                                        name="fs_accommodation_fee_2"
                                                        placeholder="Enter Accommodation Fee" class="form-control"
                                                        value="{{ $fees_structure['accommodation_fees_2'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Insurance Fee (CNY)</label>
                                                    <input type="number" min="0" name="fs_insurance_fee"
                                                        placeholder="Enter Insurance Fee" class="form-control"
                                                        value="{{ $fees_structure['insurance_fee'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Visa Extension Fee (CNY)</label>
                                                    <input type="number" min="0" name="fs_visa_extension_fee"
                                                        placeholder="Enter Visa Extension Fee" class="form-control"
                                                        value="{{ $fees_structure['visa_extension_fee'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Medical In China Fee (CNY)</label>
                                                    <input type="number" min="0"
                                                        name="fs_medical_in_china_fee"
                                                        placeholder="Enter Medical In China Fee" class="form-control"
                                                        value="{{ $fees_structure['medical_in_china_fee'] ?? '' }}">
                                                </div>
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

    <script src="{{ asset('backend/assets/js/select2.js') }}"></script>
    <script src="{{ asset('backend/assets/js/dropify.js') }}"></script>
    <script>
        $('select').select2();
        // $('.scholarshipSelect2').select2();
        // $('.dormitorySelect2').select2();
        // $('.majorSelect2').select2();

        $('#icon_upload').on('change', function(e) {
            var fileInput = $(this)[0];

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#icon_preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        });
        $('#banner_upload').on('change', function(e) {
            var fileInput = $(this)[0];

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#banner_preview').attr('src', e.target.result);
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
</body>

</html>
