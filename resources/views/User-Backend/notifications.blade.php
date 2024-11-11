<!DOCTYPE html>
<html lang="en">

<head>
    @include('User-Backend.components.head')
    <title>{{ env('APP_NAME') }} | My Notification</title>
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
                            My Notification
                        </h3>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            @foreach ($notifications as $notification)
                                @if ($notification->type == 'university')
                                    <div class="list d-flex align-items-center border-bottom py-3">
                                        <img class="img-sm rounded-circle"
                                            src="{{ @$notification->application->student->image_show ?? asset('frontend/images/No-image.jpg') }}"
                                            alt="">
                                        <div class="wrapper w-100 ml-3">
                                            <p class="mb-0" style="font-size: 0.9rem;">
                                                <b>Notification</b>
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa fa-bell text-muted mr-2" aria-hidden="true"></i>
                                                    <a href="{{ !empty($notification->application) ? route('frontend.application-details', @$notification->application->id) : '#' }}"
                                                        class="mb-0 text-dark" style="font-size: 0.9rem;">
                                                        {{ @$notification->text }}</a>
                                                </div>
                                                <small class="text-muted ml-auto">
                                                    {{ date('d M, Y h:i A', strtotime(@$notification->created_at)) }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($notification->type == 'event')
                                    <div class="list d-flex align-items-center border-bottom py-3">
                                        <img class="img-sm rounded-circle"
                                            src="{{ @$notification->event_cart->event->host->image_show }}"
                                            alt="">
                                        <div class="wrapper w-100 ml-3">
                                            <p class="mb-0" style="font-size: 0.9rem;">
                                                <b>{{ @$notification->application->student->name }}</b>
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa fa-bell text-muted mr-2" aria-hidden="true"></i>
                                                    <a href="{{ route('frontend.event.details', $notification->event_cart->event->id) }}"
                                                        class="mb-0 text-dark" style="font-size: 0.9rem;">
                                                        Event:
                                                        {{ @$notification->event_cart->order->order_number }}
                                                    </a>
                                                </div>
                                                <small class="text-muted ml-auto">
                                                    {{ date('d M, Y h:i A', strtotime(@$notification->created_at)) }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="list d-flex align-items-center border-bottom py-3">
                                        <img class="img-sm rounded-circle"
                                            src="{{ Auth::user()->image_show ?? asset('frontend/images/No-image.jpg') }}"
                                            alt="">
                                        <div class="wrapper w-100 ml-3">
                                            <p class="mb-0" style="font-size: 0.9rem;">
                                                <b>Notification</b>
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa fa-bell text-muted mr-2" aria-hidden="true"></i>
                                                    <p class="mb-0 text-dark" style="font-size: 0.9rem;">
                                                        {{ @$notification->text }}
                                                    </p>
                                                </div>
                                                <small class="text-muted ml-auto">
                                                    {{ date('d M, Y h:i A', strtotime(@$notification->created_at)) }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
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
