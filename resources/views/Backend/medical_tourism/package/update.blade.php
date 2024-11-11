@section('title')
    Admin - Edit Continent
@endsection

@extends('Backend.layouts.layouts')

@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader">
          <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Home</a>
            <a class="breadcrumb-item" href="{{route('tourism-package.index')}}"> <i class="icon ion-reply text-22"></i> All Tourism Package</a>
          </nav>
        </div><!-- br-pageheader -->

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center mb-4"> Update Tourism Package</h6>
               {{-- validate start  --}}
               @if(count($errors) > 0)
               @foreach($errors->all() as $error)
                   <div class="alert alert-danger">{{ $error }}</div>
               @endforeach
               @endif
               {{-- validate End  --}}

            <!----- Start Add Category Form input ------->
            <div class="col-xl-9 mx-auto">
                <div class="form-layout form-layout-4 py-5">

                    <form action="{{ route('tourism-package.update', $package->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        {{ method_field('PATCH') }}
                        
                        <div class="row mt-4">
                          <label class="col-sm-3 form-control-label">Package Name: <span class="tx-danger">*</span></label>
                          <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                          <input type="text" value="{{ $package->name }}" name="name" class="form-control" placeholder="Enter Package Name" required>
                        </div>
                      </div><!-- row -->

                      <div class="row mt-3" id="menuimage">
                        <label class="col-sm-3 form-control-label">Post Image: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 150px;">
                                    <img class="display-upload-img" style="width: 150px;height: 70px;" src="{{$package->image_show}}" alt="">
                                    <input type="file" name="image" class="form-control upload-img" placeholder="Enter Activity Image" style="position: absolute;top: 0;opacity: 0;height: 100%;">
                                </div>
                        </div>
                    </div><!-- row -->

                     


                    <div class="row mt-4">
                      <label class="col-sm-3 form-control-label">Continent Name: <span class="tx-danger">*</span></label>
                      <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <select id="continent"  class="form-control" name="continent_id" id="phar_cat" required>
                          <option value="">Select Continent</option>
                          @foreach ($continents as $continent)
                          <option @if($continent->id == $package->continent_id)  Selected @endif value="{{ $continent->id }}">{{ $continent->name }}</option>
                          
                          @endforeach
                      </select>
                  </div>
                  </div><!-- row -->

                  <div class="row mt-4">
                    <label class="col-sm-3 form-control-label">Country Name: <span class="tx-danger">*</span></label>
                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                      <select  class="form-control" name="country_id" id="country" required>
                        <option value="">Select Country</option>
                        @foreach ($countries as $country)
                        <option @if($country->id == $package->country_id)  Selected @endif value="{{ $country->id }}">{{ $country->name }}</option>
                        
                        @endforeach

                      </select>
                    </div>
                  </div><!-- row -->



                  <div class="row mt-4">
                    <label class="col-sm-3 form-control-label">Province Name: <span class="tx-danger">*</span></label>
                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                      <select  class="form-control" name="state_id" id="state" required>
                        <option value="">Select Province</option>
                        @foreach ($states as $state)
                        <option @if($state->id == $package->state_id)  Selected @endif value="{{ $state->id }}">{{ $state->name }}</option>
                        
                        @endforeach
                      </select>
                    </div>
                  </div><!-- row -->

                  <div class="row mt-4">
                    <label class="col-sm-3 form-control-label">City Name: <span class="tx-danger">*</span></label>
                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                      <select  class="form-control" name="city_id" id="city" required>
                        <option value="">Select City</option>
                        @foreach ($cities as $city)
                        <option @if($city->id == $package->city_id)  Selected @endif value="{{ $city->id }}">{{ $city->name }}</option>
                        
                        @endforeach
                      </select>
                    </div>
                  </div><!-- row -->

                          
                        <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Price: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="number" value="{{ $package->price }}" name="price" class="form-control" placeholder="Enter Package Price" required>
                        </div>
                        </div><!-- row -->

                        <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Discount: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" value="{{ $package->discount }}" name="discount" class="form-control" placeholder="Enter Discount" required>
                        </div>
                        </div><!-- row -->


                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Details: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                               <textarea id="summernote" name="shortdetail">{{ $package->shortdetail }}</textarea>
                            </div>
                        </div><!-- row -->

                        <hr>
                        <h4>Package Item:</h4>
                        <div class="show-add-tagline-data">
                          @if($package->packagetaglines->count() == 0)
                          <div class="d-flex mt-3">
                              <div class="" style="border: 1px solid;padding:10px;width: 97%;">
                                  <div class="row mt-3">
                                      <div class="col-sm-3">
                                          <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 100px;">
                                              <img class="display-upload-img" style="width: 100px;height: 70px;" src="{{ asset("frontend/images/No-image.jpg")}}" alt="">
                                              <input type="file" name="tagline_image[]" class="form-control upload-img" placeholder="Enter Activity Image" style="position: absolute;top: 0;opacity: 0;height: 100%;">
                                          </div>
                                      </div>
                                      <div class="col-sm-9">
                                          <input  value="" type="text" name="tagline[]" class="form-control" placeholder="Enter Tagline">
                                      </div>
                                      <hr style="width:95%;">
                                  </div>
                                  <div class="show-add-list-data">
                                      <div class="row mt-3">
                                          <label class="col-sm-3 form-control-label"> </label>
                                          <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                              <div class="d-flex align-items-center ">
                                                  <input  value="" type="text" name="details[0][]" class="form-control" placeholder="Enter Details">
                                                  <a tag_id="0" href="javascript:void(0)" class="plus-btn-data-detail plus-btn-data px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                              </div>
                              <a id="plus-btn-data-tagline" href="javascript:void(0)" class="plus-btn-data px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                          </div>
                          @else
                          @foreach ($package->packagetaglines as $k=>$packagetagline)
                              <div class="d-flex mt-3">
                                  <div class="" style="border: 1px solid;padding:10px;width: 97%;">
                                      <div class="row mt-3">
                                          <div class="col-sm-3">
                                              <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 100px;">
                                                  <img class="display-upload-img" style="width: 100px;height: 70px;" src="{{$packagetagline->icon_show}}"alt="">
                                                  <input type="file"  name="old_tagline_image[{{ $packagetagline->id }}]" class="form-control upload-img" placeholder="Enter Activity Image" style="position: absolute;top: 0;opacity: 0;height: 100%;">
                                              </div>
                                          </div>
                                          <div class="col-sm-9">
                                              <input value="{{ $packagetagline->title }}"  type="text"  name="old_tagline[{{ $packagetagline->id }}]" class="form-control">
                                          </div>
                                          <hr style="width:95%;">
                                      </div>
                                      @if ($packagetagline->details->count() == 0)
                                      <div class="show-add-list-data">
                                          <div class="row mt-3">
                                              <label class="col-sm-3 form-control-label"> </label>
                                              <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                                  <div class="d-flex align-items-center ">
                                                      <input  value="" type="text" name="details[{{ $packagetagline->id }}][]" class="form-control" placeholder="Enter Details">
                                                      <a tag_id="{{  $packagetagline->id }}" href="javascript:void(0)" class="plus-btn-data-detail plus-btn-data px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      @else
                                      <div class="show-add-list-data">
                                      @foreach ($packagetagline->details as $j=>$detail)

                                              <div class="row mt-3">
                                                  <label class="col-sm-3 form-control-label"> </label>
                                                  <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                                      <div class="d-flex align-items-center ">
                                                          <input  value="{{ $detail->text }}" type="text" name="old_details[{{$packagetagline->id  }}][{{ $detail->id }}]" class="form-control" placeholder="Enter Details">
                                                          @if($j == $packagetagline->details->count()-1)
                                                          <a tag_id="{{ $packagetagline->id }}" id="plus-btn-data" href="javascript:void(0)" class="plus-btn-data px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                                          @else
                                                          <a d_id="{{ $detail->id }}" tagline_id="{{ $packagetagline->id }}" href="javascript:void(0)" class="minus-btn-details-data-old px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>
                                                          @endif
                                                      </div>
                                                  </div>
                                              </div>
                                      @endforeach
                                      </div>
                                      @endif

                                  </div>
                                  @if($k == $package->packagetaglines->count()-1)
                                  <a id="plus-btn-data-tagline" href="javascript:void(0)" class="plus-btn-data px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                  @else
                                  <a tagline_id="{{ $packagetagline->id }}" href="javascript:void(0)" class="minus-btn-packagetaglines-data-old px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>
                                  @endif
                              </div>
                          @endforeach
                          @endif
                      </div>
                    
                        <div class="row mt-4">
                          <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-right">
                            <a href="{{route('tourism-package.index')}}" type="button" class="btn btn-secondary text-white mr-2" >Cancel</a>
                            <button type="submit" class="btn btn-info ">Update</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js"></script>
