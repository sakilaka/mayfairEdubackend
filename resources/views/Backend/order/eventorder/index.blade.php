<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Event Participants</title>
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
                            Event Participants
                        </h3>
                    </div>

                    <div class="row card">
                        <div class="col-sm-12 card-body table-responsive">
                            <table id="order-listing" class="table table-striped dataTable no-footer" role="grid"
                                aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th>SL</th>
                                        <th>Order</th>
                                        <th>Student Name</th>
                                        <th>Student Mobile</th>
                                        <th>Student Email</th>
                                        <th>Course Amount</th>
                                        <th>Payment</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr role="row" class="odd">
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td>{{ $event->order_number }}</td>
                                            <td>{{ $event->name }}</td>
                                            <td>{{ $event->mobile }}</td>
                                            <td>{{ $event->email }}</td>
                                            <td>{{ $event->total_amount }}</td>
                                            <td>
                                                @if ($event->payment_status == 'paid')
                                                    <span class="badge badge-success">Paid</span>
                                                @elseif($event->payment_status == 'unpaid')
                                                    <span class="badge badge-danger">Unpaid</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($event->status == 'new')
                                                    <span class="badge badge-info">New</span>
                                                @elseif($event->status == 'process')
                                                    <span class="badge badge-warning">Process</span>
                                                @elseif($event->status == 'delivered')
                                                    <span class="badge badge-success">Delivered</span>
                                                @elseif($event->status == 'cancel')
                                                    <span class="badge badge-danger">Cancel</span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <input type="hidden" value="{{ $event->id }}">
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

                {{-- Item delete modal --}}
                <div id="delete_modal_box" class="modal fade delete-modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <img src="{{ asset('backend/assets/images/warning.png') }}" alt=""
                                    width="50" height="46">
                                <h5 class="mt-3 mb-4">Are you sure want to delete this?</h5>
                                <div class="m-t-20 flex">
                                    <form action="{{ route('event.status.change.index') }}" method="POST"
                                        id="deleteForm">
                                        @csrf
                                        <h4 class="tx-success  tx-semibold mg-b-20 mt-2">Change Status</h4>
                                        <select class="form-control form-control-lg" name="status">
                                            <option value="">Select Status type</option>
                                            <option value="new">New</option>
                                            <option value="process">Process</option>
                                            <option value="delivered">Delivered</option>
                                            <option value="cancel">Cancel</option>
                                        </select>
                                        <input type="hidden" name="eventstatus_id" id="modal_data_id">
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

                @include('Backend.components.footer')
            </div>
        </div>
    </div>

    @include('Backend.components.script')
</body>

</html>
