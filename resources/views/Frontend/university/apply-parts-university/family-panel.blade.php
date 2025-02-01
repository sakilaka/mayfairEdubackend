<!--family & finance panel-->


    <div class="multisteps-form__content">
        
        <div id="financialsupport">

            <div class="family-contacts">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="multisteps-form__title">Family Contact</h5>
                        <h6>Member information</h6>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="addFamilyMember()">Add A Family
                        Member</button>
                </div>

                <!-- Initial Family Member Section -->
                <div class="family-member">
                    <div class="form-row">
                        <div class="col-12 col-sm-6">
                            <div class="form-label-group mt-2">
                                <input type="text" name="family_member_name[]" placeholder="Name"
                                    class="form-control" required>
                                <label>Name</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-label-group mt-2">
                                <input type="text" name="family_member_nationality[]" placeholder="Nationality"
                                    class="form-control" required>
                                <label>Nationality</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-12 col-sm-6">
                            <div class="form-label-group mt-2">
                                <input type="text" name="family_member_phone[]" placeholder="Phone number"
                                    class="form-control form-control-lg phone-input pt-0" required>
                                <label>Phone number</label>
                            </div>
                            <span class="text-danger" id="output"></span>
                            <div class="invalid-feedback">
                                This field is required.
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-label-group mt-2">
                                <input type="text" name="family_member_email[]" placeholder="Email"
                                    class="form-control" required>
                                <label>Email</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-12 col-sm-6">
                            <div class="form-label-group mt-2">
                                <input type="text" name="family_member_work_employer[]" placeholder="Workplace"
                                    class="form-control" required>
                                <label>Workplace</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-label-group mt-2">
                                <input type="text" name="family_member_work_position[]" placeholder="Position"
                                    class="form-control" required>
                                <label>Position</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-12 col-sm-6">
                            <div class="form-label-group mt-2">
                                <input type="text" name="family_member_work_relationship[]"
                                    placeholder="Relationship" class="form-control" required>
                                <label>Relationship</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Container for Additional Family Members -->
                <div id="family-members-container"></div>
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
                    <input type="text" name="family_member_phone[]" placeholder="Phone number" class="form-control form-control-lg phone-input pt-0" required>
                    <label>Phone number</label>
                </div>
                <span class="text-danger" id="output"></span>
                <div class="invalid-feedback">
                    This field is required.
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-label-group mt-2">
                    <input type="email" name="family_member_email[]" placeholder="Email" class="form-control" required>
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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const emailInputs = document.querySelectorAll('.email-input');

        emailInputs.forEach((input) => {
            const output = document.createElement('div');
            output.className = 'validation-output';
            input.parentNode.insertBefore(output, input.nextSibling);

            const validateEmail = (email) => {
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(email);
            };

            const checkEmailValidity = async (email) => {
                try {
                    const response = await fetch(`/validate-email?email=${encodeURIComponent(email)}`);
                    const data = await response.json();
                    return data.isValid;
                } catch (error) {
                    console.error('Email validation error:', error);
                    return false;
                }
            };

            const handleChange = async () => {
                const email = input.value.trim();
                if (!email) {
                    output.textContent = 'Please enter an email address.';
                    output.classList.add('text-danger');
                    output.classList.remove('text-success');
                    return;
                }

                if (!validateEmail(email)) {
                    output.textContent = 'Invalid email format.';
                    output.classList.add('text-danger');
                    output.classList.remove('text-success');
                    return;
                }

                output.textContent = 'Validating email...';
                const isValid = await checkEmailValidity(email);

                if (isValid) {
                    output.textContent = 'Valid email address.';
                    output.classList.add('text-success');
                    output.classList.remove('text-danger');
                } else {
                    output.textContent = 'Invalid email address or domain.';
                    output.classList.add('text-danger');
                    output.classList.remove('text-success');
                }
            };

            input.addEventListener('change', handleChange);
            input.addEventListener('keyup', handleChange);
        });
    });
</script>

