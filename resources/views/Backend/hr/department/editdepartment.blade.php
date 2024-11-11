@extends('Backend.layouts.layouts')

@section('title', 'Page Title')


@section('main_contain')
<div class="br-mainpanel">

    <!-- <div class="br-pagetitle">
      <i class="fa-duotone fa-gear"></i>
      <div>
        <h4>Edit Department Info</h4>
      </div>
    </div>d-flex -->



      <!-- <div class="p-5"> -->

          <div class="br-section-wrapper">
                <div class="text-center mb-4">
                    <h1 class="">Edit Department Info</h1>
                    <br>
            </div>
            @php
            $employee = DB::table('employee_info')
            ->get();
            @endphp
            @foreach ($department as $dept )
              <form action="{{ url('updateDepartment') }}/{{ $dept->id }}" method="post">
                  @csrf
                  <div class="row">
                      <div class="col-md-6" style="margin-bottom: 5px">
                          <label for="">Department Name : </label>
                          <input type="text" name="name" id="deptName" class="form-control" required placeholder="Add a Department" value="{{ $dept->name }}">
                      </div>

                      <br><br>
                  <center>
                      <button class="btn btn-info">
                          <i class="icon ion-compose tx-28"></i>
                           Update Informations
                      </button>
                  </center>

              </form>
              @endforeach
          </div>
      <!-- </div> -->

</div>

@stop
