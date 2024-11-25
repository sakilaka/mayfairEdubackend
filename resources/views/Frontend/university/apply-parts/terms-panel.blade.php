<!-- Agreement panel -->
<div id="agreement" class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
    <div class="multisteps-form__content">

        <h6 class="fw-bold my-2">1. Acknowledgment</h6>
        <div class="checkbox-container">
            <input type="checkbox" id="termsCheckbox" onchange="toggleModal(); checkAllCheckboxes()">
            <label class="mt-2" for="termsCheckbox">I have read and understood the Terms and Conditions and Privacy
                Policy of MalishaEdu.</label>
        </div>

        <br>
        <h6 class="fw-bold my-2">2. Consent</h6>
        <div class="checkbox-container">
            <input type="checkbox" id="privacyCheckbox" onchange="toggleModalPrivacy(); checkAllCheckboxes()">
            <label class="mt-2" for="privacyCheckbox">I give consent to MalishaEdu to collect, process, and share my
                data with relevant parties for the purpose of admission and visa processing.</label>
        </div>

        <br>
        <h6 class="fw-bold my-2">3. Accuracy of Information</h6>
        <div class="checkbox-container">
            <input type="checkbox" id="accuracyCheckbox" onchange="checkAllCheckboxes()">
            <label class="mt-2" for="accuracyCheckbox">I declare that the information and documents provided in my
                application are accurate and authentic to the best of my knowledge.</label>
        </div>

        <br>
        <h6 class="fw-bold my-2">4. Payment Policy</h6>
        <div class="checkbox-container">
            <input type="checkbox" id="paymentCheckbox" onchange="toggleModalPayment(); checkAllCheckboxes()">
            <label class="mt-2" for="paymentCheckbox">I have read and understood the Payment policy of MalishaEdu and
                agree to its terms.
            </label>
        </div>

        <br>
        <h6 class="fw-bold my-2">4. Refund Policy</h6>
        <div class="checkbox-container">
            <input type="checkbox" id="refundCheckbox" onchange="toggleModalRefund(); checkAllCheckboxes()">
            <label class="mt-2" for="refundCheckbox">I have read and understood the Refund Policy of MalishaEdu and
                agree to its terms.</label>
        </div>

        <br>
        <h6 class="fw-bold my-2">5. Compliance</h6>
        <div class="checkbox-container">
            <input type="checkbox" id="compliance1checkbox" onchange="checkAllCheckboxes()">
            <label class="mt-2" for="compliance1checkbox">I agree to attend all required courses, interviews, and exams as
                outlined in the application process.
            </label>
        </div>
        <div class="checkbox-container">
            <input type="checkbox" id="compliance2checkbox" onchange="checkAllCheckboxes()">
            <label class="mt-2" for="compliance2checkbox">I will abide by the rules and regulations of the People’s
                Republic of China as well as the rules and Regulations of the university and MalishaEdu.</label>
        </div>

        <div class="checkbox-container mt-2">
            <input type="checkbox" id="compliance3checkbox" onchange="checkAllCheckboxes()">
            <label class="mt-2" for="compliance3checkbox">By clicking "I Agree," you confirm your acceptance of the above statements and proceed with your application</label>
        </div>


        <!-- Navigation Buttons -->
        <div class="row">
            <div class="button-row d-flex mt-4 col-12">
                <button class="btn btn-secondary js-btn-prev" type="button" title="Prev">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    Previous
                </button>
                <button class="btn btn-primary-light-bg ml-auto service btn-upload-doc" type="button" title="Next"
                    id="next-button" disabled>
                    <span class="title">Next</span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>

    </div>
</div>


