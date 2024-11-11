@extends('Backend.layouts.layouts')

@section('title', 'Edit Payroll')

@section('main_contain')

<div class="br-mainpanel">
<div class="br-pagetitle">

    <div class="br-section-wrapper mt-4">

            <div class="text-center mb-4">
                    <h1 class="">Edit Payroll</h1>
                    <br>
                </div>
                <!-- <h2>Add Notice</h2> -->
                <form action="{{route('updatePayroll',$p->id)}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 my-2">
                            <label for="">House Rent(%) : </label>
                           <input type="number" name="house_rent" value="{{$p->house_rent}}" class="form-control" step="any">
                           @error('house_rent')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                         <div class="col-md-4 my-2">
                            <label for="">Medical Cost(%) : </label>
                           <input type="number" name="medical_cost" value="{{$p->medical_cost}}" class="form-control" step="any">
                           @error('medical_cost')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                         <div class="col-md-4 my-2">
                            <label for="">Transpot Cost(%) : </label>
                           <input type="number" name="transport_cost"value="{{$p->transport_cost}}" value="Transpot Cost" class="form-control" step="any">
                           @error('transport_cost')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                         <div class="col-md-4 my-2">
                            <label for="">Tax(%) : </label>
                           <input type="number" name="tax" value="{{$p->tax}}" class="form-control" step="any">
                           @error('tax')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                         <div class="col-md-4 my-2">
                            <label for="">Provident Fund(%) : </label>
                           <input type="number" name="provident_fund" value="{{$p->provident_fund}}" class="form-control" step="any">
                           @error('provident_fund')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                    </div>

                    <center>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-info">
                            Edit Payroll</button>
                    </div>
                    </center>
                </form>
        <!-- </div> -->

    </div>
</div>
@stop

