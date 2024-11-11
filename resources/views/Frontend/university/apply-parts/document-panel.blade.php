<!-- Supporting Documents Panel -->
<div id="supportdocs">
    <style>
        #required-attachments::-webkit-scrollbar {
            width: 0px !important;
        }
    </style>
    <!-- Single Form Panel -->
    <div id="required-attachments" class="multisteps-form__panel shadow-lg p-4 rounded bg-white" data-animation="scaleIn"
        style="height: 100%; max-height: 1000px; overflow-y: auto;">
        <h4 class="multisteps-form__title my-2">Upload Your Application Documents</h4>

        <!-- Bachelor/Language/Diploma Degree Section -->
        {{-- <div class="d-flex align-items-center gap-2 ms-3 mt-5">
            <input type="checkbox" id="bachelor-checkbox" onchange="toggleFileUpload('bachelor-upload')">
            <h5 class="mt-2">Bachelor/Language/Diploma Degree</h5>
        </div> --}}

        <div class="row p-2 mt-2">
            <!-- Bachelor Card -->
            <div id="bachelor-card" class="card text-center p-3 col-md-6 active" 
                 style="background-color: var(--section_background); cursor: pointer;" 
                 onclick="toggleFileUpload('bachelor-upload', 'bachelor-card', 'masters-card')">
                <h5>Bachelor/Language/Diploma Degree</h5>
            </div>
    
            <!-- Masters Card -->
            <div id="masters-card" class="card text-center p-3 col-md-6" 
                 style="background-color: var(--section_background); cursor: pointer;" 
                 onclick="toggleFileUpload('masters-upload', 'masters-card', 'bachelor-card')">
                <h5>Masters/PhD Degree</h5>
            </div>
        </div>

        <div id="bachelor-upload" class="ms-3 tab-content mt-4" style="display: block;">
            {{-- passport  --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Passport Pages (1-12)</h6>
                <input type="file" id="passport-file" style="display: none;"
                    onchange="showFileName('passport-file', 'passport-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('passport-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>

            <div id="passport-preview" class="mt-2"></div>

            {{-- Academic Certificate --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Highest Academic Certificate</h6>
                <input type="file" id="certificate-file" style="display: none;"
                    onchange="showFileName('certificate-file', 'certificate-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('certificate-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="certificate-preview" class="mt-2"></div>

            {{-- Academic Transcript --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Highest Academic Transcript</h6>
                <input type="file" id="transcript-file" style="display: none;"
                    onchange="showFileName('transcript-file', 'transcript-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('transcript-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="transcript-preview" class="mt-2"></div>

            {{-- Language Certificate --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Language Proficiency Certificate</h6>
                <input type="file" id="language-file" style="display: none;"
                    onchange="showFileName('language-file', 'language-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('language-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="language-preview" class="mt-2"></div>

            {{-- Foreigner Physical --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Foreigner Physical Examination Form</h6>
                <input type="file" id="foreigner-file" style="display: none;"
                    onchange="showFileName('foreigner-file', 'foreigner-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('foreigner-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="foreigner-preview" class="mt-2"></div>

            {{-- Non Criminal --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Non Criminal Certificate</h6>
                <input type="file" id="criminal-file" style="display: none;"
                    onchange="showFileName('criminal-file', 'criminal-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('criminal-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="criminal-preview" class="mt-2"></div>

            {{-- Bank Certificate --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Bank Solvency Certificate</h6>
                <input type="file" id="bank-file" style="display: none;"
                    onchange="showFileName('bank-file', 'bank-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('bank-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="bank-preview" class="mt-2"></div>

            {{-- Personal Photo --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Personal Photo</h6>
                <input type="file" id="personal-file" style="display: none;"
                    onchange="showFileName('personal-file', 'personal-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('personal-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="personal-preview" class="mt-2"></div>

            {{-- Resume/CV --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Resume/CV</h6>
                <input type="file" id="resume-file" style="display: none;"
                    onchange="showFileName('resume-file', 'resume-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('resume-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="resume-preview" class="mt-2"></div>

            {{-- Award Certificate --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Award Certificate</h6>
                <input type="file" id="award-file" style="display: none;"
                    onchange="showFileName('award-file', 'award-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('award-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="award-preview" class="mt-2"></div>

            {{-- Father’s/Mother’s ID --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Father’s/Mother’s ID</h6>
                <input type="file" id="father-file" style="display: none;"
                    onchange="showFileName('father-file', 'father-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('father-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="father-preview" class="mt-2"></div>


            <button class="btn btn-primary mt-3" onclick="uploadDocuments({{ $application->id }})">Upload
                Documents</button>

        </div>




        <!-- Masters/PhD Degree Section -->
        {{-- <div class="d-flex align-items-center gap-2 ms-3 mt-3">
            <input type="checkbox" id="masters-checkbox" onchange="toggleFileUpload('masters-upload')">
            <h5 class="mt-2">Masters/PhD Degree</h5>
        </div> --}}

        <div id="masters-upload" class="ms-3 tab-content mt-4" style="display: none;">

            {{-- Passport --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Passport Pages (1-12)</h6>
                <input type="file" id="passportMasters-file" style="display: none;"
                    onchange="showFileName('passportMasters-file', 'passportMasters-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('passportMasters-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="passportMasters-preview" class="mt-2"></div>

            {{-- Academic Certificate --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Highest Academic Certificate</h6>
                <input type="file" id="certificateMasters-file" style="display: none;"
                    onchange="showFileName('certificateMasters-file', 'certificateMasters-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('certificateMasters-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="certificateMasters-preview" class="mt-2"></div>

            {{-- Academic Transcript --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Highest Academic Transcript</h6>
                <input type="file" id="transcriptMasters-file" style="display: none;"
                    onchange="showFileName('transcriptMasters-file', 'transcriptMasters-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('transcriptMasters-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="transcriptMasters-preview" class="mt-2"></div>

            {{-- Language Certificate --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Language Proficiency Certificate</h6>
                <input type="file" id="languageMasters-file" style="display: none;"
                    onchange="showFileName('languageMasters-file', 'languageMasters-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('languageMasters-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="languageMasters-preview" class="mt-2"></div>

            {{-- Foreigner Physical --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Foreigner Physical Examination Form</h6>
                <input type="file" id="foreignerMasters-file" style="display: none;"
                    onchange="showFileName('foreignerMasters-file', 'foreignerMasters-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('foreignerMasters-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="foreignerMasters-preview" class="mt-2"></div>

            {{-- Non Criminal --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Non Criminal Certificate</h6>
                <input type="file" id="criminalMasters-file" style="display: none;"
                    onchange="showFileName('criminalMasters-file', 'criminalMasters-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('criminalMasters-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="criminalMasters-preview" class="mt-2"></div>

            {{-- Bank Certificate --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Bank Solvency Certificate</h6>
                <input type="file" id="bankMasters-file" style="display: none;"
                    onchange="showFileName('bankMasters-file', 'bankMasters-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('bankMasters-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="bankMasters-preview" class="mt-2"></div>

            {{-- Personal Photo --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Personal Photo</h6>
                <input type="file" id="personalMasters-file" style="display: none;"
                    onchange="showFileName('personalMasters-file', 'personalMasters-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('personalMasters-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="personalMasters-preview" class="mt-2"></div>

            {{-- Two Recommendation Letters --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Two Recommendation Letters</h6>
                <input type="file" id="Recommendation-file" style="display: none;"
                    onchange="showFileName('Recommendation-file', 'Recommendation-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('Recommendation-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="Recommendation-preview" class="mt-2"></div>

            {{-- Study Plan --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Study Plan</h6>
                <input type="file" id="studyPlan-file" style="display: none;"
                    onchange="showFileName('studyPlan-file', 'studyPlan-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('studyPlan-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="studyPlan-preview" class="mt-2"></div>

            {{-- Work Experience --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Work Experience</h6>
                <input type="file" id="work-file" style="display: none;"
                    onchange="showFileName('work-file', 'work-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('work-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="work-preview" class="mt-2"></div>

            {{-- Publication --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Publication</h6>
                <input type="file" id="Publication-file" style="display: none;"
                    onchange="showFileName('Publication-file', 'Publication-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('Publication-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="Publication-preview" class="mt-2"></div>

            {{-- Resume/CV --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Resume/CV</h6>
                <input type="file" id="resumeMasters-file" style="display: none;"
                    onchange="showFileName('resumeMasters-file', 'resumeMasters-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('resumeMasters-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="resumeMasters-preview" class="mt-2"></div>

            {{-- Award Certificate --}}
            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Award Certificate</h6>
                <input type="file" id="awardMasters-file" style="display: none;"
                    onchange="showFileName('awardMasters-file', 'awardMasters-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('awardMasters-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="awardMasters-preview" class="mt-2"></div>

            {{-- Father id  --}}

            <div class="d-flex justify-content-between align-items-center mt-2 p-1"
                style="background-color: rgb(239, 233, 233); border-radius:5px;">
                <h6 class="ms-2">Father’s/Mother’s ID</h6>
                <input type="file" id="fatherMasters-file" style="display: none;"
                    onchange="showFileName('fatherMasters-file', 'fatherMasters-preview')">
                <button class="me-4 px-3 py-1" onclick="document.getElementById('fatherMasters-file').click()"
                    style="background-color: var(--primary_background); color:white; font-size: 12px; border-radius:5px; border:none;">
                    Choose File
                </button>
            </div>
            <div id="fatherMasters-preview" class="mt-2"></div>

            <button class="btn btn-primary mt-3" onclick="uploadDocuments({{ $application->id }})">Upload
                Documents</button>

        </div>


        {{-- Next/previous button  --}}

        <div class="button-row d-flex mt-4">
            <button class="btn btn-secondary js-btn-prev" type="button" title="Prev">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Previous
            </button>

            <button class="btn btn-primary-light-bg ml-auto payment" type="button" title="Next">
                <div class="d-flex align-items-center ">
                    <span class="title">Next</span>
                    <span class="next-arrow">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </span>
                    <span id="payment-spinner" class="spinner-border spinner-border-sm d-none  float-right ml-2"
                        role="status" aria-hidden="true"></span>
                </div>
            </button>

        </div>
    </div>
</div>



<style>
    /* Active card style */
    .card.active {
        background-color:var(--primary_background) !important ;
        color: white;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
<script>
    // Ensure the worker is set up
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';
</script>

<script>
    // Function to toggle the display of file upload option
    function toggleFileUpload(uploadId, activeCardId, otherCardId) {
        // Hide all tab containers initially
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.style.display = 'none';
        });

        // Show only the clicked tab container
        const uploadElement = document.getElementById(uploadId);
        uploadElement.style.display = 'block';
        
        // Manage active card styling
        const activeCard = document.getElementById(activeCardId);
        const otherCard = document.getElementById(otherCardId);
        
        activeCard.classList.add('active');
        otherCard.classList.remove('active');
    }

    // Function to display the selected file name and preview
    function showFileName(inputId, previewId) {
        const fileInput = document.getElementById(inputId);
        const previewElement = document.getElementById(previewId);

        if (fileInput.files && fileInput.files[0]) {
            const file = fileInput.files[0];
            const fileName = file.name;
            previewElement.innerHTML = `<p>Selected File: <strong>${fileName}</strong></p>`;

            // Check if the file is an image
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewElement.innerHTML +=
                        `<img src="${e.target.result}" alt="Preview" style="max-width: 150px; margin-top: 10px;">`;
                };
                reader.readAsDataURL(file);

                // Check if the file is a PDF
            } else if (file.type === 'application/pdf') {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const loadingTask = pdfjsLib.getDocument({
                        data: e.target.result
                    });
                    loadingTask.promise.then(pdf => {
                        // Fetch the first page
                        pdf.getPage(1).then(page => {
                            const scale = 1.5;
                            const viewport = page.getViewport({
                                scale
                            });
                            const canvas = document.createElement('canvas');
                            const context = canvas.getContext('2d');
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;

                            // Render the page into the canvas
                            page.render({
                                canvasContext: context,
                                viewport: viewport
                            }).promise.then(() => {
                                previewElement.innerHTML +=
                                    `<img src="${canvas.toDataURL('image/png')}" alt="PDF Preview" style="max-width: 150px; margin-top: 10px;">`;
                            });
                        });
                    });
                };
                reader.readAsArrayBuffer(file);
            }
        } else {
            previewElement.innerHTML = "";
        }
    }

    function uploadDocuments(applicationId) {
        const formData = new FormData();

        const passportFile = document.getElementById('passport-file').files[0];
        if (passportFile) {
            formData.append('files[]', passportFile);
            formData.append('titles[]', 'Passport Pages (1-12)');
        }

        const transcriptFile = document.getElementById('transcript-file').files[0];
        if (transcriptFile) {
            formData.append('files[]', transcriptFile);
            formData.append('titles[]', 'Highest Academic Transcript');
        }

        const certificateFile = document.getElementById('certificate-file').files[0];
        if (certificateFile) {
            formData.append('files[]', certificateFile);
            formData.append('titles[]', 'Highest Academic Certificate');
        }

        const languageFile = document.getElementById('language-file').files[0];
        if (languageFile) {
            formData.append('files[]', languageFile);
            formData.append('titles[]', 'Language Proficiency certificate');
        }

        const foreignerFile = document.getElementById('foreigner-file').files[0];
        if (foreignerFile) {
            formData.append('files[]', foreignerFile);
            formData.append('titles[]', 'Foreigner Physical Examination Form');
        }

        const criminalFile = document.getElementById('criminal-file').files[0];
        if (criminalFile) {
            formData.append('files[]', criminalFile);
            formData.append('titles[]', 'Non Criminal Certificate');
        }

        const bankFile = document.getElementById('bank-file').files[0];
        if (bankFile) {
            formData.append('files[]', bankFile);
            formData.append('titles[]', 'Bank Certificate');
        }

        const personalFile = document.getElementById('personal-file').files[0];
        if (personalFile) {
            formData.append('files[]', personalFile);
            formData.append('titles[]', 'personal photo');
        }

        const resumeFile = document.getElementById('resume-file').files[0];
        if (resumeFile) {
            formData.append('files[]', resumeFile);
            formData.append('titles[]', 'resume/cv');
        }

        const awardFile = document.getElementById('award-file').files[0];
        if (awardFile) {
            formData.append('files[]', awardFile);
            formData.append('titles[]', 'award/cv');
        }

        const fatherFile = document.getElementById('father-file').files[0];
        if (fatherFile) {
            formData.append('files[]', fatherFile);
            formData.append('titles[]', 'father id');
        }



        // for master's 


        const passportMastersFile = document.getElementById('passportMasters-file').files[0];
        if (passportFile) {
            formData.append('files[]', passportMastersFile);
            formData.append('titles[]', 'Passport Pages (1-12)');
        }

        const transcriptMastersFile = document.getElementById('transcriptMasters-file').files[0];
        if (transcriptFile) {
            formData.append('files[]', transcriptMastersFile);
            formData.append('titles[]', 'Highest Academic Transcript');
        }

        const certificateMastersFile = document.getElementById('certificateMasters-file').files[0];
        if (certificateFile) {
            formData.append('files[]', certificateMastersFile);
            formData.append('titles[]', 'Highest Academic Certificate');
        }

        const languageMastersFile = document.getElementById('languageMasters-file').files[0];
        if (languageFile) {
            formData.append('files[]', languageMastersFile);
            formData.append('titles[]', 'Language Proficiency certificate');
        }

        const foreignerMastersFile = document.getElementById('foreignerMasters-file').files[0];
        if (foreignerFile) {
            formData.append('files[]', foreignerMastersFile);
            formData.append('titles[]', 'Foreigner Physical Examination Form');
        }

        const criminalMastersFile = document.getElementById('criminalMasters-file').files[0];
        if (criminalFile) {
            formData.append('files[]', criminalMastersFile);
            formData.append('titles[]', 'Non Criminal Certificate');
        }

        const bankMastersFile = document.getElementById('bankMasters-file').files[0];
        if (bankFile) {
            formData.append('files[]', bankMastersFile);
            formData.append('titles[]', 'Bank Certificate');
        }

        const personalMastersFile = document.getElementById('personalMasters-file').files[0];
        if (personalFile) {
            formData.append('files[]', personalMastersFile);
            formData.append('titles[]', 'personal photo');
        }

        const RecommendationMastersFile = document.getElementById('Recommendation-file').files[0];
        if (RecommendationMastersFile) {
            formData.append('files[]', RecommendationMastersFile);
            formData.append('titles[]', 'Recommendation Letters');
        }

        const studyPlanFile = document.getElementById('studyPlan-file').files[0];
        if (studyPlanFile) {
            formData.append('files[]', studyPlanFile);
            formData.append('titles[]', 'Study Plan');
        }

        const workFile = document.getElementById('work-file').files[0];
        if (workFile) {
            formData.append('files[]', workFile);
            formData.append('titles[]', 'Working Experience');
        }

        const PublicationFile = document.getElementById('Publication-file').files[0];
        if (PublicationFile) {
            formData.append('files[]', PublicationFile);
            formData.append('titles[]', 'Publication');
        }

        const resumeMastersFile = document.getElementById('resumeMasters-file').files[0];
        if (resumeMastersFile) {
            formData.append('files[]', resumeMastersFile);
            formData.append('titles[]', 'resume/cv');
        }

        const awardMastersFile = document.getElementById('awardMasters-file').files[0];
        if (awardMastersFile) {
            formData.append('files[]', awardMastersFile);
            formData.append('titles[]', 'award/cv');
        }

        const fatherMastersFile = document.getElementById('fatherMasters-file').files[0];
        if (fatherMastersFile) {
            formData.append('files[]', fatherMastersFile);
            formData.append('titles[]', 'father id');
        }

        $.ajax({
            url: `/add-attachment/upload/${applicationId}`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.code === 0) {
                    alert(response.msg);
                } else {
                    alert(response.err || response.msg);
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('An error occurred while uploading.');
            }
        });
    }
</script>
