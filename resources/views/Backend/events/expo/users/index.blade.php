<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Expo Participants</title>

    <style>
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
                            Expo Participants
                        </h3>

                        <nav aria-label="breadcrumb">
                            @php
                                $add_participant_route = match (request()->type) {
                                    'main' => route('admin.expo.add_participator', ['type' => request()->type]),
                                    'site' => route('admin.expo-site.add_participator', ['type' => request()->type]),
                                    default => '#',
                                };
                            @endphp

                            <a href="{{ $add_participant_route }}" class="btn btn-secondary-bg">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Add Participator
                            </a>
                            <button class="btn btn-primary-bg" data-toggle="modal" data-target="#sendMailToAllModal">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                Send email to all
                            </button>
                        </nav>
                    </div>

                    @if (request()->type === 'main')
                        <form action="{{ route('admin.expo.users.filter', ['type' => request()->type]) }}"
                            method="POST">
                            @csrf

                            <div class="my-2 justify-content-end row" style="gap: 5px">
                                <select class="filter_child col-md-4 col-lg-3 form-control form-control-lg"
                                    name="filter_participant" id="filter_participant">
                                    <option value="">Select Expo</option>
                                    <option value="all"
                                        {{ isset($filtered_expo) && $filtered_expo === 'all' ? 'selected' : '' }}>All
                                    </option>
                                    @foreach ($expos as $expo)
                                        <option value="{{ $expo->unique_id }}"
                                            {{ isset($filtered_expo) && $filtered_expo === $expo->unique_id ? 'selected' : '' }}>
                                            {{ $expo->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    @endif

                    <div class="row card">
                        <div class="col-sm-12 card-body table-responsive">
                            <table id="order-listing" class="table table-striped dataTable no-footer" role="grid"
                                aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Ticket No.</th>
                                        @if (request()->type === 'main')
                                            <th>Expo</th>
                                        @endif
                                        <th>ID Type</th>
                                        <th>ID No.</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expo_users as $user)
                                        <tr role="row" class="odd">
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td
                                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                                                <img src="{{ $user->photo ?? asset('frontend/images/no-profile.jpg') }}"
                                                    alt="" width="30px" height="30px"
                                                    style="margin-right: 8px">
                                                <span target="_blank" style="color: var(--primary_background);"
                                                    data-toggle="tooltip" data-placement="top"
                                                    data-original-title="{{ $user->first_name . ' ' . $user->last_name }}">
                                                    {{ $user->first_name . ' ' . $user->last_name }}
                                                </span>
                                            </td>
                                            <td>
                                                @php
                                                    if ($user['expo_id']) {
                                                        $ticket_url = route('expo.expo-ticket', [
                                                            'unique_id' => $user['expo_id'],
                                                            'ticket_no' => $user->id,
                                                        ]);
                                                    } else {
                                                        $ticket_url =
                                                            env('APP_EXPO_DOMAIN') . '/expo-ticket' . '/' . $user->id;
                                                    }
                                                @endphp
                                                <a href="{{ $ticket_url }}" style="color: var(--primary_background);"
                                                    target="_blank">
                                                    {{ $user->ticket_no }}
                                                </a>
                                            </td>
                                            @if (request()->type === 'main' && $user['expo_id'])
                                                <td>
                                                    <a href="{{ route('expo.details', ['id' => $user['expo_id']]) }}"
                                                        style="color: var(--primary_background);" target="_blank">
                                                        {{ strtoupper($user['expo_id']) }}
                                                    </a>
                                                </td>
                                            @endif
                                            <td>{{ $user->id_type }}</td>
                                            <td>{{ $user->id_no }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->email }}</td>

                                            <td class="text-end d-flex justify-content-end">
                                                <a href="javascript:void(0)" class="btn text-primary show-participant"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="View Participant's Data"
                                                    data-ticket-no="{{ $user->ticket_no }}">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>

                                                <a href="javascript:void(0)" class="btn text-primary"
                                                    data-toggle="modal" data-target="#emailModal"
                                                    data-original-title="Send email to this participant"
                                                    data-participant-name="{{ $user->first_name . ' ' . $user->last_name }}"
                                                    data-participant-email="{{ $user->email }}">
                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                                    Send Mail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end mt-3">
                                <div class="pagination-container">
                                    {{ $expo_users->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Individual Email Modal -->
                <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="emailModalLabel">Send Email to Participant</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.expo.send_mail', ['type' => request()->type]) }}"
                                method="POST">
                                @csrf
                                <div class="modal-body">
                                    <!-- Participant's Email (Readonly) -->
                                    <div class="form-group">
                                        <label for="participantEmail">Email</label>
                                        <input type="email" class="form-control" id="participantEmail" name="email"
                                            readonly>
                                    </div>
                                    <!-- Email Subject -->
                                    <div class="form-group">
                                        <label for="emailSubject">Subject</label>
                                        <input type="text" class="form-control" id="emailSubject" name="subject"
                                            required>
                                    </div>
                                    <!-- Email Body -->
                                    <div class="form-group">
                                        <label for="emailBody">Message</label>
                                        <textarea class="form-control" id="emailBody" name="body" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Send Email</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Send Email to all - Modal -->
                <div class="modal fade" id="sendMailToAllModal" tabindex="-1" role="dialog"
                    aria-labelledby="sendMailToAllLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('admin.expo.send_mail_all', ['type' => request()->type]) }}"
                                method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="sendMailToAllLabel">Send Email to All Exhibitors</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Subject input -->
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" class="form-control" id="subject" name="subject"
                                            required>
                                    </div>
                                    <!-- Body textarea -->
                                    <div class="form-group">
                                        <label for="body">Message</label>
                                        <textarea class="form-control" id="body" name="body" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Send Email</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Participant Details Modal -->
                <div class="modal fade" id="participantModal" tabindex="-1" role="dialog"
                    aria-labelledby="participantModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-bold" id="participantModalLabel">Participant
                                    Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <div class="mb-3">
                                            <img id="modalPhoto" src="" alt="Participant Photo"
                                                width="150"
                                                style="height: auto; border-radius: 5px; margin-bottom: 10px;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p style="font-size: 14px"><strong>Ticket No:</strong> <span
                                                id="modalTicketNo"></span></p>
                                        <p style="font-size: 14px"><strong>Email:</strong> <span
                                                id="modalEmail"></span></p>
                                        <p style="font-size: 14px"><strong>First Name:</strong> <span
                                                id="modalFirstName"></span></p>
                                        <p style="font-size: 14px"><strong>Last Name:</strong> <span
                                                id="modalLastName"></span></p>
                                        <p style="font-size: 14px"><strong>ID Type:</strong> <span
                                                id="modalIdType"></span></p>
                                        <p style="font-size: 14px"><strong>ID No:</strong> <span
                                                id="modalIdNo"></span></p>
                                        <p style="font-size: 14px"><strong>Nationality:</strong> <span
                                                id="modalNationality"></span></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p style="font-size: 14px"><strong>Sex:</strong> <span id="modalSex"></span>
                                        </p>
                                        <p style="font-size: 14px"><strong>Date of Birth:</strong> <span
                                                id="modalDob"></span></p>
                                        <p style="font-size: 14px"><strong>Phone:</strong> <span
                                                id="modalPhone"></span></p>
                                        <p style="font-size: 14px"><strong>Profession:</strong> <span
                                                id="modalProfession"></span></p>
                                        <p style="font-size: 14px"><strong>Institution:</strong> <span
                                                id="modalInstitution"></span></p>
                                        <p style="font-size: 14px"><strong>Program:</strong> <span
                                                id="modalProgram"></span></p>
                                        <p style="font-size: 14px"><strong>Degree:</strong> <span
                                                id="modalDegree"></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
        $('#filter_participant').on('change', function() {
            $(this).closest('form').submit();
        });
    </script>

    <script>
        $('#emailModal').on('show.bs.modal', function(event) {
            var modal = $(this);
            modal.find('.modal-title').text('');
            modal.find('#participantEmail').val('');

            var button = $(event.relatedTarget);
            var participantName = button.data('participant-name');
            var participantEmail = button.data('participant-email');

            modal.find('.modal-title').text('Send Email to ' + participantName);
            modal.find('#participantEmail').val(participantEmail);
        });

        let queue_status = @json(session('status'));
        if (queue_status === 'success') {
            $.ajax({
                url: '{{ route('admin.expo.start_queue_mail') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('Request was successful:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Error occurred:', error);
                }
            });
        }
    </script>

    <script>
        $('.show-participant').on('click', function() {
            var ticketNo = $(this).data('ticket-no');
            var noProfileImage = '{{ asset('frontend/images/no-profile.jpg') }}';

            clearModalContent();
            $.ajax({
                url: '{{ route('admin.expo.show_participant', ['type' => request()->type]) }}',
                method: 'GET',
                data: {
                    ticket_no: ticketNo
                },
                success: function(response) {
                    $('#participantModal').modal('show');

                    $('#modalPhoto').attr('src', response.photo ? response.photo : noProfileImage);
                    $('#modalTicketNo').text(response.ticket_no);
                    $('#modalEmail').text(response.email);
                    $('#modalFirstName').text(response.first_name);
                    $('#modalLastName').text(response.last_name);
                    $('#modalIdType').text(response.id_type);
                    $('#modalIdNo').text(response.id_no);
                    $('#modalNationality').text(response.nationality);
                    $('#modalSex').text(response.sex);
                    $('#modalDob').text(response.dob);
                    $('#modalPhone').text(response.phone);
                    $('#modalProfession').text(response.profession);
                    $('#modalInstitution').text(response.institution);
                    $('#modalProgram').text(response.program);
                    $('#modalDegree').text(response.degree);
                },
                error: function(xhr, status, error) {
                    alert('Failed to fetch participant data. Please try again.');
                }
            });

            // Function to clear modal content
            function clearModalContent() {
                $('#modalPhoto').attr('src', noProfileImage);
                $('#modalTicketNo').text('');
                $('#modalEmail').text('');
                $('#modalFirstName').text('');
                $('#modalLastName').text('');
                $('#modalIdType').text('');
                $('#modalIdNo').text('');
                $('#modalNationality').text('');
                $('#modalSex').text('');
                $('#modalDob').text('');
                $('#modalPhone').text('');
                $('#modalProfession').text('');
                $('#modalInstitution').text('');
                $('#modalProgram').text('');
                $('#modalDegree').text('');
            }
        });
    </script>
</body>

</html>
