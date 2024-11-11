@extends('Frontend.layouts.master-layout')
@section('title','- Checkout')
@section('head')

@endsection
@section('main_content')

<!-- Main content -->

<div class="content_search" style="margin-top:70px">
    <style>
ul li {
    list-style: none;
}

#pswd_info {
    position: absolute;
    top: calc(100% + -40px);
    bottom: -115px\9;
    /* left: 45px; */
    width: 250px;
    padding: 15px;
    background: #fefefe;
    font-size: .875em;
    border-radius: 5px;
    box-shadow: 0 1px 3px #ccc;
    border: 1px solid #ddd;
    z-index: 11;
}

#pswd_info h4 {
    margin: 0 0 10px 0;
    padding: 0;
    font-weight: normal;
}

#pswd_info::before {
    content: "\25B2";
    position: absolute;
    top: -12px;
    left: 45%;
    font-size: 14px;
    line-height: 14px;
    color: #ddd;
    text-shadow: none;
    display: block;
}

#confirm-pswd_info {
    position: absolute;
    top: calc(100% + -40px);
    bottom: -115px\9;
    width: 250px;
    padding: 15px;
    background: #fefefe;
    font-size: .875em;
    border-radius: 5px;
    box-shadow: 0 1px 3px #ccc;
    border: 1px solid #ddd;
    z-index: 11;
}

#confirm-pswd_info h4 {
    margin: 0 0 10px 0;
    padding: 0;
    font-weight: normal;
}

#confirm-pswd_info::before {
    content: "\25B2";
    position: absolute;
    top: -12px;
    left: 45%;
    font-size: 14px;
    line-height: 14px;
    color: #ddd;
    text-shadow: none;
    display: block;
}

.invalid {
    background: url(../assets/invalid.png) no-repeat 0 50%;
    padding-left: 22px;
    line-height: 24px;
    color: #ec3f41;
}

.valid {
    background: url(../assets/valid.png) no-repeat 0 50%;
    padding-left: 28px;
    line-height: 24px;
    color: #3a7d34;
}

#pswd_info {
    display: none;
}

#confirm-pswd_info {
    display: none;
}
</style>


<form id="checkout_data" action="{{route('order')}}"  enctype="multipart/form-data" method="post">
@csrf
{{-- <input type="hidden" name="csrf_test_name" value="36d805a0f12897f142946a4cab50575c" />
<input type="hidden" id="sess_id" value="ch4jr6ouu3shlmu9bi290cejt4uisob4"> --}}

