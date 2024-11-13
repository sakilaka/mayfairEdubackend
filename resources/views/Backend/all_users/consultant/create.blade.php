<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/summernote/dist/summernote-bs4.css') }}">
    <title>{{ env('APP_NAME') }} | Add Partner</title>
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
                            Add Partner
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.consultant.index') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All Partner</a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-md-12 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample" action="{{ route('admin.consultant.store') }}"
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
                                                                    accept="image/*" id="avatar_upload" required>
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
                                                            <img src="{{ asset('frontend/images/No-image.jpg') }}"
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
                                                            placeholder="Enter Name" required>
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
                                                            placeholder="Enter Name" required>
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
                                                            placeholder="Enter Email" required>
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
                                                            placeholder="Enter NID" required>
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
                                                        <option value="0">Male</option>
                                                        <option value="1">Female</option>
                                                        <option value="2">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Date of Birth:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="date" name="dob" class="form-control"
                                                            required>
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
                                                            <option value="{{ $continent->id }}">{{ $continent->name }}
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
                                                        <option value="">Select Country</option>
                                                        <option value="1"> Afghanistan </option>
                                                        <option value="2">Aland Islands </option>
                                                        <option value="3">
                                                            Albania</option>
                                                        <option value="4">
                                                            Algeria</option>
                                                        <option value="5">
                                                            American Samoa</option>
                                                        <option value="6">
                                                            Andorra</option>
                                                        <option value="7">
                                                            Angola</option>
                                                        <option value="8">
                                                            Anguilla</option>
                                                        <option value="9">
                                                            Antarctica</option>
                                                        <option value="10">
                                                            Antigua and Barbuda</option>
                                                        <option value="11">
                                                            Argentina</option>
                                                        <option value="12">
                                                            Armenia</option>
                                                        <option value="13">
                                                            Aruba</option>
                                                        <option value="14">
                                                            Australia</option>
                                                        <option value="15">
                                                            Austria</option>
                                                        <option value="16">
                                                            Azerbaijan</option>
                                                        <option value="17">
                                                            Bahamas</option>
                                                        <option value="18">
                                                            Bahrain</option>
                                                        <option value="19">
                                                            Bangladesh</option>
                                                        <option value="20">
                                                            Barbados</option>
                                                        <option value="21">
                                                            Belarus</option>
                                                        <option value="22">
                                                            Belgium</option>
                                                        <option value="23">
                                                            Belize</option>
                                                        <option value="24">
                                                            Benin</option>
                                                        <option value="25">
                                                            Bermuda</option>
                                                        <option value="26">
                                                            Bhutan </option>
                                                        <option value="27">
                                                            Bolivia</option>
                                                        <option value="28">
                                                            Bonaire, Sint Eustatius and Saba </option>
                                                        <option value="29">
                                                            Bosnia and Herzegovina</option>
                                                        <option value="30">
                                                            Botswana</option>
                                                        <option value="31">
                                                            Bouvet Island</option>
                                                        <option value="32">
                                                            Brazil</option>
                                                        <option value="33">
                                                            British Indian Ocean Territory</option>
                                                        <option value="34">
                                                            Brunei</option>
                                                        <option value="35">
                                                            Bulgaria</option>
                                                        <option value="36">
                                                            Burkina Faso</option>
                                                        <option value="37">
                                                            Burundi</option>
                                                        <option value="38">
                                                            Cambodia</option>
                                                        <option value="39">
                                                            Cameroon</option>
                                                        <option value="40">
                                                            Canada </option>
                                                        <option value="41">
                                                            Cape Verde </option>
                                                        <option value="42">
                                                            Cayman Islands </option>
                                                        <option value="43">
                                                            Central African Republic </option>
                                                        <option value="44">
                                                            Chad </option>
                                                        <option value="45">
                                                            Chile </option>
                                                        <option value="46">
                                                            China </option>
                                                        <option value="47">
                                                            Christmas Island </option>
                                                        <option value="48">
                                                            Cocos (Keeling) Islands </option>
                                                        <option value="49">
                                                            Colombia </option>
                                                        <option value="50">
                                                            Comoros </option>
                                                        <option value="51">
                                                            Congo </option>
                                                        <option value="52">
                                                            Cook Islands </option>
                                                        <option value="53">
                                                            Costa Rica </option>
                                                        <option value="55">
                                                            Croatia </option>
                                                        <option value="56">
                                                            Cuba </option>
                                                        <option value="57">
                                                            Curacao </option>
                                                        <option value="58">
                                                            Cyprus </option>
                                                        <option value="59">
                                                            Czech Republic </option>
                                                        <option value="60">
                                                            Democratic Republic of the Congo </option>
                                                        <option value="61">
                                                            Denmark </option>
                                                        <option value="62">
                                                            Djibouti </option>
                                                        <option value="63">
                                                            Dominica </option>
                                                        <option value="64">
                                                            Dominican Republic </option>
                                                        <option value="65">
                                                            Ecuador </option>
                                                        <option value="66">
                                                            Egypt </option>
                                                        <option value="67">
                                                            El Salvador </option>
                                                        <option value="68">
                                                            Equatorial Guinea </option>
                                                        <option value="69">
                                                            Eritrea </option>
                                                        <option value="70">
                                                            Estonia </option>
                                                        <option value="71">
                                                            Ethiopia </option>
                                                        <option value="72">
                                                            Falkland Islands (Malvinas) </option>
                                                        <option value="73">
                                                            Faroe Islands </option>
                                                        <option value="74">
                                                            Fiji </option>
                                                        <option value="75">
                                                            Finland </option>
                                                        <option value="76">
                                                            France </option>
                                                        <option value="77">
                                                            French Guiana </option>
                                                        <option value="78">
                                                            French Polynesia </option>
                                                        <option value="79">
                                                            French Southern Territories </option>
                                                        <option value="80">
                                                            Gabon </option>
                                                        <option value="81">
                                                            Gambia </option>
                                                        <option value="82">
                                                            Georgia </option>
                                                        <option value="83">
                                                            Germany </option>
                                                        <option value="84">
                                                            Ghana </option>
                                                        <option value="85">
                                                            Gibraltar </option>
                                                        <option value="86">
                                                            Greece </option>
                                                        <option value="87">
                                                            Greenland </option>
                                                        <option value="88">
                                                            Grenada </option>
                                                        <option value="89">
                                                            Guadaloupe </option>
                                                        <option value="90">
                                                            Guam </option>
                                                        <option value="91">
                                                            Guatemala </option>
                                                        <option value="92">
                                                            Guernsey </option>
                                                        <option value="93">
                                                            Guinea </option>
                                                        <option value="94">
                                                            Guinea-Bissau </option>
                                                        <option value="95">
                                                            Guyana </option>
                                                        <option value="96">
                                                            Haiti </option>
                                                        <option value="97">
                                                            Heard Island and McDonald Islands </option>
                                                        <option value="98">
                                                            Honduras </option>
                                                        <option value="99">
                                                            Hong Kong </option>
                                                        <option value="100">
                                                            Hungary </option>
                                                        <option value="101">
                                                            Iceland </option>
                                                        <option value="102">
                                                            India </option>
                                                        <option value="103">
                                                            Indonesia </option>
                                                        <option value="104">
                                                            Iran </option>
                                                        <option value="105">
                                                            Iraq </option>
                                                        <option value="106">
                                                            Ireland </option>
                                                        <option value="107">
                                                            Isle of Man </option>
                                                        <option value="108">
                                                            Israel </option>
                                                        <option value="109">
                                                            Italy </option>
                                                        <option value="54">
                                                            Ivory Coast </option>
                                                        <option value="110">
                                                            Jamaica </option>
                                                        <option value="111">
                                                            Japan </option>
                                                        <option value="112">
                                                            Jersey </option>
                                                        <option value="113">
                                                            Jordan </option>
                                                        <option value="114">
                                                            Kazakhstan </option>
                                                        <option value="115">
                                                            Kenya </option>
                                                        <option value="116">
                                                            Kiribati </option>
                                                        <option value="117">
                                                            Kosovo </option>
                                                        <option value="118">
                                                            Kuwait </option>
                                                        <option value="119">
                                                            Kyrgyzstan </option>
                                                        <option value="120">
                                                            Laos </option>
                                                        <option value="121">
                                                            Latvia </option>
                                                        <option value="122">
                                                            Lebanon </option>
                                                        <option value="123">
                                                            Lesotho </option>
                                                        <option value="124">
                                                            Liberia </option>
                                                        <option value="125">
                                                            Libya </option>
                                                        <option value="126">
                                                            Liechtenstein </option>
                                                        <option value="127">
                                                            Lithuania </option>
                                                        <option value="128">
                                                            Luxembourg </option>
                                                        <option value="129">
                                                            Macao </option>
                                                        <option value="130">
                                                            Macedonia </option>
                                                        <option value="131">
                                                            Madagascar </option>
                                                        <option value="132">
                                                            Malawi </option>
                                                        <option value="133">
                                                            Malaysia </option>
                                                        <option value="134">
                                                            Maldives </option>
                                                        <option value="135">
                                                            Mali </option>
                                                        <option value="136">
                                                            Malta </option>
                                                        <option value="137">
                                                            Marshall Islands </option>
                                                        <option value="138">
                                                            Martinique </option>
                                                        <option value="139">
                                                            Mauritania </option>
                                                        <option value="140">
                                                            Mauritius </option>
                                                        <option value="141">
                                                            Mayotte </option>
                                                        <option value="142">
                                                            Mexico </option>
                                                        <option value="143">
                                                            Micronesia </option>
                                                        <option value="144">
                                                            Moldava </option>
                                                        <option value="145">
                                                            Monaco </option>
                                                        <option value="146">
                                                            Mongolia </option>
                                                        <option value="147">
                                                            Montenegro </option>
                                                        <option value="148">
                                                            Montserrat </option>
                                                        <option value="149">
                                                            Morocco </option>
                                                        <option value="150">
                                                            Mozambique </option>
                                                        <option value="151">
                                                            Myanmar (Burma) </option>
                                                        <option value="152">
                                                            Namibia </option>
                                                        <option value="153">
                                                            Nauru </option>
                                                        <option value="154">
                                                            Nepal </option>
                                                        <option value="155">
                                                            Netherlands </option>
                                                        <option value="156">
                                                            New Caledonia </option>
                                                        <option value="157">
                                                            New Zealand </option>
                                                        <option value="158">
                                                            Nicaragua </option>
                                                        <option value="159">
                                                            Niger </option>
                                                        <option value="160">
                                                            Nigeria </option>
                                                        <option value="161">
                                                            Niue </option>
                                                        <option value="162">
                                                            Norfolk Island </option>
                                                        <option value="163">
                                                            North Korea </option>
                                                        <option value="164">
                                                            Northern Mariana Islands </option>
                                                        <option value="165">
                                                            Norway </option>
                                                        <option value="166">
                                                            Oman </option>
                                                        <option value="167">
                                                            Pakistan </option>
                                                        <option value="168">
                                                            Palau </option>
                                                        <option value="169">
                                                            Palestine </option>
                                                        <option value="170">
                                                            Panama </option>
                                                        <option value="171">
                                                            Papua New Guinea </option>
                                                        <option value="172">
                                                            Paraguay </option>
                                                        <option value="173">
                                                            Peru </option>
                                                        <option value="174">
                                                            Phillipines </option>
                                                        <option value="175">
                                                            Pitcairn </option>
                                                        <option value="176">
                                                            Poland </option>
                                                        <option value="177">
                                                            Portugal </option>
                                                        <option value="178">
                                                            Puerto Rico </option>
                                                        <option value="179">
                                                            Qatar </option>
                                                        <option value="180">
                                                            Reunion </option>
                                                        <option value="181">
                                                            Romania </option>
                                                        <option value="182">
                                                            Russia </option>
                                                        <option value="183">
                                                            Rwanda </option>
                                                        <option value="184">
                                                            Saint Barthelemy </option>
                                                        <option value="185">
                                                            Saint Helena </option>
                                                        <option value="186">
                                                            Saint Kitts and Nevis </option>
                                                        <option value="187">
                                                            Saint Lucia </option>
                                                        <option value="188">
                                                            Saint Martin </option>
                                                        <option value="189">
                                                            Saint Pierre and Miquelon </option>
                                                        <option value="190">
                                                            Saint Vincent and the Grenadines </option>
                                                        <option value="191">
                                                            Samoa </option>
                                                        <option value="192">
                                                            San Marino </option>
                                                        <option value="193">
                                                            Sao Tome and Principe </option>
                                                        <option value="194">
                                                            Saudi Arabia </option>
                                                        <option value="195">
                                                            Senegal </option>
                                                        <option value="196">
                                                            Serbia </option>
                                                        <option value="197">
                                                            Seychelles </option>
                                                        <option value="198">
                                                            Sierra Leone </option>
                                                        <option value="199">
                                                            Singapore </option>
                                                        <option value="200">
                                                            Sint Maarten </option>
                                                        <option value="201">
                                                            Slovakia </option>
                                                        <option value="202">
                                                            Slovenia </option>
                                                        <option value="203">
                                                            Solomon Islands </option>
                                                        <option value="204">
                                                            Somalia </option>
                                                        <option value="205">
                                                            South Africa </option>
                                                        <option value="206">
                                                            South Georgia and the South Sandwich Islands</option>
                                                        <option value="207">
                                                            South Korea </option>
                                                        <option value="208">
                                                            South Sudan </option>
                                                        <option value="209">
                                                            Spain </option>
                                                        <option value="210">
                                                            Sri Lanka </option>
                                                        <option value="211">
                                                            Sudan </option>
                                                        <option value="212">
                                                            Suriname </option>
                                                        <option value="213">
                                                            Svalbard and Jan Mayen </option>
                                                        <option value="214">
                                                            Swaziland </option>
                                                        <option value="215">
                                                            Sweden </option>
                                                        <option value="216">
                                                            Switzerland </option>
                                                        <option value="217">
                                                            Syria </option>
                                                        <option value="218">
                                                            Taiwan </option>
                                                        <option value="219">
                                                            Tajikistan </option>
                                                        <option value="220">
                                                            Tanzania </option>
                                                        <option value="221">
                                                            Thailand </option>
                                                        <option value="222">
                                                            Timor-Leste (East Timor)</option>
                                                        <option value="223">
                                                            Togo</option>
                                                        <option value="224">
                                                            Tokelau</option>
                                                        <option value="225">
                                                            Tonga</option>
                                                        <option value="226">
                                                            Trinidad and Tobago</option>
                                                        <option value="227">
                                                            Tunisia</option>
                                                        <option value="228">
                                                            Turkey</option>
                                                        <option value="229">
                                                            Turkmenistan</option>
                                                        <option value="230">
                                                            Turks and Caicos Islands</option>
                                                        <option value="231">
                                                            Tuvalu</option>
                                                        <option value="232">
                                                            Uganda</option>
                                                        <option value="233">
                                                            Ukraine</option>
                                                        <option value="234">
                                                            United Arab Emirates</option>
                                                        <option value="235">
                                                            United Kingdom</option>
                                                        <option value="236">
                                                            United States</option>
                                                        <option value="237">
                                                            United States Minor Outlying Islands</option>
                                                        <option value="238">
                                                            Uruguay</option>
                                                        <option value="239">
                                                            Uzbekistan</option>
                                                        <option value="240">
                                                            Vanuatu</option>
                                                        <option value="241">
                                                            Vatican City</option>
                                                        <option value="242">
                                                            Venezuela</option>
                                                        <option value="243">
                                                            Vietnam</option>
                                                        <option value="244">
                                                            Virgin Islands, British</option>
                                                        <option value="245">
                                                            Virgin Islands, US</option>
                                                        <option value="246">
                                                            Wallis and Futuna</option>
                                                        <option value="247">
                                                            Western Sahara</option>
                                                        <option value="248">
                                                            Yemen</option>
                                                        <option value="249">
                                                            Zambia</option>
                                                        <option value="250">
                                                            Zimbabwe</option>
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
                                                        placeholder="Enter Address">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea type="text" name="description" class="form-control" placeholder="Enter description"></textarea>
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
                                                    <input type="text" name="facebook_url" class="form-control"
                                                        placeholder="Enter Facebook URL">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>
                                                        <i class="fab fa-twitter" aria-hidden="true"></i>
                                                        Twitter
                                                    </label>
                                                    <input type="text" name="twitter_url" class="form-control"
                                                        placeholder="Enter Twitter URL">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>
                                                        <i class="fab fa-google" aria-hidden="true"></i>
                                                        Google Plus
                                                    </label>
                                                    <input type="text" name="google_plus_url" class="form-control"
                                                        placeholder="Enter Google Plus URL">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>
                                                        <i class="fab fa-instagram" aria-hidden="true"></i>
                                                        Instagram
                                                    </label>
                                                    <input type="text" name="instagram_url" class="form-control"
                                                        placeholder="Enter Instagram URL">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <span class="text-muted">
                                                        <i>
                                                            Default Account Password: <strong>12345678</strong>
                                                        </i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
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
