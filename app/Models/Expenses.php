<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Expenses extends Model
{
    use HasFactory;


    
    static public function getRecord($request = null)
    {
        $return = self::select('expenses.*', 'updated_by.name as updated_by_name', 'updated_by.last_name as updated_by_last_name', 'updated_by.other_name as updated_by_other_name')
                        ->leftJoin('users', 'expenses.staff_id', '=', 'users.id')
                        ->leftJoin('users as updated_by', 'expenses.updated_by', '=', 'updated_by.id')
                        ->addSelect('users.name as staff_name')
                        ->addSelect('users.last_name as last_name')
                        ->addSelect('users.other_name as other_name');


                        if ($request !== null) {
                            $searchQuery = trim($request->get('name'));

                            if (!empty($searchQuery)) {
                                $words = preg_split('/\s+/', $searchQuery); // Split by space

                                $return = $return->where(function ($query) use ($words) {
                                    foreach ($words as $word) {
                                        $query->where(function ($q) use ($word) {
                                            $q->where('expenses.category', 'like', '%' . $word . '%')
                                            ->orWhere('expenses.amount', 'like', '%' . $word . '%')
                                            ->orWhere('expenses.payment_method', 'like', '%' . $word . '%')
                                            ->orWhere('expenses.description', 'like', '%' . $word . '%')
                                            ->orWhere('users.name', 'like', '%' . $word . '%')
                                            ->orWhere('users.last_name', 'like', '%' . $word . '%')
                                            ->orWhere('users.other_name', 'like', '%' . $word . '%')
                                            ->orWhere('updated_by.name', 'like', '%' . $word . '%')
                                            ->orWhere('updated_by.last_name', 'like', '%' . $word . '%')
                                            ->orWhere('updated_by.other_name', 'like', '%' . $word . '%');
                                        });
                                    }
                                });
                            }

                        }


                        

                        if (!empty(Request::get('date'))) {
                            $return = $return->where(function ($query) {
                                $query->whereDate('expenses.created_at', Request::get('date'))
                                    ->orWhereDate('expenses.date', Request::get('date'));
                            });
                        }

                        //SEARCH FEATURE ENDS
                        

        $return = $return->orderBy('expenses.created_at', 'desc');

        return $return;
    }




    static public function getTotalExpenses()
    {
        return self::sum('expenses.amount');
    }


    static public function getTotalMonthlyExpenses()
    {
        return self::whereMonth('expenses.created_at', '=', date('m'))
                    ->sum('expenses.amount');
    }

    static public function getTotalTodayExpenses()
    {
        return self::whereDate('expenses.created_at', '=', date('Y-m-d'))
                    ->sum('expenses.amount');
    }


    
}
