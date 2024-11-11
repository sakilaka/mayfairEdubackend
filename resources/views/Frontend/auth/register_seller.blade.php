@extends('Frontend.layouts.master-layout')
@section('title','- Seller Register')
@section('head')

@endsection
@section('main_content')
<br>
<br>
<br>
<div class="py-5">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="border-md mx-0 rounded-3 row">
                    <div class="border-end-md col-md-6 p-sm-5 px-5">
                     @php
                     $home_content = \App\Models\HomeContentSetup::first();
                     @endphp
                        <h2 class="h3 mb-4 fw-bold text-uppercase align-items-center" style="text-align:center">
                           {{ $home_content->register_title }}                        </h2>
                        <h4 class="mb-0" style="font-size:20px ;text-align:center">
                           {{ $home_content->register_des }}                         </h4>
                        <br>
                        <center class="text-center">
                            <a href="{{ route('frontend.register') }}"><strong> Become an Student</strong></a>                        </center>
                        
                        <center class="text-center">
                            <a href="{{ route('frontend.teacher_register') }}"><strong> Become an Teacher</strong></a>                        </center>
                        <center class="text-center">
                        <a href="{{ route('frontend.affiliate_register') }}">
                        <strong>
                            Become an Affiliate                        </strong></a>
                        </center>
                        <center class="text-center">
                           <a href="{{ route('frontend.consultant_register') }}">
                           <strong>
                               Become a Partner                        </strong></a>
                           </center>
                        <img class="d-block img-fluid mx-auto" style="margin-top:100px; height:380px; width:330px;" src="{{  $home_content->register_image_show }}"
                            width="344" alt="Illustartion">
                    </div>
                    <div class="col-md-6 px-4 pt-2 pb-4 px-sm-5 pb-sm-5 pt-md-5">
                        <!-- <a class="btn btn-outline-dark-cerulean btn-lg w-100 mb-3" href="#"><i class="fab fa-google me-1"></i>Sign in with Google</a>
                        <a class="btn btn-outline-dark-cerulean btn-lg w-100 mb-3" href="#"><i class="fab fa-facebook me-1"></i>Sign in with Facebook</a>
                        <div class="d-flex align-items-center py-2 mb-2">
                            <hr class="w-100">
                            <div class="px-3">Or</div>
                            <hr class="w-100">
                        </div> -->

                        <!--  -->

                        <h4>Seller Sign up</h4>
                        <form action="{{ route('frontend.set_register') }}" class="myform" id="student" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        @csrf

                            {{-- <input type="hidden" name="csrf_test_name" value="23b826ad1bc7f991149ab321ac679e99" />    --}}
                        <div class="mb-3">
                            <label class="form-label mb-1" for="user_name">Full name</label>
                            <input class="form-control form-control-lg" type="text" id="user_name" name="name"
                                placeholder="Enter your full name" autofocus required="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label mb-1" for="user_mobile">Mobile</label>
                            <input class="form-control form-control-lg" type="number" id="user_mobile" name="mobile" placeholder="Enter your Mobile Number" onkeyup="mobilecheck(4)" required="">
                        </div>

                        <div class="mb-3">
                            <label class="form-label mb-1" for="user_email">Email address</label>
                            <input class="form-control form-control-lg" type="email" id="user_email" name="email" onkeyup="mailcheck(4)"
                                placeholder="Enter your email" required="">
                        </div>

                        <div class="mb-3">
                            <label class="form-label mb-1" for="user_mobile">Gender</label>
                            <select  class="form-control form-control-lg" name="gender" required>
                                <option value="">Select Gender</option>
                                <option  value="0">Male</option>
                                <option  value="1">Female</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label mb-1" for="user_mobile">Qualification</label>
                            <input class="form-control form-control-lg" type="text" id="user_mobile" name="qualification" placeholder="Enter your Qualification" onkeyup="mobilecheck(4)">
                        </div>
                        <div class="mb-3">
                            <label class="form-label mb-1" for="user_mobile">Experience</label>
                            <input class="form-control form-control-lg" type="text" id="user_mobile" name="experience" placeholder="Enter your Experience" onkeyup="mobilecheck(4)">
                        </div>
                        <div class="mb-3">
                            <label class="form-label mb-1" for="user_mobile">Language</label>
                            <select class="form-select form-control-lg" name="language">
                                <option value="">select one language</option>
                                <option value="1">Bangla</option>
                                <option value="2">English</option>
                                <option value="3">Hindi</option>
                                <option value="4">Arabic</option>
                            </select>
                            {{-- <input class="form-control form-control-lg" type="text" id="user_mobile" name="language" placeholder="Enter your Language" onkeyup="mobilecheck(4)" required=""> --}}
                        </div>
                        <div class="mb-3">
                            <label class="form-label mb-1" for="user_mobile">Country</label>
                            <select class="form-select form-control-lg" name="country">
                                <option value="">select one country</option>
                                <option value="1"> Afghanistan </option>
                                <option value="2" >Aland Islands </option>
                                 <option value="3" >
                                    Albania</option>
                                 <option value="4" >
                                    Algeria</option>
                                 <option value="5" >
                                    American Samoa</option>
                                 <option value="6" >
                                    Andorra</option>
                                 <option value="7" >
                                    Angola</option>
                                 <option value="8" >
                                    Anguilla</option>
                                 <option value="9" >
                                    Antarctica</option>
                                 <option value="10" >
                                    Antigua and Barbuda</option>
                                 <option value="11" >
                                    Argentina</option>
                                 <option value="12" >
                                    Armenia</option>
                                 <option value="13" >
                                    Aruba</option>
                                 <option value="14" >
                                    Australia</option>
                                 <option value="15" >
                                    Austria</option>
                                 <option value="16" >
                                    Azerbaijan</option>
                                 <option value="17" >
                                    Bahamas</option>
                                 <option value="18" >
                                    Bahrain</option>
                                 <option value="19" >
                                    Bangladesh</option>
                                 <option value="20" >
                                    Barbados</option>
                                 <option value="21" >
                                    Belarus</option>
                                 <option value="22" >
                                    Belgium</option>
                                 <option value="23" >
                                    Belize</option>
                                 <option value="24" >
                                    Benin</option>
                                 <option value="25" >
                                    Bermuda</option>
                                 <option value="26" >
                                    Bhutan </option>
                                 <option value="27" >
                                    Bolivia</option>
                                 <option value="28" >
                                    Bonaire, Sint Eustatius and Saba </option>
                                 <option value="29" >
                                    Bosnia and Herzegovina</option>
                                 <option value="30" >
                                    Botswana</option>
                                 <option value="31" >
                                    Bouvet Island</option>
                                 <option value="32" >
                                    Brazil</option>
                                 <option value="33" >
                                    British Indian Ocean Territory</option>
                                 <option value="34" >
                                    Brunei</option>
                                 <option value="35" >
                                    Bulgaria</option>
                                 <option value="36" >
                                    Burkina Faso</option>
                                 <option value="37" >
                                    Burundi</option>
                                 <option value="38" >
                                    Cambodia</option>
                                 <option value="39" >
                                    Cameroon</option>
                                 <option value="40" >
                                    Canada                                    </option>
                                 <option value="41" >
                                    Cape Verde                                    </option>
                                 <option value="42" >
                                    Cayman Islands                                    </option>
                                 <option value="43" >
                                    Central African Republic                                    </option>
                                 <option value="44" >
                                    Chad                                    </option>
                                 <option value="45" >
                                    Chile                                    </option>
                                 <option value="46" >
                                    China                                    </option>
                                 <option value="47" >
                                    Christmas Island                                    </option>
                                 <option value="48" >
                                    Cocos (Keeling) Islands                                    </option>
                                 <option value="49" >
                                    Colombia                                    </option>
                                 <option value="50" >
                                    Comoros                                    </option>
                                 <option value="51" >
                                    Congo                                    </option>
                                 <option value="52" >
                                    Cook Islands                                    </option>
                                 <option value="53" >
                                    Costa Rica                                    </option>
                                 <option value="55" >
                                    Croatia                                    </option>
                                 <option value="56" >
                                    Cuba                                    </option>
                                 <option value="57" >
                                    Curacao                                    </option>
                                 <option value="58" >
                                    Cyprus                                    </option>
                                 <option value="59" >
                                    Czech Republic                                    </option>
                                 <option value="60" >
                                    Democratic Republic of the Congo                                    </option>
                                 <option value="61" >
                                    Denmark                                    </option>
                                 <option value="62" >
                                    Djibouti                                    </option>
                                 <option value="63" >
                                    Dominica                                    </option>
                                 <option value="64" >
                                    Dominican Republic                                    </option>
                                 <option value="65" >
                                    Ecuador                                    </option>
                                 <option value="66" >
                                    Egypt                                    </option>
                                 <option value="67" >
                                    El Salvador                                    </option>
                                 <option value="68" >
                                    Equatorial Guinea                                    </option>
                                 <option value="69" >
                                    Eritrea                                    </option>
                                 <option value="70" >
                                    Estonia                                    </option>
                                 <option value="71" >
                                    Ethiopia                                    </option>
                                 <option value="72" >
                                    Falkland Islands (Malvinas)                                    </option>
                                 <option value="73" >
                                    Faroe Islands                                    </option>
                                 <option value="74" >
                                    Fiji                                    </option>
                                 <option value="75" >
                                    Finland                                    </option>
                                 <option value="76" >
                                    France                                    </option>
                                 <option value="77" >
                                    French Guiana                                    </option>
                                 <option value="78" >
                                    French Polynesia                                    </option>
                                 <option value="79" >
                                    French Southern Territories                                    </option>
                                 <option value="80" >
                                    Gabon                                    </option>
                                 <option value="81" >
                                    Gambia                                    </option>
                                 <option value="82" >
                                    Georgia                                    </option>
                                 <option value="83" >
                                    Germany                                    </option>
                                 <option value="84" >
                                    Ghana                                    </option>
                                 <option value="85" >
                                    Gibraltar                                    </option>
                                 <option value="86" >
                                    Greece                                    </option>
                                 <option value="87" >
                                    Greenland                                    </option>
                                 <option value="88" >
                                    Grenada                                    </option>
                                 <option value="89" >
                                    Guadaloupe                                    </option>
                                 <option value="90" >
                                    Guam                                    </option>
                                 <option value="91" >
                                    Guatemala                                    </option>
                                 <option value="92" >
                                    Guernsey                                    </option>
                                 <option value="93" >
                                    Guinea                                    </option>
                                 <option value="94" >
                                    Guinea-Bissau                                    </option>
                                 <option value="95" >
                                    Guyana                                    </option>
                                 <option value="96" >
                                    Haiti                                    </option>
                                 <option value="97" >
                                    Heard Island and McDonald Islands                                    </option>
                                 <option value="98" >
                                    Honduras                                    </option>
                                 <option value="99" >
                                    Hong Kong                                    </option>
                                 <option value="100" >
                                    Hungary                                    </option>
                                 <option value="101" >
                                    Iceland                                    </option>
                                 <option value="102" >
                                    India                                    </option>
                                 <option value="103" >
                                    Indonesia                                    </option>
                                 <option value="104" >
                                    Iran                                    </option>
                                 <option value="105" >
                                    Iraq                                    </option>
                                 <option value="106" >
                                    Ireland                                    </option>
                                 <option value="107" >
                                    Isle of Man                                    </option>
                                 <option value="108" >
                                    Israel                                    </option>
                                 <option value="109" >
                                    Italy                                    </option>
                                 <option value="54" >
                                    Ivory Coast                                    </option>
                                 <option value="110" >
                                    Jamaica                                    </option>
                                 <option value="111" >
                                    Japan                                    </option>
                                 <option value="112" >
                                    Jersey                                    </option>
                                 <option value="113" >
                                    Jordan                                    </option>
                                 <option value="114" >
                                    Kazakhstan                                    </option>
                                 <option value="115" >
                                    Kenya                                    </option>
                                 <option value="116" >
                                    Kiribati                                    </option>
                                 <option value="117" >
                                    Kosovo                                    </option>
                                 <option value="118" >
                                    Kuwait                                    </option>
                                 <option value="119" >
                                    Kyrgyzstan                                    </option>
                                 <option value="120" >
                                    Laos                                    </option>
                                 <option value="121" >
                                    Latvia                                    </option>
                                 <option value="122" >
                                    Lebanon                                    </option>
                                 <option value="123" >
                                    Lesotho                                    </option>
                                 <option value="124" >
                                    Liberia                                    </option>
                                 <option value="125" >
                                    Libya                                    </option>
                                 <option value="126" >
                                    Liechtenstein                                    </option>
                                 <option value="127" >
                                    Lithuania                                    </option>
                                 <option value="128" >
                                    Luxembourg                                    </option>
                                 <option value="129" >
                                    Macao                                    </option>
                                 <option value="130" >
                                    Macedonia                                    </option>
                                 <option value="131" >
                                    Madagascar                                    </option>
                                 <option value="132" >
                                    Malawi                                    </option>
                                 <option value="133" >
                                    Malaysia                                    </option>
                                 <option value="134" >
                                    Maldives                                    </option>
                                 <option value="135" >
                                    Mali                                    </option>
                                 <option value="136" >
                                    Malta                                    </option>
                                 <option value="137" >
                                    Marshall Islands                                    </option>
                                 <option value="138" >
                                    Martinique                                    </option>
                                 <option value="139" >
                                    Mauritania                                    </option>
                                 <option value="140" >
                                    Mauritius                                    </option>
                                 <option value="141" >
                                    Mayotte                                    </option>
                                 <option value="142" >
                                    Mexico                                    </option>
                                 <option value="143" >
                                    Micronesia                                    </option>
                                 <option value="144" >
                                    Moldava                                    </option>
                                 <option value="145" >
                                    Monaco                                    </option>
                                 <option value="146" >
                                    Mongolia                                    </option>
                                 <option value="147" >
                                    Montenegro                                    </option>
                                 <option value="148" >
                                    Montserrat                                    </option>
                                 <option value="149" >
                                    Morocco                                    </option>
                                 <option value="150" >
                                    Mozambique                                    </option>
                                 <option value="151" >
                                    Myanmar (Burma)                                    </option>
                                 <option value="152" >
                                    Namibia                                    </option>
                                 <option value="153" >
                                    Nauru                                    </option>
                                 <option value="154" >
                                    Nepal                                    </option>
                                 <option value="155" >
                                    Netherlands                                    </option>
                                 <option value="156" >
                                    New Caledonia                                    </option>
                                 <option value="157" >
                                    New Zealand                                    </option>
                                 <option value="158" >
                                    Nicaragua                                    </option>
                                 <option value="159" >
                                    Niger                                    </option>
                                 <option value="160" >
                                    Nigeria                                    </option>
                                 <option value="161" >
                                    Niue                                    </option>
                                 <option value="162" >
                                    Norfolk Island                                    </option>
                                 <option value="163" >
                                    North Korea                                    </option>
                                 <option value="164" >
                                    Northern Mariana Islands                                    </option>
                                 <option value="165" >
                                    Norway                                    </option>
                                 <option value="166" >
                                    Oman                                    </option>
                                 <option value="167" >
                                    Pakistan                                    </option>
                                 <option value="168" >
                                    Palau                                    </option>
                                 <option value="169" >
                                    Palestine                                    </option>
                                 <option value="170" >
                                    Panama                                    </option>
                                 <option value="171" >
                                    Papua New Guinea                                    </option>
                                 <option value="172" >
                                    Paraguay                                    </option>
                                 <option value="173" >
                                    Peru                                    </option>
                                 <option value="174" >
                                    Phillipines                                    </option>
                                 <option value="175" >
                                    Pitcairn                                    </option>
                                 <option value="176" >
                                    Poland                                    </option>
                                 <option value="177" >
                                    Portugal                                    </option>
                                 <option value="178" >
                                    Puerto Rico                                    </option>
                                 <option value="179" >
                                    Qatar                                    </option>
                                 <option value="180" >
                                    Reunion                                    </option>
                                 <option value="181" >
                                    Romania                                    </option>
                                 <option value="182" >
                                    Russia                                    </option>
                                 <option value="183" >
                                    Rwanda                                    </option>
                                 <option value="184" >
                                    Saint Barthelemy                                    </option>
                                 <option value="185" >
                                    Saint Helena                                    </option>
                                 <option value="186" >
                                    Saint Kitts and Nevis                                    </option>
                                 <option value="187" >
                                    Saint Lucia                                    </option>
                                 <option value="188" >
                                    Saint Martin                                    </option>
                                 <option value="189" >
                                    Saint Pierre and Miquelon                                    </option>
                                 <option value="190" >
                                    Saint Vincent and the Grenadines                                    </option>
                                 <option value="191" >
                                    Samoa                                    </option>
                                 <option value="192" >
                                    San Marino                                    </option>
                                 <option value="193" >
                                    Sao Tome and Principe                                    </option>
                                 <option value="194" >
                                    Saudi Arabia                                    </option>
                                 <option value="195" >
                                    Senegal                                    </option>
                                 <option value="196" >
                                    Serbia                                    </option>
                                 <option value="197" >
                                    Seychelles                                    </option>
                                 <option value="198" >
                                    Sierra Leone                                    </option>
                                 <option value="199" >
                                    Singapore                                    </option>
                                 <option value="200" >
                                    Sint Maarten                                    </option>
                                 <option value="201" >
                                    Slovakia                                    </option>
                                 <option value="202" >
                                    Slovenia                                    </option>
                                 <option value="203" >
                                    Solomon Islands                                    </option>
                                 <option value="204" >
                                    Somalia                                    </option>
                                 <option value="205" >
                                    South Africa                                    </option>
                                 <option value="206" >
                                    South Georgia and the South Sandwich Islands</option>
                                 <option value="207" >
                                    South Korea                                    </option>
                                 <option value="208" >
                                    South Sudan                                    </option>
                                 <option value="209" >
                                    Spain                                    </option>
                                 <option value="210" >
                                    Sri Lanka                                    </option>
                                 <option value="211" >
                                    Sudan                                    </option>
                                 <option value="212" >
                                    Suriname                                    </option>
                                 <option value="213" >
                                    Svalbard and Jan Mayen                                    </option>
                                 <option value="214" >
                                    Swaziland                                    </option>
                                 <option value="215" >
                                    Sweden                                    </option>
                                 <option value="216" >
                                    Switzerland                                    </option>
                                 <option value="217" >
                                    Syria                                    </option>
                                 <option value="218" >
                                    Taiwan                                    </option>
                                 <option value="219" >
                                    Tajikistan                                    </option>
                                 <option value="220" >
                                    Tanzania                                    </option>
                                 <option value="221" >
                                    Thailand                                    </option>
                                 <option value="222" >
                                    Timor-Leste (East Timor)</option>
                                 <option value="223" >
                                    Togo</option>
                                 <option value="224" >
                                    Tokelau</option>
                                 <option value="225" >
                                    Tonga</option>
                                 <option value="226" >
                                    Trinidad and Tobago</option>
                                 <option value="227" >
                                    Tunisia</option>
                                 <option value="228" >
                                    Turkey</option>
                                 <option value="229" >
                                    Turkmenistan</option>
                                 <option value="230" >
                                    Turks and Caicos Islands</option>
                                 <option value="231" >
                                    Tuvalu</option>
                                 <option value="232" >
                                    Uganda</option>
                                 <option value="233" >
                                    Ukraine</option>
                                 <option value="234" >
                                    United Arab Emirates</option>
                                 <option value="235" >
                                    United Kingdom</option>
                                 <option value="236" >
                                    United States</option>
                                 <option value="237" >
                                    United States Minor Outlying Islands</option>
                                 <option value="238" >
                                    Uruguay</option>
                                 <option value="239" >
                                    Uzbekistan</option>
                                 <option value="240" >
                                    Vanuatu</option>
                                 <option value="241" >
                                    Vatican City</option>
                                 <option value="242" >
                                    Venezuela</option>
                                 <option value="243" >
                                    Vietnam</option>
                                 <option value="244" >
                                    Virgin Islands, British</option>
                                 <option value="245" >
                                    Virgin Islands, US</option>
                                 <option value="246" >
                                    Wallis and Futuna</option>
                                 <option value="247" >
                                    Western Sahara</option>
                                 <option value="248" >
                                    Yemen</option>
                                 <option value="249" >
                                    Zambia</option>
                                 <option value="250" >
                                    Zimbabwe</option>
                            </select>
                            {{-- <input class="form-control form-control-lg" type="text" id="user_mobile" name="country" placeholder="Enter your Country" onkeyup="mobilecheck(4)" required=""> --}}
                        </div>

                        <div class="mb-3 position-relative">
                            <label class="form-label mb-1" for="user_password">
                                Password                                <!-- <small class="fs-sm text-muted">(min. 8 char)</small> -->
                            </label>
                            <input class="form-control form-control-lg" type="password" id="user_password" name="password"
                                placeholder="Enter password" required="">
                                <span style="position: absolute;    right: 10px;    top: 36px;    font-size: 20px;">
                                <a href="javascript:void(0)" onclick="viewpassword(1)">
                                    <div class="change-icon-1">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                </a>
                            </span>

                            <div id="pswd_info" style="display: none">
                                {{-- <h6>Password must be following requirements:</h6> --}}
                                {{-- <ul class="ps-0"> --}}
                                    <!-- <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                                    <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                                    <li id="number" class="invalid">At least <strong>one number</strong></li> -->
                                    <p id="length" class="invalid">Be at least <strong>8 characters</strong></p>
                                    {{-- <li id="length" class="invalid">Be at least <strong>8 characters</strong></li> --}}
                                {{-- </ul> --}}
                            </div>
                        </div>


                        <div class="mb-3 position-relative">
                            <label class="form-label mb-1" for="user_cpassword">
                                Confirm Password                            </label>
                            <input class="form-control form-control-lg" type="password" id="user_cpassword" name="user_cpassword"
                                placeholder="Confirm Password" required="">
                                <span style="position: absolute; right: 10px; top: 36px; font-size: 20px;">
                                <a href="javascript:void(0)" onclick="viewpassword(2)">
                                    <div class="change-icon-2">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                </a>
                            </span>
                            <!-- <div id="confirm-pswd_info">
                                <h6>Password must be following requirements:</h6>
                                <ul class="ps-0">
                                     <li id="confirm-letter" class="invalid">At least <strong>one letter</strong></li>
                                    <li id="confirm-capital" class="invalid">At least <strong>one capital letter</strong></li>
                                    <li id="confirm-number" class="invalid">At least <strong>one number</strong></li>
                                    <li id="confirm-length" class="invalid">Be at least <strong>8 characters</strong></li>
                                </ul>
                            </div> -->

                                <div id="confirm-pswd_info" style="display: none">
                                    {{-- <h6>Password must be following requirements:</h6> --}}
                                    {{-- <ul class="ps-0"> --}}
                                        <!-- <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                                        <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                                        <li id="number" class="invalid">At least <strong>one number</strong></li> -->
                                        <p id="length" class="invalid">Be at least <strong>8 characters</strong></p>
                                    {{-- </ul> --}}
                                </div>


                        </div>
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="user_terms" name="user_terms" checked value="1"
                                required="">
                            <label class="form-check-label" for="agree-to-terms">
                                By joining,  I read and agree to the<a target="_blank" href="{{ route('frontend.terms_conditions') }}" class="text-decoration-underline"> Terms & Conditions</a>,
                                <a href="{{ route('frontend.privacy_policy') }}" target="_blank" class="text-decoration-underline">Privacy policy</a>,
                                <a target="_blank" href="{{ route('frontend.refund_policy') }}" class="text-decoration-underline">and Return and Refund Policy.</a>                            </label>
                                    <!-- <br>
                                <div class="loadotpmodal mt-2">
                                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">OTP Modal</button>
                                                                    </div> -->

                        </div>

                        <div class="form-check ">
                            <div class="g-recaptcha" data-sitekey="6LeAHywoAAAAALCmCuXotxQ5u6fMFpiRw8TR4Jtp"></div>
                        </div>
                        <input type="hidden" name="type" id="user_type" value="5">
                        <!-- <button class="btn btn-dark-cerulean btn-lg w-100 registerbtn" onclick="register_save(4)" type="button"> -->
                        <button type="submit" class="btn btn-dark-cerulean btn-lg w-100 registerbtn">
                            Sign up
                        </button>
                        </form>

                        <div class="text-center col-md-12 mt-3 d-flex ">
                            <div class="" style="padding: 10px; margin-left:60px">
                                <form action="{{ route('auth.google') }}" method="get">
                                    <input type="hidden" name="login_type" value="5">

                                    <button class="btn btn-outline-dark-cerulean btn-lg mb-3"><i class="fab fa-google me-1"></i></button>
                                </form>
                            </div>
                            <div class="" style="padding: 10px">
                                <form action="{{ route('auth.facebook') }}" method="get">
                                    <input type="hidden" name="login_type" value="5">
                                <button class="btn btn-outline-dark-cerulean btn-lg mb-3"><i class="fab fa-facebook me-1"></i></button>
                                </form>
                            </div>
                        </div>

                      <div class="mt-sm-4 text-center"> Already have an account?<strong>
                                <a href="{{ route('frontend.seller_signin') }}"class="text-decoration-underline">Sign in</a>                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('Frontend.layouts.parts.news-letter')

