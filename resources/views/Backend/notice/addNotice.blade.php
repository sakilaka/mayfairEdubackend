@extends('Backend.layouts.layouts')

@section('title', 'Add Notice')

<link rel="stylesheet" href="css/custom/class.css">

@section('main_contain')

<div class="br-mainpanel">

      <div class="br-pagetitle">
        <i class="fa-duotone fa-screen-users"></i>
        <div>
          <h4>Add a Notice</h4>
          <p class="mg-b-0">Add a new notice</p>
        </div>
      </div><!-- d-flex -->


        <div class="p-5">

            <div class="br-section-wrapper">

                <h2>Add Notice</h2>
                <form action="{{ url('storeNotice') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label>Notice : </label>
                            <select name="notice" id=""
                            class="form-control">
                                <option value="">
                                    Select Notice Type
                                </option>
                                <option value="Daily Notice">Daily Notice</option>
                                <option value="Monthly Notice">Monthly Notice</option>
                                <option value="Yearly Notice">Yearly Notice</option>
                                <option value="Instant Notice">Instant Notice</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Notice Name : </label>
                                <input type="text"
                                class="form-control" name="name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="">Status : </label>
                            <select name="status" id="" class="form-control">
                                <option value="">-----Select Status-------</option>
                                <option value="active">Active</option>
                                <option value="deactive">Deactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description : </label>
                                <textarea id="editor"
                                class="form-control" name="description"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary
                         createClass">
                            Create New Notice</button>
                    </div>
                </form>
        </div>

    </div>
</div>
@endsection

