<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Add University</title>

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
                            Add University
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
                                    <form class="forms-sample" action="{{ route('admin.university.store') }}"
                                        method="POST" enctype="multipart/form-data">
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
                                                                    accept="image/*" id="icon_upload" required>
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
                                                            <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                                                alt="" class="img-fluid"
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
                                                                    id="banner_upload" required>
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
                                                            <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                                                alt="" class="img-fluid"
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
                                                            style="font-size: 1.25rem; line-height:0;">*</span>
                                                    </label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Enter University Name"
                                                            value="{{ old('name') }}" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Short Name:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span>
                                                    </label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="short_name" class="form-control"
                                                            placeholder="Enter University Short Name"
                                                            value="{{ old('short_name') }}" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Major
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span>
                                                    </label>
                                                    <select id="major_id"
                                                        class="form-control form-control-lg majorSelect2"
                                                        name="major_id[]" multiple required>
                                                        <option value="">Select Major</option>
                                                        @foreach ($majors as $major)
                                                            <option value="{{ $major->id }}"
                                                                @if (in_array($major->id, old('major_id', []))) selected @endif>
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
                                                        @foreach ($scholarships as $scholarship)
                                                            <option value="{{ $scholarship->id }}"
                                                                @if (in_array($scholarship->id, old('scholarship_id', []))) selected @endif>
                                                                {{ $scholarship->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Additional Scholarships</label>
                                                    <select class="form-control form-control-lg scholarshipSelect2"
                                                        name="optional_scholarship_id[]" multiple>
                                                        <option value="">Select Scholarships</option>
                                                        <option value="free"
                                                            @if (in_array('free', old('optional_scholarship_id', []))) selected @endif>
                                                            Full Scholarship
                                                        </option>
                                                        @foreach ($scholarships as $scholarship)
                                                            <option value="{{ $scholarship->id }}"
                                                                @if (in_array($scholarship->id, old('optional_scholarship_id', []))) selected @endif>
                                                                {{ $scholarship->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Dormitory</label>
                                                    <select class="form-control form-control-lg dormitorySelect2"
                                                        name="dormitory_id[]" multiple>
                                                        <option value="">Select Dormitory</option>
                                                        @foreach ($dormitories as $dormitory)
                                                            <option value="{{ $dormitory->id }}"
                                                                @if (in_array($dormitory->id, old('dormitory_id', []))) selected @endif>
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
                                                        name="continent_id" required>
                                                        <option value="">Select Continent</option>
                                                        @foreach ($continents as $continent)
                                                            <option value="{{ $continent->id }}"
                                                                @if (old('continent_id') == $continent->id) selected @endif>
                                                                {{ $continent->name }}
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
                                                        @if (old('continent_id'))
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->id }}"
                                                                    @if (old('country_id') == $country->id) selected @endif>
                                                                    {{ $country->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
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
                                                            <option value="{{ $state->id }}"
                                                                @if (old('state_id') == $state->id) selected @endif>
                                                                {{ $state->name }}
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
                                                        @if (old('state_id'))
                                                            @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}"
                                                                    @if (old('city_id') == $city->id) selected @endif>
                                                                    {{ $city->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Intake <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <select class="form-control form-control-lg" name="intake"
                                                        id="intake" required>
                                                        <option value="">Select Intake</option>
                                                        @foreach ($intakes as $single)
                                                            <option value="{{ $single->name }}"
                                                                @if (old('intake') == $single->name) selected @endif>
                                                                {{ $single->name }}
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
                                                        placeholder="Enter Address" value="{{ old('address') }}"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Application Fees (CNY)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="application_charge"
                                                        placeholder="Enter Application Fees" class="form-control"
                                                        value="{{ old('application_charge') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Yearly Tuition Fee (CNY)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="year_fee"
                                                        placeholder="Enter Yearly Tuition Fee" class="form-control"
                                                        value="{{ old('year_fee') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Accommodation Fee (CNY)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="accommodation_fee"
                                                        placeholder="Enter Accommodation Fee" class="form-control"
                                                        value="{{ old('accommodation_fee') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Yearly Insurance Fee (CNY)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="insurance_fee"
                                                        placeholder="Enter Insurance Fee" class="form-control"
                                                        value="{{ old('insurance_fee') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Visa Extension Fee (CNY)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="visa_extension_fee"
                                                        placeholder="Enter Visa Extension Fee" class="form-control"
                                                        value="{{ old('visa_extension_fee') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Medical In China Fee (CNY)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="medical_in_china_fee"
                                                        placeholder="Enter Medical In China Fee" class="form-control"
                                                        value="{{ old('medical_in_china_fee') }}" required>
                                                </div>
                                            </div>

                                            {{-- Service Charge  --}}

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge (Beginner)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0"
                                                        name="service_charge_beginner"
                                                        placeholder="Enter Service Charge" class="form-control"
                                                        value="{{ old('service_charge_beginner') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge (1 star)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="service_charge_1"
                                                        placeholder="Enter Service Charge" class="form-control"
                                                        value="{{ old('service_charge_1') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge (2 star)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="service_charge_2"
                                                        placeholder="Enter Service Charge" class="form-control"
                                                        value="{{ old('service_charge_2') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge (3 star)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="service_charge_3"
                                                        placeholder="Enter Service Charge" class="form-control"
                                                        value="{{ old('service_charge_3') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge (4 star)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="service_charge_4"
                                                        placeholder="Enter Service Charge" class="form-control"
                                                        value="{{ old('service_charge_4') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge (5 star)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="service_charge_5"
                                                        placeholder="Enter Service Charge" class="form-control"
                                                        value="{{ old('service_charge_5') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge (6 star)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="service_charge_6"
                                                        placeholder="Enter Service Charge" class="form-control"
                                                        value="{{ old('service_charge_6') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge (7 star)<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <input type="number" min="0" name="service_charge_7"
                                                        placeholder="Enter Service Charge" class="form-control"
                                                        value="{{ old('service_charge_7') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tags</label>
                                                    <select id="tags"
                                                        class="form-control form-control-lg tagsSelect2"
                                                        name="tags[]" multiple>
                                                        <option value="">Select Tags</option>
                                                        <option value="211 Projects">211 Projects</option>
                                                        <option value="985 Projects">985 Projects</option>
                                                        <option value="Double First Class">Double First Class</option>
                                                        <option value="C9 League">C9 League</option>
                                                    </select>
                                                    <p class="text-sm text-muted">Maximum 3</p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Accommodation <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <textarea class="form-control editor" name="accommodation" style="height: 150px"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Admissions Process <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <textarea class="form-control editor" name="admissions_process" style="height: 150px"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>About <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <textarea class="form-control editor" name="about" style="height: 150px"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <h5>Display Section</h5>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">University Type:</label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="university_type"
                                                            class="form-control" placeholder="Enter University Type"
                                                            value="{{ old('university_type') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">World Rank:</label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="world_rank" class="form-control"
                                                            placeholder="Enter World Rank"
                                                            value="{{ old('world_rank') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">National Rank:</label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="national_rank"
                                                            class="form-control" placeholder="Enter National Rank"
                                                            value="{{ old('national_rank') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Total Students:</label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="total_students"
                                                            class="form-control" placeholder="Enter Total Students"
                                                            value="{{ old('total_students') }}">
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
                                                            value="{{ old('international_students') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Student Enrolled:</label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="student_enrolled"
                                                            class="form-control" placeholder="Enter Student Enrolled"
                                                            value="{{ old('student_enrolled') }}">
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
                                                            value="{{ old('countdown_deadline') }}"
                                                            min="{{ date('Y-m-d') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-12 mb-2">
                                                <h5>Fees Structure</h5>
                                            </div>

                                            <!-- First Group -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Degree</label>
                                                    <select name="degree[]" class="form-control form-control-lg">
                                                        <option value="">Select Degree</option>
                                                        <option value="Bachelor">Bachelor</option>
                                                        <option value="Masters">Masters</option>
                                                        <option value="PhD">PhD</option>
                                                        <option value="Non-Degree">Non-Degree</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tuition Fee 1 (CNY)</label>
                                                    <input type="number" min="0" name="fs_tuition_fee_1[]"
                                                        placeholder="Enter Yearly Tuition Fee" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tuition Fee 2 (CNY)</label>
                                                    <input type="number" min="0" name="fs_tuition_fee_2[]"
                                                        placeholder="Enter Yearly Tuition Fee" class="form-control">
                                                </div>
                                            </div>

                                            <!-- Second Group -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Degree</label>
                                                    <select name="degree[]" class="form-control form-control-lg">
                                                        <option value="">Select Degree</option>
                                                        <option value="Bachelor">Bachelor</option>
                                                        <option value="Masters">Masters</option>
                                                        <option value="PhD">PhD</option>
                                                        <option value="Non-Degree">Non-Degree</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tuition Fee 1 (CNY)</label>
                                                    <input type="number" min="0" name="fs_tuition_fee_1[]"
                                                        placeholder="Enter Yearly Tuition Fee" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tuition Fee 2 (CNY)</label>
                                                    <input type="number" min="0" name="fs_tuition_fee_2[]"
                                                        placeholder="Enter Yearly Tuition Fee" class="form-control">
                                                </div>
                                            </div>

                                            <!-- Third Group -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Degree</label>
                                                    <select name="degree[]" class="form-control form-control-lg">
                                                        <option value="">Select Degree</option>
                                                        <option value="Bachelor">Bachelor</option>
                                                        <option value="Masters">Masters</option>
                                                        <option value="PhD">PhD</option>
                                                        <option value="Non-Degree">Non-Degree</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tuition Fee 1 (CNY)</label>
                                                    <input type="number" min="0" name="fs_tuition_fee_1[]"
                                                        placeholder="Enter Yearly Tuition Fee" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tuition Fee 2 (CNY)</label>
                                                    <input type="number" min="0" name="fs_tuition_fee_2[]"
                                                        placeholder="Enter Yearly Tuition Fee" class="form-control">
                                                </div>
                                            </div>

                                            <!-- Fourth Group -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Degree</label>
                                                    <select name="degree[]" class="form-control form-control-lg">
                                                        <option value="">Select Degree</option>
                                                        <option value="Bachelor">Bachelor</option>
                                                        <option value="Masters">Masters</option>
                                                        <option value="PhD">PhD</option>
                                                        <option value="Non-Degree">Non-Degree</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tuition Fee 1 (CNY)</label>
                                                    <input type="number" min="0" name="fs_tuition_fee_1[]"
                                                        placeholder="Enter Yearly Tuition Fee" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tuition Fee 2 (CNY)</label>
                                                    <input type="number" min="0" name="fs_tuition_fee_2[]"
                                                        placeholder="Enter Yearly Tuition Fee" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Accommodation Fee 1 (CNY)</label>
                                                    <input type="number" min="0"
                                                        name="fs_accommodation_fee_1"
                                                        placeholder="Enter Accommodation Fee" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Accommodation Fee 2 (CNY)</label>
                                                    <input type="number" min="0" name="fs_ccommodation_fee_2"
                                                        placeholder="Enter Accommodation Fee" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Insurance Fee (CNY)</label>
                                                    <input type="number" min="0" name="fs_insurance_fee"
                                                        placeholder="Enter Insurance Fee" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Visa Extension Fee (CNY)</label>
                                                    <input type="number" min="0" name="fs_visa_extension_fee"
                                                        placeholder="Enter Visa Extension Fee" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Medical In China Fee (CNY)</label>
                                                    <input type="number" min="0"
                                                        name="fs_medical_in_china_fee"
                                                        placeholder="Enter Medical In China Fee" class="form-control">
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
