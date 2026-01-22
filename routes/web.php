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
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\PigController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccineController;
use App\Http\Controllers\WeeklyRecordController;
use Illuminate\Support\Facades\Route;


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
    // Route::get('/admin/farm_record/list', [FarmRecordsController::class,'list'])->name('farm_record.list');
    // Route::get('/admin/farm_record/add', [FarmRecordsController::class,'add'])->name('farm_record.add');
    // Route::post('/admin/farm_record/add', [FarmRecordsController::class,'store'])->name('farm_record.store');
    // Route::get('/admin/farm_record/edit/{id}', [FarmRecordsController::class,'edit'])->name('farm_record.edit');
    // Route::post('/admin/farm_record/edit/{id}', [FarmRecordsController::class,'update'])->name('farm_record.update');
    // Route::delete('/admin/farm_record/delete/{id}', [FarmRecordsController::class,'delete'])->name('farm_record.delete');

    
    //AJAX for Frm Record Search
    // Route::get('/admin/farm_record/ajax-search', [FarmRecordsController::class, 'ajaxSearch'])->name('farm_record.ajax.search');
    
    
    
    // MISCELLANEOUS RECORD ROUTES
    Route::get('/admin/inventory/miscellaneous/list', [MiscellaneousController::class,'list'])->name('miscellaneous.list');
    Route::get('/admin/inventory/miscellaneous/add', [MiscellaneousController::class,'add'])->name('miscellaneous.add');
    Route::post('/admin/inventory/miscellaneous/add', [MiscellaneousController::class,'store'])->name('miscellaneous.store');
    Route::get('/admin/inventory/miscellaneous/view/{id}', [MiscellaneousController::class,'view'])->name('miscellaneous.view');
    Route::get('/admin/inventory/miscellaneous/edit/{id}', [MiscellaneousController::class,'edit'])->name('miscellaneous.edit');
    Route::post('/admin/inventory/miscellaneous/edit/{id}', [MiscellaneousController::class,'update'])->name('miscellaneous.update');
    Route::delete('/admin/inventory/miscellaneous/delete/{id}', [MiscellaneousController::class,'delete'])->name('miscellaneous.delete');

    // AJAX for Expense Record Search
    Route::get('/admin/inventory/miscellaneous/ajax-search', [MiscellaneousController::class, 'ajaxSearch'])->name('miscellaneous.ajax.search');



    // REPORTS ROUTES
    Route::get('/admin/report/list', [ReportController::class,'list'])->name('report.list');


    //VIEW RECORDS FOR 7 DAYS
    Route::get('/admin/weekly_records/view', [WeeklyRecordController::class,'view'])->name('weekly_records.view');
    //VIEW RECORDS FOR 7 DAYS
    



    
    
    // ######========NEW UPDATES STARTED HERE =========########


    // ANINAL RECORD ROUTES

    //Animal Identification
    Route::get('/admin/animal_record/animal_identification/list', [AnimalRecordController::class,'list'])->name('animal_identification.list');
    Route::get('/admin/animal_record/animal_identification/add', [AnimalRecordController::class,'add'])->name('animal_identification.add');
    Route::post('/admin/animal_record/animal_identification/add', [AnimalRecordController::class,'store'])->name('animal_identification.store');
    // Route::get('/admin/animal_record/animal_identification/view/{id}', [AnimalRecordController::class,'view'])->name('animal_identification.view');
    Route::get('/admin/animal_record/animal_identification/edit/{id}', [AnimalRecordController::class,'edit'])->name('animal_identification.edit');
    Route::post('/admin/animal_record/animal_identification/edit/{id}', [AnimalRecordController::class,'update'])->name('animal_identification.update');
    Route::delete('/admin/animal_record/animal_identification/delete/{id}', [AnimalRecordController::class,'delete'])->name('animal_identification.delete');

    //AJAX for Record Search
    Route::get('/admin/animal_record/animal_identification/ajax-search', [AnimalRecordController::class, 'ajaxSearch'])->name('animal_identification.ajax.search');



    Route::get('/admin/animal_record/inactive_animal/list', [AnimalRecordController::class,'inactive'])->name('animal_identification.inactive');
    Route::get('/admin/animal_record/inactive_animal/ajax-inactive-search', [AnimalRecordController::class, 'ajaxInactiveSearch'])->name('animal_identification.ajax.inactive.search');



    //Breeding Routes
    Route::get('/admin/animal_record/breeding_record/list', [AnimalRecordController::class,'breedList'])->name('breeding_record.list');
    Route::post('/admin/animal_record/breeding_record/add', [AnimalRecordController::class,'breedStore'])->name('breeding_record.store');
    Route::get('/admin/animal_record/breeding_record/edit/{id}', [AnimalRecordController::class,'breedEdit'])->name('breeding_record.edit');
    Route::post('/admin/animal_record/breeding_record/edit/{id}', [AnimalRecordController::class,'breedUpdate'])->name('breeding_record.update');
    Route::delete('/admin/animal_record/breeding_record/delete/{id}', [AnimalRecordController::class,'breedDelete'])->name('breeding_record.delete');

    //AJAX for Record Search
    Route::get('admin/animal_record/breeding_record/search',[AnimalRecordController::class, 'breedingAjaxSearch'])->name('breeding_record.ajax.search');
    

    //Breeding More Record
    Route::get('/admin/animal_record/breeding_record/more_record/{id}', [AnimalRecordController::class,'breedMoreRecord'])->name('breeding_record.more_record');
    Route::post('/admin/animal_record/breeding_record/more_record/{id}', [AnimalRecordController::class,'breedMoreRecordStore'])->name('breeding_record.more_record.store');
    Route::get('/admin/animal_record/breeding_record/more_record/edit/{id}', [AnimalRecordController::class,'breedMoreRecordEdit'])->name('breeding_record.more_record.edit');
    Route::post('/admin/animal_record/breeding_record/more_record/edit/{id}', [AnimalRecordController::class,'breedMoreRecordUpdate'])->name('breeding_record.more_record.update');
    Route::delete('/admin/animal_record/breeding_record/more_record/delete/{id}', [AnimalRecordController::class,'breedMoreRecordDelete'])->name('breeding_record.more_record.delete');
    
    


    
    //Heating Routes
    Route::get('/admin/animal_record/heating/list', [AnimalRecordController::class,'heatingList'])->name('heating.list');
    Route::post('/admin/animal_record/heating/add', [AnimalRecordController::class,'heatingStore'])->name('heating.store');
    Route::get('/admin/animal_record/heating/edit/{id}', [AnimalRecordController::class,'heatingEdit'])->name('heating.edit');
    Route::post('/admin/animal_record/heating/edit/{id}', [AnimalRecordController::class,'heatingUpdate'])->name('heating.update');
    Route::delete('/admin/animal_record/heating/delete/{id}', [AnimalRecordController::class,'heatingDelete'])->name('heating.delete');

    //AJAX for Record Search
    Route::get('admin/animal_record/heating/search',[AnimalRecordController::class, 'heatingAjaxSearch'])->name('heating.ajax.search');
    

    //Heating More Record
    Route::get('/admin/animal_record/heating/more_record/{id}', [AnimalRecordController::class,'heatingMoreRecord'])->name('heating.more_record');
    Route::post('/admin/animal_record/heating/more_record/{id}', [AnimalRecordController::class,'heatingMoreRecordStore'])->name('heating.more_record.store');
    Route::get('/admin/animal_record/heating/more_record/edit/{id}', [AnimalRecordController::class,'heatingMoreRecordEdit'])->name('heating.more_record.edit');
    Route::post('/admin/animal_record/heating/more_record/edit/{id}', [AnimalRecordController::class,'heatingMoreRecordUpdate'])->name('heating.more_record.update');
    Route::delete('/admin/animal_record/heating/more_record/delete/{id}', [AnimalRecordController::class,'heatingMoreRecordDelete'])->name('heating.more_record.delete');


    
    
    
    //Growth Performance Routes
    Route::get('/admin/animal_record/growth_performance/list', [AnimalRecordController::class, 'growthList'])->name('growth_performance.index');
    Route::post('/admin/animal_record/growth_performance/add', [AnimalRecordController::class, 'growthStore'])->name('growth_performance.store');
    Route::get('/admin/animal_record/growth_performance/edit/{id}', [AnimalRecordController::class,'growthEdit'])->name('growth_performance.edit');
    Route::post('/admin/animal_record/growth_performance/edit/{id}', [AnimalRecordController::class,'growthUpdate'])->name('growth_performance.update');
    Route::delete('/admin/animal_record/growth_performance/delete/{id}', [AnimalRecordController::class,'growthDelete'])->name('growth_performance.delete');

    //AJAX
    Route::get('admin/animal_record/growth_performance/{pig_id}', [AnimalRecordController::class, 'loadPigGrowth'])->name('growth_performance.load');


    //Growth Performance More Record
    Route::get('/admin/animal_record/growth_performance/more_record/{id}', [AnimalRecordController::class,'growthMoreRecord'])->name('growth_performance.more_record');
    Route::post('/admin/animal_record/growth_performance/more_record/{id}', [AnimalRecordController::class,'growthMoreRecordStore'])->name('growth_performance.more_record.store');
    Route::get('/admin/animal_record/growth_performance/more_record/edit/{id}', [AnimalRecordController::class,'growthMoreRecordEdit'])->name('growth_performance.more_record.edit');
    Route::post('/admin/animal_record/growth_performance/more_record/edit/{id}', [AnimalRecordController::class,'growthMoreRecordUpdate'])->name('growth_performance.more_record.update');
    Route::delete('/admin/animal_record/growth_performance/more_record/delete/{id}', [AnimalRecordController::class,'growthMoreRecordDelete'])->name('growth_performance.more_record.delete');







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


    //Feed Stock More Record
    Route::get('/admin/feed_record/feed_stock/more_record/{id}', [FeedRecordController::class,'stockMoreDetail'])->name('feed_stock.more_record');
    Route::post('/admin/feed_record/feed_stock/more_record/{id}', [FeedRecordController::class,'stockMoreDetailStore'])->name('feed_stock.more_record.store');
    Route::get('/admin/feed_record/feed_stock/more_record/edit/{id}', [FeedRecordController::class,'stockMoreDetailEdit'])->name('feed_stock.more_record.edit');
    Route::post('/admin/feed_record/feed_stock/more_record/edit/{id}', [FeedRecordController::class,'stockMoreDetailUpdate'])->name('feed_stock.more_record.update');
    Route::delete('/admin/feed_record/feed_stock/more_record/delete/{id}', [FeedRecordController::class,'stockMoreDetailDelete'])->name('feed_stock.more_record.delete');


    
    
    
    
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
    
    //Feed Formulation More Record 
    Route::get('/admin/feed_record/feed_formulation/more_record/{id}', [FeedRecordController::class,'formulationMoreRecord'])->name('feed_formulation.more_record');
    Route::post('/admin/feed_record/feed_formulation/more_record/{id}', [FeedRecordController::class,'formulationMoreRecordStore'])->name('feed_formulation.more_record.store');
    Route::get('/admin/feed_record/feed_formulation/more_record/edit/{id}', [FeedRecordController::class,'formulationMoreRecordEdit'])->name('feed_formulation.more_record.edit');
    Route::post('/admin/feed_record/feed_formulation/more_record/edit/{id}', [FeedRecordController::class,'formulationMoreRecordUpdate'])->name('feed_formulation.more_record.update');
    Route::delete('/admin/feed_record/feed_formulation/more_record/delete/{id}', [FeedRecordController::class,'formulationMoreRecordDelete'])->name('feed_formulation.more_record.delete');




    
    
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
    



    //Yearly Expense Report
    Route::get('/admin/expense_record/general_expense_report', [ExpensesController::class, 'generalExpenseReport'])->name('general.expense.report');

    Route::get('/admin/expense_record/general-expense-report/data', [ExpensesController::class, 'generalExpenseReportData'])->name('general.expense.report.data');
    
    
    
    
    
    
    
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




    Route::get('/admin/sales_record/general_sales_report',[SalesController::class, 'generalSalesReport'])->name('general.sales.report');

    Route::get('/admin/sales_record/general-sales-report/data',[SalesController::class, 'generalSalesReportData'])->name('general.sales.report.data');






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
    
    
    //Nedication $ Treatment More Record
    Route::get('/admin/disease_treatment/medication_treatment/More_record/{id}', [DiseaseTreatmentController::class,'medicationMoreRecord'])->name('medication_treatment.more_record');
    Route::post('/admin/disease_treatment/medication_treatment/More_record/{id}', [DiseaseTreatmentController::class,'medicationMoreRecordStore'])->name('medication_treatment.more_record.store');
    Route::get('/admin/disease_treatment/medication_treatment/More_record/edit/{id}', [DiseaseTreatmentController::class,'medicationMoreRecordEdit'])->name('medication_treatment.more_record.edit');
    Route::post('/admin/disease_treatment/medication_treatment/More_record/update/{id}', [DiseaseTreatmentController::class,'medicationMoreRecordUpdate'])->name('medication_treatment.more_record.update');
    Route::delete('/admin/disease_treatment/medication_treatment/More_record/delete/{id}', [DiseaseTreatmentController::class,'medicationMoreRecordDelete'])->name('medication_treatment.more_record.delete');
    
    
    
    
    //VACCINE RECORD ROUTES

    // Vaccine Schedule
    Route::get('/admin/vaccine_record/vaccine_schedule/list', [VaccineController::class,'scheduleList'])->name('vaccine_schedule.list');
    Route::get('/admin/vaccine_record/vaccine_schedule/add', [VaccineController::class,'scheduleAdd'])->name('vaccine_schedule.add');
    Route::post('/admin/vaccine_record/vaccine_schedule/add', [VaccineController::class,'scheduleStore'])->name('vaccine_schedule.store');
    Route::get('/admin/vaccine_record/vaccine_schedule/view/{id}', [VaccineController::class,'scheduleView'])->name('vaccine_schedule.view');
    Route::get('/admin/vaccine_record/vaccine_schedule/edit/{id}', [VaccineController::class,'scheduleEdit'])->name('vaccine_schedule.edit');
    Route::post('/admin/vaccine_record/vaccine_schedule/edit/{id}', [VaccineController::class,'scheduleUpdate'])->name('vaccine_schedule.update');
    Route::delete('/admin/vaccine_record/vaccine_schedule/delete/{id}', [VaccineController::class,'scheduleDelete'])->name('vaccine_schedule.delete');

    //AJAX for Daily Avtivity Record Search
    Route::get('/admin/vaccine_record/vaccine_schedule/ajax-search', [VaccineController::class, 'scheduleAjaxSearch'])->name('vaccine_schedule.ajax.search');
    
    
    
    // Vaccine log
    Route::get('/admin/vaccine_record/vaccine_log/list', [VaccineController::class,'logList'])->name('vaccine_log.list');
    Route::get('/admin/vaccine_record/vaccine_log/add', [VaccineController::class,'logAdd'])->name('vaccine_log.add');
    Route::post('/admin/vaccine_record/vaccine_log/add', [VaccineController::class,'logStore'])->name('vaccine_log.store');
    Route::get('/admin/vaccine_record/vaccine_log/view/{id}', [VaccineController::class,'logView'])->name('vaccine_log.view');
    Route::get('/admin/vaccine_record/vaccine_log/edit/{id}', [VaccineController::class,'logEdit'])->name('vaccine_log.edit');
    Route::post('/admin/vaccine_record/vaccine_log/edit/{id}', [VaccineController::class,'logUpdate'])->name('vaccine_log.update');
    Route::delete('/admin/vaccine_record/vaccine_log/delete/{id}', [VaccineController::class,'logDelete'])->name('vaccine_log.delete');
    
    //AJAX for Daily Avtivity Record Search
    Route::get('/admin/vaccine_record/vaccine_log/ajax-search', [VaccineController::class, 'logAjaxSearch'])->name('vaccine_log.ajax.search');
    

    //Vaccine Log More Record
    Route::get('/admin/vaccine_record/vaccine_log/more_record/{id}', [VaccineController::class,'logMoreRecord'])->name('vaccine_log.more_record');
    Route::post('/admin/vaccine_record/vaccine_log/more_record/{id}', [VaccineController::class,'logMoreRecordStore'])->name('vaccine_log.more_record.store');
    Route::get('/admin/vaccine_record/vaccine_log/more_record/edit/{id}', [VaccineController::class,'logMoreRecordEdit'])->name('vaccine_log.more_record.edit');
    Route::post('/admin/vaccine_record/vaccine_log/more_record/update/{id}', [VaccineController::class,'logMoreRecordUpdate'])->name('vaccine_log.more_record.update');
    Route::delete('/admin/vaccine_record/vaccine_log/more_record/delete/{id}', [VaccineController::class,'logMoreRecordDelete'])->name('vaccine_log.more_record.delete');









    // TASK MANAGEMENT ROUTES

    //Pending & In-Progress Tasks
    Route::get('/admin/tasks/pending_in_progress', [TaskController::class,'index'])->name('tasks.index');
    Route::get('/admin/tasks/pending_in_progress/create', [TaskController::class,'create'])->name('tasks.create');
    Route::post('/admin/tasks/pending_in_progress', [TaskController::class,'store'])->name('tasks.store');
    Route::get('/admin/tasks/pending_in_progress/edit/{id}', [TaskController::class,'edit'])->name('tasks.edit');
    Route::post('/admin/tasks/pending_in_progress/edit/{id}', [TaskController::class,'update'])->name('tasks.update');
    Route::get('/admin/tasks/pending_in_progress/view/{task}', [TaskController::class,'show'])->name('tasks.show');

    Route::post('/admin/tasks/pending_in_progress/{task}/start', [TaskController::class,'start'])->name('tasks.start');
    Route::get('/admin/tasks/pending_in_progress/{task}/complete', [TaskController::class,'complete'])->name('tasks.complete');
    Route::post('/admin/tasks/pending_in_progress/{task}/complete', [TaskController::class,'storeCompletion'])->name('tasks.complete.store');
    Route::delete('/admin/tasks/pending_in_progress/{task}/delete', [TaskController::class,'delete'])->name('tasks.delete');

    Route::post('/admin/tasks/pending_in_progress/search', [TaskController::class,'search'])->name('tasks.search');


    //Completed Tasks
    Route::get('/admin/tasks/completed', [TaskController::class,'completedIndex'])->name('tasks.completed_index');
    Route::post('/admin/tasks/completed/search', [TaskController::class,'searchCompleted'])->name('tasks.search_completed');
    Route::get('/admin/tasks/completed/view/{task}', [TaskController::class,'show'])->name('tasks.show_completed');



    //My To Do Tasks
    Route::get('/admin/tasks/my_todo', [TaskController::class,'myToDoIndex'])->name('tasks.my_todo_index');
   





    
    // INVENTORY ROUTES

    //Farm Inventory
    Route::get('/admin/inventory/farm_inventory/list', [InventoryController::class,'inventoryList'])->name('farm_inventory.list');
    Route::get('/admin/inventory/farm_inventory/add', [InventoryController::class,'inventoryAdd'])->name('farm_inventory.add');
    Route::post('/admin/inventory/farm_inventory/add', [InventoryController::class,'inventoryStore'])->name('farm_inventory.store');
    Route::get('/admin/inventory/farm_inventory/view/{id}', [InventoryController::class,'inventoryView'])->name('farm_inventory.view');
    Route::get('/admin/inventory/farm_inventory/edit/{id}', [InventoryController::class,'inventoryEdit'])->name('farm_inventory.edit');
    Route::post('/admin/inventory/farm_inventory/edit/{id}', [InventoryController::class,'inventoryUpdate'])->name('farm_inventory.update');
    Route::delete('/admin/inventory/farm_inventory/delete/{id}', [InventoryController::class,'inventoryDelete'])->name('farm_inventory.delete');
    
    //AJAX for Daily Avtivity Record Search
    Route::get('/admin/inventory/farm_inventory/ajax-search', [InventoryController::class, 'inventoryAjaxSearch'])->name('farm_inventory.ajax.search');
    

    //Inventory More Record
    Route::get('/admin/inventory/farm_inventory/more_record/{id}', [InventoryController::class,'inventoryMoreRecord'])->name('farm_inventory.more_record');
    Route::post('/admin/inventory/farm_inventory/more_record/{id}', [InventoryController::class,'inventoryMoreRecordStore'])->name('farm_inventory.more_record.store');
    Route::get('/admin/inventory/farm_inventory/more_record/edit/{id}', [InventoryController::class,'inventoryMoreRecordEdit'])->name('farm_inventory.more_record.edit');
    Route::post('/admin/inventory/farm_inventory/more_record/update/{id}', [InventoryController::class,'inventoryMoreRecordUpdate'])->name('farm_inventory.more_record.update');
    Route::delete('/admin/inventory/farm_inventory/more_record/delete/{id}', [InventoryController::class,'inventoryMoreRecordDelete'])->name('farm_inventory.more_record.delete');
    
    
    
    
    
    
    
    // INGREDIENT ROUTES

    //Farm Inventory
    Route::get('/admin/inventory/farm_inventory/list', [InventoryController::class,'inventoryList'])->name('farm_inventory.list');
    Route::get('/admin/inventory/farm_inventory/add', [InventoryController::class,'inventoryAdd'])->name('farm_inventory.add');
    Route::post('/admin/inventory/farm_inventory/add', [InventoryController::class,'inventoryStore'])->name('farm_inventory.store');
    Route::get('/admin/inventory/farm_inventory/view/{id}', [InventoryController::class,'inventoryView'])->name('farm_inventory.view');
    Route::get('/admin/inventory/farm_inventory/edit/{id}', [InventoryController::class,'inventoryEdit'])->name('farm_inventory.edit');
    Route::post('/admin/inventory/farm_inventory/edit/{id}', [InventoryController::class,'inventoryUpdate'])->name('farm_inventory.update');
    Route::delete('/admin/inventory/farm_inventory/delete/{id}', [InventoryController::class,'inventoryDelete'])->name('farm_inventory.delete');
    
    //AJAX for Daily Avtivity Record Search
    Route::get('/admin/inventory/farm_inventory/ajax-search', [InventoryController::class, 'inventoryAjaxSearch'])->name('farm_inventory.ajax.search');
    

    //Inventory More Record
    Route::get('/admin/inventory/farm_inventory/more_record/{id}', [InventoryController::class,'inventoryMoreRecord'])->name('farm_inventory.more_record');
    Route::post('/admin/inventory/farm_inventory/more_record/{id}', [InventoryController::class,'inventoryMoreRecordStore'])->name('farm_inventory.more_record.store');
    Route::get('/admin/inventory/farm_inventory/more_record/edit/{id}', [InventoryController::class,'inventoryMoreRecordEdit'])->name('farm_inventory.more_record.edit');
    Route::post('/admin/inventory/farm_inventory/more_record/update/{id}', [InventoryController::class,'inventoryMoreRecordUpdate'])->name('farm_inventory.more_record.update');
    Route::delete('/admin/inventory/farm_inventory/more_record/delete/{id}', [InventoryController::class,'inventoryMoreRecordDelete'])->name('farm_inventory.more_record.delete');












    



    



});
//===ADMIN ROUTE GROUP END===///















