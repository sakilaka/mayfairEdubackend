<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | All Exhibitors</title>

    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding: 2px 0px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 12px;
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
                            All Exhibitors
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="javascript:void(0);" class="btn btn-primary btn-fw" data-toggle="modal"
                                data-target="#manage_exhibitors_modal_box">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add Exhibitor
                            </a>
                        </nav>
                    </div>

                    <div class="row card">
                        <div class="col-sm-12 card-body table-responsive">
                            <table id="order-listing" class="table table-striped dataTable no-footer" role="grid"
                                aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th>SL</th>
                                        <th>Exhibitor</th>
                                        <th>Address</th>
                                        <th class="text-center">Show in Expo</th>
                                        <th class="text-center">Position</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exhibitors as $exhibitor)
                                        <tr role="row" class="odd">
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td
                                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                                                <img src="{{ $exhibitor->image_show }}" alt="" width="30px"
                                                    height="30px" style="margin-right: 8px">
                                                <a href="{{ route('expo.exhibitor.details', ['exhibitor_id' => $exhibitor->id]) }}"
                                                    target="_blank" style="color: var(--primary_background);"
                                                    data-toggle="tooltip" data-placement="top"
                                                    data-original-title="{{ $exhibitor->name }}">
                                                    {{ $exhibitor->name }}
                                                </a>
                                            </td>
                                            <td class="text-left">{{ $exhibitor->address }}</td>
                                            <td class="text-center">
                                                @if ($exhibitor->show_in_expo == true)
                                                    <a
                                                        href="{{ route('admin.expo-site.exhibitors.toggle_show_in_expo', ['id' => $exhibitor->id, 'status' => 0]) }}">
                                                        <span class="badge badge-success" data-toggle="tooltip"
                                                            data-placement="top"
                                                            data-original-title="Hide this exhibitor from expo">Showing</span>
                                                    </a>
                                                @elseif($exhibitor->show_in_expo == false)
                                                    <a
                                                        href="{{ route('admin.expo-site.exhibitors.toggle_show_in_expo', ['id' => $exhibitor->id, 'status' => 1]) }}">
                                                        <span class="badge badge-danger" data-toggle="tooltip"
                                                            data-placement="top"
                                                            data-original-title="Show this exhibitor from expo">Hidden</span>
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span>{{ $exhibitor->position_in_expo }}</span>
                                                <a data-toggle="modal" class="btn text-primary"
                                                    data-exhibitor-id="{{ $exhibitor->id }}"
                                                    data-current-position="{{ $exhibitor->position_in_expo }}"
                                                    data-target="#positionModal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-arrow-down-up"
                                                        viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5m-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5" />
                                                    </svg>
                                                </a>
                                            </td>
                                            <td class="text-end d-flex justify-content-end">
                                                <a class="btn text-primary"
                                                    href="{{ route('admin.expo-site.exhibitor.edit', ['exhibitor_id' => $exhibitor->id]) }}">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>

                                                <input type="hidden" value="{{ $exhibitor->id }}">
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
                                    <form action="{{ route('admin.expo-site.exhibitors.delete') }}" method="POST"
                                        id="deleteForm">
                                        @csrf
                                        <input type="hidden" name="exhibitor_id" id="modal_item_id" value="">
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

                {{-- manage exhibitors modal --}}
                <div id="manage_exhibitors_modal_box" class="modal fade delete-modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5 class="mt-3 mb-4">Select an university to mark as an Exhibitor</h5>
                                <div class="m-t-20">
                                    <form action="{{ route('admin.expo-site.exhibitors.store') }}" method="POST"
                                        id="manageExhibitorsForm">
                                        @csrf
                                        <div class="form-group">
                                            <select class="form-control form-control-lg" id="university_select"
                                                name="university_id[]" multiple required>
                                                <option value=""></option>
                                                @foreach ($available_universities as $university)
                                                    <option value="{{ $university->id }}">{{ $university->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                    <div class="mt-3 d-flex justify-content-end">
                                        <a href="#" class="btn btn-success" data-dismiss="modal"
                                            style="margin-right: 5px">Cancel</a>
                                        <a class="btn btn-danger"
                                            onclick="document.getElementById('manageExhibitorsForm').submit()">Confirm</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Position Modal -->
                <div class="modal fade" id="positionModal" tabindex="-1" role="dialog"
                    aria-labelledby="positionModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="positionModalLabel">Update Exhibitor Position</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.expo-site.exhibitors.position_in_expo') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="currentPosition">Current Position</label>
                                        <input type="text" class="form-control" id="currentPosition"
                                            name="current_position">
                                        <input type="hidden" id="exhibitorId" name="exhibitor_id">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Position</button>
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


    <script src="{{ asset('backend/assets/js/select2.js') }}"></script>
    <script>
        $('select').select2({
            placeholder: 'Select an option'
        });

        $('#positionModal').on('show.bs.modal', function(event) {
            var modal = $(this);
            modal.find('#currentPosition').val('');
            modal.find('#exhibitorId').val('');

            var button = $(event.relatedTarget);
            var currentPosition = button.data('current-position');
            var exhibitorId = button.data('exhibitor-id');

            modal.find('#currentPosition').val(currentPosition);
            modal.find('#exhibitorId').val(exhibitorId);
        });
    </script>
</body>

</html>
