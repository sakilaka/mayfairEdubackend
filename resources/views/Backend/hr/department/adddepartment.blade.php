@extends('Backend.layouts.layouts')

@section('title', 'Add Department')


@section('main_contain')
<div class="br-mainpanel">

    <!-- <div class="br-pagetitle">
      <i class="fa-duotone fa-gear"></i>
      <div>
        <h4>Add Department</h4>
      </div>
    </div>d-flex -->


      <!-- <div class="p-5"> -->

          <div class="br-section-wrapper">

                <div class="text-center mb-4">
                    <h1 class="">Add Department</h1>
                    <br>
                </div>

              <form action="{{ route('storeDeptData') }}" method="post">
                  @csrf
                  <div class="row">
                      <div class="col-md-9" style="margin-bottom: 20px">
                          {{-- <label for="">Department Name : </label> --}}
                          <input type="text" name="name" id="" class="form-control" required placeholder="Add A Department Name (Example: Engineering/Marketing/Accounting etc.)">
                      </div>
                      <br><br>
                  <center>
                      <button class="btn btn-info">
                          <i class="fa fa-plus ml-0 mr-1"></i>
                           Add Department
                      </button>
                  </center>

              </form>

          </div>
      <!-- </div> -->

</div>
@stop
