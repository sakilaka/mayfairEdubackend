<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Deposit - Transaction</title>
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
                            Deposit - Transaction
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.transactions.index') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All Transactions</a>
                        </nav>
                    </div>

                    <div class="row card">
                        <div class="col-md-12 p-4 form-container">
                            @php
                                $action = '#';
                                if ($transaction_type == 'in') {
                                    $action = route('admin.transactions.in_form_update');
                                } elseif ($transaction_type == 'out') {
                                    $action = route('admin.transactions.out_form_update');
                                } elseif ($transaction_type == 'deposit') {
                                    $action = route('admin.transactions.deposit_form_update');
                                }
                            @endphp
                            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <!-- Client Name Field -->
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label for="client_name">Client Name</label>
                                            <input type="text" id="client_name"
                                                class="form-control @error('client_name') is-invalid @enderror"
                                                name="client_name" placeholder="Enter Client Name"
                                                value="{{ old('client_name') }}">
                                            @error('client_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Phone Number Field -->
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label for="client_phone">Phone Number</label>
                                            <input type="text" id="client_phone"
                                                class="form-control @error('client_phone') is-invalid @enderror"
                                                name="client_phone" placeholder="Enter Phone Number"
                                                value="{{ old('client_phone') }}">
                                            @error('client_phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Type Field -->
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label for="category">Type <span class="text-danger">*</span></label>
                                            <select id="category"
                                                class="form-control form-control-lg @error('category') is-invalid @enderror"
                                                name="category" required>
                                                <option value="">Select Type</option>
                                                <option value="Ranji Deposit"
                                                    {{ old('category') == 'Ranji Deposit' ? 'selected' : '' }}>
                                                    Ranji Deposit
                                                </option>
                                                <option value="Rakin Deposit"
                                                    {{ old('category') == 'Rakin Deposit' ? 'selected' : '' }}>
                                                    Rakin Deposit
                                                </option>
                                                <option value="Student Deposit"
                                                    {{ old('category') == 'Student Deposit' ? 'selected' : '' }}>
                                                    Student Deposit
                                                </option>
                                                <option value="Worker Deposit"
                                                    {{ old('category') == 'Worker Deposit' ? 'selected' : '' }}>
                                                    Worker Deposit
                                                </option>
                                                <option value="Other"
                                                    {{ old('category') == 'Other Deposit' ? 'selected' : '' }}>Other
                                                </option>
                                            </select>
                                            @error('category')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Title Field -->
                                    <div
                                        class="col-12 col-md-6 col-lg-3 title-container {{ old('category') == 'Other' ? '' : 'd-none' }}">
                                        <div class="form-group">
                                            <label for="title">Title <span class="text-danger">*</span></label>
                                            <input type="text" id="title"
                                                class="form-control @error('title') is-invalid @enderror" name="title"
                                                placeholder="Enter Title" value="{{ old('title') }}"
                                                {{ old('category') == 'Other' ? 'required' : '' }}>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Amount Field -->
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label for="amount">Amount <span class="text-danger">*</span></label>
                                            <input type="number" step="0.01" id="amount"
                                                class="form-control @error('amount') is-invalid @enderror"
                                                name="amount" placeholder="Enter Amount" value="{{ old('amount') }}"
                                                required>
                                            @error('amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Refundable Field -->
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label for="is_refundable">Refundable? <span
                                                    class="text-danger">*</span></label>
                                            <select id="is_refundable"
                                                class="form-control form-control-lg @error('is_refundable') is-invalid @enderror"
                                                name="is_refundable" required>
                                                <option value="" disabled>Select Option</option>
                                                <option value="yes"
                                                    {{ old('is_refundable') == 'yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="no"
                                                    {{ old('is_refundable') == 'no' ? 'selected' : '' }}>No</option>
                                            </select>
                                            @error('is_refundable')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Refundable Amount Field -->
                                    <div class="col-12 col-md-6 col-lg-3" id="refundable_amount_container"
                                        style="{{ old('is_refundable') == 'yes' ? '' : 'display:none;' }}">
                                        <div class="form-group">
                                            <label for="refundable_amount">Refunded Amount <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" step="0.01" id="refundable_amount"
                                                class="form-control @error('refundable_amount') is-invalid @enderror"
                                                name="refundable_amount" placeholder="Enter Refunded Amount"
                                                value="{{ old('refundable_amount') }}"
                                                {{ old('is_refundable') == 'yes' ? 'required' : '' }}>
                                            @error('refundable_amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Status Field -->
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select id="status"
                                                class="form-control form-control-lg @error('status') is-invalid @enderror"
                                                name="status" required>
                                                <option value="" selected>Select Status</option>
                                                <option value="Pending"
                                                    {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Resolved"
                                                    {{ old('status') == 'Resolved' ? 'selected' : '' }}>Resolved
                                                </option>
                                            </select>
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Description Field -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description">Description (Optional)</label>
                                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"
                                                placeholder="Enter Description">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary-bg">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                @include('Backend.components.footer')
            </div>
        </div>
    </div>

    @include('Backend.components.script')

    <script src="{{ asset('backend/lib/select2/js/select2.min.js') }}"></script>
    <script>
        $('.select2').select2({
            placeholder: 'Select an option'
        });

        $(document).ready(function() {
            const $isRefundableSelect = $('#is_refundable');
            const $refundableAmountContainer = $('#refundable_amount_container');
            const $refundableAmountInput = $('#refundable_amount');
            const $typeSelect = $('#category');
            const $titleContainer = $('.title-container');
            const $titleField = $('#title');

            // Handle the Refundable dropdown change
            $isRefundableSelect.on('change', function() {
                if ($(this).val() === 'yes') {
                    $refundableAmountContainer.show();
                    $refundableAmountInput.prop('required', true);
                } else {
                    $refundableAmountContainer.hide();
                    $refundableAmountInput.prop('required', false);
                }
            });

            // Handle the Type dropdown change
            $typeSelect.on('change', function() {
                if ($(this).val() === 'Other') {
                    $titleContainer.removeClass('d-none');
                    $titleField.prop('required', true);
                } else {
                    $titleContainer.addClass('d-none');
                    $titleField.prop('required', false);
                }
            });

            // Initial setup based on current selections
            if ($isRefundableSelect.val() === 'yes') {
                $refundableAmountContainer.show();
                $refundableAmountInput.prop('required', true);
            } else {
                $refundableAmountContainer.hide();
                $refundableAmountInput.prop('required', false);
            }

            if ($typeSelect.val() === 'Other') {
                $titleContainer.removeClass('d-none');
                $titleField.prop('required', true);
            } else {
                $titleContainer.addClass('d-none');
                $titleField.prop('required', false);
            }
        });
    </script>
</body>

</html>
