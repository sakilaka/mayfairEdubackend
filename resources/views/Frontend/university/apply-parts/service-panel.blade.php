  <!-- service panel -->
  <div id="services" class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
      <h5 class="multisteps-form__title guaranteed">Are you interested in
          our Guaranteed Admissions Service?</h5>
      <h5 class="multisteps-form__title priority d-none">Are you interested in our
          Priority Application Service? (Recommended)</h5>

      <div class="multisteps-form__content">

          <form action="" class="optional-service-price" id="optional-service">
              <section class="" id="optional-services">

                  <div class="custom-control custom-radio">
                      <input checked type="radio" data-orig-app-fee="285" data-app-fee="285" data-srv-fee="0"
                          data-opt-srv-fee="0" data-total="285" data-name="none" id="none" name="optional_service"
                          class="custom-control-input" value="15">
                      <style>
                          label.custom-control-label::before {
                              background-color: var(--btn_primary_color) !important;
                              border-color: var(--btn_primary_color) !important;
                          }

                          label::after {
                              top: 9px;
                          }
                      </style>
                      <label class="custom-control-label" for="none">
                          <strong>
                              No, thanks (Basic Service) - {{ convertCurrency($application->application_fee) }}
                          </strong>
                      </label>
                      <small>
                          <p style="text-align:initial">
                              ✓&nbsp;<b>Price Match</b> - <span
                                  class="app-fee">{{ convertCurrency($application->application_fee) }}</span> is the
                              university
                              application fee that will be paid to the university. It covers the cost of processing
                              applications, preparing your visa, and sending the admissions package to you in your home
                              country. If this is lower to apply directly we will refund the difference.<br>
                              ✓&nbsp;<b>Free Email Support Is Available</b> - by our award winning international and
                              Chinese team with average reply speed of 6 hours 23 minutes. <br>
                              ✓&nbsp;<b>Free Document Review &amp; Assistance</b> - before you have submitted your final
                              application.<br>
                          </p>
                      </small>
                  </div>
              </section>


          </form>
          <div id="no-optional-services" class="d-none">
              There are no available optional services for the programs in your
              application.
              You can move to the next step!
          </div>



          <div class="row">
              <div class="button-row d-flex mt-4 col-12">
                  <button class="btn btn-secondary js-btn-prev" type="button" title="Prev">
                      <i class="fa fa-arrow-left" aria-hidden="true"></i>
                      Previous</button>
                  <button class="btn btn-primary-light-bg ml-auto service btn-upload-doc" type="button" title="Next">
                      <span class="title">Next</span>
                      <i class="fa fa-arrow-right" aria-hidden="true"></i>
                  </button>
              </div>
          </div>
      </div>
  </div>
