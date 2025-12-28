<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnimalRecordController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiseaseTreatmentController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\FarmDailyCareController;
use App\Http\Controllers\FarmRecordsController;
use App\Http\Controllers\FeedRecordController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\PigController;
use App\Http\Controllers\RecordController;
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





    // // FARM DAILY CARE ROUTES
    // Route::get('/admin/farm_daily_care/list', [FarmDailyCareController::class,'list'])->name('farm_daily_care.list');
    // Route::get('/admin/farm_daily_care/add', [FarmDailyCareController::class,'add'])->name('farm_daily_care.add');
    // Route::post('/admin/farm_daily_care/add', [FarmDailyCareController::class,'store'])->name('farm_daily_care.store');
    // Route::get('/admin/farm_daily_care/view/{id}', [FarmDailyCareController::class,'view'])->name('farm_daily_care.view');
    // Route::get('/admin/farm_daily_care/edit/{id}', [FarmDailyCareController::class,'edit'])->name('farm_daily_care.edit');
    // Route::post('/admin/farm_daily_care/edit/{id}', [FarmDailyCareController::class,'update'])->name('farm_daily_care.update');
    // Route::delete('/admin/farm_daily_care/delete/{id}', [FarmDailyCareController::class,'delete'])->name('farm_daily_care.delete');

    
    // //AJAX for Farm Record Search
    // Route::get('/admin/farm_daily_care/ajax-search', [FarmDailyCareController::class, 'ajaxSearch'])->name('farm_daily_care.ajax.search');





    // EXPENSES ROUTES
    // Route::get('/admin/expenses/list', [ExpensesController::class,'list'])->name('expenses.list');
    // Route::get('/admin/expenses/add', [ExpensesController::class,'add'])->name('expenses.add');
    // Route::post('/admin/expenses/add', [ExpensesController::class,'store'])->name('expenses.store');
    // Route::get('/admin/expenses/view/{id}', [ExpensesController::class,'view'])->name('expenses.view');
    // Route::get('/admin/expenses/edit/{id}', [ExpensesController::class,'edit'])->name('expenses.edit');
    // Route::post('/admin/expenses/edit/{id}', [ExpensesController::class,'update'])->name('expenses.update');
    // Route::delete('/admin/expenses/delete/{id}', [ExpensesController::class,'delete'])->name('expenses.delete');

    //AJAX for Expense Record Search
    // Route::get('/admin/expenses/ajax-search', [ExpensesController::class, 'ajaxSearch'])->name('expenses.ajax.search');



    // SALES ROUTES
    // Route::get('/admin/sales/list', [SalesController::class,'list'])->name('sales.list');
    // Route::get('/admin/sales/add', [SalesController::class,'add'])->name('sales.add');
    // Route::post('/admin/sales/add', [SalesController::class,'store'])->name('sales.store');
    // Route::get('/admin/sales/view/{id}', [SalesController::class,'view'])->name('sales.view');
    // Route::get('/admin/sales/edit/{id}', [SalesController::class,'edit'])->name('sales.edit');
    // Route::post('/admin/sales/edit/{id}', [SalesController::class,'update'])->name('sales.update');
    // Route::delete('/admin/sales/delete/{id}', [SalesController::class,'delete'])->name('sales.delete');

    // //AJAX for Expense Record Search
    // Route::get('/admin/sales/ajax-search', [SalesController::class, 'ajaxSearch'])->name('sales.ajax.search');
    
    
    
    
    
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


    //VIEW RECORDS
    Route::get('/admin/view_records/list', [RecordController::class, 'index'])->name('records.view');




    
    
    // ######========NEW UPDATES STARTED HERE =========########



    // ANINAL RECORD ROUTES

    //Animal Identification
    Route::get('/admin/animal_record/animal_identification/list', [AnimalRecordController::class,'list'])->name('animal_identification.list');
    Route::get('/admin/animal_record/animal_identification/add', [AnimalRecordController::class,'add'])->name('animal_identification.add');
    Route::post('/admin/animal_record/animal_identification/add', [AnimalRecordController::class,'store'])->name('animal_identification.store');
    Route::get('/admin/animal_record/animal_identification/view/{id}', [AnimalRecordController::class,'view'])->name('animal_identification.view');
    Route::get('/admin/animal_record/animal_identification/edit/{id}', [AnimalRecordController::class,'edit'])->name('animal_identification.edit');
    Route::post('/admin/animal_record/animal_identification/edit/{id}', [AnimalRecordController::class,'update'])->name('animal_identification.update');
    Route::delete('/admin/animal_record/animal_identification/delete/{id}', [AnimalRecordController::class,'delete'])->name('animal_identification.delete');

    //AJAX for Record Search
    Route::get('/admin/animal_record/animal_identification/ajax-search', [AnimalRecordController::class, 'ajaxSearch'])->name('animal_identification.ajax.search');



    //Breeding Routes
    Route::get('/admin/animal_record/breeding_record/list', [AnimalRecordController::class,'breedList'])->name('breeding_record.list');
    Route::post('/admin/animal_record/breeding_record/add', [AnimalRecordController::class,'breedStore'])->name('breeding_record.store');
    Route::get('/admin/animal_record/breeding_record/edit/{id}', [AnimalRecordController::class,'breedEdit'])->name('breeding_record.edit');
    Route::post('/admin/animal_record/breeding_record/edit/{id}', [AnimalRecordController::class,'breedUpdate'])->name('breeding_record.update');
    Route::delete('/admin/animal_record/breeding_record/delete/{id}', [AnimalRecordController::class,'breedDelete'])->name('breeding_record.delete');

    //AJAX for Record Search
    Route::get('admin/animal_record/breeding_record/search',[AnimalRecordController::class, 'breedingAjaxSearch'])->name('breeding_record.ajax.search');
    
    
    
    
    //Growth Performance Routes
    Route::get('/admin/animal_record/growth_performance/list', [AnimalRecordController::class, 'growthList'])->name('growth_performance.index');
    Route::post('/admin/animal_record/growth_performance/add', [AnimalRecordController::class, 'growthStore'])->name('growth_performance.store');
    Route::get('/admin/animal_record/growth_performance/edit/{id}', [AnimalRecordController::class,'growthEdit'])->name('growth_performance.edit');
    Route::post('/admin/animal_record/growth_performance/edit/{id}', [AnimalRecordController::class,'growthUpdate'])->name('growth_performance.update');
    Route::delete('/admin/animal_record/growth_performance/delete/{id}', [AnimalRecordController::class,'growthDelete'])->name('growth_performance.delete');

    //AJAX
    Route::get('admin/animal_record/growth_performance/{pig_id}', [AnimalRecordController::class, 'loadPigGrowth'])->name('growth_performance.load');






    // FARM RECORD ROUTES

    //Feed Stock Routes 
    Route::get('/admin/feed_record/feed_stock/list', [FeedRecordController::class,'stockList'])->name('feed_stock.list');
    Route::get('/admin/feed_record/feed_stock/add', [FeedRecordController::class,'stockAdd'])->name('feed_stock.add');
    Route::post('/admin/feed_record/feed_stock/add', [FeedRecordController::class,'stockStore'])->name('feed_stock.store');
    // Route::get('/admin/feed_record/feed_stock/view/{id}', [FeedRecordController::class,'stockView'])->name('feed_stock.view');
    Route::get('/admin/feed_record/feed_stock/edit/{id}', [FeedRecordController::class,'stockEdit'])->name('feed_stock.edit');
    Route::post('/admin/feed_record/feed_stock/edit/{id}', [FeedRecordController::class,'stockUpdate'])->name('feed_stock.update');
    Route::delete('/admin/feed_record/feed_stock/delete/{id}', [FeedRecordController::class,'stockDelete'])->name('feed_stock.delete');

    //AJAX for Record Search
    Route::get('/admin/feed_record/feed_stock/ajax-search', [FeedRecordController::class, 'stockAjaxSearch'])->name('feed_stock.ajax.search');

    
    
    
    //Daily Feed Usage Routes 
    Route::get('/admin/feed_record/daily_feed_usage/list', [FeedRecordController::class,'feedUsageList'])->name('daily_feed_usage.list');
    Route::post('/admin/feed_record/daily_feed_usage/add', [FeedRecordController::class,'feedUsageStore'])->name('daily_feed_usage.store');
    Route::get('/admin/feed_record/daily_feed_usage/edit/{id}', [FeedRecordController::class,'feedUsageEdit'])->name('daily_feed_usage.edit');
    Route::post('/admin/feed_record/daily_feed_usage/edit/{id}', [FeedRecordController::class,'feedUsageUpdate'])->name('daily_feed_usage.update');
    Route::delete('/admin/feed_record/daily_feed_usage/delete/{id}', [FeedRecordController::class,'feedUsageDelete'])->name('daily_feed_usage.delete');

    //AJAX for Record Search
    Route::get('/admin/feed_record/daily_feed_usage/ajax-search', [FeedRecordController::class, 'feedUsageAjaxSearch'])->name('daily_feed_usage.ajax.search');




    //Feed Formulation Routes 
    Route::get('/admin/feed_record/feed_formulation/list', [FeedRecordController::class,'formulationList'])->name('feed_formulation.list');
    Route::get('/admin/feed_record/feed_formulation/add', [FeedRecordController::class,'formulationAdd'])->name('feed_formulation.add');
    Route::post('/admin/feed_record/feed_formulation/add', [FeedRecordController::class,'formulationStore'])->name('feed_formulation.store');
    Route::get('/admin/feed_record/feed_formulation/edit/{id}', [FeedRecordController::class,'formulationEdit'])->name('feed_formulation.edit');
    Route::post('/admin/feed_record/feed_formulation/edit/{id}', [FeedRecordController::class,'formulationUpdate'])->name('feed_formulation.update');
    Route::delete('/admin/feed_record/feed_formulation/delete/{id}', [FeedRecordController::class,'formulationDelete'])->name('feed_formulation.delete');

    //AJAX for Record Search
    Route::get('/admin/feed_record/feed_formulation/ajax-search', [FeedRecordController::class, 'formulationAjaxSearch'])->name('feed_formulation.ajax.search');





    
    
    // EXPENSES ROUTES

    // Daily Expense Record
    Route::get('/admin/expense_record/daily_expense/list', [ExpensesController::class,'list'])->name('expenses.list');
    Route::get('/admin/expense_record/daily_expense/add', [ExpensesController::class,'add'])->name('expenses.add');
    Route::post('/admin/expense_record/daily_expense/add', [ExpensesController::class,'store'])->name('expenses.store');
    Route::get('/admin/expense_record/daily_expense/view/{id}', [ExpensesController::class,'view'])->name('expenses.view');
    Route::get('/admin/expense_record/daily_expense/edit/{id}', [ExpensesController::class,'edit'])->name('expenses.edit');
    Route::post('/admin/expense_record/daily_expense/edit/{id}', [ExpensesController::class,'update'])->name('expenses.update');
    Route::delete('/admin/expense_record/daily_expense/delete/{id}', [ExpensesController::class,'delete'])->name('expenses.delete');

    //AJAX for Expense Record Search
    Route::get('/admin/expense_record/daily_expense/ajax-search', [ExpensesController::class, 'ajaxSearch'])->name('expenses.ajax.search');
    
    
    
    // Monthly Expense Record
    Route::get('/admin/expense_record/monthly_expense_summary/list', [ExpensesController::class,'monthlyList'])->name('monthly_expenses.list');
    Route::get('/admin/expense_record/monthly_expense_summary/add', [ExpensesController::class,'monthlyAdd'])->name('monthly_expenses.add');
    Route::post('/admin/expense_record/monthly_expense_summary/add', [ExpensesController::class,'monthlyStore'])->name('monthly_expenses.store');
    // Route::get('/admin/expense_record/monthly_expense_summary/view/{id}', [ExpensesController::class,'monthlyView'])->name('monthly_expenses.view');
    Route::get('/admin/expense_record/monthly_expense_summary/edit/{id}', [ExpensesController::class,'monthlyEdit'])->name('monthly_expenses.edit');
    Route::post('/admin/expense_record/monthly_expense_summary/edit/{id}', [ExpensesController::class,'monthlyUpdate'])->name('monthly_expenses.update');
    Route::delete('/admin/expense_record/monthly_expense_summary/delete/{id}', [ExpensesController::class,'monthlyDelete'])->name('monthly_expenses.delete');

    //AJAX for Expense Record Search
    Route::get('/admin/expense_record/monthly_expense_summary/ajax-search', [ExpensesController::class, 'monthlyAjaxSearch'])->name('monthly_expenses.ajax.search');
    
    
    
    
    
    
    // SALES ROUTES

    // Daily Sales Record
    Route::get('/admin/sales_record/daily_sales/list', [SalesController::class,'list'])->name('sales.list');
    Route::get('/admin/sales_record/daily_sales/add', [SalesController::class,'add'])->name('sales.add');
    Route::post('/admin/sales_record/daily_sales/add', [SalesController::class,'store'])->name('sales.store');
    Route::get('/admin/sales_record/daily_sales/view/{id}', [SalesController::class,'view'])->name('sales.view');
    Route::get('/admin/sales_record/daily_sales/edit/{id}', [SalesController::class,'edit'])->name('sales.edit');
    Route::post('/admin/sales_record/daily_sales/edit/{id}', [SalesController::class,'update'])->name('sales.update');
    Route::delete('/admin/sales_record/daily_sales/delete/{id}', [SalesController::class,'delete'])->name('sales.delete');

    //AJAX for Expense Record Search
    Route::get('/admin/sales_record/daily_sales/ajax-search', [SalesController::class, 'ajaxSearch'])->name('sales.ajax.search');
    

    
    // Monthly Sales Record
    Route::get('/admin/sales_record/monthly_sales_summary/list', [SalesController::class,'monthlyList'])->name('monthly_sales.list');
    Route::get('/admin/sales_record/monthly_sales_summary/add', [SalesController::class,'monthlyAdd'])->name('monthly_sales.add');
    Route::post('/admin/sales_record/monthly_sales_summary/add', [SalesController::class,'monthlyStore'])->name('monthly_sales.store');
    Route::get('/admin/sales_record/monthly_sales_summary/edit/{id}', [SalesController::class,'monthlyEdit'])->name('monthly_sales.edit');
    Route::post('/admin/sales_record/monthly_sales_summary/edit/{id}', [SalesController::class,'monthlyUpdate'])->name('monthly_sales.update');
    Route::delete('/admin/sales_record/monthly_sales_summary/delete/{id}', [SalesController::class,'monthlyDelete'])->name('monthly_sales.delete');

    //AJAX for sales Record Search
    Route::get('/admin/sales_record/monthly_sales_summary/ajax-search', [SalesController::class, 'monthlyAjaxSearch'])->name('monthly_sales.ajax.search');





    //====== GENERAL FARM ACTIVITY ROUTES=====

    //Daily Farm Activities 
    Route::get('/admin/general_farm_activity/farm_daily_care/list', [FarmDailyCareController::class,'list'])->name('farm_daily_care.list');
    Route::get('/admin/general_farm_activity/farm_daily_care/add', [FarmDailyCareController::class,'add'])->name('farm_daily_care.add');
    Route::post('/admin/general_farm_activity/farm_daily_care/add', [FarmDailyCareController::class,'store'])->name('farm_daily_care.store');
    Route::get('/admin/general_farm_activity/farm_daily_care/view/{id}', [FarmDailyCareController::class,'view'])->name('farm_daily_care.view');
    Route::get('/admin/general_farm_activity/farm_daily_care/edit/{id}', [FarmDailyCareController::class,'edit'])->name('farm_daily_care.edit');
    Route::post('/admin/general_farm_activity/farm_daily_care/edit/{id}', [FarmDailyCareController::class,'update'])->name('farm_daily_care.update');
    Route::delete('/admin/general_farm_activity/farm_daily_care/delete/{id}', [FarmDailyCareController::class,'delete'])->name('farm_daily_care.delete');

    //AJAX for Daily Avtivity Record Search
    Route::get('/admin/general_farm_activity/farm_daily_care/ajax-search', [FarmDailyCareController::class, 'ajaxSearch'])->name('farm_daily_care.ajax.search');
    
    


    //Maintenance & Sanitation 
    Route::get('/admin/general_farm_activity/maintenance_sanitation/list', [FarmDailyCareController::class,'maintenanceList'])->name('maintenance_sanitation.list');
    // Route::get('/admin/general_farm_activity/maintenance_sanitation/add', [FarmDailyCareController::class,'maintenanceAdd'])->name('maintenance_sanitation.add');
    Route::post('/admin/general_farm_activity/maintenance_sanitation/add', [FarmDailyCareController::class,'maintenanceStore'])->name('maintenance_sanitation.store');
    Route::get('/admin/general_farm_activity/maintenance_sanitation/view/{id}', [FarmDailyCareController::class,'maintenanceView'])->name('maintenance_sanitation.view');
    Route::get('/admin/general_farm_activity/maintenance_sanitation/edit/{id}', [FarmDailyCareController::class,'maintenanceEdit'])->name('maintenance_sanitation.edit');
    Route::post('/admin/general_farm_activity/maintenance_sanitation/edit/{id}', [FarmDailyCareController::class,'maintenanceUpdate'])->name('maintenance_sanitation.update');
    Route::delete('/admin/general_farm_activity/maintenance_sanitation/delete/{id}', [FarmDailyCareController::class,'maintenanceDelete'])->name('maintenance_sanitation.delete');

    //AJAX for Daily Avtivity Record Search
    Route::get('/admin/general_farm_activity/maintenance_sanitation/ajax-search', [FarmDailyCareController::class, 'maintenanceAjaxSearch'])->name('maintenance_sanitation.ajax.search');




    
    
    //DISEASE & TREATMENT ROUTES
    
    //Disease Incidence Routes
    Route::get('/admin/disease_treatment/disease_incidence/list', [DiseaseTreatmentController::class,'incidenceList'])->name('disease_incidence.list');
    Route::get('/admin/disease_treatment/disease_incidence/add', [DiseaseTreatmentController::class,'incidenceAdd'])->name('disease_incidence.add');
    Route::post('/admin/disease_treatment/disease_incidence/add', [DiseaseTreatmentController::class,'incidenceStore'])->name('disease_incidence.store');
    Route::get('/admin/disease_treatment/disease_incidence/view/{id}', [DiseaseTreatmentController::class,'incidenceView'])->name('disease_incidence.view');
    Route::get('/admin/disease_treatment/disease_incidence/edit/{id}', [DiseaseTreatmentController::class,'incidenceEdit'])->name('disease_incidence.edit');
    Route::post('/admin/disease_treatment/disease_incidence/edit/{id}', [DiseaseTreatmentController::class,'incidenceUpdate'])->name('disease_incidence.update');
    Route::delete('/admin/disease_treatment/disease_incidence/delete/{id}', [DiseaseTreatmentController::class,'incidenceDelete'])->name('disease_incidence.delete');

    //AJAX for Daily Avtivity Record Search
    Route::get('/admin/disease_treatment/disease_incidence/ajax-search', [DiseaseTreatmentController::class, 'incidenceAjaxSearch'])->name('disease_incidence.ajax.search');




    //Medication & Treatment Routes
    Route::get('/admin/disease_treatment/medication_treatment/list', [DiseaseTreatmentController::class,'medicationList'])->name('medication_treatment.list');
    Route::get('/admin/disease_treatment/medication_treatment/add', [DiseaseTreatmentController::class,'medicationAdd'])->name('medication_treatment.add');
    Route::post('/admin/disease_treatment/medication_treatment/add', [DiseaseTreatmentController::class,'medicationStore'])->name('medication_treatment.store');
    Route::get('/admin/disease_treatment/medication_treatment/view/{id}', [DiseaseTreatmentController::class,'medicationView'])->name('medication_treatment.view');
    Route::get('/admin/disease_treatment/medication_treatment/edit/{id}', [DiseaseTreatmentController::class,'medicationEdit'])->name('medication_treatment.edit');
    Route::post('/admin/disease_treatment/medication_treatment/edit/{id}', [DiseaseTreatmentController::class,'medicationUpdate'])->name('medication_treatment.update');
    Route::delete('/admin/disease_treatment/medication_treatment/delete/{id}', [DiseaseTreatmentController::class,'medicationDelete'])->name('medication_treatment.delete');

    //AJAX for Daily Avtivity Record Search
    Route::get('/admin/disease_treatment/medication_treatment/ajax-search', [DiseaseTreatmentController::class, 'medicationAjaxSearch'])->name('medication_treatment.ajax.search');









  


    






    



});
//===ADMIN ROUTE GROUP END===///















//===STAFF DASHBOARD ROUTE GROUP===///
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








