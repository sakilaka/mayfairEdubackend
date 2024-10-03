<style>
    .student-application-edit .nav-item .nav-link{
        font-size: 0.9rem;
    }
    .border-bottom-primary {
        /* border-left: 2px solid #677aff !important;
        border-right: 2px solid #677aff !important; */
        border-left: 2px solid #237c3a !important;
        border-right: 2px solid #237c3a !important;
        color: #237c3a !important;
        font-weight: bold;
    }
</style>

<ul class="nav nav-tabs nav-tabs-vertical student-application-edit">
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.student_appliction_program_edit') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('admin.student_appliction_program_edit', $s_appliction->id) }}">
            Program Info
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.student_appliction_edit') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('admin.student_appliction_edit', $s_appliction->id) }}">
            Personal Info
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.student_appliction_edit_family') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('admin.student_appliction_edit_family', $s_appliction->id) }}">
            Family Info
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.student_appliction_document') ? 'active border-bottom-primary' : '' }}"
            href="{{ route('admin.student_appliction_document', $s_appliction->id) }}">
            Documents
        </a>
    </li>
</ul>
