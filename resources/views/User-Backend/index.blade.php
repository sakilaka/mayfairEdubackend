<!DOCTYPE html>
<html lang="en">

<head>
    @include('User-Backend.components.head')
    <title>{{ env('APP_NAME') }} | Dashboard</title>

    <style>
        .nav-tabs .nav-item:nth-child(1) {
            margin-left: 0px;
        }

        .nav-tabs .nav-item {
            line-height: 1;
            margin-left: 6px;
            font-size: 0.9rem;
        }

        .nav-tabs .nav-item .nav-link {
            border-radius: 6px !important;
        }

        .partner-social-container ul {
            list-style-type: none;
            display: flex;
            justify-content: start;
            align-items: center;
        }

        .partner-social-container ul li {
            margin-right: 0.85rem;
            background-color: rgb(228, 254, 237);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 45px;
            height: 45px;
            transition: 0.4s;
        }

        .partner-social-container ul li:hover {
            background-color: var(--btn_primary_color);
        }

        .partner-social-container ul li a {
            font-size: 18px !important;
            margin-top: 2.5px;
            text-decoration: none;
            padding: 12px;
            color: var(--btn_primary_color);
            transition: 0.4s;
        }

        .partner-social-container ul li:hover a {
            color: rgb(228, 254, 237);
        }

        @media screen and (max-width:1299px) {
            .partner-social-container-lg {
                display: inline-block;
            }

            .partner-social-container-sm {
                display: none;
            }
        }

        @media screen and (min-width:1300px) {
            .partner-social-container-lg {
                display: none;
            }

            .partner-social-container-sm {
                display: inline-block;
            }
        }

        .form-group label {
            font-size: 1.08rem;
            font-weight: 600;
            color: rgb(99, 99, 99);
        }

        .form-group p {
            font-size: 1rem;
            color: rgb(43, 43, 43);
        }
    </style>
</head>

