<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Edit University</title>

    <style>
        /* Select2 multiple select container - set height and enable scrolling */
        .select2-container--default .select2-selection--multiple {
            max-height: 80px;
            overflow-y: auto;
            padding: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .select2-container--default .select2-selection__rendered {
            max-height: 80px;
            overflow-y: auto !important;
            padding: 5px;
        }

        .select2-container--default .select2-selection__choice {
            margin-top: 3px;
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
                                                            <label class="form-control-label">University Icon</label>
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
                                                                </label>
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
                                                        
                                                    </label>
                                                    <select class="form-control form-control-lg scholarshipSelect2"
                                                        name="scholarship_id[]" multiple>
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
                                            </div> --}}


                                            {{-- <div class="col-md-4">
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
                                            </div> --}}

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Country <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <select class="form-control form-control-lg" name="country_id"
                                                        id="country" required>
                                                        <option value="">Select Country</option>
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}"
                                                                @if ($country->id == $university->country_id) selected @endif>
                                                                {{ $country->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <select class="form-control form-control-lg" name="city_id"
                                                        id="city">
                                                        <option value="">Loading...</option>
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
                                                                @if ($single->name == $university->intake) Selected @endif>
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
                                                        placeholder="Enter Address"
                                                        value="{{ $university->address }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Application Fees ($)</label>
                                                    <input type="number" min="0" name="application_charge"
                                                        placeholder="Enter Application Fees"
                                                        value="{{ $university->application_charge }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Yearly Fee ($)</label>
                                                    <input type="number" min="0" name="year_fee"
                                                        placeholder="Enter Yearly Course Fee"
                                                        value="{{ $university->year_fee }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Accommodation Fee ($)</label>
                                                    <input type="number" min="0" name="accommodation_fee"
                                                        placeholder="Enter Accommodation Fee" class="form-control"
                                                        value="{{ $university->accommodation_fee }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Yearly Insurance Fee ($)</label>
                                                    <input type="number" min="0" name="insurance_fee"
                                                        placeholder="Enter Insurance Fee" class="form-control"
                                                        value="{{ $university->insurance_fee }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Visa Extension Fee ($)</label>
                                                    <input type="number" min="0" name="visa_extension_fee"
                                                        placeholder="Enter Visa Extension Fee" class="form-control"
                                                        value="{{ $university->visa_extension_fee }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Medical In China Fee ($)</label>
                                                    <input type="number" min="0" name="medical_in_china_fee"
                                                        placeholder="Enter Medical In China Fee" class="form-control"
                                                        value="{{ $university->medical_in_china_fee }}">
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge ($)</label>
                                                    <input type="number" min="0" name="service_charge"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $university->service_charge }}"
                                                        class="form-control">
                                                </div>
                                            </div> --}}

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge (Beginner)</label>
                                                    <input type="number" min="0"
                                                        name="service_charge_beginner"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $university->service_charge_beginner }}"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge (1 star)</label>
                                                    <input type="number" min="0" name="service_charge_1"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $university->service_charge_1 }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge (2 star)</label>
                                                    <input type="number" min="0" name="service_charge_2"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $university->service_charge_2 }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge (3 star)</label>
                                                    <input type="number" min="0" name="service_charge_3"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $university->service_charge_3 }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge (4 star)</label>
                                                    <input type="number" min="0" name="service_charge_4"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $university->service_charge_4 }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge (5 star)</label>
                                                    <input type="number" min="0" name="service_charge_5"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $university->service_charge_5 }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge (6 star)</label>
                                                    <input type="number" min="0" name="service_charge_6"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $university->service_charge_6 }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Charge (7 star)</label>
                                                    <input type="number" min="0" name="service_charge_7"
                                                        placeholder="Enter Service Charge"
                                                        value="{{ $university->service_charge_7 }}"
                                                        class="form-control">
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

                                        {{-- <div class="row">
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
                                                            >
                                                    </div>
                                                </div>
                                            </div>

                                        </div> --}}

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
                                                        <label>Tuition Fee 1 ($)</label>
                                                        <input type="number" min="0"
                                                            name="fs_tuition_fee_1[]"
                                                            placeholder="Enter Yearly Tuition Fee"
                                                            class="form-control"
                                                            value="{{ $fees_structure['tuition_fees_1'][$index] ?? '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Tuition Fee 2 ($)</label>
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
                                                    <label>Accommodation Fee 1 ($)</label>
                                                    <input type="number" min="0"
                                                        name="fs_accommodation_fee_1"
                                                        placeholder="Enter Accommodation Fee" class="form-control"
                                                        value="{{ $fees_structure['accommodation_fees_1'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Accommodation Fee 2 ($)</label>
                                                    <input type="number" min="0"
                                                        name="fs_accommodation_fee_2"
                                                        placeholder="Enter Accommodation Fee" class="form-control"
                                                        value="{{ $fees_structure['accommodation_fees_2'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Insurance Fee ($)</label>
                                                    <input type="number" min="0" name="fs_insurance_fee"
                                                        placeholder="Enter Insurance Fee" class="form-control"
                                                        value="{{ $fees_structure['insurance_fee'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Visa Extension Fee ($)</label>
                                                    <input type="number" min="0" name="fs_visa_extension_fee"
                                                        placeholder="Enter Visa Extension Fee" class="form-control"
                                                        value="{{ $fees_structure['visa_extension_fee'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Medical In China Fee ($)</label>
                                                    <input type="number" min="0"
                                                        name="fs_medical_in_china_fee"
                                                        placeholder="Enter Medical In China Fee" class="form-control"
                                                        value="{{ $fees_structure['medical_in_china_fee'] ?? '' }}">
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">

                                            <div class="col-12 mb-3 px-4">
                                                <div class="row justify-content-between">
                                                    <h4 class="d-inline">Galleries</h4>

                                                    <div class="d-flex">
                                                        {{-- <button type="submit" class="btn blue-btn btn-primary"
                                                            style="margin-right: 8px">Save</button> --}}

                                                        {{-- <a href="javascript:void(0)" class="btn btn-sm btn-primary"
                                                            id="add-gallery">
                                                            <i class="fa fa-plus"></i>
                                                            Add
                                                        </a> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 row" id="galleries-container"
                                                style="padding-right: 0">

                                                @php
                                                    $contents = [];
                                                    if ($university && $university->image_gallery) {
                                                        $decodedContents = json_decode(
                                                            $university->image_gallery,
                                                            true,
                                                        );
                                                        $contents = is_array($decodedContents) ? $decodedContents : [];
                                                    }
                                                @endphp

                                                @forelse ($contents as $galleryKey => $content)
                                                    <div class="col-sm-12 mb-3" style="padding-right: 0;">

                                                        {{-- @php
                                                            $random = rand();
                                                        @endphp --}}

                                                        <div class="card-header" data-toggle="collapse"
                                                            data-target="#activity_single_collapse_{{ $galleryKey }}">
                                                            <div class="d-flex justify-content-between">
                                                                <h5 class="card-title mb-0 py-2 gallery-title">
                                                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                                                    &nbsp;
                                                                    {{ $content['title'] ?? 'Gallery' }}
                                                                </h5>

                                                                {{-- <a href="javascript:void(0)"
                                                                    class="btn btn-sm btn-danger remove-gallery">
                                                                    <i class="fa fa-minus"></i>
                                                                </a> --}}
                                                            </div>
                                                        </div>

                                                        <div class="collapse"
                                                            id="activity_single_collapse_{{ $galleryKey }}">
                                                            <div class="card-body">
                                                                <div class="col-sm-12 mt-3">

                                                                    <div class="d-flex justify-content-between mt-4">
                                                                        <h5 class="d-inline">Gallery Image</h5>
                                                                        <a href="javascript:void(0)"
                                                                            class="btn btn-sm btn-primary add-gallery-image"
                                                                            data-gallery-key="{{ $galleryKey }}">
                                                                            <i class="fa fa-plus"></i>
                                                                            Add
                                                                        </a>
                                                                    </div>

                                                                    <div class="gallery-image-container">

                                                                        @forelse ($content['images'] as $imageKey => $image)
                                                                            <div class="row align-items-center mt-2">

                                                                                <div
                                                                                    class="col-sm-12 col-md-5 img-upload-container">
                                                                                    <label
                                                                                        class="form-control-label">Upload
                                                                                        Image:</label>
                                                                                    <div class="dropify-wrapper"
                                                                                        style="border: none">
                                                                                        <div class="dropify-loader">
                                                                                        </div>
                                                                                        <div
                                                                                            class="dropify-errors-container">
                                                                                            <ul></ul>
                                                                                        </div>
                                                                                        <input type="file"
                                                                                            class="dropify"
                                                                                            name="galleries[{{ $galleryKey }}][gallery_image][{{ $imageKey }}]"
                                                                                            accept="image/*">
                                                                                        <input type="hidden"
                                                                                            name="galleries[{{ $galleryKey }}][old_gallery_image][{{ $imageKey }}]"
                                                                                            value="{{ $image }}">
                                                                                        <button type="button"
                                                                                            class="dropify-clear">Remove</button>
                                                                                        <div class="dropify-preview">
                                                                                            <span
                                                                                                class="dropify-render"></span>
                                                                                            <div class="dropify-infos">
                                                                                                <div
                                                                                                    class="dropify-infos-inner">
                                                                                                    <p
                                                                                                        class="dropify-filename">
                                                                                                        <span
                                                                                                            class="file-icon"></span>
                                                                                                        <span
                                                                                                            class="dropify-filename-inner"></span>
                                                                                                    </p>
                                                                                                    <p
                                                                                                        class="dropify-infos-message">
                                                                                                        Drag
                                                                                                        and drop or
                                                                                                        click to
                                                                                                        replace</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="img-preview-container col-sm-12 col-md-6 d-flex justify-content-center align-items-center">
                                                                                    <div class="px-3 mt-3">
                                                                                        <img src="{{ $image ?? asset('frontend/images/No-image.jpg') }}"
                                                                                            alt=""
                                                                                            class="img-fluid"
                                                                                            style="border-radius: 10px; max-height: 200px !important;">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-1">
                                                                                    <a href="javascript:void(0)"
                                                                                        class="remove-gallery-image btn btn-danger btn-sm m-0 ml-2">
                                                                                        <i class="fas fa-minus-circle">
                                                                                        </i>
                                                                                    </a>
                                                                                </div>

                                                                            </div>
                                                                        @empty
                                                                            <div class="row align-items-center mt-2">

                                                                                <div
                                                                                    class="col-sm-12 col-md-5 mt-3 img-upload-container">
                                                                                    <label
                                                                                        class="form-control-label">Upload
                                                                                        Image:</label>
                                                                                    <div class="dropify-wrapper"
                                                                                        style="border: none">
                                                                                        <div class="dropify-loader">
                                                                                        </div>
                                                                                        <div
                                                                                            class="dropify-errors-container">
                                                                                            <ul></ul>
                                                                                        </div>
                                                                                        <input type="file"
                                                                                            class="dropify"
                                                                                            name="galleries[{{ $galleryKey }}][gallery_image][{{ $random }}]"
                                                                                            accept="image/*">
                                                                                        <button type="button"
                                                                                            class="dropify-clear">Remove</button>
                                                                                        <div class="dropify-preview">
                                                                                            <span
                                                                                                class="dropify-render"></span>
                                                                                            <div class="dropify-infos">
                                                                                                <div
                                                                                                    class="dropify-infos-inner">
                                                                                                    <p
                                                                                                        class="dropify-filename">
                                                                                                        <span
                                                                                                            class="file-icon"></span>
                                                                                                        <span
                                                                                                            class="dropify-filename-inner"></span>
                                                                                                    </p>
                                                                                                    <p
                                                                                                        class="dropify-infos-message">
                                                                                                        Drag
                                                                                                        and drop or
                                                                                                        click to
                                                                                                        replace</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="img-preview-container col-sm-12 col-md-6 d-flex justify-content-center align-items-center">
                                                                                    <div class="px-3 mt-3">
                                                                                        <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                                                                            alt=""
                                                                                            class="img-fluid"
                                                                                            style="border-radius: 10px; max-height: 200px !important;">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-1">
                                                                                    <a href="javascript:void(0)"
                                                                                        class="remove-gallery-image btn btn-danger btn-sm m-0 ml-2">
                                                                                        <i class="fas fa-minus-circle">
                                                                                        </i>
                                                                                    </a>
                                                                                </div>

                                                                            </div>
                                                                        @endforelse

                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="col-sm-12 mb-3" style="padding-right: 0;">
                                                        @php
                                                            $random = rand();
                                                        @endphp

                                                        <div class="card-header" data-toggle="collapse"
                                                            data-target="#activity_single_collapse_{{ $random }}">
                                                            <div class="d-flex justify-content-between">
                                                                <h5 class="card-title mb-0 py-2 gallery-title">
                                                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                                                    Gallery
                                                                </h5>

                                                                {{-- <a href="javascript:void(0)"
                                                                    class="btn btn-sm btn-danger remove-gallery">
                                                                    <i class="fa fa-minus"></i>
                                                                </a> --}}
                                                            </div>
                                                        </div>

                                                        <div class="collapse"
                                                            id="activity_single_collapse_{{ $random }}">
                                                            <div class="card-body">
                                                                <div class="col-sm-12 mt-3">


                                                                    <div class="d-flex justify-content-between mt-4">
                                                                        <h5 class="d-inline">Gallery Image</h5>
                                                                        <a href="javascript:void(0)"
                                                                            class="btn btn-sm btn-primary add-gallery-image"
                                                                            data-gallery-key="{{ $random }}">
                                                                            <i class="fa fa-plus"></i>
                                                                            Add
                                                                        </a>
                                                                    </div>

                                                                    <div class="gallery-image-container">

                                                                        <div class="row align-items-center mt-2">

                                                                            <div
                                                                                class="col-sm-12 col-md-5 img-upload-container">
                                                                                <label
                                                                                    class="form-control-label">Upload
                                                                                    Image:</label>
                                                                                <div class="dropify-wrapper"
                                                                                    style="border: none">
                                                                                    <div class="dropify-loader"></div>
                                                                                    <div
                                                                                        class="dropify-errors-container">
                                                                                        <ul></ul>
                                                                                    </div>
                                                                                    <input type="file"
                                                                                        class="dropify"
                                                                                        name="galleries[{{ $random }}][gallery_image][{{ $random }}]"
                                                                                        accept="image/*">
                                                                                    <button type="button"
                                                                                        class="dropify-clear">Remove</button>
                                                                                    <div class="dropify-preview">
                                                                                        <span
                                                                                            class="dropify-render"></span>
                                                                                        <div class="dropify-infos">
                                                                                            <div
                                                                                                class="dropify-infos-inner">
                                                                                                <p
                                                                                                    class="dropify-filename">
                                                                                                    <span
                                                                                                        class="file-icon"></span>
                                                                                                    <span
                                                                                                        class="dropify-filename-inner"></span>
                                                                                                </p>
                                                                                                <p
                                                                                                    class="dropify-infos-message">
                                                                                                    Drag
                                                                                                    and drop or click to
                                                                                                    replace</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div
                                                                                class="img-preview-container col-sm-12 col-md-6 d-flex justify-content-center align-items-center">
                                                                                <div class="px-3 mt-3">
                                                                                    <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                                                                        alt=""
                                                                                        class="img-fluid"
                                                                                        style="border-radius: 10px; max-height: 200px !important;">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-1">
                                                                                <a href="javascript:void(0)"
                                                                                    class="remove-gallery-image btn btn-danger btn-sm m-0 ml-2">
                                                                                    <i class="fas fa-minus-circle">
                                                                                    </i>
                                                                                </a>
                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforelse

                                            </div>
                                        </div>


                                        <hr>


                                        @php
                                            $contents = [];
                                            if ($university && $university->video) {
                                                $decodedContents = json_decode($university->video, true);
                                                $contents = is_array($decodedContents) ? $decodedContents : []; // Ensure $contents is an array
                                            }
                                        @endphp



                                        <div class="row">

                                            <div class="col-sm-12">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="d-inline">Videos</h5>
                                                    <div class="d-flex">

                                                        {{-- <button type="submit" class="btn blue-btn btn-primary"
                                                            style="margin-right: 8px">Save</button> --}}

                                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary"
                                                            id="add-photo-gallery-image">
                                                            <i class="fa fa-plus"></i>
                                                            Add
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="photo-gallery-container">
                                                    @forelse ($contents as $key => $content)
                                                        <div class="row align-items-center video-container mt-2 mb-4"
                                                            style="{{ !$loop->last ? 'border-bottom: 3px solid #ddd;' : '' }}">
                                                            <div
                                                                class="col-12 row align-items-center justify-content-between">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Video Type <span
                                                                                class="text-danger">*</span></label>
                                                                        <select name="video_type[{{ $key }}]"
                                                                            class="form-control form-control-lg video-type-selector"
                                                                            onchange="toggleVideoSections(this)">
                                                                            <option value="">Choose an option
                                                                            </option>
                                                                            <option value="youtube"
                                                                                {{ $content['type'] == 'youtube' ? 'selected' : '' }}>
                                                                                Youtube Embed Code
                                                                            </option>
                                                                            <option value="upload"
                                                                                {{ $content['type'] == 'upload' ? 'selected' : '' }}>
                                                                                Video Upload
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-1">
                                                                    <a href="javascript:void(0)"
                                                                        class="remove-photo-gallery-image btn btn-danger btn-sm m-0 ml-2">
                                                                        <i class="fas fa-minus-circle"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            {{--
                                                            <div class="col-12 youtube-section">
                                                                <div class="form-group">
                                                                    <label for="">Video Title<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text"
                                                                        name="video_title[{{ $key }}]"
                                                                        class="form-control form-control-lg"
                                                                        placeholder="Enter Video Title"
                                                                        value="{{ $content['title'] ?? '' }}">
                                                                </div>
                                                            </div> --}}

                                                            <!-- Youtube Section -->
                                                            <div
                                                                class="col-12 youtube-section {{ $content['type'] == 'youtube' ? '' : 'd-none' }}">
                                                                <div class="form-group">
                                                                    <label for="">Youtube Embed Code <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text"
                                                                        name="youtube_embed_code[{{ $key }}]"
                                                                        class="form-control form-control-lg"
                                                                        placeholder="Enter Youtube Embed Code"
                                                                        value="{{ $content['type'] == 'youtube' ? $content['url'] : '' }}">
                                                                </div>
                                                            </div>

                                                            <!-- Upload Section -->
                                                            <div
                                                                class="col-12 row upload-section {{ $content['type'] == 'upload' ? '' : 'd-none' }}">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="upload_video">Upload Video</label>
                                                                        <input type="file"
                                                                            name="video_upload[{{ $key }}]"
                                                                            class="form-control video-upload"
                                                                            accept="video/*">
                                                                        <input type="hidden"
                                                                            name="old_photo_gallery_image[{{ $key }}]"
                                                                            value="{{ $content['type'] == 'upload' ? $content['url'] : '' }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div
                                                                        class="form-group video-preview-container {{ $content['type'] != 'upload' ? 'd-none' : '' }}">
                                                                        <label>Video Preview:</label>
                                                                        <video class="video-preview"
                                                                            style="width: 100%; max-height: 200px;"
                                                                            controls>
                                                                            <source
                                                                                src="{{ $content['type'] == 'upload' ? $content['url'] : '' }}"
                                                                                type="video/mp4">
                                                                            Your browser does not support the video tag.
                                                                        </video>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="row align-items-center video-container mt-2 mb-4"
                                                            style="border-bottom: 3px solid #ddd">
                                                            @php
                                                                $random = rand(10000, 99999);
                                                            @endphp

                                                            <div
                                                                class="col-12 row align-items-center justify-content-between">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Video Type <span
                                                                                class="text-danger">*</span></label>
                                                                        <select name="video_type[{{ $random }}]"
                                                                            class="form-control form-control-lg video-type-selector">
                                                                            <option value="">Choose an option
                                                                            </option>
                                                                            <option value="youtube">Youtube Embed Code
                                                                            </option>
                                                                            <option value="upload">Video Upload
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-1">
                                                                    <a href="javascript:void(0)"
                                                                        class="remove-photo-gallery-image btn btn-danger btn-sm m-0 ml-2">
                                                                        <i class="fas fa-minus-circle"></i>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                            {{-- <!-- Video Title Section -->
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="">Video Title<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text"
                                                                        name="video_title[{{ $random }}]"
                                                                        class="form-control form-control-lg"
                                                                        placeholder="Enter Video Title">
                                                                </div>
                                                            </div> --}}

                                                            <!-- Youtube Section -->
                                                            <div class="col-12 youtube-section d-none">
                                                                <div class="form-group">
                                                                    <label for="">Youtube Embed Code <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text"
                                                                        name="youtube_embed_code[{{ $random }}]"
                                                                        class="form-control form-control-lg"
                                                                        placeholder="Enter Youtube Embed Code">
                                                                </div>
                                                            </div>

                                                            <!-- Upload Section -->
                                                            <div class="col-12 row upload-section d-none">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="upload_video">Upload Video</label>
                                                                        <input type="file"
                                                                            name="video_upload[{{ $random }}]"
                                                                            class="form-control video-upload"
                                                                            accept="video/*">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div
                                                                        class="form-group video-preview-container d-none">
                                                                        <label>Video Preview:</label>
                                                                        <video class="video-preview"
                                                                            style="width: 100%; max-height: 200px;"
                                                                            controls>
                                                                            <source src="" type="video/mp4">
                                                                            Your browser does not support the video tag.
                                                                        </video>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforelse

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

    <script src="{{ asset('backend/assets/js/dropify.js') }}"></script>

    <script>
        $(document).on('change', `.dropify`, function() {
            var fileInput = $(this)[0];
            var uploadSelector = $(this);

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(uploadSelector).closest('.img-upload-container')
                        .siblings('.img-preview-container')
                        .find('img')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        });

        /* add gallery image */
        $(document).on('click', '.add-gallery-image', function() {
            var randomNumber = Math.floor(10000 + Math.random() * 90000);
            let activityKey = $(this).data('gallery-key');

            var myvar = `
                <div class="row align-items-center mt-2">

                    <div
                        class="col-sm-12 col-md-5 mt-3 img-upload-container">
                        <label class="form-control-label">Add
                            Image:</label>
                        <div class="dropify-wrapper"
                            style="border: none">
                            <div class="dropify-loader"></div>
                            <div class="dropify-errors-container">
                                <ul></ul>
                            </div>
                            <input type="file" class="dropify"
                                name="galleries[${activityKey}][gallery_image][${randomNumber}]"
                                accept="image/*">
                            <button type="button"
                                class="dropify-clear">Remove</button>
                            <div class="dropify-preview">
                                <span class="dropify-render"></span>
                                <div class="dropify-infos">
                                    <div class="dropify-infos-inner">
                                        <p class="dropify-filename">
                                            <span
                                                class="file-icon"></span>
                                            <span
                                                class="dropify-filename-inner"></span>
                                        </p>
                                        <p
                                            class="dropify-infos-message">
                                            Drag
                                            and drop or click to
                                            replace</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="img-preview-container col-sm-12 col-md-6 d-flex justify-content-center align-items-center">
                        <div class="px-3 mt-3">
                            <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                alt="" class="img-fluid"
                                style="border-radius: 10px; max-height: 200px !important;">
                        </div>
                    </div>

                    <div class="col-1">
                        <a href="javascript:void(0)"
                            class="remove-gallery-image btn btn-danger btn-sm m-0 ml-2">
                            <i class="fas fa-minus-circle"> </i>
                        </a>
                    </div>

                </div>
            `;
            $(this).parent().siblings('.gallery-image-container').prepend(myvar);
            $(`.dropify`).dropify();
        });

        $(document).on('click', '.remove-gallery-image', function() {
            $(this).parent().parent().remove();
        });

        /* add gallery */
        $(document).on('click', '#add-gallery', function() {
            var randomNumber = Math.floor(10000 + Math.random() * 90000);

            var myvar = `
                <div class="col-sm-12 mb-3" style="padding-right: 0;">
                    <div class="card-header" data-toggle="collapse"
                        data-target="#activity_single_collapse_${randomNumber}">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title mb-0 py-2 gallery-title">
                                <i class="fa fa-camera" aria-hidden="true"></i>&nbsp;
                                Gallery
                            </h5>

                            <a href="javascript:void(0)"
                                class="btn btn-sm btn-danger remove-gallery">
                                <i class="fa fa-minus"></i>
                            </a>
                        </div>
                    </div>

                    <div class="collapse"
                        id="activity_single_collapse_${randomNumber}">
                        <div class="card-body">
                            <div class="col-sm-12 mt-3">

                                <div class="d-flex justify-content-between mt-4">
                                    <h5 class="d-inline">Gallery Image</h5>
                                    <a href="javascript:void(0)"
                                        class="btn btn-sm btn-primary add-gallery-image"
                                        data-gallery-key="${randomNumber}">
                                        <i class="fa fa-plus"></i>
                                        Add
                                    </a>
                                </div>

                                <div class="gallery-image-container">

                                    <div class="row align-items-center mt-2">

                                        <div
                                            class="col-sm-12 col-md-5 img-upload-container">
                                            <label class="form-control-label">Upload
                                                Image:</label>
                                            <div class="dropify-wrapper"
                                                style="border: none">
                                                <div class="dropify-loader"></div>
                                                <div class="dropify-errors-container">
                                                    <ul></ul>
                                                </div>
                                                <input type="file" class="dropify"
                                                    name="galleries[${randomNumber}][gallery_image][${randomNumber}]"
                                                    accept="image/*">
                                                <button type="button"
                                                    class="dropify-clear">Remove</button>
                                                <div class="dropify-preview">
                                                    <span class="dropify-render"></span>
                                                    <div class="dropify-infos">
                                                        <div
                                                            class="dropify-infos-inner">
                                                            <p class="dropify-filename">
                                                                <span
                                                                    class="file-icon"></span>
                                                                <span
                                                                    class="dropify-filename-inner"></span>
                                                            </p>
                                                            <p
                                                                class="dropify-infos-message">
                                                                Drag
                                                                and drop or click to
                                                                replace</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="img-preview-container col-sm-12 col-md-6 d-flex justify-content-center align-items-center">
                                            <div class="px-3 mt-3">
                                                <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                                    alt="" class="img-fluid"
                                                    style="border-radius: 10px; max-height: 200px !important;">
                                            </div>
                                        </div>

                                        <div class="col-1">
                                            <a href="javascript:void(0)"
                                                class="remove-gallery-image btn btn-danger btn-sm m-0 ml-2">
                                                <i class="fas fa-minus-circle">
                                                </i>
                                            </a>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            $('#galleries-container').prepend(myvar);
            $(`.dropify`).dropify();
        });

        $(document).on('click', '.remove-gallery', function() {
            $(this).parent().parent().parent().remove();
        });
    </script>

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

    <script>
        $(document).on('change', '.video-type-selector', function() {
            var $parent = $(this).closest('.video-container');
            var selectedType = $(this).val();

            if (selectedType === 'youtube') {
                $parent.find('.youtube-section').removeClass('d-none');
                $parent.find('.upload-section').addClass('d-none');
            } else if (selectedType === 'upload') {
                $parent.find('.upload-section').removeClass('d-none');
                $parent.find('.youtube-section').addClass('d-none');
            } else {
                $parent.find('.youtube-section').addClass('d-none');
                $parent.find('.upload-section').addClass('d-none');
            }
        });

        $(document).on('change', '.video-upload', function(e) {
            var file = e.target.files[0];
            var $parent = $(this).closest('.upload-section');

            if (file && file.type.startsWith('video/')) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var videoSrc = e.target.result;
                    $parent.find('.video-preview-container').removeClass('d-none');
                    $parent.find('.video-preview source').attr('src', videoSrc);
                    $parent.find('.video-preview')[0].load();
                };

                reader.readAsDataURL(file);
            } else {
                $parent.find('.video-preview-container').addClass('d-none');
            }
        });

        $('.video-type-selector').trigger('change');
    </script>

    <script>
        /* add photo gallery image */
        $('#add-photo-gallery-image').on('click', function() {
            var randomNumber = Math.floor(10000 + Math.random() * 90000);

            var myvar = `
                <div class="row align-items-center video-container mt-2 mb-4" style="border-bottom: 3px solid #ddd">
                    <div class="col-12 row align-items-center justify-content-between">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Video Type <span class="text-danger">*</span></label>
                                <select name="video_type[${randomNumber}]"
                                    class="form-control form-control-lg video-type-selector"
                                    required>
                                    <option value="">Choose an option</option>
                                    <option value="youtube">Youtube Embed Code</option>
                                    <option value="upload">Video Upload</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-1">
                            <a href="javascript:void(0)"
                                class="remove-photo-gallery-image btn btn-danger btn-sm m-0 ml-2">
                                <i class="fas fa-minus-circle"></i>
                            </a>
                        </div>
                    </div>


                    <!-- Youtube Section -->
                    <div class="col-12 youtube-section d-none">
                        <div class="form-group">
                            <label for="">Youtube Embed Code <span class="text-danger">*</span></label>
                            <input type="text" name="youtube_embed_code[${randomNumber}]"
                                class="form-control form-control-lg"
                                placeholder="Enter Youtube Embed Code">
                        </div>
                    </div>

                    <!-- Upload Section -->
                    <div class="col-12 row upload-section d-none">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="upload_video">Upload Video</label>
                                <input type="file" name="video_upload[${randomNumber}]"
                                    class="form-control video-upload" accept="video/*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group video-preview-container d-none">
                                <label>Video Preview:</label>
                                <video class="video-preview" style="width: 100%; max-height: 200px;" controls>
                                    <source src="" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            $('.photo-gallery-container').prepend(myvar);
            $(`.dropify`).dropify();
        });

        $(document).on('click', '.remove-photo-gallery-image', function() {
            $(this).closest('.video-container').remove();
        });
    </script>

    <script>
        $(document).ready(function() {
            function fetchCities(country_id, selectedCity = null) {
                $('#city').html('<option value="">Loading...</option>');

                if (country_id) {
                    $.ajax({
                        url: `/get-cities/${country_id}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            let options = '<option value="">Select City</option>';
                            $.each(data, function(key, city) {
                                let selected = (selectedCity && city.id == selectedCity) ?
                                    'selected' : '';
                                options +=
                                    `<option value="${city.id}" ${selected}>${city.name}</option>`;
                            });
                            $('#city').html(options);
                        }
                    });
                } else {
                    $('#city').html('<option value="">Select City</option>'); // Reset dropdown
                }
            }

            let selectedCountry = $('#country').val();
            let selectedCity = '{{ $university->city_id ?? '' }}'; // Pre-select city if available

            if (selectedCountry) {
                fetchCities(selectedCountry, selectedCity);
            }

            $('#country').change(function() {
                let country_id = $(this).val();
                fetchCities(country_id);
            });
        });
    </script>

</body>

</html>
