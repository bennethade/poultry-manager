<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WeeklyRecordController extends Controller
{
    public function view(Request $request)
    {
        // DATE RANGE
        $startDateInput = $request->input('start_date');
        $endDateInput = $request->input('end_date');

        if ($startDateInput && $endDateInput) {
            $startDate = Carbon::parse($startDateInput)->startOfDay();
            $endDate = Carbon::parse($endDateInput)->endOfDay();
        } else {
            $endDate = Carbon::now()->endOfDay();
            $startDate = (clone $endDate)->subDays(6)->startOfDay();
        }

        // ---------- ORIGINAL TABLES ----------
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
                'created_at',
                DB::raw("NULL as extra_1"),
                DB::raw("NULL as extra_2"),
                DB::raw("NULL as extra_3"),
                DB::raw("NULL as extra_4")
            )
            ->whereBetween('created_at', [$startDate, $endDate]);

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
                'created_at',
                DB::raw("NULL as extra_1"),
                DB::raw("NULL as extra_2"),
                DB::raw("NULL as extra_3"),
                DB::raw("NULL as extra_4")
            )
            ->whereBetween('created_at', [$startDate, $endDate]);

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
                'created_at',
                DB::raw("NULL as extra_1"),
                DB::raw("NULL as extra_2"),
                DB::raw("NULL as extra_3"),
                DB::raw("NULL as extra_4")
            )
            ->whereBetween('created_at', [$startDate, $endDate]);

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
                'created_at',
                DB::raw("NULL as extra_1"),
                DB::raw("NULL as extra_2"),
                DB::raw("NULL as extra_3"),
                DB::raw("NULL as extra_4")
            )
            ->whereBetween('created_at', [$startDate, $endDate]);

        // ---------- NEW TABLES ----------

        $farmInventories = DB::table('farm_inventories')
            ->select(
                'id',
                DB::raw("'farm_inventory' as record_type"),
                'item_name as title',
                'quantity',
                'cost as amount',
                'category as party',
                'remarks as notes',
                'date',
                'created_at',
                'source as extra_1',
                'status as extra_2',
                DB::raw("NULL as extra_3"),
                DB::raw("NULL as extra_4")
            )
            ->whereBetween('created_at', [$startDate, $endDate]);


        $pigs = DB::table('pigs')
            ->select(
                'id',
                DB::raw("'pig' as record_type"),
                'tag_id as title',
                DB::raw("NULL as quantity"),
                'current_weight as amount',
                'status as party',
                'remarks as notes',
                'date_entry as date',
                'created_at',
                'dob as extra_1',
                'initial_weight as extra_2',
                'sex as extra_3',
                'source as extra_4'
            )
            ->whereBetween('created_at', [$startDate, $endDate]);

        $breeding = DB::table('breeding_records')
            ->select(
                'id',
                DB::raw("'breeding_record' as record_type"),
                'type as title',
                'number_of_born_alive as quantity',
                DB::raw("0 as amount"),
                DB::raw("CONCAT('Sow ID:', sow_id, ', Boar ID:', boar_id) as party"),
                'remarks as notes',
                'expected_farrow_date as date',
                'created_at',
                'actual_farrow_date as extra_1',
                'number_of_stillborn as extra_2',
                DB::raw("NULL as extra_3"),
                DB::raw("NULL as extra_4")
            )
            ->whereBetween('created_at', [$startDate, $endDate]);

        $growth = DB::table('growth_records')
            ->select(
                'id',
                DB::raw("'growth_record' as record_type"),
                'pig_id as title',
                'age_in_days as quantity',
                'weight as amount',
                'feed_type as party',
                'remarks as notes',
                'measurement_date as date',
                'created_at',
                'age_in_weeks as extra_1',
                DB::raw("NULL as extra_2"),
                DB::raw("NULL as extra_3"),
                DB::raw("NULL as extra_4")
            )
            ->whereBetween('created_at', [$startDate, $endDate]);

        $feedStocks = DB::table('feed_stocks')
            ->select(
                'id',
                DB::raw("'feed_stock' as record_type"),
                'feed_type as title',
                'quantity_received as quantity',
                'cost as amount',
                'supplier as party',
                'notes',
                'received_date as date',
                'created_at',
                'remaining_stock as extra_1',
                DB::raw("NULL as extra_2"),
                DB::raw("NULL as extra_3"),
                DB::raw("NULL as extra_4")
            )
            ->whereBetween('created_at', [$startDate, $endDate]);

        $feedUsages = DB::table('feed_usages')
            ->select(
                'id',
                DB::raw("'feed_usage' as record_type"),
                'feed_type as title',
                'quantity_fed as quantity',
                DB::raw("0 as amount"),
                'time_of_day as party',
                'remarks as notes',
                'feeding_date as date',
                'created_at',
                DB::raw("NULL as extra_1"),
                DB::raw("NULL as extra_2"),
                DB::raw("NULL as extra_3"),
                DB::raw("NULL as extra_4")
            )
            ->whereBetween('created_at', [$startDate, $endDate]);

        $feedFormulations = DB::table('feed_formulations')
            ->select(
                'id',
                DB::raw("'feed_formulation' as record_type"),
                'feed_stage as title',
                'quantity as quantity',
                'cost as amount',
                'ingredients_used as party',
                'remarks as notes',
                'formulation_date as date',
                'created_at',
                'total_output as extra_1',
                DB::raw("NULL as extra_2"),
                DB::raw("NULL as extra_3"),
                DB::raw("NULL as extra_4")
            )
            ->whereBetween('created_at', [$startDate, $endDate]);

        $monthlyExpenses = DB::table('monthly_expenses')
            ->select(
                'id',
                DB::raw("'monthly_expense' as record_type"),
                DB::raw("CONCAT(MONTHNAME(STR_TO_DATE(month, '%m')), ' ', year) as title"),
                'opening_balance as quantity',
                'total_spent as amount',
                'closing_balance as party',
                'remarks as notes',
                DB::raw("STR_TO_DATE(CONCAT(year,'-',month,'-01'), '%Y-%m-%d') as date"),
                'created_at',
                DB::raw("NULL as extra_1"),
                DB::raw("NULL as extra_2"),
                DB::raw("NULL as extra_3"),
                DB::raw("NULL as extra_4")
            )
            ->whereBetween('created_at', [$startDate, $endDate]);

        $monthlySales = DB::table('monthly_sales')
            ->select(
                'id',
                DB::raw("'monthly_sale' as record_type"),
                DB::raw("CONCAT(MONTHNAME(STR_TO_DATE(month, '%m')), ' ', year) as title"),
                'total_sales as quantity',
                'gross_profit as amount',
                'total_expense as party',
                'remarks as notes',
                DB::raw("STR_TO_DATE(CONCAT(year,'-',month,'-01'), '%Y-%m-%d') as date"),
                'created_at',
                DB::raw("NULL as extra_1"),
                DB::raw("NULL as extra_2"),
                DB::raw("NULL as extra_3"),
                DB::raw("NULL as extra_4")
            )
            ->whereBetween('created_at', [$startDate, $endDate]);

        $maintenance = DB::table('maintenance_sanitations')
            ->select(
                'id',
                DB::raw("'maintenance' as record_type"),
                'activity as title',
                DB::raw("NULL as quantity"),
                DB::raw("0 as amount"),
                'area as party',
                'remarks as notes',
                'date',
                'created_at',
                'chemicals_tools_used as extra_1',
                DB::raw("NULL as extra_2"),
                DB::raw("NULL as extra_3"),
                DB::raw("NULL as extra_4")
            )
            ->whereBetween('created_at', [$startDate, $endDate]);

        $diseaseIncidences = DB::table('disease_incidences')
            ->select(
                'id',
                DB::raw("'disease_incidence' as record_type"),
                'suspected_disease as title',
                DB::raw("NULL as quantity"),
                DB::raw("0 as amount"),
                'action_taken as party',
                'symptoms_observed as notes',
                'date',
                'created_at',
                'vet_name as extra_1',
                'outcome as extra_2',
                DB::raw("NULL as extra_3"),
                DB::raw("NULL as extra_4")
            )
            ->whereBetween('created_at', [$startDate, $endDate]);

        $medication = DB::table('medication_treatments')
            ->select(
                'id',
                DB::raw("'medication' as record_type"),
                'drug_name as title',
                DB::raw("NULL as quantity"),
                DB::raw("0 as amount"),
                'administered_by as party',
                'remarks as notes',
                'date',
                'created_at',
                'dosage as extra_1',
                'duration as extra_2',
                DB::raw("NULL as extra_3"),
                DB::raw("NULL as extra_4")
            )
            ->whereBetween('created_at', [$startDate, $endDate]);

        $vaccineSchedules = DB::table('vaccine_schedules')
            ->select(
                'id',
                DB::raw("'vaccine_schedule' as record_type"),
                'vaccine_name as title',
                DB::raw("NULL as quantity"),
                DB::raw("0 as amount"),
                'administered_by as party',
                'remarks as notes',
                'date_given as date',
                'created_at',
                'age_given as extra_1',
                'next_due_date as extra_2',
                DB::raw("NULL as extra_3"),
                DB::raw("NULL as extra_4")
            )
            ->whereBetween('created_at', [$startDate, $endDate]);

        $vaccineLogs = DB::table('vaccine_logs')
            ->select(
                'id',
                DB::raw("'vaccine_log' as record_type"),
                'vaccine_name as title',
                'no_of_pigs_vaccinated as quantity',
                DB::raw("0 as amount"),
                'batch_no as party',
                'remarks as notes',
                'date as date',
                'created_at',
                'expiry_date as extra_1',
                'vet_name as extra_2',
                DB::raw("NULL as extra_3"),
                DB::raw("NULL as extra_4")
            )
            ->whereBetween('created_at', [$startDate, $endDate]);

        $heatingRecords = DB::table('heating_records')
    ->join('pigs', 'pigs.id', '=', 'heating_records.pig_id')
    ->join('users as staff', 'staff.id', '=', 'heating_records.staff_id')
    ->select(
        'heating_records.id', // ✅ COLUMN 1
        DB::raw("'heating_record' as record_type"), // ✅ COLUMN 2
        DB::raw("CONCAT('Heating - Pig ', pigs.tag_id) as title"), // 3
        DB::raw("NULL as quantity"), // 4
        DB::raw("0 as amount"), // 5
        DB::raw("staff.name as party"), // 6
        DB::raw("
            CONCAT(
                IFNULL(heating_records.measurement_detail, ''),
                CASE 
                    WHEN heating_records.observation IS NOT NULL 
                    THEN CONCAT(' || Observation: ', heating_records.observation)
                    ELSE ''
                END,
                CASE 
                    WHEN heating_records.remarks IS NOT NULL 
                    THEN CONCAT(' || Remarks: ', heating_records.remarks)
                    ELSE ''
                END
            )
        as notes"), // 7
        'heating_records.date as date', // 8
        'heating_records.created_at', // ✅ COLUMN 9
        'pigs.tag_id as extra_1', // 10
        DB::raw("NULL as extra_2"), // 11
        DB::raw("NULL as extra_3"), // 12
        DB::raw("NULL as extra_4")  // 13
    )
    ->whereBetween('heating_records.created_at', [$startDate, $endDate]);



        // ---------- UNION ALL ----------
        $records = $sales
            ->unionAll($expenses)
            ->unionAll($farmRecords)
            ->unionAll($farmDailyCares)
            ->unionAll($farmInventories)
            ->unionAll($pigs)
            ->unionAll($breeding)
            ->unionAll($growth)
            ->unionAll($feedStocks)
            ->unionAll($feedUsages)
            ->unionAll($feedFormulations)
            ->unionAll($monthlyExpenses)
            ->unionAll($monthlySales)
            ->unionAll($maintenance)
            ->unionAll($diseaseIncidences)
            ->unionAll($medication)
            ->unionAll($vaccineSchedules)
            ->unionAll($vaccineLogs)
            ->unionAll($heatingRecords) // ✅ NEW
            ->orderBy('created_at', 'desc')
            ->get();



        $data['header_title'] = "Quick Records";

        if(Auth::user()->user_type === 2)
        {
            return view('staff.records.index', compact('records','startDate','endDate','startDateInput','endDateInput'), $data);
        }
        else{
            return view('admin.records.index', compact('records','startDate','endDate','startDateInput','endDateInput'), $data);
        }
    
    }


}
