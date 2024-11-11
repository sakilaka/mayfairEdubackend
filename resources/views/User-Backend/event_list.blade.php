<!DOCTYPE html>
<html lang="en">

<head>
    @include('User-Backend.components.head')
    <title>{{ env('APP_NAME') }} | My Event</title>
</head>

<body>
    <div class="container-scroller">
        @include('User-Backend.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('User-Backend.components.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            My Event
                        </h3>
                    </div>

                    <div class="row card">
                        <div class="col-sm-12 card-body table-responsive">
                            <table id="order-listing" class="table dataTable-export table-striped dataTable no-footer"
                                role="grid" aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th class="text-left">SL</th>
                                        <th>Event Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Price</th>
                                        <th>Order Date</th>
                                        <th>Payment Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($my_events as $order)
                                        <tr role="row" class="odd">
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td>{{ $order->event->name ?? '' }}</td>
                                            <td>{{ $order->event->startdate ?? '' }}</td>
                                            <td>{{ $order->event->enddate ?? '' }}</td>
                                            <td>{{ format_price($order->amount) ?? 0 }}</td>
                                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $order->order->payment_status ?? '' }}</td>
                                            <td class="text-right">
                                                <a href="{{ route('frontend.event.details', $order->event->id) }}"
                                                    class="btn text-primary" data-toggle="tooltip" data-placement="top"
                                                    data-original-title="View Event Details">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @include('User-Backend.components.footer')
            </div>
        </div>
    </div>

    @include('User-Backend.components.script')

</body>

</html>