<script>
    function toggleModal() {
        const termsCheckbox = document.getElementById('termsCheckbox');
        const termsModal = document.getElementById('termsModal');
        if (termsCheckbox.checked) {
            termsModal.style.display = 'block';
        } else {
            termsModal.style.display = 'none';
        }
    }

    function toggleModalPrivacy() {
        const termsCheckbox = document.getElementById('privacyCheckbox');
        const termsModal = document.getElementById('privacyModal');
        if (termsCheckbox.checked) {
            termsModal.style.display = 'block';
        } else {
            termsModal.style.display = 'none';
        }
    }

    function toggleModalPayment() {
        const termsCheckbox = document.getElementById('paymentCheckbox');
        const termsModal = document.getElementById('paymentModal');
        if (termsCheckbox.checked) {
            termsModal.style.display = 'block';
        } else {
            termsModal.style.display = 'none';
        }
    }

    function toggleModalRefund() {
        const termsCheckbox = document.getElementById('refundCheckbox');
        const termsModal = document.getElementById('refundModal');
        if (termsCheckbox.checked) {
            termsModal.style.display = 'block';
        } else {
            termsModal.style.display = 'none';
        }
    }


    function toggleNextButton() {
        const agreeCheckbox = document.getElementById('agreeCheckbox');
        const agreeButton = document.getElementById('agreeButton');
        agreeButton.disabled = !agreeCheckbox.checked;
    }

    function toggleNextButtonPrivacy() {
        const agreeCheckboxPrivacy = document.getElementById('agreeCheckboxPrivacy');
        const agreeButtonPrivacy = document.getElementById('agreeButtonPrivacy');
        agreeButtonPrivacy.disabled = !agreeCheckboxPrivacy.checked;
    }

    function toggleNextButtonPayment() {
        const agreeCheckboxPayment = document.getElementById('agreeCheckboxPayment');
        const agreeButtonPayment = document.getElementById('agreeButtonPayment');
        agreeButtonPayment.disabled = !agreeCheckboxPayment.checked;
    }

    function toggleNextButtonRefund() {
        const agreeCheckboxRefund = document.getElementById('agreeCheckboxRefund');
        const agreeButtonRefund = document.getElementById('agreeButtonRefund');
        agreeButtonRefund.disabled = !agreeCheckboxRefund.checked;
    }


    function closeModal() {
        const termsModal = document.getElementById('termsModal');
        termsModal.style.display = 'none';
    }


    function closeModalPrivacy() {
        const privacyModal = document.getElementById('privacyModal');
        privacyModal.style.display = 'none';
    }

    function closeModalPayment() {
        const PaymentModal = document.getElementById('paymentModal');
        PaymentModal.style.display = 'none';
    }

    function closeModalRefund() {
        const RefundModal = document.getElementById('refundModal');
        RefundModal.style.display = 'none';
    }


    function confirmAgreement() {
        const agreeButton = document.getElementById('agreeButton');
        if (agreeButton.disabled) return;


        closeModal();
    }

    function confirmAgreementPrivacy() {
        const agreeButtonPrivacy = document.getElementById('agreeButtonPrivacy');
        if (agreeButtonPrivacy.disabled) return;


        closeModalPrivacy();
    }

    function confirmAgreementPayment() {
        const agreeButtonPayment = document.getElementById('agreeButtonPayment');
        if (agreeButtonPayment.disabled) return;


        closeModalPayment();
    }

    function confirmAgreementRefund() {
        const agreeButtonRefund = document.getElementById('agreeButtonRefund');
        if (agreeButtonRefund.disabled) return;


        closeModalRefund();
    }

    function checkAllCheckboxes(){

      const termsCheckbox = document.getElementById('termsCheckbox');
      const privacyCheckbox = document.getElementById('privacyCheckbox');
      const paymentCheckbox = document.getElementById('paymentCheckbox');
      const refundCheckbox = document.getElementById('refundCheckbox');
      const accuracyCheckbox = document.getElementById('accuracyCheckbox');
      const com1Checkbox = document.getElementById('compliance1checkbox');
      const com2Checkbox = document.getElementById('compliance2checkbox');
      const com3Checkbox = document.getElementById('compliance3checkbox');


      const allChecked = termsCheckbox.checked && privacyCheckbox.checked && paymentCheckbox.checked && refundCheckbox.checked  &&
       accuracyCheckbox.checked  && com1Checkbox.checked  && com2Checkbox.checked && com3Checkbox.checked;

      document.getElementById('next-button').disabled = !allChecked; 
    }

</script>


{{-- document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('privacy-checkbox').addEventListener('change', function() {
        document.getElementById('next-button').disabled = !this.checked;
    });
}); --}}

<style>
    /* Modal Styles */
    .modal-terms {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        overflow-y: auto;
    }

    .modal-content-terms {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 60%;
    }

    .modal-footer-terms {
        margin-top: 10px;
    }

    .checkbox-container {
        display: flex;
        align-items: center;
    }

    .checkbox-container input[type="checkbox"] {
        margin-right: 10px;
    }
    label{
      font-size: 14px;
    }
</style>