<script>










    
  $('body').on("change",'#continent',function(){
      let id = $(this).val();
      getCountry(id,"country");
  });

  function getCountry(id,outid){
      let url = '{{ url("get/country/") }}/' + id;
      axios.get(url)
          .then(res => {
              console.log(res);
          $('#'+outid).empty();
              let html = '';
              html += '<option value="">Select Country</option>'
              res.data.forEach(element => {
                  html += "<option value=" + element.id + ">" + element.name + "</option>"
              });


              $('#'+outid).append(html);
              $('#'+outid).val("").change();
          });
  }


  $('body').on("change",'#country',function(){
      console.log("this");
      let id = $(this).val();
      getState(id,"state");
  });
  function getState(id,outid){
      let url = '{{ url("/get/state/") }}/' + id;
      axios.get(url)
          .then(res => {
              console.log(res);
          $('#'+outid).empty();
            let html = '';
            html += '<option value="">Select Province</option>'
            res.data.forEach(element => {
                html += "<option value=" + element.id + ">" + element.name + "</option>"
            });


            $('#'+outid).append(html);
            $('#'+outid).val("").change();
  });


  $('body').on("change",'#state',function(){
      console.log("this");
      let id = $(this).val();
      getCity(id,"city");
  });
  function getCity(id,outid){
      let url = '{{ url("/get/city/") }}/' + id;
      axios.get(url)
          .then(res => {
              console.log(res);
          $('#'+outid).empty();
            let html = '';
            html += '<option value="">Select City</option>'
            res.data.forEach(element => {
                html += "<option value=" + element.id + ">" + element.name + "</option>"
            });


            $('#'+outid).append(html);
            $('#'+outid).val("").change();
      });

  }
}


