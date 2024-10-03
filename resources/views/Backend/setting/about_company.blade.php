@section('title')
    Admin - Site Setting
@endsection

@extends('Backend.layouts.layouts')

@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader">
          <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Home</a>
          </nav>
        </div><!-- br-pageheader -->

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center mb-4"> About Company Info</h6>
            @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
            @endif
            <!----- Start Add Category Form input ------->
            <div class="col-xl-12 mx-auto">
                <div class="form-layout form-layout-4 py-5">

                    <form action="{{ route('backend.setting.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="row col-sm-4">
                                <label class="col-sm-5 form-control-label">Header Logo: <span class="tx-danger"></span></label>
                                <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                    <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 76px;">
                                        <img class="display-upload-img" style="width: 76px;height: 70px;" src="{{ $site_setting->header_image == '' ? $site_setting->no_image : $site_setting->header_image_show}}" alt="">
                                            <input type="file" name="header_logo" class="form-control upload-img" placeholder="Enter Activity Image"
                                            style="position: absolute;top: 0;opacity: 0;height: 100%;">
                                    </div>
                                </div>
                            </div><!-- row -->
                            <div class="row col-sm-4">
                                <label class="col-sm-5 form-control-label">Footer Logo: <span class="tx-danger"></span></label>
                                <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                    <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 76px;">
                                        <img class="display-upload-img" style="width: 76px;height: 70px;" src="{{ $site_setting->footer_image == '' ? $site_setting->no_image : $site_setting->footer_image_show}}" alt="">
                                            <input type="file" name="footer_logo" class="form-control upload-img" placeholder="Enter Activity Image"
                                            style="position: absolute;top: 0;opacity: 0;height: 100%;">
                                    </div>
                                </div>
                            </div><!-- row -->
                            <div class="row col-sm-4">
                                <label class="col-sm-5 form-control-label">Favicon: <span class="tx-danger"></span></label>
                                <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                    <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 76px;">
                                        <img class="display-upload-img" style="width: 76px;height: 70px;" src="{{ $site_setting->favicon == '' ? $site_setting->no_image : $site_setting->favicon_show}}" alt="">
                                            <input type="file" name="favicon" class="form-control upload-img" placeholder="Enter Activity Image"
                                            style="position: absolute;top: 0;opacity: 0;height: 100%;">
                                    </div>
                                </div>
                            </div><!-- row -->
                        </div>

                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <label class=" form-control-label">Website Title :<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="text" name="web_title" class="form-control" placeholder="Enter Website Title" value="{{ $site_setting->web_title ?? '' }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class=" form-control-label">License No :<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="text" name="license_no" class="form-control" placeholder="Enter License No" value="{{ $site_setting->license_no ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <label class=" form-control-label">Company Name:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="text" name="company_name" class="form-control" placeholder="Enter Company Name" value="{{ $site_setting->company_name ?? '' }}">
                                </div>
                            </div>
                            {{-- <div class="col-sm-6">
                                <label class=" form-control-label">Design By Text:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="text" name="design_by_text"  value="{{ $site_setting->design_by_text ?? '' }}" class="form-control" placeholder="Enter Design By">
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-6">
                                <label class=" form-control-label">Design By Url:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="text" name="design_link_text"  value="{{ $site_setting->design_link_text ?? '' }}" class="form-control" placeholder="Enter URL">
                                </div>
                            </div> --}}
                            <div class="col-sm-6">
                                <label class=" form-control-label">Payment Title:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="text" name="payment_title"  value="{{ $site_setting->payment_title ?? '' }}" class="form-control" placeholder="Enter Payment Title">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class=" form-control-label">Payment Image:<span class="tx-danger"></span></label>
                                <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                    <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 150px;">
                                        <img class="display-upload-img" style="width: 150px;height: 70px;" src="{{ $site_setting->payment_image_show}}" alt="">
                                            <input type="file" name="payment_image" class="form-control upload-img" placeholder="Enter Activity Image"
                                            style="position: absolute;top: 0;opacity: 0;height: 100%;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class=" form-control-label">Copy Right's' Text:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="text" name="right_text"  value="{{ $site_setting->right_text ?? '' }}" class="form-control" placeholder="Enter Copy Rights">
                                </div>
                            </div>

                        </div><!-- row -->
                        <hr/>
                        <h2>Addres 1</h2>
                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <label class=" form-control-label">Address Title:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="text" value="{{ $site_setting->address_title1 ?? '' }}" name="address_title1" class="form-control" placeholder="Enter Address Title">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class=" form-control-label">Email:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input  value="{{ $site_setting->email1 ?? '' }}" type="text" name="email1" class="form-control" placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class=" form-control-label">Phone:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input  value="{{ $site_setting->phone1 ?? '' }}" type="text" name="phone1" class="form-control" placeholder="Enter Phone">
                                </div>
                            </div>


                           <div class="col-sm-6">
                                <label class=" form-control-label">Address:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="text"  value="{{ $site_setting->address1 ?? '' }}" name="address1" class="form-control" placeholder="Enter Address">
                                </div>
                            </div>
                        </div><!-- row -->
                        <hr/>
                        <h2>Addres 2</h2>
                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <label class=" form-control-label">Address Title:<span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input  value="{{ $site_setting->address_title2 ?? '' }}" type="text" name="address_title2" class="form-control" placeholder="Enter Address Title">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class=" form-control-label">Email:<span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="text"  value="{{ $site_setting->email2 ?? '' }}" name="email2" class="form-control" placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class=" form-control-label">Phone:<span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input  value="{{ $site_setting->phone2 ?? '' }}" type="text" name="phone2" class="form-control" placeholder="Enter Phone">
                                </div>
                            </div>


                           <div class="col-sm-6">
                                <label class=" form-control-label">Address:<span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="text"  value="{{ $site_setting->address2 ?? '' }}" name="address2" class="form-control" placeholder="Enter Address">
                                </div>
                            </div>
                        </div><!-- row -->
                        <hr/>
                        <h2>Social link</h2>
                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <label class=" form-control-label">Facebook link:<span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="text"  value="{{ $site_setting->facebook ?? '' }}" name="facebook" class="form-control" placeholder="Enter facebook link">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class=" form-control-label">Twitter link:<span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="text"  value="{{ $site_setting->twitter ?? '' }}" name="twitter" class="form-control" placeholder="Enter twitter link">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class=" form-control-label">Instagram link:<span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="text"  value="{{ $site_setting->instagram ?? '' }}" name="instagram" class="form-control" placeholder="Enter instagram link">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class=" form-control-label">Youtube link:<span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="text"  value="{{ $site_setting->youtube ?? '' }}" name="youtube" class="form-control" placeholder="Enter youtube link">
                                </div>
                            </div>
                          </div>

                          <hr/>
                        <h2>Pay With</h2>

                        <div class="row mt-4">
                            <div class="col-sm-12">

                                <div class="mg-t-10 mg-sm-t-0 add-data">
                                    @if($site_setting->paywiths->count() == 0)
                                    <div class="d-flex align-items-center mt-2">

                                     <div class="d-flex align-items-center select-add-section p-2" style="width: 40%;">
                                        <input type="text" name="pay_name[]" class="ml-2 form-control" placeholder="Pay With Name">
                                    </div>

                                    <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 110px;">
                                        <img class="display-upload-img" style="width: 110px;height: 60px;" src="{{ asset("frontend/images/No-image.jpg")}}" alt="">
                                            <input type="file" name="pay_image[]" class="form-control upload-img" placeholder="Enter Activity Image"
                                            style="position: absolute;top: 0;opacity: 0;height: 100%;">
                                    </div>

                                    <a id="plus-btn-data" href="javascript:void(0)" class="plus-btn-data px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                    </div>

                                    @else
                                    @foreach ($site_setting->paywiths as $j=>$paywith)
                                    <div class="d-flex align-items-center mt-2">

                                        <div class="d-flex align-items-center select-add-section p-2" style="width: 40%;">
                                            <input type="text" name="old_pay_name[{{ $paywith->id }}]" value="{{ $paywith->pay_name }}" class="ml-2 form-control" placeholder="Pay With Name">
                                        </div>

                                        <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 110px;">
                                            <img class="display-upload-img" style="width: 110px;height: 60px;" src="{{ $paywith->pay_image_show }}" alt="">
                                                <input type="file" name="old_pay_image[{{ $paywith->id }}]" class="form-control upload-img" placeholder="Enter Activity Image"
                                                style="position: absolute;top: 0;opacity: 0;height: 100%;">
                                        </div>

                                        {{-- <div class="d-flex align-items-center select-add-section" style="width: 97%;">

                                           <input value="{{ $facilitiyitem->car_facility }}" type="text" name="old_car_facility[{{ $facilitiyitem->id }}]" class="ml-2 form-control" placeholder="Seat">
                                       </div> --}}

                                       @if($j == $site_setting->paywiths->count() - 1)
                                       <a id="plus-btn-data" href="javascript:void(0)" class="plus-btn-data px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                       @else
                                       <a facilitiyitem_id="{{ $paywith->id }}" href="javascript:void(0)" class="minus-btn-data-old px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>
                                       @endif

                                    </div>
                                 @endforeach
                                    @endif
                                </div>

                            </div>

                        </div><!-- row -->




                        <div class="row mt-4">
                          <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-right">
                            <button type="submit" class="btn btn-info ">Save</button>
                          </div>
                        </div>
                    </form>

                </div><!-- form-layout -->
            </div><!-- col-6 -->
            <!----- Start Add Category Form input ------->
          </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->

    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->







@endsection
@section('script')
<script>

$(document).ready(function() {
        $(document).on('click','#plus-btn-data',function(){



var myvar = '<div class="d-flex align-items-center mt-2">'+
''+
'                                     <div class="d-flex align-items-center select-add-section p-2" style="width: 40%;">'+
'                                        <input type="text" name="pay_name[]" class="ml-2 form-control" placeholder="Pay With Name">'+
'                                    </div>'+
''+
'                                    <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 110px;">'+
'                                        <img class="display-upload-img" style="width: 110px;height: 60px;" src="{{ asset("frontend/images/No-image.jpg")}}" alt="">'+
'                                            <input type="file" name="pay_image[]" class="form-control upload-img" placeholder="Enter Activity Image"'+
'                                            style="position: absolute;top: 0;opacity: 0;height: 100%;">'+
'                                    </div>'+
''+
'                                   <a href="javascript:void(0)" class="minus-btn-data px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>'+
'                                    </div>';


$('.add-data').prepend(myvar);
            //console.log();
        });

        $(document).on('click','.minus-btn-data',function(){
            $(this).parent().remove();
        });
        $(document).on('click','.minus-btn-data-old',function(){
             $(this).parent().parent().append('<input type="hidden" name="delete_facilitiyitem[]" value="'+$(this).attr('facilitiyitem_id')+'">');
            $(this).parent().remove();
        });

    });





     $(document).on('change','.upload-img',function(){
            var files = $(this).get(0).files;
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            var arg=this;
            reader.addEventListener("load", function(e) {
                var image = e.target.result;
                $(arg).parent().find('.display-upload-img').attr('src', image);
            });
        });
</script>
@endsection
