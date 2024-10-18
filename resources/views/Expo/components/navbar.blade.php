<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav ms-auto d-flex align-items-center custom-navbar-width">
        <li class="nav-item">
            <a class="nav-link {{ Route::is('expo.details') ? 'active' : '' }}"
                href="{{ route('expo.details', ['id' => $expo->unique_id]) }}" style="color: white;">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Route::is('expo.schedule') ? 'active' : '' }}"
                href="{{ route('expo.schedule', ['unique_id' => $expo->unique_id]) }}" style="color: white;">Schedule</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('expo.exhibitors') ? 'active' : '' }}"
                href="{{ route('expo.exhibitors', ['unique_id' => $expo->unique_id]) }}"
                style="color: white;">Exhibitors</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('expo.delegates') ? 'active' : '' }}"
                href="{{ route('expo.delegates', ['unique_id' => $expo->unique_id]) }}"
                style="color: white;">Delegates</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('expo.testimonials') ? 'active' : '' }}"
                href="{{ route('expo.testimonials', ['unique_id' => $expo->unique_id]) }}"
                style="color: white;">Testimonial</a>
        </li>
        <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle {{ Route::is('expo.gallery') || Route::is('expo.video') ? 'active' : '' }} text-white"
                href="#" data-toggle="dropdown" id="whyChinaDropdown" aria-expanded="false">
                <span class="mr-2">Media</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown shadow" aria-labelledby="whyChinaDropdown">
                <a class="dropdown-item" href="{{ route('expo.gallery', ['unique_id' => $expo->unique_id]) }}">
                    Gallery
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('expo.video', ['unique_id' => $expo->unique_id]) }}">
                    Video
                </a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="http://studyinchinaexhibition.com/contact" style="color: white;">Join</a>
        </li>
    </ul>
</div>
