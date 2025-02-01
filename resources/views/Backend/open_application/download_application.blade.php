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
                    $studentName = $o_application->student
                        ? $o_application->student->name
                        : $o_application->first_name . ' ' . $o_application->last_name;
                @endphp

                <h2 class="text-center mb-5" style="color: black; text-align: center;">
                    <b>{{ $studentName }}'s Application Details</b>
                </h2>

                <b>
                    <h4 style="margin: 0;">Program Information
                </b></h4>
                <hr style="margin: 0;">
            </div>

          

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
                        <p>{{ $o_application->first_name }}</p>
                    </td>
                    <td>
                        <p><b>Middle Name:</b></p>
                        <p>{{ $o_application->middle_name }}</p>
                    </td>
                    <td>
                        <p><b>Last Name:</b></p>
                        <p>{{ $o_application->last_name }}</p>
                    </td>
                    <td>
                        <p><b>Chinese Name:</b></p>
                        <p>{{ $o_application->chinese_name }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Phone:</b></p>
                        <p>{{ $o_application->phone }}</p>
                    </td>
                    <td>
                        <p><b>Email:</b></p>
                        <p>{{ $o_application->email }}</p>
                    </td>
                    <td>
                        <p><b>Date of Birth:</b></p>
                        <p>{{ $o_application->dob }}</p>
                    </td>
                    <td>
                        <p><b>Birth Place:</b></p>
                        <p>{{ $o_application->birth_place }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Passport Number:</b></p>
                        <p>{{ $o_application->passport_number }}</p>
                    </td>
                    <td>
                        <p><b>Passport Exipre Date:</b></p>
                        <p>{{ $o_application->passport_exipre_date }}</p>
                    </td>
                    <td>
                        <p><b>Nationality:</b></p>
                        <p>{{ @$o_application->nationality_country->name }}</p>
                    </td>
                    <td>
                        <p><b>Religion:</b></p>
                        <p>{{ $o_application->religion }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Gender:</b></p>
                        <p>{{ $o_application->gender }}</p>
                    </td>
                    <td>
                        <p><b>Maritial Status:</b></p>
                        <p>{{ $o_application->maritial_status }}</p>
                    </td>
                    <td>
                        <p><b>In Chaina:</b></p>
                        <p>
                            @if ($o_application->in_chaina == 1)
                                No
                            @else
                                Yes
                            @endif
                        </p>
                    </td>
                    <td>
                        <p><b>In Alcoholic:</b></p>
                        <p>
                            @if ($o_application->in_alcoholic == 1)
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
                        <p>{{ $o_application->hobby }}</p>
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
                        <p>{{ $o_application->native_language }}</p>
                    </td>
                    <td>
                        <p><b>English Level:</b></p>
                        <p>
                            @if ($o_application->english_level == 0)
                                Can't speak English at all
                            @elseif ($o_application->english_level == 1)
                                Beginner - not currently good enough to study in English
                            @elseif ($o_application->english_level == 2)
                                Intermediate - OK but needs some work
                            @elseif ($o_application->english_level == 3)
                                Fluent - very good level
                            @elseif ($o_application->english_level == 4)
                                Native English
                            @endif
                        </p>
                    </td>
                    <td>
                        <p><b>Chinese Level:</b></p>
                        <p>
                            @if ($o_application->chinese_level == 0)
                                Can't speak English at all
                            @elseif ($o_application->chinese_level == 1)
                                Beginner - not currently good enough to study in English
                            @elseif ($o_application->chinese_level == 2)
                                Intermediate - OK but needs some work
                            @elseif ($o_application->chinese_level == 3)
                                Fluent - very good level
                            @elseif ($o_application->chinese_level == 4)
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
                        <p>{{ $o_application->home_country }}</p>
                    </td>
                    <td>
                        <p><b>Home City:</b></p>
                        <p>{{ $o_application->home_city }}</p>
                    </td>
                    <td>
                        <p><b>Home District:</b></p>
                        <p>{{ $o_application->home_district }}</p>
                    </td>
                    <td>
                        <p><b>Home Street:</b></p>
                        <p>{{ $o_application->home_street }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Home Zip Code:</b></p>
                        <p>{{ $o_application->home_zipcode }}</p>
                    </td>
                    <td>
                        <p><b>Home Contact Name:</b></p>
                        <p>{{ $o_application->home_contact_name }}</p>
                    </td>
                    <td>
                        <p><b>Home Contact Phone:</b></p>
                        <p>{{ $o_application->home_contact_phone }}</p>
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
                        <p>{{ $o_application->current_country }}</p>
                    </td>
                    <td>
                        <p><b>Current City:</b></p>
                        <p>{{ $o_application->current_city }}</p>
                    </td>
                    <td>
                        <p><b>Current District:</b></p>
                        <p>{{ $o_application->current_district }}</p>
                    </td>
                    <td>
                        <p><b>Current Street:</b></p>
                        <p>{{ $o_application->current_street }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Current Zip Code:</b></p>
                        <p>{{ $o_application->current_zipcode }}</p>
                    </td>
                    <td>
                        <p><b>Current Contact Name:</b></p>
                        <p>{{ $o_application->current_contact_name }}</p>
                    </td>
                    <td>
                        <p><b>Current Contact Phone:</b></p>
                        <p>{{ $o_application->current_contact_phone }}</p>
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
                @foreach ($o_application->educations as $item)
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
                @foreach ($o_application->work_experiences as $item)
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
                        <p>{{ @$o_application->father_name }}</p>
                    </td>
                    <td>
                        <p><b>Father Nnationlity:</b></p>
                        <p>{{ @$o_application->father_nationlity }}</p>
                    </td>
                    <td>
                        <p><b>Father Phone:</b></p>
                        <p>{{ @$o_application->father_phone }}</p>
                    </td>

                    <td>
                        <p><b>Father Email:</b></p>
                        <p>{{ @$o_application->father_email }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Father Workplace:</b></p>
                        <p>{{ @$o_application->father_workplace }}</p>
                    </td>
                    <td>
                        <p><b>Father Position:</b></p>
                        <p>{{ @$o_application->father_position }}</p>
                    </td>
                    <td>
                        <p><b>Mother Name:</b></p>
                        <p>{{ @$o_application->father_phone }}</p>
                    </td>

                    <td>
                        <p><b>Mother Nationlity:</b></p>
                        <p>{{ @$o_application->mother_nationlity }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Mother Phone:</b></p>
                        <p>{{ @$o_application->mother_phone }}</p>
                    </td>
                    <td>
                        <p><b>Mother Email:</b></p>
                        <p>{{ @$o_application->mother_email }}</p>
                    </td>
                    <td>
                        <p><b>Mother Workplace:</b></p>
                        <p>{{ @$o_application->mother_workplace }}</p>
                    </td>

                    <td>
                        <p><b>Mother Position:</b></p>
                        <p>{{ @$o_application->mother_position }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Guarantor Relationship:</b></p>
                        <p>{{ @$o_application->guarantor_relationship }}</p>
                    </td>
                    <td>
                        <p><b>Guarantor Name:</b></p>
                        <p>{{ @$o_application->guarantor_name }}</p>
                    </td>
                    <td>
                        <p><b>Guarantor Address:</b></p>
                        <p>{{ @$o_application->guarantor_address }}</p>
                    </td>

                    <td>
                        <p><b>Guarantor Phone:</b></p>
                        <p>{{ @$o_application->guarantor_phone }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><b>Guarantor Email:</b></p>
                        <p>{{ @$o_application->guarantor_email }}</p>
                    </td>
                    <td>
                        <p><b>Guarantor Workplace:</b></p>
                        <p>{{ @$o_application->guarantor_workplace }}</p>
                    </td>
                    <td>
                        <p><b>Guarantor Work Address:</b></p>
                        <p>{{ @$o_application->guarantor_work_address }}</p>
                    </td>

                    <td>
                        <p><b>Study Fund:</b></p>
                        <p>{{ @$o_application->study_fund }}</p>
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
                        <p>{{ @$o_application->emergency_contact_name }}</p>
                    </td>
                    <td>
                        <p><b>Emergency Contact Phone:</b></p>
                        <p>{{ @$o_application->emergency_contact_phone }}</p>
                    </td>
                    <td>
                        <p><b>Emergency Contact Email:</b></p>
                        <p>{{ @$o_application->emergency_contact_email }}</p>
                    </td>

                    <td>
                        <p><b>Emergency Contact Address:</b></p>
                        <p>{{ @$o_application->emergency_contact_address }}</p>
                    </td>
                </tr>

            </table>

        </div>
    </div>
</body>

</html>