</script>

<script>
  var tagline =1;
  $(document).on('click','.plus-btn-data',function(){
      let out = '<div class="row mt-3">'+
                '<label class="col-sm-3 form-control-label"> </label>'+
                '<div class="col-sm-9 mg-t-10 mg-sm-t-0">'+
                  '<div class="d-flex align-items-center ">'+
                  '<input  value="" type="text" name="details['+$(this).attr('tag_id')+'][]" class="form-control" placeholder="Enter Details">'+
                  '<a href="javascript:void(0)" class="minus-btn-data px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>'+
                  '</div></div></div>';
     $(this).parent().parent().parent().parent().prepend(out);
  });
  $(document).on('click','.minus-btn-data',function(){
      $(this).parent().parent().parent().remove();
  });

  $(document).on('click','#plus-btn-data-tagline',function(){
      var myvar = '<div class="d-flex mt-3">'+
      '                                <div class="" style="border: 1px solid;padding:10px;width: 97%;">'+
      '                                    <div class="row mt-3">'+
      '                                        <div class="col-sm-3">'+
      '                                            <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 100px;">'+
      '                                                <img class="display-upload-img" style="width: 100px;height: 70px;" src="{{ asset("frontend/images/No-image.jpg")}}" alt="">'+
      '                                                <input type="file" name="tagline_image[]" class="form-control upload-img" placeholder="Enter Activity Image" style="position: absolute;top: 0;opacity: 0;height: 100%;">'+
      '                                            </div>'+
      '                                        </div>'+
      '                                        <div class="col-sm-9">'+
      '                                            <input  value="" type="text" name="tagline[]" class="form-control" placeholder="Enter Tagline">'+
      '                                        </div>'+
      '                                        <hr style="width:95%;">'+
      '                                    </div>'+
      '                                    <div class="show-add-list-data">'+
      '                                        <div class="row mt-3">'+
      '                                            <label class="col-sm-3 form-control-label"> </label>'+
      '                                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">'+
      '                                                <div class="d-flex align-items-center ">'+
      '                                                    <input  value="" type="text" name="details['+tagline+'][]" class="form-control" placeholder="Enter Details">'+
      '                                                    <a tag_id="'+tagline+'" class="plus-btn-data" href="javascript:void(0)" class="plus-btn-data px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>'+
      '                                                </div>'+
      '                                            </div>'+
      '                                        </div>'+
      '                                    </div>'+
      '                                </div>'+
      '                                <a href="javascript:void(0)" class="minus-btn-data-tagline px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>'+
      '                            </div>';

      $('.show-add-tagline-data').prepend(myvar);
      tagline++;
      $(this).focus();
  });
  $(document).on('click','.minus-btn-data-tagline',function(){
      $(this).parent().remove();
  });

  $(document).on('click','.minus-btn-details-data-old',function(){
      $(this).parent().parent().parent().parent().append('<input type="hidden" name="delete_details[]" value="'+$(this).attr('d_id')+'">')
      $(this).parent().parent().parent().remove();
  });

  $(document).on('click','.minus-btn-packagetaglines-data-old',function(){
      console.log(this);
      $(this).parent().parent().append('<input type="hidden" name="delete_tagline[]" value="'+$(this).attr('tagline_id')+'">')
      $(this).parent().remove();
  });

</script>
@endsection

