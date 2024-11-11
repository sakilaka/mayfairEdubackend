<?php

use App\Http\Controllers\Backend\Hr_management\Designation\designationController;
use Illuminate\Support\Facades\Route;

/*-----------------------------------------------HR Management Route------------------------------------------------- */

Route::get('/getStockData', 'App\Http\Controllers\Backend\HrController@getStockData')->name('getStockData');
Route::get('/agentHiring', 'App\Http\Controllers\Backend\HrController@agentHiring')->name('agentHiring');
Route::post('/storeAgentData', 'App\Http\Controllers\Backend\HrController@storeAgentData')->name('storeAgentData');
Route::get('/manageAgent', 'App\Http\Controllers\Backend\HrController@manageAgent')->name('manageAgent');
Route::get('/editAgentHiring/{id}', 'App\Http\Controllers\Backend\HrController@editAgentHiring')->name('editAgentHiring');
Route::post('/updateAgentInfo/{id}', 'App\Http\Controllers\Backend\HrController@updateAgentInfo')->name('updateAgentInfo');
Route::get('/deleteAgentData/{id}', 'App\Http\Controllers\Backend\HrController@deleteAgentData')->name('deleteAgentData');

//department
Route::get('/viewDepartment', 'App\Http\Controllers\Backend\HrController@viewDepartment')->name('viewDepartment');
Route::get('/addDepartment', 'App\Http\Controllers\Backend\HrController@addDepartment')->name('addDepartment');
Route::post('/storeDeptData', 'App\Http\Controllers\Backend\HrController@storeDeptData')->name('storeDeptData');
Route::get('/editDepartment/{id}', 'App\Http\Controllers\Backend\HrController@editDepartment')->name('editDepartment');
Route::post('/updateDepartment/{id}', 'App\Http\Controllers\Backend\HrController@updateDepartment')->name('updateDepartment');
Route::get('/deleteDept/{id}', 'App\Http\Controllers\Backend\HrController@deleteDept')->name('deleteDept');

//end department

//designation
Route::get('/viewDesignation', 'App\Http\Controllers\Backend\HrController@viewDesignation')->name('viewDesignation');
Route::get('/addDesignation', 'App\Http\Controllers\Backend\HrController@addDesignation')->name('addDesignation');
Route::post('/storeDesgData', 'App\Http\Controllers\Backend\HrController@storeDesgData')->name('storeDesgtData');
Route::get('/editDesignation/{id}', 'App\Http\Controllers\Backend\HrController@editDesignation')->name('editDesignation');
Route::post('/updateDesignation/{id}', 'App\Http\Controllers\Backend\HrController@updateDesignation')->name('updateDesignation');

Route::get('/deleteDesg/{id}', 'App\Http\Controllers\Backend\HrController@deleteDesg')->name('deleteDesg');
Route::get('/getEmpDesig', 'App\Http\Controllers\Backend\HrController@getEmpDesig')->name('getEmpDesig');

Route::post('/getDesigName', 'App\Http\Controllers\Backend\EmployeeController@getDesigName')->name('/getDesigName');
Route::post('/getEmployeeId', 'App\Http\Controllers\Backend\EmployeeController@getEmployeeId')->name('/getEmployeeId');

Route::post('/getDesigName1', 'App\Http\Controllers\Backend\EmployeeController@getDesigName')->name('/getDesigName1');
Route::post('/getEmployeeId1', 'App\Http\Controllers\Backend\EmployeeController@getEmployeeId')->name('/getEmployeeId1');

Route::post('/getDesigName2', 'App\Http\Controllers\Backend\EmployeeController@getDesigName')->name('/getDesigName2');
Route::post('/getEmployeeId2', 'App\Http\Controllers\Backend\EmployeeController@getEmployeeId')->name('/getEmployeeId2');

Route::post('/getDesigName3', 'App\Http\Controllers\Backend\HRController@getDesigName')->name('/getDesigName3');

