<!--family & finance panel-->
<div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
    <div class="multisteps-form__content">
        <form action="" id="financialsupport">

            <div class="family-contacts">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="multisteps-form__title">Family Contact</h5>
                        <h6>Member information</h6>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="addFamilyMember()">Add A Family Member</button>
                </div>
            
                <!-- Initial Family Member Section -->
                <div class="family-member">
                    <div class="form-row">
                        <div class="col-12 col-sm-6">
                            <div class="form-label-group mt-2">
                                <input type="text" name="family_member_name[]" placeholder="Name" class="form-control" required>
                                <label>Name</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-label-group mt-2">
                                <input type="text" name="family_member_nationality[]" placeholder="Nationality" class="form-control" required>
                                <label>Nationality</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-12 col-sm-6">
                            <div class="form-label-group mt-2">
                                <input type="text" name="family_member_phone[]" placeholder="Phone number" class="form-control" required>
                                <label>Phone number</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-label-group mt-2">
                                <input type="text" name="family_member_email[]" placeholder="Email" class="form-control" required>
                                <label>Email</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-12 col-sm-6">
                            <div class="form-label-group mt-2">
                                <input type="text" name="family_member_work_employer[]" placeholder="Workplace" class="form-control" required>
                                <label>Workplace</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-label-group mt-2">
                                <input type="text" name="family_member_work_position[]" placeholder="Position" class="form-control" required>
                                <label>Position</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-12 col-sm-6">
                            <div class="form-label-group mt-2">
                                <input type="text" name="family_member_work_relationship[]" placeholder="Relationship" class="form-control" required>
                                <label>Relationship</label>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Container for Additional Family Members -->
                <div id="family-members-container"></div>
            </div>


            <div class="">
                <h5 class="multisteps-form__title">Financial Supporter</h5>
                <p>Please enter the details of the person who will be paying for your studies. It can be a family
                    member, friend, company, government or yourself.</p>
                {{-- <div class="form-row">
                    <span class="pl-2 mr-2">Same as: </span>
                    <div class="form-check form-check-inline">

                        <label class="form-check-label" for="inlineRadio1">
                            <input @if ($application->guarantor_inter_relation == 'father') @checked(true) @endif
                                class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                value="father" onclick="copySupporter('father')">
                            Father
                        </label>
                    </div>
                    <div class="form-check form-check-inline">

                        <label class="form-check-label" for="inlineRadio2">
                            <input @if ($application->guarantor_inter_relation == 'mother') @checked(true) @endif
                                class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                value="mother" onclick="copySupporter('mother')">
                            Mother
                        </label>
                    </div>
                </div> --}}
                <div class="form-row ">
                    <div class="col-12 col-sm-6">
                        <div class=" form-label-group mt-2">

                            <input type="text" id="supporter_relationship" name="supporter_relationship"
                                data-name="supporter_relationship" required="" placeholder="Relationship"
                                class="form-control" maxlength=""
                                value="{{ $application->guarantor_relationship }}">
                            <label for="supporter_relationship" class="form-control-placeholder">
                                Relationship</label>

                            <div class="invalid-feedback">
                                This field is required.
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class=" form-label-group mt-2">

                            <input type="text" id="supporter_name" name="supporter_name"
                                data-name="supporter_name" required="" placeholder="Guarantor’s name"
                                class="form-control" maxlength="" value="{{ $application->guarantor_name }}">
                            <label for="supporter_name" class="form-control-placeholder">
                                Guarantor’s name</label>

                            <div class="invalid-feedback">
                                This field is required.
                            </div>

                        </div>
                    </div>
                </div>

                <div class="form-row ">
                    <div class="col-12 col-sm-6">
                        <div class=" form-label-group mt-2">

                            <input type="text" id="supporter_address" name="supporter_address"
                                data-name="supporter_address" required="" placeholder="Guarantor’s address"
                                class="form-control" maxlength="" value="{{ $application->guarantor_address }}">
                            <label for="supporter_address" class="form-control-placeholder">
                                Guarantor’s address</label>

                            <div class="invalid-feedback">
                                This field is required.
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class=" form-label-group mt-2">

                            <input type="text" id="supporter_phone" name="supporter_phone"
                                data-name="supporter_phone" required="" placeholder="Guarantor’s phone"
                                class="form-control" maxlength="" value="{{ $application->guarantor_phone }}">
                            <label for="supporter_phone" class="form-control-placeholder">
                                Guarantor’s phone</label>

                            <div class="invalid-feedback">
                                This field is required.
                            </div>

                        </div>
                    </div>

                </div>
                <div class="form-row ">
                    <div class="col-12 col-sm-6">
                        <div class=" form-label-group mt-2">

                            <input type="text" id="supporter_email" name="supporter_email"
                                data-name="supporter_email" required="" placeholder="Guarantor’s email"
                                class="form-control" maxlength="" value="{{ $application->guarantor_email }}">
                            <label for="supporter_email" class="form-control-placeholder">
                                Guarantor’s email</label>

                            <div class="invalid-feedback">
                                This field is required.
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class=" form-label-group mt-2">

                            <input type="text" id="supporter_company" name="supporter_company"
                                data-name="supporter_company" required="" placeholder="Workplace"
                                class="form-control" maxlength="" value="{{ $application->guarantor_workplace }}">
                            <label for="supporter_company" class="form-control-placeholder">
                                Workplace</label>

                            <div class="invalid-feedback">
                                This field is required.
                            </div>

                        </div>
                    </div>

                </div>
                <div class="form-row ">
                    <div class="col-12 col-sm-6">
                        <div class=" form-label-group mt-2">

                            <input type="text" id="supporter_company_address" name="supporter_company_address"
                                data-name="supporter_company_address" required="" placeholder="Workplace address"
                                class="form-control" maxlength=""
                                value="{{ $application->guarantor_work_address }}">
                            <label for="supporter_company_address" class="form-control-placeholder">
                                Workplace address</label>

                            <div class="invalid-feedback">
                                This field is required.
                            </div>

                        </div>
                    </div>
                </div>
                <div class="form-row ">
                    <div class="col-12 mt-2">
                        <div class="form-label-group mt-2">
                            <select class="custom-select d-block w-100" id="fund" name="fund"
                                placeholder="How do you plan to fund your studies level" value="0"
                                required="">
                                <option @if ($application->study_fund == 'Self finance') selected @endif value="Self finance">Self
                                    finance</option>
                                <option @if ($application->study_fund == 'Chinese Government Scholarship') selected @endif
                                    value="Chinese Government Scholarship">Chinese Government Scholarship</option>
                                <option @if ($application->study_fund == 'Part scholarship part self financed') selected @endif
                                    value="Part scholarship part self financed">Part scholarship part self
                                    financed (University scholarship)</option>
                            </select>
                            <label for="fund">How do you plan to fund
                                your studies</label>
                        </div>
                        <small id="msg-fund" class="invalid-feedback" style="display: block;">
                        </small>
                    </div>
                </div>
                <div class="form-row" id="txt-scholarship" style="display: none;">
                    <div class="col-12 col-sm-6">
                        <div class=" form-label-group mt-2">

                            <input type="text" id="scholarship" name="scholarship" data-name="scholarship"
                                placeholder="Which scholarship are you applying to?" class="form-control"
                                maxlength="" value="{{ $application->scholarship }}">
                            <label for="scholarship" class="form-control-placeholder">
                                Which scholarship are you applying to?</label>

                        </div>
                    </div>
                </div>
            </div>

            <div class="">
                <h5 class="multisteps-form__title">Contact in Case of
                    Emergencies
                </h5>
                <small>
                    If you have a contact in China, please add them here. If you
                    don’t know anyone in China, we’ll automatically assume the
                    embassy of your country in China.
                </small>
                <div class="form-row ">
                    <div class="col-12 col-sm-6">
                        <div class=" form-label-group mt-2">

                            <input type="text" id="emergency_contact_name" name="emergency_contact_name"
                                data-name="emergency_contact_name" required="" placeholder="Name"
                                class="form-control" maxlength=""
                                value="{{ $application->emergency_contact_name }}">
                            <label for="emergency_contact_name" class="form-control-placeholder">
                                Name</label>

                            <div class="invalid-feedback">
                                This field is required.
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class=" form-label-group mt-2">

                            <input type="text" id="emergency_contact_phone" name="emergency_contact_phone"
                                data-name="emergency_contact_phone" required="" placeholder="Phone number"
                                class="form-control" maxlength=""
                                value="{{ $application->emergency_contact_phone }}">
                            <label for="emergency_contact_phone" class="form-control-placeholder">
                                Phone number</label>

                            <div class="invalid-feedback">
                                This field is required.
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class=" form-label-group mt-2">

                            <input type="text" id="emergency_contact_email" name="emergency_contact_email"
                                data-name="emergency_contact_email" required="" placeholder="Email"
                                class="form-control" maxlength=""
                                value="{{ $application->emergency_contact_email }}">
                            <label for="emergency_contact_email" class="form-control-placeholder">
                                Email</label>

                            <div class="invalid-feedback">
                                This field is required.
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class=" form-label-group mt-2">

                            <input type="text" id="emergency_contact_address" name="emergency_contact_address"
                                data-name="emergency_contact_address" required="" placeholder="Complete Address"
                                class="form-control" maxlength=""
                                value="{{ $application->emergency_contact_address }}">
                            <label for="emergency_contact_address" class="form-control-placeholder">
                                Complete Address</label>

                            <div class="invalid-feedback">
                                This field is required.
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="button-row d-flex mt-4 col-12">
                <button class="btn btn-secondary js-btn-prev" type="button" title="Prev">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    Previous</button>
                <button class="btn btn-primary-light-bg js-btn-next ml-auto supporting-doc" type="button"
                    title="Next">Next
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
</div>


