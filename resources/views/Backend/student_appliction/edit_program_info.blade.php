<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Student Application Program Edit</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">



    <style>
        span.select2-container {
            width: 100% !important;
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
                            Student Application Program Info Edit
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.student_appliction_list') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All Application</a>
                        </nav>
                    </div>

                    <div class="row">
                        {{-- <div class="my-2 col-md-2">
                            @include('Backend.student_appliction.theme_options_tabs_nav')
                        </div> --}}

                        <div class="my-2 col-md-12">
                            <div class="tab-content tab-content-vertical bg-white rounded">
                                <div class="tab-pane fade show active" id="program-info-tab-content" role="tabpanel"
                                    aria-labelledby="home-tab-vertical">

                                    <form novalidate="" method="post"
                                        action="{{ route('admin.student_appliction_program_update', $s_application->id) }}"
                                        data-validate="parsley" id="DataEntry_formId" enctype="multipart/form-data">
                                        @csrf

                                        <h5 class="multisteps-form__title">Contact Information</h5>

                                        <div class="multisteps-form__content">
                                            <div class="form-row">

                                                <div class="col-12  col-md-4">
                                                    <div class=" form-label-group mt-2">

                                                        <input type="email" id="email" name="email"
                                                            data-name="email" required="" placeholder="Email"
                                                            class="form-control" maxlength=""
                                                            value="{{ $s_application->email }}">
                                                        <label for="email"
                                                            class="form-control-placeholder">Email</label>

                                                        <div class="invalid-feedback">
                                                            This field is required.
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-12  col-md-4">
                                                    <div class=" form-label-group mt-2">
                                                        <input type="tel" id="" name="phone"
                                                            data-name="phone" required=""
                                                            placeholder="Enter Phone Number"
                                                            class="form-control"
                                                            value="{{ $s_application->phone }}">
                                                        <label for="phone" class="form-control-placeholder">
                                                            Phone</label>

                                                        {{-- <span class="text-danger" id="output"></span> --}}
                                                        <div class="invalid-feedback">Please provide a valid
                                                            contact
                                                            number.
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-12  col-md-4">
                                                    <div class=" form-label-group mt-2">

                                                        <select name="country_of_residence" class="form-control"
                                                            id="">
                                                            <option value="Select country">Select Country
                                                            </option>


                                                            @foreach ($countries as $country)
                                                                <option
                                                                    {{ $s_application->country_of_residence == $country->id ? 'selected' : '' }}
                                                                    value="{{ $country->id }}">
                                                                    {{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <label for="contact_id" class="form-control-placeholder">
                                                            Country Of Residence
                                                        </label>

                                                    </div>
                                                </div>

                                                <div class="col-12  col-md-4">
                                                    <div class=" form-label-group mt-2">

                                                        <input type="text" id="address" name="address"
                                                            data-name="address" required="" placeholder="address"
                                                            class="form-control" maxlength=""
                                                            value="{{ $s_application->address }}">
                                                        <input type="hidden" name="program_name"
                                                            value="{{ $s_application->program_name }}">
                                                        <label for="address"
                                                            class="form-control-placeholder">Address</label>

                                                        <div class="invalid-feedback">
                                                            This field is required.
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-12  col-md-4">
                                                    <div class=" form-label-group mt-2">

                                                        <input type="text" id="postal_code" name="postal_code"
                                                            data-name="postal_code" required=""
                                                            placeholder="postal_code" class="form-control"
                                                            maxlength="" value="{{ $s_application->postal_code }}">
                                                        <label for="postal_code" class="form-control-placeholder">Postal
                                                            code</label>

                                                        <div class="invalid-feedback">
                                                            This field is required.
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <h5 class="multisteps-form__title">Personal Information</h5>
                                        <div class="multisteps-form__content">
                                            <div class="form-row ">
                                                <div class="col-12  col-md-4">
                                                    <div class=" form-label-group mt-2">

                                                        <input type="text" id="full_name" name="full_name"
                                                            data-name="full_name" required=""
                                                            placeholder="full name (Given Name)" class="form-control"
                                                            maxlength="" value="{{ $s_application->full_name }}">
                                                        <label for="full_name" class="form-control-placeholder">
                                                            Full name (Given Name)</label>

                                                        <div class="invalid-feedback">
                                                            This field is required.
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-12  col-md-4">
                                                    <div class=" form-label-group mt-2">

                                                        <input type="text" id="forenames" name="forenames"
                                                            data-name="forenames" placeholder="ForeNames"
                                                            class="form-control" maxlength=""
                                                            value="{{ $s_application->forenames }}">
                                                        <label for="forenames" class="form-control-placeholder">
                                                            ForeNames</label>

                                                    </div>
                                                </div>

                                                <div class="col-12  col-md-4">
                                                    <div class=" form-label-group mt-2">

                                                        <input type="text" id="surname" name="surname"
                                                            data-name="surname" required=""
                                                            placeholder="Surname (Family name)" class="form-control"
                                                            maxlength="" value="{{ $s_application->surname }}">
                                                        <label for="surname" class="form-control-placeholder">
                                                            Surname (Family name)</label>

                                                        <div class="invalid-feedback">
                                                            This field is required.
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-12  col-md-4">
                                                    <div class=" form-label-group mt-2">

                                                        <input type="text" id="nationality" name="nationality"
                                                            data-name="nationality" placeholder="nationality"
                                                            class="form-control" maxlength=""
                                                            value="{{ $s_application->nationality }}">
                                                        <label for="nationality" class="form-control-placeholder">
                                                            Nationality</label>

                                                    </div>
                                                </div>

                                                <div class="col-12  col-md-4">
                                                    <div class=" form-label-group mt-2">

                                                        <input type="date" id="date_of_birth" name="date_of_birth"
                                                            data-name="date_of_birth" date-field=""
                                                            data-date="Y-m-d" required=""
                                                            placeholder="Date of birth"
                                                            class="form-control flatpickr-input" maxlength=""
                                                            value="{{ $s_application->date_of_birth }}">
                                                        <label for="date_of_birth" class="form-control-placeholder">
                                                            Date of birth</label>

                                                        <div class="invalid-feedback">
                                                            This field is required.
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-12  col-md-4">
                                                    <div class=" form-label-group mt-2">

                                                        <input type="text" id="place_of_birth"
                                                            name="place_of_birth" data-name="place_of_birth"
                                                            placeholder="Place of birth" class="form-control"
                                                            maxlength=""
                                                            value="{{ $s_application->place_of_birth ?? '' }}">
                                                        <label for="place_of_birth" class="form-control-placeholder">
                                                            Place of birth</label>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>



                                        <h5 class="multisteps-form__title">Passport Information</h5>

                                        <div class="multisteps-form__content">
                                            <div class="form-row ">

                                                <div class="col-12  col-md-4">
                                                    <div class=" form-label-group mt-2">

                                                        <input type="text" id="passport_no" name="passport_no"
                                                            data-name="passport_no" placeholder="Passport number"
                                                            class="form-control" maxlength=""
                                                            value="{{ $s_application->passport_no ?? '' }}">
                                                        <label for="passport_no" class="form-control-placeholder">
                                                            Passport number</label>

                                                    </div>
                                                </div>

                                                <div class="col-12  col-md-4">
                                                    <div class=" form-label-group mt-2">

                                                        <input type="date" id="passport_issue_date"
                                                            name="passport_issue_date" data-name="passport_issue_date"
                                                            date-field="" data-date="Y-m-d"
                                                            placeholder="Passport issue date"
                                                            class="form-control flatpickr-input" maxlength=""
                                                            value="{{ $s_application->passport_issue_date }}">
                                                        <label for="passport_issue_date"
                                                            class="form-control-placeholder">
                                                            Passport issue date</label>

                                                    </div>
                                                </div>

                                                <div class="col-12  col-md-4">
                                                    <div class=" form-label-group mt-2">

                                                        <input type="date" id="passport_expiration_date"
                                                            name="passport_expiration_date"
                                                            data-name="passport_expiration_date" date-field=""
                                                            data-date="Y-m-d" placeholder="Passport expiry date"
                                                            class="form-control flatpickr-input" maxlength=""
                                                            value="{{ $s_application->passport_expiration_date }}">
                                                        <label for="passport_expiration_date"
                                                            class="form-control-placeholder">
                                                            Passport expiry date</label>

                                                    </div>
                                                </div>

                                                <div class="col-12  col-md-4">
                                                    <div class=" form-label-group mt-2">

                                                        <input type="text" id="issuing_authority"
                                                            name="issuing_authority" data-name="issuing authority"
                                                            date-field="" data-date="Y-m-d"
                                                            placeholder="Issuing Authority"
                                                            class="form-control flatpickr-input" maxlength=""
                                                            value="{{ $s_application->issuing_authority }}">
                                                        <label for="issuing authority"
                                                            class="form-control-placeholder">
                                                            Issuing Authority</label>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <h5 class="multisteps-form__title">Emergency Contact Details</h5>
                                        <div class="form-row ">
                                            <div class="col-12  col-md-4">
                                                <div class=" form-label-group mt-2">

                                                    <input type="text" id="emergency_name" name="emergency_name"
                                                        data-name="emergency_name" required=""
                                                        placeholder="emergency_name" class="form-control"
                                                        maxlength="" value="{{ $s_application->emergency_name }}">
                                                    <label for="emergency_name"
                                                        class="form-control-placeholder">Emergency name</label>

                                                    <div class="invalid-feedback">
                                                        This field is required.
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-12  col-md-4">
                                                <div class=" form-label-group mt-2">
                                                    <input type="tel" id="phone" name="emergency_phone"
                                                        data-name="phone" required=""
                                                        placeholder="Enter Phone Number"
                                                        class="form-control"
                                                        value="{{ $s_application->emergency_phone }}">
                                                    <label for="phone" class="form-control-placeholder">
                                                        Phone</label>

                                                    {{-- <span class="text-danger" id="output"></span> --}}
                                                    <div class="invalid-feedback">Please provide a valid
                                                        contact
                                                        number.
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-12  col-md-4">
                                                <div class=" form-label-group mt-2">

                                                    <input type="text" id="relationship" name="relationship"
                                                        data-name="relationship" required=""
                                                        placeholder="relationship" class="form-control"
                                                        maxlength="" value="{{ $s_application->relationship }}">
                                                    <label for="relationship"
                                                        class="form-control-placeholder">Relationship</label>

                                                    <div class="invalid-feedback">
                                                        This field is required.
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="col-12  col-md-4">
                                                <div class=" form-label-group mt-2">

                                                    <select name="relation_country" class="form-control"
                                                        id="relation_country">
                                                        <option value="Select country">Select Country
                                                        </option>

                                                        @foreach ($countries as $country)
                                                            <option
                                                                {{ $s_application->relation_country == $country->id ? 'selected' : '' }}
                                                                value="{{ $country->id }}">
                                                                {{ $country->name }}</option>
                                                        @endforeach

                                                    </select>
                                                    <label for="relationship"
                                                        class="form-control-placeholder">Country</label>

                                                    <div class="invalid-feedback">
                                                        This field is required.
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <h5 class="multisteps-form__title">Higher Education Details</h5>
                                        <div class="form-row ">
                                            <div class="col-12  col-md-4">
                                                <div class="form-label-group mt-2">
                                                    <input type="text" id="year_of_completion"
                                                        name="higher_year_of_completion"
                                                        data-name="year_of_completion" required
                                                        placeholder="Year of Completion" class="form-control"
                                                        maxlength=""
                                                        value="{{ $s_application->higher_year_of_completion }}">
                                                    <label for="year_of_completion"
                                                        class="form-control-placeholder">Year of
                                                        Completion</label>
                                                    <div class="invalid-feedback">
                                                        This field is required.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12  col-md-4">
                                                <div class="form-label-group mt-2">
                                                    <input type="text" id="degree_name" name="higher_degree_name"
                                                        data-name="degree_name" required placeholder="Degree Name"
                                                        class="form-control" maxlength=""
                                                        value="{{ $s_application->higher_degree_name }}">
                                                    <label for="degree_name" class="form-control-placeholder">Degree
                                                        Name</label>
                                                    <div class="invalid-feedback">
                                                        This field is required.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12  col-md-4">
                                                <div class="form-label-group mt-2">
                                                    <input type="text" id="student_number"
                                                        name="higher_student_number" data-name="student_number"
                                                        required placeholder="Student Number" class="form-control"
                                                        maxlength=""
                                                        value="{{ $s_application->higher_student_number }}">
                                                    <label for="student_number"
                                                        class="form-control-placeholder">Student Number</label>
                                                    <div class="invalid-feedback">
                                                        This field is required.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12  col-md-4">
                                                <div class="form-label-group mt-2">
                                                    <input type="text" id="major_subject"
                                                        name="higher_major_subject" data-name="major_subject" required
                                                        placeholder="Major Subject" class="form-control"
                                                        maxlength=""
                                                        value="{{ $s_application->higher_major_subject }}">
                                                    <label for="major_subject" class="form-control-placeholder">Major
                                                        Subject</label>
                                                    <div class="invalid-feedback">
                                                        This field is required.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12  col-md-4">
                                                <div class="form-label-group mt-2">
                                                    <input type="text" id="cgpa" name="higher_cgpa"
                                                        data-name="cgpa" required
                                                        placeholder="Cumulative Grade Point Average / Percentage"
                                                        class="form-control" maxlength=""
                                                        value="{{ $s_application->higher_cgpa }}">
                                                    <label for="cgpa" class="form-control-placeholder">Cumulative
                                                        Grade Point
                                                        Average / Percentage</label>
                                                    <div class="invalid-feedback">
                                                        This field is required.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12  col-md-4">
                                                <div class="form-label-group mt-2">
                                                    <input type="date" id="certificate_issue_date"
                                                        name="higher_certificate_issue_date"
                                                        data-name="certificate_issue_date" required
                                                        class="form-control"
                                                        value="{{ $s_application->higher_certificate_issue_date }}">
                                                    <label for="certificate_issue_date"
                                                        class="form-control-placeholder">Certificate Issue
                                                        Date</label>
                                                    <div class="invalid-feedback">
                                                        This field is required.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12  col-md-4">
                                                <div class="form-label-group mt-2">
                                                    <input type="text" id="school_university"
                                                        name="higher_school_university" data-name="school_university"
                                                        required placeholder="School/University" class="form-control"
                                                        maxlength=""
                                                        value="{{ $s_application->higher_school_university }}">
                                                    <label for="school_university"
                                                        class="form-control-placeholder">School/University</label>
                                                    <div class="invalid-feedback">
                                                        This field is required.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12  col-md-4">
                                                <div class="form-label-group mt-2">
                                                    <input type="text" id="country_of_completion"
                                                        name="higher_country_of_completion"
                                                        data-name="country_of_completion" required
                                                        placeholder="Country of Completion" class="form-control"
                                                        maxlength=""
                                                        value="{{ $s_application->higher_country_of_completion }}">
                                                    <label for="country_of_completion"
                                                        class="form-control-placeholder">Country of
                                                        Completion</label>
                                                    <div class="invalid-feedback">
                                                        This field is required.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12  col-md-4">
                                                <div class="form-label-group mt-2">
                                                    <input type="text" id="institution_address"
                                                        name="higher_institution_address"
                                                        data-name="institution_address" required
                                                        placeholder="Street Address of Institution"
                                                        class="form-control" maxlength=""
                                                        value="{{ $s_application->higher_institution_address }}">
                                                    <label for="institution_address"
                                                        class="form-control-placeholder">Street Address of
                                                        Institution</label>
                                                    <div class="invalid-feedback">
                                                        This field is required.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12  col-md-4">
                                                <div class="form-label-group mt-2">
                                                    <input type="text" id="institution_email"
                                                        name="higher_institution_email" data-name="institution_email"
                                                        required placeholder="Street email of Institution"
                                                        class="form-control" maxlength=""
                                                        value="{{ $s_application->higher_institution_email }}">
                                                    <label for="institution_email"
                                                        class="form-control-placeholder">Email of
                                                        Institution</label>
                                                    <div class="invalid-feedback">
                                                        This field is required.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12  col-md-4">
                                                <div class="form-label-group mt-2">
                                                    <input type="text" id="institution_website"
                                                        name="higher_institution_website"
                                                        data-name="institution_website" required
                                                        placeholder="Street website of Institution"
                                                        class="form-control" maxlength=""
                                                        value="{{ $s_application->higher_institution_website }}">
                                                    <label for="institution_website"
                                                        class="form-control-placeholder">Website of
                                                        Institution</label>
                                                    <div class="invalid-feedback">
                                                        This field is required.
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="d-flex justify-content-between w-100">
                                            <h5 class="multisteps-form__title">High School Information</h5>
                                            {{-- <div class="mt-3">
                                                <button type="button" class="btn btn-primary" id="add-school">Add
                                                    School</button>
                                            </div> --}}
                                        </div>

                                        @foreach ($schools as $school)
                                            <div id="schools-container">
                                                <div class="school-entry">
                                                    <div class="form-row">
                                                        <div class="col-12  col-md-4">
                                                            <div class="form-label-group mt-2">

                                                                <input type="hidden" name="school_id[]" value="{{ $school->id ?? '' }}">


                                                                <input type="text" name="year_of_completion[]"
                                                                    required placeholder="Year of Completion"
                                                                    class="form-control"
                                                                    value="{{ $school->year_of_completion }}">
                                                                <label class="form-control-placeholder">Year of
                                                                    Completion</label>
                                                                <div class="invalid-feedback">This field is required.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12  col-md-4">
                                                            <div class="form-label-group mt-2">
                                                                <input type="text" name="degree_name[]" required
                                                                    placeholder="Degree Name" class="form-control"
                                                                    value="{{ $school->degree_name }}">
                                                                <label class="form-control-placeholder">Degree
                                                                    Name</label>
                                                                <div class="invalid-feedback">This field is required.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12  col-md-4">
                                                            <div class="form-label-group mt-2">
                                                                <input type="text" name="student_roll_number[]"
                                                                    required placeholder="Student Roll Number"
                                                                    class="form-control"
                                                                    value="{{ $school->student_roll_number }}">
                                                                <label class="form-control-placeholder">Student Roll
                                                                    Number</label>
                                                                <div class="invalid-feedback">This field is required.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12  col-md-4">
                                                            <div class="form-label-group mt-2">
                                                                <input type="text" name="major_subject[]" required
                                                                    placeholder="Major Subject" class="form-control"
                                                                    value="{{ $school->major_subject }}">
                                                                <label class="form-control-placeholder">Major
                                                                    Subject</label>
                                                                <div class="invalid-feedback">This field is required.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12  col-md-4">
                                                            <div class="form-label-group mt-2">
                                                                <input type="text" name="cgpa[]" required
                                                                    placeholder="Cumulative Grade Point Average / Percentage"
                                                                    class="form-control" value="{{ $school->cgpa }}">
                                                                <label class="form-control-placeholder">Cumulative
                                                                    Grade Point Average / Percentage</label>
                                                                <div class="invalid-feedback">This field is required.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12  col-md-4">
                                                            <div class="form-label-group mt-2">
                                                                <input type="date" name="certificate_issue_date[]"
                                                                    required class="form-control"
                                                                    value="{{ $school->certificate_issue_date }}">
                                                                <label class="form-control-placeholder">Certificate
                                                                    Issue Date</label>
                                                                <div class="invalid-feedback">This field is required.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12  col-md-4">
                                                            <div class="form-label-group mt-2">
                                                                <input type="text" name="school_university[]"
                                                                    required placeholder="School/University"
                                                                    class="form-control"
                                                                    value="{{ $school->school_university }}">
                                                                <label
                                                                    class="form-control-placeholder">School/University</label>
                                                                <div class="invalid-feedback">This field is required.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12  col-md-4">
                                                            <div class="form-label-group mt-2">
                                                                <input type="text" name="country_of_completion[]"
                                                                    required placeholder="Country of Completion"
                                                                    class="form-control"
                                                                    value="{{ $school->country_of_completion }}">
                                                                <label class="form-control-placeholder">Country of
                                                                    Completion</label>
                                                                <div class="invalid-feedback">This field is required.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12  col-md-4">
                                                            <div class="form-label-group mt-2">
                                                                <input type="text" name="institution_address[]"
                                                                    required
                                                                    placeholder="Street Address of Institution"
                                                                    class="form-control"
                                                                    value="{{ $school->institution_address }}">
                                                                <label class="form-control-placeholder">Street Address
                                                                    of Institution</label>
                                                                <div class="invalid-feedback">This field is required.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12  col-md-4">
                                                            <div class="form-label-group mt-2">
                                                                <input type="text" name="institution_website[]"
                                                                    placeholder="Institution Website"
                                                                    class="form-control"
                                                                    value="{{ $school->institution_website }}">
                                                                <label class="form-control-placeholder">Institution
                                                                    Website</label>
                                                            </div>
                                                        </div>

                                                        {{-- <div class="col-12 text-right mt-3">
                                                            <button type="button" class="btn btn-danger remove-school">Remove School</button>
                                                        </div> --}}

                                                    </div>
                                                    <hr>
                                                </div>
                                            </div>
                                        @endforeach

                                        <h5 class="multisteps-form__title">Language Proficiency Test</h5>
                                        <div class="form-row">
                                            <div class="col-12  col-md-4">
                                                <div class="form-label-group mt-2">
                                                    <input type="text" name="ielts_pte_score" required
                                                        placeholder="IELTS/PTE Academic Score" class="form-control"
                                                        value="{{ $s_application->ielts_pte_score }}">
                                                    <label class="form-control-placeholder">IELTS/PTE Academic
                                                        Score</label>
                                                    <div class="invalid-feedback">This field is required.</div>
                                                </div>
                                            </div>

                                            <div class="col-12  col-md-4">
                                                <div class="form-label-group mt-2">
                                                    <input type="text" name="score_report_code" required
                                                        placeholder="Score Report Code" class="form-control"
                                                        value="{{ $s_application->score_report_code }}">
                                                    <label class="form-control-placeholder">Score Report
                                                        Code</label>
                                                    <div class="invalid-feedback">This field is required.</div>
                                                </div>
                                            </div>

                                            <div class="col-12  col-md-4">
                                                <div class="form-label-group mt-2">
                                                    <input type="date" name="language_test_date" required
                                                        class="form-control"
                                                        value="{{ $s_application->language_test_date }}">
                                                    <label class="form-control-placeholder">Date of the PTE/IELTS
                                                        Language Test</label>
                                                    <div class="invalid-feedback">This field is required.</div>
                                                </div>
                                            </div>

                                            <div class="col-12  col-md-4">
                                                <div class="form-label-group mt-2">
                                                    <input type="text" name="test_taker_id" required
                                                        placeholder="Test Taker ID" class="form-control"
                                                        value="{{ $s_application->test_taker_id }}">
                                                    <label class="form-control-placeholder">Test Taker ID</label>
                                                    <div class="invalid-feedback">This field is required.</div>
                                                </div>
                                            </div>

                                            <div class="col-12  col-md-4">
                                                <div class="form-label-group mt-2">
                                                    <input type="text" name="registration_id" required
                                                        placeholder="Registration ID" class="form-control"
                                                        value="{{ $s_application->registration_id }}">
                                                    <label class="form-control-placeholder">Registration
                                                        ID</label>
                                                    <div class="invalid-feedback">This field is required.</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row tabs-footer mt-15">
                                            <div class="col-lg-12">
                                                <a href="{{ route('admin.student_appliction_list') }}"
                                                    class="btn blue-btn btn-danger">Cancel</a>
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

    <script src="{{ asset('backend/assets/js/select2.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $('.select2').select2();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const paymentStatus = document.getElementById("payment_status");
            const submitPaymentButton = document.getElementById("submitPayment");
            const paidAmountInput = document.getElementById("paid_amount");
            const paymentModal = new bootstrap.Modal(document.getElementById("paymentModal"));

            // Show modal when "Paid" is selected
            paymentStatus.addEventListener("change", function() {
                if (paymentStatus.value === "1") {
                    paymentModal.show();
                }
            });

            // Handle modal submit button click
            submitPaymentButton.addEventListener("click", function() {
                const paidAmount = parseFloat(paidAmountInput.value);
                const applicationId = submitPaymentButton.getAttribute("data-id");

                if (isNaN(paidAmount) || paidAmount <= 0) {
                    Swal.fire("Error", "Please enter a valid amount", "error");
                    return;
                }

                // Fetch request to update the amount
                fetch(`/admin/update-paid-amount/${applicationId}`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            paid_amount: paidAmount
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire("Success", data.message, "success");

                            // Update the payment status dropdown and display total paid amount
                            paymentStatus.value = data.payment_status === 1 ? "1" : "0";
                            paidAmountInput.value = ""; // Clear the input after submission
                        } else {
                            Swal.fire("Error", data.message, "error");
                        }
                        paymentModal.hide();
                    })
                    .catch(error => {
                        Swal.fire("Error", "An error occurred while updating: " + error.message,
                            "error");
                        console.error("Error:", error);
                    });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const paymentStatus = document.getElementById("payment_status_application");
            const submitPaymentApplicationButton = document.getElementById("submitPaymentApplication");
            const paidApplicationfeeInput = document.getElementById("paid_application_fees");
            const paymentModalApplication = new bootstrap.Modal(document.getElementById("paymentModalApplication"));

            // Show modal when "Paid" is selected
            paymentStatus.addEventListener("change", function() {
                if (paymentStatus.value === "1") {
                    paymentModalApplication.show();
                }
            });

            // Handle modal submit button click
            submitPaymentApplicationButton.addEventListener("click", function() {
                const paidAmount = parseFloat(paidApplicationfeeInput.value);
                const applicationId = submitPaymentApplicationButton.getAttribute("data-id");

                if (isNaN(paidAmount) || paidAmount <= 0) {
                    Swal.fire("Error", "Please enter a valid amount", "error");
                    return;
                }

                // Fetch request to update the amount
                fetch(`/admin/update-application-fee/${applicationId}`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            paid_application_fees: paidAmount
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire("Success", data.message, "success");

                            // Update the payment status dropdown and display total paid amount
                            paymentStatus.value = data.payment_status_application === 1 ? "1" : "0";
                            paidApplicationfeeInput.value = ""; // Clear the input after submission
                        } else {
                            Swal.fire("Error", data.message, "error");
                        }
                        paymentModalApplication.hide();
                    })
                    .catch(error => {
                        Swal.fire("Error", "An error occurred while updating: " + error.message,
                            "error");
                        console.error("Error:", error);
                    });
            });
        });
    </script>
</body>

</html>