<body>

    <div class="container-scroller"
        style="
        @if ($user->role == 'partner') @if ($status == 0) filter: blur(5px); pointer-events: none; @endif @endif
        ">
        @include('User-Backend.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('User-Backend.components.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            Dashboard
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-0">Applications</h4>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-inline-block pt-3">
                                            <div class="d-md-flex">
                                                <h2 class="mb-0">{{ $orders->count() }}</h2>
                                            </div>
                                        </div>
                                        <div class="d-inline-block">
                                            <i class="fa fa-file-pdf text-danger icon-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-0">Events</h4>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-inline-block pt-3">
                                            <div class="d-md-flex">
                                                <h2 class="mb-0">{{ $event->count() }}</h2>
                                            </div>
                                        </div>
                                        <div class="d-inline-block">
                                            <i class="fa fa-podcast text-info icon-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        @if ($user->role == 'partner')
                            <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-0">Your Level</h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    @if ($user->star == 0)
                                                        <h2 class="mb-0">Beginner</h2>
                                                    @else
                                                        @for ($i = 0; $i < $user->star; $i++)
                                                            <i class="fa fa-star text-warning icon-md"></i>
                                                        @endfor
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($user->type == 1 && $user->is_verified === 1)
                            <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-0">Email Verify status</h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="pt-3">
                                                <div class="">
                                                    @if ($user->is_verified === 0)
                                                        <h5 class="mb-2 text-danger fw-bold" style="font-size: 1rem;">Your email is not verified!!</h5>
                                                        
                                                        <br>
                                                        <form action="">
                                                            <a href="{{ route('frontend.send_verification_email') }}" class="btn btn-success btn-sm">
                                                                Verify Email
                                                            </a>
                                                        </form>

                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif



                        @if (Auth::user()->type == 1)
                            <div class="col-sm-6 col-md-4 col-lg-5 ml-lg-auto grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-2">My Partner</h4>
                                        @if ($consultant)
                                            <div class="d-flex flex-row">
                                                <img src="{{ @$consultant->image_show }}" class="img-lg rounded"
                                                    alt="profile-{{ @$consultant->name }}">
                                                <div class="ml-3">
                                                    <h6>{{ @$consultant->name }}</h6>
                                                    <p class="text-muted">{{ @$consultant->address }},
                                                        {{ @$consultant->continents->name }}</p>
                                                    <div
                                                        class="mt-0 partner-social-container partner-social-container-sm">
                                                        <ul class="social">
                                                            <li>
                                                                <a href="{{ @$consultant->facebook_url ?? 'javascript:void(0)' }}"
                                                                    target="_blank" class="fab fa-facebook"
                                                                    aria-hidden="true"></a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ @$consultant->twitter_url ?? 'javascript:void(0)' }}"
                                                                    target="_blank" class="fab fa-twitter"
                                                                    aria-hidden="true"></a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ @$consultant->google_plus_url ?? 'javascript:void(0)' }}"
                                                                    target="_blank" class="fab fa-google-plus"
                                                                    aria-hidden="true"></a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ @$consultant->instagram_url ?? 'javascript:void(0)' }}"
                                                                    target="_blank" class="fab fa-instagram"
                                                                    aria-hidden="true"></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 partner-social-container partner-social-container-lg">
                                                <ul class="social">
                                                    <li>
                                                        <a href="{{ @$consultant->facebook_url ?? 'javascript:void(0)' }}"
                                                            target="_blank" class="fab fa-facebook"
                                                            aria-hidden="true"></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ @$consultant->twitter_url ?? 'javascript:void(0)' }}"
                                                            target="_blank" class="fab fa-twitter"
                                                            aria-hidden="true"></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ @$consultant->google_plus_url ?? 'javascript:void(0)' }}"
                                                            target="_blank" class="fab fa-google-plus"
                                                            aria-hidden="true"></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ @$consultant->instagram_url ?? 'javascript:void(0)' }}"
                                                            target="_blank" class="fab fa-instagram"
                                                            aria-hidden="true"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @else
                                            <p style="font-size: 1rem;">You have no partner yet.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0"><b>Personal Informations</b></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-3">
                                    <img src="{{ Auth::user()->image_show }}" alt="{{ Auth::user()->name }}"
                                        width="200" style="border-radius: 8px">
                                    <div class="mt-2">
                                        <p class="pr-3" style="font-size: 1rem !important">
                                            {{ Auth::user()->description }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-9 mt-3 mt-lg-0">
                                    <div class="row">
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <p>{{ Auth::user()->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Email Address</label>
                                                <p>{{ Auth::user()->email }}</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Phone Number</label>
                                                <p>{{ Auth::user()->mobile }}</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Gender</label>
                                                <p>
                                                    @if (Auth::user()->gender == '0')
                                                        Male
                                                    @elseif (Auth::user()->gender == '1')
                                                        Female
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        @if (Auth::user()->type == '1' || Auth::user()->type == '2')
                                            <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label for="name">Date of Birth</label>
                                                    <p>{{ date('d M, Y', strtotime(Auth::user()->dob)) }}</p>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label for="name">NID</label>
                                                    <p>{{ Auth::user()->nid ?? '-' }}</p>
                                                </div>
                                            </div>
                                            @if (Auth::user()->type == 2)
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="name">Designation</label>
                                                        <p>{{ Auth::user()->designation ?? '-' }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="name">Institution</label>
                                                        <p>{{ Auth::user()->institution ?? '-' }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                        {{-- <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Qualification</label>
                                                <p>{{ Auth::user()->qualification ?? '-' }}</p>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Experience</label>
                                                <p>{{ Auth::user()->experience ?? '-' }}</p>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Language</label>
                                                <p>
                                                    @if (auth()->user()->language == '1')
                                                        Bangla
                                                    @elseif (auth()->user()->language == '2')
                                                        English
                                                    @elseif (auth()->user()->language == '3')
                                                        Hindi
                                                    @elseif (auth()->user()->language == '4')
                                                        Arabic
                                                    @endif
                                                </p>
                                            </div>
                                        </div> --}}
                                        {{-- @if (auth()->user()->type == 1 || auth()->user()->type == 7)
                                            <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label for="name">Continent</label>
                                                    <p>{{ auth()->user()->continents?->name }}</p>
                                                </div>
                                            </div>
                                        @endif --}}
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Country</label>
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
                                                <p>
                                                    {{ $countries[Auth::user()->country] }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Address</label>
                                                <p>{{ auth()->user()->address ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if (Auth::user()->certificate->count() > 0)
                                    <div class="col-12 mt-4 mt-lg-2">
                                        <h4 class="card-title mb-3"><b>Certificates</b></h4>

                                        <div class="row">
                                            @foreach (Auth::user()->certificate as $k => $item)
                                                <div class="col-6 col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="address"><b>{{ $loop->iteration }}.
                                                                {{ $item->certificates_name }}</b></label>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <button style="margin-left: 18px" type="button"
                                                                    data-toggle="modal"
                                                                    data-target="#certificateModal{{ $k }}"
                                                                    class="btn btn-primary"><i class="fa fa-eye"></i>
                                                                    View
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Modal -->
                                                <div class="modal fade" id="certificateModal{{ $k }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="audioModalLabel"
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
                                                                @if ($item->extensions == 'pdf')
                                                                    <iframe src="{{ $item->certificates_file_show }}"
                                                                        width="100%" height="500"></iframe>
                                                                @else
                                                                    <img src="{{ $item->certificates_file_show }}"
                                                                        alt="image"
                                                                        style="height: 300px; width:450px">
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @include('User-Backend.components.footer')
            </div>
        </div>
    </div>

    @if ($user->role == 'partner')
        @if ($status == 0)
            <!-- Full-page overlay for inactive users -->
            <div class="inactive-overlay"
                style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); z-index: 1000; display: flex; align-items: center; justify-content: center; color: #fff;">
                <div class="text-center">
                    <h2>Your account is inactive</h2>
                    <p>Please contact the administrator to activate your account.</p>
                </div>
            </div>
        @endif
    @endif

    @include('User-Backend.components.script')
</body>

</html>
