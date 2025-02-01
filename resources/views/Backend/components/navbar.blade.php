@php
     $header_logo = \App\Models\Tp_option::where('option_name', 'theme_logo')->first();
@endphp
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ url('http://localhost:5173/') }}">
            <img src="{{ @$header_logo->header_image == '' ? @$header_logo->no_image : @$header_logo->header_image_show }}"
            alt="Logo-{{ @$theme_header->company_name }}">
        </a>
        {{-- <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}">
            <img src="{{ asset('backend/assets/images/logo-mini.svg') }}" alt="logo">
        </a> --}}
    </div>
    <div class="navbar-menu-wrapper d-flex justify-content-between align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="fas fa-bars text-primary"></span>
        </button>
        <ul class="navbar-nav">
            <li class="nav-item nav-search d-none d-md-flex">
                <div class="nav-link">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search">
                    </div>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
                @php
                    $notifications = \App\Models\Notification::orderBy('id', 'desc')->paginate(4);
                @endphp

                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                    data-toggle="dropdown">
                    <i class="fas fa-bell mx-0"></i>
                    <span class="count">{{ count($notifications) }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="notificationDropdown">
                    <div class="dropdown-item">
                        <p class="mb-0 font-weight-normal float-left">You have {{ count($notifications) }} new
                            notifications
                        </p>
                        <a href="{{ route('admin.all.notification.index') }}"
                            class="badge badge-pill text-white badge-warning float-right">View all</a>
                    </div>
                    <div class="dropdown-divider"></div>
                    @foreach ($notifications as $notification)
                        @if ($notification->type == 'university')
                            <a href="{{ route('admin.student_appliction_details', $notification->application->id ?? '') }}"
                                class="preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-danger">
                                        <img src="{{ $notification->application->student->image_show ?? '' }}"
                                            alt="{{ $notification->application->student->name ?? '' }}">
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-medium">{{ $notification->text }}</h6>
                                    <p class="font-weight-light small-text">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </a>
                        @elseif ($notification->type == 'event')
                            <a class="preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-danger">
                                        <img src="{{ $notification->event_cart->event->host->image_show }}"
                                            alt="{{ $notification->event_cart->event->name }}">
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-medium">
                                        {{ $notification->event_cart->event->name }}</h6>
                                    <p>{{ $notification->text }}</p>
                                    <p class="font-weight-light small-text">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </a>
                        @elseif ($notification->type == 'package')
                            <a class="preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-danger">
                                        <img src="{{ $notification->image_show }}"
                                            alt="{{ $notification->cart->package->name }}">
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-medium">
                                        {{ $notification->cart->package->name }}</h6>
                                    <p>{{ $notification->text }}</p>
                                    <p class="font-weight-light small-text">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </a>
                        @elseif ($notification->type == 'ebook')
                            <a class="preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-danger">
                                        <img src="{{ @$notification?->cart?->ebook?->user?->image_show }}"
                                            alt="{{ $notification->cart->ebook->title }}">
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-medium">
                                        {{ $notification->cart->ebook->title }}</h6>
                                    <p>{{ $notification->text }}</p>
                                    <p class="font-weight-light small-text">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </a>
                        @else
                            <a class="preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-danger">
                                        <img src="{{ @$notification?->user->image_show }}"
                                            alt="{{ $notification->user->name }}">
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-medium">
                                        Notification
                                    </h6>
                                    <p>{{ $notification->text }}</p>
                                    <p class="font-weight-light small-text">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </a>
                        @endif

                        @if (!$loop->last)
                            <div class="dropdown-divider"></div>
                        @endif
                    @endforeach
                </div>
            </li>

            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown"
                    aria-expanded="false">
                    <span class="mr-2 d-none d-md-inline">{{ Auth::user()->name ?? '' }}</span>
                    <img src="{{ Auth::user()->image_show ?? asset('backend/assets/images/faces/face4.jpg') }}">
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('backend.edit_admin', Auth::user()->id) }}">
                        <i class="fa fa-user text-primary"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="fas fa-power-off text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="fas fa-bars"></span>
        </button>
    </div>
</nav>
