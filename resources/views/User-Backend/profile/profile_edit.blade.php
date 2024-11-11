<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ env('APP_NAME') }} | Edit Profile</title>
    @include('User-Backend.components.head')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/summernote/dist/summernote-bs4.css') }}">
</head>

<body>
    <div class="container-scroller">
        @include('User-Backend.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('User-Backend.components.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            Edit Profile
                        </h3>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0"><b>Personal Information</b></h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.profile_info_update', Auth::user()->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="menu_type" class=" col-form-label">Profile Photo</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-8 col-lg-6">
                                                        <div class="dropify-wrapper" style="border: none">
                                                            <div class="dropify-loader"></div>
                                                            <div class="dropify-errors-container">
                                                                <ul></ul>
                                                            </div>
                                                            <input type="file" class="dropify" name="new_image"
                                                                accept="image/*" id="thumbnail_upload">
                                                            <button type="button" class="dropify-clear">Remove</button>
                                                            <div class="dropify-preview">
                                                                <span class="dropify-render"></span>
                                                                <div class="dropify-infos">
                                                                    <div class="dropify-infos-inner">
                                                                        <p class="dropify-filename">
                                                                            <span class="file-icon"></span>
                                                                            <span class="dropify-filename-inner"></span>
                                                                        </p>
                                                                        <p class="dropify-infos-message">
                                                                            Drag and drop or click to replace
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-sm-12 col-md-4 col-lg-6 d-flex justify-content-center align-items-center">
                                                        <div class="px-3">
                                                            <img src="{{ Auth::user()->image_show ?? asset('frontend/images/No-image.jpg') }}"
                                                                alt="" class="img-fluid"
                                                                style="border-radius: 10px; max-height: 200px !important;"
                                                                id="thumbnail_preview">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Full Name</label>
                                            <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                                name="name" placeholder="Username" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Email Address</label>
                                            <input type="email" class="form-control" value="{{ Auth::user()->email }}"
                                                name="email" placeholder="Email Address" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Mobile Number</label>
                                            <input type="text" class="form-control"
                                                value="{{ Auth::user()->mobile }}" name="mobile"
                                                placeholder="Mobile Number" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Gender</label>
                                            <select class="form-control form-control-lg" name="gender" required>
                                                <option value="">Select Gender</option>
                                                <option @if (Auth::user()->gender == '0') Selected @endif
                                                    value="0">Male</option>
                                                <option @if (Auth::user()->gender == '1') Selected @endif
                                                    value="1">Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Date of Birth</label>
                                            <input type="date" class="form-control" value="{{ Auth::user()->dob }}"
                                                name="dob" />
                                        </div>
                                    </div> --}}

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Passport or NID</label>
                                            <input type="text" class="form-control" value="{{ Auth::user()->nid }}"
                                                name="nid" placeholder="Passport or NID" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Qualification</label>
                                            <input type="text" class="form-control"
                                                value="{{ Auth::user()->qualification }}" name="qualification"
                                                placeholder="Qualification" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Experience</label>
                                            <input type="text" class="form-control"
                                                value="{{ Auth::user()->experience }}" name="experience"
                                                placeholder="Experience" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Language</label>
                                            <select class="form-select form-control form-control-lg" name="language">
                                                <option value="">Select one language</option>
                                                <option @if (Auth::user()->language == '1') Selected @endif
                                                    value="1">Bangla</option>
                                                <option @if (Auth::user()->language == '2') Selected @endif
                                                    value="2">English</option>
                                                <option @if (Auth::user()->language == '3') Selected @endif
                                                    value="3">Hindi</option>
                                                <option @if (Auth::user()->language == '4') Selected @endif
                                                    value="4">Arabic</option>
                                            </select>
                                        </div>
                                    </div>

                                    @if (Auth::user()->type == 1 || Auth::user()->type == 7)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label class="col-form-label">Continent</label>
                                                <select class="form-control form-control-lg" name="continent_id"
                                                    required>
                                                    <option value="">Select Continent</option>
                                                    @foreach ($continents as $continent)
                                                        <option @if (@$continent->id == @Auth::user()->continents->id) Selected @endif
                                                            value="{{ @$continent->id }}">{{ @$continent->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Country</label>
                                            @php
                                                $countries = [
                                                    1 => 'Afghanistan',
                                                    2 => 'Aland Islands',
                                                    3 => 'Albania',
                                                    4 => 'Algeria',
                                                    5 => 'American Samoa',
                                                    6 => 'Andorra',
                                                    7 => 'Angola',
                                                    8 => 'Anguilla',
                                                    9 => 'Antarctica',
                                                    10 => 'Antigua and Barbuda',
                                                    11 => 'Argentina',
                                                    12 => 'Armenia',
                                                    13 => 'Aruba',
                                                    14 => 'Australia',
                                                    15 => 'Austria',
                                                    16 => 'Azerbaijan',
                                                    17 => 'Bahamas',
                                                    18 => 'Bahrain',
                                                    19 => 'Bangladesh',
                                                    20 => 'Barbados',
                                                    21 => 'Belarus',
                                                    22 => 'Belgium',
                                                    23 => 'Belize',
                                                    24 => 'Benin',
                                                    25 => 'Bermuda',
                                                    26 => 'Bhutan',
                                                    27 => 'Bolivia',
                                                    28 => 'Bonaire, Sint Eustatius and Saba',
                                                    29 => 'Bosnia and Herzegovina',
                                                    30 => 'Botswana',
                                                    31 => 'Bouvet Island',
                                                    32 => 'Brazil',
                                                    33 => 'British Indian Ocean Territory',
                                                    34 => 'Brunei',
                                                    35 => 'Bulgaria',
                                                    36 => 'Burkina Faso',
                                                    37 => 'Burundi',
                                                    38 => 'Cambodia',
                                                    39 => 'Cameroon',
                                                    40 => 'Canada',
                                                    41 => 'Cape Verde',
                                                    42 => 'Cayman Islands',
                                                    43 => 'Central African Republic',
                                                    44 => 'Chad',
                                                    45 => 'Chile',
                                                    46 => 'China',
                                                    47 => 'Christmas Island',
                                                    48 => 'Cocos (Keeling) Islands',
                                                    49 => 'Colombia',
                                                    50 => 'Comoros',
                                                    51 => 'Congo',
                                                    52 => 'Cook Islands',
                                                    53 => 'Costa Rica',
                                                    54 => 'Ivory Coast',
                                                    55 => 'Croatia',
                                                    56 => 'Cuba',
                                                    57 => 'Curacao',
                                                    58 => 'Cyprus',
                                                    59 => 'Czech Republic',
                                                    60 => 'Democratic Republic of the Congo',
                                                    61 => 'Denmark',
                                                    62 => 'Djibouti',
                                                    63 => 'Dominica',
                                                    64 => 'Dominican Republic',
                                                    65 => 'Ecuador',
                                                    66 => 'Egypt',
                                                    67 => 'El Salvador',
                                                    68 => 'Equatorial Guinea',
                                                    69 => 'Eritrea',
                                                    70 => 'Estonia',
                                                    71 => 'Ethiopia',
                                                    72 => 'Falkland Islands (Malvinas)',
                                                    73 => 'Faroe Islands',
                                                    74 => 'Fiji',
                                                    75 => 'Finland',
                                                    76 => 'France',
                                                    77 => 'French Guiana',
                                                    78 => 'French Polynesia',
                                                    79 => 'French Southern Territories',
                                                    80 => 'Gabon',
                                                    81 => 'Gambia',
                                                    82 => 'Georgia',
                                                    83 => 'Germany',
                                                    84 => 'Ghana',
                                                    85 => 'Gibraltar',
                                                    86 => 'Greece',
                                                    87 => 'Greenland',
                                                    88 => 'Grenada',
                                                    89 => 'Guadaloupe',
                                                    90 => 'Guam',
                                                    91 => 'Guatemala',
                                                    92 => 'Guernsey',
                                                    93 => 'Guinea',
                                                    94 => 'Guinea-Bissau',
                                                    95 => 'Guyana',
                                                    96 => 'Haiti',
                                                    97 => 'Heard Island and McDonald Islands',
                                                    98 => 'Honduras',
                                                    99 => 'Hong Kong',
                                                    100 => 'Hungary',
                                                    101 => 'Iceland',
                                                    102 => 'India',
                                                    103 => 'Indonesia',
                                                    104 => 'Iran',
                                                    105 => 'Iraq',
                                                    106 => 'Ireland',
                                                    107 => 'Isle of Man',
                                                    108 => 'Israel',
                                                    109 => 'Italy',
                                                    110 => 'Jamaica',
                                                    111 => 'Japan',
                                                    112 => 'Jersey',
                                                    113 => 'Jordan',
                                                    114 => 'Kazakhstan',
                                                    115 => 'Kenya',
                                                    116 => 'Kiribati',
                                                    117 => 'Kosovo',
                                                    118 => 'Kuwait',
                                                    119 => 'Kyrgyzstan',
                                                    120 => 'Laos',
                                                    121 => 'Latvia',
                                                    122 => 'Lebanon',
                                                    123 => 'Lesotho',
                                                    124 => 'Liberia',
                                                    125 => 'Libya',
                                                    126 => 'Liechtenstein',
                                                    127 => 'Lithuania',
                                                    128 => 'Luxembourg',
                                                    129 => 'Macao',
                                                    130 => 'Macedonia',
                                                    131 => 'Madagascar',
                                                    132 => 'Malawi',
                                                    133 => 'Malaysia',
                                                    134 => 'Maldives',
                                                    135 => 'Mali',
                                                    136 => 'Malta',
                                                    137 => 'Marshall Islands',
                                                    138 => 'Martinique',
                                                    139 => 'Mauritania',
                                                    140 => 'Mauritius',
                                                    141 => 'Mayotte',
                                                    142 => 'Mexico',
                                                    143 => 'Micronesia',
                                                    144 => 'Moldava',
                                                    145 => 'Monaco',
                                                    146 => 'Mongolia',
                                                    147 => 'Montenegro',
                                                    148 => 'Montserrat',
                                                    149 => 'Morocco',
                                                    150 => 'Mozambique',
                                                    151 => 'Myanmar (Burma)',
                                                    152 => 'Namibia',
                                                    153 => 'Nauru',
                                                    154 => 'Nepal',
                                                    155 => 'Netherlands',
                                                    156 => 'New Caledonia',
                                                    157 => 'New Zealand',
                                                    158 => 'Nicaragua',
                                                    159 => 'Niger',
                                                    160 => 'Nigeria',
                                                    161 => 'Niue',
                                                    162 => 'Norfolk Island',
                                                    163 => 'North Korea',
                                                    164 => 'Northern Mariana Islands',
                                                    165 => 'Norway',
                                                    166 => 'Oman',
                                                    167 => 'Pakistan',
                                                    168 => 'Palau',
                                                    169 => 'Palestine',
                                                    170 => 'Panama',
                                                    171 => 'Papua New Guinea',
                                                    172 => 'Paraguay',
                                                    173 => 'Peru',
                                                    174 => 'Phillipines',
                                                    175 => 'Pitcairn',
                                                    176 => 'Poland',
                                                    177 => 'Portugal',
                                                    178 => 'Puerto Rico',
                                                    179 => 'Qatar',
                                                    180 => 'Reunion',
                                                    181 => 'Romania',
                                                    182 => 'Russia',
                                                    183 => 'Rwanda',
                                                    184 => 'Saint Barthelemy',
                                                    185 => 'Saint Helena',
                                                    186 => 'Saint Kitts and Nevis',
                                                    187 => 'Saint Lucia',
                                                    188 => 'Saint Martin',
                                                    189 => 'Saint Pierre and Miquelon',
                                                    190 => 'Saint Vincent and the Grenadines',
                                                    191 => 'Samoa',
                                                    192 => 'San Marino',
                                                    193 => 'Sao Tome and Principe',
                                                    194 => 'Saudi Arabia',
                                                    195 => 'Senegal',
                                                    196 => 'Serbia',
                                                    197 => 'Seychelles',
                                                    198 => 'Sierra Leone',
                                                    199 => 'Singapore',
                                                    200 => 'Sint Maarten',
                                                    201 => 'Slovakia',
                                                    202 => 'Slovenia',
                                                    203 => 'Solomon Islands',
                                                    204 => 'Somalia',
                                                    205 => 'South Africa',
                                                    206 => 'South Georgia and the South Sandwich Islands',
                                                    207 => 'South Korea',
                                                    208 => 'South Sudan',
                                                    209 => 'Spain',
                                                    210 => 'Sri Lanka',
                                                    211 => 'Sudan',
                                                    212 => 'Suriname',
                                                    213 => 'Svalbard and Jan Mayen',
                                                    214 => 'Swaziland',
                                                    215 => 'Sweden',
                                                    216 => 'Switzerland',
                                                    217 => 'Syria',
                                                    218 => 'Taiwan',
                                                    219 => 'Tajikistan',
                                                    220 => 'Tanzania',
                                                    221 => 'Thailand',
                                                    222 => 'Timor-Leste (East Timor)',
                                                    223 => 'Togo',
                                                    224 => 'Tokelau',
                                                    225 => 'Tonga',
                                                    226 => 'Trinidad and Tobago',
                                                    227 => 'Tunisia',
                                                    228 => 'Turkey',
                                                    229 => 'Turkmenistan',
                                                    230 => 'Turks and Caicos Islands',
                                                    231 => 'Tuvalu',
                                                    232 => 'Uganda',
                                                    233 => 'Ukraine',
                                                    234 => 'United Arab Emirates',
                                                    235 => 'United Kingdom',
                                                    236 => 'United States',
                                                    237 => 'Uruguay',
                                                    238 => 'Uzbekistan',
                                                    239 => 'Vanuatu',
                                                    240 => 'Vatican City',
                                                    241 => 'Venezuela',
                                                    242 => 'Vietnam',
                                                    243 => 'British Virgin Islands',
                                                    244 => 'US Virgin Islands',
                                                    245 => 'Western Sahara',
                                                    246 => 'Yemen',
                                                    247 => 'Zambia',
                                                    248 => 'Zimbabwe',
                                                ];
                                            @endphp
                                            <select class="form-select form-control form-control-lg" name="country">
                                                <option value="">Select one country</option>
                                                @foreach ($countries as $id => $name)
                                                    <option @if (Auth::user()->country == $id) Selected @endif
                                                        value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Address</label>
                                            <input type="text" class="form-control"
                                                value="{{ Auth::user()->address }}" name="address"
                                                placeholder="Address" />
                                        </div>
                                    </div>

                                    @if (Auth::user()->type == 7)
                                        <div class="col-md-12">
                                            <h4 class="card-title"><b>Social</b></h4>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Facebook</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->facebook_url }}" name="facebook_url"
                                                    placeholder="https://www.facebook.com/your_profile_link" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Twitter/X</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->twitter_url }}" name="twitter_url"
                                                    placeholder="https://twitter.com/your_profile_link" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Google Plus</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->google_plus_url }}"
                                                    name="google_plus_url"
                                                    placeholder="https://www.google.com/your_profile_link" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Instagram</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->instagram_url }}" name="instagram_url"
                                                    placeholder="https://www.instagram.com/your_profile_link" />
                                            </div>
                                        </div>
                                    @elseif (Auth::user()->type == 5)
                                        <div class="col-md-12">
                                            <h4 class="card-title"><b>Bank Info</b></h4>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label class="col-form-label">Bank Name</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->bank_name }}" name="bank_name"
                                                    placeholder="Bank Name" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label class="col-form-label">Bank Code/IFSC</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->bank_code_ifsc }}" name="bank_code_ifsc"
                                                    placeholder="Bank Code/IFSC" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label class="col-form-label">Account Number</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->bank_account_number }}"
                                                    name="bank_account_number" placeholder="Account Number" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label class="col-form-label">Account Holder Name</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->bank_ac_holder_name }}"
                                                    name="bank_ac_holder_name" placeholder="Account Holder Name" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label class="col-form-label">PayPal ID</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->paypal_id_num }}" name="paypal_id_num"
                                                    placeholder="PayPal ID" />
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">About</label>
                                            <textarea type="text" class="form-control {{-- summernote --}}" name="description" placeholder="Details"
                                                rows="5">{!! Auth::user()->description !!}</textarea>
                                        </div>
                                    </div>

                                    @if (Auth::user()->type == 2 || Auth::user()->type == 1)
                                        <div class="col-md-12">
                                            <h4 class="card-title">Certificates</h4>

                                            <div class="mg-t-10 mg-sm-t-0 add-data-content">
                                                @if (Auth::user()->certificate->count() == 0)
                                                    <div class="d-flex align-items-center mt-2 row">
                                                        <div class="col-md-7">
                                                            <div class="form-group">
                                                                <label class="col-form-label"><b>Certificate
                                                                        Name:</b></label>
                                                                <input type="text" name="certificates_name[]"
                                                                    value="{{ old('$certificates_name') }}"
                                                                    class="form-control"
                                                                    placeholder="Certificate Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="col-form-label"><b>Certificate
                                                                        File:</b></label>
                                                                <input type="file" name="certificates_file[]"
                                                                    accept="image/jpeg,image/gif,image/png,application/pdf"
                                                                    value="{{ old('$certificates_file') }}"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <a id="plus-btn-data-content" href="javascript:void(0)"
                                                                class="plus-btn-data-content px-1 p-0 m-0 ml-2"><i
                                                                    class="fas fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                @else
                                                    @foreach (Auth::user()->certificate as $k => $item)
                                                        <div class="d-flex align-items-center mt-2 row">
                                                            <div class="col-md-7">
                                                                <div class="form-group">
                                                                    <label class="col-form-label"><b>Certificate
                                                                            Name:</b></label>
                                                                    <input type="text"
                                                                        name="old_certificates_name[{{ $item->id }}]"
                                                                        value="{{ $item->certificates_name }}"
                                                                        class="form-control"
                                                                        placeholder="Certificate Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="col-form-label"><b>Certificate
                                                                            File:</b></label>
                                                                    <input type="file"
                                                                        accept="image/jpeg,image/gif,image/png,application/pdf"
                                                                        name="old_certificates_file[{{ $item->id }}]"
                                                                        value="{{ $item->certificates_file }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 mt-lg-3 row">
                                                                <div class="col-6 d-flex justify-content-center align-items-center">
                                                                    {{-- <label class="col-form-label"><b>View:</b></label> --}}
                                                                    <div class="form-group mb-0">
                                                                        <a class="btn btn-primary" data-toggle="modal"
                                                                            data-target="#certificateModal{{ $k }}">
                                                                            &nbsp;<i class="fa fa-eye"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 d-flex justify-content-center align-items-center">
                                                                    @if ($k == Auth::user()->certificate->count() - 1)
                                                                        <div class="form-group mb-0">
                                                                            <a id="plus-btn-data-content"
                                                                                href="javascript:void(0)"
                                                                                class="plus-btn-data-content px-1 p-0 m-0 ml-2"><i
                                                                                    class="fas fa-plus"></i></a>
                                                                        </div>
                                                                    @else
                                                                        <div class="form-group mb-0">
                                                                            <a audio_file_id="{{ $item->id }}"
                                                                                href="javascript:void(0)"
                                                                                class="minus-btn-data-old-audio px-1 p-0 m-0 ml-2"><i
                                                                                    class="fas fa-minus-circle"></i></a>
                                                                        </div>
                                                                    @endif
                                                                </div>
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
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-5">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Change Password</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.password_change', Auth::user()->id) }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="current_password">Current Password</label>
                                            <div class="input-group">
                                                <input type="password" id="current_password" name="current_password"
                                                    class="form-control" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        onclick="togglePassword('current_password')">
                                                        <i class="fa fa-eye" id="current_password_eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="new_password">New Password</label>
                                            <div class="input-group">
                                                <input type="password" id="new_password" name="new_password"
                                                    class="form-control @error('new_password') is-invalid @enderror"
                                                    required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        onclick="togglePassword('new_password')">
                                                        <i class="fa fa-eye" id="new_password_eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @error('new_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="new_password_confirmation">Confirm
                                                Password</label>
                                            <div class="input-group">
                                                <input type="password" id="new_password_confirmation"
                                                    name="new_password_confirmation" class="form-control" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        onclick="togglePassword('new_password_confirmation')">
                                                        <i class="fa fa-eye" id="new_password_confirmation_eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @include('User-Backend.components.footer')
            </div>
        </div>
    </div>

    @include('User-Backend.components.script')
    <script src="{{ asset('backend/assets/js/dropify.js') }}"></script>
    <script src="{{ asset('backend/lib/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $('.summernote').summernote({
            placeholder: 'Write something...',
            tabsize: 4,
            height: 150
        });
    </script>

    <script>
        //Audio Contents start
        $(document).ready(function() {
            $(document).on('click', '#plus-btn-data-content', function() {
                var myvar = '<div class="d-flex align-items-center mt-2 row">' +
                    '<div class="col-md-7">' +
                    '<div class="form-group">' +
                    '<label class="col-form-label"><b>Certificate Name:</b></label>' +
                    '<input type="text" name="certificates_name[]" class="form-control" placeholder="Certificate Name">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-4">' +
                    '<div class="form-group">' +
                    '<label class="col-form-label"><b>Certificate File:</b></label>' +
                    '<input type="file" name="certificates_file[]" accept="image/jpeg,image/gif,image/png,application/pdf" class="form-control">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-1">' +
                    '<a href="javascript:void(0)" class="minus-btn-data-content px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>' +
                    '</div>' +
                    '</div>';

                $('.add-data-content').prepend(myvar);
            });

            $(document).on('click', '.minus-btn-data-content', function() {
                $(this).parent().parent().remove();
            });
        });

        $(document).on('click', '.minus-btn-data-old-audio', function() {
            $(this).parent().parent().parent().append(
                '<input type="hidden" name="delete_certificates_file[]" value="' + $(this).attr(
                    'audio_file_id') + '">');
            $(this).parent().parent().remove();
        });
        //Audio Contents end
    </script>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const eyeIcon = document.getElementById(inputId + '_eye');

            if (input.type === "password") {
                input.type = "text";
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

        $('#thumbnail_upload').on('change', function(e) {
            var fileInput = $(this)[0];

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#thumbnail_preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        });
    </script>
</body>

</html>
