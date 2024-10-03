@section('title')
    Admin - Edit Word
@endsection

@extends('Backend.layouts.layouts')

@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader">
          <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Home</a>
            <a class="breadcrumb-item" href="{{route('word.index')}}"> <i class="icon ion-reply text-22"></i> All Words</a>
          </nav>
        </div><!-- br-pageheader -->

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center mb-4"> Update Word</h6>
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

                    <form action="{{ route('word.update', $word->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        {{ method_field('PATCH') }}
                        
                        <div class="row mt-3" id="menuimage">
                          <label class="col-sm-3 form-control-label">Word Image: <span class="tx-danger">*</span></label>
                          <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                              <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 150px;">
                                      <img class="display-upload-img" style="width: 150px;height: 70px;" src="{{ $word->image_show}}" alt="">
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
                              <option @if($continent->id == $word->continent_id)  Selected @endif value="{{ $continent->id }}">{{ $continent->name }}</option>
                              
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
                            <option @if($country->id == $word->country_id)  Selected @endif value="{{ $country->id }}">{{ $country->name }}</option>
                            
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
                            <option @if($state->id == $word->state_id)  Selected @endif value="{{ $state->id }}">{{ $state->name }}</option>
                            
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
                            <option @if($city->id == $word->city_id)  Selected @endif value="{{ $city->id }}">{{ $city->name }}</option>
                            
                            @endforeach
                          </select>
                        </div>
                      </div><!-- row -->

                      <div class="row mt-4">
                        <label class="col-sm-3 form-control-label">Post Name: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                          <select  class="form-control" name="thana_id" id="thana" required>
                            <option value="">Select Post</option>
                            @foreach ($thanas as $thana)
                            <option @if($thana->id == $word->thana_id)  Selected @endif value="{{ $thana->id }}">{{ $thana->name }}</option>
                            
                            @endforeach
                          </select>
                        </div>
                      </div><!-- row -->

                      <div class="row mt-4">
                        <label class="col-sm-3 form-control-label">Union Name: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                          <select  class="form-control" name="union_id" id="union" required>
                            <option value="">Select Unions</option>
                            @foreach ($unions as $union)
                            <option @if($union->id == $word->union_id)  Selected @endif value="{{ $union->id }}">{{ $union->name }}</option>
                            
                            @endforeach
                          </select>
                        </div>
                      </div><!-- row -->




                          <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">word Name: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" name="name" value="{{ $word->name }}" class="form-control" placeholder="Enter Post Name" required>
                        </div>
                        </div><!-- row -->
                        

                    
                        <div class="row mt-4">
                          <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-right">
                            <a href="{{route('word.index')}}" type="button" class="btn btn-secondary text-white mr-2" >Cancel</a>
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

  $('body').on("change",'#thana',function(){
      console.log("this");
      let id = $(this).val();
      getUnion(id,"union");
  });
  function getUnion(id,outid){
      let url = '{{ url("/get/union/") }}/' + id;
      axios.get(url)
          .then(res => {
              console.log(res);
          $('#'+outid).empty();
            let html = '';
            html += '<option value="">Select Union</option>'
            res.data.forEach(element => {
                html += "<option value=" + element.id + ">" + element.name + "</option>"
            });


            $('#'+outid).append(html);
            $('#'+outid).val("").change();
      });

  }
  $('body').on("change",'#city',function(){
      console.log("this");
      let id = $(this).val();
      getword(id,"thana");
  });
  function getword(id,outid){
      let url = '{{ url("/get/thana/") }}/' + id;
      axios.get(url)
          .then(res => {
              console.log(res);
          $('#'+outid).empty();
            let html = '';
            html += '<option value="">Select Post</option>'
            res.data.forEach(element => {
                html += "<option value=" + element.id + ">" + element.name + "</option>"
            });


            $('#'+outid).append(html);
            $('#'+outid).val("").change();
      });

  }
}



</script>
@endsection