@endsection


@section('script')



<script>
$(document).ready(function() {
    // $('input[type=password]').keyup(function() {
    $('#user_password').keyup(function() {
        // keyup code here

        // set password variable
        var pswd = $("#user_password").val();
        //validate the length

        if (pswd.length < 8) {
            $('#length').removeClass('valid').addClass('invalid');
            var error = 0;
        } else {
            $('#length').removeClass('invalid').addClass('valid');
            var error = 1;
        }
        //validate letter
        // if (pswd.match(/[A-z]/)) {
        //     $('#letter').removeClass('invalid').addClass('valid');
        //     var error1 = 1;
        // } else {
        //     $('#letter').removeClass('valid').addClass('invalid');
        //     var error1 = 0;
        // }

        //validate capital letter
        // if (pswd.match(/[A-Z]/)) {
        //     $('#capital').removeClass('invalid').addClass('valid');
        //     var error2 = 1;
        // } else {
        //     $('#capital').removeClass('valid').addClass('invalid');
        //     var error2 = 0;
        // }

        //validate number
        // if (pswd.match(/\d/)) {
        //     $('#number').removeClass('invalid').addClass('valid');
        //     var error3 = 1;
        // } else {
        //     $('#number').removeClass('valid').addClass('invalid');
        //     var error3 = 0;
        // }
        if (error == 1) {
            $('#pswd_info').hide();
            $('.registerbtn').prop('disabled', false);
            $('#user_password').css({"border": ""});
        } else {
            $('#pswd_info').show();
            $('#user_password').css({"border": "1px solid red"});
            $('.registerbtn').prop('disabled', true);
        }
        // alert(error+'_'+error1+'_'+error2+'_'+error3);

    }).focus(function() {
        $('#pswd_info').show();
        if (error == 1 ) {
            $('#pswd_info').hide();
            $('.registerbtn').prop('disabled', false);
            $('#user_password').css({"border": ""});
        } else {
            $('#pswd_info').show();
            $('#user_password').css({"border": "1px solid red"});
            $('.registerbtn').prop('disabled', true);
        }
    }).blur(function() {
        $('#pswd_info').hide();
        if (error == 1) {
            $('#pswd_info').hide();
            $('.registerbtn').prop('disabled', false);
            $('#user_password').css({"border": ""});
        } else {
            $('#pswd_info').show();
            $('#user_password').css({"border": "1px solid red"});
            $('.registerbtn').prop('disabled', true);
        }
    });

    // ============= its for confirm-password ================
    $('#user_cpassword').keyup(function() {
        // set password variable
        var pswd = $("#user_cpassword").val();
        //validate the length

        if (pswd.length < 8) {
            $('#confirm-length').removeClass('valid').addClass('invalid');
            var error = 0;
        } else {
            $('#confirm-length').removeClass('invalid').addClass('valid');
            var error = 1;
        }
        //validate letter
        // if (pswd.match(/[A-z]/)) {
        //     $('#confirm-letter').removeClass('invalid').addClass('valid');
        //     var error1 = 1;
        // } else {
        //     $('#confirm-letter').removeClass('valid').addClass('invalid');
        //     var error1 = 0;
        // }

        //validate capital letter
        // if (pswd.match(/[A-Z]/)) {
        //     $('#confirm-capital').removeClass('invalid').addClass('valid');
        //     var error2 = 1;
        // } else {
        //     $('#confirm-capital').removeClass('valid').addClass('invalid');
        //     var error2 = 0;
        // }

        //validate number
        // if (pswd.match(/\d/)) {
        //     $('#confirm-number').removeClass('invalid').addClass('valid');
        //     var error3 = 1;
        // } else {
        //     $('#confirm-number').removeClass('valid').addClass('invalid');
        //     var error3 = 0;
        // }
        if (error == 1) {
            $('#confirm-pswd_info').hide();
            $('.registerbtn').prop('disabled', false);
            $('#user_cpassword').css({"border": ""});
        } else {
            $('#confirm-pswd_info').show();
            $('#user_cpassword').css({"border": "1px solid red"});
            $('.registerbtn').prop('disabled', true);
        }
        // alert(error+'_'+error1+'_'+error2+'_'+error3);

    }).focus(function() {
        $('#confirm-pswd_info').show();
        if (error == 1) {
            $('#confirm-pswd_info').hide();
            $('.registerbtn').prop('disabled', false);
            $('#user_cpassword').css({"border": ""});
        } else {
            $('#confirm-pswd_info').show();
            $('#user_cpassword').css({"border": "1px solid red"});
            $('.registerbtn').prop('disabled', true);
        }
    }).blur(function() {
        $('#confirm-pswd_info').hide();
        if (error == 1) {
            $('#confirm-pswd_info').hide();
            $('.registerbtn').prop('disabled', false);
            $('#user_cpassword').css({"border": ""});
        } else {
            $('#confirm-pswd_info').show();
            $('#user_cpassword').css({"border": "1px solid red"});
            $('.registerbtn').prop('disabled', true);
        }
    });

 $("#user_cpassword").on('keyup',function(){
    var pswd = $("#user_password").val();
    var password_confirm = $("#user_cpassword").val();
    if(pswd != password_confirm){
        $('#user_cpassword').css({"border": "1px solid red"});
        $('.registerbtn').prop('disabled', true);
    }else{
        $('#user_cpassword').css({"border": "1px solid #45c203"});
    }

 });


 var input = document.querySelector("#user_mobile");
	var utilslink = 'application/modules/frontend/views/themes/default/assets/js/index.html';

    window.intlTelInput(input, {

      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      preferredCountries: ['bd'],
      // separateDialCode: true,
	  // Change the country selection
 	  // instance.selectCountry("gb"),
      utilsScript: utilslink+"utils.js",
    });

    $("body").on("click", ".registerbtn", function () {
        var fd = new FormData();
        var g_recaptcha_response = $("#g-recaptcha-response").val();
         fd.append("g_recaptcha_response", g_recaptcha_response);

         if(g_recaptcha_response == ''){
            swal({
                title: "Please, select this captcha!!",
                type: "warning",
                showCancelButton: false,
                confirmButtonColor: '#14AD54',
                cancelButtonColor: '#07477D',
                confirmButtonText: 'OK',
                cancelButtonText: "Go To Signin",
                closeOnConfirm: true,
                closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm===false) {
                        swal("Please Signin");
                    }
                    else{
                        swal("Please Signin");
                    }
                });
                return false;
         }
    });
});


