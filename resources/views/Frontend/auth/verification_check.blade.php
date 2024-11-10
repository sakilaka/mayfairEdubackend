@extends('Frontend.layouts.master-layout')
@section('title', '- Student Verification')
@section('head')

@endsection
@section('main_content')
    <br>
    <br>
    <br>
    <div class="py-5">
        <div class="container-lg">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-9">
                    <div class="border-md mx-0 rounded-3 row">
                        <div class="border-end-md col-md-6 p-sm-5 px-5">
                            @php
                                $home_content = \App\Models\HomeContentSetup::first();
                            @endphp
                            <h2 class="h3 mb-4 fw-bold text-uppercase align-items-center" style="text-align:center">
                                Please Verify your email. </h2>
                            <h4 class="mb-0" style="font-size:20px ;text-align:center">
                                {{ $home_content->register_des }} </h4>
                            <br>
              

                            {{-- <img class="d-block img-fluid mx-auto" style="margin-top:50px; height:380px; width:330px;"
                                src="{{ $home_content->register_image_show }}" width="344" alt="image"> --}}
                        </div>

                        <div class="col-md-6 px-4 pt-2 pb-4 px-sm-5 pb-sm-5 pt-md-5">
    
                            <h4 class="text-center my-2">Email Sent Successfully. Please Check Your Mail</h4>
                        
                            <form action="{{ route('frontend.set_verify') }}" class="myform" id="student"
                                  enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email }}">
                        
                                <div class="mb-3">
                                    <label for="user_name" class="form-label mb-1">Enter Verification Code</label>
                                    <input type="text" class="form-control form-control-lg" id="user_name" 
                                           name="verification_code" placeholder="Your Code" required autofocus>
                                </div>
                        
                                <button type="submit" class="btn btn-dark-cerulean btn-lg w-100 registerbtn">
                                    Submit
                                </button>
                            </form>
                        
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
                    $('#user_password').css({
                        "border": ""
                    });
                } else {
                    $('#pswd_info').show();
                    $('#user_password').css({
                        "border": "1px solid red"
                    });
                    $('.registerbtn').prop('disabled', true);
                }
                // alert(error+'_'+error1+'_'+error2+'_'+error3);

            }).focus(function() {
                $('#pswd_info').show();
                if (error == 1) {
                    $('#pswd_info').hide();
                    $('.registerbtn').prop('disabled', false);
                    $('#user_password').css({
                        "border": ""
                    });
                } else {
                    $('#pswd_info').show();
                    $('#user_password').css({
                        "border": "1px solid red"
                    });
                    $('.registerbtn').prop('disabled', true);
                }
            }).blur(function() {
                $('#pswd_info').hide();
                if (error == 1) {
                    $('#pswd_info').hide();
                    $('.registerbtn').prop('disabled', false);
                    $('#user_password').css({
                        "border": ""
                    });
                } else {
                    $('#pswd_info').show();
                    $('#user_password').css({
                        "border": "1px solid red"
                    });
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
                    $('#user_cpassword').css({
                        "border": ""
                    });
                } else {
                    $('#confirm-pswd_info').show();
                    $('#user_cpassword').css({
                        "border": "1px solid red"
                    });
                    $('.registerbtn').prop('disabled', true);
                }
                // alert(error+'_'+error1+'_'+error2+'_'+error3);

            }).focus(function() {
                $('#confirm-pswd_info').show();
                if (error == 1) {
                    $('#confirm-pswd_info').hide();
                    $('.registerbtn').prop('disabled', false);
                    $('#user_cpassword').css({
                        "border": ""
                    });
                } else {
                    $('#confirm-pswd_info').show();
                    $('#user_cpassword').css({
                        "border": "1px solid red"
                    });
                    $('.registerbtn').prop('disabled', true);
                }
            }).blur(function() {
                $('#confirm-pswd_info').hide();
                if (error == 1) {
                    $('#confirm-pswd_info').hide();
                    $('.registerbtn').prop('disabled', false);
                    $('#user_cpassword').css({
                        "border": ""
                    });
                } else {
                    $('#confirm-pswd_info').show();
                    $('#user_cpassword').css({
                        "border": "1px solid red"
                    });
                    $('.registerbtn').prop('disabled', true);
                }
            });

            $("#user_cpassword").on('keyup', function() {
                var pswd = $("#user_password").val();
                var password_confirm = $("#user_cpassword").val();
                if (pswd != password_confirm) {
                    $('#user_cpassword').css({
                        "border": "1px solid red"
                    });
                    $('.registerbtn').prop('disabled', true);
                } else {
                    $('#user_cpassword').css({
                        "border": "1px solid #45c203"
                    });
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
                utilsScript: utilslink + "utils.js",
            });

            $("body").on("click", ".registerbtn", function() {
                var fd = new FormData();
                var g_recaptcha_response = $("#g-recaptcha-response").val();
                fd.append("g_recaptcha_response", g_recaptcha_response);

                if (g_recaptcha_response == '') {
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
                        function(isConfirm) {
                            if (isConfirm === false) {
                                swal("Please Signin");
                            } else {
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
                    csrf_test_name: CSRF_TOKEN,
                    mobile: mobi,
                    usertype: type
                },
                success: function(data) {
                    // console.log(data);
                    if (data == 1 && mobi !== "") {
                        $("#user_mobile").focus().val("");
                        // toastrErrorMsg("This email already exists!");
                        swal({
                                title: "" + mobile +
                                    " \n This mobile number already registered. \n Please signin",
                                type: "warning",
                                showCancelButton: false,
                                confirmButtonColor: '#14AD54',
                                cancelButtonColor: '#07477D',
                                confirmButtonText: 'OK',
                                cancelButtonText: "Go To Signin",
                                closeOnConfirm: true,
                                closeOnCancel: false
                            },
                            function(isConfirm) {
                                if (isConfirm === false) {
                                    swal("Please Signin");
                                    // location.href(base_url + enterprise_shortname + '/signin');
                                } else {
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
                    csrf_test_name: CSRF_TOKEN,
                    email: email,
                    usertype: type
                },
                success: function(data) {
                    // console.log(data);
                    if (data == 1) {
                        $("#user_email").focus().val("");
                        // toastrErrorMsg("This email already exists!");
                        swal({
                            title: "" + decodeURIComponent(email) +
                                " \n This email already registered \n Please signin",
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

    <script>
        // List of countries with country codes
        const countryCodes = [{
                name: "Afghanistan",
                code: "+93"
            },
            {
                name: "Albania",
                code: "+355"
            },
            {
                name: "Algeria",
                code: "+213"
            },
            {
                name: "Andorra",
                code: "+376"
            },
            {
                name: "Angola",
                code: "+244"
            },
            {
                name: "Argentina",
                code: "+54"
            },
            {
                name: "Armenia",
                code: "+374"
            },
            {
                name: "Australia",
                code: "+61"
            },
            {
                name: "Austria",
                code: "+43"
            },
            {
                name: "Azerbaijan",
                code: "+994"
            },
            {
                name: "Bahamas",
                code: "+1-242"
            },
            {
                name: "Bahrain",
                code: "+973"
            },
            {
                name: "Bangladesh",
                code: "+880"
            },
            {
                name: "Barbados",
                code: "+1-246"
            },
            {
                name: "Belarus",
                code: "+375"
            },
            {
                name: "Belgium",
                code: "+32"
            },
            {
                name: "Belize",
                code: "+501"
            },
            {
                name: "Benin",
                code: "+229"
            },
            {
                name: "Bhutan",
                code: "+975"
            },
            {
                name: "Bolivia",
                code: "+591"
            },
            {
                name: "Bosnia and Herzegovina",
                code: "+387"
            },
            {
                name: "Botswana",
                code: "+267"
            },
            {
                name: "Brazil",
                code: "+55"
            },
            {
                name: "Brunei",
                code: "+673"
            },
            {
                name: "Bulgaria",
                code: "+359"
            },
            {
                name: "Burkina Faso",
                code: "+226"
            },
            {
                name: "Burundi",
                code: "+257"
            },
            {
                name: "Cabo Verde",
                code: "+238"
            },
            {
                name: "Cambodia",
                code: "+855"
            },
            {
                name: "Cameroon",
                code: "+237"
            },
            {
                name: "Canada",
                code: "+1"
            },
            {
                name: "Central African Republic",
                code: "+236"
            },
            {
                name: "Chad",
                code: "+235"
            },
            {
                name: "Chile",
                code: "+56"
            },
            {
                name: "China",
                code: "+86"
            },
            {
                name: "Colombia",
                code: "+57"
            },
            {
                name: "Comoros",
                code: "+269"
            },
            {
                name: "Congo",
                code: "+242"
            },
            {
                name: "Costa Rica",
                code: "+506"
            },
            {
                name: "Croatia",
                code: "+385"
            },
            {
                name: "Cuba",
                code: "+53"
            },
            {
                name: "Cyprus",
                code: "+357"
            },
            {
                name: "Czech Republic",
                code: "+420"
            },
            {
                name: "Denmark",
                code: "+45"
            },
            {
                name: "Djibouti",
                code: "+253"
            },
            {
                name: "Dominica",
                code: "+1-767"
            },
            {
                name: "Dominican Republic",
                code: "+1-809"
            },
            {
                name: "Ecuador",
                code: "+593"
            },
            {
                name: "Egypt",
                code: "+20"
            },
            {
                name: "El Salvador",
                code: "+503"
            },
            {
                name: "Equatorial Guinea",
                code: "+240"
            },
            {
                name: "Eritrea",
                code: "+291"
            },
            {
                name: "Estonia",
                code: "+372"
            },
            {
                name: "Eswatini",
                code: "+268"
            },
            {
                name: "Ethiopia",
                code: "+251"
            },
            {
                name: "Fiji",
                code: "+679"
            },
            {
                name: "Finland",
                code: "+358"
            },
            {
                name: "France",
                code: "+33"
            },
            {
                name: "Gabon",
                code: "+241"
            },
            {
                name: "Gambia",
                code: "+220"
            },
            {
                name: "Georgia",
                code: "+995"
            },
            {
                name: "Germany",
                code: "+49"
            },
            {
                name: "Ghana",
                code: "+233"
            },
            {
                name: "Greece",
                code: "+30"
            },
            {
                name: "Grenada",
                code: "+1-473"
            },
            {
                name: "Guatemala",
                code: "+502"
            },
            {
                name: "Guinea",
                code: "+224"
            },
            {
                name: "Guyana",
                code: "+592"
            },
            {
                name: "Haiti",
                code: "+509"
            },
            {
                name: "Honduras",
                code: "+504"
            },
            {
                name: "Hungary",
                code: "+36"
            },
            {
                name: "Iceland",
                code: "+354"
            },
            {
                name: "India",
                code: "+91"
            },
            {
                name: "Indonesia",
                code: "+62"
            },
            {
                name: "Iran",
                code: "+98"
            },
            {
                name: "Iraq",
                code: "+964"
            },
            {
                name: "Ireland",
                code: "+353"
            },
            {
                name: "Israel",
                code: "+972"
            },
            {
                name: "Italy",
                code: "+39"
            },
            {
                name: "Jamaica",
                code: "+1-876"
            },
            {
                name: "Japan",
                code: "+81"
            },
            {
                name: "Jordan",
                code: "+962"
            },
            {
                name: "Kazakhstan",
                code: "+7"
            },
            {
                name: "Kenya",
                code: "+254"
            },
            {
                name: "Kiribati",
                code: "+686"
            },
            {
                name: "Kuwait",
                code: "+965"
            },
            {
                name: "Kyrgyzstan",
                code: "+996"
            },
            {
                name: "Laos",
                code: "+856"
            },
            {
                name: "Latvia",
                code: "+371"
            },
            {
                name: "Lebanon",
                code: "+961"
            },
            {
                name: "Lesotho",
                code: "+266"
            },
            {
                name: "Liberia",
                code: "+231"
            },
            {
                name: "Libya",
                code: "+218"
            },
            {
                name: "Lithuania",
                code: "+370"
            },
            {
                name: "Luxembourg",
                code: "+352"
            },
            {
                name: "Madagascar",
                code: "+261"
            },
            {
                name: "Malawi",
                code: "+265"
            },
            {
                name: "Malaysia",
                code: "+60"
            },
            {
                name: "Maldives",
                code: "+960"
            },
            {
                name: "Mali",
                code: "+223"
            },
            {
                name: "Malta",
                code: "+356"
            },
            {
                name: "Mauritania",
                code: "+222"
            },
            {
                name: "Mauritius",
                code: "+230"
            },
            {
                name: "Mexico",
                code: "+52"
            },
            {
                name: "Monaco",
                code: "+377"
            },
            {
                name: "Mongolia",
                code: "+976"
            },
            {
                name: "Montenegro",
                code: "+382"
            },
            {
                name: "Morocco",
                code: "+212"
            },
            {
                name: "Mozambique",
                code: "+258"
            },
            {
                name: "Myanmar",
                code: "+95"
            },
            {
                name: "Namibia",
                code: "+264"
            },
            {
                name: "Nauru",
                code: "+674"
            },
            {
                name: "Nepal",
                code: "+977"
            },
            {
                name: "Netherlands",
                code: "+31"
            },
            {
                name: "New Zealand",
                code: "+64"
            },
            {
                name: "Nicaragua",
                code: "+505"
            },
            {
                name: "Niger",
                code: "+227"
            },
            {
                name: "Nigeria",
                code: "+234"
            },
            {
                name: "Norway",
                code: "+47"
            },
            {
                name: "Oman",
                code: "+968"
            },
            {
                name: "Pakistan",
                code: "+92"
            },
            {
                name: "Panama",
                code: "+507"
            },
            {
                name: "Papua New Guinea",
                code: "+675"
            },
            {
                name: "Paraguay",
                code: "+595"
            },
            {
                name: "Peru",
                code: "+51"
            },
            {
                name: "Philippines",
                code: "+63"
            },
            {
                name: "Poland",
                code: "+48"
            },
            {
                name: "Portugal",
                code: "+351"
            },
            {
                name: "Qatar",
                code: "+974"
            },
            {
                name: "Romania",
                code: "+40"
            },
            {
                name: "Russia",
                code: "+7"
            },
            {
                name: "Rwanda",
                code: "+250"
            },
            {
                name: "Saudi Arabia",
                code: "+966"
            },
            {
                name: "Senegal",
                code: "+221"
            },
            {
                name: "Serbia",
                code: "+381"
            },
            {
                name: "Seychelles",
                code: "+248"
            },
            {
                name: "Sierra Leone",
                code: "+232"
            },
            {
                name: "Singapore",
                code: "+65"
            },
            {
                name: "Slovakia",
                code: "+421"
            },
            {
                name: "Slovenia",
                code: "+386"
            },
            {
                name: "Solomon Islands",
                code: "+677"
            },
            {
                name: "Somalia",
                code: "+252"
            },
            {
                name: "South Africa",
                code: "+27"
            },
            {
                name: "South Korea",
                code: "+82"
            },
            {
                name: "Spain",
                code: "+34"
            },
            {
                name: "Sri Lanka",
                code: "+94"
            },
            {
                name: "Sudan",
                code: "+249"
            },
            {
                name: "Sweden",
                code: "+46"
            },
            {
                name: "Switzerland",
                code: "+41"
            },
            {
                name: "Syria",
                code: "+963"
            },
            {
                name: "Taiwan",
                code: "+886"
            },
            {
                name: "Tajikistan",
                code: "+992"
            },
            {
                name: "Tanzania",
                code: "+255"
            },
            {
                name: "Thailand",
                code: "+66"
            },
            {
                name: "Togo",
                code: "+228"
            },
            {
                name: "Tonga",
                code: "+676"
            },
            {
                name: "Trinidad and Tobago",
                code: "+1-868"
            },
            {
                name: "Tunisia",
                code: "+216"
            },
            {
                name: "Turkey",
                code: "+90"
            },
            {
                name: "Turkmenistan",
                code: "+993"
            },
            {
                name: "Uganda",
                code: "+256"
            },
            {
                name: "Ukraine",
                code: "+380"
            },
            {
                name: "United Arab Emirates",
                code: "+971"
            },
            {
                name: "United Kingdom",
                code: "+44"
            },
            {
                name: "United States",
                code: "+1"
            },
            {
                name: "Uruguay",
                code: "+598"
            },
            {
                name: "Uzbekistan",
                code: "+998"
            },
            {
                name: "Vanuatu",
                code: "+678"
            },
            {
                name: "Venezuela",
                code: "+58"
            },
            {
                name: "Vietnam",
                code: "+84"
            },
            {
                name: "Yemen",
                code: "+967"
            },
            {
                name: "Zambia",
                code: "+260"
            },
            {
                name: "Zimbabwe",
                code: "+263"
            }
        ];


        function populateCountryCodes() {
            const countrySelect = document.getElementById("country_code");
            countryCodes.forEach(country => {
                const option = document.createElement("option");
                option.value = country.code;
                option.textContent = `${country.name} (${country.code})`;
                countrySelect.appendChild(option);
            });
        }

        window.onload = populateCountryCodes;
    </script>
@endsection
