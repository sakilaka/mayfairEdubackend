<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Success</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    @php
        $results = \App\Models\Tp_option::where('option_name', 'theme_color')->first();
        $dataObj = json_decode($results->option_value);
    @endphp
    <style>
        :root {
            --primary_background: {{ $theme_color['primary_color'] ?? '#068b76' }};
            --secondary_background: {{ $theme_color['secondary_color'] ?? '#068b76' }};
            --tertiary_background: {{ $theme_color['tertiary_color'] ?? '#f40000' }};

            --btn_primary_color: var(--secondary_background);
            --btn_primary_hover_color: var(--primary_background);

            --btn_secondary_color: var(--primary_background);
            --btn_secondary_hover_color: var(--secondary_background);

            --btn_tertiary_color: var(--tertiary_background);
            --btn_tertiary_hover_color: {{ '#c10000' }};

            --section_background: {{ '#f2fafe' }};
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

        .fw-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        Application Has Submitted
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('upload/icons/correct.png') }}" alt="" width="100">
                        </div>
                        <h2 class="text-center text-success mt-4 fw-bold">Congratulations!</h2>
                        <h5 class="text-center text-dark mt-2 fw-bold">Application ID:
                            {{ $application->application_code }}</h5>
                        <div class="alert alert-success text-center mt-3" role="alert">
                            Your application has been successfully submitted. Please wait, we will respond as soon as
                            possible. Thank you.
                        </div>
                    </div>
                    <div class="card-footer text-center d-md-flex justify-content-md-between">
                        <a href="{{ route('frontend.application-form-download', ['id' => $application->id]) }}"
                            class="btn btn-secondary-bg mt-2 mt-md-0">
                            Download Application
                        </a>

                        @php
                            $partnerRef = session('partner_ref_id') ?? request()->query('partner_ref_id');
                            $appliedBy = session('applied_by') ?? request()->query('applied_by');

                            $course_list_url_params = [
                                'partner_ref_id' => $partnerRef,
                                'applied_by' => $appliedBy,
                            ];

                            if (session('is_anonymous')) {
                                $course_list_url_params['is_anonymous'] = 'true';
                            }

                            $course_list_url = route('frontend.university_course_list', $course_list_url_params);
                        @endphp
                        <a href="{{ $course_list_url }}" class="btn btn-primary-bg mt-2 mt-md-0">
                            Apply For New
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
