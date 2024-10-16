<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav ms-auto d-flex align-items-center custom-navbar-width">
        <li class="nav-item">
            <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}"
                style="color: white;">Home</a>
        </li>
        {{-- <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="whyChinaDropdown"
                aria-expanded="false">
                <span class="mr-2">Why China</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown shadow" aria-labelledby="whyChinaDropdown">
                <a class="dropdown-item" href="https://www.studyinchina.edu.cn/lxzgywz/414369/414371/index.html"
                    target="_blank">
                    10 Reasons for Study in China
                </a>
            </div>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" href="#" style="color: white;"
                target="_blank">Schedule</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="http://studyinchinaexhibition.com/about-us" style="color: white;"
                target="_blank">About US</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="http://studyinchinaexhibition.com/contact" style="color: white;"
                target="_blank">Contact</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="http://studyinchinaexhibition.com/gallery" style="color: white;"
                target="_blank">Gallery</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="http://studyinchinaexhibition.com/exhibitors" style="color: white;"
                target="_blank">Exhibitors</a>
        </li>
        <li class="nav-item">
            <a class="nav-link registration-btn btn-danger-bg px-2"
                href="http://studyinchinaexhibition.com/expo-sign-up" style="color: white;">Participate</a>
        </li>
    </ul>
</div>
