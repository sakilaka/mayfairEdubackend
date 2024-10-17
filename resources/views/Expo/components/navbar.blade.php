<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav ms-auto d-flex align-items-center custom-navbar-width">
        <li class="nav-item">
            <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}"
                style="color: white;">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#" style="color: white;" target="_blank">Schedule</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('expo.exhibitors', ['expo_id' => $expo->unique_id]) }}"
                style="color: white;">Exhibitors</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="http://studyinchinaexhibition.com/exhibitors" style="color: white;"
                target="_blank">Delegates</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="http://studyinchinaexhibition.com/exhibitors" style="color: white;"
                target="_blank">Testimonial</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="http://studyinchinaexhibition.com/gallery" style="color: white;"
                target="_blank">Gallery</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="http://studyinchinaexhibition.com/contact" style="color: white;"
                target="_blank">Join</a>
        </li>
    </ul>
</div>
