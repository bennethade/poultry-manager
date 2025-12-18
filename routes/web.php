<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\FarmDailyCareController;
use App\Http\Controllers\FarmRecordsController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'authLogin'])->name('authLogin');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/forgot-password', [AuthController::class, 'postForgotPassword'])->name('post.forgot-password');
Route::get('/reset/{token}', [AuthController::class, 'reset'])->name('reset');
Route::post('/reset/{token}', [AuthController::class, 'postReset'])->name('postReset');




//===COMMON ROUTE GROUP===///
Route::group(['middleware' => 'common'], function(){
    Route::get('/under_development', [DashboardController::class,'underDevelopment'])->name('under_development');



});




//===ADMIN ROUTE GROUP===///
Route::group(['middleware' => 'admin'], function(){


    Route::get('/admin/dashboard', [DashboardController::class,'dashboard'])->name('admin.dashboard');


    Route::get('/admin/comment_bank', [DashboardController::class,'commentBank'])->name('admin.comment_bank');


    Route::get('/admin/admin/list', [AdminController::class,'list'])->name('admin.list');
    Route::get('/admin/admin/add', [AdminController::class,'add'])->name('admin.add');
    Route::post('/admin/admin/add', [AdminController::class,'insert'])->name('admin.insert');
    Route::get('/admin/admin/edit/{id}', [AdminController::class,'edit'])->name('admin.edit');
    Route::post('/admin/admin/edit/{id}', [AdminController::class,'update'])->name('admin.update');
    Route::delete('/admin/admin/delete/{id}', [AdminController::class,'delete'])->name('admin.delete');




    //DESIGNATION ROUTES
    Route::get('/admin/designation/list', [AdminController::class,'designationList'])->name('designation.list');
    Route::get('/admin/designation/add', [AdminController::class,'designationAdd'])->name('designation.add');
    Route::post('/admin/designation/insert', [AdminController::class,'designationInsert'])->name('designation.insert');
    Route::get('/admin/designation/edit/{id}', [AdminController::class,'designationEdit'])->name('designation.edit');
    Route::post('/admin/designation/edit/{id}', [AdminController::class,'designationUpdate'])->name('designation.update');
    Route::delete('/admin/designation/delete/{id}', [AdminController::class,'designationDelete'])->name('designation.delete');




    //MY ACCOUNT
    Route::get('/admin/account', [UserController::class,'myAccount'])->name('admin.account');
    Route::post('/admin/account', [UserController::class,'updateMyAdminAccount'])->name('update.admin.account');

    Route::get('/admin/setting', [UserController::class,'setting'])->name('admin.setting');
    Route::post('/admin/setting', [UserController::class,'updateSetting'])->name('admin.setting.update');



    //CHANGE PASSWORD
    Route::get('/admin/change_password', [UserController::class,'changePassword'])->name('change_password');
    Route::post('/admin/change_password', [UserController::class,'updatePassword'])->name('update_password');
    




    //STAFF ROUTES
    Route::get('/admin/staff/list', [StaffController::class,'list'])->name('staff.list');
    Route::get('/admin/staff/add', [StaffController::class,'add'])->name('staff.add');
    Route::post('/admin/staff/add', [StaffController::class,'insert'])->name('staff.insert');
    Route::get('/admin/staff/edit/{id}', [StaffController::class,'edit'])->name('staff.edit');
    Route::post('/admin/staff/edit/{id}', [StaffController::class,'update'])->name('staff.update');
    Route::delete('/admin/staff/delete/{id}', [StaffController::class,'delete'])->name('staff.delete');

    Route::get('/admin/staff/ajax-search', [StaffController::class, 'ajaxSearch'])->name('staff.ajax.search');






    // FARM RECORD ROUTES
    Route::get('/admin/farm_record/list', [FarmRecordsController::class,'list'])->name('farm_record.list');
    Route::get('/admin/farm_record/add', [FarmRecordsController::class,'add'])->name('farm_record.add');
    Route::post('/admin/farm_record/add', [FarmRecordsController::class,'store'])->name('farm_record.store');
    Route::get('/admin/farm_record/edit/{id}', [FarmRecordsController::class,'edit'])->name('farm_record.edit');
    Route::post('/admin/farm_record/edit/{id}', [FarmRecordsController::class,'update'])->name('farm_record.update');
    Route::delete('/admin/farm_record/delete/{id}', [FarmRecordsController::class,'delete'])->name('farm_record.delete');

    
    //AJAX for Frm Record Search
    Route::get('/admin/farm_record/ajax-search', [FarmRecordsController::class, 'ajaxSearch'])->name('farm_record.ajax.search');





    // FARM DAILY CARE ROUTES
    Route::get('/admin/farm_daily_care/list', [FarmDailyCareController::class,'list'])->name('farm_daily_care.list');
    Route::get('/admin/farm_daily_care/add', [FarmDailyCareController::class,'add'])->name('farm_daily_care.add');
    Route::post('/admin/farm_daily_care/add', [FarmDailyCareController::class,'store'])->name('farm_daily_care.store');
    Route::get('/admin/farm_daily_care/view/{id}', [FarmDailyCareController::class,'view'])->name('farm_daily_care.view');
    Route::get('/admin/farm_daily_care/edit/{id}', [FarmDailyCareController::class,'edit'])->name('farm_daily_care.edit');
    Route::post('/admin/farm_daily_care/edit/{id}', [FarmDailyCareController::class,'update'])->name('farm_daily_care.update');
    Route::delete('/admin/farm_daily_care/delete/{id}', [FarmDailyCareController::class,'delete'])->name('farm_daily_care.delete');

    
    //AJAX for Farm Record Search
    Route::get('/admin/farm_daily_care/ajax-search', [FarmDailyCareController::class, 'ajaxSearch'])->name('farm_daily_care.ajax.search');





    // EXPENSES ROUTES
    Route::get('/admin/expenses/list', [ExpensesController::class,'list'])->name('expenses.list');
    Route::get('/admin/expenses/add', [ExpensesController::class,'add'])->name('expenses.add');
    Route::post('/admin/expenses/add', [ExpensesController::class,'store'])->name('expenses.store');
    Route::get('/admin/expenses/view/{id}', [ExpensesController::class,'view'])->name('expenses.view');
    Route::get('/admin/expenses/edit/{id}', [ExpensesController::class,'edit'])->name('expenses.edit');
    Route::post('/admin/expenses/edit/{id}', [ExpensesController::class,'update'])->name('expenses.update');
    Route::delete('/admin/expenses/delete/{id}', [ExpensesController::class,'delete'])->name('expenses.delete');

    //AJAX for Expense Record Search
    Route::get('/admin/expenses/ajax-search', [ExpensesController::class, 'ajaxSearch'])->name('expenses.ajax.search');





    // SALES ROUTES
    Route::get('/admin/sales/list', [SalesController::class,'list'])->name('sales.list');
    Route::get('/admin/sales/add', [SalesController::class,'add'])->name('sales.add');
    Route::post('/admin/sales/add', [SalesController::class,'store'])->name('sales.store');
    Route::get('/admin/sales/view/{id}', [SalesController::class,'view'])->name('sales.view');
    Route::get('/admin/sales/edit/{id}', [SalesController::class,'edit'])->name('sales.edit');
    Route::post('/admin/sales/edit/{id}', [SalesController::class,'update'])->name('sales.update');
    Route::delete('/admin/sales/delete/{id}', [SalesController::class,'delete'])->name('sales.delete');

    //AJAX for Expense Record Search
    Route::get('/admin/sales/ajax-search', [SalesController::class, 'ajaxSearch'])->name('sales.ajax.search');
    
    
    
    
    
    // MISCELLANEOUS RECORD ROUTES
    Route::get('/admin/miscellaneous/list', [MiscellaneousController::class,'list'])->name('miscellaneous.list');
    Route::get('/admin/miscellaneous/add', [MiscellaneousController::class,'add'])->name('miscellaneous.add');
    Route::post('/admin/miscellaneous/add', [MiscellaneousController::class,'store'])->name('miscellaneous.store');
    // Route::get('/admin/miscellaneous/view/{id}', [MiscellaneousController::class,'view'])->name('miscellaneous.view');
    Route::get('/admin/miscellaneous/edit/{id}', [MiscellaneousController::class,'edit'])->name('miscellaneous.edit');
    Route::post('/admin/miscellaneous/edit/{id}', [MiscellaneousController::class,'update'])->name('miscellaneous.update');
    Route::delete('/admin/miscellaneous/delete/{id}', [MiscellaneousController::class,'delete'])->name('miscellaneous.delete');

    //AJAX for Expense Record Search
    Route::get('/admin/miscellaneous/ajax-search', [MiscellaneousController::class, 'ajaxSearch'])->name('miscellaneous.ajax.search');





    // REPORTS ROUTES
    Route::get('/admin/report/list', [ReportController::class,'list'])->name('report.list');
    // Route::get('/admin/miscellaneous/view/{id}', [MiscellaneousController::class,'view'])->name('miscellaneous.view');
    





  


    






    



});
//===ADMIN ROUTE GROUP END===///















