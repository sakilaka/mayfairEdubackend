<style>
    .upload-card {
        box-shadow: 1px 4px 20px -10px rgba(120, 200, 159, 0.75);
        background-color: #fff;
        border-radius: 8px;
        border: 1px solid #eee !important;
    }

    .upload-card:hover {
        cursor: pointer;
    }
</style>

@php
    if (session('partner_ref_id') || request()->query('partner_ref_id')) {
        $route = route('application.submit_appliction', [
            'id' => $application->id,
            'partner_ref_id' => session('partner_ref_id') ?? request()->query('partner_ref_id'),
        ]);
    } else {
        $route = route('application.submit_appliction', ['id' => $application->id]);
    }
@endphp

<form action="{{ $route }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div id="payment">

        <!--single form panel-->
        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
            <p class="my-2">Please pay the Application Fees: {{ $application->application_fee }} CNY. After completing your payment please upload the payment receipt.</p>
            
            <h5 class="multisteps-form__title">Choose Your Payment Method</h5>

            <div class="has-fee">
                <h6 class="my-3 fw-bold">
                    Please upload you payment receipt after completing payment.
                </h6>

                <div class="my-4">

                    <div class="row my-3 p-3 d-flex flex-wrap">
                        <div data-bs-toggle="modal" data-bs-target="#modalWechat"
                            class="cardPayment p-3 flex-grow-1 justify-content-center align-items-center upload-card"
                            style="max-width: calc(25% - 16px); margin-right: 16px; margin-bottom: 16px;" data-id="wechatPay">
                            <img height="50" width="50"
                                src="{{ asset('frontend/paymentMethod/wechat.png') }}"
                                alt="Description of image">
                            <p class="mt-2">WeChat pay</p>
                        </div>

                        <div data-bs-toggle="modal" data-bs-target="#modalAlipay"
                            class="cardPayment p-3 flex-grow-1 justify-content-center align-items-center upload-card"
                            style="max-width: calc(25% - 16px); margin-right: 16px; margin-bottom: 16px;" data-id="Alipay">
                            <svg height="50" viewBox="0 0 1024.051 1024" width="50"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m1024.051 701.03v-504.166a196.966 196.966 0 0 0 -196.915-196.864h-630.272a196.966 196.966 0 0 0 -196.864 196.864v630.272a196.915 196.915 0 0 0 196.864 196.864h630.272a197.12 197.12 0 0 0 193.843-162.1c-52.224-22.63-278.528-120.32-396.441-176.64-89.703 108.698-183.706 173.927-325.325 173.927s-236.186-87.245-224.82-194.047c7.476-70.041 55.553-184.576 264.295-164.966 110.08 10.342 160.41 30.873 250.163 60.518 23.194-42.598 42.496-89.446 57.14-139.264h-397.928v-39.424h196.915v-70.86h-240.178v-43.367h240.128v-102.145s2.15-15.974 19.814-15.974h98.458v118.118h256v43.418h-256v70.758h208.845a805.99 805.99 0 0 1 -84.839 212.685c60.672 22.016 336.794 106.393 336.794 106.393zm-740.505 90.573c-149.658 0-173.312-94.464-165.376-133.939 7.833-39.322 51.2-90.624 134.4-90.624 95.59 0 181.248 24.474 284.057 74.547-72.192 94.003-160.921 150.016-253.081 150.016z"
                                    fill="#009fe8" />
                            </svg>
                            <p class="mt-2">AliPay</p>
                        </div>

                        <div data-bs-toggle="modal" data-bs-target="#modalPaypal"
                            class="cardPayment p-3 flex-grow-1 justify-content-center align-items-center upload-card"
                            style="max-width: calc(25% - 16px); margin-right: 16px; margin-bottom: 16px;" data-id="Paypal">
                            <svg height="50" viewBox="5.8 1.3 52.7 61.4" width="50"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m50.3 5.9c-2.8-3.2-8-4.6-14.5-4.6h-19.1c-1.3 0-2.5 1-2.7 2.3l-8 50.4c-.2 1 .6 1.9 1.6 1.9h11.8l3-18.8-.1.6c.2-1.3 1.3-2.3 2.7-2.3h5.6c11 0 19.6-4.5 22.1-17.4.1-.4.1-.8.2-1.1-.3-.2-.3-.2 0 0 .7-4.8 0-8-2.6-11"
                                    fill="#263b80" />
                                <path
                                    d="m52.9 16.9c-.1.4-.1.7-.2 1.1-2.5 12.9-11.1 17.4-22.1 17.4h-5.6c-1.3 0-2.5 1-2.7 2.3l-3.7 23.3c-.1.9.5 1.7 1.4 1.7h9.9c1.2 0 2.2-.9 2.4-2l.1-.5 1.9-11.8.1-.7c.2-1.2 1.2-2 2.4-2h1.5c9.6 0 17.1-3.9 19.3-15.2.9-4.7.4-8.7-2-11.4-.8-.9-1.7-1.6-2.7-2.2"
                                    fill="#139ad6" />
                                <path
                                    d="m50.2 15.9-1.2-.3c-.4-.1-.8-.2-1.3-.2-1.5-.3-3.2-.4-4.9-.4h-14.9c-.4 0-.7.1-1 .2-.7.3-1.2 1-1.3 1.8l-3.2 20.1-.1.6c.2-1.3 1.3-2.3 2.7-2.3h5.6c11 0 19.6-4.5 22.1-17.4.1-.4.1-.8.2-1.1-.6-.3-1.3-.6-2.1-.9-.2 0-.4-.1-.6-.1"
                                    fill="#232c65" />
                                <path d="m35.7 1.3h-19c-1.3 0-2.5 1-2.7 2.3l-4.6 28.8 30.8-30.8c-1.4-.2-2.9-.3-4.5-.3z"
                                    fill="#2a4dad" />
                                <path
                                    d="m56.5 20.5c-.3-.5-.5-1-.9-1.5-.7-.8-1.7-1.5-2.7-2.1-.1.4-.1.7-.2 1.1-2.5 12.9-11.1 17.4-22.1 17.4h-5.6c-1.3 0-2.5 1-2.7 2.3l-3.2 20.2z"
                                    fill="#0d7dbc" />
                                <path d="m7.6 55.9h11.8l2.9-18.2c0-.3.1-.5.2-.7l-16.4 16.4-.1.6c-.1 1 .6 1.9 1.6 1.9z"
                                    fill="#232c65" />
                                <path d="m32.1 1.3h-15.4c-.4 0-.7.1-1 .2l-1.5 1.5c-.1.2-.2.4-.2.6l-3 18.8z"
                                    fill="#436bc4" />
                                <path
                                    d="m57.6 30.4c.3-1.5.4-2.9.4-4.3l-19.5 19.5c9.5-.1 16.9-4 19.1-15.2zm-25.2 29.8 1.6-10-12.5 12.5h8.5c1.2 0 2.2-.9 2.4-2z"
                                    fill="#0cb2ed" />
                                <path
                                    d="m52.3 19.6 5.7 5.7c0-.7-.2-1.4-.3-2.1l-5-5c-.2.5-.3.9-.4 1.4zm-1.4 4.2-.6 1.2 6.9 6.9.3-1.5zm4.3 13.4.6-1.2-7.6-7.6c-.3.3-.5.7-.8 1zm-12-4.6 8.7 8.7.9-.9-8.5-8.5c-.4.2-.7.4-1.1.7zm-5.3 2 9.5 9.5 1.2-.6-9.3-9.3c-.5.1-.9.3-1.4.4zm3.5 10.9c.5-.1 1.1-.1 1.6-.2l-10-10c-.6 0-1.1.1-1.7.1zm-15.6-10.1h-.8c-.3 0-.6.1-.8.1l10.8 10.9c.3-.3.7-.6 1.1-.7zm-4 5.2 11.8 11.8.3-1.6-11.8-11.8zm-1 6.3 11.8 11.8.3-1.5-11.8-11.8zm-.7 4.8-.2 1.6 9.4 9.4h.7c.3 0 .6-.1.9-.2zm-1.3 7.9 3.1 3.1h1.8l-4.6-4.6z"
                                    fill="#33e2ff" opacity=".6" />
                            </svg>
                            <p class="mt-2">PayPal</p>
                        </div>

                        <div data-bs-toggle="modal" data-bs-target="#bankTransfer"
                            class="cardPayment p-3 flex-grow-1 justify-content-center align-items-center upload-card"
                            style="max-width: calc(25% - 16px); margin-right: 16px; margin-bottom: 16px;" data-id="Bank Transfer">
                            <img height="50" width="50"
                                src="{{ asset('frontend/paymentMethod/bank-transfer-circle-round-payment-method-19792.png') }}"
                                alt="Description of image">
                            <p class="mt-2">Bank Transfer</p>
                        </div>
                    </div>

                </div>
                
            </div>

            <div class="multisteps-form__content mt-3">
                <div class="button-row d-flex justify-content-between mt-4">
                    <button class="btn btn-secondary js-btn-prev" type="button" title="Prev">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Previous
                    </button>

                    <input type="hidden" name="payment_method" id="payment_method">

                    <button class="btn btn-primary-light-bg ml-auto mt-2 submit-payment" id="submit-payment"
                        type="submit" title="" style="display: none">
                        <span class="">Submit</span>
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
        {{-- </form> --}}
    </div>

    <!-- WeChat Modal -->
    <div class="modal fade" id="modalWechat" tabindex="-1" aria-labelledby="modalWechatLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <button type="button" class="btn-close top-right" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <div class="text-center w-100">
                        <img src="{{ asset('frontend/paymentMethod/wechatQR.jpg') }}" alt="WeChat QR Code"
                            class="img-fluid" style="width: 50%">
                        <p class="mt-2">Please upload the screenshot of your transaction record after payment.</p>
                        <div class="d-flex gap-3 justify-content-center align-items-center">
                            <button type="button" onclick="document.getElementById('fileInputWechat').click()"
                                class="btn btn-primary-bg">
                                <i class="fa fa-upload me-2" aria-hidden="true"></i>Upload Payment receipt
                            </button>
                            <input type="file" name="wechat_payment_receipt" id="fileInputWechat"
                                style="display: none;" accept="image/*"
                                onchange="previewImage(event, 'imagePreviewWechat', 'previewWechat', 'modalWechat','wechatPay')">
                            {{-- <input type="hidden" name="payment_method" value="WeChat Pay"> --}}
                            <div id="imagePreviewWechat" style="display: none;">
                                <img src="" alt="Image Preview" id="previewWechat"
                                    style="max-width: 100px; max-height: 100px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- AliPay Modal -->
    <div class="modal fade" id="modalAlipay" tabindex="-1" aria-labelledby="modalAlipayLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <button type="button" class="btn-close top-right" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <div class="text-center w-100">
                        <img src="{{ asset('frontend/paymentMethod/malisha.jpg') }}" alt="AliPay QR Code"
                            class="img-fluid" style="width: 50%">
                        <p class="mt-2">Please upload the screenshot of your transaction record after payment.</p>
                        <div class="d-flex gap-3 justify-content-center align-items-center">
                            <button type="button" onclick="document.getElementById('fileInputAli').click()"
                                class="btn btn-primary-bg">
                                <i class="fa fa-upload me-2" aria-hidden="true"></i>Upload Payment receipt
                            </button>
                            <input type="file" name="alipay_payment_receipt" id="fileInputAli"
                                style="display: none;" accept="image/*"
                                onchange="previewImage(event, 'imagePreviewAli', 'previewAli', 'modalAlipay', 'Alipay')">
                            {{-- <input type="hidden" name="payment_method" value="AliPay"> --}}
                            <div id="imagePreviewAli" style="display: none;">
                                <img src="" alt="Image Preview" id="previewAli"
                                    style="max-width: 100px; max-height: 100px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- PayPal Modal -->
    <div class="modal fade" id="modalPaypal" tabindex="-1" aria-labelledby="modalPaypalLabel" aria-hidden="true">
        <div class="modal-dialog custom-modal-width modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <button type="button" class="btn-close top-right" data-bs-dismiss="modal"
                        aria-label="Close"></button>

                    <div class="sidebar d-flex flex-column justify-content-center align-items-center p-3">
                        <svg height="80" viewBox="5.8 1.3 52.7 61.4" width="80"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m50.3 5.9c-2.8-3.2-8-4.6-14.5-4.6h-19.1c-1.3 0-2.5 1-2.7 2.3l-8 50.4c-.2 1 .6 1.9 1.6 1.9h11.8l3-18.8-.1.6c.2-1.3 1.3-2.3 2.7-2.3h5.6c11 0 19.6-4.5 22.1-17.4.1-.4.1-.8.2-1.1-.3-.2-.3-.2 0 0 .7-4.8 0-8-2.6-11"
                                fill="#263b80" />
                            <path
                                d="m52.9 16.9c-.1.4-.1.7-.2 1.1-2.5 12.9-11.1 17.4-22.1 17.4h-5.6c-1.3 0-2.5 1-2.7 2.3l-3.7 23.3c-.1.9.5 1.7 1.4 1.7h9.9c1.2 0 2.2-.9 2.4-2l.1-.5 1.9-11.8.1-.7c.2-1.2 1.2-2 2.4-2h1.5c9.6 0 17.1-3.9 19.3-15.2.9-4.7.4-8.7-2-11.4-.8-.9-1.7-1.6-2.7-2.2"
                                fill="#139ad6" />
                            <path
                                d="m50.2 15.9-1.2-.3c-.4-.1-.8-.2-1.3-.2-1.5-.3-3.2-.4-4.9-.4h-14.9c-.4 0-.7.1-1 .2-.7.3-1.2 1-1.3 1.8l-3.2 20.1-.1.6c.2-1.3 1.3-2.3 2.7-2.3h5.6c11 0 19.6-4.5 22.1-17.4.1-.4.1-.8.2-1.1-.6-.3-1.3-.6-2.1-.9-.2 0-.4-.1-.6-.1"
                                fill="#232c65" />
                            <path d="m35.7 1.3h-19c-1.3 0-2.5 1-2.7 2.3l-4.6 28.8 30.8-30.8c-1.4-.2-2.9-.3-4.5-.3z"
                                fill="#2a4dad" />
                            <path
                                d="m56.5 20.5c-.3-.5-.5-1-.9-1.5-.7-.8-1.7-1.5-2.7-2.1-.1.4-.1.7-.2 1.1-2.5 12.9-11.1 17.4-22.1 17.4h-5.6c-1.3 0-2.5 1-2.7 2.3l-3.2 20.2z"
                                fill="#0d7dbc" />
                            <path d="m7.6 55.9h11.8l2.9-18.2c0-.3.1-.5.2-.7l-16.4 16.4-.1.6c-.1 1 .6 1.9 1.6 1.9z"
                                fill="#232c65" />
                            <path d="m32.1 1.3h-15.4c-.4 0-.7.1-1 .2l-1.5 1.5c-.1.2-.2.4-.2.6l-3 18.8z"
                                fill="#436bc4" />
                            <path
                                d="m57.6 30.4c.3-1.5.4-2.9.4-4.3l-19.5 19.5c9.5-.1 16.9-4 19.1-15.2zm-25.2 29.8 1.6-10-12.5 12.5h8.5c1.2 0 2.2-.9 2.4-2z"
                                fill="#0cb2ed" />
                            <path
                                d="m52.3 19.6 5.7 5.7c0-.7-.2-1.4-.3-2.1l-5-5c-.2.5-.3.9-.4 1.4zm-1.4 4.2-.6 1.2 6.9 6.9.3-1.5zm4.3 13.4.6-1.2-7.6-7.6c-.3.3-.5.7-.8 1zm-12-4.6 8.7 8.7.9-.9-8.5-8.5c-.4.2-.7.4-1.1.7zm-5.3 2 9.5 9.5 1.2-.6-9.3-9.3c-.5.1-.9.3-1.4.4zm3.5 10.9c.5-.1 1.1-.1 1.6-.2l-10-10c-.6 0-1.1.1-1.7.1zm-15.6-10.1h-.8c-.3 0-.6.1-.8.1l10.8 10.9c.3-.3.7-.6 1.1-.7zm-4 5.2 11.8 11.8.3-1.6-11.8-11.8zm-1 6.3 11.8 11.8.3-1.5-11.8-11.8zm-.7 4.8-.2 1.6 9.4 9.4h.7c.3 0 .6-.1.9-.2zm-1.3 7.9 3.1 3.1h1.8l-4.6-4.6z"
                                fill="#33e2ff" opacity=".6" />
                        </svg>
                        <p class="text-center" style="font-size: 22px; color:white;">PayPal</p>
                    </div>

                    <div class="right-side right-side-margin">
                        <p><span class="fw-bold">PayPal Account Number:</span> korban_ali@hotmail.com</p>
                        <p>Please upload your receipt after completing payment (PayPal charges a transaction service
                            fee).</p>
                        <p>Upload the screenshot of the transaction record after payment:</p>

                        <div class="d-flex gap-3 align-items-center">
                            <a href="javascript:void(0)" onclick="document.getElementById('fileInputPaypal').click()"
                                class="fw-bold btn btn-primary-bg">
                                <i class="fa fa-upload me-2"></i>Upload Payment receipt
                            </a>
                            <input type="file" name="paypal_payment_receipt" id="fileInputPaypal"
                                style="display: none;" accept="image/*"
                                onchange="previewImage(event, 'imagePreviewPaypal', 'previewPaypal', 'modalPaypal','Paypal')">
                            {{-- <input type="hidden" name="payment_method" value="PayPal"> --}}

                            <div id="imagePreviewPaypal" style="display: none;">
                                <img src="" alt="Image Preview" id="previewPaypal"
                                    style="max-width: 100px; max-height: 100px; margin-left: 10px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bank Transfer Modal -->
    <div class="modal fade" id="bankTransfer" tabindex="-1" aria-labelledby="bankTransferLabel"
        aria-hidden="true">
        <div class="modal-dialog custom-modal-width modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <button type="button" class="btn-close top-right" data-bs-dismiss="modal"
                        aria-label="Close"></button>

                    <div class="sidebar d-flex flex-column justify-content-center align-items-center p-3">
                        <img height="80" width="80"
                            src="{{ asset('frontend/paymentMethod/bank-transfer-circle-round-payment-method-19792.png') }}"
                            alt="Description of image">
                        <p class="text-center" style="font-size: 22px; color:white;">BANK TRANSFER IN USD</p>
                    </div>

                    <div class="mt-3 right-side">
                        <p><span class="fw-bold">Account Name:</span>Guangzhou MalishaEdu Co., Limited</p>
                        <p><span class="fw-bold">Bank Name:</span> ICBC Guangzhou South Branch</p>
                        <p><span class="fw-bold">Account Number:</span> 3602041709140229437</p>
                        <p><span class="fw-bold">Swift code:</span> ICBKCNBJGDG</p>
                        <p><span class="fw-bold">Address:</span> 2nd Floor Crowne Plaza ,Huanshi Donglu 339, Yuexiu District ,Guangzhou City, Guangdong Provice, P.R China 510000</p>
                        <p>Please upload the screenshot of the transaction record after payment.</p>

                        <div class="d-flex gap-3 align-items-center">
                            <a href="javascript:void(0)" onclick="document.getElementById('fileInputBank').click()"
                                class="fw-bold btn btn-primary-bg">
                                <i class="fa fa-upload me-2"></i>Upload Payment receipt
                            </a>
                            <input type="file" name="bank_payment_receipt" id="fileInputBank"
                                style="display: none;" accept="image/*"
                                onchange="previewImage(event, 'imagePreviewBank', 'previewBank', 'bankTransfer','Bank Transfer')">

                            {{-- <input type="hidden" name="payment_method" value="Bank Transfer"> --}}

                            <div id="imagePreviewBank" style="display: none;">
                                <img src="" alt="Image Preview" id="previewBank"
                                    style="max-width: 100px; max-height: 100px; margin-left: 10px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<style>
    .cardPayment {
        height: 200px;
        border: 2px solid rgb(141, 139, 139);
        border-radius: 4px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .modal-body {
        height: 420px;
        display: flex;
        gap: 40px;
    }

    .sidebar {
        width: 300px !important;
        background-color: var(--primary_background);
        border-top-right-radius: 100px;
        border-bottom-right-radius: 100px;
        margin: 0;
    }

    .sidebarWeChat {
        width: 300px !important;
        background-color: rgb(218, 255, 218);
        border-top-right-radius: 100px;
        border-bottom-right-radius: 100px;
        margin: 0;
    }

    .sidebarAlipay {
        width: 300px !important;
        background-color: rgb(218, 255, 218);
        border-top-right-radius: 100px;
        border-bottom-right-radius: 100px;
        margin: 0;
    }

    .right-side {
        background-image: url('/frontend/images/section_bg.webp');
    }

    .right-side-margin {
        margin-top: 80px;
    }

    .custom-modal-width {
        max-width: 1200px;
        width: 100%;
    }

    .top-right {
        position: absolute;
        top: 15px;
        right: 15px;
    }
</style>

<script>


   function previewImage(event, previewContainerId, previewImageId, modalId, paymentMethod) {
    const file = event.target.files[0];
    const previewContainer = document.getElementById(previewContainerId);
    const previewImage = document.getElementById(previewImageId);
    const modalElement = document.getElementById(modalId);
    const submitPaymentBtn = document.getElementById('submit-payment');
    const paymentMethodName = document.getElementById('payment_method');

    // Get all payment method divs
    const paymentMethods = document.querySelectorAll('.cardPayment');

    // Disable other payment methods when a file is selected
    if (file) {
        submitPaymentBtn.style.display = 'inline';  // Show submit button
        previewImage.src = URL.createObjectURL(file);  // Set preview image
        previewContainer.style.display = 'block';  // Show preview container
        paymentMethodName.value = paymentMethod;  // Set selected payment method

        // Disable all other payment methods
        paymentMethods.forEach(method => {
            if (method.getAttribute('data-id') !== paymentMethod) {
                method.classList.add('disabled');
                method.style.pointerEvents = 'none'; // Make it unclickable
            }
        });

        // Hide the modal after selecting an image
        const modalInstance = bootstrap.Modal.getInstance(modalElement);
        if (modalInstance) modalInstance.hide();
    } else {
        // Hide the preview container if no file is selected
        previewContainer.style.display = 'none';

        // Re-enable all payment methods if no file is selected
        paymentMethods.forEach(method => {
            method.classList.remove('disabled');
            method.style.pointerEvents = 'auto';  // Make them clickable again
        });
    }
}



    
</script>

<style>
    .cardPayment.disabled {
    opacity: 0.5; /* Lower opacity to indicate it's disabled */
}
</style>