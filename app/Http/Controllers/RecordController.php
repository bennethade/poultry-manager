<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RecordController extends Controller
{
    public function index(Request $request)
    {
        $selectedDate = $request->input('date')
            ? Carbon::parse($request->input('date'))->endOfDay()
            : Carbon::now()->endOfDay();

        $startDate = (clone $selectedDate)->subDays(6)->startOfDay();

        // SALES
        $sales = DB::table('sales')
            ->select(
                'id',
                DB::raw("'sale' as record_type"),
                'item_type as title',
                'quantity',
                'price as amount',
                'buyer_name as party',
                'notes',
                'date',
                'created_at'
            )
            ->whereBetween('created_at', [$startDate, $selectedDate]);

        // EXPENSES
        $expenses = DB::table('expenses')
            ->select(
                'id',
                DB::raw("'expense' as record_type"),
                'category as title',
                DB::raw("NULL as quantity"),
                'amount',
                'payment_method as party',
                'description as notes',
                'date',
                'created_at'
            )
            ->whereBetween('created_at', [$startDate, $selectedDate]);

        // FARM RECORDS
        $farmRecords = DB::table('farm_records')
            ->select(
                'id',
                DB::raw("'farm_record' as record_type"),
                'activity_title as title',
                DB::raw("NULL as quantity"),
                DB::raw("0 as amount"),
                'activity_type as party',
                'notes',
                'date',
                'created_at'
            )
            ->whereBetween('created_at', [$startDate, $selectedDate]);

        // FARM DAILY CARES
        $farmDailyCares = DB::table('farm_daily_cares')
            ->select(
                'id',
                DB::raw("'farm_daily_care' as record_type"),
                'care_type as title',
                'quantity',
                DB::raw("0 as amount"),
                'house_or_unit as party',
                'notes',
                'date',
                'created_at'
            )
            ->whereBetween('created_at', [$startDate, $selectedDate]);

        // UNION ALL
        $records = $sales
            ->unionAll($expenses)
            ->unionAll($farmRecords)
            ->unionAll($farmDailyCares)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.records.index', compact('records', 'startDate', 'selectedDate'));
    }
}
