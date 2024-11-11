@extends('Backend.layouts.layouts')

@section('title', 'Manage Loss')

@section('main_contain')
    <div class="br-mainpanel">
        <div class="br-section-wrapper">
        <center>
            <h1>Manage Loss Details</h1>
            <p class="mg-b-0">View Loss Details from here</p>
        </center>
        <br>
        <br>
            <div class="row mb-3">
                <div class="col-md-3">
                    <input type="text" id="myInput" class="form-control" placeholder="Search Here">
                </div>
                <div class="col-md-9 text-right">
                    <a href="#" class="btn btn-info">
                        <i class="fa-solid fa-plus"></i> Add Loss Details
                    </a>
                </div>
            </div>

            <table class="table" id="myTable">
                <thead>
                    <tr>
                      <th scope="col">SN</th>
                      <th scope="col">Category</th>
                      <th scope="col">Sub-Category</th>
                      <th scope="col">Title</th>
                      <th scope="col">Photo</th>
                      <th scope="col">Buying Price</th>
                      <th scope="col">Selling Price</th>
                      <th scope="col">Expenses</th>
                      <th scope="col">Description</th>
                      <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <ul class="actionBar">
                                    <li>
                                        <a href="#">
                                            <i class="fa-duotone fa-pen-to-square btn btn-sm btn-success"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa-duotone fa-trash btn btn-sm btn-danger"></i>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                </tbody>
            </table>

        </div>
    </div>
@stop
