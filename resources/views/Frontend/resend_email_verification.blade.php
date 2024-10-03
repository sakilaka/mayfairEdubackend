<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

     @php
        $site_setting = \App\Models\SiteSetting::first();
    @endphp
      <title>Resent email verification - {{@$site_setting->company_name}}</title>
    <link rel="icon" type="image/x-icon" href="{{@$site_setting->header_image_show}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('frontend/css/login.css') }}" />
    <style>
         .google_btn button {
        display: block;
        transition: 0.35s ease-in-out;
        font-size: 14px;
        border-radius: 36px;
        border: 1px solid rgb(148, 148, 148);
        height: 40px;
        text-align: center;
        padding: 3px 16px;
        font-weight: 600;
        width: 100%;
        color: #303030;
        background-color: transparent;
        line-height: 34px;
        position: relative;
        background-color: #40e16b;
        text-decoration: none;
    }
     .google_btn button img {
        position: absolute;
        left: 22px;
        top: 26%;
    }
    </style>
  </head>

  <body>
    <header></header>

    <main>
      <section class="log_in_innerSect">
        <div class="login_container">
          <div class="container">
            <div class="login_Contains">
              <div class="row">
                <div class="col-lg-6">
                  <div class="login_formLeftContent">
                    <div class="login_contains">
                      <div class="login-left_heading">
                        <h3 class="main-heading_leftForm">
                          Welcome to SafiHealth
                        </h3>
                        <p class="subTitle_form">Search Your Dream Home</p>
                      </div>
                      <div class="lef-form_Banner_Image">
                        <img
                          src="public/frontend/images/Dream-House-Transparent.png"
                          alt=""
                        />
                      </div>
                      <div class="short_textInner">
                        <p>
                         Bigest Digital E-Health Service in the Country.We are always for you.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="login_formRightContent">
                    <div class="form_title">
                      <h4>SafiHealth</h4>
                      <p>Sign in to your account</p>
                    </div>


    {{-- success message start --}}
    @if(session()->has('message'))
    <div class="alert alert-success">
    {{-- <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true"></button> --}}
    {{session()->get('message')}}
    </div>
    <script>
        setTimeout(function(){
            $('.alert.alert-success').hide();
        }, 3000);
    </script>
    @endif
     @if(session()->has('error'))

        <div class="alert alert-danger">{{ session()->get('error') }}</div>

    @endif
    {{-- success message start --}}

                    <form action="{{ route('frontend.login') }}" method="POST" class="row g-3">
                      @csrf
                      <input type="text" value="{{ $user_id }}">

                      <div class="col-12">
                        <div class="submitBtn">
                          <button type="submit" class="btn btn-primary">
                            Sign In
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer></footer>
  </body>
</html>
