<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Details</title>

    <style>
        .text-start {
            text-align: left;
            vertical-align: top;
        }
    </style>
</head>

<body>
    <div class="" style="margin-left: 10px; margin-right: 10px; margin-top: 100px; margin-bottom: 100px">
        <div class="">


            <div class="col-lg-12 mt-3">
                @php
                    $studentName = $s_appliction->student
                        ? $s_appliction->student->name
                        : $s_appliction->first_name . ' ' . $s_appliction->last_name;
                @endphp

                <h2 class="text-center mb-5" style="color: black; text-align: center;">
                    <b>{{ $studentName }}'s Application Details</b>
                </h2>

                <b>
                    <h4 style="margin: 0;">Program Information
                </b></h4>
                <hr style="margin: 0;">
            </div>

            <table style="width: 100%">
                <tr>
                    <td class="text-start">
                        <p><b>Application ID:</b></p>
                        <p>{{ $s_appliction->application_code }}</p>
                    </td>
                    <td class="text-start">
                        <p><b>Program:</b></p>
                        @foreach (json_decode($s_appliction->programs) as $programId)
                            <p>{{ optional(\App\Models\Course::find($programId))->name }}</p>
                        @endforeach
                    </td>
                    <td class="text-start">
                        <p><b>University:</b></p>
                        @foreach (json_decode($s_appliction->programs) as $programId)
                            <p>{{ optional(optional(\App\Models\Course::find($programId))->university)->name }}</p>
                        @endforeach
                    </td>
                    <td class="text-start">
                        <p><b>Continent:</b></p>
                        @foreach (json_decode($s_appliction->programs) as $programId)
                            <p>{{ optional(optional(optional(\App\Models\Course::find($programId))->university)->continent)->name }}
                            </p>
                        @endforeach
                    </td>
                </tr>
            </table>

            <div class="col-lg-12 mt-3">
                <b>
                    <h4 style="margin: 0;margin-top:20px;">Personal Information
                </b></h4>
                <hr style="margin: 0;">
            </div>
            <table style="width: 100%">
                <tr>
                    <td>
                        <p><b>First Name:</b></p>
                        <p>{{ $s_appliction->first_name }}</p>
                    </td>
                    <td>
                        <p><b>Middle Name:</b></p>
                        <p>{{ $s_appliction->middle_name }}</p>
                    </td>
                    <td>
                        <p><b>Last Name:</b></p>
                        <p>{{ $s_appliction->last_name }}</p>
                    </td>
                    <td>
                        <p><b>Chinese Name:</b></p>
                        <p>{{ $s_appliction->chinese_name }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Phone:</b></p>
                        <p>{{ $s_appliction->phone }}</p>
                    </td>
                    <td>
                        <p><b>Email:</b></p>
                        <p>{{ $s_appliction->email }}</p>
                    </td>
                    <td>
                        <p><b>Date of Birth:</b></p>
                        <p>{{ $s_appliction->dob }}</p>
                    </td>
                    <td>
                        <p><b>Birth Place:</b></p>
                        <p>{{ $s_appliction->birth_place }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Passport Number:</b></p>
                        <p>{{ $s_appliction->passport_number }}</p>
                    </td>
                    <td>
                        <p><b>Passport Exipre Date:</b></p>
                        <p>{{ $s_appliction->passport_exipre_date }}</p>
                    </td>
                    <td>
                        <p><b>Nationality:</b></p>
                        <p>{{ @$s_appliction->nationality_country->name }}</p>
                    </td>
                    <td>
                        <p><b>Religion:</b></p>
                        <p>{{ $s_appliction->religion }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Gender:</b></p>
                        <p>{{ $s_appliction->gender }}</p>
                    </td>
                    <td>
                        <p><b>Maritial Status:</b></p>
                        <p>{{ $s_appliction->maritial_status }}</p>
                    </td>
                    <td>
                        <p><b>In Chaina:</b></p>
                        <p>
                            @if ($s_appliction->in_chaina == 1)
                                No
                            @else
                                Yes
                            @endif
                        </p>
                    </td>
                    <td>
                        <p><b>In Alcoholic:</b></p>
                        <p>
                            @if ($s_appliction->in_alcoholic == 1)
                                No
                            @else
                                Yes
                            @endif
                        </p>
                    </td>
                </tr>
                <tr style="width: 100%">
                    <td>
                        <p><b>Hobby:</b></p>
                        <p>{{ $s_appliction->hobby }}</p>
                    </td>
                </tr>
            </table>

            <div class="col-lg-12 mt-3">
                <b>
                    <h4 style="margin: 0;margin-top:20px;">Language Proficiency
                </b></h4>
                <hr style="margin: 0;">
            </div>
            <table style="width: 100%">
                <tr>
                    <td>
                        <p><b>Native Language:</b></p>
                        <p>{{ $s_appliction->native_language }}</p>
                    </td>
                    <td>
                        <p><b>English Level:</b></p>
                        <p>
                            @if ($s_appliction->english_level == 0)
                                Can't speak English at all
                            @elseif ($s_appliction->english_level == 1)
                                Beginner - not currently good enough to study in English
                            @elseif ($s_appliction->english_level == 2)
                                Intermediate - OK but needs some work
                            @elseif ($s_appliction->english_level == 3)
                                Fluent - very good level
                            @elseif ($s_appliction->english_level == 4)
                                Native English
                            @endif
                        </p>
                    </td>
                    <td>
                        <p><b>Chinese Level:</b></p>
                        <p>
                            @if ($s_appliction->chinese_level == 0)
                                Can't speak English at all
                            @elseif ($s_appliction->chinese_level == 1)
                                Beginner - not currently good enough to study in English
                            @elseif ($s_appliction->chinese_level == 2)
                                Intermediate - OK but needs some work
                            @elseif ($s_appliction->chinese_level == 3)
                                Fluent - very good level
                            @elseif ($s_appliction->chinese_level == 4)
                                Native English
                            @endif
                        </p>
                    </td>

                </tr>

            </table>


            <div class="col-lg-12 mt-3">
                <b>
                    <h4 style="margin: 0;margin-top:20px;">Home Address Details
                </b></h4>
                <hr style="margin: 0;">
            </div>

            <table style="width: 100%">
                <tr>
                    <td>
                        <p><b>Home Country:</b></p>
                        <p>{{ $s_appliction->home_country }}</p>
                    </td>
                    <td>
                        <p><b>Home City:</b></p>
                        <p>{{ $s_appliction->home_city }}</p>
                    </td>
                    <td>
                        <p><b>Home District:</b></p>
                        <p>{{ $s_appliction->home_district }}</p>
                    </td>
                    <td>
                        <p><b>Home Street:</b></p>
                        <p>{{ $s_appliction->home_street }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Home Zip Code:</b></p>
                        <p>{{ $s_appliction->home_zipcode }}</p>
                    </td>
                    <td>
                        <p><b>Home Contact Name:</b></p>
                        <p>{{ $s_appliction->home_contact_name }}</p>
                    </td>
                    <td>
                        <p><b>Home Contact Phone:</b></p>
                        <p>{{ $s_appliction->home_contact_phone }}</p>
                    </td>
                </tr>

            </table>

            <div class="col-lg-12 mt-3">
                <b>
                    <h4 style="margin: 0;margin-top:20px;">Postal Address Details
                </b></h4>
                <hr style="margin: 0;">
            </div>

            <table style="width: 100%">
                <tr>
                    <td>
                        <p><b>Current Country:</b></p>
                        <p>{{ $s_appliction->current_country }}</p>
                    </td>
                    <td>
                        <p><b>Current City:</b></p>
                        <p>{{ $s_appliction->current_city }}</p>
                    </td>
                    <td>
                        <p><b>Current District:</b></p>
                        <p>{{ $s_appliction->current_district }}</p>
                    </td>
                    <td>
                        <p><b>Current Street:</b></p>
                        <p>{{ $s_appliction->current_street }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Current Zip Code:</b></p>
                        <p>{{ $s_appliction->current_zipcode }}</p>
                    </td>
                    <td>
                        <p><b>Current Contact Name:</b></p>
                        <p>{{ $s_appliction->current_contact_name }}</p>
                    </td>
                    <td>
                        <p><b>Current Contact Phone:</b></p>
                        <p>{{ $s_appliction->current_contact_phone }}</p>
                    </td>
                </tr>

            </table>

            <div class="col-lg-12 mt-3">
                <b>
                    <h4 style="margin: 0;margin-top:20px;">Education Background
                </b></h4>
            </div>


            <table style="width: 100%;border-collapse: collapse;">
                <tr>
                    <td style="border: 1px solid;"><b>School:</b></td>
                    <td style="border: 1px solid;"><b>Major:</b></td>
                    <td style="border: 1px solid;"><b>Start Date:</b></td>
                    <td style="border: 1px solid;"><b>End Date:</b></td>
                    <td style="border: 1px solid;"><b>GPA:</b></td>
                    <td style="border: 1px solid;"><b>Country:</b></td>
                </tr>
                @foreach ($s_appliction->educations as $item)
                    <tr>
                        <td style="border: 1px solid;">
                            {{ @$item->school }}
                        </td>
                        <td style="border: 1px solid;">
                            {{ @$item->major }}
                        </td>
                        <td style="border: 1px solid;">

                            {{ @$item->start_date }}
                        </td>
                        <td style="border: 1px solid;">

                            {{ @$item->end_date }}
                        </td>
                        <td style="border: 1px solid;">
                            {{ @$item->gpa_type }}
                            {{-- @if ($item->gpa_type == 0)
                            Very Low (Grade E Average, 40% or less, GPA 1.5 or less)
                            @elseif ($item->gpa_type == 1)
                            Below average - (Grade D Average, 45%- 55%, GPA 1.5-2)
                            @elseif ($item->gpa_type == 2)
                            Average level - (Grade C-B, 55% - 60%, GPA 2-2.5%)
                            @elseif ($item->gpa_type == 3)
                            Above average - (Grade B-A, 60-70%, GPA 2.5-3) 
                            @elseif ($item->gpa_type == 4)
                            Exceptional - (Grade A, 70%+, GPA 3+)       
                        @endif --}}
                        </td>
                        <td style="border: 1px solid;">

                            {{ @$item->country }}
                        </td>

                    </tr>
                @endforeach
            </table>




            <div class="col-lg-12 mt-3">
                <b>
                    <h4 style="margin: 0;margin-top:20px;">Work Experience
                </b></h4>
            </div>

            <table style="width: 100%;border-collapse: collapse;">
                <tr>
                    <td style="border: 1px solid;"><b>Company:</b></td>
                    <td style="border: 1px solid;"><b>Job Title:</b></td>
                    <td style="border: 1px solid;"><b>Start Date:</b></td>
                    <td style="border: 1px solid;"><b>End Date:</b></td>
                </tr>
                @foreach ($s_appliction->work_experiences as $item)
                    <tr>

                        <td style="border: 1px solid;">

                            {{ @$item->company }}
                        </td>
                        <td style="border: 1px solid;">

                            {{ @$item->job_title }}
                        </td>
                        <td style="border: 1px solid;">

                            {{ @$item->start_date }}
                        </td>

                        <td style="border: 1px solid;">
                            {{ @$item->end_date }}
                        </td>

                    </tr>
                @endforeach
            </table>






            <div class="col-lg-12 mt-3">
                <b>
                    <h4 style="margin: 0;margin-top:20px;">Family Information
                </b></h4>
                <hr style="margin: 0;">
            </div>

            <table style="width: 100%">
                <tr>
                    <td>
                        <p><b>Father Name:</b></p>
                        <p>{{ @$s_appliction->father_name }}</p>
                    </td>
                    <td>
                        <p><b>Father Nnationlity:</b></p>
                        <p>{{ @$s_appliction->father_nationlity }}</p>
                    </td>
                    <td>
                        <p><b>Father Phone:</b></p>
                        <p>{{ @$s_appliction->father_phone }}</p>
                    </td>

                    <td>
                        <p><b>Father Email:</b></p>
                        <p>{{ @$s_appliction->father_email }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Father Workplace:</b></p>
                        <p>{{ @$s_appliction->father_workplace }}</p>
                    </td>
                    <td>
                        <p><b>Father Position:</b></p>
                        <p>{{ @$s_appliction->father_position }}</p>
                    </td>
                    <td>
                        <p><b>Mother Name:</b></p>
                        <p>{{ @$s_appliction->father_phone }}</p>
                    </td>

                    <td>
                        <p><b>Mother Nationlity:</b></p>
                        <p>{{ @$s_appliction->mother_nationlity }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Mother Phone:</b></p>
                        <p>{{ @$s_appliction->mother_phone }}</p>
                    </td>
                    <td>
                        <p><b>Mother Email:</b></p>
                        <p>{{ @$s_appliction->mother_email }}</p>
                    </td>
                    <td>
                        <p><b>Mother Workplace:</b></p>
                        <p>{{ @$s_appliction->mother_workplace }}</p>
                    </td>

                    <td>
                        <p><b>Mother Position:</b></p>
                        <p>{{ @$s_appliction->mother_position }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Guarantor Relationship:</b></p>
                        <p>{{ @$s_appliction->guarantor_relationship }}</p>
                    </td>
                    <td>
                        <p><b>Guarantor Name:</b></p>
                        <p>{{ @$s_appliction->guarantor_name }}</p>
                    </td>
                    <td>
                        <p><b>Guarantor Address:</b></p>
                        <p>{{ @$s_appliction->guarantor_address }}</p>
                    </td>

                    <td>
                        <p><b>Guarantor Phone:</b></p>
                        <p>{{ @$s_appliction->guarantor_phone }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Guarantor Email:</b></p>
                        <p>{{ @$s_appliction->guarantor_email }}</p>
                    </td>
                    <td>
                        <p><b>Guarantor Workplace:</b></p>
                        <p>{{ @$s_appliction->guarantor_workplace }}</p>
                    </td>
                    <td>
                        <p><b>Guarantor Work Address:</b></p>
                        <p>{{ @$s_appliction->guarantor_work_address }}</p>
                    </td>

                    <td>
                        <p><b>Study Fund:</b></p>
                        <p>{{ @$s_appliction->study_fund }}</p>
                    </td>
                </tr>

            </table>



            <div class="col-lg-12 mt-3">
                <b>
                    <h4 style="margin: 0;margin-top:20px;">Contact in Case of Emergencies
                </b></h4>
                <hr style="margin: 0;">
            </div>

            <table style="width: 100%">
                <tr>
                    <td>
                        <p><b>Emergency Contact Name:</b></p>
                        <p>{{ @$s_appliction->emergency_contact_name }}</p>
                    </td>
                    <td>
                        <p><b>Emergency Contact Phone:</b></p>
                        <p>{{ @$s_appliction->emergency_contact_phone }}</p>
                    </td>
                    <td>
                        <p><b>Emergency Contact Email:</b></p>
                        <p>{{ @$s_appliction->emergency_contact_email }}</p>
                    </td>

                    <td>
                        <p><b>Emergency Contact Address:</b></p>
                        <p>{{ @$s_appliction->emergency_contact_address }}</p>
                    </td>
                </tr>

            </table>

        </div>
    </div>
</body>

</html>
