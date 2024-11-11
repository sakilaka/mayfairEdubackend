@extends('Backend.layouts.layouts')

@section('title', 'Page Title')


@section('main_contain')
<div class="br-mainpanel">

          <div class="br-section-wrapper">

                <div class="text-center mb-4">
                    <h1 class="">Edit Designation</h1>
                    <br>
                </div>
            @php
            $employee = DB::table('employee_info')
            ->get();
            @endphp
            @foreach ($designation as $desg )

              <form action="{{ url('updateDesignation') }}/{{ $desg->id }}" method="post">
                  @csrf
                  <div class="row">

                      <div class="col-md-6" style="margin-bottom: 20px">
                            <label for="">Department Name : </label>
                            <input type="hidden" name="prev_cate" value="{{ $desg->department_id }}">
                            <select name="department_id" id="" class="form-control">
                                <option value="" selected disabled>{{$getName?->name}}</option>
                              @foreach ($department as $cate )
                                  <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                              @endforeach
                            </select>
                        </div>

                      <div class="col-md-6" style="margin-bottom: 20px">
                          <label for="">Designation Name : </label>
                          <input type="text" name="name" id="" value="{{ $desg->name }}" class="form-control" required placeholder="Add A Designation (Example: Intern/Developer etc.)">
                      </div>
                    </div>
                      <br><br>
                  <center>
                      <button class="btn btn-info">
                          {{-- <i class="fa-regular fa-plus"></i> --}}
                           Update Designation
                      </button>
                  </center>

              </form>
            @endforeach
          </div>
      <!-- </div> -->

</div>
@stop
