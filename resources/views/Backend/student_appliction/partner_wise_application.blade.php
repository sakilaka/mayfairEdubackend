<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | All Appliction List Under {{ $partner->name }}</title>
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
                            @php
                                $tooltipContent = $partner->name ?? '';
                                $textContent = $partner->name ?? '';

                                $partner_country = '';
                                $partner_continent = '';
                                if ($partner) {
                                    $partner_country = App\Models\Country::find($partner->country);
                                    $partner_continent = App\Models\Continent::find($partner->continent_id);
                                }

                                if ($partner_continent && $partner_country) {
                                    $tooltipContent .= " ({$partner_continent->name}, {$partner_country->name})";
                                    $textContent .= " ({$partner_continent->name}, {$partner_country->name})";
                                } elseif ($partner_continent) {
                                    $tooltipContent .= " ({$partner_continent->name})";
                                    $textContent .= " ({$partner_continent->name})";
                                } elseif ($partner_country) {
                                    $tooltipContent .= " ({$partner_country->name})";
                                    $textContent .= " ({$partner_country->name})";
                                }
                            @endphp
                            All Appliction List Under {{ $textContent }}
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.student_appliction_list_partner_wise') }}"
                                class="btn btn-primary btn-fw">
                                <i class="fa fa-chevron-left" aria-hidden="true"></i> &nbsp;
                                Go Back
                            </a>
                        </nav>
                    </div>

                    <div class="row card">
                        <div class="col-sm-12 card-body table-responsive">
                            <table id="order-listing" class="table table-striped dataTable no-footer" role="grid"
                                aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th class="text-left">SL</th>
                                        <th>Code</th>
                                        <th>Student</th>
                                        <th>Program Name</th>
                                        <th>University</th>
                                        <th style="white-space: nowrap; 
                                                        overflow: hidden; 
                                                        text-overflow: ellipsis; 
                                                        max-width: 80px;"
                                            class="text-center">Apply Date</th>
                                        <th style="white-space: nowrap; 
                                                        overflow: hidden; 
                                                        text-overflow: ellipsis; 
                                                        max-width: 80px;"
                                            class="text-center">Paid Status</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applications as $item)
                                        <tr role="row" class="odd">
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td>{{ $item->application_code }}</td>
                                            <td
                                                style="white-space: nowrap; 
                                                        overflow: hidden; 
                                                        text-overflow: ellipsis; 
                                                        max-width: 100px;">
                                                <span data-toggle="tooltip" data-placement="left"
                                                    data-original-title="{{ $item->first_name . ' ' . $item->middle_name . ' ' . $item->last_name }}">
                                                    {{ $item->first_name . ' ' . $item->middle_name . ' ' . $item->last_name }}
                                                </span>
                                            </td>
                                            <td
                                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;">
                                                @php
                                                    $programIds = json_decode($item->programs) ?? [];
                                                    $programs = collect($programIds)
                                                        ->map(function ($programId) {
                                                            $course = \App\Models\Course::find($programId);
                                                            return $course
                                                                ? [
                                                                    'id' => $course->id,
                                                                    'name' => $course->name,
                                                                ]
                                                                : null;
                                                        })
                                                        ->filter()
                                                        ->unique('id')
                                                        ->values();

                                                    $programLinks = $programs
                                                        ->map(function ($program) {
                                                            return '<a href="' .
                                                                route('frontend.course.details', [
                                                                    'id' => $program['id'],
                                                                ]) .
                                                                '" target="_blank" style="color: var(--primary_background);" data-toggle="tooltip" data-placement="top" data-original-title="' .
                                                                $program['name'] .
                                                                '">' .
                                                                $program['name'] .
                                                                '</a>';
                                                        })
                                                        ->implode(',<br>');
                                                @endphp
                                                {!! $programLinks !!}
                                            </td>
                                            <td
                                                style="font-size: 0.9rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;">
                                                @php
                                                    $programIds = json_decode($item->programs) ?? [];
                                                    $universities = collect($programIds)
                                                        ->map(function ($programId) {
                                                            $course = \App\Models\Course::find($programId);
                                                            return $course?->university;
                                                        })
                                                        ->filter()
                                                        ->unique('id')
                                                        ->values();

                                                    $universityNames = $universities
                                                        ->map(function ($university) {
                                                            return '<a href="' .
                                                                route('frontend.university_details', [
                                                                    'id' => $university->id,
                                                                ]) .
                                                                '" target="_blank" style="color: var(--primary_background);" data-toggle="tooltip" data-placement="top" data-original-title="' .
                                                                $university->name .
                                                                '">' .
                                                                $university->name .
                                                                '</a>';
                                                        })
                                                        ->implode(',<br>');
                                                @endphp
                                                {!! $universityNames !!}
                                            </td>

                                            <td>{{ date('d M, Y', strtotime($item->created_at)) }}</td>
                                            <td class="text-center">
                                                @if ($item->payment_status == 1)
                                                    <span class="badge badge-success">Paid</span>
                                                @elseif($item->payment_status == 0)
                                                    <span class="badge badge-danger">Unpaid</span>
                                                @endif
                                            </td>
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
                                                <span class="badge {{ $statusLabels[$item->status]['badge'] }}">
                                                    {{ $statusLabels[$item->status]['label'] }}
                                                </span>
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="fa fa-ellipsis-v text-primary"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <div class="d-flex">

                                                            <a href="{{ route('admin.appliction_list_partner_wise', ['partner_id' => $partner->id, 'detach-application' => $item->id]) }}"
                                                                class="btn text-primary" data-toggle="tooltip"
                                                                data-placement="top"
                                                                data-original-title="Detach this application from this user">
                                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                                            </a>
                                                            <a href="{{ route('admin.student_appliction_details', $item->id) }}"
                                                                class="btn text-primary" data-toggle="tooltip"
                                                                data-placement="top" data-original-title="View">
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                            </a>
                                                            <a href="{{ route('admin.application-form-download', $item->id) }}"
                                                                class="btn text-primary" data-toggle="tooltip"
                                                                data-placement="top"
                                                                data-original-title="Download Application">
                                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                            </a>
                                                            <a href="{{ route('admin.application-all-document-download', $item->id) }}"
                                                                class="btn text-primary" data-toggle="tooltip"
                                                                data-placement="top"
                                                                data-original-title="All Documents Download">
                                                                <i class="fa fa-cloud" aria-hidden="true"></i>
                                                            </a>
                                                            <a href="{{ route('admin.student_appliction_invoice', $item->id) }}"
                                                                class="btn text-primary" data-toggle="tooltip"
                                                                data-placement="top" data-original-title="Invoice">
                                                                <i class="fa fa-solid fa-receipt"
                                                                    aria-hidden="true"></i>
                                                            </a>
                                                            <a href="{{ route('admin.student_appliction_program_edit', $item->id) }}"
                                                                class="btn text-primary" data-toggle="tooltip"
                                                                data-placement="top" data-original-title="Edit">
                                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                            </a>
                                                            <input type="hidden" value="{{ $item->id }}">
                                                            <a data-toggle="modal" data-target="#delete_modal_box"
                                                                class="btn text-primary delete-item"
                                                                data-toggle="tooltip" data-placement="top"
                                                                data-original-title="Delete">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
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

                {{-- Item delete modal --}}
                <div id="delete_modal_box" class="modal fade delete-modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <img src="{{ asset('backend/assets/images/warning.png') }}" alt=""
                                    width="50" height="46">
                                <h5 class="mt-3 mb-4">Are you sure want to delete this?</h5>
                                <div class="m-t-20 flex">
                                    <form action="{{ route('admin.student_appliction_delete') }}" method="POST"
                                        id="deleteForm">
                                        @csrf
                                        <input type="hidden" name="s_appliction_id" id="modal_item_id"
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

                @include('Backend.components.footer')
            </div>
        </div>
    </div>

    @include('Backend.components.script')
</body>

</html>
