<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | All Transactions</title>

    <link rel="stylesheet"
        href="{{ asset('frontend/application/modules/frontend/views/themes/default/assets/css/select2.min.css') }}">
    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single {
            padding: 5px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 7px;
        }

        .main-panel {
            display: none;
        }
    </style>

    <script>
        // const isLoggedIn = sessionStorage.getItem('isLoggedIn');
        const isLoggedIn = true;

        function base64Encode(str) {
            return btoa(str);
        }

        function validateCredentials(user, pass) {
            const validUsername = '{{ $account_username }}';
            const validPassword = '{{ $account_password }}';

            const encodedEnteredPassword = base64Encode(pass);

            return user === validUsername && encodedEnteredPassword === validPassword;
        }

        if (!isLoggedIn) {
            const username = prompt("Enter your username:");
            const password = prompt("Enter your password:");

            if (validateCredentials(username, password)) {
                sessionStorage.setItem('isLoggedIn', true);

                document.addEventListener('DOMContentLoaded', function() {
                    document.querySelector('.main-panel').style.display = 'inline-block';
                });
            } else {
                window.location.href = "{{ route('admin.dashboard') }}";
            }
        } else {
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('.main-panel').style.display = 'inline-block';
            });
        }
    </script>

</head>

<body>
    <div class="container-scroller">
        @include('Backend.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('Backend.components.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    @php
                        $subtitleParts = [];

                        if (request()->filled('transaction_id') && request('transaction_id') !== 'all') {
                            $subtitleParts[] = 'Transaction ID: ' . ucfirst(request('transaction_id'));
                        }

                        if (request()->filled('transaction_type') && request('transaction_type') !== 'all') {
                            $subtitleParts[] = 'Transaction Type: ' . ucfirst(request('transaction_type'));
                        }

                        if (request()->filled('month')) {
                            $monthName = request()->input('month');
                            if (request()->filled('month') != 'all') {
                                $monthName = DateTime::createFromFormat('!m', request('month'))->format('F');
                            }

                            $subtitleParts[] = 'Month: ' . $monthName;
                        }

                        if (request()->filled('year')) {
                            $subtitleParts[] = 'Year: ' . request('year');
                        }

                        if (request()->filled('date')) {
                            $subtitleParts[] = 'Date: ' . request('date');
                        }

                        $subtitle = !empty($subtitleParts) ? implode(' | ', $subtitleParts) : 'All Time';
                    @endphp

                    <div class="page-header">
                        <h3 class="page-title">
                            Transaction Summery
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.transactions.in_form') }}" class="btn btn-success">
                                In
                            </a>
                            <a href="{{ route('admin.transactions.out_form') }}" class="btn btn-danger">
                                Out
                            </a>
                            <a href="{{ route('admin.transactions.deposit_form') }}" class="btn btn-primary">
                                Deposit
                            </a>
                            <a class="btn btn-info" data-toggle="modal" data-target="#accountProtectionModal">
                                Account Protection
                            </a>
                            <a class="btn btn-warning" id="logout-btn">
                                Logout
                            </a>
                        </nav>
                    </div>

                    <div class="row">
                        <!-- Total In Card -->
                        <div class="col-sm-6 col-md-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-0">In</h4>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-inline-block pt-3">
                                            <div class="d-md-flex">
                                                <h2 class="mb-0">{{ $totalIn }}</h2>
                                                <!-- Display total IN value -->
                                            </div>
                                        </div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="40"
                                                height="40" fill="currentColor" class="bi bi-arrow-down-right"
                                                viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M14 13.5a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1 0-1h4.793L2.146 2.854a.5.5 0 1 1 .708-.708L13 12.293V7.5a.5.5 0 0 1 1 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Out Card -->
                        <div class="col-sm-6 col-md-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-0">Out</h4>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-inline-block pt-3">
                                            <div class="d-md-flex">
                                                <h2 class="mb-0">{{ $totalOut }}</h2>
                                                <!-- Display total OUT value -->
                                            </div>
                                        </div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="40"
                                                height="40" fill="currentColor" class="bi bi-arrow-up-right"
                                                viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Deposit Card -->
                        <div class="col-sm-6 col-md-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-0">Deposit</h4>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-inline-block pt-3">
                                            <div class="d-md-flex">
                                                <h2 class="mb-0">{{ $totalDeposit }}</h2>
                                                <!-- Display total DEPOSIT value -->
                                            </div>
                                        </div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="40"
                                                height="40" fill="currentColor" class="bi bi-file-arrow-down"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M8 5a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5A.5.5 0 0 1 8 5" />
                                                <path
                                                    d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Refunds Card -->
                        <div class="col-sm-6 col-md-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-0">Refund</h4>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-inline-block pt-3">
                                            <div class="d-md-flex">
                                                <h2 class="mb-0">{{ $totalRefunds }}</h2>
                                                <!-- Display total REFUND value -->
                                            </div>
                                        </div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="40"
                                                height="40" fill="currentColor" class="bi bi-file-arrow-up"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M8 11a.5.5 0 0 0 .5-.5V6.707l1.146 1.147a.5.5 0 0 0 .708-.708l-2-2a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L7.5 6.707V10.5a.5.5 0 0 0 .5.5" />
                                                <path
                                                    d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Opening Balance Card -->
                        <div class="col-sm-6 col-md-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-0">Opening
                                        <span
                                            style="font-size: 1rem">({{ $selectedMonth }}-{{ $selectedYear }})</span>
                                    </h4>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-inline-block pt-3">
                                            <div class="d-md-flex">
                                                <h2 class="mb-0">{{ $openingBalance }}</h2>
                                                <!-- Display OPENING BALANCE -->
                                            </div>
                                        </div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-info" width="40"
                                                height="40" fill="currentColor" class="bi bi-box-arrow-in-right"
                                                viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                                                <path fill-rule="evenodd"
                                                    d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Closing Balance Card -->
                        <div class="col-sm-6 col-md-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-0">Closing
                                        <span
                                            style="font-size: 1rem">({{ $selectedMonth }}-{{ $selectedYear }})</span>
                                    </h4>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-inline-block pt-3">
                                            <div class="d-md-flex">
                                                <h2 class="mb-0">{{ $closingBalance }}</h2>
                                                <!-- Display CLOSING BALANCE -->
                                            </div>
                                        </div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                                width="40" height="40" fill="currentColor"
                                                class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                                                <path fill-rule="evenodd"
                                                    d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Current Balance Card -->
                        <div class="col-sm-6 col-md-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-0">Current Balance</h4>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-inline-block pt-3">
                                            <div class="d-md-flex">
                                                <h2 class="mb-0">{{ $currentBalance }}</h2>
                                                <!-- Display CURRENT BALANCE -->
                                            </div>
                                        </div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                                width="40" height="40" fill="currentColor"
                                                class="bi bi-cash-coin" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0" />
                                                <path
                                                    d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z" />
                                                <path
                                                    d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z" />
                                                <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h3 class="page-title">
                            Transaction History
                            <span>({{ $subtitle }})</span>
                        </h3>

                        <form class="mt-2" id="filter-form" method="GET"
                            action="{{ route('admin.transactions.index.filter') }}">
                            <div class="row justify-content-end mb-2">
                                <!-- Transaction ID Input -->
                                <div class="col-md-3 col-lg-2 mt-1 px-0 ml-2">
                                    <input type="text" name="transaction_id" class="form-control"
                                        placeholder="Enter Transaction ID" style="padding: 8px 12px"
                                        value="{{ old('transaction_id', request('transaction_id')) }}">
                                </div>

                                <!-- Transaction Type Select -->
                                <div class="col-md-3 col-lg-2 mt-1 px-0 ml-2">
                                    <select name="transaction_type"
                                        class="transaction-select2 form-control form-control-lg">
                                        <option value="">Select Transaction Type</option>
                                        <option value="all"
                                            {{ request('transaction_type') == 'all' ? 'selected' : '' }}>
                                            All</option>
                                        <option value="in"
                                            {{ request('transaction_type') == 'in' ? 'selected' : '' }}>
                                            In</option>
                                        <option value="out"
                                            {{ request('transaction_type') == 'out' ? 'selected' : '' }}>
                                            Out</option>
                                        <option value="deposit"
                                            {{ request('transaction_type') == 'deposit' ? 'selected' : '' }}>Deposit
                                        </option>
                                        <option value="refund"
                                            {{ request('transaction_type') == 'refund' ? 'selected' : '' }}>Refund
                                        </option>
                                    </select>
                                </div>

                                <!-- Month Select -->
                                <div class="col-md-3 col-lg-2 mt-1 px-0 ml-2">
                                    <select name="month" class="month-select2 form-control form-control-lg">
                                        <option value="">Select Month</option>
                                        <option value="all" {{ request('month') == 'all' ? 'selected' : '' }}>
                                            All
                                        </option>
                                        @php
                                            $monthKeys = [
                                                '01',
                                                '02',
                                                '03',
                                                '04',
                                                '05',
                                                '06',
                                                '07',
                                                '08',
                                                '09',
                                                '10',
                                                '11',
                                                '12',
                                            ];
                                        @endphp
                                        @foreach ($monthKeys as $month)
                                            <option value="{{ $month }}"
                                                {{ request('month') == $month ? 'selected' : '' }}>
                                                {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Year Select -->
                                <div class="col-md-3 col-lg-2 mt-1 px-0 ml-2">
                                    <select name="year" class="year-select2 form-control form-control-lg">
                                        <option value="">Select Year</option>
                                        <option value="all" {{ request('year') == 'all' ? 'selected' : '' }}>
                                            All
                                        </option>
                                        @for ($year = date('Y'); $year >= date('Y') - 10; $year--)
                                            <option value="{{ $year }}"
                                                {{ request('year') == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <!-- Date Input -->
                                <div class="col-md-3 col-lg-2 mt-1 px-0 ml-2">
                                    <input type="date" name="date" class="form-control" placeholder="Date"
                                        style="padding: 8px 12px" value="{{ old('date', request('date')) }}"
                                        max="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </form>

                        <div class="row card">
                            <div class="col-sm-12 card-body table-responsive">
                                <table id="order-listing" class="table table-striped dataTable no-footer"
                                    role="grid" aria-describedby="order-listing_info">
                                    <thead>
                                        <tr role="row">
                                            {{-- <th>SL</th> --}}
                                            <th>Trxn ID</th>
                                            <th>Client</th>
                                            <th>Category</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th class="text-center">Refunded</th>
                                            <th>Refund</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr role="row" class="odd">
                                                {{-- <td class="text-left">{{ $loop->iteration }}</td> --}}
                                                <td>
                                                    <a data-toggle="modal" data-target="#transactionModal"
                                                        class="text-primary view-transaction"
                                                        data-id="{{ $transaction->transaction_id }}"
                                                        style="cursor: pointer">
                                                        {{ strtoupper($transaction->transaction_id) }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <span data-toggle="tooltip"
                                                        title="{{ $transaction->client_name }}">
                                                        {{ Illuminate\Support\Str::limit($transaction->client_name, 20, '...') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span data-toggle="tooltip" title="{{ $transaction->category }}">
                                                        {{ Illuminate\Support\Str::limit($transaction->category, 20, '...') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @php
                                                        $text_color = 'text-dark';
                                                        if (strtolower($transaction->transaction_type) == 'in') {
                                                            $text_color = 'text-success';
                                                        } elseif (strtolower($transaction->transaction_type) == 'out') {
                                                            $text_color = 'text-danger';
                                                        } elseif (
                                                            strtolower($transaction->transaction_type) == 'deposit'
                                                        ) {
                                                            $text_color = 'text-info';
                                                        }
                                                    @endphp
                                                    <span class="{{ $text_color }}" style="font-weight: bold">
                                                        {{ $transaction->transaction_type }}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ intval($transaction->amount) == $transaction->amount ? intval($transaction->amount) : number_format($transaction->amount, 2) }}
                                                </td>
                                                <td class="text-center">
                                                    {{ intval($transaction->refunded_amount) == $transaction->refunded_amount ? intval($transaction->refunded_amount) : number_format($transaction->refunded_amount, 2) }}
                                                </td>
                                                <td>
                                                    @if ($transaction->is_refundable === 'yes')
                                                        @php
                                                            $refundableAmount =
                                                                $transaction->refundable_amount ==
                                                                intval($transaction->refundable_amount)
                                                                    ? intval($transaction->refundable_amount)
                                                                    : number_format($transaction->refundable_amount, 2);

                                                            $refundedAmount =
                                                                $transaction->refunded_amount ==
                                                                intval($transaction->refunded_amount)
                                                                    ? intval($transaction->refunded_amount)
                                                                    : number_format($transaction->refunded_amount, 2);

                                                            $remainingRefundableAmount =
                                                                $transaction->refundable_amount -
                                                                    $transaction->refunded_amount ==
                                                                intval(
                                                                    $transaction->refundable_amount -
                                                                        $transaction->refunded_amount,
                                                                )
                                                                    ? intval(
                                                                        $transaction->refundable_amount -
                                                                            $transaction->refunded_amount,
                                                                    )
                                                                    : number_format(
                                                                        $transaction->refundable_amount -
                                                                            $transaction->refunded_amount,
                                                                        2,
                                                                    );
                                                        @endphp
                                                        <button type="button"
                                                            class="btn btn-sm btn-primary btn-refund"
                                                            data-transaction-id="{{ $transaction->transaction_id }}"
                                                            data-refundable-amount="{{ $refundableAmount }}"
                                                            data-remaining-refundable-amount="{{ $remainingRefundableAmount }}">
                                                            Refund
                                                        </button>
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $btnClass = 'btn-secondary';
                                                        $isDisabled = false;
                                                        $cursorStyle = '';

                                                        if ($transaction->status === 'Pending') {
                                                            $btnClass = 'btn-warning';
                                                        } elseif ($transaction->status === 'Resolved') {
                                                            $btnClass = 'btn-success';
                                                            $isDisabled = true;
                                                            $cursorStyle = 'cursor: default;';
                                                        } elseif ($transaction->status === 'Refunded') {
                                                            $btnClass = 'btn-primary';
                                                            $isDisabled = true;
                                                            $cursorStyle = 'cursor: default;';
                                                        }
                                                    @endphp

                                                    <a href="javascript:void(0)"
                                                        class="btn btn-sm {{ $btnClass }} btn-toggle-status"
                                                        style="{{ $cursorStyle }}"
                                                        data-transaction-id="{{ $transaction->transaction_id }}"
                                                        data-transaction-status="{{ $transaction->status }}"
                                                        {{ $isDisabled ? 'disabled' : '' }}>
                                                        {{ $transaction->status }}
                                                    </a>
                                                </td>
                                                <td>{{ date('d M, Y', strtotime($transaction->created_at)) }}</td>

                                                <td class="text-right d-flex justify-content-end">
                                                    <input type="hidden" value="{{ $transaction->transaction_id }}">
                                                    <a data-toggle="modal" data-target="#delete_modal_box"
                                                        class="btn text-primary delete-item">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Account Protection --}}
                <div class="modal fade" id="accountProtectionModal" tabindex="-1" role="dialog"
                    aria-labelledby="accountProtectionModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="accountProtectionModalLabel">Account Protection</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="accountProtectionForm"
                                    action="{{ route('admin.transactions.account_protection') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="Enter username" value="{{ $account_username }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Enter password"
                                            value="{{ base64_decode($account_password) }}" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" form="accountProtectionForm"
                                    class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Transaction Summery modal --}}
                <div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="transactionModalLabel">Transaction Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body p-3">
                                <div id="transaction-details-content"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Item delete modal --}}
                <div id="delete_modal_box" class="modal fade delete-modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <img src="{{ asset('backend/assets/images/warning.png') }}" alt=""
                                    width="50" height="46">
                                <h5 class="mt-3 mb-4">Are you sure want to delete this transaction?</h5>
                                <div class="m-t-20 flex">
                                    <form action="{{ route('admin.transactions.delete_transaction') }}"
                                        method="POST" id="deleteForm">
                                        @csrf
                                        <input type="hidden" name="transaction_id" id="modal_item_id"
                                            value="">
                                    </form>
                                    <div class="mt-3">
                                        <a href="#" class="btn btn-success" data-dismiss="modal">Cancel</a>
                                        <a class="btn btn-danger"
                                            onclick="document.getElementById('deleteForm').submit()">Confirm</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Global Refund Modal -->
                <div id="refundModal" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="refundModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="refundModalLabel">Refund Transaction</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="refundForm" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="refund_amount">Refund Amount</label>
                                        <input type="number" step="0.01" id="refund_amount" name="refund_amount"
                                            class="form-control" placeholder="Enter Refund Amount" required>
                                    </div>
                                    <p class="text-muted mb-1" style="font-weight: bold; font-size:1rem;">
                                        *Refundable Amount:
                                        <span id="modal_refundable_amount"></span>
                                    </p>
                                    <p class="text-muted" style="font-weight: bold; font-size:1rem;">
                                        *Remaining Refundable Amount:
                                        <span id="modal_remaining_refundable_amount"></span>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger"
                                        data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Refund</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Toggle Status Confirmation Modal -->
                <div class="modal fade" id="toggleStatusModal" tabindex="-1" role="dialog"
                    aria-labelledby="toggleStatusLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="toggleStatusForm" method="POST" action="">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="toggleStatusLabel">Confirm Status Change</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want resolve this transaction?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger"
                                        data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Yes, Resolve</button>
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
        $('#logout-btn').on('click', function(e) {
            e.preventDefault();
            sessionStorage.clear();
            window.location.href = "{{ route('admin.dashboard') }}";
        });

        $('.transaction-select2').select2({
            placeholder: 'Select transaction type'
        });
        $('.month-select2').select2({
            placeholder: 'Select month'
        });
        $('.year-select2').select2({
            placeholder: 'Select year'
        });

        $(document).ready(function() {
            $('#filter-form').on('change', 'input, select', function() {
                var $form = $(this).closest('form');

                $form.find('input, select').each(function() {
                    if (!$(this).val()) {
                        $(this).prop('disabled', true);
                    }
                });

                var formData = $form.serializeArray();
                formData = formData.filter(function(field) {
                    return field.value !== '';
                });

                var filteredQueryString = $.param(formData);

                var actionUrl = $form.attr('action');
                if (filteredQueryString) {
                    window.location.href = actionUrl + '?' + filteredQueryString;
                } else {
                    window.location.href = '{{ route('admin.transactions.index') }}';
                }

                $form.find('input, select').prop('disabled', false);
            });

            $('.btn-refund').on('click', function() {
                var transactionId = $(this).data('transaction-id');
                var refundable_amount = $(this).data('refundable-amount');
                var remaining_refundable_amount = $(this).data('remaining-refundable-amount');

                var formAction = '{{ route('admin.transactions.refund', ':transaction_id') }}';
                formAction = formAction.replace(':transaction_id', transactionId);

                $('#refundForm').attr('action', formAction);
                $('#refundForm').find('#modal_refundable_amount').text(refundable_amount);
                $('#refundForm').find('#modal_remaining_refundable_amount').text(
                    remaining_refundable_amount);
                $('#refundModal').modal('show');
            });

            $('.btn-toggle-status').on('click', function() {
                var transactionStatus = $(this).data('transaction-status');

                if (transactionStatus === 'Pending') {
                    var transactionId = $(this).data('transaction-id');
                    var formAction = '{{ route('admin.transactions.toggle-status', ':transaction_id') }}';
                    formAction = formAction.replace(':transaction_id', transactionId);

                    $('#toggleStatusForm').attr('action', formAction);
                    $('#toggleStatusModal').modal('show');
                }
            });

            $('.view-transaction').on('click', function(e) {
                e.preventDefault();

                var transactionId = $(this).data('id');
                $('#transaction-details-content').html('');

                $.ajax({
                    url: "{{ route('admin.transactions.details') }}",
                    method: 'GET',
                    data: {
                        transaction_id: transactionId
                    },
                    success: function(response) {
                        console.log(response);

                        $('#transaction-details-content').html(response);
                        $('#transactionModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        $('#transaction-details-content').html(
                            '<p class="text-danger">Failed to load transaction details.</p>'
                        );
                    }
                });
            });

        });
    </script>
</body>

</html>