//===staff DASHBOARD ROUTE GROUP===///
Route::group(['middleware' => 'staff'], function(){

    Route::get('/staff/dashboard', [DashboardController::class,'dashboard'])->name('staff.dashboard');
    
    Route::get('/staff/change_password', [UserController::class,'changePassword'])->name('change_password');
    Route::post('/staff/change_password', [UserController::class,'updatePassword'])->name('update_password');


    Route::get('/staff/account', [UserController::class,'myAccount'])->name('staff.account');
    Route::post('/staff/account', [UserController::class,'updateMyAccount'])->name('update.staff.account');




    // FARM RECORD ROUTES
    Route::get('/staff/farm_record/list', [FarmRecordsController::class,'list'])->name('staff.farm_record.list');
    Route::get('/staff/farm_record/add', [FarmRecordsController::class,'add'])->name('staff.farm_record.add');
    Route::post('/staff/farm_record/add', [FarmRecordsController::class,'store'])->name('staff.farm_record.store');

    
    //AJAX for Frm Record Search
    Route::get('/staff/farm_record/ajax-search', [FarmRecordsController::class, 'ajaxSearch'])->name('staff.farm_record.ajax.search');





    // FARM DAILY CARE ROUTES
    Route::get('/staff/farm_daily_care/list', [FarmDailyCareController::class,'list'])->name('staff.farm_daily_care.list');
    Route::get('/staff/farm_daily_care/add', [FarmDailyCareController::class,'add'])->name('staff.farm_daily_care.add');
    Route::post('/staff/farm_daily_care/add', [FarmDailyCareController::class,'store'])->name('staff.farm_daily_care.store');
    Route::get('/staff/farm_daily_care/view/{id}', [FarmDailyCareController::class,'view'])->name('staff.farm_daily_care.view');
    
    
    //AJAX for Farm Record Search
    Route::get('/staff/farm_daily_care/ajax-search', [FarmDailyCareController::class, 'ajaxSearch'])->name('staff.farm_daily_care.ajax.search');





    // EXPENSES ROUTES
    Route::get('/staff/expenses/list', [ExpensesController::class,'list'])->name('staff.expenses.list');
    Route::get('/staff/expenses/add', [ExpensesController::class,'add'])->name('staff.expenses.add');
    Route::post('/staff/expenses/add', [ExpensesController::class,'store'])->name('staff.expenses.store');
    Route::get('/staff/expenses/view/{id}', [ExpensesController::class,'view'])->name('staff.expenses.view');
    
    //AJAX for Expense Record Search
    Route::get('/staff/expenses/ajax-search', [ExpensesController::class, 'ajaxSearch'])->name('staff.expenses.ajax.search');




    // SALES ROUTES
    Route::get('/staff/sales/list', [SalesController::class,'list'])->name('staff.sales.list');
    Route::get('/staff/sales/add', [SalesController::class,'add'])->name('staff.sales.add');
    Route::post('/staff/sales/add', [SalesController::class,'store'])->name('staff.sales.store');
    Route::get('/staff/sales/view/{id}', [SalesController::class,'view'])->name('staff.sales.view');
   
    //AJAX for Expense Record Search
    Route::get('/staff/sales/ajax-search', [SalesController::class, 'ajaxSearch'])->name('staff.sales.ajax.search');
    
    




    // MISCELLANEOUS RECORD ROUTES
    Route::get('/staff/miscellaneous/list', [MiscellaneousController::class,'list'])->name('staff.miscellaneous.list');
    Route::get('/staff/miscellaneous/add', [MiscellaneousController::class,'add'])->name('staff.miscellaneous.add');
    Route::post('/staff/miscellaneous/add', [MiscellaneousController::class,'store'])->name('staff.miscellaneous.store');
    
    //AJAX for Expense Record Search
    Route::get('/staff/miscellaneous/ajax-search', [MiscellaneousController::class, 'ajaxSearch'])->name('staff.miscellaneous.ajax.search');















    
});
//===staff ROUTE GROUP END===///








