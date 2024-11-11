@extends('Backend.layouts.layouts')

@section('title', 'Add Late Roll')

@section('main_contain')

<div class="br-mainpanel">
<div class="br-pagetitle">
    <div class="br-section-wrapper mt-4" style="width:100%">

            <div class="text-center mb-4">
                    <h1 class="">Add Late Roll</h1>
                    <br>
                </div>

                <form action="{{route('storeLateRoll')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 my-2">
                            <label for="">Late Day</label>
                           <input type="number" name="late" placeholder="Late Day" class="form-control"  value="{{old('late'
                            )}}">
                           @error('late')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                       <div class="col-md-4 my-2">
                            <label for="">Absent Count  </label>
                           <input type="number" name="absent" placeholder="Absent Count " class="form-control"  value="{{old('absent'
                            )}}">
                           @error('absent')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                        <div class="col-md-4 my-2">
                            <button type="submit" class="btn btn-info mt-4">
                            Create New Late Roll</button>
                        </div>
                    </div>

                </form>


    </div>
</div>
@stop

