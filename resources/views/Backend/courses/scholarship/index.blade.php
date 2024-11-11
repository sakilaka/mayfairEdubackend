<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | All Scholarship</title>
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
                            All Scholarship
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.scholarship.create') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Add Scholarship</a>
                        </nav>
                    </div>

                    <div class="row card">
                        <div class="col-sm-12 card-body table-responsive">
                            <table id="order-listing" class="table table-striped dataTable no-footer" role="grid"
                                aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th>SL</th>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Tuition</th>
                                        <th class="text-center" data-toggle="tooltip" data-placement="top"
                                            data-original-title="Accommodation">
                                            Accom.
                                        </th>
                                        <th class="text-center">Insurance</th>
                                        <th class="text-center">
                                            Stipend (Monthly)
                                        </th>
                                        <th class="text-center">
                                            Stipend (Yearly)
                                        </th>
                                        <th class="text-center">Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($scholarships as $item)
                                        <tr role="row" class="odd">
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td
                                                style="white-space: nowrap; 
                                                        overflow: hidden; 
                                                        text-overflow: ellipsis; 
                                                        max-width: 100px;">
                                                <span data-toggle="tooltip" data-placement="top"
                                                    data-original-title="{{ $item->title }}">
                                                    {{ $item->title }}
                                                </span>
                                            </td>
                                            <td
                                                style="white-space: nowrap; 
                                                        overflow: hidden; 
                                                        text-overflow: ellipsis; 
                                                        max-width: 100px;">
                                                <span data-toggle="tooltip" data-placement="top"
                                                    data-original-title="{{ $item->type }}">
                                                    {{ $item->type }}
                                                </span>
                                            </td>
                                            <td class="text-center">{{ $item->scholarship_amount }}</td>
                                            <td class="text-center">{{ $item->tuition_fee }}</td>
                                            <td class="text-center">{{ $item->accommodation_fee }}</td>
                                            <td class="text-center">{{ $item->insurance_fee }}</td>
                                            <td class="text-center">{{ $item->stipend_monthly }}</td>
                                            <td class="text-center">{{ $item->stipend_yearly }}</td>
                                            <td class="text-center">
                                                @if ($item->status == 1)
                                                    <a href="{{ route('admin.scholarship.status', $item->id) }}">
                                                        <span class="badge badge-success">Active</span>
                                                    </a>
                                                @elseif($item->status == 0)
                                                    <a href="{{ route('admin.scholarship.status', $item->id) }}">
                                                        <span class="badge badge-danger">Inactive</span>
                                                    </a>
                                                @endif
                                            </td>
                                            {{-- <td class="text-right">
                                                <a href="{{ route('admin.scholarship.edit', $item->id) }}"
                                                    class="btn text-primary" data-toggle="tooltip"
                                                                data-placement="top"
                                                                data-original-title="Edit Scholarship">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>
                                                <input type="hidden" value="{{ $item->id }}">
                                                <a data-toggle="modal" data-target="#delete_modal_box"
                                                    class="btn text-primary delete-item">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </td> --}}

                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="fa fa-ellipsis-v text-primary"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <div class="d-flex justify-content-end">
                                                            <a href="{{ route('admin.scholarship.edit', $item->id) }}"
                                                                class="btn text-primary" data-toggle="tooltip"
                                                                data-placement="top"
                                                                data-original-title="Edit Scholarship">
                                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                            </a>
                                                            <input type="hidden" value="{{ $item->id }}">
                                                            <a data-toggle="modal" data-target="#delete_modal_box"
                                                                class="btn text-primary delete-item">
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
                                    <form action="{{ route('admin.scholarship.delete') }}" method="POST"
                                        id="deleteForm">
                                        @csrf
                                        <input type="hidden" name="scholarship_id" id="modal_item_id" value="">
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
