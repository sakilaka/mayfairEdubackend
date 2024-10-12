<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | All Consultations</title>

    <link rel="stylesheet"
        href="{{ asset('frontend/application/modules/frontend/views/themes/default/assets/css/select2.min.css') }}">
    <style>
        .select2-container--default .select2-selection--single {
            padding: 5px;
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
                            All Consultations
                        </h3>
                    </div>

                    <form id="filter-form" method="POST" action="{{ route('admin.get_consultation.index.filter') }}">
                        @csrf
                        <div class="row justify-content-end mb-2">
                            <!-- Program Select -->
                            <div class="col-md-3 col-lg-2 mt-1 px-0 ml-2">
                                <select name="status" class="status-select2 form-control form-control-lg">
                                    <option value=""></option>
                                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>
                                        All
                                    </option>
                                    <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>
                                        Submitted
                                    </option>
                                    <option value="in_process"
                                        {{ request('status') == 'in_process' ? 'selected' : '' }}>
                                        In Process
                                    </option>
                                    <option value="file_opened"
                                        {{ request('status') == 'file_opened' ? 'selected' : '' }}>
                                        File Opened
                                    </option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                        Completed
                                    </option>
                                </select>

                            </div>
                        </div>
                    </form>

                    <div class="row card">
                        <div class="col-sm-12 card-body table-responsive">
                            <table id="order-listing" class="table table-striped dataTable no-footer" role="grid"
                                aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($consultations as $consultation)
                                        <tr role="row" class="odd">
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td>{{ $consultation->name }}</td>
                                            <td>{{ $consultation->email ?? '' }}</td>
                                            <td>{{ $consultation->phone ?? '' }}</td>
                                            <td>{{ ucwords($consultation->status) }}</td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="fa fa-ellipsis-v text-primary"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <div class="d-flex">
                                                            <a href="javascript:void(0)"
                                                                class="btn text-primary show-application-support-modal-trigger"
                                                                data-toggle="tooltip" data-placement="top"
                                                                data-original-title="View supports for this application"
                                                                data-application-id="{{ $consultation->id }}">
                                                                <i class="fa fa-users" aria-hidden="true"></i>
                                                            </a>
                                                            <a href="javascript:void(0)"
                                                                class="btn text-primary assign-application-modal-trigger"
                                                                data-toggle="tooltip" data-placement="top"
                                                                data-original-title="Assign Application to Partner"
                                                                data-application-id="{{ $consultation->id }}">
                                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                            </a>

                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top"
                                                                data-original-title="View Consultation"
                                                                class="btn text-primary view-consultation"
                                                                data-id="{{ $consultation->id }}">
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                            </a>

                                                            <a href="{{ route('admin.get_consultation.edit', ['id' => $consultation->id]) }}"
                                                                class="btn text-primary" data-toggle="tooltip"
                                                                data-placement="top"
                                                                data-original-title="Edit Consultation">
                                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                            </a>
                                                            <input type="hidden" value="{{ $consultation->id }}">
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
                                    <form action="{{ route('admin.get_consultation.delete') }}" method="POST"
                                        id="deleteForm">
                                        @csrf
                                        <input type="hidden" name="consultation_id" id="modal_item_id" value="">
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

                <!-- Consultation details view - modal -->
                <div class="modal fade" id="consultationModal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="consultationModalLabel">Consultation Details</h5>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tbody id="consultationDetails">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- assign application to partner - modal --}}
                <div class="modal fade" id="assign_application_to_partner_modal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel-2" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('admin.assign_application_to_employee') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Assign Application To Partner</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="application_id" value="">
                                    <div class="row">
                                        <div class="col-6 mt-3">
                                            <p class="fw-bold">Choose Manager</p>
                                            <select name="manager_id"
                                                class="form-control form-control-lg selectManager select2"
                                                style="width: 100% !important">
                                                <option value="">None</option>
                                                @foreach ($all_managers as $manager)
                                                    @php
                                                        $continentName = !empty($manager->continent_id)
                                                            ? App\Models\Continent::find($manager->continent_id)->name
                                                            : '';
                                                        $roleName = $manager->role ?? '';
                                                    @endphp
                                                    <option value="{{ $manager->id }}">
                                                        {{ $manager->name }}
                                                        @if ($continentName)
                                                            ({{ $continentName }})
                                                        @endif
                                                        @if ($roleName)
                                                            - {{ ucwords($roleName) }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <p class="fw-bold">Choose Support</p>
                                            <select name="support_id"
                                                class="form-control form-control-lg selectSupport select2"
                                                style="width: 100% !important">
                                                <option value="">None</option>
                                                @foreach ($all_supports as $support)
                                                    @php
                                                        $continentName = !empty($support->continent_id)
                                                            ? App\Models\Continent::find($support->continent_id)->name
                                                            : '';
                                                        $roleName = $support->role ?? '';
                                                    @endphp
                                                    <option value="{{ $support->id }}">
                                                        {{ $support->name }}
                                                        @if ($continentName)
                                                            ({{ $continentName }})
                                                        @endif
                                                        @if ($roleName)
                                                            - {{ ucwords($roleName) }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <p class="mt-2">Assign an application to specific user.</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" type="button" class="btn btn-light"
                                        data-dismiss="modal">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Assign</button>
                                </div>
                            </form>
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

                @include('Backend.components.footer')
            </div>
        </div>
    </div>

    @include('Backend.components.script')

    <script src="{{ asset('backend/lib/select2/js/select2.min.js') }}"></script>
    <script>
        $('.status-select2').select2({
            placeholder: 'Select status'
        });

        $(document).ready(function() {
            $('#filter-form').on('change', 'input, select', function() {
                $(this).closest('form').submit();
            });

            // Event listener for the view button
            $('.view-consultation').on('click', function() {
                var consultationId = $(this).data('id');
                $('#consultationDetails').html('')

                $.ajax({
                    url: '{{ route('admin.get_consultation.view', ':id') }}'.replace(':id',
                        consultationId),
                    method: 'GET',
                    success: function(response) {
                        var consultation = response.consultation;

                        var createdAt = new Date(consultation.created_at).toLocaleDateString(
                            'en-US', {
                                day: '2-digit',
                                month: 'short',
                                year: 'numeric'
                            });

                        var tableContent = `
                            <tr>
                                <th>Name</th>
                                <td>${consultation.name}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>${consultation.phone}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>${consultation.email || 'N/A'}</td>
                            </tr>
                            <tr>
                                <th>Major</th>
                                <td>${consultation.major || 'N/A'}</td>
                            </tr>
                            <tr>
                                <th>Degree</th>
                                <td>${consultation.degree || 'N/A'}</td>
                            </tr>
                            <tr>
                                <th>Result</th>
                                <td>${consultation.result || 'N/A'}</td>
                            </tr>
                            <tr>
                                <th>Note</th>
                                <td>${consultation.note || 'N/A'}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>${consultation.status}</td>
                            </tr>
                            <tr>
                                <th>Submitted At</th>
                                <td>${createdAt}</td>
                            </tr>
                        `;

                        $('#consultationDetails').html(tableContent);
                        $('#consultationModal').modal('show');
                    },
                    error: function(xhr) {
                        console.error('Error fetching consultation data:', xhr);
                    }
                });
            });
        });
    </script>

    <script>
        // assign application to user
        $('.assign-application-modal-trigger').click(function() {
            var applicationId = $(this).data('application-id');
            $('input[name="application_id"]').val(applicationId);

            $.ajax({
                url: '{{ route('admin.fetch_application', ':application_id') }}'.replace(':application_id',
                    applicationId),
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        var data = response.data;

                        $('.selectManager').val(data.manager_id).trigger('change');
                        $('.selectSupport').val(data.support_id).trigger('change');

                        $('#assign_application_to_partner_modal').modal('show');
                    } else {
                        alert('Failed to fetch application data: ' + response.message);
                    }
                },
                error: function() {
                    alert('An error occurred while fetching the application data.');
                }
            });
        });

        $('#assign_application_to_partner_modal').on('hidden.bs.modal', function() {
            $(this).find('input[name="application_id"]').val('');
        });

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
</body>

</html>