<div class="bg-alice-blue py-5">
    <div class="container-lg p-0">
        <div class="row g-1">
            <div class="col-md-5 col-lg-4 order-md-last sticky-content">
                <div class="card border-0 rounded-0 shadow-sm mb-3 page-section">
                    <div class="card-body p-4 p-xl-5">

                        <h5 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-dark-cerulean">Your Order</span>
                            <!-- <span class="badge bg-dark-cerulean rounded-circle">3</span> -->
                        </h5>
                        @if(session('cart'))
                                @php
                                    $total=0;
                                @endphp
                                @foreach(session('cart') as $id => $details)
                                @php
                                   $total =$total+ $details['fee']
                                @endphp
                                @endforeach

                        @endif
                        <ul class="list-group mb-3" style="list-style: none;" id="chkout">
                            <li class="border-bottom d-flex justify-content-between lh-sm mb-2 pb-2">
                                <div>
                                    <h6 class="my-0">Course</h6>
                                    <!-- <small class="text-muted">Brief description</small> -->
                                </div>
                                <span class="text-muted">Total</span>
                            </li>
                             <input type="hidden" value="0" id="is_course_type"
                                name="is_course_type[]">
                            <li class="border-bottom d-flex justify-content-between lh-sm mb-2 pb-2">
                                <div style="width:70%">
                                    <h6 class="my-0"
                                        style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                                        Stock Market Investment: How to Earn by Investing
                                    </h6>
                                    <span class="fs-12 text-danger"></span>
                                </div>
                                <span class="text-muted" style="width:30%;text-align:right">


                                    <input type="hidden" name="affiliator_id" id="affiliator_id" value="">
                                   {{ format_price(@$total) }}
                                </span>
                            </li>

                            <li class="border-bottom d-flex justify-content-between lh-sm mb-2 pb-2 cart-subtotal">
                                <h6 class="my-0">Subtotal</h6>
                                <span class="woocommerce-Price-amount amount">
                                    <span class="woocommerce-Price-currencySymbol">
                                    </span>  {{ format_price( @$total) }}
                                    <input type="hidden" name="sub_total" value="{{@$total}}"/>
                                </span>
                            </li>

                            <!-- coupon end -->

                           <li class="border-bottom d-flex justify-content-between lh-sm mb-2 pb-2 coupon-areashow"
                                id="couponAmountRow" @if(!session()->has("add_coupon_code")) style="display:none!important;" @endif>
                                <div>
                                    <div class="coupon_discount">
                                        <h6 class="my-0">Coupon Discount</h6>
                                        @php
                                           $coupon_amount = session()->has("add_coupon_code") ? session()->get("add_coupon_amount") : 0;
                                        @endphp
                                        <span class="text-danger fs-12" id="course_coupon_course_name">{{ session()->get("add_coupon_code") }}</span>
                                    </div>
                                </div>
                                <!-- <td class="text-right"> -->
                                <!-- <span id="set_coupon_price"></span> -->
                                <span class="text-muted" id="set_coupon_price">{{ $coupon_amount }}</span>
                                <!-- </td> -->
                            </li>
                            <li class="border-bottom d-flex justify-content-between lh-sm mb-2 pb-2 order-total">
                                <h6>Total</h6>
                                <td class="text-right">
                                 @php
                                    $total = (float)$total -  (float)$coupon_amount;
                                 @endphp
                                    <strong>
                                        <span class="woocommerce-Price-amount amount">
                                            <span class="woocommerce-Price-currencySymbol"></span>
                                                  <span id="total_amount">{{ format_price(@$total)}}</span>
                                        </span>
                                    </strong>

                                    <input type="hidden" name="total_amount" id="cart_total_amount"
                                        value="{{ @$total}}">

                                </td>
                            </li>
                            <!-- coupon start  -->
                             <li class="border-bottom  justify-content-between lh-sm mb-2 pb-2 coupon_input" @if(session()->has("add_coupon_code")) style="display:none;" @endif>
                                <span class="text-danger" id="coupon_error_text_color"><span
                                        id="coupon_error"></span></span>
                                <span class="control-label font-weight-600" for="coupon_code">Use coupon code </span>
                                <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    Enter your coupon here
                                </a>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <div class="row g-3">
                                            <!-- col-auto -->
                                            <div class="">
                                                <input type="text" id="coupon_code" class="form-control"
                                                    name="coupon_code" placeholder="Enter your coupon here">
                                            </div>
                                            <div class="col-auto">
                                                <a class="btn btn-primary" id="coupon_value">Apply Coupon</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="agree" value="" id="flexCheckDefault" required>
                            <label class="form-check-label" for="flexCheckDefault">
                                I read and agree to the <a
                                    href="https://lead.academy/terms-condition">Terms
                                    &amp; Conditions</a>,
                                <a href="https://lead.academy/privacy-policy">
                                    Privacy Policy</a>, and
                                <a href="https://lead.academy/refund-policy">
                                    Return and
                                    Refund Policy.</a>
                            </label>
                        </div>
                        <h5 class="mt-4 text-dark-cerulean">Payment</h5>

                        @php
                            $payment_gateway= \App\Models\Tp_option::where('option_name', 'payment_gateway')->first();

                            $payment_gateway = json_decode($payment_gateway->option_value);
                        @endphp

                      @if ($payment_gateway->stripe_status=='1')
                         <div class="payment-block" id="stipe_payment">
                            <div class="payment-item mb-3">
                                <input type="radio" name="payment_method" class="p_method"
                                    id="payment_method_stripe" data-parent="#payment"
                                    data-target="#description_Bkash" value="stripe" checked>
                                <label for="payment_method_stripe">Stripe </label>
                                {{-- <input type="hidden" name="card_number" value="">
                                card_number
                                card_ma
                                card_ye
                                cv --}}

                                <img src="{{ asset('upload/paymentgateway/'.$payment_gateway->stripe_icon) }}" alt="stripe_logo" width="80px" height="95px" class="img-fluid mb-2 p-2"/>
                             </div>
                             <div id="pay_stripe" class="row hideclass">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="form-control" id="card-element"></div>
                                                <span class="card-errors" id="card-errors"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      @endif

                      @if ($payment_gateway->paypal_status=='1')
                         <div class="payment-block" id="paypal_payment">
                            <div class="payment-item mb-3">
                                <input type="radio" name="payment_method" class="p_method"
                                id="payment_method_paypal" data-parent="#payment"
                                data-target="#description_SSLCOMMERZ" value="paypal">
                                <label for="payment_method_paypal">Paypal </label>
                                <img src="{{ asset('upload/paymentgateway/'.$payment_gateway->paypal_icon) }}" alt="paypal_logo" width="90px" height="70px" class="img-fluid mb-2 p-2"/>
                            </div>
                        </div>
                      @endif
                     @if(($payment_gateway->cod_status ?? 0)=='1')
                     <div class="payment-block" id="cash_payment">
                        <div class="payment-item mb-3">
                           <input type="radio" name="payment_method" class="p_method"
                            id="payment_method_cod" value="cod">
                           <label for="payment_method_cod">Payment via Cash </label>
                            
                        </div>
                     </div>
                     @endif
                     <button class="w-100 btn btn-dark-cerulean btn-lg mt-3 btn-checkout" type="submit">Continue to checkout</button>
                    </div>
                </div>
            </div>






            <div class="col-md-7 col-lg-8 sticky-content">
                <div class="card border-0 rounded-0 shadow-sm mb-3 page-section">
                    <div class="card-body p-4 p-xl-5">
                        <h5 class="mb-3 text-dark-cerulean">Billing address</h5>
                        <!-- <form class="needs-validation" novalidate> -->
                        <div class="row g-3">

                            <div class="col-sm-12">
                                <label for="firstName" class="form-label">Name <i class="text-danger"> *</i></label>
                                <!-- <input type="text" class="form-control" id="name" placeholder="" value="md shohag hossen" required> -->
                                <input id="name" type="text" class="form-control" name="name"
                                    placeholder="Name"
                                    value="{{auth()->check() == true ? auth()->user()->name:''}}">
                                    <div class="error_name invalid"></div>
                            </div>

                            <div class="col-6">
                                <label for="mail" class="form-label">Email <span
                                        class="text-muted"><i class="text-danger"> *</i></span></label>
                                <input id="email" type="email" class="form-control" name="email"
                                     value="{{auth()->check() == true ? auth()->user()->email:''}}"
                                    placeholder="Email">
                                <div class="error_email invalid"></div>
                            </div>

                            <div class="col-6">
                                <label for="mobile" class="form-label">Mobile <span class="text-muted"><i class="text-danger"> *</i></span></label>
                                <!-- <div class="input-group has-validation"> -->
                                    <input id="phone" type="number" class="form-control" name="mobile"
                                    onkeyup="existing_mobilecheck()" value="{{auth()->check() == true ? auth()->user()->mobile:''}}"
                                    placeholder="Mobile" required>
                                    <div class="error_mobile invalid"></div>
                                <!-- </div> -->
                            </div>

                            <!-- Lead Inhouse by @Salehin 06122022 -->
                             <!-- <div class="col-12"> -->
                             <span class="text-white p-1" style="background:#808080;">Optional</span>
                            <!-- </div> -->

                            {{-- validate start  --}}
                            @if(count($errors) > 0)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                            @endif
                            {{-- validate End  --}}

                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <input id="address" type="text" class="form-control" name="address"
                                    placeholder="Address"
                                    value="{{auth()->check() == true ? auth()->user()->address:''}}">
                                <div class="error_address invalid"></div>
                            </div>

                            <div class="col-md-6">
                                <label for="country_id" class="form-label">Country</label>
                                <select class="form-select" name="country_id"
                                    data-placeholder="-- select one --">
                                    <option value="">select one country</option>
                                    <option value="1"> Afghanistan </option>
                                    <option value="2" >Aland Islands </option>
                                     <option value="3" >
                                        Albania</option>
                                     <option value="4" >
                                        Algeria</option>
                                     <option value="5" >
                                        American Samoa</option>
                                     <option value="6" >
                                        Andorra</option>
                                     <option value="7" >
                                        Angola</option>
                                     <option value="8" >
                                        Anguilla</option>
                                     <option value="9" >
                                        Antarctica</option>
                                     <option value="10" >
                                        Antigua and Barbuda</option>
                                     <option value="11" >
                                        Argentina</option>
                                     <option value="12" >
                                        Armenia</option>
                                     <option value="13" >
                                        Aruba</option>
                                     <option value="14" >
                                        Australia</option>
                                     <option value="15" >
                                        Austria</option>
                                     <option value="16" >
                                        Azerbaijan</option>
                                     <option value="17" >
                                        Bahamas</option>
                                     <option value="18" >
                                        Bahrain</option>
                                     <option value="19" >
                                        Bangladesh</option>
                                     <option value="20" >
                                        Barbados</option>
                                     <option value="21" >
                                        Belarus</option>
                                     <option value="22" >
                                        Belgium</option>
                                     <option value="23" >
                                        Belize</option>
                                     <option value="24" >
                                        Benin</option>
                                     <option value="25" >
                                        Bermuda</option>
                                     <option value="26" >
                                        Bhutan </option>
                                     <option value="27" >
                                        Bolivia</option>
                                     <option value="28" >
                                        Bonaire, Sint Eustatius and Saba </option>
                                     <option value="29" >
                                        Bosnia and Herzegovina</option>
                                     <option value="30" >
                                        Botswana</option>
                                     <option value="31" >
                                        Bouvet Island</option>
                                     <option value="32" >
                                        Brazil</option>
                                     <option value="33" >
                                        British Indian Ocean Territory</option>
                                     <option value="34" >
                                        Brunei</option>
                                     <option value="35" >
                                        Bulgaria</option>
                                     <option value="36" >
                                        Burkina Faso</option>
                                     <option value="37" >
                                        Burundi</option>
                                     <option value="38" >
                                        Cambodia</option>
                                     <option value="39" >
                                        Cameroon</option>
                                     <option value="40" >
                                        Canada                                    </option>
                                     <option value="41" >
                                        Cape Verde                                    </option>
                                     <option value="42" >
                                        Cayman Islands                                    </option>
                                     <option value="43" >
                                        Central African Republic                                    </option>
                                     <option value="44" >
                                        Chad                                    </option>
                                     <option value="45" >
                                        Chile                                    </option>
                                     <option value="46" >
                                        China                                    </option>
                                     <option value="47" >
                                        Christmas Island                                    </option>
                                     <option value="48" >
                                        Cocos (Keeling) Islands                                    </option>
                                     <option value="49" >
                                        Colombia                                    </option>
                                     <option value="50" >
                                        Comoros                                    </option>
                                     <option value="51" >
                                        Congo                                    </option>
                                     <option value="52" >
                                        Cook Islands                                    </option>
                                     <option value="53" >
                                        Costa Rica                                    </option>
                                     <option value="55" >
                                        Croatia                                    </option>
                                     <option value="56" >
                                        Cuba                                    </option>
                                     <option value="57" >
                                        Curacao                                    </option>
                                     <option value="58" >
                                        Cyprus                                    </option>
                                     <option value="59" >
                                        Czech Republic                                    </option>
                                     <option value="60" >
                                        Democratic Republic of the Congo                                    </option>
                                     <option value="61" >
                                        Denmark                                    </option>
                                     <option value="62" >
                                        Djibouti                                    </option>
                                     <option value="63" >
                                        Dominica                                    </option>
                                     <option value="64" >
                                        Dominican Republic                                    </option>
                                     <option value="65" >
                                        Ecuador                                    </option>
                                     <option value="66" >
                                        Egypt                                    </option>
                                     <option value="67" >
                                        El Salvador                                    </option>
                                     <option value="68" >
                                        Equatorial Guinea                                    </option>
                                     <option value="69" >
                                        Eritrea                                    </option>
                                     <option value="70" >
                                        Estonia                                    </option>
                                     <option value="71" >
                                        Ethiopia                                    </option>
                                     <option value="72" >
                                        Falkland Islands (Malvinas)                                    </option>
                                     <option value="73" >
                                        Faroe Islands                                    </option>
                                     <option value="74" >
                                        Fiji                                    </option>
                                     <option value="75" >
                                        Finland                                    </option>
                                     <option value="76" >
                                        France                                    </option>
                                     <option value="77" >
                                        French Guiana                                    </option>
                                     <option value="78" >
                                        French Polynesia                                    </option>
                                     <option value="79" >
                                        French Southern Territories                                    </option>
                                     <option value="80" >
                                        Gabon                                    </option>
                                     <option value="81" >
                                        Gambia                                    </option>
                                     <option value="82" >
                                        Georgia                                    </option>
                                     <option value="83" >
                                        Germany                                    </option>
                                     <option value="84" >
                                        Ghana                                    </option>
                                     <option value="85" >
                                        Gibraltar                                    </option>
                                     <option value="86" >
                                        Greece                                    </option>
                                     <option value="87" >
                                        Greenland                                    </option>
                                     <option value="88" >
                                        Grenada                                    </option>
                                     <option value="89" >
                                        Guadaloupe                                    </option>
                                     <option value="90" >
                                        Guam                                    </option>
                                     <option value="91" >
                                        Guatemala                                    </option>
                                     <option value="92" >
                                        Guernsey                                    </option>
                                     <option value="93" >
                                        Guinea                                    </option>
                                     <option value="94" >
                                        Guinea-Bissau                                    </option>
                                     <option value="95" >
                                        Guyana                                    </option>
                                     <option value="96" >
                                        Haiti                                    </option>
                                     <option value="97" >
                                        Heard Island and McDonald Islands                                    </option>
                                     <option value="98" >
                                        Honduras                                    </option>
                                     <option value="99" >
                                        Hong Kong                                    </option>
                                     <option value="100" >
                                        Hungary                                    </option>
                                     <option value="101" >
                                        Iceland                                    </option>
                                     <option value="102" >
                                        India                                    </option>
                                     <option value="103" >
                                        Indonesia                                    </option>
                                     <option value="104" >
                                        Iran                                    </option>
                                     <option value="105" >
                                        Iraq                                    </option>
                                     <option value="106" >
                                        Ireland                                    </option>
                                     <option value="107" >
                                        Isle of Man                                    </option>
                                     <option value="108" >
                                        Israel                                    </option>
                                     <option value="109" >
                                        Italy                                    </option>
                                     <option value="54" >
                                        Ivory Coast                                    </option>
                                     <option value="110" >
                                        Jamaica                                    </option>
                                     <option value="111" >
                                        Japan                                    </option>
                                     <option value="112" >
                                        Jersey                                    </option>
                                     <option value="113" >
                                        Jordan                                    </option>
                                     <option value="114" >
                                        Kazakhstan                                    </option>
                                     <option value="115" >
                                        Kenya                                    </option>
                                     <option value="116" >
                                        Kiribati                                    </option>
                                     <option value="117" >
                                        Kosovo                                    </option>
                                     <option value="118" >
                                        Kuwait                                    </option>
                                     <option value="119" >
                                        Kyrgyzstan                                    </option>
                                     <option value="120" >
                                        Laos                                    </option>
                                     <option value="121" >
                                        Latvia                                    </option>
                                     <option value="122" >
                                        Lebanon                                    </option>
                                     <option value="123" >
                                        Lesotho                                    </option>
                                     <option value="124" >
                                        Liberia                                    </option>
                                     <option value="125" >
                                        Libya                                    </option>
                                     <option value="126" >
                                        Liechtenstein                                    </option>
                                     <option value="127" >
                                        Lithuania                                    </option>
                                     <option value="128" >
                                        Luxembourg                                    </option>
                                     <option value="129" >
                                        Macao                                    </option>
                                     <option value="130" >
                                        Macedonia                                    </option>
                                     <option value="131" >
                                        Madagascar                                    </option>
                                     <option value="132" >
                                        Malawi                                    </option>
                                     <option value="133" >
                                        Malaysia                                    </option>
                                     <option value="134" >
                                        Maldives                                    </option>
                                     <option value="135" >
                                        Mali                                    </option>
                                     <option value="136" >
                                        Malta                                    </option>
                                     <option value="137" >
                                        Marshall Islands                                    </option>
                                     <option value="138" >
                                        Martinique                                    </option>
                                     <option value="139" >
                                        Mauritania                                    </option>
                                     <option value="140" >
                                        Mauritius                                    </option>
                                     <option value="141" >
                                        Mayotte                                    </option>
                                     <option value="142" >
                                        Mexico                                    </option>
                                     <option value="143" >
                                        Micronesia                                    </option>
                                     <option value="144" >
                                        Moldava                                    </option>
                                     <option value="145" >
                                        Monaco                                    </option>
                                     <option value="146" >
                                        Mongolia                                    </option>
                                     <option value="147" >
                                        Montenegro                                    </option>
                                     <option value="148" >
                                        Montserrat                                    </option>
                                     <option value="149" >
                                        Morocco                                    </option>
                                     <option value="150" >
                                        Mozambique                                    </option>
                                     <option value="151" >
                                        Myanmar (Burma)                                    </option>
                                     <option value="152" >
                                        Namibia                                    </option>
                                     <option value="153" >
                                        Nauru                                    </option>
                                     <option value="154" >
                                        Nepal                                    </option>
                                     <option value="155" >
                                        Netherlands                                    </option>
                                     <option value="156" >
                                        New Caledonia                                    </option>
                                     <option value="157" >
                                        New Zealand                                    </option>
                                     <option value="158" >
                                        Nicaragua                                    </option>
                                     <option value="159" >
                                        Niger                                    </option>
                                     <option value="160" >
                                        Nigeria                                    </option>
                                     <option value="161" >
                                        Niue                                    </option>
                                     <option value="162" >
                                        Norfolk Island                                    </option>
                                     <option value="163" >
                                        North Korea                                    </option>
                                     <option value="164" >
                                        Northern Mariana Islands                                    </option>
                                     <option value="165" >
                                        Norway                                    </option>
                                     <option value="166" >
                                        Oman                                    </option>
                                     <option value="167" >
                                        Pakistan                                    </option>
                                     <option value="168" >
                                        Palau                                    </option>
                                     <option value="169" >
                                        Palestine                                    </option>
                                     <option value="170" >
                                        Panama                                    </option>
                                     <option value="171" >
                                        Papua New Guinea                                    </option>
                                     <option value="172" >
                                        Paraguay                                    </option>
                                     <option value="173" >
                                        Peru                                    </option>
                                     <option value="174" >
                                        Phillipines                                    </option>
                                     <option value="175" >
                                        Pitcairn                                    </option>
                                     <option value="176" >
                                        Poland                                    </option>
                                     <option value="177" >
                                        Portugal                                    </option>
                                     <option value="178" >
                                        Puerto Rico                                    </option>
                                     <option value="179" >
                                        Qatar                                    </option>
                                     <option value="180" >
                                        Reunion                                    </option>
                                     <option value="181" >
                                        Romania                                    </option>
                                     <option value="182" >
                                        Russia                                    </option>
                                     <option value="183" >
                                        Rwanda                                    </option>
                                     <option value="184" >
                                        Saint Barthelemy                                    </option>
                                     <option value="185" >
                                        Saint Helena                                    </option>
                                     <option value="186" >
                                        Saint Kitts and Nevis                                    </option>
                                     <option value="187" >
                                        Saint Lucia                                    </option>
                                     <option value="188" >
                                        Saint Martin                                    </option>
                                     <option value="189" >
                                        Saint Pierre and Miquelon                                    </option>
                                     <option value="190" >
                                        Saint Vincent and the Grenadines                                    </option>
                                     <option value="191" >
                                        Samoa                                    </option>
                                     <option value="192" >
                                        San Marino                                    </option>
                                     <option value="193" >
                                        Sao Tome and Principe                                    </option>
                                     <option value="194" >
                                        Saudi Arabia                                    </option>
                                     <option value="195" >
                                        Senegal                                    </option>
                                     <option value="196" >
                                        Serbia                                    </option>
                                     <option value="197" >
                                        Seychelles                                    </option>
                                     <option value="198" >
                                        Sierra Leone                                    </option>
                                     <option value="199" >
                                        Singapore                                    </option>
                                     <option value="200" >
                                        Sint Maarten                                    </option>
                                     <option value="201" >
                                        Slovakia                                    </option>
                                     <option value="202" >
                                        Slovenia                                    </option>
                                     <option value="203" >
                                        Solomon Islands                                    </option>
                                     <option value="204" >
                                        Somalia                                    </option>
                                     <option value="205" >
                                        South Africa                                    </option>
                                     <option value="206" >
                                        South Georgia and the South Sandwich Islands</option>
                                     <option value="207" >
                                        South Korea                                    </option>
                                     <option value="208" >
                                        South Sudan                                    </option>
                                     <option value="209" >
                                        Spain                                    </option>
                                     <option value="210" >
                                        Sri Lanka                                    </option>
                                     <option value="211" >
                                        Sudan                                    </option>
                                     <option value="212" >
                                        Suriname                                    </option>
                                     <option value="213" >
                                        Svalbard and Jan Mayen                                    </option>
                                     <option value="214" >
                                        Swaziland                                    </option>
                                     <option value="215" >
                                        Sweden                                    </option>
                                     <option value="216" >
                                        Switzerland                                    </option>
                                     <option value="217" >
                                        Syria                                    </option>
                                     <option value="218" >
                                        Taiwan                                    </option>
                                     <option value="219" >
                                        Tajikistan                                    </option>
                                     <option value="220" >
                                        Tanzania                                    </option>
                                     <option value="221" >
                                        Thailand                                    </option>
                                     <option value="222" >
                                        Timor-Leste (East Timor)</option>
                                     <option value="223" >
                                        Togo</option>
                                     <option value="224" >
                                        Tokelau</option>
                                     <option value="225" >
                                        Tonga</option>
                                     <option value="226" >
                                        Trinidad and Tobago</option>
                                     <option value="227" >
                                        Tunisia</option>
                                     <option value="228" >
                                        Turkey</option>
                                     <option value="229" >
                                        Turkmenistan</option>
                                     <option value="230" >
                                        Turks and Caicos Islands</option>
                                     <option value="231" >
                                        Tuvalu</option>
                                     <option value="232" >
                                        Uganda</option>
                                     <option value="233" >
                                        Ukraine</option>
                                     <option value="234" >
                                        United Arab Emirates</option>
                                     <option value="235" >
                                        United Kingdom</option>
                                     <option value="236" >
                                        United States</option>
                                     <option value="237" >
                                        United States Minor Outlying Islands</option>
                                     <option value="238" >
                                        Uruguay</option>
                                     <option value="239" >
                                        Uzbekistan</option>
                                     <option value="240" >
                                        Vanuatu</option>
                                     <option value="241" >
                                        Vatican City</option>
                                     <option value="242" >
                                        Venezuela</option>
                                     <option value="243" >
                                        Vietnam</option>
                                     <option value="244" >
                                        Virgin Islands, British</option>
                                     <option value="245" >
                                        Virgin Islands, US</option>
                                     <option value="246" >
                                        Wallis and Futuna</option>
                                     <option value="247" >
                                        Western Sahara</option>
                                     <option value="248" >
                                        Yemen</option>
                                     <option value="249" >
                                        Zambia</option>
                                     <option value="250" >
                                        Zimbabwe</option>
                                </select>
                                <div class="error_country invalid"></div>
                            </div>

                            <div class="col-md-6">
                                <label for="city" class="form-label">Town / City</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Town / City" value="">
                                <div class="error_city invalid"></div>
                            </div>

                            <div class="col-md-6">
                                <label for="city" class="form-label">Province</label>
                                <input id="state" type="text" class="form-control" name="state"
                                    placeholder="Province"
                                    value="">
                                <div class="error_state invalid"></div>
                            </div>

                            <div class="col-md-6">
                                <label for="zip"
                                    class="form-label">Postcode / Zip</label>
                                <input type="number" class="form-control" name="postcode"
                                    placeholder="Postcode / Zip"
                                    value="">
                                <div class="error_postcode invalid"></div>
                            </div>

                            <!-- Lead Inhouse by @Salehin 06122022 -->

                        </div>

                        <div class="row gy-3 mt-3">
                            <div class="col-md-12">

                            </div>
                        </div>

                        <!-- </form> -->
                        <script type="text/.javascript">
                                setTimeout(function () {
                                window.location.href = base_url + "checkout";
                                }, 1000);
                            </script>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

