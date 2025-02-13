<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Application Agreement Create</title>

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
                            Application Agreement
                        </h3>

                        {{-- <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.application_order_print', $agreement->id) }}"
                                class="btn btn-primary">
                                <i class="fa fa-print mr-1"></i>Print
                            </a>
                        </nav> --}}
                    </div>


                    <div class="">
                        <div class="">
                            <div class="card px-2">
                                <form action="{{ route('admin.agreement.store') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <!-- Party A (Applicant) Information -->
                                            <div class="row">
                                                 <div class="form-group col-md-4 col-12">
                                                    <label class="form-control-label">Application: <span
                                                            class="text-danger">*</span></label>
                                                    {{-- <input type="text" name="name" class="form-control"
                                                        placeholder="Enter Full Name" required> --}}
                                                        <select class="form-control" name="application_id" id="">
                                                            <option value="">Select application</option>
                                                            @foreach ($agreement as $item)
                                                                <option value="{{ $item->id }}">{{ $item->id }}</option>
                                                            @endforeach
                                                        </select>

                                                </div>
                                                <div class="form-group col-md-4 col-12">
                                                    <label class="form-control-label">Full Name: <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="Enter Full Name" required>

                                                </div>

                                                <div class="form-group col-md-4 col-12">
                                                    <label class="form-control-label">Passport Number:</label>
                                                    <input type="text" name="passport_number" class="form-control"
                                                        placeholder="Enter Passport Number">
                                                </div>
                                                <div class="form-group col-md-4 col-12">
                                                    <label class="form-control-label">Present Address:</label>
                                                    <input type="text" name="present_address" class="form-control"
                                                        placeholder="Enter Present Address">
                                                </div>
                                                <div class="form-group col-md-4 col-12">
                                                    <label class="form-control-label">Permanent Address:</label>
                                                    <input type="text" name="permanent_address" class="form-control"
                                                        placeholder="Enter Permanent Address">
                                                </div>
                                                <div class="form-group col-md-4 col-12">
                                                    <label class="form-control-label">Spouse Name (Optional):</label>
                                                    <input type="text" name="spouse_name" class="form-control"
                                                        placeholder="Enter Spouse Name">
                                                </div>
                                                <div class="form-group col-md-4 col-12">
                                                    <label class="form-control-label">Spouse Passport Number
                                                        (Optional):</label>
                                                    <input type="text" name="spouse_passport_number"
                                                        class="form-control" placeholder="Enter Spouse Passport Number">
                                                </div>
                                                <div class="form-group col-md-4 col-12">
                                                    <label class="form-control-label">Children Names (Optional):</label>
                                                    <input type="text" name="children_names" class="form-control"
                                                        placeholder="Enter Children Names">
                                                </div>
                                                <div class="form-group col-md-4 col-12">
                                                    <label class="form-control-label">Children Passport Numbers
                                                        (Optional):</label>
                                                    <input type="text" name="children_passport_numbers"
                                                        class="form-control"
                                                        placeholder="Enter Children Passport Numbers">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Destination and Services -->
                                        <div class="form-group">
                                            <label class="form-control-label">Study Destination:</label>
                                            <select name="study_destination" class="form-control">
                                                <option value="Finland">Finland</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Services Required:</label><br>
                                            <input type="checkbox" name="services[]" value="Overseas Study Consulting">
                                            Overseas Study Consulting<br>
                                            <input type="checkbox" name="services[]" value="Documents Assessment">
                                            Documents Assessment<br>
                                            <input type="checkbox" name="services[]" value="Visa Processing"> Visa
                                            Processing<br>
                                            <input type="checkbox" name="services[]" value="Accommodation Assistance">
                                            Accommodation Assistance
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Company Contact Number (Fixed: +372 5870
                                                0600)</label>
                                        </div>

                                        <!-- Payment Details -->
                                        <div class="row">
                                            <div class="form-group col-md-4 col-12">
                                                <label class="form-control-label">File Opening Fee:</label>
                                                <input type="number" name="file_opening_fee" class="form-control"
                                                    value="100">
                                            </div>
                                            <div class="form-group col-md-4 col-12">
                                                <label class="form-control-label">Application Fees/Union Fees:</label>
                                                <input type="number" name="application_fees" class="form-control"
                                                    value="100">
                                            </div>
                                            <div class="form-group col-md-4 col-12">
                                                <label class="form-control-label">After Admission Service
                                                    Charge:</label>
                                                <input type="number" name="admission_service_charge"
                                                    class="form-control" value="100">
                                            </div>
                                            <div class="form-group col-md-4 col-12">
                                                <label class="form-control-label">First-Year Tuition Fees:</label>
                                                <input type="number" name="tuition_fee" class="form-control"
                                                    value="5000">
                                            </div>
                                            <div class="form-group col-md-4 col-12">
                                                <label class="form-control-label">Health Insurance (1st Year):</label>
                                                <input type="number" name="health_insurance" class="form-control"
                                                    value="200">
                                            </div>
                                            <div class="form-group col-md-4 col-12">
                                                <label class="form-control-label">Residence Permit/Embassy
                                                    Fees:</label>
                                                <input type="number" name="residence_permit" class="form-control"
                                                    value="350">
                                            </div>
                                            <div class="form-group col-md-4 col-12">
                                                <label class="form-control-label">VFS Fees (Per Applicant):</label>
                                                <input type="number" name="vfs_fee" class="form-control"
                                                    value="70">
                                            </div>
                                            <div class="form-group col-md-4 col-12">
                                                <label class="form-control-label">Travel, Food & Accommodation for
                                                    India:</label>
                                                <input type="number" name="travel_food" class="form-control"
                                                    value="500">
                                            </div>
                                            <div class="form-group col-md-4 col-12">
                                                <label class="form-control-label">Air Ticket after Visa:</label>
                                                <input type="number" name="air_ticket" class="form-control"
                                                    value="850">
                                            </div>
                                            <div class="form-group col-md-4 col-12">
                                                <label class="form-control-label">Final Service Fee after Visa:</label>
                                                <input type="number" name="final_service" class="form-control"
                                                    value="1000">
                                            </div>
                                            <div class="form-group col-md-4 col-12">
                                                <label class="form-control-label">House Rent + Deposit:</label>
                                                <input type="number" name="house_rent" class="form-control"
                                                    value="600">
                                            </div>

                                            <div class="form-group col-md-4 col-12">
                                                <label class="form-control-label">Total Estimated Expenses:</label>
                                                <input type="number" name="admission_service_charge"
                                                    class="form-control" value="">
                                            </div>
                                        </div>

                                        <!-- Bank Statement Requirement -->
                                        <div class="form-group">
                                            <label class="form-control-label">Bank Statement Confirmation:</label>
                                            <select name="bank_statement_confirmation" class="form-control">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-control-label">Amount Required (Fixed: 9600
                                                Euros)</label>
                                        </div>

                                        <!-- Refund Policy -->
                                        <div class="form-group">
                                            <input type="checkbox" name="refund_acknowledgment"> Refund Acknowledgment
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" name="exchange_rate_policy"> Exchange Rate Policy
                                            Agreement
                                        </div>

                                        <!-- Consultant Information -->
                                        <div class="form-group">
                                            <label class="form-control-label">Consultant Name: Mohammed Nurul Islam
                                                Khan</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Company Name: Mayfair Global
                                                Education</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Company Address: Vindi 9-2,
                                                Tallinn-11315, Estonia</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Company Contact Number (Fixed: +372 5870
                                                0600)</label>
                                        </div>

                                        <!-- Agreement Terms & Conditions -->
                                        <div class="form-group">
                                            <input type="checkbox" name="applicant_obligations"> Applicant Obligations
                                            Agreement
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" name="consultant_obligations"> Consultant
                                            Obligations Agreement
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" name="consultant_obligations"> Liability for Breach
                                            Agreement
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" name="consultant_obligations"> Force Majeure Clause
                                            Agreement
                                        </div>

                                        <!-- Signature & Date -->
                                        <div class="form-group">
                                            <label class="form-control-label">Applicant Signature:</label>
                                            <input type="text" name="applicant_signature" class="form-control"
                                                placeholder="Digital Signature">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Consultant Signature:</label>
                                            <input type="text" name="consultant_signature" class="form-control"
                                                placeholder="Digital Signature">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Agreement Date (Auto-generated):</label>
                                            <input type="date" name="agreement_date" class="form-control"
                                                value="<?= date('Y-m-d') ?>">
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>



                            </div>

                            @include('Backend.components.footer')
                        </div>
                    </div>
                </div>

                @include('Backend.components.script')
</body>

</html>
