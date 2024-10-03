<style>
    .social-link {
        width: 30px;
        height: 30px;
        border: 1px solid #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        border-radius: 50%;
        transition: all 0.3s;
        font-size: 0.9rem;
    }

    .social-link:hover,
    .social-link:focus {
        background: #ddd;
        text-decoration: none;
        color: #555;
    }

    .icon-wrapper {
        display: inline-block;
        line-height: 1;
        transition: all 350ms cubic-bezier(.24, .85, .58, 1);
        color: #818a91;
        font-size: 48px;
        width: 48px;
        height: auto;
        text-align: center;
        overflow: hidden;
        position: relative;
        box-sizing: content-box;
        padding: 40px;
        border-radius: 50%;
        box-shadow: 0 2px 6px -2px #c7c7c7;
    }

    .icon-wrapper i {
        font-size: 3rem;
        color: var(--secondary_background);
    }

    .steps_count {
        padding: 5px 12px;
        font-weight: 600;
        background: #fff;
        color: #818a91 !important;
        box-shadow: 0 1px 3px -1px #818a91;
        transition: all .3s ease;
        width: max-content;
        height: max-content;
        border-radius: 12px;
        position: absolute;
        left: 50%;
        top: -10%;
    }

    .steps-description p {
        font-size: 0.95rem !important;
        color: #4d4d4d
    }
</style>
<div class="container" style="margin-top: 5rem;">
    <div class="text-center">
        <h3 class="ca-card-title d-block text-center mb-4 font-dm-sans-title">3 Steps To Apply University's</h3>

    </div>
    <div class="row text-center">
        <div class="col-md-4 col-sm-6 mb-5">
            <div class="bg-white rounded py-5 px-4">
                <div class="row text-center" style="position: relative">
                    <div class="steps_count">Step 1</div>
                    <div class="col-3 mx-auto icon-wrapper">
                        <i class="far fa-file-alt" aria-hidden="true" style="font-size: 3rem"></i>
                    </div>
                </div>

                <div class="mt-5 steps-description">
                    <h5 class="mb-3" style="font-weight: 700">Application Materials​</h5>
                    <p>
                        For step 1, need to prepare application documents for submission​
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-5">
            <div class="bg-white rounded py-5 px-4">
                <div class="row text-center" style="position: relative">
                    <div class="steps_count">Step 2</div>
                    <div class="col-3 mx-auto icon-wrapper">
                        <i class="fas fa-file-upload" aria-hidden="true" style="font-size: 3rem"></i>
                    </div>
                </div>

                <div class="mt-5 steps-description">
                    <h5 class="mb-3" style="font-weight: 700">Application Submission​​</h5>
                    <p>
                        We will proceed for next step with your application materials for review​
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-5">
            <div class="bg-white rounded py-5 px-4">
                <div class="row text-center" style="position: relative">
                    <div class="steps_count">Step 3</div>
                    <div class="col-3 mx-auto icon-wrapper">
                        <i class="fas fa-star" aria-hidden="true" style="font-size: 3rem"></i>
                    </div>
                </div>

                <div class="mt-5 steps-description">
                    <h5 class="mb-3" style="font-weight: 700">Admission Result​​</h5>
                    <p>
                        You will get admission result with a very short period of time after review​
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
