<!-- Agreement panel -->
<div id="agreement" class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
    <div class="multisteps-form__content">
  
      <!-- Terms and Conditions -->
      <div id="terms-section">
        <h5 class="multisteps-form__title guaranteed">Terms and conditions</h5>
        <p>{!! $terms->description !!}</p>
        <div class="d-flex gap-2">
          <input type="checkbox" id="terms-checkbox">
          <p class="mt-3">I agree to terms and conditions.</p>
        </div>
      </div>
  
      <!-- Refund Policy (initially hidden) -->
      <div id="refund-section" style="display: none;">
        <h5 class="multisteps-form__title guaranteed">Refund Policy</h5>
        <p>{!! $refund->description !!}</p>
        <div class="d-flex gap-2">
          <input type="checkbox" id="refund-checkbox">
          <p class="mt-3">I agree to the refund policy.</p>
        </div>
      </div>
  
      <!-- Privacy Policy (initially hidden) -->
      <div id="privacy-section" style="display: none;">
        <h5 class="multisteps-form__title guaranteed">Privacy Policy</h5>
        <p>{!! $privacy->description !!}</p>
        <div class="d-flex gap-2">
          <input type="checkbox" id="privacy-checkbox">
          <p class="mt-3">I agree to the privacy policy.</p>
        </div>
      </div>
  
      <!-- Navigation Buttons -->
      <div class="row">
        <div class="button-row d-flex mt-4 col-12">
          <button class="btn btn-secondary js-btn-prev" type="button" title="Prev">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            Previous
          </button>
          <button class="btn btn-primary-light-bg ml-auto service btn-upload-doc" type="button" title="Next" id="next-button" disabled>
            <span class="title">Next</span>
            <i class="fa fa-arrow-right" aria-hidden="true"></i>
          </button>
        </div>
      </div>
  
    </div>
  </div>
  


  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Handle Terms checkbox
      document.getElementById('terms-checkbox').addEventListener('change', function () {
        if (this.checked) {
          document.getElementById('terms-section').style.display = 'none';
          document.getElementById('refund-section').style.display = 'block';
          window.scrollTo(0, 0);
        }
      });
  
      // Handle Refund checkbox
      document.getElementById('refund-checkbox').addEventListener('change', function () {
        if (this.checked) {
          document.getElementById('refund-section').style.display = 'none';
          document.getElementById('privacy-section').style.display = 'block';
          window.scrollTo(0, 0);
        }
      });
  
      // Handle Privacy checkbox
      document.getElementById('privacy-checkbox').addEventListener('change', function () {
        document.getElementById('next-button').disabled = !this.checked;
      });
    });
  </script>
  