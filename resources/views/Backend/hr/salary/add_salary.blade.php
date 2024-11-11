@extends('Backend.layouts.layouts')

@section('title', 'Page Title')


@section('main_contain')

<div class="br-mainpanel">

    <!-- <div class="br-pagetitle">
      <i class="fa-duotone fa-gear"></i>
      <div>
        <h4>Add Employee Salary</h4>
      </div>
    </div>d-flex -->


      <!-- <div class="p-5"> -->

          <div class="br-section-wrapper">
                <div class="text-center mb-4">
                    <h1 class="">Add Employee Salary</h1>
                    <br>
                </div>
              <form action="/storeSalary" method="post">
                  @csrf
                  <div class="row">
                      <div class="col-md-4" style="margin-bottom: 5px">
                        <label for="exampleDataList" class="form-label">Employee Name :</label>

                        <select name="empId" class="form-control">
                            <option value="">Select Employee</option>
                            @foreach ($employee as $emp)
                            <option value="{{ $emp->id}}">{{ $emp->employee_name }}
                            @endforeach
                        </select>
                          </div>
                      <div class="col-md-4" style="margin-bottom: 5px">
                          <label for="">Salary Month : </label>
                          <input type="text" name="salary_month" id="" class="form-control" placeholder="Type salary month here.." required>
                      </div>
                      <div class="col-md-4" style="margin-bottom: 5px">
                          <label for="">Generate Date : </label>
                           <input type="text" class="form-control form-control-sm" name="monthDate" id="monthDate" autocomplete="off" placeholder="yyyy-mm" required />

                      </div>
                      <div class="col-md-6" style="margin-bottom: 5px">
                          <label for="">Generate By : </label>
                          <input type="text" name="generate_by" id="" class="form-control" placeholder="Type generate by.." required>
                      </div>
                      <div class="col-md-6" style="margin-bottom: 5px">
                          <label for="">Leave Status : </label>
                          <select name="status" id="" class="form-control" requird>
                            <option value="" selected disabled>Choose Status..</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                          </select>
                      </div>
                    </div>
                      <br><br>
                      <center>
                      <div class="row">
                        <div class="col-md-12">
                      <button class="btn btn-info">
                          <i class="fa-regular fa-plus"></i>
                           Add Salary
                      </button>
                      </div>
                      </div>
                      </center>

              </form>

          </div>
      <!-- </div> -->

</div>

@endsection
@section('script')
<script>
    $("#monthDate").datepicker( {
            format: "yyyy-mm",
            startView: "months",
            minViewMode: "months",
            autoclose: true
        });
$(function() {
  $('.selectpicker').selectpicker();
});
</script>
@endsection
