<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Out - Transaction</title>
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
                            Out - Transaction
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
                                    <div class="col-12 col-md-6">
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
                                    <div class="col-12 col-md-6">
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
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="category">Type <span class="text-danger">*</span></label>
                                            <select id="category"
                                                class="form-control form-control-lg @error('category') is-invalid @enderror"
                                                name="category" required>
                                                <option value="">Select Type</option>
                                                <option value="Salary"
                                                    {{ old('category') == 'Salary' ? 'selected' : '' }}>Salary</option>
                                                <option value="Rent"
                                                    {{ old('category') == 'Rent' ? 'selected' : '' }}>Rent</option>
                                                <option value="Commission"
                                                    {{ old('category') == 'Commission' ? 'selected' : '' }}>Commission</option>
                                                <option value="Assets Cost"
                                                    {{ old('category') == 'Assets Cost' ? 'selected' : '' }}>Assets Cost
                                                </option>
                                                <option value="Ranji Withdraw"
                                                    {{ old('category') == 'Ranji Withdraw' ? 'selected' : '' }}>Ranji
                                                    Withdraw</option>
                                                <option value="Rakin Withdraw"
                                                    {{ old('category') == 'Rakin Withdraw' ? 'selected' : '' }}>Rakin
                                                    Withdraw</option>
                                                <option value="Family Withdraw"
                                                    {{ old('category') == 'Family Withdraw' ? 'selected' : '' }}>Family
                                                    Withdraw</option>
                                                <option value="University Payment"
                                                    {{ old('category') == 'University Payment' ? 'selected' : '' }}>
                                                    University Payment</option>
                                                <option value="Company Payment"
                                                    {{ old('category') == 'Company Payment' ? 'selected' : '' }}>
                                                    Company Payment</option>
                                                <option value="Other"
                                                    {{ old('category') == 'Other Withdraw' ? 'selected' : '' }}>Other
                                                    Withdraw</option>
                                            </select>

                                            @error('category')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Title Field -->
                                    <div
                                        class="col-12 col-md-6 title-container {{ old('category') == 'Other' ? '' : 'd-none' }}">
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
                                    <div class="col-12 col-md-6">
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

                                    <!-- Status Field -->
                                    <div class="col-12 col-md-6">
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
            const $typeSelect = $('#category');
            const $titleContainer = $('.title-container');
            const $titleField = $('#title');

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
