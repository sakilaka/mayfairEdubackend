<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Hrleave;
use App\Models\Payment_range;
use App\Models\SalarySheet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class HrController extends Controller
{
    public function agentHiring(){
        return view('backend.hr.agent.agenthiring');
    }
     public function getStockData(Request $req) {

        // $packageId = DB::table('cart')->pluck('package_id')->all();

        // ->where('status' , '0')

        $package_info = DB::table('package_info')
        ->get();

        $user = DB::table('user')->get();
        $packageList = DB::table('packagelisting')->get();
        $cart = DB::table('cart')->get();

        return view('backend.hr.stock.manageStock', compact('package_info' , 'user' , 'packageList' , 'cart'));

    }

    public function storeAgentData(Request $request){
        $agent =  DB::table('user')->insert([
            'name'=> $request->name,
            'email' =>$request->email,
            'phone'=>$request->phone,
            'role'=>'2',
            'password'=>md5($request->password)
        ]);

            $userData = DB::table('user')
            ->where('email' , $request->email)
            ->where('password' , md5($request->password))
            ->first();

        DB::table('agent_info')->insert([
            'userId'=>$userData->id,
            'license' =>$request->license,
            'education'=>$request->education,
            'specialist'=>$request->specialist
        ]);

        return redirect('/manageAgent');
    }

    public function manageAgent(){

        $agentUser = Db::table('user')->where('role','=','2')->get();

        $getAgentData = DB::table('agent_info')
        ->join('user','user.id','=','agent_info.userId')
        ->get();

        return view('backend.hr.agent.manageAgentinfo',compact('getAgentData'));
    }

    public function editAgentHiring($id){
        $agent_info = DB::table('agent_info')
        ->join('user','user.id','=','agent_info.userId')
        ->where('agent_id',$id)
        ->get();

        return view('backend.hr.agent.editAgenthiring',compact('agent_info'));

    }

    public function updateAgentInfo(Request $request, $id){

        $data = DB::table('agent_info')
        ->join('user','user.id','=','agent_info.userId')
        ->where('agent_id',$id)
        ->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'license' =>$request->license,
            'education'=>$request->education,
            'specialist'=>$request->specialist
        ]);

        // echo $data;

        return redirect('/manageAgent');
    }

    public function deleteAgentData($id){

        // echo $data;

        $td = DB::table('agent_info')->where('agent_id',$id)->first();

        $data = DB::table('user')
        ->where('id',$td->userId)
        ->delete();

        DB::table('agent_info')
        ->where('agent_id',$id)
        ->delete();


        return redirect('/manageAgent');

    }

    public function viewDepartment(){
        $departmentData = Department::where('type',2)->get();
        return view('backend.hr.department.allDepartment',compact('departmentData'));
    }

    public function addDepartment(){
        return view('backend.hr.department.adddepartment');
    }

    public function storeDeptData(Request $request){
        DB::table('departments')->insert([
            'name' =>$request->name,
            'type' =>2
        ]);

        return redirect('/viewDepartment');
    }

    public function editDepartment($id){
        $department = DB::table('departments')->where('id',$id)->get();
        return view('backend.hr.department.editdepartment',compact('department'));
    }

    public function updateDepartment(Request $request, $id){
        DB::table('departments')->where('id',$id)->update([
                'name'=>$request->name
            ]);

        return redirect('/viewDepartment');
    }

    public function deleteDept($id){
        DB::table('departments')->where('id',$id)->delete();
        return redirect('/viewDepartment');

    }

    public function viewDesignation(){
        $designationData = DB::table('designations')
        ->get();
        $department = DB::table('departments')->where('type',2)->get();

        $employee = DB::table('employee_info')->get();

        return view('backend.hr.designation.allDesignation',compact('designationData','employee','department'));
    }

    public function addDesignation(){
        $department = DB::table('departments')->where('type',2)->get();
        return view('backend.hr.designation.adddesignation',compact('department'));
    }

    public function storeDesgData(Request $request){
        DB::table('designations')->insert([
            'name' =>$request->name,
            'department_id'=>$request->department_id,
        ]);

        return redirect('/viewDesignation');
    }

    public function editDesignation($id){
        $department = DB::table('departments')->where('type',2)->get();
        $getName = DB::table('designations')->join('departments', 'departments.id', '=', 'designation.department_id')->where('designation.id', $id)->first();
        echo  $getName?->department_id;
        $designation = DB::table('designation')->where('id',$id)->get();
        return view('backend.hr.designation.editdesignation',compact('designation','department','getName'));

    }

    public function updateDesignation(Request $request, $id)
    {
        //dd($request);
        //$pre_cat = $request->prev_cate;
        // if (!empty($request->department_id)) {

        //     DB::table('designation')->where('id', $id)->update([
        //         'department_id' => $request->department_id
        //     ]);
        // }
       DB::table('designations')->where('id', $id)->update([
            'department_id' => $request->department_id,
            'name' => $request->name,
        ]);
        return redirect('/viewDesignation')->with('msg', 'Designation Updated Successfully');;
    }

    public function DeleteDesg($id){
        DB::table('designation')->where('id',$id)->delete();
        return redirect('/viewDesignation');

    }
    function getEmpDesig(Request $request){
        $designation = DB::table('designation')
        ->where('department_id' , $request->data)
        ->get();

        foreach ($designation as $desg) {
            echo "<option value='$desg->id'>" . $desg->name . "</option>";
        }
    }

    public function allEmployee(){
        $employee  = Employee::get();
        //dd($employee[0]);
        return view('backend.hr.employee.manageEmployee',compact('employee'));
    }

    public function addEmployee(){
        $departments = Department::where('type','2')->get();
        return view('backend.hr.employee.addEmployee',compact('departments'));
    }

    public function storeEmployee(Request $request){

        $this->validate($request,[
            'deptID'=>'required',
            'desigID'=>'required',
            'empName'=>'required',
            'fName'=>'required',
            'mName'=>'required',
            'cAddress'=>'required',
            'pAddress'=>'required',
            'dob'=>'required',
            'nationality'=>'required',
            'religion'=>'required',
            'nid'=>'required',
            'maritalStatus'=>'required',
            'gender'=>'required',
            'mobile'=>'required',
            'email'=>'required',
            'empID'=>'required',
            'salary'=>'required',
            'joinDate'=>'required',
        ]);
        try{
            DB::beginTransaction();
            // mail sent with login info to employee

            $employeePassword = Str::random(8);

            $userData=User::where('email',$request->email)->first();
            if(!$userData){
                $userData=new User();
            }

            $userData->fname=$request->empName;
            $userData->email=$request->email;
            $userData->password=$employeePassword;
            $userData->type=20;
            // $userData->empID=$request->empID;
            $userData->save();
           //if($userData->save()){
                // $projectDomainName= $request->getSchemeAndHttpHost();
                // $userData->notify(new SendLoginInfoToEmployee($projectDomainName,$request->email,$request->empName,$employeePassword));
           // }

            // end mail sent with login info to employee
            $data=new Employee();
            $data->user_id=$userData->id;
             $file=$request->file('image');
            if($file){
                $filename=date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('public/upload/Employee_Image'),$filename);
                $data->employee_image=$filename;
            }
            $data->department_id =$request->deptID;
            $data->designation_id =$request->desigID;
            $data->employee_name =$request->empName;
            $data->father_name =$request->fName;
            $data->mother_name =$request->mName;
            $data->cAddress=$request->cAddress;
            $data->pAddress=$request->pAddress;
            $data->date_of_birth=$request->dob;
            $data->nationality=$request->nationality;
            $data->religion=$request->religion;
            $data->nid_number=$request->nid;
            $data->bloodGroup=$request->bloodGroup;
            $data->maritalStatus=$request->maritalStatus;
            $data->gender=$request->gender;
            $data->mobile=$request->mobile;
            $data->officePhone=$request->officePhone;
            $data->email=$request->email;
            $data->employee_id=$request->empID;
            $data->salary=$request->salary;
            $data->join_date=$request->joinDate;
            $data->rejineDate=$request->rejineDate;
            $data->note=$request->note;
            $data->save();
            DB::commit();
            return redirect('/allEmployee');
        }catch(\Exception $e){
            DB::rollBack();
          return redirect('/allEmployee')->with('error',"something went wrong!");
        }

    }

    public function editEmployee($id){
        $employeeData =Employee::where('id',$id)->first();
        //dd($employeeData);
        $departments = Department::where('type','2')->get();

        $emp_designations = Designation::where('department_id',$employeeData->department_id)->get();
       // dd($emp_designations);
        return view('backend.hr.employee.editEmployee',compact('employeeData','departments','emp_designations'));
    }

    public function updateEmployee(Request $request, $id){

      $this->validate($request,[
            'deptID'=>'required',
            'desigID'=>'required',
            'empName'=>'required',
            'fName'=>'required',
            'mName'=>'required',
            'cAddress'=>'required',
            'pAddress'=>'required',
            'dob'=>'required',
            'nationality'=>'required',
            'religion'=>'required',
            'nid'=>'required',
            'maritalStatus'=>'required',
            'gender'=>'required',
            'mobile'=>'required',
            'email'=>'required',
            'empID'=>'required',
            'salary'=>'required',
            'joinDate'=>'required',
        ]);
        try{
             DB::beginTransaction();
            $data= Employee::find($id);
            $userData=User::find($data->user_id);
            $userData->fname=$request->empName;
            $userData->email=$request->email;
            $userData->save();
            $file=$request->file('image');
            if($file){
                $filename=date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('public/upload/Employee_Image'),$filename);
                @unlink(public_path('public/upload/Employee_Image/'.$data->image));
                $data->employee_image=$filename;
            }
            $data->user_id=$userData->id;
            $data->department_id =$request->deptID;
            $data->designation_id =$request->desigID;
            $data->employee_name =$request->empName;
            $data->father_name =$request->fName;
            $data->mother_name =$request->mName;
            $data->cAddress=$request->cAddress;
            $data->pAddress=$request->pAddress;
            $data->date_of_birth=$request->dob;
            $data->nationality=$request->nationality;
            $data->religion=$request->religion;
            $data->nid_number=$request->nid;
            $data->bloodGroup=$request->bloodGroup;
            $data->maritalStatus=$request->maritalStatus;
            $data->gender=$request->gender;
            $data->mobile=$request->mobile;
            $data->officePhone=$request->officePhone;
            $data->email=$request->email;
            $data->employee_id=$request->empID;
            $data->salary=$request->salary;
            $data->join_date=$request->joinDate;
            $data->rejineDate=$request->rejineDate;
            $data->note=$request->note;
            $data->save();
            DB::commit();
            return redirect('/allEmployee');
        }catch(\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            return redirect('/allEmployee')->with('error',"something went wrong!");
        }
    }

    public function deleteEmployee($id){
        DB::table('employee_info')->where('id',$id)->delete();
        return redirect('/allEmployee');
    }

    public function addLeave(){

        $employee = Employee::get();

        return view('backend.hr.leave.add_leave',compact('employee'));
    }

    public function storeLeave(Request $request){
        $this->validate($request,[
            'empId' => 'required',
            'type'=> 'required',
        ]);
        $leave = Hrleave::create([
            'employee_id' => $request->empId,
            'leave_type'  => $request->type,
            'reason' => $request->reason,
            'status' => $request->status
        ]);


        return redirect('/manageLeave');
    }

    public function manageLeave(){
        $viewAll = Hrleave::get();

        // $employee = DB::table('employee_info')->get();
        return view('backend.hr.leave.manage_leave',compact('viewAll'));
    }

    public function editLeave($id){
        $editData = Hrleave::find($id);
 $employee = Employee::get();
        return view('backend.hr.leave.edit_leave',compact('editData','employee'));
    }

    public function updateLeave(Request $request, $id){
         $this->validate($request,[
            'empId' => 'required',
            'type'=> 'required',
        ]);
        $leave = Hrleave::where('id',$id)->update([
            'employee_id' => $request->empId,
            'leave_type'  => $request->type,
            'reason' => $request->reason,
            'status' => $request->status
        ]);


        return redirect('/manageLeave');
    }

    public function deleteLeave($id){
       Hrleave::where('id',$id)->delete();
        return redirect('/manageLeave');

    }


    public function addSalary(){
        $employee = Employee::get();
        return view('backend.hr.salary.add_salary',compact('employee'));
    }

    public function storeSalary(Request $request){
        DB::table('salary_manage')->insert([
            'emp_id' => $request->empId,
            'salary_month' => $request->salary_month,
            'generate_date' => $request->generate_date,
            'generate_by' =>$request->generate_by,
            'status' => $request->status
        ]);

        return redirect('/manageSalary');

    }

    public function manageSalary(){
        $allData = SalarySheet::get();

        return view('backend.hr.salary.manage_salary',compact('allData'));
    }

    public function editSalary($id){
        $salaryData = SalarySheet::find($id);
        $employee = DB::table('employee_info')->get();
        return view('backend.hr.salary.edit_salary',compact('salaryData','employee'));
    }

    public function updateSalary(Request $request, $id){
        DB::table('salary_manage')->where('id',$id)->update([
            'emp_id' => $request->empId,
            'salary_month' => $request->salary_month,
            'generate_date' => $request->generate_date,
            'generate_by' =>$request->generate_by,
            'status' => $request->status
        ]);

        return redirect('/manageSalary');
    }

    public function deleteSalary($id){
        DB::table('salary_manage')->where('id',$id)->delete();
        return redirect('/manageSalary');

    }


    public function SalarySheet() {

        $salaryData = DB::table('salary_manage')->get();
        return view('backend.hr.salary.salary_sheet',compact('salaryData'));

    }


    //--------------------Account-> Sales Methods------------------------//

    public function manageAccounts(){

        $cart = DB::table('cart')->get();
        $user = DB::table('user')->get();
        $pkg = DB::table('package_info')->get();
        return view('backend.hr.account.sale.manageAccounts' , compact('cart' , 'user' , 'pkg'));
    }


    public function manageAccountsSorting(Request $req) {

        $cart = DB::table('cart')->whereBetween('deal_date', [$req->min , $req->max])->get();
        $user = DB::table('user')->get();
        $pkg = DB::table('package_info')->get();
        return view('backend.hr.account.sale.loadManageAccounts' , compact('cart' , 'user' , 'pkg'));

    }

    //--------------------Account-> Due Methods------------------------//

    public function manageDue(){

        $cart = DB::table('cart')->get();
        $user = DB::table('user')->get();
        $pkg = DB::table('package_info')->get();
        return view('backend.hr.account.due.manageDue' , compact('cart' , 'user' , 'pkg'));
    }

    public function manageDueSorting(Request $req) {

        $cart = DB::table('cart')->whereBetween('deal_date', [$req->min , $req->max])->get();
        $user = DB::table('user')->get();
        $pkg = DB::table('package_info')->get();
        return view('backend.hr.account.due.loadManageDue' , compact('cart' , 'user' , 'pkg'));

    }
    //--------------------Account-> Stock Methods------------------------//

    public function getStock(Request $req) {

        $packageId = DB::table('cart')->pluck('package_id')->all();

        $package_info = DB::table('package_info')
        ->whereNotIn('id', $packageId)
        ->get();

        $user = DB::table('user')->get();
        $packageList = DB::table('packagelisting')->get();
        $cart = DB::table('cart')->get();

        return view('backend.hr.account.stock.manageStock', compact('package_info' , 'user' , 'packageList' , 'cart'));

    }

    public function manageStockSorting(Request $req) {

        $cart = DB::table('cart')->whereBetween('deal_date', [$req->min , $req->max])->get();
        $user = DB::table('user')->get();
        $pkg = DB::table('package_info')->get();
        return view('backend.hr.account.stock.loadManageStock' , compact('cart' , 'user' , 'pkg'));

    }

        //--------------------Account-> Profit Methods------------------------//

        public function manageProfit(){

            $cart = DB::table('cart')->get();
            $user = DB::table('user')->get();
            $pkg = DB::table('package_info')->get();
            return view('backend.hr.account.profit.manageProfit' , compact('cart' , 'user' , 'pkg'));
        }


        public function manageProfitSorting(Request $req) {

             $cart = DB::table('cart')->whereBetween('deal_date', [$req->min , $req->max])->get();
             $user = DB::table('user')->get();
            $pkg = DB::table('package_info')->get();
             return view('backend.hr.account.profit.loadManageProfit' , compact('cart' , 'user' , 'pkg'));

         }

             //--------------------Account-> Stock Out Methods------------------------//

    public function getStockOut(){

        $cart = DB::table('cart')->get();
        $user = DB::table('user')->get();
        $pkg = DB::table('package_info')->get();
        return view('backend.hr.account.stock.getStockOut' , compact('cart' , 'user' , 'pkg'));
    }


    public function manageStockOutSorting(Request $req) {

        $cart = DB::table('cart')->whereBetween('deal_date', [$req->min , $req->max])->get();
        $user = DB::table('user')->get();
        $pkg = DB::table('package_info')->get();
        return view('backend.hr.account.stock.loadManageStockOut' , compact('cart' , 'user' , 'pkg'));

    }

    //--------------------Account-> Service Expenses Methods------------------------//

    public function getServiceExpenses() {

        $services = DB::table('services')
        ->get();

        return view('backend.hr.account.expense.manage' , compact('services'));

    }

    public function manageExpensesSorting(Request $req) {

        $cart = DB::table('cart')->whereBetween('deal_date', [$req->min , $req->max])->get();
        $user = DB::table('user')->get();
        $pkg = DB::table('package_info')->get();
        return view('backend.hr.account.expense.loadManageExpenses' , compact('cart' , 'user' , 'pkg'));

    }

        //--------------------Account-> Loss Methods------------------------//

        public function manageloss() {

            // $loss = DB::table('')
            // ->get();

            return view('backend.hr.account.loss.manage');
            //, compact('loss')

        }

