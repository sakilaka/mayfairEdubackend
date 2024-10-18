<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} | Expo Ticket - {{ $expoData['ticket_no'] }}</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300italic,regular,italic,700,700italic&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin,latin-ext,vietnamese">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin,latin-ext,vietnamese">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&amp;subset=latin,latin-ext,vietnamese">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Barlow+Condensed:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&amp;subset=latin,latin-ext,vietnamese">

    <link rel="stylesheet" href="{{ asset('frontend/expo-domain/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/expo-domain/css/site.css') }}">

    <style>
        :root {
            --primary_background: #0c4493;
            --secondary_background: #58b135;
            --tertiary_background: #c0392b;

            --btn_primary_color: var(--secondary_background);
            --btn_primary_hover_color: var(--primary_background);

            --btn_secondary_color: var(--primary_background);
            --btn_secondary_hover_color: var(--secondary_background);

            --btn_tertiary_color: var(--tertiary_background);
            --btn_tertiary_hover_color: {{ '#c10000' }};
        }

        /* assign btn theme for this site */
        .btn-primary-light-bg {
            background-color: var(--btn_primary_color) !important;
            color: white !important;
        }

        .btn-primary-bg {
            background-color: var(--btn_primary_color) !important;
            color: white !important;
            font-family: 'DM Sans', sans-serif !important;
        }

        .btn-primary-bg:hover {
            background-color: var(--btn_primary_hover_color) !important;
        }

        .btn-secondary-bg {
            background-color: var(--btn_secondary_color) !important;
            color: white !important;
            font-family: 'DM Sans', sans-serif !important;
        }

        .btn-secondary-bg:hover {
            background-color: var(--btn_secondary_hover_color) !important;
        }

        .btn-tertiary-bg {
            background-color: var(--btn_tertiary_color) !important;
            color: white !important;
            font-family: 'DM Sans', sans-serif !important;
        }

        .btn-tertiary-bg:hover {
            background-color: var(--btn_tertiary_hover_color) !important;
        }

        html,
        body {
            height: 100%;
            margin: 0;
        }

        .container-wrapper {
            /* height: 100vh; */
            display: flex;
            align-items: center;
            justify-content: center;
            /* background-image: url('{{ asset('frontend/expo-domain/images/rectangle_1.png') }}'); */
        }

        .ticket-container {
            width: 80%;
            max-width: 1200px;
        }

        .card-red-pattern-bg {
            width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
            border-radius: 25px;
        }

        .card-red-pattern-bg::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(255, 255, 255, 0.35), rgba(255, 255, 255, 0.35)),
                url('{{ asset('frontend/images/logo/bottom-objects.png') }}');
            background-position: bottom;
            background-repeat: no-repeat;
            background-size: cover;
            z-index: 1;
            opacity: 1;
        }

        .card-red-pattern-bg .card-title,
        .card-red-pattern-bg .card-body {
            position: relative;
            z-index: 2;
        }

        .wrapper-title {
            font-size: 38px;
            font-weight: 600;
        }

        .user-details {
            padding: 20px;
        }

        .bottom-logo img {
            max-width: 250px;
            opacity: 0.9;
        }

        .ticket-number {
            font-weight: 600;
            color: rgb(0, 0, 0);
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .minimal-shadow {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.15);
        }

        .qrcode-container {
            margin-right: 70px;
        }

        /* Printing styles specifically for A4 paper */
        @media print {

            @page {
                size: A4 landscape;
                margin: 0;
            }

            body,
            html {
                width: 11.69in;
                height: 100%;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .container-wrapper {
                height: 97.5vh;
                margin: 0 auto;
                padding: 0;
                display: block;
            }

            .navbar-container {
                display: none;
            }

            #download-pdf {
                display: none !important;
            }

            #print-pdf {
                display: none !important;
            }

            .ticket-container {
                width: 90%;
                max-width: 100%;
            }

            .card-red-pattern-bg {
                width: 100%;
                height: 100%;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .bottom-logo {
                bottom: 15mm;
            }

            .card-body {
                break-inside: avoid;
                page-break-inside: avoid;
            }

            .qrcode-container {
                margin-right: 80px;
            }
        }
    </style>
</head>

