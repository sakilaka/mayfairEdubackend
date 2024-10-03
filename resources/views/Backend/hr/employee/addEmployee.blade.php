@extends('Backend.layouts.layouts')
@section('title', 'Employee')

@section('main_contain')

<div class="br-mainpanel">

      <!-- <div class="br-pagetitle">
        <i class="fa-duotone fa-screen-users"></i>
        <div>
          <h4>Add an Employee</h4>
          <p class="mg-b-0">Add Employee Information</p>
        </div>
      </div>d-flex -->


        <!-- <div class="p-5"> -->

            <div class="br-section-wrapper">

                <div class="text-center mb-4">
                    <h1 class="">Add Employee Information</h1>
                    <br>
                </div>

                <form action="{{ url("storeEmployee") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <input type="hidden" value="0" name="id"  required>
                        <div class="col-sm-6">
                            <label for="">Department *</label>
                            <select class="form-control form-control-sm" id="deptID2" name="deptID" required>
                                <option>-- Select One --</option>
                                @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="">Designation *</label>
                            <select class="form-control form-control-sm" id="desigID2" name="desigID" required>
                                <option>-- wait --</option>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <label for=""> Employee Name *</label>
                            <input type="text" class=" form-control form-control-sm" name="empName" autocomplete="off" required>
                        </div>

                        <div class="col-sm-4">
                            <label for=""> Father's Name *</label>
                            <input type="text" class=" form-control form-control-sm" name="fName" autocomplete="off" required>
                        </div>

                        <div class="col-sm-4">
                            <label for=""> Mother's Name *</label>
                            <input type="text" class=" form-control form-control-sm" name="mName" autocomplete="off" required>
                        </div>

                        <div class="col-sm-6">
                            <br/>
                            <label for="">Current Address *</label>
                            <textarea class="form-control form-control-sm" name="cAddress" cols="10" placeholder="Current Address" rows="2" required>

                            </textarea>
                        </div>

                        <div class="col-sm-6">
                            <br/>
                            <label for="">Permanent Address *</label>
                            <textarea class="form-control form-control-sm" name="pAddress" cols="10" placeholder="Permanent Address" rows="2" required>

                            </textarea>
                            <br/>
                        </div>

                        <div class="col-sm-3">
                            <label for="">Date of Birth *</label>
                            <input onclick="this.showPicker()" type="date" class=" form-control form-control-sm" name="dob" required>
                        </div>

                        <div class="col-sm-3">
                            <label for=""> Nationality *</label>
                            <input type="text" class=" form-control form-control-sm" name="nationality" autocomplete="off" required>
                        </div>

                        <div class="col-sm-3">
                            <label for=""> Religion *</label>
                            <input type="text" class=" form-control form-control-sm" name="religion" autocomplete="off" required>
                        </div>

                        <div class="col-sm-3">
                            <label for=""> NID *</label>
                            <input type="text" class=" form-control form-control-sm" name="nid" autocomplete="off" required><br/>
                        </div>

                        <div class="col-sm-3">
                            <label for="">Blood Group </label>
                            <input type="text" class=" form-control form-control-sm" name="bloodGroup" autocomplete="off">
                        </div>

                        <div class="col-sm-3">
                            <label for="" > Marital Status *</label>
                            <select class="form-control form-control-sm" name="maritalStatus" required>
                                <option value="Unmarried">Unmarried</option>
                                <option value="Married">Married</option>
                            </select>
                        </div>

                        <div class="col-sm-3">
                            <label for="" > Gender *</label>
                            <select class="form-control form-control-sm" name="gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>

                        </div>

                        <div class="col-sm-3">
                            <label for="">Mobile *</label>
                            <input type="text" class=" form-control form-control-sm" name="mobile" autocomplete="off" required>
                        </div>

                        <div class="col-sm-3">
                            <label for="">Office Phone </label>
                            <input type="text" class=" form-control form-control-sm" name="officePhone" autocomplete="off">
                        </div>

                        <div class="col-sm-6">
                            <label for="">Email *</label>
                            <input type="email" class=" form-control form-control-sm"  name="email" autocomplete="off" required><br/>
                        </div>

                        <div class="col-sm-3">
                            <label for="">Employee ID *</label>
                            <input type="text" class=" form-control form-control-sm" name="empID" autocomplete="off" required>
                        </div>

                        <div class="col-sm-3">
                            <label for="">Basic Salary *</label>
                            <input type="number" class=" form-control form-control-sm"  name="salary" step="any" autocomplete="off" required>
                        </div>

                        <div class="col-sm-3">
                            <label for="">Join Date *</label>
                            <input type="date" class=" form-control form-control-sm"  name="joinDate" autocomplete="off" required>
                        </div>

                        <div class="col-sm-3">
                            <label for="">Regine Date </label>
                            <input type="date" class=" form-control form-control-sm" name="rejineDate" autocomplete="off">
                        </div>

                        <div class="col-sm-3">
                            <label for="">Image *</label>
                            <input type="file" class=" form-control form-control-sm"  name="image" autocomplete="off" required>
                        </div>


                        <div class="col-sm-6">
                            <br/>
                            <label for="">Note </label>
                            <textarea class="form-control form-control-sm" name="note"  cols="10" placeholder="Permanent Address" rows="2">

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
                        Add Employee</button>
                    </div>
                </form>
        <!-- </div> -->

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('#deptID2').on('change' , function(){
        var d = $(this).val();
        $.ajax({
        type:"GET",
        url:"{{ url('getEmpDesig') }}",
        data: {data: d},
        success: function (html) {
            $('#desigID2').html(html);
        }
      });

    });
</script>

</div>
@stop



