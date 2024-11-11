@extends('Backend.layouts.layouts')

@section('title', 'Add Designation')


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
                    <h1 class="">Add Designation</h1>
                    <br>
                </div>

              <form action="{{ url('storeDesgData') }}" method="post">
                  @csrf
                  <div class="row">
                    <div class="col-md-6" style="margin-bottom: 20px">
                          <label for="">Department Name : </label>
                          <select name="department_id" id="" class="form-control">
                            @foreach ($department as $cate )
                                <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="col-md-6" style="margin-bottom: 20px">
                          <label for="">Designation Name : </label>
                          <input type="text" name="name" id="" class="form-control" required placeholder="Add A Designation (Example: Intern/Developer etc.)">
                      </div>
                    </div>
                      <br><br>
                  <center>
                      <button class="btn btn-info">
                          {{-- <i class="fa-regular fa-plus"></i> --}}
                           Add Designation
                      </button>
                  </center>

              </form>

          </div>
      <!-- </div> -->

</div>
@stop
