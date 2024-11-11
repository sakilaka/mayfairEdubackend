@extends('Backend.layouts.layouts')

@section('title', 'Edit Late Roll')

@section('main_contain')

<div class="br-mainpanel">
<div class="br-pagetitle">

    <div class="br-section-wrapper mt-4" style="width:100%">

            <div class="text-center mb-4">
                    <h1 class="">Edit Late Roll</h1>
                    <br>
                </div>
            <form action="{{route('updateLateRoll',$p->id)}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 my-2">
                            <label for="">Late Day</label>
                           <input type="number" name="late"  class="form-control"  value="{{$p->late}}">
                           @error('late')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                       <div class="col-md-4 my-2">
                            <label for="">Absent Count  </label>
                           <input type="number" name="absent"  class="form-control"  value="{{$p->absent}}">
                           @error('absent')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                        <div class="col-md-4 my-2">
                            <button type="submit" class="btn btn-info mt-4">
                            Update Late Roll</button>
                        </div>
                    </div>

                </form>

    </div>
</div>
@stop

