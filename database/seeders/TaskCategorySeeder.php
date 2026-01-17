<?php

namespace Database\Seeders;

use App\Models\TaskCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::first()?->id;

        $categories = [

            // SALES & FINANCE
            [
                'name' => 'Breeding Record',
                'table_name' => 'breeding_records',
                'form_view' => 'tasks.forms.breeding',
                'upload_path' => '',
                'description' => 'Record breeding information',
                'staff_id' => $userId,
                'updated_by' => $userId,
            ],
            [
                'name' => 'Disease Incidences',
                'table_name' => 'disease_incidences',
                'form_view' => 'tasks.forms.disease_incidences',
                'upload_path' => '',
                'description' => 'Record disease incidences',
                'staff_id' => $userId,
                'updated_by' => $userId,
            ],
            [
                'name' => 'Daily Expense',
                'table_name' => 'expenses',
                'form_view' => 'tasks.forms.expense',
                'upload_path' => 'expenses',
                'description' => 'Record daily farm expenses',
                'staff_id' => $userId,
                'updated_by' => $userId,
            ],
            [
                'name' => 'Daily Farm Activities',
                'table_name' => 'farm_daily_cares',
                'form_view' => 'tasks.forms.farm_daily_cares',
                'upload_path' => 'farm_daily_cares',
                'description' => 'Record Daily Farm Activities',
                'staff_id' => $userId,
                'updated_by' => $userId,
            ],
            
            // FEED MANAGEMENT
            [
                'name' => 'Feed Formulation',
                'table_name' => 'feed_formulations',
                'form_view' => 'tasks.forms.feed_formulation',
                'upload_path' => '',
                'description' => 'Record feed mixing and formulation',
                'staff_id' => $userId,
                'updated_by' => $userId,
            ],
            
            [
                'name' => 'Feed Stock',
                'table_name' => 'feed_stocks',
                'form_view' => 'tasks.forms.feed_stock',
                'upload_path' => 'feed_stock',
                'description' => 'Record feed received into store',
                'staff_id' => $userId,
                'updated_by' => $userId,
            ],
            [
                'name' => 'Feed Usage',
                'table_name' => 'feed_usages',
                'form_view' => 'tasks.forms.feed_usage',
                'upload_path' => '',
                'description' => 'Record daily feed usage',
                'staff_id' => $userId,
                'updated_by' => $userId,
            ],

            // HEALTH MANAGEMENT
            [
                'name' => 'Growth Records',
                'table_name' => 'growth_records',
                'form_view' => 'tasks.forms.growth_records',
                'upload_path' => '',
                'description' => 'Record animal growth and weight',
                'staff_id' => $userId,
                'updated_by' => $userId,
            ],
            [
                'name' => 'Maintenance & Sanitations',
                'table_name' => 'maintenance_sanitations',
                'form_view' => 'tasks.forms.maintenance_sanitations',
                'upload_path' => '',
                'description' => 'Record cleaning, repairs, and sanitation',
                'staff_id' => $userId,
                'updated_by' => $userId,
            ],
            [
                'name' => 'Medication & Treatment',
                'table_name' => 'medication_treatments',
                'form_view' => 'tasks.forms.medication_treatments',
                'upload_path' => '',
                'description' => 'Record medication and treatment',
                'staff_id' => $userId,
                'updated_by' => $userId,
            ],
            [
                'name' => 'Monthly Expenses',
                'table_name' => 'monthly_expenses',
                'form_view' => 'tasks.forms.monthly_expenses',
                'upload_path' => '',
                'description' => 'Record monthly farm expenses',
                'staff_id' => $userId,
                'updated_by' => $userId,
            ],

            // FARM OPERATIONS
            [
                'name' => 'Monthly Sales',
                'table_name' => 'monthly_sales',
                'form_view' => 'tasks.forms.monthly_sales',
                'upload_path' => '',
                'description' => 'Record Monthly Sales',
                'staff_id' => $userId,
                'updated_by' => $userId,
            ],
            [
                'name' => 'Pig Identification',
                'table_name' => 'pigs',
                'form_view' => 'tasks.forms.pigs',
                'upload_path' => '',
                'description' => 'Record Pig Identification Details',
                'staff_id' => $userId,
                'updated_by' => $userId,
            ],

            // ANIMAL MANAGEMENT
            [
                'name' => 'Sales',
                'table_name' => 'sales',
                'form_view' => 'tasks.forms.sales',
                'upload_path' => 'sales',
                'description' => 'Record sales details',
                'staff_id' => $userId,
                'updated_by' => $userId,
            ],
            [
                'name' => 'Vaccine Logs',
                'table_name' => 'vaccine_logs',
                'form_view' => 'tasks.forms.vaccine_logs',
                'upload_path' => '',
                'description' => 'Record vaccine administration details',
                'staff_id' => $userId,
                'updated_by' => $userId,
            ],
            [
                'name' => 'Vaccine Schedules',
                'table_name' => 'vaccine_schedules',
                'form_view' => 'tasks.forms.vaccine_schedules',
                'upload_path' => '',
                'description' => 'Record vaccine schedules',
                'staff_id' => $userId,
                'updated_by' => $userId,
            ],
            [
                'name' => 'Farm Inventory',
                'table_name' => 'farm_inventories',
                'form_view' => 'tasks.forms.farm_inventories',
                'upload_path' => 'farm_inventory',
                'description' => 'Farm Inventory record',
                'staff_id' => $userId,
                'updated_by' => $userId,
            ],
        ];

        foreach ($categories as $category) {
            TaskCategory::updateOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
