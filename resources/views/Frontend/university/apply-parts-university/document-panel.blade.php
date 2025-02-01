<!-- Supporting Documents Panel -->
<div id="document-upload-panel">
    <style>
        #required-attachments::-webkit-scrollbar {
            width: 0px !important;
        }

        .upload-card {
            box-shadow: 1px 4px 20px -10px rgba(120, 200, 159, 0.75);
            background-color: #fff;
            border-radius: 8px;
        }
    </style>

    <!-- Single Form Panel -->
    <div id="required-attachments" class="p-4 rounded bg-white" data-animation="scaleIn"
        style="max-height: 1000px; overflow-y: auto;">
        <h5 class="multisteps-form__title my-2">Upload Documents</h5>
        <p class="text-muted p-2 rounded" style="background-color: rgb(242, 242, 242)">
            The uploaded file type(s) need to be *.jpg, *.jpeg, *.png, *.bmp, *.doc, *.docx, *.pdf, *.xls, *.xlsx |
            Maximum file size 5MB
        </p>

        <!-- Upload Fields -->
        <div id="bachelor-upload" class="tab-content mt-4" style="display: block;">
            <!-- Passport -->
            <div class="upload-card d-flex justify-content-between align-items-center mt-3 p-1 py-2">

                <h6 class="ms-2"><span class="text-danger me-1"
                                            style="font-size: 1.25rem; line-height:0;">*</span>Passport number/Student ID/National ID</h6>
                <input type="file" name="documents[passport]" id="passport-file" style="display: none;"
                    onchange="showFileName('passport-file', 'passport-preview')">
                    <input type="hidden" name="titles[passport]" value="Passport">
                <button class="me-4 px-3 py-1 btn-secondary-bg" onclick="openFileDialog(event, 'passport-file')"
                    style="color:white; font-size: 12px; border-radius:5px; border:none;">Choose File</button>
            </div>
            <div id="passport-preview" class="mt-2"></div>

            <!-- Certificate -->
            <div class="upload-card d-flex justify-content-between align-items-center mt-3 p-1 py-2">
                <h6 class="ms-2">Highest Academic Certificate</h6>
                <input type="file" name="documents[certificate]" id="certificate-file" style="display: none;"
                    onchange="showFileName('certificate-file', 'certificate-preview')">
                    <input type="hidden" name="titles[certificate]" value="Certificate">

                <button class="me-4 px-3 py-1 btn-secondary-bg" onclick="openFileDialog(event, 'certificate-file')"
                    style="color:white; font-size: 12px; border-radius:5px; border:none;">Choose File</button>
            </div>
            <div id="certificate-preview" class="mt-2"></div>

            <!-- Transcript -->
            <div class="upload-card d-flex justify-content-between align-items-center mt-3 p-1 py-2">
                <h6 class="ms-2">Highest Academic Transcript</h6>
                <input type="file" name="documents[transcript]" id="transcript-file" style="display: none;"
                    onchange="showFileName('transcript-file', 'transcript-preview')">
                    <input type="hidden" name="titles[transcript]" value="Transcript">

                <button class="me-4 px-3 py-1 btn-secondary-bg" onclick="openFileDialog(event, 'transcript-file')"
                    style="color:white; font-size: 12px; border-radius:5px; border:none;">Choose File</button>
            </div>
            <div id="transcript-preview" class="mt-2"></div>

            <!-- Personal Photo -->
            <div class="upload-card d-flex justify-content-between align-items-center mt-3 p-1 py-2">
                <h6 class="ms-2">Personal Photo</h6>
                <input type="file" name="documents[personal_photo]" id="personal-file" style="display: none;"
                    onchange="showFileName('personal-file', 'personal-preview')">
                    <input type="hidden" name="titles[personal_photo]" value="personal_photo">

                <button class="me-4 px-3 py-1 btn-secondary-bg" onclick="openFileDialog(event, 'personal-file')"
                    style="color:white; font-size: 12px; border-radius:5px; border:none;">Choose File</button>
            </div>
            <div id="personal-preview" class="mt-2"></div>
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
<script>
    // Function to open file dialog
    function openFileDialog(event, fileInputId) {
        event.preventDefault();
        document.getElementById(fileInputId).click();
    }

    // Display file name and preview (image or PDF)
    function showFileName(inputId, previewId) {
        const fileInput = document.getElementById(inputId);
        const previewElement = document.getElementById(previewId);

        if (fileInput.files && fileInput.files[0]) {
            const file = fileInput.files[0];
            const fileName = file.name;
            previewElement.innerHTML = `<p>Selected File: <strong>${fileName}</strong></p>`;

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewElement.innerHTML += `<img src="${e.target.result}" alt="Preview" style="max-width: 150px; margin-top: 10px;">`;
                };
                reader.readAsDataURL(file);
            } else if (file.type === 'application/pdf') {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const loadingTask = pdfjsLib.getDocument({ data: e.target.result });
                    loadingTask.promise.then(pdf => {
                        pdf.getPage(1).then(page => {
                            const scale = 1.5;
                            const viewport = page.getViewport({ scale });
                            const canvas = document.createElement('canvas');
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;
                            const context = canvas.getContext('2d');
                            page.render({ canvasContext: context, viewport }).promise.then(() => {
                                previewElement.innerHTML += `<img src="${canvas.toDataURL('image/png')}" alt="PDF Preview" style="max-width: 150px; margin-top: 10px;">`;
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
</script>
