<!DOCTYPE html>
<html lang="en">

<head>
    @include('User-Backend.components.head')
    <title>{{ env('APP_NAME') }} | Appliction-Invoice-{{ $orderdetails->application_code }}</title>

    <style>
        li {
            font-size: 0.9rem;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                margin: 0 !important;
            }

            .badge {
                border: 0;
            }

            .card {
                box-shadow: none;
            }
        }
    </style>

    <script>
        function handlePrint() {
            history.back();
        }

        window.addEventListener('afterprint', handlePrint);
        window.print();
    </script>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">

            <div class="main-panel m-auto">
                <div class="content-wrapper bg-white">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card px-2">
                                <div class="card-body">
                                    <div class="mt-4 container-fluid d-flex justify-content-between">
                                        <p class="text-right d-inline-block" style="font-size: 1.25rem">
                                            @php
                                                $title = \App\Models\Tp_option::where(
                                                    'option_name',
                                                    'theme_option_header',
                                                )->first();
                                            @endphp
                                            <strong>{{ $title->company_name }}</strong>
                                        </p>
                                        <p class="text-right d-inline-block" style="font-size: 1.25rem">
                                            <strong>Application ID: </strong>
                                            {{ $orderdetails->application_code }}
                                        </p>
                                    </div>
                                    <div class="mt-4 container-fluid d-flex justify-content-between">
                                        <div class="col-md-5 pl-0 d-flex justify-content-start align-items-start">
                                            <ul class="list-unstyled">
                                                <li>Student ID :
                                                    <span style="color:#5d9fc5;">
                                                        {{ $orderdetails->student?->id }}
                                                    </span>
                                                </li>
                                                <li>Student Name :
                                                    <span style="color:#5d9fc5;">
                                                        {{ $orderdetails->student?->name }}
                                                    </span>
                                                </li>
                                                <li>Email :
                                                    <span style="color:#5d9fc5;">
                                                        {{ $orderdetails->student?->email }}
                                                    </span>
                                                </li>
                                                <li>Phone Number :
                                                    <span style="color:#5d9fc5;">
                                                        {{ $orderdetails->student?->mobile }}
                                                    </span>
                                                </li>
                                                <li>Address :
                                                    <span style="color:#5d9fc5;">
                                                        {{ $orderdetails->student?->address }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-2 d-flex justify-content-center align-items-start">
                                            <img src="{{ asset('backend/assets/images/logo.svg') }}"
                                                alt="{{ env('APP_NAME') }}" width="150px">
                                        </div>
                                        <div class="col-md-5 pr-0 d-flex justify-content-end align-items-start">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <span class="fw-bold">
                                                        Creation Date: </span>
                                                    {{ date('d M, Y', strtotime(@$orderdetails->created_at)) }}
                                                </li>
                                                <li>
                                                    <span class="me-1 fw-bold">
                                                        Payment Status: </span>
                                                    @if (@$orderdetails->payment_method)
                                                        <span class="badge bg-warning text-white fw-bold">
                                                            {{ @$orderdetails->payment_method }}
                                                        </span>
                                                    @endif
                                                </li>

                                                <li>
                                                    @php
                                                        function getStatusBadgeClass($status)
                                                        {
                                                            $statusClasses = [
                                                                0 => 'bg-primary',
                                                                1 => 'bg-info',
                                                                2 => 'bg-success',
                                                                3 => 'bg-danger',
                                                            ];

                                                            return $statusClasses[$status] ?? '';
                                                        }

                                                        function getStatusText($status)
                                                        {
                                                            $statusTexts = [
                                                                0 => 'Application Start',
                                                                1 => 'Processing',
                                                                2 => 'Approval',
                                                                3 => 'Cancel',
                                                            ];

                                                            return $statusTexts[$status] ?? '';
                                                        }
                                                    @endphp
                                                    <span class="me-1 fw-bold">Status :</span>
                                                    <span
                                                        class="badge fw-bold {{ getStatusBadgeClass($orderdetails->status) }} text-white">
                                                        {{ getStatusText($orderdetails->status) }}
                                                    </span>
                                                </li>


                                            </ul>
                                        </div>
                                    </div>

                                    <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                                        <div class="table-responsive w-100">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr class="bg-dark text-white">
                                                        <th>SL</th>
                                                        <th>Program Name</th>
                                                        <th class="text-right">University Name</th>
                                                        <th class="text-right">Application Fee</th>
                                                        <th class="text-right">Service Charge</th>
                                                        <th class="text-right">Total Fee</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $total_application_fees = 0;
                                                        $total_service_charges = 0;
                                                        $total_fees = 0;
                                                        $programIds = json_decode($orderdetails->programs) ?? [];
                                                    @endphp
                                                    @foreach ($programIds as $programId)
                                                        @php
                                                            $course = \App\Models\Course::find($programId);
                                                            $applicationFee = $course->application_charge ?? 0;
                                                            $serviceCharge = $orderdetails->service_charge ?? 0;
                                                            $totalApplicationFee = $applicationFee;
                                                            $totalServiceCharge = $serviceCharge;
                                                            $totalFee = $totalApplicationFee + $totalServiceCharge;

                                                            $total_application_fees += $applicationFee;
                                                            $total_service_charges += $serviceCharge;
                                                            $total_fees += $totalFee;
                                                        @endphp
                                                        <tr>
                                                            <th scope="row">{{ $loop->iteration }}</th>
                                                            <td>{{ $course->name ?? 'N/A' }}</td>
                                                            <td>{{ $course->university->name ?? 'N/A' }}</td>
                                                            <td class="text-right">{{ $applicationFee }}</td>
                                                            <td class="text-right">{{ $serviceCharge }}</td>
                                                            <td class="text-right">{{ $totalFee }}</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <th scope="row" colspan="3">Total</th>
                                                        <td class="text-right" style="font-weight: bold">
                                                            {{ $total_application_fees }}</td>
                                                        <td class="text-right" style="font-weight: bold">
                                                            {{ $total_service_charges }}</td>
                                                        <td class="text-right" style="font-weight: bold">
                                                            {{ $total_fees }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="container-fluid mt-5 w-100">
                                        <h4 class="text-right mb-5" style="font-size: 1.25rem">Total :
                                            {{ $total_fees }}</h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('User-Backend.components.script')
</body>

</html>
