<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function list()
    {
        
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek   = Carbon::now()->endOfWeek();
        $lastWeekStart = Carbon::now()->subWeek()->startOfWeek();
        $lastWeekEnd   = Carbon::now()->subWeek()->endOfWeek();
        $thisMonth = Carbon::now()->month;
        $thisYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth()->month;
        $lastMonthYear = Carbon::now()->subMonth()->year;

        $data['today_expense'] = DB::table('expenses')
            ->whereDate('created_at', $today)
            ->sum('amount');

        $data['today_sales'] = DB::table('sales')
            ->whereDate('created_at', $today)
            ->sum('price');

        $data['yesterday_expense'] = DB::table('expenses')
            ->whereDate('created_at', $yesterday)
            ->sum('amount');

        $data['yesterday_sales'] = DB::table('sales')
            ->whereDate('created_at', $yesterday)
            ->sum('price');


        $data['week_expense'] = DB::table('expenses')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->sum('amount');

        $data['week_sales'] = DB::table('sales')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->sum('price');

        $data['last_week_expense'] = DB::table('expenses')
            ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->sum('amount');

        $data['last_week_sales'] = DB::table('sales')
            ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->sum('price');


        $data['month_expense'] = DB::table('expenses')
            ->whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)
            ->sum('amount');

        $data['month_sales'] = DB::table('sales')
            ->whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)
            ->sum('price');

        $data['last_month_expense'] = DB::table('expenses')
            ->whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $lastMonthYear)
            ->sum('amount');

        $data['last_month_sales'] = DB::table('sales')
            ->whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $lastMonthYear)
            ->sum('price');

        $data['total_expense'] = DB::table('expenses')->sum('amount');
        $data['total_sales'] = DB::table('sales')->sum('price');


        $data['header_title'] = 'Reports';

        if(Auth::user()->user_type == 2)
        {
            return view('staff.report.list', $data);
        }
        else{
            return view('admin.report.list', $data);
        }
    }




}
