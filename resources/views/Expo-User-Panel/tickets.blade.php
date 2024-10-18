<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo-User-Panel.components.head')
    <title>{{ env('APP_NAME') }} | My Tickets</title>
</head>

<body>
    <div class="container-scroller">
        @include('Expo-User-Panel.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('Expo-User-Panel.components.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            My Tickets
                        </h3>
                    </div>

                    <div class="row card">
                        <div class="col-sm-12 card-body table-responsive">
                            <table id="order-listing" class="table table-striped dataTable no-footer" role="grid"
                                aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th>SL</th>
                                        <th>Ticket No</th>
                                        <th>Registration Date</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr role="row" class="odd">
                                        <td class="text-left">1</td>
                                        <td
                                            style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                                            <a href="{{ route('expo_module.expo-ticket', ['ticket_no' => $userData->id]) }}"
                                                target="_blank" style="color: var(--primary_background);"
                                                data-toggle="tooltip" data-placement="top"
                                                data-original-title="{{ $userData->ticket_no }}">
                                                {{ $userData->ticket_no }}
                                            </a>
                                        </td>
                                        <td class="text-left">
                                            {{ date('d M, Y', strtotime($userData->created_at)) }}
                                        </td>
                                        <td class="text-end d-flex justify-content-end">
                                            <a href="{{ route('expo_module.expo-ticket', ['ticket_no' => $userData->id]) }}"
                                                class="btn btn-danger btn-sm py-1" style="margin-right: 8px"
                                                data-toggle="tooltip" data-placement="top"
                                                data-original-title="View this ticket ({{ $userData->ticket_no }})"
                                                target="_blank">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                <span style="font-weight: 600">View</span>
                                            </a>
                                            <a href="{{ route('expo_module.expo-ticket', ['ticket_no' => $userData->id]) }}?download"
                                                class="btn btn-danger btn-sm py-1" style="margin-right: 8px"
                                                data-toggle="tooltip" data-placement="top"
                                                data-original-title="Download this ticket ({{ $userData->ticket_no }})"
                                                target="_blank">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                <span style="font-weight: 600">Download</span>
                                            </a>
                                            <a href="{{ route('expo_module.expo-ticket', ['ticket_no' => $userData->id]) }}?print"
                                                class="btn btn-danger btn-sm py-1" data-toggle="tooltip"
                                                data-placement="top"
                                                data-original-title="Print this ticket ({{ $userData->ticket_no }})"
                                                target="_blank">
                                                <i class="fa fa-print" aria-hidden="true"></i>
                                                <span style="font-weight: 600">Print</span>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @include('Expo-User-Panel.components.footer')
            </div>
        </div>

        @include('Expo-User-Panel.components.wrapper-footer')
    </div>

    @include('Expo-User-Panel.components.script')
</body>

</html>
