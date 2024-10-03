<style>
    .theme-option-appearance .nav-item .nav-link {
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
        <a class="nav-link {{ Route::is('admin.ourServices_page') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('admin.ourServices_page') }}">
            Our Services Page
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.whyChina_page') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('admin.whyChina_page') }}">
            Why China Page
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.aboutChina_page') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('admin.aboutChina_page') }}">
            About China Page
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.companyDetails_page') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('admin.companyDetails_page') }}">
            Company Details Page
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.gallery_page') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('admin.gallery_page') }}">
            Gallery Page
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.authorizationLetters_page') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('admin.authorizationLetters_page') }}">
            Authorization Letters Page
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.activities_page') || Route::is('admin.activities_page_add') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('admin.activities_page') }}">
            Activities Page
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.founders_co_founders_page') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('admin.founders_co_founders_page') }}">
            Founders & Co-Founders Page
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.learner') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('admin.learner') }}">
            Learner Page
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.instructor') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('admin.instructor') }}">
            Partner Page
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.library') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('admin.library') }}">
            Library Page
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.manage_faq') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('admin.manage_faq') }}">
            FAQ Page
        </a>
    </li>
</ul>
