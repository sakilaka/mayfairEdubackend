<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Student Application Personal Info Edit</title>
</head>

<body>
    <div class="container-scroller">
        @include('Backend.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('Backend.components.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            Student Application Personal Info Edit
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.student_appliction_list') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All Application</a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="my-2 col-md-2">
                            @include('Backend.student_appliction.theme_options_tabs_nav')
                        </div>

                        <div class="my-2 col-md-10">
                            <div class="tab-content tab-content-vertical bg-white rounded">
                                <div class="tab-pane fade show active" id="program-info-tab-content" role="tabpanel"
                                    aria-labelledby="home-tab-vertical">

                                    <form novalidate="" method="post"
                                        action="{{ route('admin.student_appliction_update', $s_appliction->id) }}"
                                        data-validate="parsley" id="DataEntry_formId" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12 mb-2 mb-2">
                                                <h4>Personal Information</h4>
                                                <hr>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('First Name:') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input value="{{ $s_appliction->first_name }}" type="text"
                                                        name="first_name" id="address" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Middle Name:') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input value="{{ $s_appliction->middle_name }}" type="text"
                                                        name="middle_name" id="address" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Last Name:') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input value="{{ $s_appliction->last_name }}" type="text"
                                                        name="last_name" id="address" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Chinese Name:') }}</label>
                                                    <input value="{{ $s_appliction->chinese_name }}" type="text"
                                                        name="chinese_name" id="address" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Contact ID:') }}</label>
                                                    <input value="{{ $s_appliction->contact_id }}" type="text"
                                                        name="contact_id" id="contact_id" class="form-control"
                                                        placeholder="WeChat/Whatsapp/Telegram">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Phone:') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input value="{{ $s_appliction->phone }}" type="text"
                                                        name="phone" id="address" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Email:') }}</label>
                                                    <input value="{{ $s_appliction->email }}" type="email"
                                                        name="email" id="address" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Date of Birth:') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input value="{{ $s_appliction->dob }}" type="date"
                                                        name="dob" id="address" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Birth Place:') }}</label>
                                                    <input value="{{ $s_appliction->birth_place }}" type="text"
                                                        name="birth_place" id="address" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Passport Number:') }}</label>
                                                    <input value="{{ $s_appliction->passport_number }}"
                                                        type="text" name="passport_number" id="address"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Passport Exipre Date:') }}</label>
                                                    <input value="{{ $s_appliction->passport_exipre_date }}"
                                                        type="date" name="passport_exipre_date" id="address"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Nationality:') }}</label>
                                                    <select id="continent" class="form-control form-control-lg"
                                                        name="nationality">
                                                        <option value="">Select Nationality</option>
                                                        @foreach ($countries as $country)
                                                            <option @if ($country->id == $s_appliction->nationality) Selected @endif
                                                                value="{{ $country->id }}">{{ $country->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    {{-- <input  value="{{ $s_appliction->nationality }}" type="text" name="nationality" id="address" class="form-control"> --}}
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Religion:') }}</label>
                                                    <input value="{{ $s_appliction->religion }}" type="text"
                                                        name="religion" id="address" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Gender:') }}</label>
                                                    <select id="continent" class="form-control form-control-lg"
                                                        name="gender">
                                                        <option value="">Select Gender</option>
                                                        <option @if ($s_appliction->gender == 'Male') Selected @endif
                                                            value="Male">Male</option>
                                                        <option @if ($s_appliction->gender == 'Female') Selected @endif
                                                            value="Female">Female</option>
                                                    </select>
                                                    {{-- <input  value="{{ $s_appliction->gender }}" type="text" name="facebook" id="address" class="form-control"> --}}
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Maritial Status:') }}</label>
                                                    <select id="continent" class="form-control form-control-lg"
                                                        name="maritial_status">
                                                        <option value="">Select Maritial Status</option>
                                                        <option @if ($s_appliction->maritial_status == 'Single') Selected @endif
                                                            value="Single">Single</option>
                                                        <option @if ($s_appliction->maritial_status == 'Married') Selected @endif
                                                            value="Married">Married</option>
                                                    </select>
                                                    {{-- <input  value="{{ $s_appliction->maritial_status }}" type="text" name="facebook" id="address" class="form-control"> --}}
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('In Chaina:') }}</label>
                                                    <select id="continent" class="form-control form-control-lg"
                                                        name="in_chaina">
                                                        <option value="">Select In Chaina?</option>
                                                        <option @if ($s_appliction->in_chaina == '0') Selected @endif
                                                            value="0">No</option>
                                                        <option @if ($s_appliction->in_chaina == '1') Selected @endif
                                                            value="1">Yes</option>
                                                    </select>
                                                    {{-- <input  value="{{ $s_appliction->in_chaina }}" type="text" name="facebook" id="address" class="form-control"> --}}
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('In Alcoholic:') }}</label>
                                                    <select id="continent" class="form-control form-control-lg"
                                                        name="in_alcoholic">
                                                        <option value="">Select In Chaina?</option>
                                                        <option @if ($s_appliction->in_alcoholic == '0') Selected @endif
                                                            value="0">No</option>
                                                        <option @if ($s_appliction->in_alcoholic == '1') Selected @endif
                                                            value="1">Yes</option>
                                                    </select>
                                                    {{-- <input  value="{{ $s_appliction->in_alcoholic }}" type="text" name="facebook" id="address" class="form-control"> --}}
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Hobby:') }}</label>
                                                    <textarea type="text" name="hobby" id="address" class="form-control">{{ $s_appliction->hobby }}</textarea>
                                                </div>
                                            </div>


                                            <div class="col-lg-12 mb-2">
                                                <h4>Language Proficiency</h4>
                                                <hr>
                                            </div>



                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Native Language:') }}</label>
                                                    <input value="{{ $s_appliction->native_language }}"
                                                        type="text" name="native_language" id="address"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('English Level:') }}</label>
                                                    <select id="continent" class="form-control form-control-lg"
                                                        name="english_level">
                                                        <option value="" selected="">English level</option>
                                                        <option @if ($s_appliction->english_level == '0') Selected @endif
                                                            value="0">0 - Can't speak English at all </option>
                                                        <option @if ($s_appliction->english_level == '1') Selected @endif
                                                            value="1">1 - Beginner - not currently good enough to
                                                            study in English</option>
                                                        <option @if ($s_appliction->english_level == '2') Selected @endif
                                                            value="2">2 - Intermediate - OK but needs some work
                                                        </option>
                                                        <option @if ($s_appliction->english_level == '3') Selected @endif
                                                            value="3">3 - Fluent - very good level </option>
                                                        <option @if ($s_appliction->english_level == '4') Selected @endif
                                                            value="4">4 - Native English</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Chinese Level:') }}</label>
                                                    <select id="continent" class="form-control form-control-lg"
                                                        name="chinese_level">
                                                        <option value="" selected="">Chinese Level</option>
                                                        <option @if ($s_appliction->chinese_level == '0') Selected @endif
                                                            value="0">0 - Can't speak Chinese at all </option>
                                                        <option @if ($s_appliction->chinese_level == '1') Selected @endif
                                                            value="1">1 - Beginner - not currently good enough to
                                                            study in Chinese</option>
                                                        <option @if ($s_appliction->chinese_level == '2') Selected @endif
                                                            value="2">2 - Intermediate - OK but needs some work
                                                        </option>
                                                        <option @if ($s_appliction->chinese_level == '3') Selected @endif
                                                            value="3">3 - Fluent - very good level </option>
                                                        <option @if ($s_appliction->chinese_level == '4') Selected @endif
                                                            value="4">4 - Native Chinese</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mb-2">
                                                <h4>Home Address Details</h4>
                                                <hr>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Home Country:') }}</label>
                                                    <input value="{{ $s_appliction->home_country }}" type="text"
                                                        name="home_country" id="address" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Home City:') }}</label>
                                                    <input value="{{ $s_appliction->home_city }}" type="text"
                                                        name="home_city" id="address" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Home District:') }}</label>
                                                    <input value="{{ $s_appliction->home_district }}" type="text"
                                                        name="home_district" id="address" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Home Street:') }}</label>
                                                    <input value="{{ $s_appliction->home_street }}" type="text"
                                                        name="home_street" id="address" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Home Zipcode:') }}</label>
                                                    <input value="{{ $s_appliction->home_zipcode }}" type="text"
                                                        name="home_zipcode" id="address" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Home Contact Name:') }}</label>
                                                    <input value="{{ $s_appliction->home_contact_name }}"
                                                        type="text" name="home_contact_name" id="address"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Home Contact Phone:') }}</label>
                                                    <input value="{{ $s_appliction->home_contact_phone }}"
                                                        type="text" name="home_contact_phone" id="address"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mb-2">
                                                <h4>Postal Address Details</h4>
                                                <hr>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Current Country:') }}</label>
                                                    <input value="{{ $s_appliction->current_country }}"
                                                        type="text" name="current_country" id="address"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Current City:') }}</label>
                                                    <input value="{{ $s_appliction->current_city }}" type="text"
                                                        name="current_city" id="address" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Current District:') }}</label>
                                                    <input value="{{ $s_appliction->current_district }}"
                                                        type="text" name="current_district" id="address"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Current Street:') }}</label>
                                                    <input value="{{ $s_appliction->current_street }}" type="text"
                                                        name="current_street" id="address" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Current Zip Code:') }}</label>
                                                    <input value="{{ $s_appliction->current_zipcode }}"
                                                        type="text" name="current_zipcode" id="address"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Current Contact Name:') }}</label>
                                                    <input value="{{ $s_appliction->current_contact_name }}"
                                                        type="text" name="current_contact_name" id="address"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">{{ __('Current Contact Phone:') }}</label>
                                                    <input value="{{ $s_appliction->current_contact_phone }}"
                                                        type="text" name="current_contact_phone" id="address"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mb-2">
                                                <h4>Education Background</h4>
                                                <hr>
                                            </div>

                                            @foreach ($s_appliction->educations as $k => $item)
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="address">{{ __('School:') }}</label>
                                                        <input value="{{ $item->school }}" type="text"
                                                            name="old_school[{{ $item->id }}]" id="address"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="address">{{ __('Major:') }}</label>
                                                        <input value="{{ $item->major }}" type="text"
                                                            name="old_major[{{ $item->id }}]" id="address"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="address">{{ __('Start Date:') }}</label>
                                                        <input value="{{ $item->start_date }}" type="date"
                                                            name="old_start_date[{{ $item->id }}]" id="address"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="address">{{ __('End Date:') }}</label>
                                                        <input value="{{ $item->end_date }}" type="date"
                                                            name="old_end_date[{{ $item->id }}]" id="address"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="address">{{ __('Gpa Type:') }}</label>
                                                        <input value="{{ $item->gpa_type }}" type="number"
                                                            name="old_gpa_type[{{ $item->id }}]" id="address"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="col-lg-12 mb-2">
                                                <h4>Work Experience</h4>
                                                <hr>
                                            </div>

                                            @foreach ($s_appliction->work_experiences as $item)
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="address">{{ __('Company Name:') }}</label>
                                                        <input value="{{ $item->company }}" type="text"
                                                            name="company[{{ $item->id }}]" id="address"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="address">{{ __('Job Title:') }}</label>
                                                        <input value="{{ $item->job_title }}" type="text"
                                                            name="job_title[{{ $item->id }}]" id="address"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="address">{{ __('Start Date:') }}</label>
                                                        <input value="{{ $item->start_date }}" type="date"
                                                            name="start_date[{{ $item->id }}]" id="address"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="address">{{ __('End Date:') }}</label>
                                                        <input value="{{ $item->end_date }}" type="date"
                                                            name="end_date[{{ $item->id }}]" id="address"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>


                                        <hr>
                                        <div class="row tabs-footer mt-15">
                                            <div class="col-lg-12">
                                                <a href="{{ route('admin.student_appliction_list') }}"
                                                    class="btn blue-btn btn-danger">Cancel</a>
                                                <button type="submit" class="btn blue-btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('Backend.components.footer')
            </div>
        </div>
    </div>

    @include('Backend.components.script')
</body>

</html>
