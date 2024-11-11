<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Student Application Program Edit</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


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
                        <div class="my-2 col-md-2">
                            @include('Backend.student_appliction.theme_options_tabs_nav')
                        </div>

                        <div class="my-2 col-md-10">
                            <div class="tab-content tab-content-vertical bg-white rounded">
                                <div class="tab-pane fade show active" id="program-info-tab-content" role="tabpanel"
                                    aria-labelledby="home-tab-vertical">

                                    <form novalidate="" method="post"
                                        action="{{ route('admin.student_appliction_program_update', $s_appliction->id) }}"
                                        data-validate="parsley" id="DataEntry_formId" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-lg-12 mb-2">
                                                <h4>Program Information</h4>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Application ID:') }}</label>
                                                    <input disabled value="{{ $s_appliction->application_code }}"
                                                        type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Student Name:') }}</label>
                                                    <input disabled value="{{ @$s_appliction->student->name }}"
                                                        type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Programs:') }}</label>

                                                    <select name="program_id[]"
                                                        class="form-control form-control-lg select2" required multiple>
                                                        @php
                                                            $selectedProgramIds =
                                                                json_decode($s_appliction->programs) ?? [];
                                                        @endphp
                                                        @forelse ($programs as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ in_array($item->id, $selectedProgramIds) ? 'selected' : '' }}>
                                                                {{ $item->name }} - ({{ $item->university?->name }})
                                                            </option>
                                                        @empty
                                                            <option value="">No Program Available</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('University Name:') }}</label>
                                                    @php
                                                        $programIds = json_decode($s_appliction->programs) ?? [];

                                                        $universityNames = collect($programIds)
                                                            ->map(function ($programId) {
                                                                $course = \App\Models\Course::find($programId);
                                                                return $course?->university?->name;
                                                            })
                                                            ->filter()
                                                            ->unique()
                                                            ->implode(', ');
                                                    @endphp
                                                    <input disabled value="{{ $universityNames }}" type="text"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Application Fees:') }}</label>
                                                    <input disabled value="{{ $s_appliction->application_fee }}"
                                                        type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="service_charge">{{ __('Final Service Charge:') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input id="service_charge" name="service_charge"
                                                        value="{{ $s_appliction->service_charge }}" type="text"
                                                        class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="total_fee">{{ __('Total Cost:') }}</label>
                                                    <input id="total_fee" name="total_fee" readonly
                                                        value="{{ $s_appliction->total_fee }}" type="text"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Payment Status:') }}</label>
                                                    <select id="payment_status" name="payment_status"
                                                        class="form-control form-control-lg">
                                                        <option @if ($s_appliction->payment_status == 0) Selected @endif
                                                            value="0">Unpaid</option>
                                                        <option @if ($s_appliction->payment_status == 1) Selected @endif
                                                            value="1">Paid</option>
                                                    </select>
                                                </div>
                                            </div>


                                            {{-- payment modal  --}}


                                            <div class="modal fade" id="paymentModal" tabindex="-1"
                                                aria-labelledby="paymentModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="paymentModalLabel">Enter Payment
                                                                Amount</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label for="paid_amount">Amount Paid:</label>
                                                            <input type="number" id="paid_amount"
                                                                class="form-control" placeholder="Enter amount">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" id="submitPayment"
                                                                class="btn btn-primary"
                                                                data-id="{{ $s_appliction->id }}">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Status:') }}</label>
                                                    <select name="status" class="form-control form-control-lg">
                                                        <option value=""> Select Status</option>
                                                        <option @if ($s_appliction->status == 0) Selected @endif
                                                            value="1"> Not Complete</option>
                                                        <option @if ($s_appliction->status == 1) Selected @endif
                                                            value="1"> Processing</option>
                                                        <option @if ($s_appliction->status == 2) Selected @endif
                                                            value="2"> Approved</option>
                                                        <option @if ($s_appliction->status == 3) Selected @endif
                                                            value="3"> Cancel</option>
                                                        <option @if ($s_appliction->status == 4) Selected @endif
                                                            value="4">Not Submitted</option>
                                                        <option @if ($s_appliction->status == 5) Selected @endif
                                                            value="5">Submitted</option>
                                                        <option @if ($s_appliction->status == 6) Selected @endif
                                                            value="6">Pending</option>
                                                        <option @if ($s_appliction->status == 7) Selected @endif
                                                            value="7">E-documents Qualified</option>
                                                        <option @if ($s_appliction->status == 8) Selected @endif
                                                            value="8">Waiting Processing</option>
                                                        <option @if ($s_appliction->status == 9) Selected @endif
                                                            value="9">Processing</option>
                                                        <option @if ($s_appliction->status == 10) Selected @endif
                                                            value="10">More Documents Needed</option>
                                                        <option @if ($s_appliction->status == 11) Selected @endif
                                                            value="11">Re-Submitted</option>
                                                        <option @if ($s_appliction->status == 12) Selected @endif
                                                            value="12">Rejected</option>
                                                        <option @if ($s_appliction->status == 13) Selected @endif
                                                            value="13">Transferred</option>
                                                        <option @if ($s_appliction->status == 14) Selected @endif
                                                            value="14">Accepted</option>
                                                        <option @if ($s_appliction->status == 15) Selected @endif
                                                            value="15">E-offer Delivered</option>
                                                        <option @if ($s_appliction->status == 16) Selected @endif
                                                            value="16">Offer Delivered</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="paid_amount">{{ __('Paid Amount:') }}</label>
                                                    <input id="paid_amount" name="paid_amount" readonly
                                                        value="{{ $s_appliction->paid_amount ?? '0' }}"
                                                        type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Feedback</label>
                                                    <textarea name="feedback" rows="5" class="editor form-control" placeholder="Write feedback here"></textarea>
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
    <script>
        $('.select2').select2();

        $(document).ready(function() {
            let total_programs = @json(count($selectedProgramIds));

            $('#service_charge').on('input', function() {
                var serviceCharge = parseFloat($(this).val()) || 0;
                var originalTotal = parseFloat('{{ $s_appliction->application_fee }}') || 0;
                var newTotal = originalTotal + (serviceCharge * total_programs);

                if (newTotal % 1 === 0) {
                    $('#total_fee').val(newTotal);
                } else {
                    $('#total_fee').val(newTotal.toFixed(2));
                }
            });
        });
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
</body>

</html>
