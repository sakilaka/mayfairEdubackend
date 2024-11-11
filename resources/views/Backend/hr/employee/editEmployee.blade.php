@extends('Backend.layouts.layouts')

@section('title', 'Edit Employee')

@section('main_contain')

<div class="br-mainpanel">

      <!-- <div class="br-pagetitle">
        <i class="fa-duotone fa-screen-users"></i>
        <div>
          <h4>Edit Information</h4>
          <p class="mg-b-0">Edit Employee Information</p>
        </div>
      </div>d-flex -->


        <!-- <div class="p-5"> -->

            <div class="br-section-wrapper">

                <div class="text-center mb-4">
                    <h1 class="">Edit Employee Information</h1>
                    <br>
                </div>
                {{-- @foreach ($employeeData as $data ) --}}
                @php
                    $data= $employeeData;
                @endphp
                <form action="{{ url('updateEmployee') }}/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                       <div class="form-row">
                        <input type="hidden" value="0" name="id"  required>
                        <div class="col-sm-6">
                            <label for="">Department *</label>
                            <select class="form-control form-control-sm" id="deptID2" name="deptID" required>
                                <option>-- Select One --</option>
                                @foreach($departments as $department)
                                <option @if($department->id == $data->department_id) selected @endif value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="">Designation *</label>

                            <select class="form-control form-control-sm" id="desigID" name="desigID" required>
                                <option>-- wait --</option>
                                @foreach($emp_designations as $emp_designation)
                                <option @if($emp_designation->id == $data->designation_id) selected @endif value="{{$emp_designation->id}}">{{$emp_designation->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <label for=""> Employee Name *</label>
                            <input type="text" class=" form-control form-control-sm" name="empName" value="{{ $data->employee_name }}" autocomplete="off" required>
                        </div>

                        <div class="col-sm-4">
                            <label for=""> Father's Name *</label>
                            <input type="text" class=" form-control form-control-sm" name="fName" value="{{ $data->father_name }}" autocomplete="off" required>
                        </div>

                        <div class="col-sm-4">
                            <label for=""> Mother's Name *</label>
                            <input type="text" class=" form-control form-control-sm" name="mName" value="{{ $data->mother_name }}" autocomplete="off" required>
                        </div>

                        <div class="col-sm-6">
                            <br/>
                            <label for="">Current Address *</label>
                            <textarea class="form-control form-control-sm" name="cAddress" cols="10"  placeholder="Current Address" rows="2" required>
                                {{ $data->cAddress }}
                            </textarea>
                        </div>

                        <div class="col-sm-6">
                            <br/>
                            <label for="">Permanent Address *</label>
                            <textarea class="form-control form-control-sm" name="pAddress" cols="10" placeholder="Permanent Address" rows="2" required>
                                {{ $data->pAddress }}
                            </textarea>
                            <br/>
                        </div>

                        <div class="col-sm-3">
                            <label for="">Date of Birth *</label>
                            <input onclick="this.showPicker()" type="date" class=" form-control form-control-sm" value="{{ $data->date_of_birth }}" name="dob" required>
                        </div>

                        <div class="col-sm-3">
                            <label for=""> Nationality *</label>
                            <input type="text" class=" form-control form-control-sm" name="nationality" value="{{ $data->nationality }}" autocomplete="off" required>
                        </div>

                        <div class="col-sm-3">
                            <label for=""> Religion *</label>
                            <input type="text" class=" form-control form-control-sm" name="religion" value="{{ $data->religion }}" autocomplete="off" required>
                        </div>

                        <div class="col-sm-3">
                            <label for=""> NID *</label>
                            <input type="text" class=" form-control form-control-sm" name="nid" autocomplete="off" value="{{ $data->nid_number }}" required><br/>
                        </div>

                        <div class="col-sm-3">
                            <label for="">Blood Group </label>
                            <input type="text" class=" form-control form-control-sm" name="bloodGroup" value="{{ $data->bloodGroup }}" autocomplete="off">
                        </div>

                        <div class="col-sm-3">
                            <label for="" > Marital Status *</label>
                            <select class="form-control form-control-sm" name="maritalStatus" required>
                                <option @if($data->maritalStatus == "Unmarried") selected @endif  value="Unmarried">Unmarried</option>
                                <option @if($data->maritalStatus == "Married") selected @endif value="Married">Married</option>
                            </select>
                        </div>

                        <div class="col-sm-3">
                            <label for="" > Gender *</label>
                            <select class="form-control form-control-sm" name="gender" required>
                                <option  @if($data->gender == "Male") selected @endif value="Male">Male</option>
                                <option  @if($data->gender == "Female") selected @endif value="Female">Female</option>
                                <option  @if($data->gender == "Other") selected @endif value="Other">Other</option>
                            </select>

                        </div>

                        <div class="col-sm-3">
                            <label for="">Mobile *</label>
                            <input type="text" class=" form-control form-control-sm" name="mobile" value="{{ $data->mobile }}" autocomplete="off" required>
                        </div>

                        <div class="col-sm-3">
                            <label for="">Office Phone </label>
                            <input type="text" value="{{ $data->officePhone }}" class=" form-control form-control-sm" name="officePhone" autocomplete="off">
                        </div>

                        <div class="col-sm-6">
                            <label for="">Email *</label>
                            <input type="email" class=" form-control form-control-sm"  name="email" value="{{ $data->email }}" autocomplete="off" required><br/>
                        </div>

                        <div class="col-sm-3">
                            <label for="">Employee ID *</label>
                            <input type="text" class=" form-control form-control-sm" name="empID" value="{{ $data->employee_id }}" autocomplete="off" required>
                        </div>

                        <div class="col-sm-3">
                            <label for="">Basic Salary *</label>
                            <input type="number" class=" form-control form-control-sm"  name="salary" value="{{ $data->salary }}" step="any" autocomplete="off" required>
                        </div>

                        <div class="col-sm-3">
                            <label for="">Join Date *</label>
                            <input type="date" class=" form-control form-control-sm"  name="joinDate" value="{{ $data->join_date }}" autocomplete="off" required>
                        </div>

                        <div class="col-sm-3">
                            <label for="">Regine Date </label>
                            <input type="date" class=" form-control form-control-sm" name="rejineDate" value="{{ $data->rejineDate }}" autocomplete="off">
                        </div>

                        <div class="col-sm-3">
                            <label for="">Image *</label>
                            <input type="file" class=" form-control form-control-sm"  name="image"  autocomplete="off" >
                        </div>


                        <div class="col-sm-6">
                            <br/>
                            <label for="">Note </label>
                            <textarea class="form-control form-control-sm" name="note"  cols="10" placeholder="Permanent Address" rows="2">
                                {{ $data->note }}
                            </textarea>
                        </div>


                        <div class="col-sm-3">
                            <br/>
                            <button class="btn btn-sm btn-primary mt-4 ">
                                <i class="fa fa-save pr-2"></i>Save
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <button type="submit" class="btn btn-info"
                        style="width:20%;margin:0 auto; margin-top:30px;">
                        Update Employee</button>
                    </div>
                </form>
                {{-- @endforeach --}}
        </div>

    <!-- </div> -->
</div>
@endsection
@section('script')
<script>
    // $('#deptID2').on('change' , function(){
    //     var d = $(this).val();
    //     $.ajax({
    //     type:"GET",
    //     url:"{{ url('getEmpDesig') }}",
    //     data: {data: d},
    //     success: function (html) {
    //         console.log(html);
    //         $('#desigID2').html(html);
    //     }
    //   });

    // });
</script>
@endsection

