<style>
    .theme-option-appearance .nav-item .nav-link{
        font-size: 0.9rem;
    }
    .border-bottom-primary {
        border-left: 2px solid #237c3a !important;
        border-right: 2px solid #237c3a !important;
        color: #237c3a !important;
        font-weight: bold;
    }
</style>

<ul class="nav nav-tabs nav-tabs-vertical theme-option-appearance">
    <li class="nav-item">
        <a class="nav-link {{ Route::is('backend.theme-options') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('backend.theme-options') }}">
            Logo
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('backend.theme-options-home-popup') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('backend.theme-options-home-popup') }}">
            Home Popup
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('backend.theme-options-header') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('backend.theme-options-header') }}">
            Header
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('backend.theme-options-footer') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('backend.theme-options-footer') }}">
            Footer
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('backend.theme-options-color') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('backend.theme-options-color') }}">
            Color
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('backend.social-media') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('backend.social-media') }}">
            Social Media
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('backend.theme-options-seo') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('backend.theme-options-seo') }}">
            SEO
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('backend.theme-options-google-map') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('backend.theme-options-google-map') }}">
            Google Map
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('backend.theme-options-social-login') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('backend.theme-options-social-login') }}">
            Social Login
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('backend.custom-html') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('backend.custom-html') }}">
            Custom HTML
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('backend.custom-css') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('backend.custom-css') }}">
            Custom CSS
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('backend.custom-js') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('backend.custom-js') }}">
            Custom JS
        </a>
    </li>
</ul>
