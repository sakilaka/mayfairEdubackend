<?php

namespace App\Http\Controllers\Backend\Hr_management\Purchase;
use App\Http\Controllers\Controller;
use App\Models\Hrpurchase;
use Illuminate\Http\Request;

class HrpurchaseController extends Controller
{
    public function addPurchase()
    {
        return view('Backend.Hr_management.Purchase.Purchase_add');
    }
}
