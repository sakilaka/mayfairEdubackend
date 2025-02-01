@extends('Frontend.layouts.master-layout')
@section('title', ' - All Universities')

@section('head')

    <link
        href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/application-bootstrap.css"
        rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/css/intlTelInput.css">
    <!-- Add this in your HTML head section -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />


@endsection

@section('main_content')
    <div class="container" style="margin-top:8rem;">

        <div class="main position-relative mb-md-5 col-lg-8 mx-auto">
            <div class="content__inner application_forms">
                <h3 class="text-center mb-4">Your Application</h3>

                <form id="multiStepForm" action="{{ route('application.personalUni') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Progress Bar -->

                    <div class="progress-container">
                        <!-- Progress Active Line -->
                        <div class="progress-line"></div>

                        <div class="progress-step-container">
                            <div class="progress-step active"></div>
                            <div class="progress-title active">Your Information</div>
                        </div>

                        <div class="progress-step-container">
                            <div class="progress-step"></div>
                            <div class="progress-title">Your Family</div>
                        </div>

                        <div class="progress-step-container">
                            <div class="progress-step"></div>
                            <div class="progress-title">Upload Documents</div>
                        </div>

                    </div>

                    <!-- Panels -->
                    <div class="multisteps-form__form">
                        <!-- Panel 1: Your Information -->
                        <div class="multisteps-form__panel js-active" data-step="1">
                            <div class="form-group">
                                <label for="university">Select University</label>
                                <select class="form-control" name="university[]" id="university" multiple required>
                                    <option value="China University of Petroleum, Beijing">China University of Petroleum, Beijing</option>
                                    <option value="Beihang University">Beihang University</option>
                                    <option value="Harbin Engineering University">Harbin Engineering University</option>
                                </select>
                                <span class="error-message text-danger d-none">Please select at least one university.</span>
                            </div>


                            <div class="text-end">
                                <button class="btn btn-primary js-btn-next mt-4" type="button">Next</button>
                            </div>
                        </div>

                        <!-- Panel 2: Your Family -->
                        <div class="multisteps-form__panel" data-step="2">
                            @include('Frontend.university.apply-parts-university.family-panel')
                            <div class="d-flex justify-content-between mt-3">
                                <button class="btn btn-secondary js-btn-prev" type="button">Previous</button>
                                <button class="btn btn-primary js-btn-next" type="button">Next</button>
                            </div>
                        </div>

                        <!-- Panel 3: Upload Documents -->
                        <div class="multisteps-form__panel" data-step="3">
                            @include('Frontend.university.apply-parts-university.document-panel')
                            <div class="d-flex justify-content-between mt-3">
                                <button class="btn btn-secondary js-btn-prev" type="button">Previous</button>
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

<script src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/application.js">
</script>

<script src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/wnoty.js"></script>

<script
    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/application_details.js">
</script>
<script src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/new_application_d.js">
</script>

<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/js/intlTelInput.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const phoneInputs = document.querySelectorAll(".phone-input");

        phoneInputs.forEach((input) => {
            const output = document.createElement('div');
            output.className = 'validation-output';
            input.parentNode.insertBefore(output, input.nextSibling);

            const iti = window.intlTelInput(input, {
                initialCountry: "auto",
                nationalMode: true,
                geoIpLookup: callback => {
                    fetch("https://ipapi.co/json")
                        .then(res => res.json())
                        .then(data => callback(data.country_code.toLowerCase()))
                        .catch(() => callback("bd"));
                },
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/js/utils.js"
            });

            const handleChange = () => {
                let text = "";
                if (input.value) {
                    if (iti.isValidNumber()) {
                        text = `Valid number detected. International format: ${iti.getNumber()}`;
                        output.classList.remove('text-danger');
                        output.classList.add('text-success');
                    } else {
                        text = "Please enter a valid number";
                        output.classList.remove('text-success');
                        output.classList.add('text-danger');
                    }
                } else {
                    text = "Please enter a valid number";
                    output.classList.remove('text-success');
                    output.classList.add('text-danger');
                }
                output.innerHTML = text;
            };

            input.addEventListener('change', handleChange);
            input.addEventListener('keyup', handleChange);
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("multiStepForm");
        const panels = document.querySelectorAll('.multisteps-form__panel');
        const progressSteps = document.querySelectorAll('.progress-step');
        const progressLine = document.querySelector('.progress-line');
        const nextButtons = document.querySelectorAll('.js-btn-next');
        const prevButtons = document.querySelectorAll('.js-btn-prev');

        let currentStep = 0;

        // Function to Show Active Panel
        function showPanel(step) {
            panels.forEach((panel, index) => {
                panel.classList.toggle('js-active', index === step);
            });
            updateProgress();
        }

        // Update Progress Bar
        function updateProgress() {
            progressSteps.forEach((step, index) => {
                if (index <= currentStep) {
                    step.classList.add('active');
                } else {
                    step.classList.remove('active');
                }
            });

            const totalSteps = progressSteps.length - 1;
            const progressWidth = (currentStep / totalSteps) * 100;
            progressLine.style.width = progressWidth + '%';
        }

        // Validate Fields in Current Panel
        function validatePanelFields(step) {
            const currentPanel = panels[step];
            const requiredFields = currentPanel.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach((field) => {
                let value = field.value.trim();

                if (field.tagName === 'SELECT') {
                    value = Array.from(field.selectedOptions).map(option => option.value).filter(val =>
                        val !== "").length > 0;
                }

                if (!value) {
                    isValid = false;
                    field.classList.add('border-danger'); // Add red border
                    const errorMessage = field.closest('.form-group')?.querySelector('.error-message');
                    if (errorMessage) {
                        errorMessage.classList.remove('d-none'); // Show error message
                    }
                } else {
                    field.classList.remove('border-danger');
                    const errorMessage = field.closest('.form-group')?.querySelector('.error-message');
                    if (errorMessage) {
                        errorMessage.classList.add('d-none'); // Hide error message
                    }
                }
            });

            return isValid;
        }

        // Next Button Click
        nextButtons.forEach((button) => {
            button.addEventListener('click', function() {
                if (validatePanelFields(currentStep)) {
                    if (currentStep < panels.length - 1) {
                        currentStep++;
                        showPanel(currentStep);
                    }
                } else {
                    alert("Please fill in all required fields before proceeding.");
                }
            });
        });


        // Previous Button Click
        prevButtons.forEach((button) => {
            button.addEventListener('click', function() {
                if (currentStep > 0) {
                    currentStep--;
                    showPanel(currentStep);
                }
            });
        });

        // Initial Setup
        showPanel(currentStep);
    });

    // Dropdown Logic for Extra Fields
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownEnglish = document.getElementById('english_certificate');
        const extraFieldsEnglish = document.getElementById('extra-fields');

        dropdownEnglish.addEventListener('change', function() {
            extraFieldsEnglish.style.display = this.value ? 'block' : 'none';
        });

        const dropdownChinese = document.getElementById('chinese_level');
        const extraFieldsChinese = document.getElementById('extra-fields-chinese');

        dropdownChinese.addEventListener('change', function() {
            extraFieldsChinese.style.display = this.value ? 'block' : 'none';
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#university').select2(); // Apply Select2 to your multi-select
    });
