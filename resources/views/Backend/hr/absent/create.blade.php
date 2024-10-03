@extends('Backend.layouts.layouts')

@section('title', 'Add Absent')

@section('main_contain')

<div class="br-mainpanel">
<div class="br-pagetitle">
    <div class="br-section-wrapper mt-4" style="width:100%">

            <div class="text-center mb-4">
                    <h1 class="">Add Absent</h1>
                    <br>
                </div>

                <form action="{{route('storeAbsent')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 my-2">
                            <label for="">First Absent Amount (%) </label>
                           <input type="number" name="first" placeholder="First Absent Amount" class="form-control" step="any" value="{{old('first'
                            )}}">
                           @error('first')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                       <div class="col-md-4 my-2">
                            <label for="">Other Absent Amount (%) </label>
                           <input type="number" name="other" placeholder="Other Other Amount" class="form-control" step="any" value="{{old('other'
                            )}}">
                           @error('other')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                        <div class="col-md-4 my-2">
                            <button type="submit" class="btn btn-info mt-4">
                            Create New Absent</button>
                        </div>
                    </div>

                </form>


    </div>
</div>
@stop

