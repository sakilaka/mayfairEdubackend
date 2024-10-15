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
        <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="whyChinaDropdown"
                aria-expanded="false">
                <span class="mr-2">Why China</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown shadow" aria-labelledby="whyChinaDropdown">
                <a class="dropdown-item" href="https://www.studyinchina.edu.cn/lxzgywz/414369/414371/index.html"
                    target="_blank">
                    10 Reasons for Study in China
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="https://www.studyinchina.edu.cn/lxzgywz/414369/414373/414354/index.html"
                    target="_blank">
                    Discover China
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="https://www.studyinchina.edu.cn/lxzgywz/414369/414386/414355/index.html"
                    target="_blank">
                    Education in China
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="https://www.studyinchina.edu.cn/lxzgywz/414369/414395/414356/index.html"
                    target="_blank">
                    Scholarships
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="https://www.studyinchina.edu.cn/lxzgywz/414369/414404/index.html"
                    target="_blank">
                    Laws & Regulations
                </a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('expo.about_us') ? 'active' : '' }}"
                href="{{ route('expo.about_us') }}" style="color: white;">About US</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('expo.contact') ? 'active' : '' }}"
                href="{{ route('expo.contact') }}" style="color: white;">Contact</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  {{ Route::is('expo.gallery') ? 'active' : '' }}"
                href="{{ route('expo.gallery') }}" style="color: white;">Gallery</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('expo.exhibitors') ? 'active' : '' }}"
                href="{{ route('expo.exhibitors') }}" style="color: white;">Exhibitors</a>
        </li>
        <li class="nav-item">
            <a class="nav-link registration-btn btn-danger-bg px-2" href="{{ route('expo_module.expo-form') }}"
                style="color: white;">Participate</a>
        </li>
    </ul>
</div>
