<!DOCTYPE html>
<html lang="en">

<head>
    @include('User-Backend.components.head')
    <title>{{ env('APP_NAME') }} | Application Details of {{ $s_appliction->application_code }}</title>

    <style>
        p {
            font-size: 0.9rem !important;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('User-Backend.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('User-Backend.components.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            Application Details of {{ $s_appliction->application_code }}
                        </h3>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mt-3">
                                    <h4>Personal Information</h4>
                                    <hr>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Application Code:') }}</b></label>
                                        <p>{{ $s_appliction->application_code }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Program Name:') }}</b></label>
                                        @php
                                            $programIds = json_decode($s_appliction->programs) ?? [];
                                            $programs = collect($programIds)
                                                ->map(function ($programId) {
                                                    $course = \App\Models\Course::find($programId);
                                                    return $course
                                                        ? [
                                                            'id' => $course->id,
                                                            'name' => $course->name,
                                                        ]
                                                        : null;
                                                })
                                                ->filter()
                                                ->unique('id')
                                                ->values();

                                            $programLinks = $programs
                                                ->map(function ($program) {
                                                    return '<span data-toggle="tooltip" data-placement="top" data-original-title="' .
                                                        $program['name'] .
                                                        '">' .
                                                        $program['name'] .
                                                        '</span>';
                                                })
                                                ->implode(',<br>');

                                        @endphp
                                        <p>{!! $programLinks !!}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('University Name:') }}</b></label>
                                        @php
                                            $programIds = json_decode($s_appliction->programs) ?? [];
                                            $universities = collect($programIds)
                                                ->map(function ($programId) {
                                                    $course = \App\Models\Course::find($programId);
                                                    return $course?->university;
                                                })
                                                ->filter()
                                                ->unique('id')
                                                ->values();

                                            $universityNames = $universities
                                                ->map(function ($university) {
                                                    return '<span data-toggle="tooltip" data-placement="top" data-original-title="' .
                                                        $university->name .
                                                        '">' .
                                                        $university->name .
                                                        '</span>';
                                                })
                                                ->implode(',<br>');

                                        @endphp
                                        <p>{!! $universityNames !!}</p>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Continent Name:') }}</b></label>
                                        @foreach ($s_appliction->carts as $cart)
                                            <p>{{ @$cart->course->university->continent->name }}</p>
                                        @endforeach
                                    </div>
                                </div> --}}

                                <div class="col-lg-12 mt-3">
                                    <b>
                                        <h4>Personal Information
                                    </b></h4>
                                    <hr>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('First Name:') }}</b></label>
                                        <p>{{ $s_appliction->first_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Middle Name:') }}</b></label>
                                        <p>{{ $s_appliction->middle_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Last Name:') }}</b></label>
                                        <p>{{ $s_appliction->last_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('chinese Name:') }}</b></label>
                                        <p>{{ $s_appliction->chinese_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Phone:') }}</b></label>
                                        <p>{{ $s_appliction->phone }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Email:') }}</b></label>
                                        <p>{{ $s_appliction->email }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Date of Birth:') }}</b></label>
                                        <p>{{ $s_appliction->dob }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Birth Place:') }}</b></label>
                                        <p>{{ $s_appliction->birth_place }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Passport Number:') }}</b></label>
                                        <p>{{ $s_appliction->passport_number }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Passport Exipre Date:') }}</b></label>
                                        <p>{{ $s_appliction->passport_exipre_date }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Nationality:') }}</b></label>
                                        <p>{{ @$s_appliction->nationality_country->name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Religion:') }}</b></label>
                                        <p>{{ $s_appliction->religion }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Gender:') }}</b></label>
                                        <p>{{ $s_appliction->gender }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Maritial Status:') }}</b></label>
                                        <p>{{ $s_appliction->maritial_status }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('In Chaina:') }}</b></label>
                                        <p>
                                            @if ($s_appliction->in_chaina == 1)
                                                No
                                            @else
                                                Yes
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('In Alcoholic:') }}</b></label>
                                        <p>
                                            @if ($s_appliction->in_alcoholic == 1)
                                                No
                                            @else
                                                Yes
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Hobby:') }}</b></label>
                                        <p>{{ $s_appliction->hobby }}</p>
                                    </div>
                                </div>


                                <div class="col-lg-12 mt-3">
                                    <b>
                                        <h4>Language Proficiency
                                    </b></h4>
                                    <hr>
                                </div>



                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Native Language:') }}</b></label>
                                        <p>{{ $s_appliction->native_language }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('English Level:') }}</b></label>
                                        <p>
                                            @if ($s_appliction->english_level == 0)
                                                Can't speak English at all
                                            @elseif ($s_appliction->english_level == 1)
                                                Beginner - not currently good enough to study in English
                                            @elseif ($s_appliction->english_level == 2)
                                                Intermediate - OK but needs some work
                                            @elseif ($s_appliction->english_level == 3)
                                                Fluent - very good level
                                            @elseif ($s_appliction->english_level == 4)
                                                Native English
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Certificate:') }}</b></label>
                                        <p>{{ $s_appliction->english_proficiency_certificate ?? 'Null' }}</p>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('English Score:') }}</b></label>
                                        <p>{{ $s_appliction->english_score ?? 'Null' }}</p>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Certificate Issue date:') }}</b></label>
                                        <p>{{ $s_appliction->certificate_issue_date ?? 'Null' }}</p>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Chinese Level:') }}</b></label>
                                        <p>
                                            @if ($s_appliction->chinese_level == 0)
                                                Can't speak English at all
                                            @elseif ($s_appliction->chinese_level == 1)
                                                Beginner - not currently good enough to study in English
                                            @elseif ($s_appliction->chinese_level == 2)
                                                Intermediate - OK but needs some work
                                            @elseif ($s_appliction->chinese_level == 3)
                                                Fluent - very good level
                                            @elseif ($s_appliction->chinese_level == 4)
                                                Native English
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('HSK_level:') }}</b></label>
                                        <p>{{ $s_appliction->HSK_level ?? 'Null' }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('HSK_score:') }}</b></label>
                                        <p>{{ $s_appliction->HSK_score ?? 'Null' }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('HSK_report_no:') }}</b></label>
                                        <p>{{ $s_appliction->HSK_report_no ?? 'Null' }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('HSKK_level:') }}</b></label>
                                        <p>{{ $s_appliction->HSK_level ?? 'Null' }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('HSKK_score:') }}</b></label>
                                        <p>{{ $s_appliction->HSK_score ?? 'Null' }}</p>
                                    </div>
                                </div>



                                <div class="col-lg-12 mt-3">
                                    <b>
                                        <h4>Home Address Details
                                    </b></h4>
                                    <hr>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Home Country:') }}</b></label>
                                        <p>{{ $s_appliction->home_country }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Home City:') }}</b></label>
                                        <p>{{ $s_appliction->home_city }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Home District:') }}</b></label>
                                        <p>{{ $s_appliction->home_district }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Home Street:') }}</b></label>
                                        <p>{{ $s_appliction->home_street }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Home Zip Code:') }}</b></label>
                                        <p>{{ $s_appliction->home_zipcode }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Home Contact Name:') }}</b></label>
                                        <p>{{ $s_appliction->home_contact_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Home Contact Phone:') }}</b></label>
                                        <p>{{ $s_appliction->home_contact_phone }}</p>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <b>
                                        <h4>Postal Address Details
                                    </b></h4>
                                    <hr>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Current Country:') }}</b></label>
                                        <p>{{ $s_appliction->current_country }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Current City:') }}</b></label>
                                        <p>{{ $s_appliction->current_city }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Current District:') }}</b></label>
                                        <p>{{ $s_appliction->current_district }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Current Street:') }}</b></label>
                                        <p>{{ $s_appliction->current_street }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Current Zip Code:') }}</b></label>
                                        <p>{{ $s_appliction->current_zipcode }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Current Contact Name:') }}</b></label>
                                        <p>{{ $s_appliction->current_contact_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Current Contact Phone:') }}</b></label>
                                        <p>{{ $s_appliction->current_contact_phone }}</p>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <b>
                                        <h4>Education Background
                                    </b></h4>
                                    <hr>
                                </div>


                                <div class="col-lg-12">
                                    <table border="1" class="col-md-12">
                                        <thead class="text-center">
                                            <th>School</th>
                                            <th>Major</th>
                                            <th>GPA</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($s_appliction->educations as $item)
                                                <tr>
                                                    <td>
                                                        <p> {{ @$item->school }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{{ @$item->major }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{{ $item->gpa_type }} </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{{ date('d-m-Y', strtotime(@$item->start_date)) }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{{ date('d-m-Y', strtotime(@$item->end_date)) }}</p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <b>
                                        <h4>Work Experience
                                    </b></h4>
                                    <hr>
                                </div>

                                <div class="col-lg-12">
                                    <table border="1" class="col-md-12">
                                        <thead class="text-center">
                                            <th>Company</th>
                                            <th>Job Title</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($s_appliction->work_experiences as $item)
                                                <tr>
                                                    <td>
                                                        <p>{{ @$item->company }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{{ @$item->job_title }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{{ date('d-m-Y', strtotime(@$item->start_date)) }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{{ date('d-m-Y', strtotime(@$item->end_date)) }}</p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <b>
                                        <h4>Family Member Information
                                    </b></h4>
                                    <hr>
                                </div>

                                @foreach ($s_appliction->familyMembers as $item)
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="address"><b>{{ __('Member Name:') }}</b></label>
                                            <p>{{ $item->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="address"><b>{{ __('Member Email:') }}</b></label>
                                            <p>{{ $item->email }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="address"><b>{{ __('Member Phone:') }}</b></label>
                                            <p>{{ $item->phone }}</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="address"><b>{{ __('Member Nnationlity:') }}</b></label>
                                            <p>{{ $item->nationlity }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="address"><b>{{ __('Member Workplace:') }}</b></label>
                                            <p>{{ $item->workplace }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="address"><b>{{ __('Member Position:') }}</b></label>
                                            <p>{{ $item->position }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="address"><b>{{ __('Member Relationship:') }}</b></label>
                                            <p>{{ $item->relationship }}</p>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-lg-12 mt-3">
                                    <b>
                                        <h4>Guarantor Information
                                    </b></h4>
                                    <hr>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Guarantor Relationship:') }}</b></label>
                                        <p>{{ $s_appliction->guarantor_relationship }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Guarantor Name:') }}</b></label>
                                        <p>{{ $s_appliction->guarantor_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Guarantor Address:') }}</b></label>
                                        <p>{{ $s_appliction->guarantor_address }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Guarantor Phone:') }}</b></label>
                                        <p>{{ $s_appliction->guarantor_phone }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Guarantor Email:') }}</b></label>
                                        <p>{{ $s_appliction->guarantor_email }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Guarantor Workplace:') }}</b></label>
                                        <p>{{ $s_appliction->guarantor_workplace }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Guarantor Work Address:') }}</b></label>
                                        <p>{{ $s_appliction->guarantor_work_address }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Study Fund:') }}</b></label>
                                        <p>{{ $s_appliction->study_fund }}</p>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <b>
                                        <h4>Contact in Case of Emergencies
                                    </b></h4>
                                    <hr>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Emergency Contact Name:') }}</b></label>
                                        <p>{{ $s_appliction->emergency_contact_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Emergency Contact Phone:') }}</b></label>
                                        <p>{{ $s_appliction->emergency_contact_phone }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Emergency Contact Email:') }}</b></label>
                                        <p>{{ $s_appliction->emergency_contact_email }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Emergency Contact Address:') }}</b></label>
                                        <p>{{ $s_appliction->emergency_contact_address }}</p>
                                    </div>
                                </div>


                                <div class="col-lg-12 mt-3">
                                    <b>
                                        <h4>Documents
                                    </b></h4>
                                    <hr>
                                </div>
                                @foreach ($s_appliction->documents as $k => $document)
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="address"><b>{{ $loop->iteration }}.
                                                    {{ __($document->document_name) }}</b></label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button style="margin-left: 18px" type="button"
                                                        data-toggle="modal"
                                                        data-target="#certificateModal{{ $k }}"
                                                        class="btn btn-primary"><i class="fa-solid fa-eye"></i>
                                                        Details</button>
                                                    <a href="{{ route('frontend.application-file-download', $document->id) }}"
                                                        class="btn btn-primary"><i class="fa-solid fa-download"></i>
                                                        Download</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="certificateModal{{ $k }}" tabindex="-1"
                                        role="dialog" aria-labelledby="audioModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="audioModalLabel"
                                                        style="color: black">
                                                        {{ $document->document_name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @if ($document->extensions == 'pdf')
                                                        <iframe src="{{ $document->document_file_show }}"
                                                            width="100%" height="500"></iframe>
                                                    @else
                                                        <img src="{{ $document->document_file_show }}"
                                                            alt="image" style="height: 300px; width:450px">
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- <div class="ms-2">
                                <h4>Money Receipt</h4>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <img src="{{ asset($s_appliction->payment_proof) }}" alt="image"
                                                 style="height: 300px; width: 450px">
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="address"><b>Payment Receipt</b></label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button style="margin-left: 18px" type="button" data-toggle="modal"
                                                data-target="#paymentRecipt" class="btn btn-primary">
                                                <i class="fa-solid fa-eye"></i> Details
                                            </button>
                                            <a href="{{ route('frontend.application-file-download', $s_appliction->id) }}"
                                                class="btn btn-primary">
                                                <i class="fa-solid fa-download"></i> Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="paymentRecipt" tabindex="-1" role="dialog"
                                aria-labelledby="paymentReciptLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="paymentReciptLabel" style="color: black">
                                                Payment Receipt
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @php
                                                $filePath = asset($s_appliction->payment_proof); // Ensure the file path starts from 'public'
                                                $fileExtension = pathinfo(
                                                    $s_appliction->payment_proof,
                                                    PATHINFO_EXTENSION,
                                                );
                                            @endphp

                                            @if ($fileExtension === 'pdf')
                                                <iframe src="{{ $filePath }}" width="100%"
                                                    height="500"></iframe>
                                            @else
                                                <img src="{{ $filePath }}" alt="image"
                                                    style="height: 300px; width: 450px">
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div>

                    @include('User-Backend.components.footer')
                </div>
            </div>
        </div>

        @include('User-Backend.components.script')

</body>

</html>
