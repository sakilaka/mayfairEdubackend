@extends('Backend.layouts.layouts')

@section('title', 'Edit Absent')

@section('main_contain')

<div class="br-mainpanel">
<div class="br-pagetitle">

    <div class="br-section-wrapper mt-4" style="width:100%">

            <div class="text-center mb-4">
                    <h1 class="">Edit Absent</h1>
                    <br>
                </div>
                      <form action="{{route('updateOvertime',$p->id)}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 my-2">
                            <label for="">Unit Hour  </label>
                           <input type="number" name="hour" class="form-control" step="any" value="{{$p->hour}}">
                           @error('hour')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                       <div class="col-md-4 my-2">
                            <label for="">Amount For Unit Hour (%) </label>
                           <input type="number" name="amount" class="form-control" step="any" value="{{$p->amount}}">
                           @error('amount')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                        <div class="col-md-4 my-2">
                            <button type="submit" class="btn btn-info mt-4">
                            Update Over Time</button>
                        </div>
                    </div>

                </form>

    </div>
</div>
@stop

