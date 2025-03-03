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

    </style>

</head>

<body>
    <div class="container-scroller">
        @include('Backend.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('Backend.components.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="mt-4">
                        <h3 class="page-title">
                            Transaction History
                        </h3>



                        <div class="row">
                            <div class="col-sm-12 card-body table-responsive">
                                <table id="order-listing" class="table table-striped dataTable no-footer"
                                    role="grid" aria-describedby="order-listing_info">
                                    <thead>
                                        <tr role="row">
                                            {{-- <th>SL</th> --}}
                                            <th>Trxn ID</th>
                                            <th>App ID</th>
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
                                        @foreach ($transactionDetails as $transaction)
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
                                                    {{ $transaction->application_id ?? "No Id " }}
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
                                                    <a href="{{ route('admin.transaction_invoice', $transaction->transaction_id) }}"
                                                        class="btn text-primary" data-toggle="tooltip"
                                                        data-placement="top"
                                                        data-original-title="Invoice">
                                                        <i class="fa fa-solid fa-receipt"
                                                            aria-hidden="true"></i>
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


</body>

</html>