<script>
function addFamilyMember() {
    // Create a new family member section
    const familyMember = document.createElement('div');
    familyMember.classList.add('family-member');
    
    familyMember.innerHTML = `
        <div class="d-flex justify-content-between">
            <h6>Member information</h6>
            <button type="button" class="btn btn-danger" onclick="removeFamilyMember(this)">Remove</button>
        </div>
        <div class="form-row">
            <div class="col-12 col-sm-6">
                <div class="form-label-group mt-2">
                    <input type="text" name="family_member_name[]" placeholder="Name" class="form-control" required>
                    <label>Name</label>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-label-group mt-2">
                    <input type="text" name="family_member_nationality[]" placeholder="Nationality" class="form-control" required>
                    <label>Nationality</label>
                </div>
            </div>
        </div>
        
        <div class="form-row">
            <div class="col-12 col-sm-6">
                <div class="form-label-group mt-2">
                    <input type="text" name="family_member_phone[]" placeholder="Phone number" class="form-control" required>
                    <label>Phone number</label>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-label-group mt-2">
                    <input type="text" name="family_member_email[]" placeholder="Email" class="form-control" required>
                    <label>Email</label>
                </div>
            </div>
        </div>
        
        <div class="form-row">
            <div class="col-12 col-sm-6">
                <div class="form-label-group mt-2">
                    <input type="text" name="family_member_work_employer[]" placeholder="Workplace" class="form-control" required>
                    <label>Workplace</label>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-label-group mt-2">
                    <input type="text" name="family_member_work_position[]" placeholder="Position" class="form-control" required>
                    <label>Position</label>
                </div>
            </div>
        </div>
        
        <div class="form-row">
            <div class="col-12 col-sm-6">
                <div class="form-label-group mt-2">
                    <input type="text" name="family_member_work_relationship[]" placeholder="Relationship" class="form-control" required>
                    <label>Relationship</label>
                </div>
            </div>
        </div>
    `;
    
    // Append the new family member section to the container
    document.getElementById('family-members-container').appendChild(familyMember);
}

function removeFamilyMember(element) {
    // Remove the specific family member section
    element.closest('.family-member').remove();
}
</script>
