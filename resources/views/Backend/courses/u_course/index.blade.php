<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | All Program</title>
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
                            All Program
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.u_course.create') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Add Program</a>
                        </nav>
                    </div>

                    <div class="row card">
                        <div class="col-sm-12 card-body">
                            <table id="order-listing" class="table table-striped dataTable no-footer" role="grid"
                                aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th>SL</th>
                                        <th>Course Name</th>
                                        <th>University Name</th>
                                        <th class="text-center">Service Charge</th>
                                        <th class="text-center">Application Fees</th>
                                        <th class="text-center">Yearly Fee</th>
                                        <th class="text-center">Show On Home</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr role="row" class="odd">
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td
                                                style="font-size: 0.9rem; 
                                                        white-space: nowrap; 
                                                        overflow: hidden; 
                                                        text-overflow: ellipsis; 
                                                        max-width: 200px;">
                                                <a href="{{ route('frontend.course.details', ['id' => $course->id]) }}"
                                                    data-toggle="tooltip" data-placement="top"
                                                    data-original-title="{{ $course->name }}" target="_blank"
                                                    style="color: var(--primary_background);">
                                                    {{ $course->name }}
                                                </a>
                                            </td>
                                            <td
                                                style="font-size: 0.9rem; 
                                                        white-space: nowrap; 
                                                        overflow: hidden; 
                                                        text-overflow: ellipsis; 
                                                        max-width: 200px;">
                                                <a href="{{ route('frontend.university_details', ['id' => $course->university?->id ?? 0]) }}"
                                                    target="_blank" style="color: var(--primary_background);"
                                                    data-toggle="tooltip" data-placement="top"
                                                    data-original-title="{{ $course->university?->name ?? '' }}">
                                                    {{ $course->university?->name ?? '' }}
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                {{-- {{ $course->service_charge }} --}}
                                                {{ $course->service_charge_1 . ' - ' . $course->service_charge_2 }}
                                            </td>
                                            <td class="text-center">{{ $course->application_charge }}</td>
                                            <td class="text-center">{{ $course->year_fee }}</td>
                                            <td class="text-center">
                                                @if ($course->show_on_home == 1)
                                                    <a
                                                        href="{{ route('admin.u_course.show_on_home_toggle', $course->id) }}">
                                                        <span class="badge badge-success">Yes</span>
                                                    </a>
                                                @else
                                                    <a
                                                        href="{{ route('admin.u_course.show_on_home_toggle', $course->id) }}">
                                                        <span class="badge badge-danger">No</span>
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($course->status == 1)
                                                    <a href="{{ route('home-category.status_toggle', $course->id) }}">
                                                        <span class="badge badge-success">Active</span>
                                                    </a>
                                                @elseif($course->status == 0)
                                                    <a href="{{ route('home-category.status_toggle', $course->id) }}">
                                                        <span class="badge badge-danger">Inactive</span>
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="text-right d-flex">
                                                <a href="{{ route('admin.u_course.edit', $course->id) }}"
                                                    class="btn text-primary">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>
                                                <input type="hidden" value="{{ $course->id }}">
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
                                    <form action="{{ route('admin.u_course.delete') }}" method="POST" id="deleteForm">
                                        @csrf
                                        <input type="hidden" name="ucourse_id" id="modal_item_id" value="">
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