Route::post('/getDesigName4', 'App\Http\Controllers\Backend\EmployeeController@getDesigName')->name('/getDesigName4');
Route::post('/getEmployeeId4', 'App\Http\Controllers\Backend\EmployeeController@getEmployeeId')->name('/getEmployeeId4');
Route::get('designations-by-dept/{id}', 'App\Http\Controllers\Backend\GlobalController@getDesignationByDepartment')->name('designations-by-dept');
Route::get('branch-by-bank/{id}', 'App\Http\Controllers\Backend\GlobalController@getBranchByBankj')->name('branch-by-bank');
//end designation

Route::get('/allEmployee', 'App\Http\Controllers\Backend\HrController@allEmployee')->name('allEmployee');
Route::get('/addEmployee', 'App\Http\Controllers\Backend\HrController@addEmployee')->name('addEmployee');
Route::post('/storeEmployee', 'App\Http\Controllers\Backend\HrController@storeEmployee')->name('storeEmployee');
Route::get('/editEmployee/{id}', 'App\Http\Controllers\Backend\HrController@editEmployee')->name('editEmployee');
Route::post('/updateEmployee/{id}', 'App\Http\Controllers\Backend\HrController@updateEmployee')->name('updateEmployee');
Route::get('/deleteEmployee/{id}', 'App\Http\Controllers\Backend\HrController@deleteEmployee')->name('deleteEmployee');




Route::get('/manageLeave', 'App\Http\Controllers\Backend\HrController@manageLeave')->name('manageLeave');
Route::get('/addLeave', 'App\Http\Controllers\Backend\HrController@addLeave')->name('addLeave');
Route::post('/storeLeave', 'App\Http\Controllers\Backend\HrController@storeLeave')->name('storeLeave');
Route::get('/editLeave/{id}', 'App\Http\Controllers\Backend\HrController@editLeave')->name('editLeave');
Route::get('/deleteLeave/{id}', 'App\Http\Controllers\Backend\HrController@deleteLeave')->name('deleteLeave');
Route::post('/updateLeave/{id}', 'App\Http\Controllers\Backend\HrController@updateLeave')->name('updateLeave');



Route::get('/manageSalary', 'App\Http\Controllers\Backend\HrController@manageSalary')->name('manageSalary');
Route::get('/SalarySheet', 'App\Http\Controllers\Backend\HrController@SalarySheet')->name('SalarySheet');
Route::get('/addSalary', 'App\Http\Controllers\Backend\HrController@addSalary')->name('addSalary');
Route::post('/storeSalary', 'App\Http\Controllers\Backend\HrController@storeSalary')->name('storeSalary');
Route::get('/editSalary/{id}', 'App\Http\Controllers\Backend\HrController@editSalary')->name('editSalary');
Route::post('/updateSalary/{id}', 'App\Http\Controllers\Backend\HrController@updateSalary')->name('updateSalary');
Route::get('/deleteSalary/{id}', 'App\Http\Controllers\Backend\HrController@deleteSalary')->name('deleteSalary');



Route::get('/manageAccounts', 'App\Http\Controllers\Backend\HrController@manageAccounts')->name('manageAccounts');
Route::get('/manageAccountsSorting', 'App\Http\Controllers\Backend\HrController@manageAccountsSorting')->name('manageAccountsSorting');

Route::get('/manageDue', 'App\Http\Controllers\Backend\HrController@manageDue')->name('manageDue');
Route::get('/manageDueSorting', 'App\Http\Controllers\Backend\HrController@manageDueSorting')->name('manageDueSorting');

Route::get('/getStock', 'App\Http\Controllers\Backend\HrController@getStock')->name('getStock');
Route::get('/manageStockSorting', 'App\Http\Controllers\Backend\HrController@manageStockSorting')->name('manageStockSorting');

Route::get('/manageProfit', 'App\Http\Controllers\Backend\HrController@manageProfit')->name('manageProfit');
Route::get('/manageProfitSorting', 'App\Http\Controllers\Backend\HrController@manageProfitSorting')->name('manageProfitSorting');