</script>



<script>
    document.addEventListener("DOMContentLoaded", () => {
        let educationIndex = 0;

        // Add new education field
        document.getElementById("add-education").addEventListener("click", () => {
            educationIndex++;
            const educationContainer = document.getElementById("education-container");
            const newField = document.querySelector(".education-fields").cloneNode(true);

            // Update field names and placeholders
            newField.setAttribute("data-index", educationIndex);
            newField.innerHTML = newField.innerHTML.replace(/\[0\]/g, `[${educationIndex}]`);
            newField.querySelectorAll("input, select").forEach(input => {
                input.value = "";
            });

            // Append new field
            educationContainer.appendChild(newField);
        });

        // Remove education field
        document.getElementById("education-container").addEventListener("click", (e) => {
            if (e.target.classList.contains("remove-education")) {
                e.target.closest(".education-fields").remove();
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        let workIndex = 0;

        // Add new work experience field
        document.getElementById("add-work-experience").addEventListener("click", () => {
            workIndex++;
            const workContainer = document.getElementById("work-experience-container");
            const newField = document.querySelector(".work-experience-fields").cloneNode(true);

            // Update field names and placeholders
            newField.setAttribute("data-index", workIndex);
            newField.innerHTML = newField.innerHTML.replace(/\[0\]/g, `[${workIndex}]`);
            newField.querySelectorAll("input").forEach(input => {
                input.value = ""; // Clear existing values
            });

            // Append new field
            workContainer.appendChild(newField);
        });

        // Remove work experience field
        document.getElementById("work-experience-container").addEventListener("click", (e) => {
            if (e.target.classList.contains("remove-work-experience")) {
                e.target.closest(".work-experience-fields").remove();
            }
        });
    });
</script>

<style>
    .error {
        border: 2px solid red;
    }

    .error-message {
        display: none;
        color: red;
        font-size: 0.875em;
        margin-top: 5px;
    }

    .error-message.visible {
        display: block;
    }


    /* Progress Bar Container */
    .progress-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        width: 100%;
        margin: 50px auto;
    }

    /* Full Grey Line */
    .progress-container::before {
        content: "";
        position: absolute;
        top: 21%;
        left: 10px;
        /* Offset for circle width */
        width: calc(100% - 20px);
        /* Offset both sides for perfect alignment */
        height: 3px;
        background-color: #ccc;
        transform: translateY(-50%);
        z-index: 0;
    }

    /* Active Progress Line */
    .progress-line {
        position: absolute;
        top: 21%;
        left: 10px;
        /* Offset to align with the circles */
        width: 0;
        /* Dynamically set based on progress */
        height: 3px;
        background-color: var(--secondary_background);
        transform: translateY(-50%);
        z-index: 1;
        transition: width 0.3s ease-in-out;
    }

    /* Step Circle */
    .progress-step-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .progress-step {
        position: relative;
        z-index: 2;
        width: 20px;
        height: 20px;
        background-color: #fff;
        border: 3px solid #ccc;
        border-radius: 50%;
    }

    .progress-step.active {
        border-color: var(--secondary_background);
        background-color: var(--secondary_background);
    }

    /* Step Title (Text under the circle) */
    .progress-title {
        margin-top: 8px;
        font-size: 12px;
        color: #aaa;
        text-align: center;
    }

    .progress-title.active {
        color: var(--secondary_background);
    }

    .multisteps-form__panel {
        display: none;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .multisteps-form__panel.js-active {
        display: block;
    }

    .multisteps-form__panel {
        display: none;
    }
</style>
