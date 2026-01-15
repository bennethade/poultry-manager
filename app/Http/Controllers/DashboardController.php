<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacher;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Exam;
use App\Models\Expenses;
use App\Models\FarmDailyCare;
use App\Models\FarmRecords;
use App\Models\Homework;
use App\Models\NoticeBoard;
use App\Models\Sales;
use App\Models\StudentAttendance;
use App\Models\StudentFees;
use App\Models\Subject;
use App\Models\SubmitHomework;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = 'Dashboad';


        $data['getTotalStaff'] = User::where('user_type', 2)->count();
        $data['getTotalFarmRecord'] = FarmRecords::count();
        $data['getTotalFarmDailyCare'] = FarmDailyCare::count();
        
        $data['firstDayOfMonth'] = Carbon::now()->startOfMonth()->toDateString();
        $data['lastDayOfMonth'] = Carbon::now()->endOfMonth()->toDateString();


        //EXPENSES DATA
        $data['getTotalTodayExpenses'] = Expenses::getTotalTodayExpenses();
        $data['getTotalMonthlyExpenses'] = Expenses::getTotalMonthlyExpenses();
        $data['getTotalExpenses'] = Expenses::getTotalExpenses();


        //SALES DATA
        $data['getTotalTodaySales'] = Sales::getTotalTodaySales();
        $data['getTotalMonthlySales'] = Sales::getTotalMonthlySales();
        $data['getTotalSales'] = Sales::getTotalSales();


        if(Auth::user()->user_type == 1 || Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'Admin')
        {          
            $data['pendingTasksCount'] = Task::where('status','pending')->orWhere('status', 'in_progress')->count();

            return view('admin.dashboard', $data);    
        }       


        elseif(Auth::user()->user_type == 2 )
        {            
            $data['pendingTasksCount'] = Task::where('assigned_to',Auth::id())->whereIn('status',['pending', 'in_progress'])->count();

            return view('staff.dashboard', $data);
        }


    }





    public function underDevelopment()
    {
        $data['header_title'] = "Under Development";
        return view('under_development');
    }


}
