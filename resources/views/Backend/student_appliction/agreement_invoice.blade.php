<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Application Invoice</title>
    <style>
        .footer {
            background: #824fa3;
            color: white;
            padding: 1px;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .footer-container {
            max-width: 700px;
            /* margin: auto; */
        }

        .footer-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 15px;
            /* border-radius: 10px; */
            border-top-right-radius: 100px;
            border-bottom-right-radius: 100px;
            color: #824fa3;
            font-weight: bold;
            height: 100px;
        }

        .company-info {
            flex: 1;
            text-align: left;
            padding: 10px;
            margin-left: 30px;

        }

        .company-info h6 {
            font-weight: bold;
        }

        .divider {
            width: 2px;
            background: #824fa3;
            height: 60px;
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            font-weight: bold;
        }


        .website a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 20px;
            margin-left: 10px;
        }

        .website i {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 20px;
        }

        .location {
            display: flex;
            align-items: center;
            font-size: 20px;
        }

        .custom-table {
            width: 80%;
            margin: 0px auto;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, sans-serif;
        }

        .custom-table td {
            border: 1px solid black;
            padding: 10px;
        }

        .custom-table strong {
            font-size: 20px;
        }

        .custom-table td {
            font-size: 19px;
        }

        .custom-table tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .partyB p {
            font-size: 20px;
        }

        .destination-fee {
            font-family: Arial, sans-serif;
            font-size: 20px;
            line-height: 1.6;
            width: 800px;
            margin: 0px auto;
        }

        .destination-fee p {
            font-weight: bold;
            font-size: 20px;
        }

        .destination-fee ol {
            padding-left: 20px;
            font-size: 20px;
        }

        .destination-fee li {
            margin-bottom: 10px;
        }

        .statement p {
            font-size: 20px;
            width: 900px;
            margin: 0px auto;
            line-height: 2;
        }

        .lastFooter {
            width: 800px;
            margin: 0px auto;
            margin-top: 30px;
        }

        .partyA p {
            font-size: 20px;
            width: 500px;
        }

        .partyB p {
            font-size: 20px;
            width: 300px;
            margin-left: 20px;
        }
    </style>
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
                            Agreement Invoice
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.application_agreement_print', $agreement->id) }}"
                                class="btn btn-primary">
                                <i class="fa fa-print mr-1"></i>Print
                            </a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card px-2">
                                <div class="card-body">

                                    {{-- page 1  --}}

                                    <div class="my-2" style="height: 1450px;">
                                        <div class="header d-flex justify-content-between mx-auto" style="width: 80%;">
                                            <div>
                                                <img src="{{ asset('backend/assets/images/new_logo.png') }}"
                                                    alt="{{ env('APP_NAME') }}" width="250px">
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center">
                                                    <i style="background-color: #824fa3; color: white; padding: 10px;border-radius: 50%;"
                                                        class="fa fa-phone"></i>
                                                    <p style="font-size: 18px; font-weight: bold; color: #824fa3;margin-left: 11px; margin-top: 10px;"
                                                        class="">+ 372 5870 0600</p>
                                                </div>

                                                <div style="color: #824fa3" class="d-flex mt-3">
                                                    <i style="font-size: 28px;" class="fa-solid fa-envelope"></i>
                                                    <p style="font-size: 18px; font-weight: bold;margin-left: 22px;">
                                                        edu.mayfair@gmail.com</p>
                                                </div>
                                            </div>
                                        </div>

                                        <hr style="background-color: #824fa3; height: 3px;">

                                        <div class="text-right mt-5">
                                            <p style="font-size: 18px;">Date : {{ $agreementDetails->created_at }}</p>
                                        </div>

                                        <div class="mt-5">
                                            <h2 class="text-center my-3" style="text-decoration: underline;">Student
                                                Visa Consultancy Service Agreement</h2>

                                            <h3 class="text-center mt-5">Party A</h3>

                                            <table class="custom-table my-5">
                                                <tr>
                                                    <td><strong>Name</strong></td>
                                                    <td>{{ $agreementDetails->full_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Passport Number</strong></td>
                                                    <td>{{ $agreementDetails->passport_number }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><strong>Present Address:</strong> {{ $agreementDetails->present_address }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Spouse Name</strong></td>
                                                    <td>{{ $agreementDetails->spouse_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Spouse Passport Number</strong></td>
                                                    <td>{{ $agreementDetails->spouse_passport_number  }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Children</strong></td>
                                                    <td>{{ $agreementDetails->children_names }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Children Passport Number</strong></td>
                                                    <td>{{ $agreementDetails->children_passport_numbers }}</td>
                                                </tr>
                                            </table>

                                            <h3 class="text-center mt-4">Party B</h3>
                                            <div class="my-5 partyB" style="width: 80%; margin: 0px auto;">
                                                <p>Mayfair Global Education</p>
                                                <p>Vindi 9-2, Kristiina, Tallinn 11315, Estonia</p>
                                                <p>+372 5870 0600</p>
                                                <p class="mt-4">In order to safeguard the rights and interests of
                                                    Party A and Party B, Party A
                                                    and Party B have entered into the following agreement in respect of
                                                    Party B
                                                    being entrusted by Party A for student visa processing for Finland:
                                                </p>
                                            </div>
                                        </div>

                                        <hr class="mt-4" style="background-color: #824fa3; height: 3px; margin: 0px;">

                                        <div class="footer">
                                            <div class="footer-container">
                                                <div class="footer-section">
                                                    <div class="logo">
                                                        <img src="your-logo.png" alt="Logo">
                                                    </div>
                                                    <div class="company-info">
                                                        <h6>Estonia:</h6>
                                                        <h6>VAT No.: EE14679610</h6>
                                                        <h6>Registration No.: 14679610</h6>
                                                    </div>
                                                    <div class="divider"></div>
                                                    <div class="company-info">
                                                        <h6>Bangladesh:</h6>
                                                        <h6>Registration No.: TRAD/DSCC/ <br>005945/2021</h6>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="footer-bottom">
                                                <div class="website">
                                                    <i class="fa-solid fa-globe"></i> <a
                                                        href="https://www.mayfaireducation.global"
                                                        target="_blank">WWW.MAYFAIREDUCATION.GLOBAL</a>
                                                </div>
                                                <div class="location">
                                                    📍 Vindi 9-2, Kristiine, Tallinn 11315, Estonia
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- page 2  --}}

                                    <div class="my-2" style="height: 1560px;">
                                        <div class="header d-flex justify-content-between mx-auto" style="width: 80%;">
                                            <div>
                                                <img src="{{ asset('backend/assets/images/new_logo.png') }}"
                                                    alt="{{ env('APP_NAME') }}" width="250px">
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center">
                                                    <i style="background-color: #824fa3; color: white; padding: 10px;border-radius: 50%;"
                                                        class="fa fa-phone"></i>
                                                    <p style="font-size: 18px; font-weight: bold; color: #824fa3;margin-left: 11px; margin-top: 10px;"
                                                        class="">+ 372 5870 0600</p>
                                                </div>

                                                <div style="color: #824fa3" class="d-flex mt-3">
                                                    <i style="font-size: 28px;" class="fa-solid fa-envelope"></i>
                                                    <p style="font-size: 18px; font-weight: bold;margin-left: 22px;">
                                                        edu.mayfair@gmail.com</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="background-color: #824fa3; height: 3px;">

                                        <div class="destination-fee d-flex">
                                            <div>
                                                <p><strong>(I)</strong></p>
                                            </div>

                                            <div style="margin-left: 50px;">
                                                <p><strong> Destination and Fee</strong></p>

                                                <ol>
                                                    <li>Party A applies for <strong>FINLAND.</strong></li>
                                                    <li>
                                                        Main service contents of Party B: Overseas study consulting,
                                                        documents assessment, visa-processing service, overseas
                                                        essential services.
                                                    </li>
                                                    <li>
                                                        Party A agrees to pay the consultancy service fee to Party B in
                                                        a lump sum of
                                                        <strong>1200 Euro</strong> in total. The party has to pay the
                                                        service charge in a gradual manner.
                                                        Here is the list of total expenses.
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>

                                        @php
                                            $totalFee = $agreementDetails->file_opening_fee + $agreementDetails->application_fees
                                            + $agreementDetails->admission_service_charge + $agreementDetails->first_year_tuition_fees +
                                            $agreementDetails->health_insurance + $agreementDetails->residence_permit_fees + $agreementDetails->vfs_fees
                                            + $agreementDetails->travel_food_accommodation + $agreementDetails->air_ticket
                                            + $agreementDetails->final_service_fee + $agreementDetails->house_rent_deposit;

                                        @endphp


                                        <table class="custom-table my-5">
                                            <tr>
                                                <td><strong>SL No.</strong></td>
                                                <td>Details</td>
                                                <td>Amount in Euros</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>File Opening Fee</td>
                                                <td>{{ $agreementDetails->file_opening_fee }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Application Fees/Union Fees – After Admission</td>
                                                <td>{{ $agreementDetails->application_fees }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>After Admission - Service Charge </td>
                                                <td>{{ $agreementDetails->admission_service_charge }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>1st Year Tuition Fees</td>
                                                <td>{{ $agreementDetails->first_year_tuition_fees }}</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Health Insurance - 1st Year</td>
                                                <td>{{ $agreementDetails->health_insurance }}</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>After Offer Letter - Service fee </td>
                                                <td>000</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Residence Permit/Embassy fees - Student </td>
                                                <td>{{ $agreementDetails->residence_permit_fees }}</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>VFS Fees - Per Applicant </td>
                                                <td>{{ $agreementDetails->vfs_fees }}</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Travelling, food & accommodation expense for India</td>
                                                <td>{{ $agreementDetails->travel_food_accommodation }}</td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>After Visa Air Ticket</td>
                                                <td>{{ $agreementDetails->air_ticket }}</td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>Service fees Final Installment after Visa</td>
                                                <td>{{ $agreementDetails->final_service_fee }}</td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>House rent + Deposit</td>
                                                <td>{{ $agreementDetails->house_rent_deposit }}</td>
                                            </tr>
                                            <tr style="border: none;">
                                                <td colspan="2">Subtotal</td>
                                                <td>{{ $totalFee }}</td>
                                            </tr>

                                        </table>


                                        <div class="statement">
                                            <p> <i style="margin-right: 20px;" class="fa-solid fa-angles-right"></i>
                                                Bank Statement (800*12)*1 (Per Applicant)= 9600 Euro.</p>
                                            <p> <i style="margin-right: 20px;" class="fa-solid fa-angles-right"></i> All
                                                other expenses may vary, except our service charge.</p>
                                            <p> <i style="margin-right: 20px;" class="fa-solid fa-angles-right"></i> 50%
                                                will be refunded in case of Visa failure, from the amount of 200 Euros,
                                                you are paying
                                                as service charges before submitting the documents in the embassy..</p>
                                            <p> <i style="margin-right: 20px;" class="fa-solid fa-angles-right"></i> The
                                                Euro exchange rate applied will be the prevailing Google rate, with an
                                                additional charge
                                                of 7.5%.</p>
                                        </div>



                                        <hr class="mt-4" style="background-color: #824fa3; height: 3px; margin: 0px;">
                                        <div class="footer">
                                            <div class="footer-container">
                                                <div class="footer-section">
                                                    <div class="logo">
                                                        <img src="your-logo.png" alt="Logo">
                                                    </div>
                                                    <div class="company-info">
                                                        <h6>Estonia:</h6>
                                                        <h6>VAT No.: EE14679610</h6>
                                                        <h6>Registration No.: 14679610</h6>
                                                    </div>
                                                    <div class="divider"></div>
                                                    <div class="company-info">
                                                        <h6>Bangladesh:</h6>
                                                        <h6>Registration No.: TRAD/DSCC/ <br>005945/2021</h6>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="footer-bottom">
                                                <div class="website">
                                                    <i class="fa-solid fa-globe"></i> <a
                                                        href="https://www.mayfaireducation.global"
                                                        target="_blank">WWW.MAYFAIREDUCATION.GLOBAL</a>
                                                </div>
                                                <div class="location">
                                                    📍 Vindi 9-2, Kristiine, Tallinn 11315, Estonia
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- page 3  --}}

                                    <div class="my-2" style="height: 1550px;">
                                        <div class="header d-flex justify-content-between mx-auto"
                                            style="width: 80%;">
                                            <div>
                                                <img src="{{ asset('backend/assets/images/new_logo.png') }}"
                                                    alt="{{ env('APP_NAME') }}" width="250px">
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center">
                                                    <i style="background-color: #824fa3; color: white; padding: 10px;border-radius: 50%;"
                                                        class="fa fa-phone"></i>
                                                    <p style="font-size: 18px; font-weight: bold; color: #824fa3;margin-left: 11px; margin-top: 10px;"
                                                        class="">+ 372 5870 0600</p>
                                                </div>

                                                <div style="color: #824fa3" class="d-flex mt-3">
                                                    <i style="font-size: 28px;" class="fa-solid fa-envelope"></i>
                                                    <p style="font-size: 18px; font-weight: bold;margin-left: 22px;">
                                                        edu.mayfair@gmail.com</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="background-color: #824fa3; height: 3px;">

                                        <div class="destination-fee">

                                            <div>
                                                <p><strong>(II)Party B’s Obligations</strong></p>
                                            </div>

                                            <div style="margin-left: 50px;">
                                                <p>5. Overseas study consulting and visa service</p>

                                                <ol>
                                                    <li>Party B shall introduce the details, optional colleges and
                                                        universities and courses</li>
                                                    <li>
                                                        Party B shall assist and guide Party A in preparing the relevant
                                                        materials of admission
                                                        application; Party B shall handle the procedures of admission
                                                        application for Party A, and shall guide
                                                        Party A to pay enrollment fee, tuition fees, medical fees,
                                                        insurance fees etc.
                                                    </li>
                                                    <li>
                                                        Party B shall guide Party A to prepare for visa application, and
                                                        assist Party A in handling visa
                                                        or entry approval documents
                                                    </li>
                                                    <li>
                                                        Party B shall keep all materials provided by Party A
                                                        confidential,
                                                        and may not disclose to any unrelated third party, except for
                                                        the purpose of the admission,
                                                        application and visa application of Party A.
                                                    </li>
                                                    <li>
                                                        Party B strictly follows the rules and regulations related to
                                                        customer services governed by the
                                                        European Union regulations.
                                                    </li>
                                                </ol>

                                                <p>5. Overseas study consulting and visa service</p>
                                                <ol>
                                                    <li>Party B will provide overseas services to Party A</li>
                                                    <li>
                                                        Overseas services include picking up at the airport of
                                                        destination, arranging accommodation
                                                        (reserving student dormitory/hotel), leading Party A to handle
                                                        registration according to the local
                                                        regulations, opening an account in a bank, introducing the local
                                                        daily living common knowledge, etc.
                                                    </li>
                                                </ol>
                                            </div>

                                            <div class="" style="list-style: none;">
                                                <p><strong>(III)Party A’s Obligations</strong></p>
                                                <li>7. Party A shall conform to the conditions of European overseas
                                                    study, and comply with the national
                                                    regulations about overseas study.
                                                </li>
                                                <li>
                                                    8. Party A shall guarantee that all documents and materials by Party
                                                    A and all contents stated by Party A
                                                    shall be lawful, true and valid.
                                                </li>
                                                <li>
                                                    9. Party A shall submit all materials necessary for overseas study
                                                    application to Party B within the time
                                                    as required by Party B.
                                                </li>
                                                <li>
                                                    10. During the process of handling overseas study applications, if
                                                    any change happens to the overseas
                                                    study policy or visa policy of the country of destination or the
                                                    admission requirements of the college
                                                    applied for, Party A shall timely provide supplementary materials
                                                    according to the new requirements
                                                </li>
                                            </div>
                                        </div>


                                        <hr class="mt-4"
                                            style="background-color: #824fa3; height: 3px; margin: 0px;">
                                        <div class="footer">
                                            <div class="footer-container">
                                                <div class="footer-section">
                                                    <div class="logo">
                                                        <img src="your-logo.png" alt="Logo">
                                                    </div>
                                                    <div class="company-info">
                                                        <h6>Estonia:</h6>
                                                        <h6>VAT No.: EE14679610</h6>
                                                        <h6>Registration No.: 14679610</h6>
                                                    </div>
                                                    <div class="divider"></div>
                                                    <div class="company-info">
                                                        <h6>Bangladesh:</h6>
                                                        <h6>Registration No.: TRAD/DSCC/ <br>005945/2021</h6>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="footer-bottom">
                                                <div class="website">
                                                    <i class="fa-solid fa-globe"></i> <a
                                                        href="https://www.mayfaireducation.global"
                                                        target="_blank">WWW.MAYFAIREDUCATION.GLOBAL</a>
                                                </div>
                                                <div class="location">
                                                    📍 Vindi 9-2, Kristiine, Tallinn 11315, Estonia
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- page 4  --}}

                                    <div class="my-2" style="height: 1450px;">
                                        <div class="header d-flex justify-content-between mx-auto"
                                            style="width: 80%;">
                                            <div>
                                                <img src="{{ asset('backend/assets/images/new_logo.png') }}"
                                                    alt="{{ env('APP_NAME') }}" width="250px">
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center">
                                                    <i style="background-color: #824fa3; color: white; padding: 10px;border-radius: 50%;"
                                                        class="fa fa-phone"></i>
                                                    <p style="font-size: 18px; font-weight: bold; color: #824fa3;margin-left: 11px; margin-top: 10px;"
                                                        class="">+ 372 5870 0600</p>
                                                </div>

                                                <div style="color: #824fa3" class="d-flex mt-3">
                                                    <i style="font-size: 28px;" class="fa-solid fa-envelope"></i>
                                                    <p style="font-size: 18px; font-weight: bold;margin-left: 22px;">
                                                        edu.mayfair@gmail.com</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="background-color: #824fa3; height: 3px;">

                                        <div class="destination-fee">


                                            <div class="" style="list-style: none;">
                                                <li>11. During the process of handling overseas study applications, if
                                                    the embassy of the countryof
                                                    destination in Europe requires interviewing Party A, Party A shall
                                                    participate in the interview as
                                                    required
                                                </li>
                                                <li>
                                                    12. Party A shall complete the training of language course within
                                                    the time as required by Party B.
                                                </li>
                                                <li>
                                                    13. Party A shall timely pay the service fee as specified herein to
                                                    Party B; Party A shall pay
                                                    enrollment fee, tuition and insurance and other necessary fees to
                                                    overseas college according to
                                                    the time as notified by Party B, and shall timely notify Party B of
                                                    the payment results.
                                                </li>
                                                <li>
                                                    14. Party A is not allowed to share the agreement and any other
                                                    official documents provided by
                                                    Party B and may not disclose to any unrelated third party.
                                                </li>
                                            </div>


                                            <div>
                                                <p><strong>(IV)Liabilities for Breach</strong></p>

                                                <div class="" style="list-style: none;">
                                                    <li>15. Party B and Party A shall perform all provisions of this
                                                        Agreement; the breaching party shall
                                                        assume corresponding liabilities for breach.
                                                    </li>
                                                    <li>
                                                        16. If Party A fails to secure his admission and visa for the
                                                        desired country, Party B will returned
                                                        the rest of the money he/she paid as additional cost for his/her
                                                        application and other necessary
                                                        fees (see- I.3)
                                                    </li>
                                                    <li>
                                                        17. If this Agreement can not be performed due to any false
                                                        documents or materials provided by
                                                        Party A or any unethical attempt, then Party B will complain to
                                                        European visa/Immigration offices
                                                        about party A, so that party A could be restricted to enter any
                                                        European country for a time being.
                                                    </li>
                                                    <li>
                                                        Within the period from the date of signing of this Agreement to
                                                        the date when Party A has
                                                        obtained the visa, if Party A requires dissolving this Agreement
                                                        due to Party A’s own cause, he/she
                                                        has to pay service charge according to the percentage of work
                                                        done by Party B.
                                                    </li>
                                                </div>

                                            </div>

                                            <div>
                                                <p><strong>(V)Force Majeure</strong></p>

                                                <li>19. If either party is prevented from performing this Agreement due
                                                    to force majeure, it shall
                                                    immediately send a notice to the other party, stating the date of
                                                    occurrence, nature, estimated
                                                    duration of the force majeure and the impact on the performance of
                                                    this Agreement by the
                                                    impacted party, and shall provide a proof within 7 days after the
                                                    date of occurrence of force
                                                    majeure.
                                                </li>
                                            </div>
                                        </div>



                                        <hr class="mt-4"
                                            style="background-color: #824fa3; height: 3px; margin: 0px;">
                                        <div class="footer">
                                            <div class="footer-container">
                                                <div class="footer-section">
                                                    <div class="logo">
                                                        <img src="your-logo.png" alt="Logo">
                                                    </div>
                                                    <div class="company-info">
                                                        <h6>Estonia:</h6>
                                                        <h6>VAT No.: EE14679610</h6>
                                                        <h6>Registration No.: 14679610</h6>
                                                    </div>
                                                    <div class="divider"></div>
                                                    <div class="company-info">
                                                        <h6>Bangladesh:</h6>
                                                        <h6>Registration No.: TRAD/DSCC/ <br>005945/2021</h6>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="footer-bottom">
                                                <div class="website">
                                                    <i class="fa-solid fa-globe"></i> <a
                                                        href="https://www.mayfaireducation.global"
                                                        target="_blank">WWW.MAYFAIREDUCATION.GLOBAL</a>
                                                </div>
                                                <div class="location">
                                                    📍 Vindi 9-2, Kristiine, Tallinn 11315, Estonia
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- page 5  --}}

                                    <div class="my-2" style="height: 1450px;">
                                        <div class="header d-flex justify-content-between mx-auto"
                                            style="width: 80%;">
                                            <div>
                                                <img src="{{ asset('backend/assets/images/new_logo.png') }}"
                                                    alt="{{ env('APP_NAME') }}" width="250px">
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center">
                                                    <i style="background-color: #824fa3; color: white; padding: 10px;border-radius: 50%;"
                                                        class="fa fa-phone"></i>
                                                    <p style="font-size: 18px; font-weight: bold; color: #824fa3;margin-left: 11px; margin-top: 10px;"
                                                        class="">+ 372 5870 0600</p>
                                                </div>

                                                <div style="color: #824fa3" class="d-flex mt-3">
                                                    <i style="font-size: 28px;" class="fa-solid fa-envelope"></i>
                                                    <p style="font-size: 18px; font-weight: bold;margin-left: 22px;">
                                                        edu.mayfair@gmail.com</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="background-color: #824fa3; height: 3px;">

                                        <div class="destination-fee">



                                            <div class="" style="list-style: none;">
                                                <li>20. The Parties shall timely negotiate over resolutions and remedial
                                                    measures in respect of the
                                                    impact caused by force majeure. The impacted party shall try to take
                                                    reasonable measures to
                                                    minimize the losses that may be suffered by the other party;
                                                    otherwise the impacted party shall
                                                    compensate for the losses as expanded therefore
                                                </li>
                                            </div>


                                            <div>
                                                <p><strong>(VI)Supplementation, Alteration and Modification of this
                                                        Agreement</strong></p>

                                                <div class="" style="list-style: none;">
                                                    <li>21. Any supplementation, alteration or modification of this
                                                        Agreement shall be made in the form of
                                                        written supplementary agreement. Such supplementary agreement
                                                        shall bear the same legal force
                                                        as this Agreement upon being signed by the Parties.
                                                    </li>

                                                </div>

                                            </div>

                                            <div>
                                                <p><strong>(V) Force Majeure</strong></p>

                                                <div class="" style="list-style: none;">
                                                    <li>22. If either party is prevented from performing this Agreement
                                                        due to force majeure, it shall
                                                        immediately send a notice to the other party, stating the date
                                                        of occurrence, nature, estimated
                                                        duration of the force majeure and the impact on the performance
                                                        of this Agreement by the
                                                        impacted party, and shall provide a proof within 7 days after
                                                        the date of occurrence of force
                                                        majeure.
                                                    </li>

                                                </div>

                                            </div>

                                            <div>
                                                <p><strong>(VII) Effectiveness and Termination</strong></p>

                                                <div class="" style="list-style: none;">
                                                    <li>23. This Agreement shall become effective upon being signed and
                                                        sealed by Party A or his/her
                                                        custodian and Party B. 23. This Agreement is made in two
                                                        originals of the same legal force, one for
                                                        each party hereto. 24. This Agreement shall be terminated as
                                                        soon as the Parties have completed all
                                                        of their respective rights and obligations hereunder.
                                                    </li>

                                                </div>

                                            </div>


                                        </div>


                                        <div class="d-flex justify-content-between lastFooter">
                                            <div class="partyA">
                                                <p> <strong>Party A:</strong> MD. ANOWAR HOSSAIN</p>
                                                <p class="mt-3"> <strong>Passport Number:</strong> A07766278</p>
                                                <p class="mt-2"> <strong>Permanent Address:</strong> ABDUL HAKIMS
                                                    HOME, PAGAR, ABUL
                                                    HOSSAIN ROAD, TONGI EAST, MONNU NAGAR - 1710,
                                                    GAZIPUR
                                                </p>
                                                <div class="d-flex mt-5" style="width: 500px;">
                                                    <p>Signnature: </p>
                                                    <p class="ms-3">Date: </p>
                                                </div>
                                            </div>
                                            <div class="partyB">
                                                <p> <strong>Party B:
                                                        Mohammed Nurul Islam Khan
                                                        Mayfair Global Education
                                                        (A concern of MAYFAIR GLOBAL
                                                        OÜ | Registry code: 14679610)
                                                        Vindi 9-2, Tallinn-11315, Estonia</strong></p>
                                                <div class="d-flex mt-5" style="width: 300px;">
                                                    <p>Signnature: </p>
                                                    <p class="ms-3">Date: </p>
                                                </div>
                                            </div>
                                        </div>





                                        <hr class="mt-4"
                                            style="background-color: #824fa3; height: 3px; margin: 0px;">
                                        <div class="footer">
                                            <div class="footer-container">
                                                <div class="footer-section">
                                                    <div class="logo">
                                                        <img src="your-logo.png" alt="Logo">
                                                    </div>
                                                    <div class="company-info">
                                                        <h6>Estonia:</h6>
                                                        <h6>VAT No.: EE14679610</h6>
                                                        <h6>Registration No.: 14679610</h6>
                                                    </div>
                                                    <div class="divider"></div>
                                                    <div class="company-info">
                                                        <h6>Bangladesh:</h6>
                                                        <h6>Registration No.: TRAD/DSCC/ <br>005945/2021</h6>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="footer-bottom">
                                                <div class="website">
                                                    <i class="fa-solid fa-globe"></i> <a
                                                        href="https://www.mayfaireducation.global"
                                                        target="_blank">WWW.MAYFAIREDUCATION.GLOBAL</a>
                                                </div>
                                                <div class="location">
                                                    📍 Vindi 9-2, Kristiine, Tallinn 11315, Estonia
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- @include('Backend.components.footer') --}}
            </div>
        </div>
    </div>

    @include('Backend.components.script')
</body>

</html>
