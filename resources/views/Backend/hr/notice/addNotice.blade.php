@extends('Backend.layouts.layouts')

@section('title', 'Add Notice')

@section('main_contain')

<div class="br-mainpanel">

    <div class="br-section-wrapper">

            <div class="text-center mb-4">
                    <h1 class="">Add Notice</h1>
                    <br>
                </div>
                <!-- <h2>Add Notice</h2> -->
                <form action="/storeNotice" method="POST">
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
                    <center>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-info">
                            Create New Notice</button>
                    </div>
                    </center>
                </form>
        <!-- </div> -->

    </div>
</div>
@stop