("use strict");
function mobilecheck(type) {
  var mobi = $("#user_mobile").val();
  var mobile = encodeURIComponent(mobi);

  $.ajax({
    url: base_url + enterprise_shortname + "/mobile-check",
    type: "post",
    data: {
		csrf_test_name : CSRF_TOKEN,
		mobile : mobi,
        usertype : type
	},
    success: function (data) {
      // console.log(data);
      if (data == 1 && mobi !== "") {
        $("#user_mobile").focus().val("");
        // toastrErrorMsg("This email already exists!");
        swal({
          title: ""+mobile+" \n This mobile number already registered. \n Please signin",
          type: "warning",
          showCancelButton: false,
          confirmButtonColor: '#14AD54',
          cancelButtonColor: '#07477D',
          confirmButtonText: 'OK',
          cancelButtonText: "Go To Signin",
          closeOnConfirm: true,
          closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm===false) {
                swal("Please Signin");
                // location.href(base_url + enterprise_shortname + '/signin');
            }
            else{
                // swal("Oh no...","press CANCEL please!");
                swal("Please Signin");
            }
        });
      /* lead inhouse by @Salehin 26062022 */
        return false;
      }
    },
  });
}


("use strict");
function mailcheck(type) {
  var email = $("#user_email").val();
  var email = encodeURIComponent(email);
  $.ajax({
    url: base_url + enterprise_shortname + "/email-check",
    type: "post",
    data: {
		csrf_test_name : CSRF_TOKEN,
		email : email,
        usertype : type
	},
    success: function (data) {
      // console.log(data);
      if (data == 1) {
        $("#user_email").focus().val("");
        // toastrErrorMsg("This email already exists!");
        swal({
          title: ""+decodeURIComponent(email)+" \n This email already registered \n Please signin",
          type: "warning",
          showCancelButton: false,
          confirmButtonColor: '#14AD54',
          confirmButtonText: 'OK',
          // cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false
      });
        return false;
      }
    },
  });
}


</script>
@endsection
