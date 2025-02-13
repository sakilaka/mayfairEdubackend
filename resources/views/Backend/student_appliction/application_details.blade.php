<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Application Details of {{ @$s_application->student->name }}</title>

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
                                        {{ $s_application->full_name }}'s
                                        Application Details
                                    </h3>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <h4>Program Information</h4>
                                    <hr>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Program Name:') }}</b></label>

                                            <p>{{ $s_application->program_name }}</p>

                                    </div>
                                </div>


                               <div class="col-lg-12 mt-3">
                                    <b>
                                        <h4>Personal Information
                                    </b></h4>
                                    <hr>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Full Name:') }}</b></label>
                                        <p>{{ $s_application->full_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Fore names:') }}</b></label>
                                        <p>{{ $s_application->forenames }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Last Name:') }}</b></label>
                                        <p>{{ $s_application->surname }}</p>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Phone:') }}</b></label>
                                        <p>{{ $s_application->phone }}</p>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Email:') }}</b></label>
                                        <p>{{ $s_application->email }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Date of Birth:') }}</b></label>
                                        <p>{{ $s_application->date_of_birth }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Birth Place:') }}</b></label>
                                        <p>{{ $s_application->place_of_birth }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Passport Number:') }}</b></label>
                                        <p>{{ $s_application->passport_no }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Passport Exipre Date:') }}</b></label>
                                        <p>{{ $s_application->passport_expiration_date }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Nationality:') }}</b></label>
                                        <p>{{ $s_application->nationality }}</p>
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
                                        <label for="address"><b>{{ __('IELTS Score:') }}</b></label>
                                        <p>
                                           {{ $s_application->ielts_pte_score }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Score Report Code:') }}</b></label>
                                        <p>{{ $s_application->score_report_code ?? 'Null' }}</p>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Language Test Date:') }}</b></label>
                                        <p>{{ $s_application->language_test_date ?? 'Null' }}</p>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Test Taker Id:') }}</b></label>
                                        <p>{{ $s_application->test_taker_id ?? 'Null' }}</p>
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
                                            <th>Student Roll Number</th>
                                            <th>Certificate issue Date</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($s_application->educations as $item)
                                                <tr>
                                                    <td>
                                                        <p> {{ @$item->school_university }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{{ @$item->major_subject }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{{ $item->cgpa }} </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{{ date('d-m-Y', strtotime(@$item->student_roll_number)) }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{{ date('d-m-Y', strtotime(@$item->certificate_issue_date)) }}</p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>


                            <div class="col-lg-12">
                                    <table border="1" class="col-md-12">
                                        <thead class="text-center">
                                            <th>School</th>
                                            <th>Major</th>
                                            <th>GPA</th>
                                            <th>Student Roll Number</th>
                                            <th>Certificate issue Date</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($s_application->educations as $item)
                                                <tr>
                                                    <td>
                                                        <p> {{ @$item->school_university }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{{ @$item->major_subject }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{{ $item->cgpa }} </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{{ date('d-m-Y', strtotime(@$item->student_roll_number)) }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p>{{ date('d-m-Y', strtotime(@$item->certificate_issue_date)) }}</p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
</body>

</html>
