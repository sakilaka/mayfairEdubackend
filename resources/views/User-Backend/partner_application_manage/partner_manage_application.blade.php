<!DOCTYPE html>
<html lang="en">

<head>
    @include('User-Backend.components.head')
    <title>{{ env('APP_NAME') }} | Assigned Application</title>
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
                            Assigned Application
                        </h3>

                        <nav aria-label="breadcrumb">
                            <div class="d-flex justify-content-between">
                                <select name="payment_status_filter" id="payment_status_filter"
                                    class="ml-3 form-control form-control-lg">
                                    <option value="">Select Payment Status</option>
                                    @php
                                        $paymentStatusLabels = [
                                            0 => 'Unpaid',
                                            1 => 'Paid',
                                        ];
                                    @endphp
                                    @foreach ($paymentStatusLabels as $key => $status)
                                        <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>

                                <select name="status_filter" id="status_filter"
                                    class="ml-3 form-control form-control-lg">
                                    <option value="">Select Status</option>
                                    @php
                                        $statusLabels = [
                                            0 => 'Not Complete',
                                            1 => 'Processing',
                                            2 => 'Approved',
                                            3 => 'Cancel',
                                            4 => 'Not Submitted',
                                            5 => 'Submitted',
                                            6 => 'Pending',
                                            7 => 'E-documents Qualified',
                                            8 => 'Waiting Processing',
                                            9 => 'Processing',
                                            10 => 'More Documents Needed',
                                            11 => 'Re-Submitted',
                                            12 => 'Rejected',
                                            13 => 'Transferred',
                                            14 => 'Accepted',
                                            15 => 'E-offer Delivered',
                                            16 => 'Offer Delivered',
                                        ];
                                    @endphp
                                    @foreach ($statusLabels as $key => $status)
                                        <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </nav>
                    </div>

                    <div class="row card">
                        <div class="col-sm-12 card-body table-responsive">
                            <table id="order-listing" class="table dataTable-export table-striped dataTable no-footer"
                                role="grid" aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th class="text-left">SL</th>
                                        <th>Appliction ID</th>
                                        <th>User Name</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">Application Date</th>
                                        <th class="text-center">Paid Status</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applications as $application)
                                        <tr role="row" class="odd">
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ route('frontend.application-details', $application->id) }}"
                                                    style="color: var(--btn_primary_color)" data-toggle="tooltip"
                                                    data-placement="top" data-original-title="View Application Details">
                                                    {{ $application->application_code }}
                                                </a>
                                            </td>
                                            <td>{{ $application->first_name . ' ' . $application->middle_name . ' ' . $application->last_name }}
                                            </td>
                                            <td>{{ $application->phone }}</td>
                                            <td>{{ date('d M, Y', strtotime($application->created_at)) }}</td>
                                            <td>
                                                @if ($application->payment_status == 1)
                                                    <span class="badge badge-success">Paid</span>
                                                @else
                                                    <span class="badge badge-danger">Unpaid</span>
                                                @endif
                                            </td>
                                            <td class="">
                                                @php
                                                    $statusLabels = [
                                                        0 => [
                                                            'label' => 'Not Complete',
                                                            'badge' => 'badge-info',
                                                        ],
                                                        1 => [
                                                            'label' => 'Processing',
                                                            'badge' => 'badge-info',
                                                        ],
                                                        2 => [
                                                            'label' => 'Approved',
                                                            'badge' => 'badge-success',
                                                        ],
                                                        3 => [
                                                            'label' => 'Cancel',
                                                            'badge' => 'badge-danger',
                                                        ],
                                                        4 => [
                                                            'label' => 'Not Submitted',
                                                            'badge' => 'badge-info',
                                                        ],
                                                        5 => [
                                                            'label' => 'Submitted',
                                                            'badge' => 'badge-info',
                                                        ],
                                                        6 => [
                                                            'label' => 'Pending',
                                                            'badge' => 'badge-warning',
                                                        ],
                                                        7 => [
                                                            'label' => 'E-documents Qualified',
                                                            'badge' => 'badge-info',
                                                        ],
                                                        8 => [
                                                            'label' => 'Waiting Processing',
                                                            'badge' => 'badge-warning',
                                                        ],
                                                        9 => [
                                                            'label' => 'Processing',
                                                            'badge' => 'badge-info',
                                                        ],
                                                        10 => [
                                                            'label' => 'More Documents Needed',
                                                            'badge' => 'badge-info',
                                                        ],
                                                        11 => [
                                                            'label' => 'Re-Submitted',
                                                            'badge' => 'badge-info',
                                                        ],
                                                        12 => [
                                                            'label' => 'Rejected',
                                                            'badge' => 'badge-danger',
                                                        ],
                                                        13 => [
                                                            'label' => 'Transferred',
                                                            'badge' => 'badge-info',
                                                        ],
                                                        14 => [
                                                            'label' => 'Accepted',
                                                            'badge' => 'badge-success',
                                                        ],
                                                        15 => [
                                                            'label' => 'E-offer Delivered',
                                                            'badge' => 'badge-success',
                                                        ],
                                                        16 => [
                                                            'label' => 'Offer Delivered',
                                                            'badge' => 'badge-success',
                                                        ],
                                                    ];
                                                @endphp
                                                <span class="badge {{ $statusLabels[$application->status]['badge'] }}">
                                                    {{ $statusLabels[$application->status]['label'] }}
                                                </span>
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="fa fa-ellipsis-v text-primary"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <div class="d-flex">
                                                            <a href="{{ route('frontend.application-details', ['id' => $application->id]) }}""
                                                                class="btn text-primary" data-toggle="tooltip"
                                                                data-placement="top" data-original-title="View">
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                            </a>
                                                            <a href="{{ route('consultent.application-form-download', ['id' => $application->id]) }}"
                                                                class="btn text-primary" data-toggle="tooltip"
                                                                data-placement="top"
                                                                data-original-title="Download Application">
                                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                            </a>
                                                            <a href="{{ route('frontend.consultant_application-all-document-download', $application->id) }}"
                                                                class="btn text-primary" data-toggle="tooltip"
                                                                data-placement="top"
                                                                data-original-title="Download Application File">
                                                                <i class="fa fa-cloud" aria-hidden="true"></i>
                                                            </a>
                                                            <a href="{{ route('frontend.manage_consultant_application_invoice', $item->id) }}"
                                                                class="btn text-primary" data-toggle="tooltip"
                                                                data-placement="top" data-original-title="Invoice">
                                                                <i class="fa fa-solid fa-receipt"
                                                                    aria-hidden="true"></i>
                                                            </a>
                                                            <a href="{{ route('consultent.student_appliction_program_edit', ['id' => $application->id]) }}"
                                                                class="btn text-primary" data-toggle="tooltip"
                                                                data-placement="top" data-original-title="Edit">
                                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @include('User-Backend.components.footer')
            </div>
        </div>
    </div>

    @include('User-Backend.components.script')

    <script>
        document.getElementById('payment_status_filter').addEventListener('change', function() {
            var selectedStatus = this.value;
            var tableRows = document.querySelectorAll('#order-listing tbody tr');

            tableRows.forEach(function(row) {
                var statusCell = row.cells[5];
                var statusSpan = statusCell.querySelector('span');

                if (selectedStatus == '') {
                    row.style.display = '';
                    return;
                }

                if (statusSpan.textContent.trim() === selectedStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        document.getElementById('status_filter').addEventListener('change', function() {
            var selectedStatus = this.value;
            var tableRows = document.querySelectorAll('#order-listing tbody tr');

            tableRows.forEach(function(row) {
                var statusCell = row.cells[6];
                var statusSpan = statusCell.querySelector('span');

                if (selectedStatus == '') {
                    row.style.display = '';
                    return;
                }

                if (statusSpan.textContent.trim() === selectedStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
