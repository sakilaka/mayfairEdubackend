<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Details</title>

    <style>
        .text-start {
            text-align: left;
            vertical-align: top;
        }
    </style>
</head>

<body>
    <div class="" style="margin-left: 10px; margin-right: 10px; margin-top: 100px; margin-bottom: 100px">
        <div class="">


            <div class="col-lg-12 mt-3">
                @php
                    $studentName = $s_appliction->student
                        ? $s_appliction->student->name
                        : $s_appliction->first_name . ' ' . $s_appliction->last_name;
                @endphp

                <h2 class="text-center mb-5" style="color: black; text-align: center;">
                    <b>{{ $studentName }}'s Application Details</b>
                </h2>

                <b>
                    <h4 style="margin: 0;">Program Information
                </b></h4>
                <hr style="margin: 0;">
            </div>

            <table style="width: 100%">
                <tr>

                    <td class="text-start">
                        <p><b>Program:</b></p>
                            <p>{{ $s_appliction->program_name }}</p>
                    </td>

                </tr>
            </table>

                  <div class="col-lg-12 mt-3">
                                    <b>
                                        <h4>Personal Information
                                    </b></h4>
                                    <hr>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Full Name:') }}</b></label>
                                        <p>{{ $s_appliction->full_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Fore names:') }}</b></label>
                                        <p>{{ $s_appliction->forenames }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Last Name:') }}</b></label>
                                        <p>{{ $s_appliction->surname }}</p>
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
                                        <p>{{ $s_appliction->date_of_birth }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Birth Place:') }}</b></label>
                                        <p>{{ $s_appliction->place_of_birth }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Passport Number:') }}</b></label>
                                        <p>{{ $s_appliction->passport_no }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Passport Exipre Date:') }}</b></label>
                                        <p>{{ $s_appliction->passport_expiration_date }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Nationality:') }}</b></label>
                                        <p>{{ $s_appliction->nationality }}</p>
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
                                           {{ $s_appliction->ielts_pte_score }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Score Report Code:') }}</b></label>
                                        <p>{{ $s_appliction->score_report_code ?? 'Null' }}</p>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Language Test Date:') }}</b></label>
                                        <p>{{ $s_appliction->language_test_date ?? 'Null' }}</p>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Test Taker Id:') }}</b></label>
                                        <p>{{ $s_appliction->test_taker_id ?? 'Null' }}</p>
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
                                            @foreach ($s_appliction->educations as $item)
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
                                            @foreach ($s_appliction->educations as $item)
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
</body>

</html>