</form>

</div>
<!--======== main content close ==========-->


@endsection
@section('script')
<script>

var error_stripe =0;
var total = "{{ $total }}";
var base_url="{{ url('/') }}";
$("#coupon_value").on("click",function(){
   console.log(this);
   var code = $('#coupon_code').val();
   var coupon_value_text = $('#coupon_value').text();
   if(code != ''){
      $.ajax({
         headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
         type: "POST",
         url:"{{url('get_coupon_amount_by_code')}}/"+code,
         data:{total:total},
         beforeSend: function () {
               $("#coupon_value").html(
                  '<span class="spinner-border spinner-border-sm"></span> Please Wait...'
               );
         },
         success: function (response) {
               if (response.status == "no") {
                  $('#couponAmountRow').hide();
                  $('.coupon_input').show();
                  toastr.error("Coupon Code is found");
               }else{
                  $('#couponAmountRow').show();
                  $('#course_coupon_course_name').text(code);
                  $('#set_coupon_price').text(response.amount);
                  
                  $('.coupon_input').hide();
                  var total_cart_amount = $('#cart_total_amount').val();
                  var total_order_amount = parseFloat(total_cart_amount) + parseFloat(response.amount);
                  $('#cart_total_amount').val(total_order_amount);
                  $('#total_amount').text(total_order_amount);
               }
                 
               $('#coupon_value').html(coupon_value_text);
         }
      });
   }
  
});
$(".btn-checkout").on("click",function(){
    var re_res = true;
     if($('input[name="payment_method"]').val() == "stripe"){
        console.log(error_stripe);
        if(error_stripe == 1){
            console.log(("s"))
            return false;
        }
        if(error_stripe == 0){
            toastr.error("Please Fill Up Stripe Card");
            return false;
        }
     }

    var payment_method = $('input[name="payment_method"]').val();
    var check_btn_text = $(".btn-checkout").text();
    if($('#flexCheckDefault').is(":checked")){
        var form_data=  $("#checkout_data").serialize();
        // form_data['_token']="{{ csrf_token() }}";
        console.log(form_data);
        $.ajax({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            type: "POST",
            url:"{{route('order')}}",
            data:form_data,
            beforeSend: function () {
                $(".btn-checkout").html(
                    '<span class="spinner-border spinner-border-sm"></span> Please Wait...'
                );
            },
            success: function (response) {
                console.log(response);
                var msgType = response.msgType;
                var msg = response.msg;
                if (msgType == "success") {
                    if (payment_method == "stripe") {

                        if (response.intent != "") {
                            onConfirmPayment(response.intent, msg);
                        }


                        //Paypal
                    } else if (payment_method =="paypal") {
                        if (response.intent != "") {
                            window.location.href = response.intent;
                        }


                    }else {
                        //onSuccessMsg(msg);
                        window.location.href = response.intent;
                    }
                } else {
                    if(msgType == "error"){
                        $.each(msg, function (prefix, val) {
                            if (prefix == "oneError") {
                                toastr.error(val[0]);
                            } else {
                              toastr.error(val[0]);
                                $(".error_" + prefix).text(val[0]);
                            }
                        });
                    }else{
                        toastr.error(msg);

                    }

                }
                $('.btn-checkout').html(check_btn_text);
            }
        });
    }
    return false;
});
</script>

@if ($payment_gateway->stripe_status=='1')
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    var validCardNumer = 0;
	var isenable_stripe = "{{ $payment_gateway->stripe_status}}";
	var stripe_key = "{{$payment_gateway->stripe_publice_key }}";
</script>
<script src="{{asset('frontend/payment_method.js')}}"></script>
@endif
@endsection
