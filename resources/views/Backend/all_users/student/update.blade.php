<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/summernote/dist/summernote-bs4.css') }}">
    <title>{{ env('APP_NAME') }} | Edit Student</title>
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
                            Edit Student
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.student.index') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All Student</a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-md-12 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample"
                                        action="{{ route('admin.student.update', $student->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row mb-3">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="row">
                                                    <div class="col-sm-12 mb-2">
                                                        <h4>Personal Details</h4>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Student Photo</label>
                                                            <div class="dropify-wrapper" style="border: none">
                                                                <div class="dropify-loader"></div>
                                                                <div class="dropify-errors-container">
                                                                    <ul></ul>
                                                                </div>
                                                                <input type="file" class="dropify" name="image"
                                                                    accept="image/*" id="avatar_upload">
                                                                <button type="button"
                                                                    class="dropify-clear">Remove</button>
                                                                <div class="dropify-preview">
                                                                    <span class="dropify-render"></span>
                                                                    <div class="dropify-infos">
                                                                        <div class="dropify-infos-inner">
                                                                            <p class="dropify-filename">
                                                                                <span class="file-icon"></span>
                                                                                <span
                                                                                    class="dropify-filename-inner"></span>
                                                                            </p>
                                                                            <p class="dropify-infos-message">
                                                                                Drag and drop or click to replace
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-sm-6 d-flex justify-content-center align-items-center">
                                                        <div class="px-3">
                                                            <img src="{{ $student->image_show ?? asset('frontend/images/No-image.jpg') }}"
                                                                alt="" class="img-fluid"
                                                                style="border-radius: 10px; max-height: 200px !important;"
                                                                id="avatar_preview">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Student Name:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Enter Name" value="{{ $student->name }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Mobile Number:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="mobile" class="form-control"
                                                            placeholder="Enter Mobile Number"
                                                            value="{{ $student->mobile }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Email:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="email" name="email" class="form-control"
                                                            placeholder="Enter Email" value="{{ $student->email }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">NID:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="nid" class="form-control"
                                                            placeholder="Enter NID" value="{{ $student->nid }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Gender <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <select class="form-control form-control-lg" name="gender"
                                                        required>
                                                        <option value="">Select Gender</option>
                                                        <option value="0"
                                                            @if ($student->gender == '0') Selected @endif>Male
                                                        </option>
                                                        <option value="1"
                                                            @if ($student->gender == '1') Selected @endif>Female
                                                        </option>
                                                        <option value="1"
                                                            @if ($student->gender == '2') Selected @endif>Other
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Date of Birth:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="date" name="dob"
                                                            value="{{ date('Y-m-d', strtotime($student->dob)) }}"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Qualification:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="qualification"
                                                            class="form-control"
                                                            value="{{ $student->qualification }}"
                                                            placeholder="Enter Qualification" required>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Experience:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="experience" class="form-control"
                                                            placeholder="Enter Experience"
                                                            value="{{ $student->experience }}" required>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Language
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span>
                                                    </label>
                                                    <select id="language" class="form-control form-control-lg"
                                                        name="language" id="phar_cat" required>
                                                        <option value="">Select Language</option>
                                                        <option @if ($student->language == '1') Selected @endif
                                                            value="1"> Bangla </option>
                                                        <option @if ($student->language == '2') Selected @endif
                                                            value="2">English </option>
                                                        <option @if ($student->language == '3') Selected @endif
                                                            value="3">Hindi </option>
                                                        <option @if ($student->language == '4') Selected @endif
                                                            value="4">Arabic </option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Continent
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span>
                                                    </label>
                                                    <select id="continent" class="form-control form-control-lg"
                                                        name="continent_id" id="phar_cat" required>
                                                        <option value="">Select Continent</option>
                                                        @foreach ($continents as $continent)
                                                            <option @if ($continent->id == $student->continent_id) Selected @endif
                                                                value="{{ $continent->id }}">{{ $continent->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Country <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <select class="form-control form-control-lg" name="country"
                                                        id="country" required>
                                                        <option value="">Select Continent First</option>
                                                       <option value="1" {{ $student->country == 1 ? 'selected' : '' }}>Afghanistan</option>
                                                        <option value="2" {{ $student->country == 2 ? 'selected' : '' }}>Aland Islands</option>
                                                        <option value="3" {{ $student->country == 3 ? 'selected' : '' }}>Albania</option>
                                                        <option value="4" {{ $student->country == 4 ? 'selected' : '' }}>Algeria</option>
                                                        <option value="5" {{ $student->country == 5 ? 'selected' : '' }}>American Samoa</option>
                                                        <option value="6" {{ $student->country == 6 ? 'selected' : '' }}>Andorra</option>
                                                        <option value="7" {{ $student->country == 7 ? 'selected' : '' }}>Angola</option>
                                                        <option value="8" {{ $student->country == 8 ? 'selected' : '' }}>Anguilla</option>
                                                        <option value="9" {{ $student->country == 9 ? 'selected' : '' }}>Antarctica</option>
                                                        <option value="10" {{ $student->country == 10 ? 'selected' : '' }}>Antigua and Barbuda</option>
                                                        <option value="11" {{ $student->country == 11 ? 'selected' : '' }}>Argentina</option>
                                                        <option value="12" {{ $student->country == 12 ? 'selected' : '' }}>Armenia</option>
                                                        <option value="13" {{ $student->country == 13 ? 'selected' : '' }}>Aruba</option>
                                                        <option value="14" {{ $student->country == 14 ? 'selected' : '' }}>Australia</option>
                                                        <option value="15" {{ $student->country == 15 ? 'selected' : '' }}>Austria</option>
                                                        <option value="16" {{ $student->country == 16 ? 'selected' : '' }}>Azerbaijan</option>
                                                        <option value="17" {{ $student->country == 17 ? 'selected' : '' }}>Bahamas</option>
                                                        <option value="18" {{ $student->country == 18 ? 'selected' : '' }}>Bahrain</option>
                                                        <option value="19" {{ $student->country == 19 ? 'selected' : '' }}>Bangladesh</option>
                                                        <option value="20" {{ $student->country == 20 ? 'selected' : '' }}>Barbados</option>
                                                        <option value="21" {{ $student->country == 21 ? 'selected' : '' }}>Belarus</option>
                                                        <option value="22" {{ $student->country == 22 ? 'selected' : '' }}>Belgium</option>
                                                        <option value="23" {{ $student->country == 23 ? 'selected' : '' }}>Belize</option>
                                                        <option value="24" {{ $student->country == 24 ? 'selected' : '' }}>Benin</option>
                                                        <option value="25" {{ $student->country == 25 ? 'selected' : '' }}>Bermuda</option>
                                                        <option value="26" {{ $student->country == 26 ? 'selected' : '' }}>Bhutan</option>
                                                        <option value="27" {{ $student->country == 27 ? 'selected' : '' }}>Bolivia</option>
                                                        <option value="28" {{ $student->country == 28 ? 'selected' : '' }}>Bonaire, Sint Eustatius and Saba</option>
                                                        <option value="29" {{ $student->country == 29 ? 'selected' : '' }}>Bosnia and Herzegovina</option>
                                                        <option value="30" {{ $student->country == 30 ? 'selected' : '' }}>Botswana</option>
                                                        <option value="31" {{ $student->country == 31 ? 'selected' : '' }}>Bouvet Island</option>
                                                        <option value="32" {{ $student->country == 32 ? 'selected' : '' }}>Brazil</option>
                                                        <option value="33" {{ $student->country == 33 ? 'selected' : '' }}>British Indian Ocean Territory</option>
                                                        <option value="34" {{ $student->country == 34 ? 'selected' : '' }}>Brunei</option>
                                                        <option value="35" {{ $student->country == 35 ? 'selected' : '' }}>Bulgaria</option>
                                                        <option value="36" {{ $student->country == 36 ? 'selected' : '' }}>Burkina Faso</option>
                                                        <option value="37" {{ $student->country == 37 ? 'selected' : '' }}>Burundi</option>
                                                        <option value="38" {{ $student->country == 38 ? 'selected' : '' }}>Cambodia</option>
                                                        <option value="39" {{ $student->country == 39 ? 'selected' : '' }}>Cameroon</option>
                                                        <option value="40" {{ $student->country == 40 ? 'selected' : '' }}>Canada</option>
                                                        <option value="41" {{ $student->country == 41 ? 'selected' : '' }}>Cape Verde</option>
                                                        <option value="42" {{ $student->country == 42 ? 'selected' : '' }}>Cayman Islands</option>
                                                        <option value="43" {{ $student->country == 43 ? 'selected' : '' }}>Central African Republic</option>
                                                        <option value="44" {{ $student->country == 44 ? 'selected' : '' }}>Chad</option>
                                                        <option value="45" {{ $student->country == 45 ? 'selected' : '' }}>Chile</option>
                                                        <option value="46" {{ $student->country == 46 ? 'selected' : '' }}>China</option>
                                                        <option value="47" {{ $student->country == 47 ? 'selected' : '' }}>Christmas Island</option>
                                                        <option value="48" {{ $student->country == 48 ? 'selected' : '' }}>Cocos (Keeling) Islands</option>
                                                        <option value="49" {{ $student->country == 49 ? 'selected' : '' }}>Colombia</option>
                                     
                                                        <option value="50" {{ $student->country == 50 ? 'selected' : '' }}>Comoros</option>
                                                        <option value="51" {{ $student->country == 51 ? 'selected' : '' }}>Congo</option>
                                                        <option value="52" {{ $student->country == 52 ? 'selected' : '' }}>Cook Islands</option>
                                                        <option value="53" {{ $student->country == 53 ? 'selected' : '' }}>Costa Rica</option>
                                                        <option value="55" {{ $student->country == 55 ? 'selected' : '' }}>Croatia</option>
                                                        <option value="56" {{ $student->country == 56 ? 'selected' : '' }}>Cuba</option>
                                                        <option value="57" {{ $student->country == 57 ? 'selected' : '' }}>Curacao</option>
                                                        <option value="58" {{ $student->country == 58 ? 'selected' : '' }}>Cyprus</option>
                                                        <option value="59" {{ $student->country == 59 ? 'selected' : '' }}>Czech Republic</option>
                                                        <option value="60" {{ $student->country == 60 ? 'selected' : '' }}>Democratic Republic of the Congo</option>
                                                        <option value="61" {{ $student->country == 61 ? 'selected' : '' }}>Denmark</option>
                                                        <option value="62" {{ $student->country == 62 ? 'selected' : '' }}>Djibouti</option>
                                                        <option value="63" {{ $student->country == 63 ? 'selected' : '' }}>Dominica</option>
                                                        <option value="64" {{ $student->country == 64 ? 'selected' : '' }}>Dominican Republic</option>
                                                        <option value="65" {{ $student->country == 65 ? 'selected' : '' }}>Ecuador</option>
                                                        <option value="66" {{ $student->country == 66 ? 'selected' : '' }}>Egypt</option>
                                                        <option value="67" {{ $student->country == 67 ? 'selected' : '' }}>El Salvador</option>
                                                        <option value="68" {{ $student->country == 68 ? 'selected' : '' }}>Equatorial Guinea</option>
                                                        <option value="69" {{ $student->country == 69 ? 'selected' : '' }}>Eritrea</option>
                                                        <option value="70" {{ $student->country == 70 ? 'selected' : '' }}>Estonia</option>
                                                        <option value="71" {{ $student->country == 71 ? 'selected' : '' }}>Ethiopia</option>
                                                        <option value="72" {{ $student->country == 72 ? 'selected' : '' }}>Falkland Islands (Malvinas)</option>
                                                        <option value="73" {{ $student->country == 73 ? 'selected' : '' }}>Faroe Islands</option>
                                                        <option value="74" {{ $student->country == 74 ? 'selected' : '' }}>Fiji</option>
                                                        <option value="75" {{ $student->country == 75 ? 'selected' : '' }}>Finland</option>
                                                        <option value="76" {{ $student->country == 76 ? 'selected' : '' }}>France</option>
                                                        <option value="77" {{ $student->country == 77 ? 'selected' : '' }}>French Guiana</option>
                                                        <option value="78" {{ $student->country == 78 ? 'selected' : '' }}>French Polynesia</option>
                                                        <option value="79" {{ $student->country == 79 ? 'selected' : '' }}>French Southern Territories</option>
                                                        <option value="80" {{ $student->country == 80 ? 'selected' : '' }}>Gabon</option>
                                                        <option value="81" {{ $student->country == 81 ? 'selected' : '' }}>Gambia</option>
                                                        <option value="82" {{ $student->country == 82 ? 'selected' : '' }}>Georgia</option>
                                                        <option value="83" {{ $student->country == 83 ? 'selected' : '' }}>Germany</option>
                                                        <option value="84" {{ $student->country == 84 ? 'selected' : '' }}>Ghana</option>
                                                        <option value="85" {{ $student->country == 85 ? 'selected' : '' }}>Gibraltar</option>
                                                        <option value="86" {{ $student->country == 86 ? 'selected' : '' }}>Greece</option>
                                                        <option value="87" {{ $student->country == 87 ? 'selected' : '' }}>Greenland</option>
                                                        <option value="88" {{ $student->country == 88 ? 'selected' : '' }}>Grenada</option>
                                                        <option value="89" {{ $student->country == 89 ? 'selected' : '' }}>Guadaloupe</option>
                                                        <option value="90" {{ $student->country == 90 ? 'selected' : '' }}>Guam</option>
                                                        <option value="91" {{ $student->country == 91 ? 'selected' : '' }}>Guatemala</option>
                                                        <option value="92" {{ $student->country == 92 ? 'selected' : '' }}>Guernsey</option>
                                                        <option value="93" {{ $student->country == 93 ? 'selected' : '' }}>Guinea</option>
                                                        <option value="94" {{ $student->country == 94 ? 'selected' : '' }}>Guinea-Bissau</option>
                                                        <option value="95" {{ $student->country == 95 ? 'selected' : '' }}>Guyana</option>
                                                        <option value="96" {{ $student->country == 96 ? 'selected' : '' }}>Haiti</option>
                                                        <option value="97" {{ $student->country == 97 ? 'selected' : '' }}>Heard Island and McDonald Islands</option>
                                                        <option value="98" {{ $student->country == 98 ? 'selected' : '' }}>Honduras</option>
                                                        <option value="99" {{ $student->country == 99 ? 'selected' : '' }}>Hong Kong</option>
                                                        <option value="100" {{ $student->country == 100 ? 'selected' : '' }}>Hungary</option>
                                                        <option value="101" {{ $student->country == 101 ? 'selected' : '' }}>Iceland</option>
                                                        <option value="102" {{ $student->country == 102 ? 'selected' : '' }}>India</option>
                                                        <option value="103" {{ $student->country == 103 ? 'selected' : '' }}>Indonesia</option>
                                                        <option value="104" {{ $student->country == 104 ? 'selected' : '' }}>Iran</option>
                                                        <option value="105" {{ $student->country == 105 ? 'selected' : '' }}>Iraq</option>
                                                        <option value="106" {{ $student->country == 106 ? 'selected' : '' }}>Ireland</option>
                                                        <option value="107" {{ $student->country == 107 ? 'selected' : '' }}>Isle of Man</option>
                                                        <option value="108" {{ $student->country == 108 ? 'selected' : '' }}>Israel</option>
                                                        <option value="109" {{ $student->country == 109 ? 'selected' : '' }}>Italy</option>
                                                        <option value="110" {{ $student->country == 110 ? 'selected' : '' }}>Jamaica</option>
                                                        <option value="111" {{ $student->country == 111 ? 'selected' : '' }}>Japan</option>
                                                        <option value="112" {{ $student->country == 112 ? 'selected' : '' }}>Jersey</option>
                                                        <option value="113" {{ $student->country == 113 ? 'selected' : '' }}>Jordan</option>
                                                        <option value="114" {{ $student->country == 114 ? 'selected' : '' }}>Kazakhstan</option>
                                                        <option value="115" {{ $student->country == 115 ? 'selected' : '' }}>Kenya</option>
                                                        <option value="116" {{ $student->country == 116 ? 'selected' : '' }}>Kiribati</option>
                                                        <option value="117" {{ $student->country == 117 ? 'selected' : '' }}>Kosovo</option>
                                                        <option value="118" {{ $student->country == 118 ? 'selected' : '' }}>Kuwait</option>
                                                        <option value="119" {{ $student->country == 119 ? 'selected' : '' }}>Kyrgyzstan</option>
                                                        <option value="120" {{ $student->country == 120 ? 'selected' : '' }}>Laos</option>
                                                        <option value="121" {{ $student->country == 121 ? 'selected' : '' }}>Latvia</option>
                                                        <option value="122" {{ $student->country == 122 ? 'selected' : '' }}>Lebanon</option>
                                                        <option value="123" {{ $student->country == 123 ? 'selected' : '' }}>Lesotho</option>
                                                        <option value="124" {{ $student->country == 124 ? 'selected' : '' }}>Liberia</option>
                                                        <option value="125" {{ $student->country == 125 ? 'selected' : '' }}>Libya</option>
                                                        <option value="126" {{ $student->country == 126 ? 'selected' : '' }}>Liechtenstein</option>
                                                        <option value="127" {{ $student->country == 127 ? 'selected' : '' }}>Lithuania</option>
                                                        <option value="128" {{ $student->country == 128 ? 'selected' : '' }}>Luxembourg</option>
                                                        <option value="129" {{ $student->country == 129 ? 'selected' : '' }}>Macao</option>
                                                        <option value="130" {{ $student->country == 130 ? 'selected' : '' }}>Macedonia</option>
                                                        <option value="131" {{ $student->country == 131 ? 'selected' : '' }}>Madagascar</option>
                                                        <option value="132" {{ $student->country == 132 ? 'selected' : '' }}>Malawi</option>
                                                        <option value="133" {{ $student->country == 133 ? 'selected' : '' }}>Malaysia</option>
                                                        <option value="134" {{ $student->country == 134 ? 'selected' : '' }}>Maldives</option>
                                                        <option value="135" {{ $student->country == 135 ? 'selected' : '' }}>Mali</option>
                                                        <option value="136" {{ $student->country == 136 ? 'selected' : '' }}>Malta</option>
                                                        <option value="137" {{ $student->country == 137 ? 'selected' : '' }}>Marshall Islands</option>
                                                        <option value="138" {{ $student->country == 138 ? 'selected' : '' }}>Martinique</option>
                                                        <option value="139" {{ $student->country == 139 ? 'selected' : '' }}>Mauritania</option>
                                                        <option value="140" {{ $student->country == 140 ? 'selected' : '' }}>Mauritius</option>
                                                        <option value="141" {{ $student->country == 141 ? 'selected' : '' }}>Mayotte</option>
                                                        <option value="142" {{ $student->country == 142 ? 'selected' : '' }}>Mexico</option>
                                                        <option value="143" {{ $student->country == 143 ? 'selected' : '' }}>Micronesia</option>
                                                        <option value="144" {{ $student->country == 144 ? 'selected' : '' }}>Moldava</option>
                                                        <option value="145" {{ $student->country == 145 ? 'selected' : '' }}>Monaco</option>
                                                        <option value="146" {{ $student->country == 146 ? 'selected' : '' }}>Mongolia</option>
                                                        <option value="147" {{ $student->country == 147 ? 'selected' : '' }}>Montenegro</option>
                                                        <option value="148" {{ $student->country == 148 ? 'selected' : '' }}>Montserrat</option>
                                                        <option value="149" {{ $student->country == 149 ? 'selected' : '' }}>Morocco</option>
                                                        <option value="150" {{ $student->country == 150 ? 'selected' : '' }}>Mozambique</option>
                                                        <option value="151" {{ $student->country == 151 ? 'selected' : '' }}>Myanmar (Burma)</option>
                                                        <option value="152" {{ $student->country == 152 ? 'selected' : '' }}>Namibia</option>
                                                        <option value="153" {{ $student->country == 153 ? 'selected' : '' }}>Nauru</option>
                                                        <option value="154" {{ $student->country == 154 ? 'selected' : '' }}>Nepal</option>
                                                        <option value="155" {{ $student->country == 155 ? 'selected' : '' }}>Netherlands</option>
                                                        <option value="156" {{ $student->country == 156 ? 'selected' : '' }}>New Caledonia</option>
                                                        <option value="157" {{ $student->country == 157 ? 'selected' : '' }}>New Zealand</option>
                                                        <option value="158" {{ $student->country == 158 ? 'selected' : '' }}>Nicaragua</option>
                                                        <option value="159" {{ $student->country == 159 ? 'selected' : '' }}>Niger</option>
                                                        <option value="160" {{ $student->country == 160 ? 'selected' : '' }}>Nigeria</option>
                                                        <option value="161" {{ $student->country == 161 ? 'selected' : '' }}>Niue</option>
                                                        <option value="162" {{ $student->country == 162 ? 'selected' : '' }}>Norfolk Island</option>
                                                        <option value="163" {{ $student->country == 163 ? 'selected' : '' }}>North Korea</option>
                                                        <option value="164" {{ $student->country == 164 ? 'selected' : '' }}>Northern Mariana Islands</option>
                                                        <option value="165" {{ $student->country == 165 ? 'selected' : '' }}>Norway</option>
                                                        <option value="166" {{ $student->country == 166 ? 'selected' : '' }}>Oman</option>
                                                        <option value="167" {{ $student->country == 167 ? 'selected' : '' }}>Pakistan</option>
                                                        <option value="168" {{ $student->country == 168 ? 'selected' : '' }}>Palau</option>
                                                        <option value="169" {{ $student->country == 169 ? 'selected' : '' }}>Palestine</option>
                                                        <option value="170" {{ $student->country == 170 ? 'selected' : '' }}>Panama</option>
                                                        <option value="171" {{ $student->country == 171 ? 'selected' : '' }}>Papua New Guinea</option>
                                                        <option value="172" {{ $student->country == 172 ? 'selected' : '' }}>Paraguay</option>
                                                        <option value="173" {{ $student->country == 173 ? 'selected' : '' }}>Peru</option>
                                                        <option value="174" {{ $student->country == 174 ? 'selected' : '' }}>Philippines</option>
                                                        <option value="175" {{ $student->country == 175 ? 'selected' : '' }}>Pitcairn</option>
                                                        <option value="176" {{ $student->country == 176 ? 'selected' : '' }}>Poland</option>
                                                        <option value="177" {{ $student->country == 177 ? 'selected' : '' }}>Portugal</option>
                                                        <option value="178" {{ $student->country == 178 ? 'selected' : '' }}>Puerto Rico</option>
                                                        <option value="179" {{ $student->country == 179 ? 'selected' : '' }}>Qatar</option>
                                                        <option value="180" {{ $student->country == 180 ? 'selected' : '' }}>Reunion</option>
                                                        <option value="181" {{ $student->country == 181 ? 'selected' : '' }}>Romania</option>
                                                        <option value="182" {{ $student->country == 182 ? 'selected' : '' }}>Russia</option>
                                                        <option value="183" {{ $student->country == 183 ? 'selected' : '' }}>Rwanda</option>
                                                        <option value="184" {{ $student->country == 184 ? 'selected' : '' }}>Saint Barthelemy</option>
                                                        <option value="185" {{ $student->country == 185 ? 'selected' : '' }}>Saint Helena</option>
                                                        <option value="186" {{ $student->country == 186 ? 'selected' : '' }}>Saint Kitts and Nevis</option>
                                                        <option value="187" {{ $student->country == 187 ? 'selected' : '' }}>Saint Lucia</option>
                                                        <option value="188" {{ $student->country == 188 ? 'selected' : '' }}>Saint Martin</option>
                                                        <option value="189" {{ $student->country == 189 ? 'selected' : '' }}>Saint Pierre and Miquelon</option>
                                                        <option value="190" {{ $student->country == 190 ? 'selected' : '' }}>Saint Vincent and the Grenadines</option>
                                                        <option value="191" {{ $student->country == 191 ? 'selected' : '' }}>Samoa</option>
                                                        <option value="192" {{ $student->country == 192 ? 'selected' : '' }}>San Marino</option>
                                                        <option value="193" {{ $student->country == 193 ? 'selected' : '' }}>Sao Tome and Principe</option>
                                                        <option value="194" {{ $student->country == 194 ? 'selected' : '' }}>Saudi Arabia</option>
                                                        <option value="195" {{ $student->country == 195 ? 'selected' : '' }}>Senegal</option>
                                                        <option value="196" {{ $student->country == 196 ? 'selected' : '' }}>Serbia</option>
                                                        <option value="197" {{ $student->country == 197 ? 'selected' : '' }}>Seychelles</option>
                                                        <option value="198" {{ $student->country == 198 ? 'selected' : '' }}>Sierra Leone</option>
                                                        <option value="199" {{ $student->country == 199 ? 'selected' : '' }}>Singapore</option>
                                                        <option value="200" {{ $student->country == 200 ? 'selected' : '' }}>Sint Maarten</option>
                                                        <option value="201" {{ $student->country == 201 ? 'selected' : '' }}>Slovakia</option>
                                                        <option value="202" {{ $student->country == 202 ? 'selected' : '' }}>Slovenia</option>
                                                        <option value="203" {{ $student->country == 203 ? 'selected' : '' }}>Solomon Islands</option>
                                                        <option value="204" {{ $student->country == 204 ? 'selected' : '' }}>Somalia</option>
                                                        <option value="205" {{ $student->country == 205 ? 'selected' : '' }}>South Africa</option>
                                                        <option value="206" {{ $student->country == 206 ? 'selected' : '' }}>South Georgia and the South Sandwich Islands</option>
                                                        <option value="207" {{ $student->country == 207 ? 'selected' : '' }}>South Korea</option>
                                                        <option value="208" {{ $student->country == 208 ? 'selected' : '' }}>South Sudan</option>
                                                        <option value="209" {{ $student->country == 209 ? 'selected' : '' }}>Spain</option>
                                                        <option value="210" {{ $student->country == 210 ? 'selected' : '' }}>Sri Lanka</option>
                                                        <option value="211" {{ $student->country == 211 ? 'selected' : '' }}>Sudan</option>
                                                        <option value="212" {{ $student->country == 212 ? 'selected' : '' }}>Suriname</option>
                                                        <option value="213" {{ $student->country == 213 ? 'selected' : '' }}>Svalbard and Jan Mayen</option>
                                                        <option value="214" {{ $student->country == 214 ? 'selected' : '' }}>Swaziland</option>
                                                        <option value="215" {{ $student->country == 215 ? 'selected' : '' }}>Sweden</option>
                                                        <option value="216" {{ $student->country == 216 ? 'selected' : '' }}>Switzerland</option>
                                                        <option value="217" {{ $student->country == 217 ? 'selected' : '' }}>Syria</option>
                                                        <option value="218" {{ $student->country == 218 ? 'selected' : '' }}>Taiwan</option>
                                                        <option value="219" {{ $student->country == 219 ? 'selected' : '' }}>Tajikistan</option>
                                                        <option value="220" {{ $student->country == 220 ? 'selected' : '' }}>Tanzania</option>
                                                        <option value="221" {{ $student->country == 221 ? 'selected' : '' }}>Thailand</option>
                                                        <option value="222" {{ $student->country == 222 ? 'selected' : '' }}>Timor-Leste (East Timor)</option>
                                                        <option value="223" {{ $student->country == 223 ? 'selected' : '' }}>Togo</option>
                                                        <option value="224" {{ $student->country == 224 ? 'selected' : '' }}>Tokelau</option>
                                                        <option value="225" {{ $student->country == 225 ? 'selected' : '' }}>Tonga</option>
                                                        <option value="226" {{ $student->country == 226 ? 'selected' : '' }}>Trinidad and Tobago</option>
                                                        <option value="227" {{ $student->country == 227 ? 'selected' : '' }}>Tunisia</option>
                                                        <option value="228" {{ $student->country == 228 ? 'selected' : '' }}>Turkey</option>
                                                        <option value="229" {{ $student->country == 229 ? 'selected' : '' }}>Turkmenistan</option>
                                                        <option value="230" {{ $student->country == 230 ? 'selected' : '' }}>Turks and Caicos Islands</option>
                                                        <option value="231" {{ $student->country == 231 ? 'selected' : '' }}>Tuvalu</option>
                                                        <option value="232" {{ $student->country == 232 ? 'selected' : '' }}>Uganda</option>
                                                        <option value="233" {{ $student->country == 233 ? 'selected' : '' }}>Ukraine</option>
                                                        <option value="234" {{ $student->country == 234 ? 'selected' : '' }}>United Arab Emirates</option>
                                                        <option value="235" {{ $student->country == 235 ? 'selected' : '' }}>United Kingdom</option>
                                                        <option value="236" {{ $student->country == 236 ? 'selected' : '' }}>United States</option>
                                                        <option value="237" {{ $student->country == 237 ? 'selected' : '' }}>United States Minor Outlying Islands</option>
                                                        <option value="238" {{ $student->country == 238 ? 'selected' : '' }}>Uruguay</option>
                                                        <option value="239" {{ $student->country == 239 ? 'selected' : '' }}>Uzbekistan</option>
                                                        <option value="240" {{ $student->country == 240 ? 'selected' : '' }}>Vanuatu</option>
                                                        <option value="241" {{ $student->country == 241 ? 'selected' : '' }}>Vatican City</option>
                                                        <option value="242" {{ $student->country == 242 ? 'selected' : '' }}>Venezuela</option>
                                                        <option value="243" {{ $student->country == 243 ? 'selected' : '' }}>Vietnam</option>
                                                        <option value="244" {{ $student->country == 244 ? 'selected' : '' }}>Virgin Islands, British</option>
                                                        <option value="245" {{ $student->country == 245 ? 'selected' : '' }}>Virgin Islands, US</option>
                                                        <option value="246" {{ $student->country == 246 ? 'selected' : '' }}>Wallis and Futuna</option>
                                                        <option value="247" {{ $student->country == 247 ? 'selected' : '' }}>Western Sahara</option>
                                                        <option value="248" {{ $student->country == 248 ? 'selected' : '' }}>Yemen</option>
                                                        <option value="249" {{ $student->country == 249 ? 'selected' : '' }}>Zambia</option>
                                                        <option value="250" {{ $student->country == 250 ? 'selected' : '' }}>Zimbabwe</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Province <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <select class="form-control form-control-lg" name="state_id"
                                                        id="state" required>
                                                        <option value="">Select Country First</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>City <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <select class="form-control form-control-lg" name="city_id"
                                                        id="city" required>
                                                        <option value="">Select Province First</option>
                                                    </select>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" name="address" class="form-control"
                                                        placeholder="Enter Address" value="{{ $student->address }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea type="text" name="description" class="form-control" placeholder="Enter description">{{ $student->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-sm-12 mb-2">
                                                <h4>Certificates</h4>
                                            </div>

                                            <div class="col-md-12 add-data-content">
                                                @if ($student->certificate->count() == 0)
                                                    <div class="d-flex align-items-center mt-2 row">
                                                        <div class="col-md-7">
                                                            <label class="form-control-label"><b>Certificate
                                                                    Name:</b></label>
                                                            <div
                                                                class="d-flex  align-items-center select-add-section ">
                                                                <input type="text" name="certificates_name[]"
                                                                    value="{{ old('$certificates_name') }}"
                                                                    class=" form-control"
                                                                    placeholder="Certificate Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-control-label"><b>Certificate
                                                                    File:</b></label>
                                                            <div class="d-flex  align-items-center select-add-section">
                                                                <input type="file" name="certificates_file[]"
                                                                    accept="image/jpeg,image/gif,image/png,application/pdf"
                                                                    value="{{ old('$certificates_file') }}"
                                                                    class=" form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-1">
                                                            <a id="plus-btn-data-content" href="javascript:void(0)"
                                                                class="plus-btn-data-content px-1 p-0 m-0 ml-2"><i
                                                                    class="fas fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                @else
                                                    @foreach ($student->certificate as $k => $item)
                                                        <div class="d-flex align-items-center mt-2 row">
                                                            <div class="col-md-7">
                                                                <label class="form-control-label"><b>Certificate
                                                                        Name:</b></label>
                                                                <div
                                                                    class="d-flex  align-items-center select-add-section ">
                                                                    <input type="text"
                                                                        name="old_certificates_name[{{ $item->id }}]"
                                                                        value="{{ $item->certificates_name }}"
                                                                        class=" form-control"
                                                                        placeholder="Certificate Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-control-label"><b>Certificate
                                                                        File:</b></label>
                                                                <div
                                                                    class="d-flex  align-items-center select-add-section">
                                                                    <input type="file"
                                                                        name="old_certificates_file[{{ $item->id }}]"
                                                                        accept="image/jpeg,image/gif,image/png,application/pdf"
                                                                        value="{{ $item->certificates_file }}"
                                                                        class=" form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="form-control-label"><b>View:</b></label>
                                                                <div
                                                                    class="d-flex  align-items-center select-add-section">
                                                                    <a class="btn btn-primary" data-toggle="modal"
                                                                        data-target="#certificateModal{{ $k }}">
                                                                        &nbsp;<i class="fa fa-solid fa-eye"
                                                                            style="color: white"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                @if ($k == $student->certificate->count() - 1)
                                                                    <a id="plus-btn-data-content"
                                                                        href="javascript:void(0)"
                                                                        class="plus-btn-data-content px-1 p-0 m-0 ml-2"><i
                                                                            class="fas fa-plus"></i></a>
                                                                @else
                                                                    <a audio_file_id="{{ $item->id }}"
                                                                        href="javascript:void(0)"
                                                                        class="minus-btn-data-old-audio px-1 p-0 m-0 ml-2"><i
                                                                            class="fas fa-minus-circle"></i></a>
                                                                @endif
                                                            </div>
                                                        </div>



                                                        <!-- Modal -->
                                                        <div class="modal fade"
                                                            id="certificateModal{{ $k }}" tabindex="-1"
                                                            role="dialog" aria-labelledby="audioModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="audioModalLabel"
                                                                            style="color: black">
                                                                            {{ $item->certificates_name }}</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        @if ($item->extension == 'pdf')
                                                                            <iframe
                                                                                src="{{ $item->certificates_file_show }}"
                                                                                width="100%"
                                                                                height="500"></iframe>
                                                                        @else
                                                                            <img src="{{ $item->certificates_file_show }}"
                                                                                alt="image"
                                                                                style="height: 300px; width:450px">
                                                                        @endif
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-primary"
                                                                            data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary mr-2">Update</button>
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

    <script src="{{ asset('backend/assets/js/dropify.js') }}"></script>
    <script>
        $('#avatar_upload').on('change', function(e) {
            var fileInput = $(this)[0];

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#avatar_preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        });
    </script>
    <script>
        $('#continent').on("change", function() {
            let id = $(this).val();
            let url = '{{ url('get/country/') }}/' + id;

            if (id == null || id == '') {
                $('#country').empty();
                let html = '<option value="">Select Continent First</option>';
                $('#country').append(html);
            }

            $.ajax({
                url: url,
                type: 'GET',
                success: function(res) {
                    $('#country').empty();

                    let html = '<option value="">Select Country</option>';
                    $.each(res, function(index, element) {
                        html += "<option value=" + element.id + ">" + element.name +
                            "</option>";
                    });
                    $('#country').append(html);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('#country').on("change", function() {
            let id = $(this).val();
            let url = '{{ url('/get/state/') }}/' + id;

            if (id == null || id == '') {
                $('#state').empty();
                let html = '<option value="">Select Country First</option>';
                $('#state').append(html);
            }

            $.ajax({
                url: url,
                type: 'GET',
                success: function(res) {

                    $('#state').empty();
                    let html = '<option value="">Select Province</option>';
                    $.each(res, function(index, element) {
                        html += "<option value=" + element.id + ">" + element.name +
                            "</option>";
                    });
                    $('#state').append(html);
                    $('#state').val("").change();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('#state').on("change", function() {
            let id = $(this).val();
            let url = '{{ url('/get/city/') }}/' + id;

            if (id == null || id == '') {
                $('#city').empty();
                let html = '<option value="">Select Province First</option>';
                $('#city').append(html);
            }

            $.ajax({
                url: url,
                type: 'GET',
                success: function(res) {

                    $('#city').empty();
                    let html = '<option value="">Select City</option>';
                    $.each(res, function(index, element) {
                        html += "<option value=" + element.id + ">" + element.name +
                            "</option>";
                    });
                    $('#city').append(html);
                    $('#city').val("").change();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '#plus-btn-data-content', function() {

            var myvar = '<div class="d-flex align-items-center mt-2 row">' +
                '    <div class="col-md-7">' +
                '        <label class="form-control-label"><b>Certificate Name:</b></label>' +
                '        <div class="d-flex  align-items-center select-add-section " >' +
                '            <input type="text" name="certificates_name[]" value="{{ old('$certificates_name') }}" class=" form-control" placeholder="Certificate Name">' +
                '        </div>' +
                '    </div>' +
                '    <div class="col-md-4">' +
                '        <label class="form-control-label"><b>Certificate File:</b></label>' +
                '        <div class="d-flex  align-items-center select-add-section">' +
                '            <input type="file"  name="certificates_file[]" accept="image/jpeg,image/gif,image/png,application/pdf" value="{{ old('$certificates_file') }}" class=" form-control">' +
                '        </div>' +
                '    </div>' +
                '    <div class="col-md-1">' +
                '     <a href="javascript:void(0)" class="minus-btn-data-content px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>' +
                '    </div>' +
                '</div>';

            $('.add-data-content').prepend(myvar);
        });

        $(document).on('click', '.minus-btn-data-content', function() {
            $(this).parent().parent().remove();
        });

        $(document).on('click', '.minus-btn-data-old-audio', function() {
            $(this).parent().parent().parent().append(
                '<input type="hidden" name="delete_certificates_file[]" value="' + $(this).attr(
                    'audio_file_id') + '">');
            $(this).parent().parent().remove();
        });
    </script>
</body>

</html>
