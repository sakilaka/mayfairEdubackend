<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/summernote/dist/summernote-bs4.css') }}">
    <title>{{ env('APP_NAME') }} | Edit Partner</title>
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
                            Edit Partner
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.consultant.index', ['id' => $consultant->id]) }}"
                                class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All Partner</a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-md-12 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample"
                                        action="{{ route('admin.consultant.update', ['id' => $consultant->id]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row mb-3">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="row">
                                                    <div class="col-sm-12 mb-2">
                                                        <h4>Personal Details</h4>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Partner Photo <span
                                                                    class="text-danger"
                                                                    style="font-size: 1.25rem; line-height:0;">*</span></label>
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
                                                            <img src="{{ $consultant->image_show ?? asset('frontend/images/No-image.jpg') }}"
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
                                                    <label class="form-control-label">Partner Name:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Enter Name" value="{{ $consultant->name }}"
                                                            required>
                                                        @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">
                                                        Partner Star:
                                                        <span class="text-danger" style="font-size: 1.25rem; line-height: 0;">*</span>
                                                    </label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <select name="star" id="star" class="form-control">
                                                            <option value="">Select star</option>
                                                            @foreach ($levels as $level)
                                                                <option value="{{ $level->star_value }}" 
                                                                    {{ $consultant->star == $level->star_value ? 'selected' : '' }}>
                                                                    {{ $level->star_value }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('star')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
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
                                                            placeholder="Enter Name" value="{{ $consultant->mobile }}"
                                                            required>
                                                        @error('mobile')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
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
                                                            placeholder="Enter Email" value="{{ $consultant->email }}"
                                                            required>
                                                        @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Passport or NID:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="nid" class="form-control"
                                                            placeholder="Enter passport or NID" value="{{ $consultant->nid }}"
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
                                                            @if ($consultant->gender == '0') Selected @endif>Male
                                                        </option>
                                                        <option value="1"
                                                            @if ($consultant->gender == '1') Selected @endif>Female
                                                        </option>
                                                        <option value="1"
                                                            @if ($consultant->gender == '2') Selected @endif>Other
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
                                                            value="{{ date('Y-m-d', strtotime($consultant->dob)) }}"
                                                            class="form-control" required>
                                                    </div>
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
                                                            <option @if ($continent->id == $consultant->continent_id) Selected @endif
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
                                                  
                                                        <option value="1" {{ $consultant->country == 1 ? 'selected' : '' }}>Afghanistan</option>
                                                        <option value="2" {{ $consultant->country == 2 ? 'selected' : '' }}>Aland Islands</option>
                                                        <option value="3" {{ $consultant->country == 3 ? 'selected' : '' }}>Albania</option>
                                                        <option value="4" {{ $consultant->country == 4 ? 'selected' : '' }}>Algeria</option>
                                                        <option value="5" {{ $consultant->country == 5 ? 'selected' : '' }}>American Samoa</option>
                                                        <option value="6" {{ $consultant->country == 6 ? 'selected' : '' }}>Andorra</option>
                                                        <option value="7" {{ $consultant->country == 7 ? 'selected' : '' }}>Angola</option>
                                                        <option value="8" {{ $consultant->country == 8 ? 'selected' : '' }}>Anguilla</option>
                                                        <option value="9" {{ $consultant->country == 9 ? 'selected' : '' }}>Antarctica</option>
                                                        <option value="10" {{ $consultant->country == 10 ? 'selected' : '' }}>Antigua and Barbuda</option>
                                                        <option value="11" {{ $consultant->country == 11 ? 'selected' : '' }}>Argentina</option>
                                                        <option value="12" {{ $consultant->country == 12 ? 'selected' : '' }}>Armenia</option>
                                                        <option value="13" {{ $consultant->country == 13 ? 'selected' : '' }}>Aruba</option>
                                                        <option value="14" {{ $consultant->country == 14 ? 'selected' : '' }}>Australia</option>
                                                        <option value="15" {{ $consultant->country == 15 ? 'selected' : '' }}>Austria</option>
                                                        <option value="16" {{ $consultant->country == 16 ? 'selected' : '' }}>Azerbaijan</option>
                                                        <option value="17" {{ $consultant->country == 17 ? 'selected' : '' }}>Bahamas</option>
                                                        <option value="18" {{ $consultant->country == 18 ? 'selected' : '' }}>Bahrain</option>
                                                        <option value="19" {{ $consultant->country == 19 ? 'selected' : '' }}>Bangladesh</option>
                                                        <option value="20" {{ $consultant->country == 20 ? 'selected' : '' }}>Barbados</option>
                                                        <option value="21" {{ $consultant->country == 21 ? 'selected' : '' }}>Belarus</option>
                                                        <option value="22" {{ $consultant->country == 22 ? 'selected' : '' }}>Belgium</option>
                                                        <option value="23" {{ $consultant->country == 23 ? 'selected' : '' }}>Belize</option>
                                                        <option value="24" {{ $consultant->country == 24 ? 'selected' : '' }}>Benin</option>
                                                        <option value="25" {{ $consultant->country == 25 ? 'selected' : '' }}>Bermuda</option>
                                                        <option value="26" {{ $consultant->country == 26 ? 'selected' : '' }}>Bhutan</option>
                                                        <option value="27" {{ $consultant->country == 27 ? 'selected' : '' }}>Bolivia</option>
                                                        <option value="28" {{ $consultant->country == 28 ? 'selected' : '' }}>Bonaire, Sint Eustatius and Saba</option>
                                                        <option value="29" {{ $consultant->country == 29 ? 'selected' : '' }}>Bosnia and Herzegovina</option>
                                                        <option value="30" {{ $consultant->country == 30 ? 'selected' : '' }}>Botswana</option>
                                                        <option value="31" {{ $consultant->country == 31 ? 'selected' : '' }}>Bouvet Island</option>
                                                        <option value="32" {{ $consultant->country == 32 ? 'selected' : '' }}>Brazil</option>
                                                        <option value="33" {{ $consultant->country == 33 ? 'selected' : '' }}>British Indian Ocean Territory</option>
                                                        <option value="34" {{ $consultant->country == 34 ? 'selected' : '' }}>Brunei</option>
                                                        <option value="35" {{ $consultant->country == 35 ? 'selected' : '' }}>Bulgaria</option>
                                                        <option value="36" {{ $consultant->country == 36 ? 'selected' : '' }}>Burkina Faso</option>
                                                        <option value="37" {{ $consultant->country == 37 ? 'selected' : '' }}>Burundi</option>
                                                        <option value="38" {{ $consultant->country == 38 ? 'selected' : '' }}>Cambodia</option>
                                                        <option value="39" {{ $consultant->country == 39 ? 'selected' : '' }}>Cameroon</option>
                                                        <option value="40" {{ $consultant->country == 40 ? 'selected' : '' }}>Canada</option>
                                                        <option value="41" {{ $consultant->country == 41 ? 'selected' : '' }}>Cape Verde</option>
                                                        <option value="42" {{ $consultant->country == 42 ? 'selected' : '' }}>Cayman Islands</option>
                                                        <option value="43" {{ $consultant->country == 43 ? 'selected' : '' }}>Central African Republic</option>
                                                        <option value="44" {{ $consultant->country == 44 ? 'selected' : '' }}>Chad</option>
                                                        <option value="45" {{ $consultant->country == 45 ? 'selected' : '' }}>Chile</option>
                                                        <option value="46" {{ $consultant->country == 46 ? 'selected' : '' }}>China</option>
                                                        <option value="47" {{ $consultant->country == 47 ? 'selected' : '' }}>Christmas Island</option>
                                                        <option value="48" {{ $consultant->country == 48 ? 'selected' : '' }}>Cocos (Keeling) Islands</option>
                                                        <option value="49" {{ $consultant->country == 49 ? 'selected' : '' }}>Colombia</option>
                                     
                                                        <option value="50" {{ $consultant->country == 50 ? 'selected' : '' }}>Comoros</option>
                                                        <option value="51" {{ $consultant->country == 51 ? 'selected' : '' }}>Congo</option>
                                                        <option value="52" {{ $consultant->country == 52 ? 'selected' : '' }}>Cook Islands</option>
                                                        <option value="53" {{ $consultant->country == 53 ? 'selected' : '' }}>Costa Rica</option>
                                                        <option value="55" {{ $consultant->country == 55 ? 'selected' : '' }}>Croatia</option>
                                                        <option value="56" {{ $consultant->country == 56 ? 'selected' : '' }}>Cuba</option>
                                                        <option value="57" {{ $consultant->country == 57 ? 'selected' : '' }}>Curacao</option>
                                                        <option value="58" {{ $consultant->country == 58 ? 'selected' : '' }}>Cyprus</option>
                                                        <option value="59" {{ $consultant->country == 59 ? 'selected' : '' }}>Czech Republic</option>
                                                        <option value="60" {{ $consultant->country == 60 ? 'selected' : '' }}>Democratic Republic of the Congo</option>
                                                        <option value="61" {{ $consultant->country == 61 ? 'selected' : '' }}>Denmark</option>
                                                        <option value="62" {{ $consultant->country == 62 ? 'selected' : '' }}>Djibouti</option>
                                                        <option value="63" {{ $consultant->country == 63 ? 'selected' : '' }}>Dominica</option>
                                                        <option value="64" {{ $consultant->country == 64 ? 'selected' : '' }}>Dominican Republic</option>
                                                        <option value="65" {{ $consultant->country == 65 ? 'selected' : '' }}>Ecuador</option>
                                                        <option value="66" {{ $consultant->country == 66 ? 'selected' : '' }}>Egypt</option>
                                                        <option value="67" {{ $consultant->country == 67 ? 'selected' : '' }}>El Salvador</option>
                                                        <option value="68" {{ $consultant->country == 68 ? 'selected' : '' }}>Equatorial Guinea</option>
                                                        <option value="69" {{ $consultant->country == 69 ? 'selected' : '' }}>Eritrea</option>
                                                        <option value="70" {{ $consultant->country == 70 ? 'selected' : '' }}>Estonia</option>
                                                        <option value="71" {{ $consultant->country == 71 ? 'selected' : '' }}>Ethiopia</option>
                                                        <option value="72" {{ $consultant->country == 72 ? 'selected' : '' }}>Falkland Islands (Malvinas)</option>
                                                        <option value="73" {{ $consultant->country == 73 ? 'selected' : '' }}>Faroe Islands</option>
                                                        <option value="74" {{ $consultant->country == 74 ? 'selected' : '' }}>Fiji</option>
                                                        <option value="75" {{ $consultant->country == 75 ? 'selected' : '' }}>Finland</option>
                                                        <option value="76" {{ $consultant->country == 76 ? 'selected' : '' }}>France</option>
                                                        <option value="77" {{ $consultant->country == 77 ? 'selected' : '' }}>French Guiana</option>
                                                        <option value="78" {{ $consultant->country == 78 ? 'selected' : '' }}>French Polynesia</option>
                                                        <option value="79" {{ $consultant->country == 79 ? 'selected' : '' }}>French Southern Territories</option>
                                                        <option value="80" {{ $consultant->country == 80 ? 'selected' : '' }}>Gabon</option>
                                                        <option value="81" {{ $consultant->country == 81 ? 'selected' : '' }}>Gambia</option>
                                                        <option value="82" {{ $consultant->country == 82 ? 'selected' : '' }}>Georgia</option>
                                                        <option value="83" {{ $consultant->country == 83 ? 'selected' : '' }}>Germany</option>
                                                        <option value="84" {{ $consultant->country == 84 ? 'selected' : '' }}>Ghana</option>
                                                        <option value="85" {{ $consultant->country == 85 ? 'selected' : '' }}>Gibraltar</option>
                                                        <option value="86" {{ $consultant->country == 86 ? 'selected' : '' }}>Greece</option>
                                                        <option value="87" {{ $consultant->country == 87 ? 'selected' : '' }}>Greenland</option>
                                                        <option value="88" {{ $consultant->country == 88 ? 'selected' : '' }}>Grenada</option>
                                                        <option value="89" {{ $consultant->country == 89 ? 'selected' : '' }}>Guadaloupe</option>
                                                        <option value="90" {{ $consultant->country == 90 ? 'selected' : '' }}>Guam</option>
                                                        <option value="91" {{ $consultant->country == 91 ? 'selected' : '' }}>Guatemala</option>
                                                        <option value="92" {{ $consultant->country == 92 ? 'selected' : '' }}>Guernsey</option>
                                                        <option value="93" {{ $consultant->country == 93 ? 'selected' : '' }}>Guinea</option>
                                                        <option value="94" {{ $consultant->country == 94 ? 'selected' : '' }}>Guinea-Bissau</option>
                                                        <option value="95" {{ $consultant->country == 95 ? 'selected' : '' }}>Guyana</option>
                                                        <option value="96" {{ $consultant->country == 96 ? 'selected' : '' }}>Haiti</option>
                                                        <option value="97" {{ $consultant->country == 97 ? 'selected' : '' }}>Heard Island and McDonald Islands</option>
                                                        <option value="98" {{ $consultant->country == 98 ? 'selected' : '' }}>Honduras</option>
                                                        <option value="99" {{ $consultant->country == 99 ? 'selected' : '' }}>Hong Kong</option>
                                                        <option value="100" {{ $consultant->country == 100 ? 'selected' : '' }}>Hungary</option>
                                                        <option value="101" {{ $consultant->country == 101 ? 'selected' : '' }}>Iceland</option>
                                                        <option value="102" {{ $consultant->country == 102 ? 'selected' : '' }}>India</option>
                                                        <option value="103" {{ $consultant->country == 103 ? 'selected' : '' }}>Indonesia</option>
                                                        <option value="104" {{ $consultant->country == 104 ? 'selected' : '' }}>Iran</option>
                                                        <option value="105" {{ $consultant->country == 105 ? 'selected' : '' }}>Iraq</option>
                                                        <option value="106" {{ $consultant->country == 106 ? 'selected' : '' }}>Ireland</option>
                                                        <option value="107" {{ $consultant->country == 107 ? 'selected' : '' }}>Isle of Man</option>
                                                        <option value="108" {{ $consultant->country == 108 ? 'selected' : '' }}>Israel</option>
                                                        <option value="109" {{ $consultant->country == 109 ? 'selected' : '' }}>Italy</option>
                                                        <option value="110" {{ $consultant->country == 110 ? 'selected' : '' }}>Jamaica</option>
                                                        <option value="111" {{ $consultant->country == 111 ? 'selected' : '' }}>Japan</option>
                                                        <option value="112" {{ $consultant->country == 112 ? 'selected' : '' }}>Jersey</option>
                                                        <option value="113" {{ $consultant->country == 113 ? 'selected' : '' }}>Jordan</option>
                                                        <option value="114" {{ $consultant->country == 114 ? 'selected' : '' }}>Kazakhstan</option>
                                                        <option value="115" {{ $consultant->country == 115 ? 'selected' : '' }}>Kenya</option>
                                                        <option value="116" {{ $consultant->country == 116 ? 'selected' : '' }}>Kiribati</option>
                                                        <option value="117" {{ $consultant->country == 117 ? 'selected' : '' }}>Kosovo</option>
                                                        <option value="118" {{ $consultant->country == 118 ? 'selected' : '' }}>Kuwait</option>
                                                        <option value="119" {{ $consultant->country == 119 ? 'selected' : '' }}>Kyrgyzstan</option>
                                                        <option value="120" {{ $consultant->country == 120 ? 'selected' : '' }}>Laos</option>
                                                        <option value="121" {{ $consultant->country == 121 ? 'selected' : '' }}>Latvia</option>
                                                        <option value="122" {{ $consultant->country == 122 ? 'selected' : '' }}>Lebanon</option>
                                                        <option value="123" {{ $consultant->country == 123 ? 'selected' : '' }}>Lesotho</option>
                                                        <option value="124" {{ $consultant->country == 124 ? 'selected' : '' }}>Liberia</option>
                                                        <option value="125" {{ $consultant->country == 125 ? 'selected' : '' }}>Libya</option>
                                                        <option value="126" {{ $consultant->country == 126 ? 'selected' : '' }}>Liechtenstein</option>
                                                        <option value="127" {{ $consultant->country == 127 ? 'selected' : '' }}>Lithuania</option>
                                                        <option value="128" {{ $consultant->country == 128 ? 'selected' : '' }}>Luxembourg</option>
                                                        <option value="129" {{ $consultant->country == 129 ? 'selected' : '' }}>Macao</option>
                                                        <option value="130" {{ $consultant->country == 130 ? 'selected' : '' }}>Macedonia</option>
                                                        <option value="131" {{ $consultant->country == 131 ? 'selected' : '' }}>Madagascar</option>
                                                        <option value="132" {{ $consultant->country == 132 ? 'selected' : '' }}>Malawi</option>
                                                        <option value="133" {{ $consultant->country == 133 ? 'selected' : '' }}>Malaysia</option>
                                                        <option value="134" {{ $consultant->country == 134 ? 'selected' : '' }}>Maldives</option>
                                                        <option value="135" {{ $consultant->country == 135 ? 'selected' : '' }}>Mali</option>
                                                        <option value="136" {{ $consultant->country == 136 ? 'selected' : '' }}>Malta</option>
                                                        <option value="137" {{ $consultant->country == 137 ? 'selected' : '' }}>Marshall Islands</option>
                                                        <option value="138" {{ $consultant->country == 138 ? 'selected' : '' }}>Martinique</option>
                                                        <option value="139" {{ $consultant->country == 139 ? 'selected' : '' }}>Mauritania</option>
                                                        <option value="140" {{ $consultant->country == 140 ? 'selected' : '' }}>Mauritius</option>
                                                        <option value="141" {{ $consultant->country == 141 ? 'selected' : '' }}>Mayotte</option>
                                                        <option value="142" {{ $consultant->country == 142 ? 'selected' : '' }}>Mexico</option>
                                                        <option value="143" {{ $consultant->country == 143 ? 'selected' : '' }}>Micronesia</option>
                                                        <option value="144" {{ $consultant->country == 144 ? 'selected' : '' }}>Moldava</option>
                                                        <option value="145" {{ $consultant->country == 145 ? 'selected' : '' }}>Monaco</option>
                                                        <option value="146" {{ $consultant->country == 146 ? 'selected' : '' }}>Mongolia</option>
                                                        <option value="147" {{ $consultant->country == 147 ? 'selected' : '' }}>Montenegro</option>
                                                        <option value="148" {{ $consultant->country == 148 ? 'selected' : '' }}>Montserrat</option>
                                                        <option value="149" {{ $consultant->country == 149 ? 'selected' : '' }}>Morocco</option>
                                                        <option value="150" {{ $consultant->country == 150 ? 'selected' : '' }}>Mozambique</option>
                                                        <option value="151" {{ $consultant->country == 151 ? 'selected' : '' }}>Myanmar (Burma)</option>
                                                        <option value="152" {{ $consultant->country == 152 ? 'selected' : '' }}>Namibia</option>
                                                        <option value="153" {{ $consultant->country == 153 ? 'selected' : '' }}>Nauru</option>
                                                        <option value="154" {{ $consultant->country == 154 ? 'selected' : '' }}>Nepal</option>
                                                        <option value="155" {{ $consultant->country == 155 ? 'selected' : '' }}>Netherlands</option>
                                                        <option value="156" {{ $consultant->country == 156 ? 'selected' : '' }}>New Caledonia</option>
                                                        <option value="157" {{ $consultant->country == 157 ? 'selected' : '' }}>New Zealand</option>
                                                        <option value="158" {{ $consultant->country == 158 ? 'selected' : '' }}>Nicaragua</option>
                                                        <option value="159" {{ $consultant->country == 159 ? 'selected' : '' }}>Niger</option>
                                                        <option value="160" {{ $consultant->country == 160 ? 'selected' : '' }}>Nigeria</option>
                                                        <option value="161" {{ $consultant->country == 161 ? 'selected' : '' }}>Niue</option>
                                                        <option value="162" {{ $consultant->country == 162 ? 'selected' : '' }}>Norfolk Island</option>
                                                        <option value="163" {{ $consultant->country == 163 ? 'selected' : '' }}>North Korea</option>
                                                        <option value="164" {{ $consultant->country == 164 ? 'selected' : '' }}>Northern Mariana Islands</option>
                                                        <option value="165" {{ $consultant->country == 165 ? 'selected' : '' }}>Norway</option>
                                                        <option value="166" {{ $consultant->country == 166 ? 'selected' : '' }}>Oman</option>
                                                        <option value="167" {{ $consultant->country == 167 ? 'selected' : '' }}>Pakistan</option>
                                                        <option value="168" {{ $consultant->country == 168 ? 'selected' : '' }}>Palau</option>
                                                        <option value="169" {{ $consultant->country == 169 ? 'selected' : '' }}>Palestine</option>
                                                        <option value="170" {{ $consultant->country == 170 ? 'selected' : '' }}>Panama</option>
                                                        <option value="171" {{ $consultant->country == 171 ? 'selected' : '' }}>Papua New Guinea</option>
                                                        <option value="172" {{ $consultant->country == 172 ? 'selected' : '' }}>Paraguay</option>
                                                        <option value="173" {{ $consultant->country == 173 ? 'selected' : '' }}>Peru</option>
                                                        <option value="174" {{ $consultant->country == 174 ? 'selected' : '' }}>Philippines</option>
                                                        <option value="175" {{ $consultant->country == 175 ? 'selected' : '' }}>Pitcairn</option>
                                                        <option value="176" {{ $consultant->country == 176 ? 'selected' : '' }}>Poland</option>
                                                        <option value="177" {{ $consultant->country == 177 ? 'selected' : '' }}>Portugal</option>
                                                        <option value="178" {{ $consultant->country == 178 ? 'selected' : '' }}>Puerto Rico</option>
                                                        <option value="179" {{ $consultant->country == 179 ? 'selected' : '' }}>Qatar</option>
                                                        <option value="180" {{ $consultant->country == 180 ? 'selected' : '' }}>Reunion</option>
                                                        <option value="181" {{ $consultant->country == 181 ? 'selected' : '' }}>Romania</option>
                                                        <option value="182" {{ $consultant->country == 182 ? 'selected' : '' }}>Russia</option>
                                                        <option value="183" {{ $consultant->country == 183 ? 'selected' : '' }}>Rwanda</option>
                                                        <option value="184" {{ $consultant->country == 184 ? 'selected' : '' }}>Saint Barthelemy</option>
                                                        <option value="185" {{ $consultant->country == 185 ? 'selected' : '' }}>Saint Helena</option>
                                                        <option value="186" {{ $consultant->country == 186 ? 'selected' : '' }}>Saint Kitts and Nevis</option>
                                                        <option value="187" {{ $consultant->country == 187 ? 'selected' : '' }}>Saint Lucia</option>
                                                        <option value="188" {{ $consultant->country == 188 ? 'selected' : '' }}>Saint Martin</option>
                                                        <option value="189" {{ $consultant->country == 189 ? 'selected' : '' }}>Saint Pierre and Miquelon</option>
                                                        <option value="190" {{ $consultant->country == 190 ? 'selected' : '' }}>Saint Vincent and the Grenadines</option>
                                                        <option value="191" {{ $consultant->country == 191 ? 'selected' : '' }}>Samoa</option>
                                                        <option value="192" {{ $consultant->country == 192 ? 'selected' : '' }}>San Marino</option>
                                                        <option value="193" {{ $consultant->country == 193 ? 'selected' : '' }}>Sao Tome and Principe</option>
                                                        <option value="194" {{ $consultant->country == 194 ? 'selected' : '' }}>Saudi Arabia</option>
                                                        <option value="195" {{ $consultant->country == 195 ? 'selected' : '' }}>Senegal</option>
                                                        <option value="196" {{ $consultant->country == 196 ? 'selected' : '' }}>Serbia</option>
                                                        <option value="197" {{ $consultant->country == 197 ? 'selected' : '' }}>Seychelles</option>
                                                        <option value="198" {{ $consultant->country == 198 ? 'selected' : '' }}>Sierra Leone</option>
                                                        <option value="199" {{ $consultant->country == 199 ? 'selected' : '' }}>Singapore</option>
                                                        <option value="200" {{ $consultant->country == 200 ? 'selected' : '' }}>Sint Maarten</option>
                                                        <option value="201" {{ $consultant->country == 201 ? 'selected' : '' }}>Slovakia</option>
                                                        <option value="202" {{ $consultant->country == 202 ? 'selected' : '' }}>Slovenia</option>
                                                        <option value="203" {{ $consultant->country == 203 ? 'selected' : '' }}>Solomon Islands</option>
                                                        <option value="204" {{ $consultant->country == 204 ? 'selected' : '' }}>Somalia</option>
                                                        <option value="205" {{ $consultant->country == 205 ? 'selected' : '' }}>South Africa</option>
                                                        <option value="206" {{ $consultant->country == 206 ? 'selected' : '' }}>South Georgia and the South Sandwich Islands</option>
                                                        <option value="207" {{ $consultant->country == 207 ? 'selected' : '' }}>South Korea</option>
                                                        <option value="208" {{ $consultant->country == 208 ? 'selected' : '' }}>South Sudan</option>
                                                        <option value="209" {{ $consultant->country == 209 ? 'selected' : '' }}>Spain</option>
                                                        <option value="210" {{ $consultant->country == 210 ? 'selected' : '' }}>Sri Lanka</option>
                                                        <option value="211" {{ $consultant->country == 211 ? 'selected' : '' }}>Sudan</option>
                                                        <option value="212" {{ $consultant->country == 212 ? 'selected' : '' }}>Suriname</option>
                                                        <option value="213" {{ $consultant->country == 213 ? 'selected' : '' }}>Svalbard and Jan Mayen</option>
                                                        <option value="214" {{ $consultant->country == 214 ? 'selected' : '' }}>Swaziland</option>
                                                        <option value="215" {{ $consultant->country == 215 ? 'selected' : '' }}>Sweden</option>
                                                        <option value="216" {{ $consultant->country == 216 ? 'selected' : '' }}>Switzerland</option>
                                                        <option value="217" {{ $consultant->country == 217 ? 'selected' : '' }}>Syria</option>
                                                        <option value="218" {{ $consultant->country == 218 ? 'selected' : '' }}>Taiwan</option>
                                                        <option value="219" {{ $consultant->country == 219 ? 'selected' : '' }}>Tajikistan</option>
                                                        <option value="220" {{ $consultant->country == 220 ? 'selected' : '' }}>Tanzania</option>
                                                        <option value="221" {{ $consultant->country == 221 ? 'selected' : '' }}>Thailand</option>
                                                        <option value="222" {{ $consultant->country == 222 ? 'selected' : '' }}>Timor-Leste (East Timor)</option>
                                                        <option value="223" {{ $consultant->country == 223 ? 'selected' : '' }}>Togo</option>
                                                        <option value="224" {{ $consultant->country == 224 ? 'selected' : '' }}>Tokelau</option>
                                                        <option value="225" {{ $consultant->country == 225 ? 'selected' : '' }}>Tonga</option>
                                                        <option value="226" {{ $consultant->country == 226 ? 'selected' : '' }}>Trinidad and Tobago</option>
                                                        <option value="227" {{ $consultant->country == 227 ? 'selected' : '' }}>Tunisia</option>
                                                        <option value="228" {{ $consultant->country == 228 ? 'selected' : '' }}>Turkey</option>
                                                        <option value="229" {{ $consultant->country == 229 ? 'selected' : '' }}>Turkmenistan</option>
                                                        <option value="230" {{ $consultant->country == 230 ? 'selected' : '' }}>Turks and Caicos Islands</option>
                                                        <option value="231" {{ $consultant->country == 231 ? 'selected' : '' }}>Tuvalu</option>
                                                        <option value="232" {{ $consultant->country == 232 ? 'selected' : '' }}>Uganda</option>
                                                        <option value="233" {{ $consultant->country == 233 ? 'selected' : '' }}>Ukraine</option>
                                                        <option value="234" {{ $consultant->country == 234 ? 'selected' : '' }}>United Arab Emirates</option>
                                                        <option value="235" {{ $consultant->country == 235 ? 'selected' : '' }}>United Kingdom</option>
                                                        <option value="236" {{ $consultant->country == 236 ? 'selected' : '' }}>United States</option>
                                                        <option value="237" {{ $consultant->country == 237 ? 'selected' : '' }}>United States Minor Outlying Islands</option>
                                                        <option value="238" {{ $consultant->country == 238 ? 'selected' : '' }}>Uruguay</option>
                                                        <option value="239" {{ $consultant->country == 239 ? 'selected' : '' }}>Uzbekistan</option>
                                                        <option value="240" {{ $consultant->country == 240 ? 'selected' : '' }}>Vanuatu</option>
                                                        <option value="241" {{ $consultant->country == 241 ? 'selected' : '' }}>Vatican City</option>
                                                        <option value="242" {{ $consultant->country == 242 ? 'selected' : '' }}>Venezuela</option>
                                                        <option value="243" {{ $consultant->country == 243 ? 'selected' : '' }}>Vietnam</option>
                                                        <option value="244" {{ $consultant->country == 244 ? 'selected' : '' }}>Virgin Islands, British</option>
                                                        <option value="245" {{ $consultant->country == 245 ? 'selected' : '' }}>Virgin Islands, US</option>
                                                        <option value="246" {{ $consultant->country == 246 ? 'selected' : '' }}>Wallis and Futuna</option>
                                                        <option value="247" {{ $consultant->country == 247 ? 'selected' : '' }}>Western Sahara</option>
                                                        <option value="248" {{ $consultant->country == 248 ? 'selected' : '' }}>Yemen</option>
                                                        <option value="249" {{ $consultant->country == 249 ? 'selected' : '' }}>Zambia</option>
                                                        <option value="250" {{ $consultant->country == 250 ? 'selected' : '' }}>Zimbabwe</option>
                                              
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
                                                    <input type="text" name="address"
                                                        value="{{ $consultant->address }}" class="form-control"
                                                        placeholder="Enter Address">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea type="text" name="description" class="form-control" placeholder="Enter description">{{ $consultant->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-12 mb-2">
                                                <h4>Social</h4>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>
                                                        <i class="fab fa-facebook" aria-hidden="true"></i>
                                                        Facebook
                                                    </label>
                                                    <input type="text" name="facebook_url"
                                                        value="{{ $consultant->facebook_url }}" class="form-control"
                                                        placeholder="Enter Facebook URL">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>
                                                        <i class="fab fa-twitter" aria-hidden="true"></i>
                                                        Twitter
                                                    </label>
                                                    <input type="text" name="twitter_url"
                                                        value="{{ $consultant->twitter_url }}" class="form-control"
                                                        placeholder="Enter Twitter URL">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>
                                                        <i class="fab fa-google" aria-hidden="true"></i>
                                                        Google Plus
                                                    </label>
                                                    <input type="text" name="google_plus_url"
                                                        value="{{ $consultant->google_plus_url }}"
                                                        class="form-control" placeholder="Enter Google Plus URL">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>
                                                        <i class="fab fa-instagram" aria-hidden="true"></i>
                                                        Instagram
                                                    </label>
                                                    <input type="text" name="instagram_url"
                                                        value="{{ $consultant->instagram_url }}" class="form-control"
                                                        placeholder="Enter Instagram URL">
                                                </div>
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
</body>

</html>
