<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GlobalController extends Controller
{
    public function getDesignationByDepartment($id)
    {
        return DB::table('designation')
                    ->where('department_id',$id)
                    ->get();
    }


    public function getBranchByBankj($id)
    {
        return DB::table('branches')
                    ->where('bank_id',$id)
                    ->get();
    }
}
