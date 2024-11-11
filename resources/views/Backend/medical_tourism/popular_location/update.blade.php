@section('title')
    Admin - Update Popular Location
@endsection

@extends('Backend.layouts.layouts')

@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader">
          <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Home</a>
            <a class="breadcrumb-item" href="{{route('admin.popular_location.index')}}"> <i class="icon ion-reply text-22"></i> All Popular Location</a>
          </nav>
        </div><!-- br-pageheader -->

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center mb-4"> Update Popular Location</h6>
            {{-- success message start --}}
            @if(session()->has('message'))
            <div class="alert alert-success">
            <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true"></button>
            {{session()->get('message')}}
            </div>
            <script>
                setTimeout(function(){
                    $('.alert.alert-success').hide();
                }, 3000);
            </script>
            @endif
            {{-- success message End --}}


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

                    <form action="{{ route('admin.popular_location.update',$location->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-4">
                          <label class="col-sm-3 form-control-label">Continent: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <select id="continent"  class="form-control" name="continent" required>
                                    <option value="">Select Continent</option>
                                    @foreach ($continents as $continent)
                                    <option @if($continent->id == $location->continent_id) selected @endif value="{{ $continent->id }}">{{ $continent->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- row -->
                        <div class="row mt-4">
                          <label class="col-sm-3 form-control-label">Country: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <select id="country"  class="form-control" name="country" >
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                    <option @if($country->id == $location->country_id) selected @endif value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- row -->
                        <div class="row mt-4">
                          <label class="col-sm-3 form-control-label">Province: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <select id="state"  class="form-control" name="state">
                                    <option value="">Select Province</option>
                                    @foreach ($states as $state)
                                    <option @if($state->id == $location->state_id) selected @endif value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- row -->
                        <div class="row mt-4">
                          <label class="col-sm-3 form-control-label">City: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <select id="city"  class="form-control" name="city">
                                    <option value="">Select City</option>
                                    @foreach ($cities as $city)
                                    <option @if($city->id == $location->city_id) selected @endif value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- row -->
                        <div class="row mt-4">
                          <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-right">
                            <a href="{{route('admin.popular_location.index')}}" type="button" class="btn btn-secondary text-white mr-2" >Cancel</a>
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


@section("script")
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
  }
  $('body').on("change",'#state',function(){
    //   console.log("this");
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
</script>
@endsection