Route::get('/getStockOut', 'App\Http\Controllers\Backend\HrController@getStockOut')->name('getStockOut');
Route::get('/manageStockOutSorting', 'App\Http\Controllers\Backend\HrController@manageStockOutSorting')->name('manageStockOutSorting');

Route::get('/getServiceExpenses', 'App\Http\Controllers\Backend\HrController@getServiceExpenses')->name('getServiceExpenses');
Route::get('/manageExpensesSorting', 'App\Http\Controllers\Backend\HrController@manageExpensesSorting')->name('manageExpensesSorting');

Route::get('/manageloss', 'App\Http\Controllers\Backend\HrController@manageloss')->name('manageloss');



# Payroll
Route::get('/managePayroll', 'App\Http\Controllers\Backend\HrController@managePayroll')->name('managePayroll');
Route::get('/addPayroll', 'App\Http\Controllers\Backend\HrController@addPayroll')->name('addPayroll');
Route::post('/storePayroll', 'App\Http\Controllers\Backend\HrController@storePayroll')->name('storePayroll');
Route::get('/editPayroll/{id}', 'App\Http\Controllers\Backend\HrController@editPayroll')->name('editPayroll');
Route::post('/updatePayroll/{id}', 'App\Http\Controllers\Backend\HrController@updatePayroll')->name('updatePayroll');
Route::get('/deletePayroll/{id}', 'App\Http\Controllers\Backend\HrController@deletePayroll')->name('deletePayroll');

//attendence
Route::get('/manageAttendance', 'App\Http\Controllers\Backend\EmployeeController@manageAttendance')->name('manageAttendance');
Route::get('/manageAttendanceSorting', 'App\Http\Controllers\Backend\EmployeeController@manageAttendanceSorting')->name('manageAttendanceSorting');

Route::post('/attendanceStoreIn', 'App\Http\Controllers\Backend\EmployeeController@attendanceStoreIn')->name('/attendanceStoreIn');
Route::post('/attendanceStoreOut', 'App\Http\Controllers\Backend\EmployeeController@attendanceStoreOut')->name('/attendanceStoreOut');
Route::get('/deleteAttendance/{id}', 'App\Http\Controllers\Backend\EmployeeController@deleteAttendance')->name('deleteAttendance');
//end attendance

# Absent
Route::get('/manageAbsent', 'App\Http\Controllers\Backend\HrController@manageAbsent')->name('manageAbsent');
Route::get('/addAbsent', 'App\Http\Controllers\Backend\HrController@addAbsent')->name('addAbsent');
Route::post('/storeAbsent', 'App\Http\Controllers\Backend\HrController@storeAbsent')->name('storeAbsent');
Route::get('/editAbsent/{id}', 'App\Http\Controllers\Backend\HrController@editAbsent')->name('editAbsent');
Route::post('/updateAbsent/{id}', 'App\Http\Controllers\Backend\HrController@updateAbsent')->name('updateAbsent');
Route::get('/deleteAbsent/{id}', 'App\Http\Controllers\Backend\HrController@deleteAbsent')->name('deleteAbsent');

//shift
Route::get('/manageShift', 'App\Http\Controllers\backend\EmployeeController@manageShift')->name('manageShift');
Route::post('/shiftManageStore', 'App\Http\Controllers\backend\EmployeeController@shiftManageStore')->name('/shiftManageStore');
Route::get('/DeleteShift/{id}', 'App\Http\Controllers\backend\EmployeeController@DeleteShift')->name('/DeleteShift');
Route::post('/updateShift/{id}', 'App\Http\Controllers\backend\EmployeeController@updateShift')->name('/updateShift');
Route::get('/editShift/{id}', 'App\Http\Controllers\backend\EmployeeController@editShift')->name('/editShift');
//end shift

