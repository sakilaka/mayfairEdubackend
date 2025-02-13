<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Appliction-Invoice-{{ $orderdetails->application_code }}</title>

    <style>
        li {
            font-size: 0.9rem;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                margin: 0 !important;
            }

            .badge {
                border: 0;
            }

            .card {
                box-shadow: none;
            }
        }
         li {
            font-size: 0.9rem;
        }

        .text {
            font-size: 16px;
        }

        h6 {
            font-weight: bold;
        }

        .custom-bg {
            position: relative;
            height: 330px;
            background: linear-gradient(rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 1)),
                url("{{ asset('backend/assets/images/fav.png') }}") no-repeat center center;
            background-size: auto 106%;
        }

        .bank-details {
            display: flex;
            align-items: center;
            border-top: 2px solid black;
            padding: 10px;
        }

        .qr-section {
            text-align: center;
            margin-right: 20px;
        }

        .qr-section img {
            width: 150px;
            height: 150px;
        }

        .info-section {
            flex: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        td {
            padding: 5px;
        }

        p {
            margin: 2px 0;
        }

        .tagline {
            font-size: 1.2rem;
            font-weight: bold;
            text-align: center;
        }
    </style>

    <script>
        function handlePrint() {
            history.back();
        }

        window.addEventListener('afterprint', handlePrint);
        window.print();
    </script>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">

            <div class="main-panel m-auto">
                <div class="content-wrapper bg-white">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card px-2">

                                @php
                                    $exchangeRate = 125.91; // Example rate, make this dynamic if needed
                                    $vatAmount =
                                        ($transactionDetails->vat / 100) *
                                        $transactionDetails->price_per_item *
                                        $transactionDetails->amount;
                                    $totalAmount =
                                        $vatAmount + $transactionDetails->price_per_item * $transactionDetails->amount;
                                    $totalEUR = $totalAmount / $exchangeRate;
                                @endphp


                                <div class="card-body">
                                    <div>
                                        <img src="{{ asset('backend/assets/images/new_logo.png') }}"
                                            alt="{{ env('APP_NAME') }}" width="250px">
                                    </div>

                                    <div class="mt-2 d-flex justify-content-between" style="width: 92%;">
                                        <div class="">
                                            <div>
                                                <h6 class="">Head Office Address:</h6>
                                                <p class="text">Vindi 9-2, Kristiine, Tallinn, 11315, Estonia</p>
                                            </div>

                                            <div class="mt-3">
                                                <h6>Bangladesh office address:</h6>
                                                <p class="text">House-14/16, apartment-401, Third Floor, Road no-5,
                                                    Block-B, <br>
                                                    Mirpur-10,
                                                    Dhaka-1216, Bangladesh.</p>
                                            </div>
                                            <div class="mt-3">
                                                <h6>Student Name: {{ $orderdetails->full_name }}</h6>
                                                {{-- <p class="text mt-2">Bangladesh</p> --}}
                                            </div>
                                            <div class="mt-3">
                                                <h6>Bangladesh office address:</h6>
                                                <p class="text">ABDUL HAKIMS HOME, PAGAR, ABUL <br>
                                                    HOSSAIN ROAD, TONGI EAST, MONNU NAGAR - 1710,
                                                    GAZIPUR</p>
                                            </div>
                                            <div class="mt-2">
                                                <p class="text">Study Destination : Finland</p>
                                                <p class="text">File Number: MGE-2025-108</p>
                                            </div>
                                        </div>

                                        <div class="me-4">
                                            <h1 class="mb-2">Invoice</h1>
                                            <div class="mt-5 d-flex" style="font-size: 16px;">
                                                <p
                                                    style="font-weight: bold; margin-right: 5px; font-size: 16px; width: 170px;">
                                                    Invoice Date:</p>
                                                <p style="font-size: 16px;">{{ $transactionDetails->created_at }}</p>
                                            </div>
                                            <div class="my-2 d-flex" style="font-size: 16px;">
                                                <p
                                                    style="font-weight: bold; margin-right: 5px; font-size: 16px; width: 170px;">
                                                    Invoice Number:</p>
                                                <p style="font-size: 16px;">{{ $transactionDetails->in_number }}</p>
                                            </div>
                                            <div class="my-2 d-flex" style="font-size: 16px;">
                                                <p
                                                    style="font-weight: bold; margin-right: 5px; font-size: 16px; width: 170px;">
                                                    Our Reference:</p>
                                                <p style="font-size: 16px;">info@mayfairedu.global</p>
                                            </div>
                                            <div class="my-2 d-flex" style="font-size: 16px;">
                                                <p
                                                    style="font-weight: bold; margin-right: 5px; font-size: 16px; width: 170px;">
                                                    Customer Number:</p>
                                                <p style="font-size: 16px;">{{ $transactionDetails->customer_number }}
                                                </p>
                                            </div>
                                            <div class="my-2 d-flex" style="font-size: 16px;">
                                                <p
                                                    style="font-weight: bold; margin-right: 5px; font-size: 16px; width: 170px;">
                                                    Invoice Due Date:</p>
                                                <p style="font-size: 16px;">{{ $transactionDetails->in_due_date }}</p>
                                            </div>
                                            <div class="my-2 d-flex" style="font-size: 16px;">
                                                <p
                                                    style="font-weight: bold; margin-right: 5px; font-size: 16px; width: 170px;">
                                                    Payment Reference:</p>
                                                <p style="font-size: 16px;">10004075</p>
                                            </div>
                                            <div class="my-2 d-flex" style="font-size: 16px;">
                                                <p
                                                    style="font-weight: bold; margin-right: 5px; font-size: 16px; width: 170px;">
                                                    Term Of Payment:</p>
                                                <p style="font-size: 16px;">Within 3 Days Due Net</p>
                                            </div>
                                            <div class="my-2 d-flex" style="font-size: 16px;">
                                                <p
                                                    style="font-weight: bold; margin-right: 5px; font-size: 16px; width: 170px;">
                                                    Penalty Interest:</p>
                                                <p style="font-size: 16px;">11.5%</p>
                                            </div>
                                            <div class="my-2 d-flex" style="font-size: 16px;">
                                                <p
                                                    style="font-weight: bold; margin-right: 5px; font-size: 16px; width: 170px;">
                                                    Time of Remarks:</p>
                                                <p style="font-size: 16px;">72 hours</p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="mt-5">
                                        <hr class="m-0">
                                        <table class="table table-striped" style="">
                                            <thead>
                                                <tr class="">
                                                    <th class="">SL</th>
                                                    <th class="">Item</th>
                                                    <th class="">Product/Service</th>
                                                    <th class="">Amount</th>
                                                    <th class="">Price per item</th>
                                                    <th class="">Vat- %</th>
                                                    <th class="">Vat amount</th>
                                                    <th class="">Total In EURO</th>
                                                    <th class="">Total In BDT</th>
                                                </tr>
                                            </thead>

                                            <tbody class="">
                                                <tr class="">
                                                    <td>1</td>
                                                    <td class="" style="font-weight: bold">
                                                        {{ $orderdetails->program_name }}</td>
                                                    <td class="" style="font-weight: bold">
                                                        {{ $transactionDetails->category }}</td>
                                                    <td class="" style="font-weight: bold">
                                                        {{ $transactionDetails->amount }}</td>
                                                    <td class="" style="font-weight: bold">
                                                        {{ $transactionDetails->price_per_item }}</td>
                                                    <td class="" style="font-weight: bold">
                                                        {{ $transactionDetails->vat }}</td>
                                                    <td class="" style="font-weight: bold">
                                                        {{ $vatAmount }}
                                                    </td>
                                                    <td class="" style="font-weight: bold">
                                                        {{ number_format($totalEUR, 2) }}</td>
                                                    <td class="" style="font-weight: bold">
                                                        {{ $totalAmount }}
                                                    </td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>

                                    <div class="custom-bg">
                                        <div class="d-flex justify-content-between p-5">
                                            <p class="text">Invoice Total</p>
                                            <p class="text">
                                                {{ $totalAmount }}
                                            </p>
                                        </div>

                                        <div class="d-flex justify-content-between p-5">
                                            <p class="text">Total</p>
                                            <p>Vat (%)</p>
                                            <div>
                                                <p>Price incl.tax</p>
                                                <p>{{ $transactionDetails->price_per_item }}</p>
                                            </div>
                                            <div>
                                                <p>Vat</p>
                                                <p>{{ $transactionDetails->vat }}</p>
                                            </div>
                                            <div>
                                                <p>Total</p>
                                                <p>{{ $totalAmount }}
                                                </p>
                                            </div>
                                            <p class="text">
                                                {{ $totalAmount }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="my-3">
                                        <p class="text" style="font-weight: bold;">Reminder fee 100.00 EURO, In
                                            12,591
                                            BDT</p>
                                        <p class="text" style="font-weight: bold;">In Word: One hundred euro, Twelve
                                            thousand five hundred ninety-one</p>
                                    </div>

                                    <hr>

                                    <div class="bank-details">
                                        <div class="qr-section">
                                            <h5>SCAN FOR BANK DETAILS</h5>
                                            <img src="{{ asset('backend/assets/images/QRcode.png') }}"
                                                alt="QR Code">
                                        </div>

                                        <div class="info-section">
                                            <table>
                                                <tr>
                                                    <td><strong>Telephone</strong></td>
                                                    <td>+372 58700 600 <br> +372 5699 8641</td>
                                                    <td><strong>Business Identity Code</strong></td>
                                                    <td>14679610</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>WWW-address</strong></td>
                                                    <td>www.mayfaireducation.global</td>
                                                    <td><strong>VAT-number</strong></td>
                                                    <td>14679610</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>e-mail</strong></td>
                                                    <td>info@mayfaireducation.global</td>
                                                    <td><strong>Locality</strong></td>
                                                    <td>Tallinn</td>
                                                </tr>
                                            </table>
                                            <p>
                                                <strong>Bangladesh:</strong> +8801898878100,
                                                <strong>Pakistan:</strong> +923131203868,
                                                <strong>Egypt:</strong> +201029600802
                                            </p>
                                            <p>
                                                <strong>Nigeria:</strong> +2347035795956,
                                                <strong>Turkiye:</strong> +905555710610,
                                                <strong>India:</strong> +91997198065
                                            </p>
                                            <p class="tagline mt-3"><em>Your Trusted Global Education Consultancy
                                                    Firm</em>
                                            </p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('Backend.components.script')
</body>

</html>
