<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | All Office</title>
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
                            All Office
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('backend.admin.office.create') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Add Office</a>
                        </nav>
                    </div>

                    <div class="row card">
                        <div class="col-sm-12 card-body table-responsive">
                            <table id="order-listing" class="table table-striped dataTable no-footer" role="grid"
                                aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Contact</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($offices as $office)
                                        <tr role="row" class="odd">
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td class="text-left">
                                                <a
                                                    href="{{ route('frontend.office_details', ['office_id' => $office->id]) }}" style="color: var(--primary_background)" target="_blank">
                                                    {{ $office->name }}
                                                </a>
                                            </td>
                                            <td class="text-left" data-toggle="tooltip" data-placement="top"
                                                data-original-title="{{ $office->address . ', ' . $office->city . ', ' . $office->country }}">
                                                {{ Illuminate\Support\Str::limit($office->address . ', ' . $office->city . ', ' . $office->country, 40, '...') }}
                                            </td>
                                            <td class="text-left" data-toggle="tooltip" data-placement="top"
                                                data-original-title="{{ implode(', ', json_decode($office->contact_no, true)) }}">
                                                {{ Illuminate\Support\Str::limit(implode(', ', json_decode($office->contact_no, true)), 40, '...') }}
                                            </td>
                                            <td class="text-right">
                                                <a href="{{ route('frontend.office_details', ['office_id' => $office->id]) }}" target="_blank"
                                                    class="btn text-primary" data-toggle="tooltip" data-placement="top"
                                                    data-original-title="View Office Details">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('backend.admin.office.edit', $office->id) }}"
                                                    class="btn text-primary" data-toggle="tooltip" data-placement="top"
                                                    data-original-title="Edit Office Details">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>
                                                <input type="hidden" value="{{ $office->id }}">
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
                                    <form action="{{ route('backend.admin.office.delete') }}" method="POST"
                                        id="deleteForm">
                                        @csrf
                                        <input type="hidden" name="office_id" id="modal_item_id" value="">
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
