<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Expo Participants</title>
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
                            <a href="{{ route('admin.expo.add_participator') }}" class="btn btn-secondary-bg">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Add Participator
                            </a>
                            <button class="btn btn-primary-bg" data-toggle="modal" data-target="#sendMailToAllModal">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                Send email to all
                            </button>
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
                                        <th>Ticket No.</th>
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
                                                <a href="{{ env('APP_EXPO_DOMAIN') }}/expo-ticket/{{ $user->id }}"
                                                    style="color: var(--primary_background);" target="_blank">
                                                    {{ $user->ticket_no }}
                                                </a>
                                            </td>
                                            <td>{{ $user->id_type }}</td>
                                            <td>{{ $user->id_no }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->email }}</td>

                                            <td class="text-end d-flex justify-content-end">
                                                <a href="javascript:void(0)"
                                                    class="btn text-primary" data-toggle="tooltip" data-placement="top"
                                                    title="View Participant's Data" data-ticket-no="{{ $user->ticket_no }}">
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
                            <form action="{{ route('admin.expo.send_mail') }}" method="POST">
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
                            <form action="{{ route('admin.expo.send_mail_all') }}" method="POST">
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


                @include('Backend.components.footer')
            </div>
        </div>
    </div>

    @include('Backend.components.script')

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

</body>

</html>
