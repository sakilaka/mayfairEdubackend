<!DOCTYPE html>
<html lang="en">

<head>
    @include('User-Backend.components.head')
    <title>{{ env('APP_NAME') }} | Application Details of {{ $s_application->application_code }}</title>

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
                            Application Details of {{ $s_application->application_code }}
                        </h3>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <div class="row">
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

                                <div class="col-lg-12 mt-3">
                                    <b>
                                        <h4>Contact in Case of Emergencies
                                    </b></h4>
                                    <hr>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Emergency Contact Name:') }}</b></label>
                                        <p>{{ $s_application->emergency_contact_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Emergency Contact Phone:') }}</b></label>
                                        <p>{{ $s_application->emergency_contact_phone }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Emergency Contact Email:') }}</b></label>
                                        <p>{{ $s_application->emergency_contact_email }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address"><b>{{ __('Emergency Contact Address:') }}</b></label>
                                        <p>{{ $s_application->emergency_contact_address }}</p>
                                    </div>
                                </div>



                            </div>

                            {{-- <div class="ms-2">
                                <h4>Money Receipt</h4>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <img src="{{ asset($s_application->payment_proof) }}" alt="image"
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
                                            <a href="{{ route('frontend.application-file-download', $s_application->id) }}"
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
                                                $filePath = asset($s_application->payment_proof); // Ensure the file path starts from 'public'
                                                $fileExtension = pathinfo(
                                                    $s_application->payment_proof,
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
