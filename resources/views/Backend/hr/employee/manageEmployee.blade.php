@extends('Backend.layouts.layouts')

@section('title', 'Employee')

@section('main_contain')
    <div class="br-mainpanel">
        <div class="br-section-wrapper">
        <div class="text-center mb-4">
                    <h1 class="">Manage All Employee Informations</h1>
                    <br>
                </div>
            <div class="row">
                <div class="col-md-3">
                    <input type="text" id="myInput" class="form-control" placeholder="Search">
                </div>
                <div class="col-md-9 text-right">
                    <a href="{{ url('addEmployee') }}" class="btn btn-info">
                        {{-- <i class="fa-solid fa-plus"></i>  --}}
                        Add Employee
                    </a>
                </div>
            </div>

            <table class="table" id="myTable">
                <thead>
                  <tr>
                    <th scope="col">SN</th>

                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Department Name</th>
                    <th scope="col">Designation Name</th>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Sallery</th>
                    <th scope="col">Join Date</th>
                    <th scope="col">Action</th>

                  </tr>
                </thead>

                <tbody>
                    @foreach ($employee as $i=>$emp)
                        <tr>
                            <td>{{ $i+1 }}</td>
                             <td>
                                <img src="{{$emp->employee_image_show}}" style="height:50px;width:50px;">
                            </td>


                            <td>{{ $emp->employee_name }}</td>
                            <td> {{ $emp->department?->name }}</td>
                            <td>{{ $emp->designation?->name }}</td>
                            <td>{{ $emp->employee_id }}</td>
                            <td>{{ $emp->email }}</td>
                            <td>{{ $emp->mobile }}</td>
                            <td>${{ $emp->salary }}</td>
                            <td>{{ $emp->join_date }}</td>
                            <td>
                                <ul class="actionBar">
                                    <li>
                                        <a href="{{ url('editEmployee') }}/{{ $emp->id }}" class="btn text-info">
                                                <i class="icon ion-compose tx-28"></i>
                                        </a>
                                    </li>
                                    <!-- <li>|</li> -->
                                    <li>
                                        <a  href="{{ url('deleteEmployee') }}/{{ $emp->id }}"  class="btn text-danger bg-white">
                                           <i class="icon ion-trash-a tx-28"></i>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>

        </div>
    </div>
@stop
