<!DOCTYPE html>
<html lang="en">

<head>
    @include('User-Backend.components.head')
    <title>{{ env('APP_NAME') }} | My Applications</title>

    <style>
        .fs-09 {
            font-size: 0.9rem !important
        }

        .fw-bold {
            font-weight: bold;
        }

        .select2-container--default .select2-selection--single {
            padding: 12px 5px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 7px;
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
                            <div class="d-md-flex justify-content-between">

                                <a href="{{ route('frontend.university_course_list') }}"><button class="ml-3 btn btn-primary-bg" data-toggle=""
                                    data-target="#">Add a new application</button></a>

                                <button class="ml-3 btn btn-primary-bg" data-toggle="modal"
                                    data-target="#manage_fields_modal">Manage Fields</button>

                                <button class="ml-3 btn btn-primary-bg" data-toggle="modal"
                                    data-target="#manage_filters_modal">Manage Filters</button>

                               
                            </div>

                        </nav>
                    </div>

                    <div class="my-2 row justify-content-end" style="gap: 5px">
                        @foreach ($table_manipulate_filter_data ?? [] as $filter)
                            @if ($filter['is_selected'] != false)
                                @php
                                    $filter_type = $filter['filter_parent'];

                                    $filter_child = [];
                                    if ($filter_type == 'partner') {
                                        $response = App\Models\User::where(['type' => 7])
                                            ->orderBy('name', 'asc')
                                            ->get(['id', 'name']);
                                        foreach ($response as $partner) {
                                            $filter_child[] = ['id' => $partner->id, 'name' => $partner->name];
                                        }
                                    } elseif ($filter_type == 'degree') {
                                        $response = App\Models\Degree::where('status', 1)
                                            ->orderBy('name', 'asc')
                                            ->get(['id', 'name']);
                                        foreach ($response as $degree) {
                                            $filter_child[] = ['id' => $degree->id, 'name' => $degree->name];
                                        }
                                    } elseif ($filter_type == 'department') {
                                        $response = App\Models\Department::orderBy('name', 'asc')->get(['id', 'name']);
                                        foreach ($response as $department) {
                                            $filter_child[] = [
                                                'id' => $department->id,
                                                'name' => $department->name,
                                            ];
                                        }
                                    } elseif ($filter_type == 'university') {
                                        $response = App\Models\University::orderBy('name', 'asc')->get(['id', 'name']);
                                        foreach ($response as $university) {
                                            $filter_child[] = [
                                                'id' => $university->id,
                                                'name' => $university->name,
                                            ];
                                        }
                                    } elseif ($filter_type == 'intake') {
                                        $response = App\Models\Section::orderBy('name', 'asc')->get(['id', 'name']);
                                        foreach ($response as $intake) {
                                            $filter_child[] = ['id' => $intake->id, 'name' => $intake->name];
                                        }
                                    } elseif ($filter_type == 'language') {
                                        $response = App\Models\CourseLanguage::orderBy('name', 'asc')->get([
                                            'id',
                                            'name',
                                        ]);
                                        foreach ($response as $language) {
                                            $filter_child[] = ['id' => $language->id, 'name' => $language->name];
                                        }
                                    }
                                @endphp

                                <select class="filter_child col-md-4 col-lg-2 form-control form-control-lg"
                                    name="filter_child" data-filter-parent="{{ $filter_type }}">
                                    <option value="">Select {{ ucfirst($filter_type) }}</option>
                                    <option value="all">All</option>
                                    @foreach ($filter_child as $item)
                                        <option value="{{ $item['id'] }}"
                                            @if ($requested_filter_child == $item['id'] && $requested_filter_parent == $filter_type) selected @endif>{{ $item['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        @endforeach

                        <select name="study_fund" class="col-md-4 col-lg-2 form-control form-control-lg"
                            id="study_fund_type">
                            <option value="">Select Fund Type</option>
                            <option value="all" @if ($study_fund_type && $study_fund_type == 'all') selected @endif>
                                All
                            </option>
                            <option value="Self finance" @if ($study_fund_type && $study_fund_type == 'Self finance') selected @endif>Self
                                finance
                            </option>
                            <option
                                value="Chinese Government Scholarship"@if ($study_fund_type && $study_fund_type == 'Chinese Government Scholarship') selected @endif>
                                Chinese Govt. Scholarship
                            </option>
                            <option
                                value="Part scholarship part self financed"@if ($study_fund_type && $study_fund_type == 'Part scholarship part self financed') selected @endif>
                                Part scholarship part...
                            </option>
                        </select>

                        @if (isset($table_manipulate_data['application_status']) && $table_manipulate_data['application_status'] == 'on')
                            <select name="status_filter" id="status_filter"
                                class="col-md-4 col-lg-2 form-control form-control-lg">
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
                        @endif
                    </div>

                    <div class="row card">
                        <div class="col-sm-12 card-body table-responsive">
                            <table id="order-listing" class="table table-striped dataTable no-footer" role="grid"
                                aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th class="text-left">SL</th>
                                        @if (isset($table_manipulate_data['application_code']) && $table_manipulate_data['application_code'] == 'on')
                                            <th>Code</th>
                                        @endif
                                        @if (isset($table_manipulate_data['student_name']) && $table_manipulate_data['student_name'] == 'on')
                                            <th>Student</th>
                                        @endif
                                        @if (isset($table_manipulate_data['partner_name']) && $table_manipulate_data['partner_name'] == 'on')
                                            <th>Assigned</th>
                                        @endif
                                        @if (isset($table_manipulate_data['passport_number']) && $table_manipulate_data['passport_number'] == 'on')
                                            <th>Passport</th>
                                        @endif
                                        @if (isset($table_manipulate_data['program_name']) && $table_manipulate_data['program_name'] == 'on')
                                            <th>Program Name</th>
                                        @endif
                                        @if (isset($table_manipulate_data['section_id']) && $table_manipulate_data['section_id'] == 'on')
                                            <th>Intake</th>
                                        @endif
                                        @if (isset($table_manipulate_data['university_name']) && $table_manipulate_data['university_name'] == 'on')
                                            <th>University</th>
                                        @endif
                                        @if (isset($table_manipulate_data['apply_date']) && $table_manipulate_data['apply_date'] == 'on')
                                            <th
                                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 80px;">
                                                Apply Date
                                            </th>
                                        @endif
                                        @if (isset($table_manipulate_data['passport_exipre_date']) && $table_manipulate_data['passport_exipre_date'] == 'on')
                                            <th
                                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 80px;">
                                                Passport Expire Date
                                            </th>
                                        @endif
                                        @if (isset($table_manipulate_data['gender']) && $table_manipulate_data['gender'] == 'on')
                                            <th
                                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 80px;">
                                                Gender
                                            </th>
                                        @endif
                                        @if (isset($table_manipulate_data['paid_status']) && $table_manipulate_data['paid_status'] == 'on')
                                            <th
                                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 80px;">
                                                Paid Status
                                            </th>
                                        @endif
                                        @if (isset($table_manipulate_data['application_status']) && $table_manipulate_data['application_status'] == 'on')
                                            <th>Status</th>
                                        @endif
                                        @if (isset($table_manipulate_data['action']) && $table_manipulate_data['action'] == 'on')
                                            <th class="text-right">Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $sl_count = 1;
                                    @endphp
                                    @foreach ($applications as $item)
                                        <tr role="row">
                                            <td class="text-left">{{ $sl_count }}</td>
                                            @if (isset($table_manipulate_data['application_code']) && $table_manipulate_data['application_code'] == 'on')
                                                <td>
                                                    <a href="{{ route('admin.student_appliction_details', $item->id) }}"
                                                        style="color: var(--btn_primary_color)" data-toggle="tooltip"
                                                        data-placement="top"
                                                        data-original-title="View Application Details">
                                                        {{ $item->application_code ?? '' }}
                                                    </a>
                                                </td>
                                            @endif
                                            @if (isset($table_manipulate_data['student_name']) && $table_manipulate_data['student_name'] == 'on')
                                                @php
                                                    $studentName = $item->first_name . ' ' . $item->last_name;
                                                @endphp
                                                <td
                                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        data-original-title="{{ $studentName ?? '' }}">
                                                        {{ $studentName ?? '' }}
                                                    </span>
                                                </td>
                                            @endif
                                            @if (isset($table_manipulate_data['partner_name']) && $table_manipulate_data['partner_name'] == 'on')
                                                @php
                                                    $partnerIds = is_array(json_decode($item->partner_ref_id, true))
                                                        ? json_decode($item->partner_ref_id, true)
                                                        : [$item->partner_ref_id];
                                                    $partnerNameAndRoles = [];

                                                    foreach ($partnerIds as $partnerId) {
                                                        $partner = $item->partner($partnerId);

                                                        if ($partner && $partner['role'] != 'admin') {
                                                            $partnerNameAndRoles[] =
                                                                $partner->name . ' (' . ucwords($partner->role) . ')';
                                                        }
                                                    }

                                                    $partnerNameAndRoleString = implode(', ', $partnerNameAndRoles);
                                                @endphp

                                                <td>
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        data-original-title="{{ $partnerNameAndRoleString }}">
                                                        {{ Illuminate\Support\Str::limit($partnerNameAndRoleString, 30, '...') }}
                                                    </span>
                                                </td>
                                            @endif
                                            @if (isset($table_manipulate_data['passport_number']) && $table_manipulate_data['passport_number'] == 'on')
                                                <td
                                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        data-original-title="{{ $item->passport_number ?? '' }}">
                                                        {{ $item->passport_number ?? '' }}
                                                    </span>
                                                </td>
                                            @endif
                                            @if (isset($table_manipulate_data['program_name']) && $table_manipulate_data['program_name'] == 'on')
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
                                                <td
                                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;">
                                                    {!! $programLinks !!}
                                                </td>
                                            @endif
                                            @if (isset($table_manipulate_data['section_id']) && $table_manipulate_data['section_id'] == 'on')
                                                @php
                                                    $programIds = json_decode($item->programs) ?? [];
                                                    $intakes = collect($programIds)
                                                        ->map(function ($programId) {
                                                            $course = \App\Models\Course::find($programId);
                                                            return $course?->intake;
                                                        })
                                                        ->filter()
                                                        ->unique('id')
                                                        ->values();

                                                    $intakeNames = $intakes->pluck('name')->implode(', ');
                                                    $intakeTooltips = $intakes->pluck('name')->implode(', ');
                                                @endphp

                                                <td
                                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        data-original-title="{{ $intakeTooltips }}">
                                                        {{ $intakeNames }}
                                                    </span>
                                                </td>
                                            @endif
                                            @if (isset($table_manipulate_data['university_name']) && $table_manipulate_data['university_name'] == 'on')
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
                                                <td
                                                    style="font-size: 0.9rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;">
                                                    {!! $universityNames !!}
                                                </td>
                                            @endif
                                            @if (isset($table_manipulate_data['apply_date']) && $table_manipulate_data['apply_date'] == 'on')
                                                <td class="text-center">
                                                    {{ date('d M, Y', strtotime($item->created_at)) }}

                                                </td>
                                            @endif
                                            @if (isset($table_manipulate_data['passport_exipre_date']) && $table_manipulate_data['passport_exipre_date'] == 'on')
                                                <td class="text-center">
                                                    {{ $item->passport_exipre_date }}

                                                </td>
                                            @endif
                                            @if (isset($table_manipulate_data['gender']) && $table_manipulate_data['gender'] == 'on')
                                                <td class="text-center">
                                                    {{ $item->gender }}

                                                </td>
                                            @endif
                                            @if (isset($table_manipulate_data['paid_status']) && $table_manipulate_data['paid_status'] == 'on')
                                                <td>
                                                    @if ($item->payment_status == 1)
                                                        <span class="badge badge-success">Paid</span>
                                                    @elseif($item->payment_status == 0)
                                                        <span class="badge badge-danger">Unpaid</span>
                                                    @endif
                                                </td>
                                            @endif
                                            @if (isset($table_manipulate_data['application_status']) && $table_manipulate_data['application_status'] == 'on')
                                                <td data-field="status">
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
                                            @endif
                                            @if (isset($table_manipulate_data['action']) && $table_manipulate_data['action'] == 'on')
                                                <td class="text-right d-flex justify-content-end align-items-center">
                                                    <a href="javascript:void(0)"
                                                        class="btn text-primary show-application-support-modal-trigger"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-original-title="View supports for this application"
                                                        data-application-id="{{ $item->id }}">
                                                        <i class="fa fa-users" aria-hidden="true"></i>
                                                    </a>
                                                    @if ($item->status == 0)
                                                        <a href="{{ route('apply_admission', @$item->id) }}"
                                                            class="btn text-primary" data-toggle="tooltip"
                                                            data-placement="top"
                                                            data-original-title="Edit Application">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('user.order_details', @$item->id) }}"
                                                        class="btn text-primary" data-toggle="tooltip"
                                                        data-placement="top"
                                                        data-original-title="View Application Details">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="{{ route('frontend.manage_consultant_application_invoice', @$item->id) }}"
                                                        class="btn text-primary" data-toggle="tooltip"
                                                        data-placement="top" data-original-title="View Invoice">
                                                        <i class="fa fa-solid fa-receipt" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                        @php
                                            $sl_count++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- manage fields - modal --}}
                <div class="modal fade" id="manage_fields_modal" tabindex="-1" role="dialog"
                    aria-labelledby="manage-fields-modal" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('admin.student_appliction_list.table_manipulate') }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="page_route" value="{{ Route::currentRouteName() }}">

                                <div class="modal-header">
                                    <h5 class="modal-title">Select fields to manipulate data table</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="application_code"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['application_code']) && $table_manipulate_data['application_code'] == 'on') checked @endif>
                                                                Application Code
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="partner_name"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['partner_name']) && $table_manipulate_data['partner_name'] == 'on') checked @endif>
                                                                Assinged Partner
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="program_name"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['program_name']) && $table_manipulate_data['program_name'] == 'on') checked @endif>
                                                                Program Name
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="passport_number"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['passport_number']) && $table_manipulate_data['passport_number'] == 'on') checked @endif>
                                                                Passport Number
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="apply_date"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['apply_date']) && $table_manipulate_data['apply_date'] == 'on') checked @endif>
                                                                Apply Date
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="gender"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['gender']) && $table_manipulate_data['gender'] == 'on') checked @endif>
                                                                Gender
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="section_id"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['section_id']) && $table_manipulate_data['section_id'] == 'on') checked @endif>
                                                                Intake
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="student_name"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['student_name']) && $table_manipulate_data['student_name'] == 'on') checked @endif>
                                                                Student Name
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="university_name"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['university_name']) && $table_manipulate_data['university_name'] == 'on') checked @endif>
                                                                University Name
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="paid_status"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['paid_status']) && $table_manipulate_data['paid_status'] == 'on') checked @endif>
                                                                Paid Status
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="passport_exipre_date"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['passport_exipre_date']) && $table_manipulate_data['passport_exipre_date'] == 'on') checked @endif>
                                                                Passport Expire Date
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="application_status"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['application_status']) && $table_manipulate_data['application_status'] == 'on') checked @endif>
                                                                Application Status
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="action"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['action']) && $table_manipulate_data['action'] == 'on') checked @endif>
                                                                Action
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-muted" style="font-size: 1rem;">Select desired fields to show
                                            in data-table.</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" type="button" class="btn btn-light"
                                        data-dismiss="modal">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Apply</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- manage filters - modal --}}
                <div class="modal fade" id="manage_filters_modal" tabindex="-1" role="dialog"
                    aria-labelledby="manage-fields-modal" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Manage filters to manipulate data table</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <form
                                        action="{{ route('admin.student_appliction_list.table_manipulate_filter') }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="page_route"
                                            value="{{ Route::currentRouteName() }}">
                                        <input type="hidden" name="data_filter_type" value="add_filter">

                                        <div class="card-header" data-toggle="collapse"
                                            data-target="#add_new_filter">
                                            <h5 class="text-dark" style="font-size: 1rem;">
                                                <i class="fa fa-solid fa-plus"></i>
                                                Add New Filter
                                            </h5>
                                        </div>
                                        <div class="collapse" id="add_new_filter">
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    {{-- <input type="hidden" name="filter_name" class="form-control"> --}}
                                                </div>

                                                <div class="col-12 mt-3">
                                                    <p class="text-muted" style="font-size: 1rem">Available Filters
                                                    </p>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <select name="filter_parent"
                                                                class="form-control form-control-lg"
                                                                id="filter_parent" required>
                                                                <option value="">Select Filter Type</option>
                                                                <option value="partner">Partner</option>
                                                                <option value="degree">Degree</option>
                                                                <option value="department">Department</option>
                                                                <option value="university">University</option>
                                                                <option value="intake">Intake</option>
                                                                <option value="language">Language</option>
                                                            </select>
                                                        </div>
                                                        {{-- <div class="col-md-6">
                                                            <select name="filter_child"
                                                                class="form-control form-control-lg" id="filter_child"
                                                                required>
                                                                <option value="">Select Type First</option>
                                                            </select>
                                                        </div> --}}
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-3 text-right">
                                                    <button class="btn btn-primary" type="submit">Add Filter</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="mt-2">
                                    <form
                                        action="{{ route('admin.student_appliction_list.table_manipulate_filter') }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="data_filter_type" value="manage_filter">

                                        <div class="card-header" data-toggle="collapse" data-target="#manage_filter">
                                            <h5 class="text-dark" style="font-size: 1rem;">
                                                <i class="fa fa-solid fa-plus"></i>
                                                Manage Filters
                                            </h5>
                                        </div>
                                        <div class="collapse" id="manage_filter">
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Filter Name</th>
                                                                <th class="text-right" style="padding-right: 2rem">
                                                                    Action</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <label class="form-check-label fs-09">
                                                                            <input type="checkbox" name="filter_id[]"
                                                                                class="form-check-input"
                                                                                value="none"
                                                                                {{ !collect($table_manipulate_filter_data)->contains('is_selected', true) ? 'checked' : '' }}>
                                                                            None
                                                                            <i class="input-helper"></i>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td class="text-right" style="padding-right: 2rem">
                                                                </td>
                                                            </tr>
                                                            @if (!empty($table_manipulate_filter_data))
                                                                @foreach ($table_manipulate_filter_data as $filter)
                                                                    <tr>
                                                                        <td>
                                                                            <div class="form-check">
                                                                                <label class="form-check-label fs-09">
                                                                                    <input type="checkbox"
                                                                                        name="filter_id[]"
                                                                                        class="form-check-input"
                                                                                        value="{{ $filter['id'] }}"
                                                                                        {{ $filter['is_selected'] ? 'checked' : '' }}>
                                                                                    {{ ucfirst($filter['filter_parent']) }}
                                                                                    <i class="input-helper"></i>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-right"
                                                                            style="padding-right: 2rem">
                                                                            <a
                                                                                href="{{ route('admin.student_appliction_list.delete_filter_item', ['id' => $filter['id']]) }}">
                                                                                <i class="fa fa-trash text-danger"
                                                                                    style="font-size: 16px"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-12 mt-3 text-right">
                                                    <button class="btn btn-primary" type="submit">Update
                                                        Filter</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- show application supports - modal --}}
                <div class="modal fade" id="show_application_support_modal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel-2" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Take a look at the supports of this application</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="support-details" class="row">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                @include('User-Backend.components.footer')
            </div>
        </div>
    </div>

    @include('User-Backend.components.script')

    <script src="{{ asset('backend/assets/js/select2.js') }}"></script>
    <script>
        $('select').select2();

        // show application support
        $('.show-application-support-modal-trigger').click(function() {
            var applicationId = $(this).data('application-id');

            $.ajax({
                url: '{{ route('admin.fetch_application_support', ':application_id') }}'.replace(
                    ':application_id', applicationId),
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        var data = response.data;

                        function createUserSection(user, isLast) {
                            if (user) {
                                const addressLine = [
                                    user.address || 'No Address Provided',
                                    user.country ? `${user.country}` : '',
                                    user.continent ? `${user.continent}` : ''
                                ].filter(part => part).join(', ');

                                const borderBottomClass = isLast ? '' : 'border-bottom';

                                return `
                                    <div class="col-12 my-2 pb-2 ${borderBottomClass}">
                                        <h4 style="font-size: 20px" class="mb-2">${user.role}</h4>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 style="font-size: 16px">${user.name || 'No Name'}</h5>
                                                <p class="mb-1" style="font-size: 16px">${addressLine}</p>
                                                <p class="mb-1" style="font-size: 16px">${user.phone || 'No Phone Number'}</p>
                                                <p class="mb-1" style="font-size: 16px">${user.email || 'No Email'}</p>
                                            </div>
                                            <div>
                                                <img src="${user.photo || '{{ asset('frontend/images/no-profile.jpg') }}'}" alt="" style="border-radius: 8px; height:100px; width:100px; object-fit:contain;">
                                            </div>
                                        </div>
                                    </div>
                                `;
                            }
                            return '';
                        }

                        var modalBody = '';
                        var hasData = false;
                        var users = [data.partner, data.manager, data.support];
                        users.forEach((user, index) => {
                            if (user) {
                                modalBody += createUserSection(user, index === users.length -
                                    1);
                                hasData = true;
                            }
                        });

                        if (!hasData) {
                            modalBody =
                                '<p class="text-center" style="font-size:16px">No support is assigned to this application.</p>';
                        }

                        $('#support-details').html(modalBody);
                        $('#show_application_support_modal').modal('show');
                    } else {
                        alert('Failed to fetch application data: ' + response.message);
                    }
                },
                error: function() {
                    alert('An error occurred while fetching the application data.');
                }
            });
        });
    </script>

    @if (isset($table_manipulate_data['application_status']) && $table_manipulate_data['application_status'] == 'on')
        <script>
            document.getElementById('status_filter').addEventListener('change', function() {
                var selectedStatus = this.value;
                var tableRows = document.querySelectorAll('#order-listing tbody tr');

                tableRows.forEach(function(row) {
                    var statusCell = row.querySelector('td[data-field="status"]');

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
    @endif

    <script>
        var studyFundSelect = document.getElementById('study_fund_type');

        studyFundSelect.addEventListener('change', function() {
            var selectedValue = studyFundSelect.value;

            if (selectedValue !== '') {
                var form = document.createElement('form');

                form.action = '{{ route('user.order_list_filter') }}';
                form.method = 'POST';

                var csrfToken = document.querySelector('meta[name="_token"]').getAttribute('content');
                var csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;

                form.appendChild(csrfInput);

                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'study_fund';
                input.value = selectedValue;

                form.appendChild(input);
                document.body.appendChild(form);

                form.submit();
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.filter_child').on('change', function() {
                var filterParent = $(this).data('filter-parent');
                var filterChild = $(this).val();

                var form = $('<form>', {
                    'method': 'POST',
                    'action': '{{ route('user.order_list_filter') }}'
                });

                var token = $('<input>', {
                    'type': 'hidden',
                    'name': '_token',
                    'value': '{{ csrf_token() }}'
                });
                form.append(token);

                if (filterChild == 'all' || filterChild == '') {
                    var parentInput = $('<input>', {
                        'type': 'hidden',
                        'name': 'filter_parent',
                        'value': 'all'
                    });
                } else {
                    var parentInput = $('<input>', {
                        'type': 'hidden',
                        'name': 'filter_parent',
                        'value': filterParent
                    });
                }
                form.append(parentInput);

                var childInput = $('<input>', {
                    'type': 'hidden',
                    'name': 'filter_child',
                    'value': filterChild
                });
                form.append(childInput);

                $('body').append(form);
                form.submit();
                /* if (filterChild) {
                } */
            });

            /* $('#filter_parent').on('change', function() {
                var parentValue = $(this).val();

                if (parentValue && parentValue != 'all') {
                    $.ajax({
                        url: '{{ route('admin.student_appliction_list.get_filter_items') }}',
                        type: 'GET',
                        data: {
                            filter: parentValue
                        },
                        success: function(response) {
                            $('#filter_child').empty();
                            $('#filter_child').attr('disabled', false).attr('required', true);
                            $('#filter_child').append(
                                '<option value="">Select Filter</option>');
                            $.each(response, function(index, item) {
                                $('#filter_child').append('<option value="' + item.id +
                                    '" data-filter-name="' + item.name + '">' + item
                                    .name + '</option>');
                            });
                        },
                        error: function() {
                            alert('Error retrieving data. Please try again.');

                            $('#filter_child').empty();
                            $('#filter_child').append(
                                '<option value="">Select Type First</option>');
                        }
                    });
                } else {
                    $('#filter_child').empty();
                    $('#filter_parent').attr('required', false);
                    $('#filter_child').attr('disabled', true).attr('required', false);
                    $('#filter_child').append('<option value="">Select Type First</option>');
                }
            });

            $(document).on('change', 'select[name="filter_child"]', function() {
                let filter_name = $(this).find('option:selected').data('filter-name');
                $('input[name="filter_name"]').val(filter_name);
            }); */

            function updateNoneCheckbox() {
                var allUnchecked = !$('input[name="filter_id[]"]:checked').length;
                $('input[name="filter_id[]"][value="none"]').prop('checked', allUnchecked);
            }

            $(document).on('change', 'input[name="filter_id[]"]:not([value="none"])', function() {
                $('input[name="filter_id[]"][value="none"]').prop('checked', false);
            });

            $(document).on('change', 'input[name="filter_id[]"][value="none"]', function() {
                $(this).prop('checked', true);
                $('input[name="filter_id[]"]:not([value="none"])').prop('checked', false);
            });

            $(document).on('change', 'input[name="filter_id[]"]', function() {
                updateNoneCheckbox();
            });

            $('input[name="filter_id[]"]:not([value="none"])').trigger('change');
        });
    </script>
</body>

</html>
