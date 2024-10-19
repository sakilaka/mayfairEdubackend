<style>
    .theme-option-appearance .nav-item .nav-link {
        font-size: 0.9rem;
    }

    .border-bottom-primary {
        border-left: 2px solid var(--primary_background) !important;
        border-right: 2px solid var(--primary_background) !important;
        color: var(--primary_background) !important;
        font-weight: bold;
    }
</style>

<ul class="nav nav-tabs nav-tabs-vertical theme-option-appearance">
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.expo.media.gallery') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('admin.expo.media.gallery', ['expo_id' => $expo->unique_id]) }}">
            Gallery
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.expo.media.video') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('admin.expo.media.video', ['expo_id' => $expo->unique_id]) }}">
            Video
        </a>
    </li>
</ul>