//===STAFF DASHBOARD ROUTE GROUP===///
Route::group(['middleware' => 'staff'], function(){

    Route::get('/staff/dashboard', [DashboardController::class,'dashboard'])->name('staff.dashboard');
    
    Route::get('/staff/change_password', [UserController::class,'changePassword'])->name('staff.change_password');
    Route::post('/staff/change_password', [UserController::class,'updatePassword'])->name('staff.update_password');


    Route::get('/staff/account', [UserController::class,'myAccount'])->name('staff.account');
    Route::post('/staff/account', [UserController::class,'updateMyAccount'])->name('update.staff.account');



    // ANINAL RECORD ROUTES

    //Animal Identification
    Route::get('/staff/animal_record/animal_identification/list', [AnimalRecordController::class,'list'])->name('staff.animal_identification.list');
    Route::get('/staff/animal_record/animal_identification/add', [AnimalRecordController::class,'add'])->name('staff.animal_identification.add');
    Route::post('/staff/animal_record/animal_identification/add', [AnimalRecordController::class,'store'])->name('staff.animal_identification.store');
    // Route::get('/staff/animal_record/animal_identification/view/{id}', [AnimalRecordController::class,'view'])->name('staff.animal_identification.view');
    Route::get('/staff/animal_record/animal_identification/edit/{id}', [AnimalRecordController::class,'edit'])->name('staff.animal_identification.edit');
    Route::post('/staff/animal_record/animal_identification/edit/{id}', [AnimalRecordController::class,'update'])->name('staff.animal_identification.update');
    Route::delete('/staff/animal_record/animal_identification/delete/{id}', [AnimalRecordController::class,'delete'])->name('staff.animal_identification.delete');

    //AJAX for Record Search
    Route::get('/staff/animal_record/animal_identification/ajax-search', [AnimalRecordController::class, 'ajaxSearch'])->name('staff.animal_identification.ajax.search');


    //For inactive animals
    Route::get('/staff/animal_record/inactive_animal/list', [AnimalRecordController::class,'inactive'])->name('staff.animal_identification.inactive');
    Route::get('/staff/animal_record/inactive_animal/ajax-inactive-search', [AnimalRecordController::class, 'ajaxInactiveSearch'])->name('staff.animal_identification.ajax.inactive.search');



    //Breeding Routes
    Route::get('/staff/animal_record/breeding_record/list', [AnimalRecordController::class,'breedList'])->name('staff.breeding_record.list');
    Route::post('/staff/animal_record/breeding_record/add', [AnimalRecordController::class,'breedStore'])->name('staff.breeding_record.store');
    Route::get('/staff/animal_record/breeding_record/edit/{id}', [AnimalRecordController::class,'breedEdit'])->name('staff.breeding_record.edit');
    Route::post('/staff/animal_record/breeding_record/edit/{id}', [AnimalRecordController::class,'breedUpdate'])->name('staff.breeding_record.update');
    Route::delete('/staff/animal_record/breeding_record/delete/{id}', [AnimalRecordController::class,'breedDelete'])->name('staff.breeding_record.delete');

    //AJAX for Record Search
    Route::get('/staff/animal_record/breeding_record/search',[AnimalRecordController::class, 'breedingAjaxSearch'])->name('staff.breeding_record.ajax.search');


    //Breeding More Record
    Route::get('/staff/animal_record/breeding_record/more_record/{id}', [AnimalRecordController::class,'breedMoreRecord'])->name('staff.breeding_record.more_record');
    Route::post('/staff/animal_record/breeding_record/more_record/{id}', [AnimalRecordController::class,'breedMoreRecordStore'])->name('staff.breeding_record.more_record.store');
    
    

    //Heating Routes
    Route::get('/staff/animal_record/heating/list', [AnimalRecordController::class,'heatingList'])->name('staff.heating.list');
    Route::post('/staff/animal_record/heating/add', [AnimalRecordController::class,'heatingStore'])->name('staff.heating.store');
    Route::get('/staff/animal_record/heating/edit/{id}', [AnimalRecordController::class,'heatingEdit'])->name('staff.heating.edit');
    Route::post('/staff/animal_record/heating/edit/{id}', [AnimalRecordController::class,'heatingUpdate'])->name('staff.heating.update');
    Route::delete('/staff/animal_record/heating/delete/{id}', [AnimalRecordController::class,'heatingDelete'])->name('staff.heating.delete');

    //AJAX for Record Search
    Route::get('staff/animal_record/heating/search',[AnimalRecordController::class, 'heatingAjaxSearch'])->name('staff.heating.ajax.search');
    

    //Heating More Record
    Route::get('/staff/animal_record/heating/more_record/{id}', [AnimalRecordController::class,'heatingMoreRecord'])->name('staff.heating.more_record');
    Route::post('/staff/animal_record/heating/more_record/{id}', [AnimalRecordController::class,'heatingMoreRecordStore'])->name('staff.heating.more_record.store');
    

    
    
    //Growth Performance Routes
    Route::get('/staff/animal_record/growth_performance/list', [AnimalRecordController::class, 'growthList'])->name('staff.growth_performance.index');
    Route::post('/staff/animal_record/growth_performance/add', [AnimalRecordController::class, 'growthStore'])->name('staff.growth_performance.store');
    Route::get('/staff/animal_record/growth_performance/edit/{id}', [AnimalRecordController::class,'growthEdit'])->name('staff.growth_performance.edit');
    Route::post('/staff/animal_record/growth_performance/edit/{id}', [AnimalRecordController::class,'growthUpdate'])->name('staff.growth_performance.update');
    Route::delete('/staff/animal_record/growth_performance/delete/{id}', [AnimalRecordController::class,'growthDelete'])->name('staff.growth_performance.delete');

    //AJAX
    Route::get('/staff/animal_record/growth_performance/{pig_id}', [AnimalRecordController::class, 'loadPigGrowth'])->name('staff.growth_performance.load');


    //Growth Performance More Record
    Route::get('/staff/animal_record/growth_performance/more_record/{id}', [AnimalRecordController::class,'growthMoreRecord'])->name('staff.growth_performance.more_record');
    Route::post('/staff/animal_record/growth_performance/more_record/{id}', [AnimalRecordController::class,'growthMoreRecordStore'])->name('staff.growth_performance.more_record.store');







    // FARM RECORD ROUTES

    //Feed Stock Routes 
    Route::get('/staff/feed_record/feed_stock/list', [FeedRecordController::class,'stockList'])->name('staff.feed_stock.list');
    Route::get('/staff/feed_record/feed_stock/add', [FeedRecordController::class,'stockAdd'])->name('staff.feed_stock.add');
    Route::post('/staff/feed_record/feed_stock/add', [FeedRecordController::class,'stockStore'])->name('staff.feed_stock.store');
    // Route::get('/staff/feed_record/feed_stock/view/{id}', [FeedRecordController::class,'stockView'])->name('staff.feed_stock.view');
    Route::get('/staff/feed_record/feed_stock/edit/{id}', [FeedRecordController::class,'stockEdit'])->name('staff.feed_stock.edit');
    Route::post('/staff/feed_record/feed_stock/edit/{id}', [FeedRecordController::class,'stockUpdate'])->name('staff.feed_stock.update');
    Route::delete('/staff/feed_record/feed_stock/delete/{id}', [FeedRecordController::class,'stockDelete'])->name('staff.feed_stock.delete');

    
    //AJAX for Record Search
    Route::get('/staff/feed_record/feed_stock/ajax-search', [FeedRecordController::class, 'stockAjaxSearch'])->name('staff.feed_stock.ajax.search');
    
    
    //Feed Store More Record
    Route::get('/staff/feed_record/feed_stock/more_record/{id}', [FeedRecordController::class,'stockMoreDetail'])->name('staff.feed_stock.more_record');
    Route::post('/staff/feed_record/feed_stock/more_record/{id}', [FeedRecordController::class,'stockMoreDetailStore'])->name('staff.feed_stock.more_record.store');

    
    
    //Daily Feed Usage Routes 
    Route::get('/staff/feed_record/daily_feed_usage/list', [FeedRecordController::class,'feedUsageList'])->name('staff.daily_feed_usage.list');
    Route::post('/staff/feed_record/daily_feed_usage/add', [FeedRecordController::class,'feedUsageStore'])->name('staff.daily_feed_usage.store');
    Route::get('/staff/feed_record/daily_feed_usage/edit/{id}', [FeedRecordController::class,'feedUsageEdit'])->name('staff.daily_feed_usage.edit');
    Route::post('/staff/feed_record/daily_feed_usage/edit/{id}', [FeedRecordController::class,'feedUsageUpdate'])->name('staff.daily_feed_usage.update');
    Route::delete('/staff/feed_record/daily_feed_usage/delete/{id}', [FeedRecordController::class,'feedUsageDelete'])->name('staff.daily_feed_usage.delete');

    //AJAX for Record Search
    Route::get('/staff/feed_record/daily_feed_usage/ajax-search', [FeedRecordController::class, 'feedUsageAjaxSearch'])->name('staff.daily_feed_usage.ajax.search');




    //Feed Formulation Routes 
    Route::get('/staff/feed_record/feed_formulation/list', [FeedRecordController::class,'formulationList'])->name('staff.feed_formulation.list');
    Route::get('/staff/feed_record/feed_formulation/add', [FeedRecordController::class,'formulationAdd'])->name('staff.feed_formulation.add');
    Route::post('/staff/feed_record/feed_formulation/add', [FeedRecordController::class,'formulationStore'])->name('staff.feed_formulation.store');
    Route::get('/staff/feed_record/feed_formulation/edit/{id}', [FeedRecordController::class,'formulationEdit'])->name('staff.feed_formulation.edit');
    Route::post('/staff/feed_record/feed_formulation/edit/{id}', [FeedRecordController::class,'formulationUpdate'])->name('staff.feed_formulation.update');
    Route::delete('/staff/feed_record/feed_formulation/delete/{id}', [FeedRecordController::class,'formulationDelete'])->name('staff.feed_formulation.delete');

    //AJAX for Record Search
    Route::get('/staff/feed_record/feed_formulation/ajax-search', [FeedRecordController::class, 'formulationAjaxSearch'])->name('staff.feed_formulation.ajax.search');


     //Feed Formulation More Record 
    Route::get('/staff/feed_record/feed_formulation/more_record/{id}', [FeedRecordController::class,'formulationMoreRecord'])->name('staff.feed_formulation.more_record');
    Route::post('/staff/feed_record/feed_formulation/more_record/{id}', [FeedRecordController::class,'formulationMoreRecordStore'])->name('staff.feed_formulation.more_record.store');




    
    
    // EXPENSES ROUTES

    // Daily Expense Record
    Route::get('/staff/expense_record/daily_expense/list', [ExpensesController::class,'list'])->name('staff.expenses.list');
    Route::get('/staff/expense_record/daily_expense/add', [ExpensesController::class,'add'])->name('staff.expenses.add');
    Route::post('/staff/expense_record/daily_expense/add', [ExpensesController::class,'store'])->name('staff.expenses.store');
    Route::get('/staff/expense_record/daily_expense/view/{id}', [ExpensesController::class,'view'])->name('staff.expenses.view');
    Route::get('/staff/expense_record/daily_expense/edit/{id}', [ExpensesController::class,'edit'])->name('staff.expenses.edit');
    Route::post('/staff/expense_record/daily_expense/edit/{id}', [ExpensesController::class,'update'])->name('staff.expenses.update');
    Route::delete('/staff/expense_record/daily_expense/delete/{id}', [ExpensesController::class,'delete'])->name('staff.expenses.delete');

    //AJAX for Expense Record Search
    Route::get('/staff/expense_record/daily_expense/ajax-search', [ExpensesController::class, 'ajaxSearch'])->name('staff.expenses.ajax.search');
    
    
    
    // Monthly Expense Record
    Route::get('/staff/expense_record/monthly_expense_summary/list', [ExpensesController::class,'monthlyList'])->name('staff.monthly_expenses.list');
    Route::get('/staff/expense_record/monthly_expense_summary/add', [ExpensesController::class,'monthlyAdd'])->name('staff.monthly_expenses.add');
    Route::post('/staff/expense_record/monthly_expense_summary/add', [ExpensesController::class,'monthlyStore'])->name('staff.monthly_expenses.store');
    // Route::get('/staff/expense_record/monthly_expense_summary/view/{id}', [ExpensesController::class,'monthlyView'])->name('staff.monthly_expenses.view');
    Route::get('/staff/expense_record/monthly_expense_summary/edit/{id}', [ExpensesController::class,'monthlyEdit'])->name('staff.monthly_expenses.edit');
    Route::post('/staff/expense_record/monthly_expense_summary/edit/{id}', [ExpensesController::class,'monthlyUpdate'])->name('staff.monthly_expenses.update');
    Route::delete('/staff/expense_record/monthly_expense_summary/delete/{id}', [ExpensesController::class,'monthlyDelete'])->name('staff.monthly_expenses.delete');

    //AJAX for Expense Record Search
    Route::get('/staff/expense_record/monthly_expense_summary/ajax-search', [ExpensesController::class, 'monthlyAjaxSearch'])->name('staff.monthly_expenses.ajax.search');
    

    
    
    
    // SALES ROUTES

    // Daily Sales Record
    Route::get('/staff/sales_record/daily_sales/list', [SalesController::class,'list'])->name('staff.sales.list');
    Route::get('/staff/sales_record/daily_sales/add', [SalesController::class,'add'])->name('staff.sales.add');
    Route::post('/staff/sales_record/daily_sales/add', [SalesController::class,'store'])->name('staff.sales.store');
    Route::get('/staff/sales_record/daily_sales/view/{id}', [SalesController::class,'view'])->name('staff.sales.view');
    Route::get('/staff/sales_record/daily_sales/edit/{id}', [SalesController::class,'edit'])->name('staff.sales.edit');
    Route::post('/staff/sales_record/daily_sales/edit/{id}', [SalesController::class,'update'])->name('staff.sales.update');
    Route::delete('/staff/sales_record/daily_sales/delete/{id}', [SalesController::class,'delete'])->name('staff.sales.delete');

    //AJAX for Expense Record Search
    Route::get('/staff/sales_record/daily_sales/ajax-search', [SalesController::class, 'ajaxSearch'])->name('staff.sales.ajax.search');
    

    
    // Monthly Sales Record
    Route::get('/staff/sales_record/monthly_sales_summary/list', [SalesController::class,'monthlyList'])->name('staff.monthly_sales.list');
    Route::get('/staff/sales_record/monthly_sales_summary/add', [SalesController::class,'monthlyAdd'])->name('staff.monthly_sales.add');
    Route::post('/staff/sales_record/monthly_sales_summary/add', [SalesController::class,'monthlyStore'])->name('staff.monthly_sales.store');
    Route::get('/staff/sales_record/monthly_sales_summary/edit/{id}', [SalesController::class,'monthlyEdit'])->name('staff.monthly_sales.edit');
    Route::post('/staff/sales_record/monthly_sales_summary/edit/{id}', [SalesController::class,'monthlyUpdate'])->name('staff.monthly_sales.update');
    Route::delete('/staff/sales_record/monthly_sales_summary/delete/{id}', [SalesController::class,'monthlyDelete'])->name('staff.monthly_sales.delete');

    //AJAX for sales Record Search
    Route::get('/staff/sales_record/monthly_sales_summary/ajax-search', [SalesController::class, 'monthlyAjaxSearch'])->name('staff.monthly_sales.ajax.search');





    //====== GENERAL FARM ACTIVITY ROUTES=====

    //Daily Farm Activities 
    Route::get('/staff/general_farm_activity/farm_daily_care/list', [FarmDailyCareController::class,'list'])->name('staff.farm_daily_care.list');
    Route::get('/staff/general_farm_activity/farm_daily_care/add', [FarmDailyCareController::class,'add'])->name('staff.farm_daily_care.add');
    Route::post('/staff/general_farm_activity/farm_daily_care/add', [FarmDailyCareController::class,'store'])->name('staff.farm_daily_care.store');
    Route::get('/staff/general_farm_activity/farm_daily_care/view/{id}', [FarmDailyCareController::class,'view'])->name('staff.farm_daily_care.view');
    Route::get('/staff/general_farm_activity/farm_daily_care/edit/{id}', [FarmDailyCareController::class,'edit'])->name('staff.farm_daily_care.edit');
    Route::post('/staff/general_farm_activity/farm_daily_care/edit/{id}', [FarmDailyCareController::class,'update'])->name('staff.farm_daily_care.update');
    Route::delete('/staff/general_farm_activity/farm_daily_care/delete/{id}', [FarmDailyCareController::class,'delete'])->name('staff.farm_daily_care.delete');

    //AJAX for Daily Avtivity Record Search
    Route::get('/staff/general_farm_activity/farm_daily_care/ajax-search', [FarmDailyCareController::class, 'ajaxSearch'])->name('staff.farm_daily_care.ajax.search');
    
    


    //Maintenance & Sanitation 
    Route::get('/staff/general_farm_activity/maintenance_sanitation/list', [FarmDailyCareController::class,'maintenanceList'])->name('staff.maintenance_sanitation.list');
    // Route::get('/staff/general_farm_activity/maintenance_sanitation/add', [FarmDailyCareController::class,'maintenanceAdd'])->name('staff.maintenance_sanitation.add');
    Route::post('/staff/general_farm_activity/maintenance_sanitation/add', [FarmDailyCareController::class,'maintenanceStore'])->name('staff.maintenance_sanitation.store');
    Route::get('/staff/general_farm_activity/maintenance_sanitation/view/{id}', [FarmDailyCareController::class,'maintenanceView'])->name('staff.maintenance_sanitation.view');
    Route::get('/staff/general_farm_activity/maintenance_sanitation/edit/{id}', [FarmDailyCareController::class,'maintenanceEdit'])->name('staff.maintenance_sanitation.edit');
    Route::post('/staff/general_farm_activity/maintenance_sanitation/edit/{id}', [FarmDailyCareController::class,'maintenanceUpdate'])->name('staff.maintenance_sanitation.update');
    Route::delete('/staff/general_farm_activity/maintenance_sanitation/delete/{id}', [FarmDailyCareController::class,'maintenanceDelete'])->name('staff.maintenance_sanitation.delete');

    //AJAX for Daily Avtivity Record Search
    Route::get('/staff/general_farm_activity/maintenance_sanitation/ajax-search', [FarmDailyCareController::class, 'maintenanceAjaxSearch'])->name('staff.maintenance_sanitation.ajax.search');




    
    
    //DISEASE & TREATMENT ROUTES
    
    //Disease Incidence Routes
    Route::get('/staff/disease_treatment/disease_incidence/list', [DiseaseTreatmentController::class,'incidenceList'])->name('staff.disease_incidence.list');
    Route::get('/staff/disease_treatment/disease_incidence/add', [DiseaseTreatmentController::class,'incidenceAdd'])->name('staff.disease_incidence.add');
    Route::post('/staff/disease_treatment/disease_incidence/add', [DiseaseTreatmentController::class,'incidenceStore'])->name('staff.disease_incidence.store');
    Route::get('/staff/disease_treatment/disease_incidence/view/{id}', [DiseaseTreatmentController::class,'incidenceView'])->name('staff.disease_incidence.view');
    Route::get('/staff/disease_treatment/disease_incidence/edit/{id}', [DiseaseTreatmentController::class,'incidenceEdit'])->name('staff.disease_incidence.edit');
    Route::post('/staff/disease_treatment/disease_incidence/edit/{id}', [DiseaseTreatmentController::class,'incidenceUpdate'])->name('staff.disease_incidence.update');
    Route::delete('/staff/disease_treatment/disease_incidence/delete/{id}', [DiseaseTreatmentController::class,'incidenceDelete'])->name('staff.disease_incidence.delete');

    //AJAX for Daily Avtivity Record Search
    Route::get('/staff/disease_treatment/disease_incidence/ajax-search', [DiseaseTreatmentController::class, 'incidenceAjaxSearch'])->name('staff.disease_incidence.ajax.search');




    //Medication & Treatment Routes
    Route::get('/staff/disease_treatment/medication_treatment/list', [DiseaseTreatmentController::class,'medicationList'])->name('staff.medication_treatment.list');
    Route::get('/staff/disease_treatment/medication_treatment/add', [DiseaseTreatmentController::class,'medicationAdd'])->name('staff.medication_treatment.add');
    Route::post('/staff/disease_treatment/medication_treatment/add', [DiseaseTreatmentController::class,'medicationStore'])->name('staff.medication_treatment.store');
    Route::get('/staff/disease_treatment/medication_treatment/view/{id}', [DiseaseTreatmentController::class,'medicationView'])->name('staff.medication_treatment.view');
    Route::get('/staff/disease_treatment/medication_treatment/edit/{id}', [DiseaseTreatmentController::class,'medicationEdit'])->name('staff.medication_treatment.edit');
    Route::post('/staff/disease_treatment/medication_treatment/edit/{id}', [DiseaseTreatmentController::class,'medicationUpdate'])->name('staff.medication_treatment.update');
    Route::delete('/staff/disease_treatment/medication_treatment/delete/{id}', [DiseaseTreatmentController::class,'medicationDelete'])->name('staff.medication_treatment.delete');

    //AJAX for Daily Avtivity Record Search
    Route::get('/staff/disease_treatment/medication_treatment/ajax-search', [DiseaseTreatmentController::class, 'medicationAjaxSearch'])->name('staff.medication_treatment.ajax.search');
    


    //Nedication $ Treatment More Record
    Route::get('/staff/disease_treatment/medication_treatment/More_record/{id}', [DiseaseTreatmentController::class,'medicationMoreRecord'])->name('staff.medication_treatment.more_record');
    Route::post('/staff/disease_treatment/medication_treatment/More_record/{id}', [DiseaseTreatmentController::class,'medicationMoreRecordStore'])->name('staff.medication_treatment.more_record.store');
    
    
    
    
    
    //VACCINE RECORD ROUTES

    // Vaccine Schedule
    Route::get('/staff/vaccine_record/vaccine_schedule/list', [VaccineController::class,'scheduleList'])->name('staff.vaccine_schedule.list');
    Route::get('/staff/vaccine_record/vaccine_schedule/add', [VaccineController::class,'scheduleAdd'])->name('staff.vaccine_schedule.add');
    Route::post('/staff/vaccine_record/vaccine_schedule/add', [VaccineController::class,'scheduleStore'])->name('staff.vaccine_schedule.store');
    Route::get('/staff/vaccine_record/vaccine_schedule/view/{id}', [VaccineController::class,'scheduleView'])->name('staff.vaccine_schedule.view');
    Route::get('/staff/vaccine_record/vaccine_schedule/edit/{id}', [VaccineController::class,'scheduleEdit'])->name('staff.vaccine_schedule.edit');
    Route::post('/staff/vaccine_record/vaccine_schedule/edit/{id}', [VaccineController::class,'scheduleUpdate'])->name('staff.vaccine_schedule.update');
    Route::delete('/staff/vaccine_record/vaccine_schedule/delete/{id}', [VaccineController::class,'scheduleDelete'])->name('staff.vaccine_schedule.delete');

    //AJAX for Daily Avtivity Record Search
    Route::get('/staff/vaccine_record/vaccine_schedule/ajax-search', [VaccineController::class, 'scheduleAjaxSearch'])->name('staff.vaccine_schedule.ajax.search');
    
    
    
    // Vaccine log
    Route::get('/staff/vaccine_record/vaccine_log/list', [VaccineController::class,'logList'])->name('staff.vaccine_log.list');
    Route::get('/staff/vaccine_record/vaccine_log/add', [VaccineController::class,'logAdd'])->name('staff.vaccine_log.add');
    Route::post('/staff/vaccine_record/vaccine_log/add', [VaccineController::class,'logStore'])->name('staff.vaccine_log.store');
    Route::get('/staff/vaccine_record/vaccine_log/view/{id}', [VaccineController::class,'logView'])->name('staff.vaccine_log.view');
    Route::get('/staff/vaccine_record/vaccine_log/edit/{id}', [VaccineController::class,'logEdit'])->name('staff.vaccine_log.edit');
    Route::post('/staff/vaccine_record/vaccine_log/edit/{id}', [VaccineController::class,'logUpdate'])->name('staff.vaccine_log.update');
    Route::delete('/staff/vaccine_record/vaccine_log/delete/{id}', [VaccineController::class,'logDelete'])->name('staff.vaccine_log.delete');

    //AJAX for Daily Avtivity Record Search
    Route::get('/staff/vaccine_record/vaccine_log/ajax-search', [VaccineController::class, 'logAjaxSearch'])->name('staff.vaccine_log.ajax.search');


    
    //Vaccine Log More Record
    Route::get('/staff/vaccine_record/vaccine_log/more_record/{id}', [VaccineController::class,'logMoreRecord'])->name('staff.vaccine_log.more_record');
    Route::post('/staff/vaccine_record/vaccine_log/more_record/{id}', [VaccineController::class,'logMoreRecordStore'])->name('staff.vaccine_log.more_record.store');







    // TASK MANAGEMENT ROUTES

    //Pending & In-Progress Tasks
    Route::get('/staff/tasks/pending_in_progress', [TaskController::class,'index'])->name('staff.tasks.index');
    Route::get('/staff/tasks/pending_in_progress/create', [TaskController::class,'create'])->name('staff.tasks.create');
    Route::post('/staff/tasks/pending_in_progress', [TaskController::class,'store'])->name('staff.tasks.store');
    Route::get('/staff/tasks/pending_in_progress/edit/{id}', [TaskController::class,'edit'])->name('staff.tasks.edit');
    Route::post('/staff/tasks/pending_in_progress/edit/{id}', [TaskController::class,'update'])->name('staff.tasks.update');
    Route::get('/staff/tasks/pending_in_progress/view/{task}', [TaskController::class,'show'])->name('staff.tasks.show');

    Route::post('/staff/tasks/pending_in_progress/{task}/start', [TaskController::class,'start'])->name('staff.tasks.start');
    Route::get('/staff/tasks/pending_in_progress/{task}/complete', [TaskController::class,'complete'])->name('staff.tasks.complete');
    Route::post('/staff/tasks/pending_in_progress/{task}/complete', [TaskController::class,'storeCompletion'])->name('staff.tasks.complete.store');
    Route::delete('/staff/tasks/pending_in_progress/{task}/delete', [TaskController::class,'delete'])->name('staff.tasks.delete');

    Route::post('/staff/tasks/pending_in_progress/search', [TaskController::class,'staffTaskSearch'])->name('staff.tasks.search');


    //Completed Tasks
    Route::get('/staff/tasks/completed', [TaskController::class,'completedIndex'])->name('staff.tasks.completed_index');
    Route::post('/staff/tasks/completed/search', [TaskController::class,'searchCompleted'])->name('staff.tasks.search_completed');
    Route::get('/staff/tasks/completed/view/{task}', [TaskController::class,'show'])->name('staff.tasks.show_completed');







    // INVENTORY ROUTES

    //Farm Inventory
    Route::get('/staff/inventory/farm_inventory/list', [InventoryController::class,'inventoryList'])->name('staff.farm_inventory.list');
    Route::get('/staff/inventory/farm_inventory/add', [InventoryController::class,'inventoryAdd'])->name('staff.farm_inventory.add');
    Route::post('/staff/inventory/farm_inventory/add', [InventoryController::class,'inventoryStore'])->name('staff.farm_inventory.store');
    Route::get('/staff/inventory/farm_inventory/view/{id}', [InventoryController::class,'inventoryView'])->name('staff.farm_inventory.view');
    Route::get('/staff/inventory/farm_inventory/edit/{id}', [InventoryController::class,'inventoryEdit'])->name('staff.farm_inventory.edit');
    Route::post('/staff/inventory/farm_inventory/edit/{id}', [InventoryController::class,'inventoryUpdate'])->name('staff.farm_inventory.update');
    Route::delete('/staff/inventory/farm_inventory/delete/{id}', [InventoryController::class,'inventoryDelete'])->name('staff.farm_inventory.delete');
    
    //AJAX for Daily Avtivity Record Search
    Route::get('/staff/inventory/farm_inventory/ajax-search', [InventoryController::class, 'inventoryAjaxSearch'])->name('staff.farm_inventory.ajax.search');
    

    //Inventory More Record
    Route::get('/staff/inventory/farm_inventory/more_record/{id}', [InventoryController::class,'inventoryMoreRecord'])->name('staff.farm_inventory.more_record');
    Route::post('/staff/inventory/farm_inventory/more_record/{id}', [InventoryController::class,'inventoryMoreRecordStore'])->name('staff.farm_inventory.more_record.store');








    // MISCELLANEOUS RECORD ROUTES
    Route::get('/staff/inventory/miscellaneous/list', [MiscellaneousController::class,'list'])->name('staff.miscellaneous.list');
    Route::get('/staff/inventory/miscellaneous/add', [MiscellaneousController::class,'add'])->name('staff.miscellaneous.add');
    Route::post('/staff/inventory/miscellaneous/add', [MiscellaneousController::class,'store'])->name('staff.miscellaneous.store');
    Route::get('/staff/inventory/miscellaneous/view/{id}', [MiscellaneousController::class,'view'])->name('staff.miscellaneous.view');
    Route::get('/staff/inventory/miscellaneous/edit/{id}', [MiscellaneousController::class,'edit'])->name('staff.miscellaneous.edit');
    Route::post('/staff/inventory/miscellaneous/edit/{id}', [MiscellaneousController::class,'update'])->name('staff.miscellaneous.update');
    Route::delete('/staff/inventory/miscellaneous/delete/{id}', [MiscellaneousController::class,'delete'])->name('staff.miscellaneous.delete');

    // AJAX for Expense Record Search
    Route::get('/staff/inventory/miscellaneous/ajax-search', [MiscellaneousController::class, 'ajaxSearch'])->name('staff.miscellaneous.ajax.search');






    //REPORTS
    Route::get('/staff/expense_record/general_expense_report', [ExpensesController::class, 'generalExpenseReport'])->name('staff.general.expense.report');

    Route::get('/staff/expense_record/general-expense-report/data', [ExpensesController::class, 'generalExpenseReportData'])->name('staff.general.expense.report.data');


    Route::get('/staff/sales_record/general_sales_report',[SalesController::class, 'generalSalesReport'])->name('staff.general.sales.report');

    Route::get('/staff/sales_record/general-sales-report/data',[SalesController::class, 'generalSalesReportData'])->name('staff.general.sales.report.data');

    Route::get('/staff/report/list', [ReportController::class,'list'])->name('staff.report.list');



    //QUICK RECORD VIEW
    Route::get('/staff/weekly_records/view', [WeeklyRecordController::class,'view'])->name('staff.weekly_records.view');









    
});
//===staff ROUTE GROUP END===///








