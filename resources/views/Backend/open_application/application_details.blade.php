<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Application Details of {{ @$o_application->first_name }}</title>

    <style>
        .label {
            font-size: 1.2rem !important;
        }

        p {
            font-size: 0.85rem !important;
            color: #383838 !important;
        }

        th {
            font-size: 0.9rem !important;
        }

        h4 {
            font-size: 1.4rem !important;
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


                    <div class="card">
                        <div class="card-body p-5">
                            <div class="row p-3 border">
                                <div class="col-12 d-flex justify-content-center my-3">
                                    <h3 class="page-title">
                                        {{ @$o_application->first_name }}'s
                                        Application Details
                                    </h3>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <h4>Program Information</h4>
                                    <hr>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Application Code:') }}</b></label>
                                        <p>{{ $o_application->application_code }}</p>
                                    </div>
                                </div>
                  

                                <div class="col-lg-12 mt-3">
                                    <h4>Personal Information</h4>
                                    <hr>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('First Name:') }}</b></label>
                                        <p>{{ $o_application->first_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Middle Name:') }}</b></label>
                                        <p>{{ $o_application->middle_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Last Name:') }}</b></label>
                                        <p>{{ $o_application->last_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Chinese Name:') }}</b></label>
                                        <p>{{ $o_application->chinese_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Phone:') }}</b></label>
                                        <p>{{ $o_application->phone }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Email:') }}</b></label>
                                        <p>{{ $o_application->email }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Date of Birth:') }}</b></label>
                                        <p>{{ $o_application->dob }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Birth Place:') }}</b></label>
                                        <p>{{ $o_application->birth_place }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Passport Number:') }}</b></label>
                                        <p>{{ $o_application->passport_number }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Passport Exipre Date:') }}</b></label>
                                        <p>{{ $o_application->passport_exipre_date }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Nationality:') }}</b></label>
                                        <p>{{ @$o_application->nationality_country->name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Religion:') }}</b></label>
                                        <p>{{ $o_application->religion }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Gender:') }}</b></label>
                                        <p>{{ $o_application->gender }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Maritial Status:') }}</b></label>
                                        <p>{{ $o_application->maritial_status }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('In Chaina:') }}</b></label>
                                        <p>
                                            @if ($o_application->in_chaina == 1)
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
                                            @if ($o_application->in_alcoholic == 1)
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
                                        <p>{{ $o_application->hobby }}</p>
                                    </div>
                                </div>


                                <div class="col-lg-12 mt-3">
                                    <h4>Language Proficiency</h4>
                                    <hr>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Native Language:') }}</b></label>
                                        <p>{{ $o_application->native_language }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('English Level:') }}</b></label>
                                        <p>
                                            @if ($o_application->english_level == 0)
                                                Can't speak English at all
                                            @elseif ($o_application->english_level == 1)
                                                Beginner - not currently good enough to study in English
                                            @elseif ($o_application->english_level == 2)
                                                Intermediate - OK but needs some work
                                            @elseif ($o_application->english_level == 3)
                                                Fluent - very good level
                                            @elseif ($o_application->english_level == 4)
                                                Native English
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Chinese Level:') }}</b></label>
                                        <p>
                                            @if ($o_application->chinese_level == 0)
                                                Can't speak English at all
                                            @elseif ($o_application->chinese_level == 1)
                                                Beginner - not currently good enough to study in English
                                            @elseif ($o_application->chinese_level == 2)
                                                Intermediate - OK but needs some work
                                            @elseif ($o_application->chinese_level == 3)
                                                Fluent - very good level
                                            @elseif ($o_application->chinese_level == 4)
                                                Native English
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <h4>Home Address Details</h4>
                                    <hr>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Home Country:') }}</b></label>
                                        <p>{{ $o_application->home_country }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Home City:') }}</b></label>
                                        <p>{{ $o_application->home_city }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Home District:') }}</b></label>
                                        <p>{{ $o_application->home_district }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Home Street:') }}</b></label>
                                        <p>{{ $o_application->home_street }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Home Zip Code:') }}</b></label>
                                        <p>{{ $o_application->home_zipcode }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Home Contact Name:') }}</b></label>
                                        <p>{{ $o_application->home_contact_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Home Contact Phone:') }}</b></label>
                                        <p>{{ $o_application->home_contact_phone }}</p>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <h4>Postal Address Details</h4>
                                    <hr>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Current Country:') }}</b></label>
                                        <p>{{ $o_application->current_country }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Current City:') }}</b></label>
                                        <p>{{ $o_application->current_city }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Current District:') }}</b></label>
                                        <p>{{ $o_application->current_district }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Current Street:') }}</b></label>
                                        <p>{{ $o_application->current_street }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Current Zip Code:') }}</b></label>
                                        <p>{{ $o_application->current_zipcode }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Current Contact Name:') }}</b></label>
                                        <p>{{ $o_application->current_contact_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Current Contact Phone:') }}</b></label>
                                        <p>{{ $o_application->current_contact_phone }}</p>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <h4>Education Background</h4>
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
                                            @foreach ($o_application->educations as $item)
                                                <tr>
                                                    <td>
                                                        <p> {{ $item->school }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{{ $item->major }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{{ $item->gpa_type }} </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{{ date('d-m-Y', strtotime($item->start_date)) }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{{ date('d-m-Y', strtotime($item->end_date)) }}</p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <h4>Work Experience</h4>
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
                                            @foreach ($o_application->work_experiences as $item)
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
                                    <h4>Family Information</h4>
                                    <hr>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Father Name:') }}</b></label>
                                        <p>{{ $o_application->father_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Father Nnationlity:') }}</b></label>
                                        <p>{{ $o_application->father_nationlity }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Father Phone:') }}</b></label>
                                        <p>{{ $o_application->father_phone }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Father Email:') }}</b></label>
                                        <p>{{ $o_application->father_email }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Father Workplace:') }}</b></label>
                                        <p>{{ $o_application->father_workplace }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Father Position:') }}</b></label>
                                        <p>{{ $o_application->father_position }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Mother Name:') }}</b></label>
                                        <p>{{ $o_application->mother_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Mother Nationlity:') }}</b></label>
                                        <p>{{ $o_application->mother_nationlity }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Mother Phone:') }}</b></label>
                                        <p>{{ $o_application->mother_phone }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Mother Email:') }}</b></label>
                                        <p>{{ $o_application->mother_email }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Mother Workplace:') }}</b></label>
                                        <p>{{ $o_application->mother_workplace }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Mother Position:') }}</b></label>
                                        <p>{{ $o_application->mother_position }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Guarantor Relationship:') }}</b></label>
                                        <p>{{ $o_application->guarantor_relationship }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Guarantor Name:') }}</b></label>
                                        <p>{{ $o_application->guarantor_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Guarantor Address:') }}</b></label>
                                        <p>{{ $o_application->guarantor_address }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Guarantor Phone:') }}</b></label>
                                        <p>{{ $o_application->guarantor_phone }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Guarantor Email:') }}</b></label>
                                        <p>{{ $o_application->guarantor_email }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Guarantor Workplace:') }}</b></label>
                                        <p>{{ $o_application->guarantor_workplace }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Guarantor Work Address:') }}</b></label>
                                        <p>{{ $o_application->guarantor_work_address }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Study Fund:') }}</b></label>
                                        <p>{{ $o_application->study_fund }}</p>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <h4>Contact in Case of Emergencies</h4>
                                    <hr>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Emergency Contact Name:') }}</b></label>
                                        <p>{{ $o_application->emergency_contact_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Emergency Contact Phone:') }}</b></label>
                                        <p>{{ $o_application->emergency_contact_phone }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Emergency Contact Email:') }}</b></label>
                                        <p>{{ $o_application->emergency_contact_email }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Emergency Contact Address:') }}</b></label>
                                        <p>{{ $o_application->emergency_contact_address }}</p>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <h4>Documents</h4>
                                    <hr>
                                </div>
                                

                                @foreach ($o_application->documents as $k => $document)
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="address"><b>{{ $loop->iteration }}.
                                                    {{ __($document->document_name) }}</b></label>
                                            <div class="row">
                                                <div class="col-md-6 d-flex">
                                                    <button style="margin-left: 18px" type="button"
                                                        data-toggle="modal"
                                                        data-target="#certificateModal{{ $k }}"
                                                        class="btn btn-primary"><i class="fa fa-solid fa-eye"></i>
                                                        Details</button>

                                                    <a href="{{ route('admin.open-application-file-download', $document->id) }}"
                                                        class="btn btn-primary ml-2"><i
                                                            class="fa fa-solid fa-download"></i>
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
                                                        <iframe src="{{ asset('upload/application/' . $document->document_file) }}"
                                                            width="100%" height="500"></iframe>
                                                    @else
                                                        <img src="{{ asset('upload/application/' . $document->document_file) }}"
                                                            alt="image" style="height: 300px; width:450px">
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
                            </div>
                        </div>
                    </div>
                </div>

                @include('Backend.components.footer')
            </div>
        </div>
    </div>

    @include('Backend.components.script')
</body>

</html>
