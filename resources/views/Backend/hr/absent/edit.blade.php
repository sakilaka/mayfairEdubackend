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
                <!-- <h2>Add Notice</h2> -->
               <form action="{{route('updateAbsent',$p->id)}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 my-2">
                            <label for="">First Absent Amount (%) </label>
                           <input type="number" name="first" value="{{$p->first}}" class="form-control" step="any">
                           @error('first')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                       <div class="col-md-4 my-2">
                            <label for="">Other Absent Amount (%) </label>
                           <input type="number" name="other" value="{{$p->other}}" class="form-control" step="any">
                           @error('other')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                        <div class="col-md-4 my-2">
                            <button type="submit" class="btn btn-info mt-4">
                            Update Absent</button>
                        </div>
                    </div>

                </form>
        <!-- </div> -->

    </div>
</div>
@stop

