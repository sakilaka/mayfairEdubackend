<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Manage Employee & Permissions</title>

    <style>
        .fs-09 {
            font-size: 0.9rem !important;
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
                            Manage Employee & Permissions
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('backend.admin.manage_employee.create') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Add Employee</a>
                        </nav>
                    </div>

                    <div class="row card">
                        <div class="col-sm-12 card-body table-responsive">
                            <table id="order-listing" class="table table-striped dataTable no-footer" role="grid"
                                aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th>SL</th>
                                        <th>Employee ID</th>
                                        <th>Designation</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Office</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr role="row" class="odd">
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td>{{ $employee->employee_id }}</td>
                                            <td>{{ ucwords($employee->role) }}</td>
                                            <td>
                                                <img src="{{ $employee->image_show }}" alt="{{ $employee->name }}"
                                                    width="40px" height="40px">&nbsp;&nbsp;
                                                {{ $employee->name }}
                                            </td>
                                            <td>{{ $employee->mobile }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->office?->name }}</td>
                                            <td class="text-right">
                                                <a href="#" class="btn text-primary" data-toggle="tooltip"
                                                    data-placement="top" title="Manage Module(s)"
                                                    id="manage_permission_modal_trigger"
                                                    data-employee-name="{{ $employee->name }}"
                                                    data-employee-id="{{ $employee->id }}">
                                                    <i class="fa fa-wrench" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('backend.admin.manage_employee.edit', $employee->id) }}"
                                                    class="btn text-primary" data-toggle="tooltip" data-placement="top"
                                                    title="Edit Employee">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>
                                                <input type="hidden" value="{{ $employee->id }}">
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
                                    <form action="{{ route('backend.admin.manage_employee.delete') }}" method="POST"
                                        id="deleteForm">
                                        @csrf
                                        <input type="hidden" name="employee_id" id="modal_item_id" value="">
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

                {{-- manage permissions - modal --}}
                <div class="modal fade" id="manage_permissions_modal" tabindex="-1" role="dialog"
                    aria-labelledby="manage-permissions-modal" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('backend.admin.manage_employee.manage_permissions') }}"
                                method="POST">
                                @csrf
                                <input type="hidden" id="modal_employee_id" name="employee_id" value="">

                                <div class="modal-header">
                                    <h5 class="modal-title">Assign the module(s) for
                                        <span id="modal_employee_name"></span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="row">

                                                    <div class="col-md-6" id="permissions-column-1">
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="home_module"
                                                                    class="form-check-input">
                                                                Home
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="programs_module"
                                                                    class="form-check-input">
                                                                Programs
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox"
                                                                    name="program_applications_module"
                                                                    class="form-check-input">
                                                                Program Applications
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="university_module"
                                                                    class="form-check-input">
                                                                University
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="location_module"
                                                                    class="form-check-input">
                                                                Location
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="all_users_module"
                                                                    class="form-check-input">
                                                                All Users
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="testimonials_module"
                                                                    class="form-check-input">
                                                                Testimonials & Reviews
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="consultation_module"
                                                                    class="form-check-input">
                                                                Consultations
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" id="permissions-column-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="expo_module"
                                                                    class="form-check-input">
                                                                Expo
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="blogs_module"
                                                                    class="form-check-input">
                                                                Blogs & Events
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="office_module"
                                                                    class="form-check-input">
                                                                Office
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="subscriber_module"
                                                                    class="form-check-input">
                                                                Subscriber
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox"
                                                                    name="user_contact_message_module"
                                                                    class="form-check-input">
                                                                User Contact Message
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="notification_module"
                                                                    class="form-check-input">
                                                                Notification
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="appearance_module"
                                                                    class="form-check-input">
                                                                Appearance
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label fs-09">
                                                                <input type="checkbox" name="founders_module"
                                                                    class="form-check-input">
                                                                Founders
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-danger danger-notif" style="font-size: 1rem;">

                                        </p>
                                        <p class="text-muted" style="font-size: 1rem;">Select desired module(s) to
                                            assign for selected employee</p>
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

                @include('Backend.components.footer')
            </div>
        </div>
    </div>

    @include('Backend.components.script')

    <script>
        $(document).on('click', '#manage_permission_modal_trigger', function(event) {
            event.preventDefault();

            let employee_id = $(this).data('employee-id');
            let employee_name = $(this).data('employee-name');

            let requestData = {
                employee_id: employee_id,
            };

            $.ajax({
                url: '{{ route('backend.admin.manage_employee.get_permissions') }}',
                type: 'GET',
                data: requestData,
                dataType: 'json',
                success: function(response) {
                    var permissions = response.data;

                    $('#permissions-column-1 input[type="checkbox"], #permissions-column-2 input[type="checkbox"]')
                        .each(function() {
                            var permissionName = $(this).attr('name');
                            if ($.inArray(permissionName, permissions) !== -1) {
                                $(this).prop('checked', true);
                            } else {
                                $(this).prop('checked', false);
                            }
                        });

                    $('#modal_employee_id').val(employee_id);
                    $('#modal_employee_name').text("'" + employee_name + "'");
                },
                error: function(xhr, status, error) {
                    $('.danger-notif').text('Something Went Wrong!');
                }
            });

            $('#manage_permissions_modal').modal('toggle');
        });
    </script>
</body>

</html>
