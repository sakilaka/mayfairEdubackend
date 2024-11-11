<!DOCTYPE html>
<html lang="en">

<head>
    @include('User-Backend.components.head')
    <title>{{ env('APP_NAME') }} | My Applications</title>

    <style>
        @media screen and (max-width:640px) {
            .dt-buttons {
                margin-bottom: 1rem;
            }
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
                            My Applications
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('frontend.university_course_list') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Add Application</a>
                        </nav>
                    </div>

                    <div class="row card">
                        <div class="col-sm-12 card-body table-responsive">
                            <table id="order-listing" class="table dataTable-export table-striped dataTable no-footer"
                                role="grid" aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th class="text-left">SL</th>
                                        <th>Appliction Code</th>
                                        <th class="text-center">Appliction Fee</th>
                                        <th>University</th>
                                        <th>Major</th>
                                        <th class="text-center">Payment Method</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applications as $application)
                                        <tr role="row" class="odd">
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ route('user.order_details', @$application->id) }}"
                                                    style="color: var(--btn_primary_color)" data-toggle="tooltip"
                                                    data-placement="top"
                                                    data-original-title="View Application Details">{{ $application->application_code }}</a>
                                            </td>
                                            <td class="text-center">{{ @$application->application_fee }}</td>
                                            <td
                                                style="font-size: 0.9rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;">
                                                @foreach ($application->carts as $cart)
                                                    <a href="{{ $cart->course?->university ? route('frontend.university_details', ['id' => $cart->course->university?->id]) : '#' }}"
                                                        target="_blank" style="color: var(--primary_background);"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-original-title="{{ $cart->course?->university?->name ?? '' }}">
                                                        {{ $cart->course?->university?->name ?? '' }}
                                                    </a>
                                                @endforeach
                                            </td>
                                            <td
                                                style="font-size: 0.9rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;">
                                                @foreach ($application->carts as $cart)
                                                    {{ $cart->course->department->name ?? '' }}
                                                @endforeach
                                            </td>
                                            <td class="text-center">{{ ucfirst($application->payment_method) }}</td>
                                            <td class="text-center">
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
                                            <td class="text-right d-flex justify-content-end align-items-center">
                                                @if ($application->status == 0)
                                                    <a href="{{ route('apply_admission', @$application->id) }}"
                                                        class="btn text-primary" data-toggle="tooltip"
                                                        data-placement="top" data-original-title="Edit Application">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ route('user.order_details', @$application->id) }}"
                                                    class="btn text-primary" data-toggle="tooltip" data-placement="top"
                                                    data-original-title="View Application Details">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('frontend.manage_consultant_application_invoice', @$application->id) }}"
                                                    class="btn text-primary" data-toggle="tooltip" data-placement="top"
                                                    data-original-title="View Invoice">
                                                    <i class="fa fa-solid fa-receipt" aria-hidden="true"></i>
                                                </a>
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

</body>

</html>
