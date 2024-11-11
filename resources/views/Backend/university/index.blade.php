<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | All University</title>

    <style>
        .fs-09 {
            font-size: 0.9rem !important
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
        @include('Backend.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('Backend.components.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            All University
                        </h3>

                        <nav aria-label="breadcrumb">
                            <button class="btn btn-primary-bg" data-toggle="modal"
                                data-target="#manage_fields_modal">Manage Fields</button>

                            <button class="btn btn-primary-bg ml-2" data-toggle="modal"
                                data-target="#manage_filters_modal">Manage Filters</button>

                            <a href="{{ route('admin.university.create') }}" class="ml-2 btn btn-primary btn-fw">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Add University</a>
                        </nav>
                    </div>

                    <div class="my-2 justify-content-end row" style="gap: 5px">
                        @foreach ($table_manipulate_filter_data as $filter)
                            @if ($filter['is_selected'] != false)
                                @php
                                    $filter_type = $filter['filter_parent'];

                                    $filter_child = [];
                                    if ($filter_type == 'major') {
                                        $response = App\Models\Department::where(['status' => 1])
                                            ->orderBy('name', 'asc')
                                            ->get(['id', 'name']);
                                        foreach ($response as $major) {
                                            $filter_child[] = ['id' => $major->id, 'name' => $major->name];
                                        }
                                    } elseif ($filter_type == 'scholarship') {
                                        $response = App\Models\Scholarship::where('status', 1)
                                            ->orderBy('title', 'asc')
                                            ->get(['id', 'title']);
                                        foreach ($response as $scholarship) {
                                            $filter_child[] = ['id' => $scholarship->id, 'name' => $scholarship->title];
                                        }
                                    } elseif ($filter_type == 'country') {
                                        $response = App\Models\Country::orderBy('name', 'asc')->get(['id', 'name']);
                                        foreach ($response as $country) {
                                            $filter_child[] = ['id' => $country->id, 'name' => $country->name];
                                        }
                                    } elseif ($filter_type == 'city') {
                                        $response = App\Models\City::orderBy('name', 'asc')->get(['id', 'name']);
                                        foreach ($response as $city) {
                                            $filter_child[] = ['id' => $city->id, 'name' => $city->name];
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
                    </div>

                    <div class="row card">
                        <div class="col-sm-12 card-body table-responsive">
                            <table id="order-listing" class="table table-striped dataTable no-footer" role="grid"
                                aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th>SL</th>
                                        @if (isset($table_manipulate_data['name']) && $table_manipulate_data['name'] == 'on')
                                            <th>Name</th>
                                        @endif
                                        @if (isset($table_manipulate_data['short_name']) && $table_manipulate_data['short_name'] == 'on')
                                            <th>Short Name</th>
                                        @endif
                                        @if (isset($table_manipulate_data['continent_id']) && $table_manipulate_data['continent_id'] == 'on')
                                            <th>Continent</th>
                                        @endif
                                        @if (isset($table_manipulate_data['country_id']) && $table_manipulate_data['country_id'] == 'on')
                                            <th>Country</th>
                                        @endif
                                        @if (isset($table_manipulate_data['state_id']) && $table_manipulate_data['state_id'] == 'on')
                                            <th>Province</th>
                                        @endif
                                        @if (isset($table_manipulate_data['city_id']) && $table_manipulate_data['city_id'] == 'on')
                                            <th>City</th>
                                        @endif
                                        @if (isset($table_manipulate_data['major_id']) && $table_manipulate_data['major_id'] == 'on')
                                            <th>Major</th>
                                        @endif
                                        @if (isset($table_manipulate_data['scholarships']) && $table_manipulate_data['scholarships'] == 'on')
                                            <th>Scholarship</th>
                                        @endif
                                        @if (isset($table_manipulate_data['dormitories']) && $table_manipulate_data['dormitories'] == 'on')
                                            <th>Dormitory</th>
                                        @endif
                                        {{-- @if (isset($table_manipulate_data['status']) && $table_manipulate_data['status'] == 'on')
                                            <th class="text-center">Status</th>
                                        @endif --}}
                                        @if (isset($table_manipulate_data['show_on_home']) && $table_manipulate_data['show_on_home'] == 'on')
                                            <th class="text-center">Show on home</th>
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
                                    @foreach ($universities as $university)
                                        <tr role="row" class="odd">
                                            <td class="text-left">{{ $sl_count }}</td>
                                            @if (isset($table_manipulate_data['name']) && $table_manipulate_data['name'] == 'on')
                                                <td
                                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                                                    <img src="{{ $university->image_show }}" alt=""
                                                        width="30px" height="30px" style="margin-right: 8px">
                                                    <a href="{{ route('frontend.university_details', ['id' => $university->id]) }}"
                                                        target="_blank" style="color: var(--primary_background);"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-original-title="{{ $university->name }}">
                                                        {{ $university->name }}
                                                    </a>
                                                </td>
                                            @endif
                                            @if (isset($table_manipulate_data['short_name']) && $table_manipulate_data['short_name'] == 'on')
                                                <td>{{ $university->short_name ?? '' }}</td>
                                            @endif
                                            @if (isset($table_manipulate_data['continent_id']) && $table_manipulate_data['continent_id'] == 'on')
                                                <td>{{ $university->continent->name ?? '' }}</td>
                                            @endif
                                            @if (isset($table_manipulate_data['country_id']) && $table_manipulate_data['country_id'] == 'on')
                                                <td>{{ $university->country->name ?? '' }}</td>
                                            @endif
                                            @if (isset($table_manipulate_data['state_id']) && $table_manipulate_data['state_id'] == 'on')
                                                <td>{{ $university->state->name ?? '' }}</td>
                                            @endif
                                            @if (isset($table_manipulate_data['city_id']) && $table_manipulate_data['city_id'] == 'on')
                                                <td>{{ $university->city->name ?? '' }}</td>
                                            @endif
                                            @if (isset($table_manipulate_data['major_id']) && $table_manipulate_data['major_id'] == 'on')
                                                @php
                                                    $selectedMajors = json_decode($university->major_id, true) ?? [];
                                                    $majorTitles = $majors
                                                        ->whereIn('id', $selectedMajors)
                                                        ->pluck('name')
                                                        ->toArray();
                                                @endphp

                                                <td
                                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                                                    <span data-toggle="tooltip" data-placement="left"
                                                        data-original-title="{{ implode(', ', $majorTitles) }}">
                                                        {{ implode(', ', $majorTitles) }}
                                                    </span>
                                                </td>
                                            @endif
                                            @if (isset($table_manipulate_data['scholarships']) && $table_manipulate_data['scholarships'] == 'on')
                                                @php
                                                    $selectedScholarships =
                                                        json_decode($university->scholarships, true) ?? [];
                                                    $scholarshipTitles = $scholarships
                                                        ->whereIn('id', $selectedScholarships)
                                                        ->pluck('title')
                                                        ->toArray();
                                                @endphp

                                                <td
                                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        data-original-title="{{ implode(', ', $scholarshipTitles) }}">
                                                        {{ implode(', ', $scholarshipTitles) }}
                                                    </span>
                                                </td>
                                            @endif
                                            @if (isset($table_manipulate_data['dormitories']) && $table_manipulate_data['dormitories'] == 'on')
                                                @php
                                                    $selectedDormitories =
                                                        json_decode($university->dormitories, true) ?? [];
                                                    $dormitoriesTitles = $dormitories
                                                        ->whereIn('id', $selectedDormitories)
                                                        ->pluck('name')
                                                        ->toArray();
                                                @endphp

                                                <td
                                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        data-original-title="{{ implode(', ', $dormitoriesTitles) }}">
                                                        {{ implode(', ', $dormitoriesTitles) }}
                                                    </span>
                                                </td>
                                            @endif
                                            {{-- @if (isset($table_manipulate_data['status']) && $table_manipulate_data['status'] == 'on')
                                                <td class="text-center">
                                                    @if ($university->status == 1)
                                                        <a
                                                            href="{{ route('admin.university.status', $university->id) }}">
                                                            <span class="badge badge-success" data-toggle="tooltip"
                                                                data-placement="top"
                                                                data-original-title="Change university status to inactive">Active</span>
                                                        </a>
                                                    @elseif($university->status == 0)
                                                        <a
                                                            href="{{ route('admin.university.status', $university->id) }}">
                                                            <span class="badge badge-danger" data-toggle="tooltip"
                                                                data-placement="top"
                                                                data-original-title="Change university status to active">Inactive</span>
                                                        </a>
                                                    @endif
                                                </td>
                                            @endif --}}
                                            @if (isset($table_manipulate_data['show_on_home']) && $table_manipulate_data['show_on_home'] == 'on')
                                                <td class="text-center">
                                                    @if ($university->show_on_home == 1)
                                                        <a
                                                            href="{{ route('admin.university.toggle_show_on_home', ['id' => $university->id, 'status' => 0]) }}">
                                                            <span class="badge badge-success" data-toggle="tooltip"
                                                                data-placement="top"
                                                                data-original-title="Hide this university from homepage">Showing</span>
                                                        </a>
                                                    @elseif($university->show_on_home == 0)
                                                        <a
                                                            href="{{ route('admin.university.toggle_show_on_home', ['id' => $university->id, 'status' => 1]) }}">
                                                            <span class="badge badge-danger" data-toggle="tooltip"
                                                                data-placement="top"
                                                                data-original-title="Show this university on homepage">Hidden</span>
                                                        </a>
                                                    @endif
                                                </td>
                                            @endif
                                            @if (isset($table_manipulate_data['action']) && $table_manipulate_data['action'] == 'on')
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false"><i
                                                                class="fa fa-ellipsis-v text-primary"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <div class="d-flex">
                                                                {{-- <a href="{{ route('admin.university.toggle_show_on_home', ['id' => $university->id, 'status' => $university->show_on_home ? 0 : 1]) }}"
                                                                class="btn text-primary" data-toggle="tooltip"
                                                                data-placement="top"
                                                                data-original-title="{{ $university->show_on_home ? 'Hide this university from homepage' : 'Show this university on homepage' }}">
                                                                <i class="fa fa-eye{{ $university->show_on_home ? '' : '-slash' }}"
                                                                    aria-hidden="true"></i>
                                                            </a> --}}
                                                                <a href="{{ route('frontend.university_details', ['id' => $university->id]) }}"
                                                                    target="_blank" class="btn text-primary"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    data-original-title="View University Details">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                                </a>
                                                                <a href="{{ route('admin.university.edit', $university->id) }}"
                                                                    class="btn text-primary" data-toggle="tooltip"
                                                                    data-placement="top" data-original-title="Edit">
                                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                                </a>
                                                                <input type="hidden" value="{{ $university->id }}">
                                                                <a data-toggle="modal" data-target="#delete_modal_box"
                                                                    class="btn text-primary delete-item">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
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

                {{-- Item delete modal --}}
                <div id="delete_modal_box" class="modal fade delete-modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <img src="{{ asset('backend/assets/images/warning.png') }}" alt=""
                                    width="50" height="46">
                                <h5 class="mt-3 mb-4">Are you sure want to delete this?</h5>
                                <div class="m-t-20 flex">
                                    <form action="{{ route('admin.university.delete') }}" method="POST"
                                        id="deleteForm">
                                        @csrf
                                        <input type="hidden" name="university_id" id="modal_item_id"
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

                {{-- manage fields - modal --}}
                <div class="modal fade" id="manage_fields_modal" tabindex="-1" role="dialog"
                    aria-labelledby="manage-fields-modal" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('admin.university.table_manipulate') }}" method="POST">
                                @csrf
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
                                                                <input type="checkbox" name="name"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['name']) && $table_manipulate_data['name'] == 'on') checked @endif>
                                                                University Name
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="continent_id"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['continent_id']) && $table_manipulate_data['continent_id'] == 'on') checked @endif>
                                                                Continent
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="country_id"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['country_id']) && $table_manipulate_data['country_id'] == 'on') checked @endif>
                                                                Country
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="state_id"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['state_id']) && $table_manipulate_data['state_id'] == 'on') checked @endif>
                                                                Province
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="city_id"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['city_id']) && $table_manipulate_data['city_id'] == 'on') checked @endif>
                                                                City
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="dormitories"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['dormitories']) && $table_manipulate_data['dormitories'] == 'on') checked @endif>
                                                                Dormitory
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="short_name"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['short_name']) && $table_manipulate_data['short_name'] == 'on') checked @endif>
                                                                University Short Name
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="status"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['status']) && $table_manipulate_data['status'] == 'on') checked @endif>
                                                                Status
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="show_on_home"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['show_on_home']) && $table_manipulate_data['show_on_home'] == 'on') checked @endif>
                                                                Show On Home
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="major_id"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['major_id']) && $table_manipulate_data['major_id'] == 'on') checked @endif>
                                                                Major
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="scholarships"
                                                                    class="form-check-input"
                                                                    @if (isset($table_manipulate_data['scholarships']) && $table_manipulate_data['scholarships'] == 'on') checked @endif>
                                                                Scholarship
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
                                    <form action="{{ route('admin.university.table_manipulate_filter') }}"
                                        method="POST">
                                        @csrf
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
                                                    <input type="hidden" name="filter_name" class="form-control">
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
                                                                <option value="major">Major</option>
                                                                <option value="scholarship">Scholarship</option>
                                                                <option value="country">Country</option>
                                                                <option value="city">City</option>
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
                                    <form action="{{ route('admin.university.table_manipulate_filter') }}"
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
                                                                                href="{{ route('admin.university.delete_filter_item', ['id' => $filter['id']]) }}">
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

                @include('Backend.components.footer')
            </div>
        </div>
    </div>

    @include('Backend.components.script')

    <script src="{{ asset('backend/assets/js/select2.js') }}"></script>
    <script>
        $('select').select2();
    </script>
    <script>
        $(document).ready(function() {
            $('.filter_child').on('change', function() {
                var filterParent = $(this).data('filter-parent');
                var filterChild = $(this).val();

                var form = $('<form>', {
                    'method': 'POST',
                    'action': '{{ route('admin.university.index.filter') }}'
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

                if (parentValue) {
                    $.ajax({
                        url: '{{ route('admin.university.get_filter_items') }}',
                        type: 'GET',
                        data: {
                            filter: parentValue
                        },
                        success: function(response) {
                            $('#filter_child').empty();
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