# LateRoll
Route::get('/manageLateRoll', 'App\Http\Controllers\Backend\HrController@manageLateRoll')->name('manageLateRoll');
Route::get('/addLateRoll', 'App\Http\Controllers\Backend\HrController@addLateRoll')->name('addLateRoll');
Route::post('/storeLateRoll', 'App\Http\Controllers\Backend\HrController@storeLateRoll')->name('storeLateRoll');
Route::get('/editLateRoll/{id}', 'App\Http\Controllers\Backend\HrController@editLateRoll')->name('editLateRoll');
Route::post('/updateLateRoll/{id}', 'App\Http\Controllers\Backend\HrController@updateLateRoll')->name('updateLateRoll');
Route::get('/deleteLateRoll/{id}', 'App\Http\Controllers\Backend\HrController@deleteLateRoll')->name('deleteLateRoll');

# Overtime
Route::get('/manageOvertime', 'App\Http\Controllers\Backend\HrController@manageOvertime')->name('manageOvertime');
Route::get('/addOvertime', 'App\Http\Controllers\Backend\HrController@addOvertime')->name('addOvertime');
Route::post('/storeOvertime', 'App\Http\Controllers\Backend\HrController@storeOvertime')->name('storeOvertime');
Route::get('/editOvertime/{id}', 'App\Http\Controllers\Backend\HrController@editOvertime')->name('editOvertime');
Route::post('/updateOvertime/{id}', 'App\Http\Controllers\Backend\HrController@updateOvertime')->name('updateOvertime');
Route::get('/deleteOvertime/{id}', 'App\Http\Controllers\Backend\HrController@deleteOvertime')->name('deleteOvertime');

//notice
Route::get('/viewNotice', 'App\Http\Controllers\Backend\noticeController@viewNotice')->name('viewNotice');
Route::get('/addNotice', 'App\Http\Controllers\Backend\noticeController@addNotice')->name('addNotice');
Route::post('/storeNotice', 'App\Http\Controllers\Backend\noticeController@storeNotice')->name('storeNotice');
Route::get('/editNotice/{id}', 'App\Http\Controllers\Backend\noticeController@editNotice')->name('editNotice');
Route::post('/updateNotice/{id}', 'App\Http\Controllers\Backend\noticeController@updateNotice')->name('updateNotice');
Route::get('/deleteNotice/{id}', 'App\Http\Controllers\backend\noticeController@deleteNotice')->name('deleteNotice');

Route::get('/updateNoticeStatus/{id}', 'App\Http\Controllers\backend\noticeController@updateNoticeStatus')->name('updateNoticeStatus');
//end notice

# Paymnet Range
Route::get('/managePaymentRange', 'App\Http\Controllers\Backend\HrController@managePaymentRange')->name('managePaymentRange');
Route::post('/storePaymentRange', 'App\Http\Controllers\Backend\HrController@storePaymentRange')->name('storePaymentRange');
Route::get('/deletePaymentRange/{id}', 'App\Http\Controllers\Backend\HrController@deletePaymentRange')->name('deletePaymentRange');
Route::post('/updatePaymentRange/{id}', 'App\Http\Controllers\Backend\HrController@updatePaymentRange')->name('updatePaymentRange');


# Purchase
Route::get('/managePurchase', 'App\Http\Controllers\Backend\HrController@managePurchase')->name('managePurchase');
Route::get('/tempPurchase', 'App\Http\Controllers\Backend\HrController@tempPurchase')->name('tempPurchase');
Route::get('/addPurchase', 'App\Http\Controllers\Backend\HrController@addPurchase')->name('addPurchase');
Route::post('/storePurchase', 'App\Http\Controllers\Backend\HrController@storePurchase')->name('storePurchase');
Route::get('/viewPurchase/{id}', 'App\Http\Controllers\Backend\HrController@showPurchase')->name('viewPurchase');
Route::get('/editPurchase/{id}', 'App\Http\Controllers\Backend\HrController@editPurchase')->name('editPurchase');
Route::post('/updatePurchase/{id}', 'App\Http\Controllers\Backend\HrController@updatePurchase')->name('updatePurchase');
Route::get('/deletePurchase/{id}', 'App\Http\Controllers\Backend\HrController@deletePurchase')->name('deletePurchase');