<body>
    <div class="bg-section" id="ticket-page">
        @if (!request()->has('print'))
            <div class="navbar-container" id="navbar-container">
                <nav class="navbar navbar-expand-md shadow-none" style="z-index: 3">
                    <div class="container d-flex justify-content-between">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <img src="{{ asset('frontend/expo-domain/images/vector_smart_object_3.png') }}"
                                alt="Logo" class="logo">
                        </a>

                        @include('Expo.components.navbar')
                    </div>
                </nav>

                <div class="bg-color"></div>
            </div>
        @endif

        <div class="container-wrapper d-flex flex-column align-items-center justify-content-center">
            @if (!request()->has('print'))
                <div class="d-flex">
                    <button id="download-pdf" class="btn btn-primary-bg mb-3 me-2" style="z-index: 3">Download</button>
                    <button id="print-pdf" class="btn btn-primary-bg mb-3" style="z-index: 3">Print</button>
                </div>
            @endif

            <div class="container ticket-container d-flex align-items-center justify-content-center">
                <div class="card card-red-pattern-bg" style="border-radius: 25px">
                    <div class="card-body shadow border-0">
                        <div class="row justify-content-between" style="margin-bottom: 8rem">

                            <div class="col-7 d-flex flex-column justify-content-around">
                                <div class="row align-items-center justify-content-between mt-3">
                                    <div class="col-6 d-flex align-items-center">
                                        <img src="{{ asset('frontend/images/studyinchina-logo.png') }}" alt=""
                                            class="img-fluid me-4" width="130">
                                        <img src="{{ asset('frontend/images/logo/malishaedu-logo.png') }}"
                                            alt="" class="img-fluid" width="90">
                                    </div>
                                    <div class="col-6 text-end">
                                        <img src="{{ asset('frontend/images/logo/study-in-china-exhibition-color.png') }}"
                                            alt="" class="img-fluid me-5" width="170">
                                    </div>
                                </div>

                                <div class="row justify-content-between">
                                    <div class="col-8 user-details ps-4">
                                        <h3 class="wrapper-title">Entry Pass</h3>
                                        <p class="text-dark mb-1"><strong>Name:</strong>
                                            {{ $expoData['first_name'] . ' ' . $expoData['last_name'] }}</p>
                                        <p class="text-dark mb-1"><strong>Profession:</strong>
                                            {{ $expoData['profession'] }}
                                        </p>
                                        <p class="text-dark mb-1"><strong>Contact No:</strong> {{ $expoData['phone'] }}
                                        </p>
                                        <p class="text-dark mb-1"><strong>Nationality:</strong>
                                            {{ $expoData['nationality'] }}</p>
                                    </div>

                                    <div class="col-4 qr-container ps-0 text-left mt-4">
                                        <div class="barcode text-left">
                                            @php
                                                $qr_code_data = implode('; ', [
                                                    'Ticket No: ' . $expoData['ticket_no'],
                                                    'Name: ' . $expoData['first_name'] . ' ' . $expoData['last_name'],
                                                    'DOB: ' . $expoData['dob'],
                                                    'Nationality: ' . $expoData['nationality'],
                                                    'Phone: ' . $expoData['phone'],
                                                    'Email: ' . $expoData['email'],
                                                    'ID Type: ' . $expoData['id_type'],
                                                    'ID No: ' . $expoData['id_no'],
                                                ]);
                                            @endphp
                                            <div class="text-center qrcode-container {{-- me-5 --}}">
                                                <img src="{{ \App\Helpers\QrCodeHelper::generateQrCode($qr_code_data) }}"
                                                    alt="QR code" width="130" class="img-fluid">
                                                <p class="ticket-number">
                                                    #{{ $expoData['ticket_no'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-5">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="mt-3">
                                        <img src="{{ asset('frontend/images/logo/cscse-color-2.png') }}" alt=""
                                            class="img-fluid" width="380">
                                    </div>
                                    <div class="mt-5">
                                        <p class="text-dark text-center minimal-shadow">
                                            <span class="fw600">Organizer:</span>
                                            {{ $organizerDetails['name'] }}
                                            <br>
                                            <span class="fw600">Co-Organizer:</span>
                                            {{ $co_organizerDetails['name'] }}
                                            <br>

                                            <span class="fw600">Supported by:</span>
                                            Embassy of the People’s Republic of China in the People’s Republic of
                                            Bangladesh
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>

    <script>
        function generatePdf() {
            var element = document.getElementById('ticket-page');
            var downloadButton = document.getElementById('download-pdf');
            var printButton = document.getElementById('print-pdf');

            downloadButton.style.display = 'none';
            printButton.style.display = 'none';

            var isSmallDevice = window.innerWidth < 768;
            var pdfHeight = isSmallDevice ? '8in' : '100%';

            var opt = {
                margin: [0, 0, 0, 0],
                filename: 'Expo Ticket - ' + '{{ $expoData['ticket_no'] }}' + '.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    useCORS: true,
                    logging: false
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'landscape'
                }
            };

            var style = document.createElement('style');
            style.innerHTML = `
            @page { size: A4 landscape; margin: 0; }
            html, body {
                width: 11.69in;
                height: ${pdfHeight};
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                overflow: hidden;
            }
            .container-wrapper {
                width: 11.69in;
                height: ${pdfHeight};
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 0;
            }
            .navbar-container { display: none; }
            .ticket-container { width: 100%; }
            .card-red-pattern-bg { width: 100%; height: auto; }
            .card-body { break-inside: avoid; page-break-inside: avoid; }
        `;
            document.head.appendChild(style);

            html2pdf().from(element).set(opt).save().then(function() {
                document.head.removeChild(style);
                downloadButton.style.display = 'block';
                printButton.style.display = 'block';

                window.close();
            });
        }

        function handlePrint() {
            window.addEventListener('afterprint', function() {
                window.close();
            });
            window.print();
        }

        // Check request parameters for 'print' or 'download'
        window.onload = function() {
            var urlParams = new URLSearchParams(window.location.search);
            var downloadButton = document.getElementById('download-pdf');
            var printButton = document.getElementById('print-pdf');

            if (urlParams.has('print')) {
                handlePrint();
            } else if (urlParams.has('download')) {
                generatePdf();
            }

            if (downloadButton) {
                downloadButton.addEventListener('click', function() {
                    generatePdf();
                });
            }

            if (printButton) {
                printButton.addEventListener('click', function() {
                    handlePrint();
                });
            }
        };
    </script>
</body>

</html>
