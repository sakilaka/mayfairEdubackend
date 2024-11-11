@extends('Backend.layouts.layouts')

@section('title', 'Add Payroll')

@section('main_contain')

<div class="br-mainpanel">
<div class="br-pagetitle">
    <div class="br-section-wrapper mt-4">

            <div class="text-center mb-4">
                    <h1 class="">Add Payroll</h1>
                    <br>
                </div>
                <!-- <h2>Add Notice</h2> -->
                <form action="{{route('storePayroll')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 my-2">
                            <label for="">House Rent(%) : </label>
                           <input type="number" name="house_rent" placeholder="House Rent" class="form-control" step="any" value="{{old('house_rent'
                            )}}">
                           @error('house_rent')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                         <div class="col-md-4 my-2">
                            <label for="">Medical Cost(%) : </label>
                           <input type="number" name="medical_cost" placeholder="Medical Cost" class="form-control" step="any" value="{{old('medical_cost'
                            )}}" >
                           @error('medical_cost')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                         <div class="col-md-4 my-2">
                            <label for="">Transpot Cost(%) : </label>
                           <input type="number" name="transport_cost" placeholder="Transpot Cost" class="form-control" step="any" value="{{old('transport_cost'
                            )}}">
                           @error('transport_cost')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                         <div class="col-md-4 my-2">
                            <label for="">Tax(%) : </label>
                           <input type="number" name="tax" placeholder="Tax" class="form-control" step="any" value="{{old('tax'
                            )}}">
                           @error('tax')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                         <div class="col-md-4 my-2">
                            <label for="">Provident Fund(%) : </label>
                           <input type="number" name="provident_fund" placeholder="Provident Fund (%)" class="form-control" step="any" value="{{old('provident_fund'
                            )}}">
                           @error('provident_fund')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                    </div>

                    <center>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-info">
                            Create New Payroll</button>
                    </div>
                    </center>
                </form>
        <!-- </div> -->

    </div>
</div>
@stop