# Size
Route::get('/manageSize', 'App\Http\Controllers\Backend\HrController@manageSize')->name('manageSize');
Route::post('/storeSize', 'App\Http\Controllers\Backend\HrController@storeSize')->name('storeSize');
Route::get('/deleteSize/{id}', 'App\Http\Controllers\Backend\HrController@deleteSize')->name('deleteSize');
Route::post('/updateSize/{id}', 'App\Http\Controllers\Backend\HrController@updateSize')->name('updateSize');

# Color
Route::get('/manageColor', 'App\Http\Controllers\Backend\HrController@manageColor')->name('manageColor');
Route::post('/storeColor', 'App\Http\Controllers\Backend\HrController@storeColor')->name('storeColor');
Route::get('/deleteColor/{id}', 'App\Http\Controllers\Backend\HrController@deleteColor')->name('deleteColor');
Route::post('/updateColor/{id}', 'App\Http\Controllers\Backend\HrController@updateColor')->name('updateColor');

# Brand
Route::get('/manageBrand', 'App\Http\Controllers\Backend\HrController@manageBrand')->name('manageBrand');
Route::post('/storeBrand', 'App\Http\Controllers\Backend\HrController@storeBrand')->name('storeBrand');
Route::get('/deleteBrand/{id}', 'App\Http\Controllers\Backend\HrController@deleteBrand')->name('deleteBrand');
Route::post('/updateBrand/{id}', 'App\Http\Controllers\Backend\HrController@updateBrand')->name('updateBrand');

# Category
Route::get('/manageCategory', 'App\Http\Controllers\Backend\HrController@manageCategory')->name('manageCategory');
Route::post('/storeCategory', 'App\Http\Controllers\Backend\HrController@storeCategory')->name('storeCategory');
Route::get('/deleteCategory/{id}', 'App\Http\Controllers\Backend\HrController@deleteCategory')->name('deleteCategory');
Route::post('/updateCategory/{id}', 'App\Http\Controllers\Backend\HrController@updateCategory')->name('updateCategory');

# Bank
Route::get('/manageBank', 'App\Http\Controllers\Backend\HrController@manageBank')->name('manageBank');
Route::post('/storeBank', 'App\Http\Controllers\Backend\HrController@storeBank')->name('storeBank');
Route::get('/deleteBank/{id}', 'App\Http\Controllers\Backend\HrController@deleteBank')->name('deleteBank');
Route::post('/updateBank/{id}', 'App\Http\Controllers\Backend\HrController@updateBank')->name('updateBank');

# Branch
Route::get('/manageBranch', 'App\Http\Controllers\Backend\HrController@manageBranch')->name('manageBranch');
Route::post('/storeBranch', 'App\Http\Controllers\Backend\HrController@storeBranch')->name('storeBranch');
Route::get('/deleteBranch/{id}', 'App\Http\Controllers\Backend\HrController@deleteBranch')->name('deleteBranch');
Route::post('/updateBranch/{id}', 'App\Http\Controllers\Backend\HrController@updateBranch')->name('updateBranch');

# Internet Bank
Route::get('/manageInternetBank', 'App\Http\Controllers\Backend\HrController@manageInternetBank')->name('manageInternetBank');
Route::post('/storeInternetBank', 'App\Http\Controllers\Backend\HrController@storeInternetBank')->name('storeInternetBank');
Route::get('/deleteInternetBank/{id}', 'App\Http\Controllers\Backend\HrController@deleteInternetBank')->name('deleteInternetBank');
Route::post('/updateInternetBank/{id}', 'App\Http\Controllers\Backend\HrController@updateInternetBank')->name('updateInternetBank');

# Mobile Bank
Route::get('/manageMobileBank', 'App\Http\Controllers\Backend\HrController@manageMobileBank')->name('manageMobileBank');
Route::post('/storeMobileBank', 'App\Http\Controllers\Backend\HrController@storeMobileBank')->name('storeMobileBank');
Route::get('/deleteMobileBank/{id}', 'App\Http\Controllers\Backend\HrController@deleteMobileBank')->name('deleteMobileBank');
Route::post('/updateMobileBank/{id}', 'App\Http\Controllers\Backend\HrController@updateMobileBank')->name('updateMobileBank');
