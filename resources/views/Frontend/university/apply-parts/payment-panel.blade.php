<div id="payment">
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
    <form action="{{ $route }}" method="post">
        @csrf
        <!--single form panel-->
        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
            <h5 class="multisteps-form__title">Choose Your Payment Method</h5>
            <div class="has-fee">

                <p style="font-size: 1.15rem;">
                    <span style="font-weight: 600; color:black;">Total Fee:</span>
                    {{ convertCurrency($application->application_fee) }}
                </p>
                <div class="service-notes">
                    <input @if ($application->payment_method == 'bkash') checked @endif type="radio" id="option1"
                        name="payment_method" value="bkash">
                    <label for="option1">Pay With bKash</label><br>
                    <input @if ($application->payment_method == 'cash') checked @endif type="radio" id="option2"
                        name="payment_method" value="cash">
                    <label for="option2">Cash</label><br>
                </div>

                <small class="not_payable d-none">
                    Your application is ready to be submitted. We will check it
                    for you for free, and we will get back to you when the
                    application fee is ready to be paid.</small>
            </div>
            <div class="no-fee d-none">
                <div class="PriceToPay" style="text-align: justify;">
                    <div class="d-flex">
                        <p class="service_type"> Application Fee</p>: $ <span class="fee mr-1"
                            style="font-size: 1em;font-weight: bold;">990</span> USD
                    </div>
                </div>
                <div class="not_payable d-none">
                    Your application is ready to be submitted. We will check it for
                    you for free, and we will get back to you</div>
            </div>
            <div class="multisteps-form__content">

                <div class="d-flex align-items-baseline terms-conditions mt-2">
                    <input type="checkbox" name="confirm-terms" id="confirm-terms" class="mr-2"
                        onchange="activatePayment(this)">
                    <label for="confirm-terms">I confirm I have read the refund policy and service terms, and terms and
                        conditions and agree to it.</label>
                </div>
                <div class="payment-methods d-none">

                    <div class="block accordion">
                        <ul>
                            <li class="payment-option">
                                <input type="checkbox" checked="" disabled="">
                                <i></i>
                                <h2 class="d-flex">Credit or Debit Card
                                    <div class="payLogo">
                                        <img
                                            src="https://d2xtzyi0kjzog2.cloudfront.net/static/assets/img/credit-cards/card-logo-visa.e6f1a872f973.svg">
                                        <img
                                            src="https://d2xtzyi0kjzog2.cloudfront.net/static/assets/img/credit-cards/card-logo-mastercard.e46010096770.svg">
                                        <img class="onlyOnDesktop"
                                            src="https://d2xtzyi0kjzog2.cloudfront.net/static/assets/img/credit-cards/card-logo-amex.1f9002692bff.svg">
                                        <img class="onlyOnDesktop"
                                            src="https://d2xtzyi0kjzog2.cloudfront.net/static/assets/img/credit-cards/Maestro_logo.324dcd1ab138.svg">
                                        <img
                                            src="https://d2xtzyi0kjzog2.cloudfront.net/static/assets/img/credit-cards/UnionPay_logo.9b59a572fd63.svg">
                                    </div>
                                </h2>
                                <div class="open d-md-flex w-100 flex-md-column">
                                    <div class="">
                                        <h3>Instructions</h3>
                                        <p>You can pay by credit card including
                                            Visa, Mastercard, American Express,
                                            Maestro, UnionPay and
                                            other bank cards in USD. This secured
                                            payment is powered by Stripe.</p>
                                        <div class="" style="margin-bottom: 30px; text-align: center;">
                                            <div class="PriceToPay">
                                                $<span class="fee">990</span>USD
                                            </div>
                                            <div id="stripe-submit" class="button red">
                                                Pay Now</div>
                                            <img src="https://d2xtzyi0kjzog2.cloudfront.net/static/assets/img/poweredByStripe.d86d23018a86.png"
                                                style="width: 100px;">
                                        </div>
                                    </div>

                                </div>
                            </li>
                            <li class="payment-option">
                                <input type="checkbox" checked="" disabled="">
                                <i></i>
                                <h2 class="d-flex">Wechat Pay
                                    <img class="payLogo"
                                        src="https://d2xtzyi0kjzog2.cloudfront.net/static/assets/img/Wechat-Pay.99580c6de287.png">
                                </h2>
                                <div class="open">
                                    <p>To pay by Wechat please scan the QR code
                                        below.
                                        After you have paid, please send a copy of
                                        the payment receipt by email to
                                        apply@china-admissions.com with your
                                        application ID or upload a copy of receipt
                                        below.</p>

                                    <div class="" style="margin-bottom: 30px; text-align: center;">
                                        <img class="dis" width="300px" src="/static/assets/img/wechat-qrcode.png">
                                        <div class="PriceToPay">
                                            <span class="fee-rmb" id="wechat-fee">7080</span>RMB
                                        </div>
                                        <div id="" class="button red">Scan to Pay</div>

                                    </div>
                                </div>
                            </li>
                            <li class="payment-option" id="paypal_accordion">
                                <input type="checkbox" checked="" disabled="">
                                <i></i>
                                <h2 class="d-flex pb-3">Paypal <img class="payLogo"
                                        src="https://d2xtzyi0kjzog2.cloudfront.net/static/assets/img/PayPal_Logo.fa90774cf997.svg">
                                </h2>
                                <div class="open">
                                    <div class="">
                                        <h3>Instructions</h3>
                                        <p>To make the payment by paypal please
                                            choose
                                            from
                                            the option below and click pay now. If
                                            you
                                            would
                                            like to pay in another currency, such as
                                            GBP
                                            or
                                            Euros, please send us an email to
                                            apply@china-admissions.com and we will
                                            send
                                            you
                                            the payment link.</p>


                                    </div>
                                    <div class="">
                                        <div class="PriceToPay">
                                            $<span class="fee mr-1">990</span>USD
                                        </div>

                                    </div>
                                    <div id="paypal-button-container" style="margin-bottom: 30px;">

                                    </div>

                                </div>
                            </li>
                            <li class="payment-option">
                                <input type="checkbox" checked="" disabled="">
                                <i></i>
                                <h2 class="d-flex">Bank Transfer
                                    <img class="payLogo"
                                        src="https://d2xtzyi0kjzog2.cloudfront.net/static/assets/img/bankTransfer.a88bb0110744.png">
                                </h2>
                                <div class="open">
                                    <p>
                                        For bank transfer: <br>
                                        Please make sure to cover any bank fees. We suggest you use <a
                                            href="http:// wise.com" target="_blank"> wise.com</a> to transfer the
                                        payment for faster transactions and lower fees.
                                    </p>
                                    <h3>In USD* from outside China:</h3>
                                    <p>Name: <strong>China Admissions
                                            Limited</strong><br>
                                        Account Number:
                                        <strong>801-482688-838</strong><br>
                                        Address: <strong>Room 9, 4/F, Beverley
                                            Commercial Centrem 87-105 Chatham Road
                                            South, Tsim Sha Tsui, Kowloon, Hong
                                            Kong</strong><br>
                                        Bank: <strong>HSBC Hong Kong, China
                                            Bank</strong><br>
                                        Bank Address: <strong>Head Office, 1 Queen’s
                                            Road Central, Hong Kong,
                                            China</strong><br>
                                        Swift Code: <strong>HSBCHKHHHKH</strong>
                                    </p>
                                    <p>Please write your application ID in the
                                        subject</p>
                                    <p>*Payments to this account can be accepted in
                                        US Dollar (USD), Euro (EUR), Pound Sterling
                                        (GBP),
                                        Australian Dollar (AUD), New Zealand Dollar
                                        (NZD), Japanese Yen (JPY), Canadian Dollar
                                        (CAD),
                                        Singapore Dollar (SGD), Swiss Franc (CHF)
                                        and Thai Baht (THB)</p>

                                    <h5 class="multisteps-form__title">Paid via Bank Transfer?
                                        Upload your receipt here.</h5>
                                    <p>For receipts on paper, please scan if you can or take a
                                        high-quality photo. For digital receipts, please upload
                                        a
                                        screenshot or a PDF file.


                                    </p>
                                    <div class="list-group-item d-flex justify-content-between receipt-attachment">

                                        <span><span class="fas fa-file"></span></span>
                                        <small class="col-8">
                                            <strong>Click to upload bank receipt</strong>
                                        </small>


                                        <form class="upload-receipt" action="" method="post">
                                            <input type="hidden" name="csrfmiddlewaretoken"
                                                value="D2ErfFCeK4gtXZUv3v4SjLY9WSVz4gQZq25sUGHqf5RqPokv5UyB0HdnCvAiyHUo">
                                            <input hidden="" type="file" name="file" id="receipt">
                                            <input hidden="" type="text" name="title"
                                                value="Payment Receipt">
                                            <button type="submit" class="btn receipt-file-upload">
                                                <span><span class="fas fa-upload"></span></span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>


                </div>
                <div class="button-row d-flex mt-4">
                    <button class="btn btn-secondary js-btn-prev" type="button" title="Prev">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>

                        Previous</button>

                    @if ($application->status == 0)
                        <button class="btn btn-primary-light-bg ml-auto submit-payment" id="submit-payment"
                            type="submit" title="Next">
                            <span class="">Submit</span>
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </button>
                        {{-- @else --}}
                    @endif

                </div>
            </div>
        </div>

    </form>
</div>