/**
         * Payroll
         */

         public function managePayroll(){

            $viewAll = DB::table('payrolls')->get();
           return view('backend.hr.payroll.manage',compact('viewAll'));
            }

           public function addPayroll()
           {




               return view('backend.hr.payroll.create');
           }

           public function storePayroll(Request $request)
           {
              // return $request;

               $request->validate([
                   "house_rent" => ["required"],
                   "medical_cost" => ["required"],
                   "provident_fund" => ["required"],
                   "transport_cost" => ["required"],
                   "tax" => ["required"]
               ]);

               DB::table('payrolls')->insert([
               'house_rent' => $request->house_rent,
               'medical_cost' => $request->medical_cost,
               'transport_cost' => $request->transport_cost,
               'provident_fund' => $request->provident_fund,
               'tax' => $request->tax,
           ]);
           return redirect()->route('managePayroll');
           }

           public function deletePayroll($id)
           {
                DB::table('payrolls')->where('id',$id)->delete();
                return back();
           }


       public function editPayroll($id){
           $p = DB::table('payrolls')->where('id',$id)->first();
           return view('backend.hr.payroll.edit',compact('p'));
       }

       public function updatePayroll(Request $request, $id){
           DB::table('payrolls')->where('id',$id)->update([
                'house_rent' => $request->house_rent,
               'medical_cost' => $request->medical_cost,
               'transport_cost' => $request->transport_cost,
               'provident_fund' => $request->provident_fund,
               'tax' => $request->tax,
           ]);

           return redirect()->route('managePayroll');
       }

        /**
            * Absent
            */

           public function manageAbsent(){

            $viewAll = DB::table('absents')->get();
               return view('backend.hr.absent.manage',compact('viewAll'));
            }

           public function addAbsent()
           {



               return view('backend.hr.absent.create');
           }

           public function storeAbsent(Request $request)
           {
               $request->validate([
                   "first" => ["required"],
                   "other" => ["required"],
               ]);

               DB::table('absents')->insert([
               'first' => $request->first,
               'other' => $request->other,
           ]);
           return redirect()->route('manageAbsent');
           }

           public function deleteAbsent($id)
           {
                DB::table('absents')->where('id',$id)->delete();
                return back();
           }


       public function editAbsent($id){
           $p = DB::table('absents')->where('id',$id)->first();
           return view('backend.hr.absent.edit',compact('p'));
       }

       public function updateAbsent(Request $request, $id){
           DB::table('absents')->where('id',$id)->update([
               'first' => $request->first,
               'other' => $request->other,
           ]);

           return redirect()->route('manageAbsent');
       }

        /**
            * LateRoll
            */

           public function manageLateRoll(){

            $viewAll = DB::table('late_rolls')->get();
               return view('backend.hr.late_roll.manage',compact('viewAll'));
            }

           public function addLateRoll()
           {


               return view('backend.hr.late_roll.create');
           }

           public function storeLateRoll(Request $request)
           {
               $request->validate([
                   "late" => ["required"],
                   "absent" => ["required"],
               ]);

               DB::table('late_rolls')->insert([
               'late' => $request->late,
               'absent' => $request->absent,
           ]);
           return redirect()->route('manageLateRoll');
           }

           public function deleteLateRoll($id)
           {
                DB::table('late_rolls')->where('id',$id)->delete();
                return back();
           }


       public function editLateRoll($id){
           $p = DB::table('late_rolls')->where('id',$id)->first();
           return view('backend.hr.late_roll.edit',compact('p'));
       }

       public function updateLateRoll(Request $request, $id){
           DB::table('late_rolls')->where('id',$id)->update([
            'late' => $request->late,
               'absent' => $request->absent,
           ]);

           return redirect()->route('manageLateRoll');
       }



        /**
            * Overtime
            */

           public function manageOvertime(){

            $viewAll = DB::table('overtimes')->get();
               return view('backend.hr.overtime.manage',compact('viewAll'));
            }

           public function addOvertime()
           {


               return view('backend.hr.overtime.create');
           }

           public function storeOvertime(Request $request)
           {
               $request->validate([
                   "hour" => ["required"],
                   "amount" => ["required"],
               ]);

               DB::table('overtimes')->insert([
               'hour' => $request->hour,
               'amount' => $request->amount,
           ]);
           return redirect()->route('manageOvertime');
           }

           public function deleteOvertime($id)
           {
                DB::table('overtimes')->where('id',$id)->delete();
                return back();
           }


       public function editOvertime($id){
           $p = DB::table('overtimes')->where('id',$id)->first();
           return view('backend.hr.overtime.edit',compact('p'));
       }

       public function updateOvertime(Request $request, $id){
           DB::table('overtimes')->where('id',$id)->update([
             'hour' => $request->hour,
               'amount' => $request->amount,
           ]);

           return redirect()->route('manageOvertime');
       }


        /**
            * Payment Range
            */

           public function managePaymentRange(){
            //dd("hi");
                $viewAll = Payment_range::get();
                $departments = Department::where('type',2)->get();
                $designations = DB::table('designation')->get();
            //dd($departments);
    return view('Backend.hr.payment.manage',compact('viewAll','designations','departments'));

            }



           public function storePaymentRange(Request $request)
           {
               $request->validate([
                   "max" => ["required"],
                   "min" => ["required"],
                   "department_id" => ["required"],
                   "designation_id" => ["required"],
               ]);

               DB::table('payment_ranges')->insert([
               'department_id' => $request->department_id,
               'designation_id' => $request->designation_id,
               'minimum_amount' => $request->min,
               'maximum_amount' => $request->max,

               ]);
           return redirect()->route('managePaymentRange');
           }

           public function deletePaymentRange($id)
           {
                DB::table('payment_ranges')->where('id',$id)->delete();
                return back();
           }



       public function updatePaymentRange(Request $request, $id){
           DB::table('payment_ranges')->where('id',$id)->update([
              'department_id' => $request->department_id,
               'designation_id' => $request->designation_id,
               'min' => $request->min,
               'max' => $request->max,
           ]);

           return redirect()->route('managePaymentRange');
       }

        /** Size **/

           public function manageSize(){

            $viewAll = DB::table('sizes')->orderBy('id','desc')->get();
               return view('backend.hr.size.manage',compact('viewAll'));
            }

           public function storeSize(Request $request){

               DB::table('sizes')->insert([
               'name' => $request->name,
               ]);
               return redirect()->route('manageSize');
           }

           public function deleteSize($id)
           {
               DB::table('sizes')->where('id',$id)->delete();
               return redirect()->route('manageSize');
           }
            public function updateSize(Request $request,$id){

                DB::table('sizes')->where('id',$id)->update([
               'name' => $request->name,
               ]);
               return redirect()->route('manageSize');
           }

            /**
            * Color
            */

           public function manageColor(){

            $viewAll = DB::table('colors')->orderBy('id','desc')->get();
               return view('backend.hr.color.manage',compact('viewAll'));
            }

           public function storeColor(Request $request){

               DB::table('colors')->insert([
               'name' => $request->name,
               ]);
               return redirect()->route('manageColor');
           }

           public function deleteColor($id)
           {
               DB::table('colors')->where('id',$id)->delete();
               return redirect()->route('manageColor');
           }
            public function updateColor(Request $request,$id){

                DB::table('colors')->where('id',$id)->update([
               'name' => $request->name,
               ]);
               return redirect()->route('manageColor');
           }

           /**
            * Brand
            */

           public function manageBrand(){

            $viewAll = DB::table('brands')->orderBy('id','desc')->get();
               return view('backend.hr.brand.manage',compact('viewAll'));
            }

           public function storeBrand(Request $request){

               DB::table('brands')->insert([
               'name' => $request->name,
               ]);
               return redirect()->route('manageBrand');
           }

           public function deleteBrand($id)
           {
               DB::table('brands')->where('id',$id)->delete();
               return redirect()->route('manageBrand');
           }
            public function updateBrand(Request $request,$id){

                DB::table('brands')->where('id',$id)->update([
               'name' => $request->name,
               ]);
               return redirect()->route('manageBrand');
           }

           /**
            * Category
            */

           public function manageCategory(){

            $viewAll = DB::table('categories')->orderBy('id','desc')->get();
               return view('backend.hr.category.manage',compact('viewAll'));
            }

           public function storeCategory(Request $request){

               DB::table('categories')->insert([
               'name' => $request->name,
               ]);
               return redirect()->route('manageCategory');
           }

           public function deleteCategory($id)
           {
               DB::table('categories')->where('id',$id)->delete();
               return redirect()->route('manageCategory');
           }
            public function updateCategory(Request $request,$id){

                DB::table('categories')->where('id',$id)->update([
               'name' => $request->name,
               ]);
               return redirect()->route('manageCategory');
           }

            /**
            * Bank
            */

           public function manageBank(){

            $viewAll = DB::table('banks')->orderBy('id','desc')->get();
               return view('backend.hr.bank.manage',compact('viewAll'));
            }

           public function storeBank(Request $request){

               DB::table('banks')->insertGetId([
               'name' => $request->name . " Bank",
               ]);
               return redirect()->route('manageBank');
           }

           public function deleteBank($id)
           {
               DB::table('banks')->where('id',$id)->delete();
               return redirect()->route('manageBank');
           }
            public function updateBank(Request $request,$id){

                DB::table('banks')->where('id',$id)->update([
               'name' => $request->name,
               ]);
               return redirect()->route('manageBank');
           }


            /**
            * Branch
            */

           public function manageBranch(){
           $banks = DB::table('banks')->orderBy('id','desc')->get();
            $viewAll = DB::table('branches')->orderBy('id','desc')->get();
               return view('backend.hr.branch.manage',compact('viewAll','banks'));
            }

           public function storeBranch(Request $request){


              $data = [];

              foreach($request->names as $name){
               $t = [
                   "name" => $name,
                   "bank_id" => $request->bank_id,
               ];

               array_push($data,$t);
              }

               DB::table('branches')->insert($data);
               return redirect()->route('manageBranch');
           }

           public function deleteBranch($id)
           {
               DB::table('branches')->where('id',$id)->delete();
               return redirect()->route('manageBranch');
           }
            public function updateBranch(Request $request,$id){

                DB::table('branches')->where('id',$id)->update([
               'name' => $request->name,
               'bank_id' => $request->bank_id,
               ]);
               return redirect()->route('manageBranch');
           }

            /**
            * Internet Bank
            */

           public function manageInternetBank(){

            $viewAll = DB::table('internet_banks')->orderBy('id','desc')->get();
               return view('backend.hr.internet_bank.manage',compact('viewAll'));
            }

           public function storeInternetBank(Request $request){

               DB::table('internet_banks')->insert([
               'name' => $request->name ,
               ]);
               return redirect()->route('manageInternetBank');
           }

           public function deleteInternetBank($id)
           {
               DB::table('internet_banks')->where('id',$id)->delete();
               return redirect()->route('manageInternetBank');
           }
            public function updateInternetBank(Request $request,$id){

                DB::table('internet_banks')->where('id',$id)->update([
               'name' => $request->name,
               ]);
               return redirect()->route('manageInternetBank');
           }

            /**
            * Mobile Bank
            */

           public function manageMobileBank(){

            $viewAll = DB::table('mobile_banks')->orderBy('id','desc')->get();
               return view('backend.hr.mobile_bank.manage',compact('viewAll'));
            }

           public function storeMobileBank(Request $request){

               DB::table('mobile_banks')->insert([
               'name' => $request->name ,
               ]);
               return redirect()->route('manageMobileBank');
           }

           public function deleteMobileBank($id)
           {
               DB::table('mobile_banks')->where('id',$id)->delete();
               return redirect()->route('manageMobileBank');
           }
            public function updateMobileBank(Request $request,$id){

                DB::table('mobile_banks')->where('id',$id)->update([
               'name' => $request->name,
               ]);
               return redirect()->route('manageMobileBank');
           }
        /**
            * Purchase
            */

           public function managePurchase(){

            $viewAll = DB::table('purchases')->orderBy('id','desc')->get();
               return view('backend.hr.purchase.manage',compact('viewAll'));
            }

            function tempPurchase(){
               $sizes = DB::table('sizes')->orderBy('id','desc')->get();
               $colors = DB::table('colors')->orderBy('id','desc')->get();
               $brands = DB::table('brands')->orderBy('id','desc')->get();
               $categories = DB::table('categories')->orderBy('id','desc')->get();
               return view('backend.hr.purchase.temp',compact('sizes','colors','brands','categories'));
           }

           public function addPurchase()
           {
               $sizes = DB::table('sizes')->get();
               $colors = DB::table('colors')->get();
               $brands = DB::table('brands')->get();
               $categories = DB::table('categories')->get();

               return view('backend.hr.purchase.create',compact('sizes','colors','brands','categories'));

           }

           public function storePurchase(Request $request)
           {

             // return $request;
               $request->validate([
                   "company_name" => ["required"],
                   "company_email" => ["required"],
                   "company_employee_name" => ["required"],
                   "company_phone" => ["required"],
                   "company_address" => ["required"],
                   "product_name" => ["required"],
                   "sku" => ["required"],
               ]);

               DB::transaction(function() use($request){
                   $id =  DB::table('purchases')->insertGetId([
                       "company_name" =>$request->company_name,
                       "company_email" =>$request->company_email,
                       "company_employee_name" =>$request->company_employee_name,
                       "company_phone" =>$request->company_phone,
                       "company_address" =>$request->company_address,
                       "product_name" =>$request->product_name,
                       "sku" =>$request->sku,
                       "type" =>$request->type,
                       "status" =>$request->status,
                       "order_date" =>$request->order_date,
                       "duration" =>$request->duration,
                       "is_return" =>$request->is_return ?? null,
                       "is_refund" =>$request->is_refund ?? null,
                       "advance" => $request->advance,
                       "pay" => $request->pay,
                       "due" => $request->due,
                   ]);

                   for ($i=0; $i < count($request->sizes); $i++) {
                       DB::table('purchase_attributes')->insert([
                       'purchase_id' => $id ,
                       'size_id' => $request->sizes[$i] ,
                       'color_id' => $request->colors[$i] ,
                       'brand_id' => $request->brands[$i] ,
                       'category_id' => $request->categories[$i],
                       'qty' => $request->quantities[$i],
                       'price' =>  $request->prices[$i],
                       'discount' =>  $request->discounts[$i] ,
                       'total' => $request->totals[$i],
                       ]);
                   }

                   DB::table('purchase_payments')->insert([
                       "purchase_id" => $id,
                       "type" => $request->payment,

                       "mobile_method" => $request->mobile_method,
                       "mobile_no" => $request->mobile_no ?? null,
                       "trans_id" => $request->trans_id ?? null,
                       "screenshot" => $request->file('screenshot') ? File::upload($request->file('screenshot'),"purchase") : null,

                       "bank_id" => $request->bank_id ?? null,
                       "branch_id" => $request->branch_id ?? null,
                       "bank_account_number" => $request->bank_account_number ?? null,
                       "bank_holder_name" => $request->bank_holder_name ?? null,

                       "internet_bank_id" => $request->internet_bank_id ?? null,
                       "internet_account_number" => $request->internet_account_number ?? null,
                       "internet_holder_name" => $request->internet_holder_name ?? null
                   ]);
               });

           return redirect()->route('managePurchase');
           }

           public function deletePurchase($id)
           {
               DB::transaction(function() use($id){
                   DB::table('purchases')->where('id',$id)->delete();
                   $payment = DB::table('purchase_payments')->where('purchase_id',$id)->first();

                   File::deleteFile($payment->screenshot);
                   DB::table('purchase_payments')->where('purchase_id',$id)->delete();
                   $attributes = DB::table('purchase_attributes')->where('purchase_id',$id)->delete();

               });

               return back();
           }

           public function showPurchase($id)
           {
               $p = DB::table('purchases')->where('id',$id)->first();
               return view('backend.hr.purchase.show',compact('p'));
           }


       public function editPurchase($id){
           $p = DB::table('purchases')->where('id',$id)->first();
           $sizes = DB::table('sizes')->get();
           $colors = DB::table('colors')->get();
           $brands = DB::table('brands')->get();
           $categories = DB::table('categories')->get();

           $payment = getPurchasePayment($id);
           $attributes = getPurchaseAttributes($id);
           return view('backend.hr.purchase.edit',compact('p','sizes','colors','brands','categories','payment','attributes'));
       }

       public function updatePurchase(Request $request, $id){

          // return $request;
              DB::transaction(function() use($request,$id){
                   DB::table('purchases')->where('id',$id)->update([
                       "company_name" =>$request->company_name,
                       "company_email" =>$request->company_email,
                       "company_employee_name" =>$request->company_employee_name,
                       "company_phone" =>$request->company_phone,
                       "company_address" =>$request->company_address,
                       "product_name" =>$request->product_name,
                       "sku" =>$request->sku,
                       "type" =>$request->type,
                       "status" =>$request->status,
                       "order_date" =>$request->order_date,
                       "duration" =>$request->duration,
                       "is_return" =>$request->is_return ?? null,
                       "is_refund" =>$request->is_refund ?? null,
                       "advance" => $request->advance,
                       "pay" => $request->pay,
                       "due" => $request->due,
                   ]);

                   for ($i=0; $i < count($request->sizes)-1; $i++) {
                       DB::table('purchase_attributes')->where("purchase_id",$id)->update([
                       'purchase_id' => $id ,
                       'size_id' => $request->sizes[$i] ,
                       'color_id' => $request->colors[$i] ,
                       'brand_id' => $request->brands[$i] ,
                       'category_id' => $request->categories[$i],
                       'qty' => $request->quantities[$i],
                       'price' =>  $request->prices[$i],
                       'discount' =>  $request->discounts[$i] ,
                       'total' => $request->totals[$i],
                       ]);
                   }

                   DB::table('purchase_payments')->where("purchase_id",$id)->update([
                       "purchase_id" => $id,
                       "type" => $request->payment,

                       "mobile_method" => $request->mobile_method,
                       "mobile_no" => $request->mobile_no ?? null,
                       "trans_id" => $request->trans_id ?? null,
                       "screenshot" => $request->file('screenshot') ? File::upload($request->file('screenshot'),"purchase") : null,

                       "bank_id" => $request->bank_id ?? null,
                       "branch_id" => $request->branch_id ?? null,
                       "bank_account_number" => $request->bank_account_number ?? null,
                       "bank_holder_name" => $request->bank_holder_name ?? null,

                       "internet_bank_id" => $request->internet_bank_id ?? null,
                       "internet_account_number" => $request->internet_account_number ?? null,
                       "internet_holder_name" => $request->internet_holder_name ?? null
                   ]);
               });

           return redirect()->route('managePurchase');
       }




   }









