<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Sales extends Model
{
    use HasFactory;


    static public function getRecord($request = null)
    {
        $return = self::select('sales.*', 'updated_by.name as updated_by_name', 'updated_by.last_name as updated_by_last_name', 'updated_by.other_name as updated_by_other_name')
                        ->leftJoin('users', 'sales.staff_id', '=', 'users.id')
                        ->leftJoin('users as updated_by', 'sales.updated_by', '=', 'updated_by.id')
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
                                            $q->where('sales.item_type', 'like', '%' . $word . '%')
                                            ->orWhere('sales.quantity', 'like', '%' . $word . '%')
                                            ->orWhere('sales.price', 'like', '%' . $word . '%')
                                            ->orWhere('sales.discounted_price', 'like', '%' . $word . '%')
                                            ->orWhere('sales.buyer_name', 'like', '%' . $word . '%')
                                            ->orWhere('sales.buyer_phone', 'like', '%' . $word . '%')
                                            ->orWhere('sales.notes', 'like', '%' . $word . '%')
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
                                $query->whereDate('sales.created_at', Request::get('date'))
                                    ->orWhereDate('sales.date', Request::get('date'));
                            });
                        }

                        //SEARCH FEATURE ENDS
                        

        $return = $return->orderBy('sales.created_at', 'desc');

        return $return;
    }



    static public function getTotalSales()
    {
        return self::sum('sales.price');
    }


    static public function getTotalMonthlySales()
    {
        return self::whereMonth('sales.created_at', '=', date('m'))
                    ->sum('sales.price');
    }

    static public function getTotalTodaySales()
    {
        return self::whereDate('sales.created_at', '=', date('Y-m-d'))
                    ->sum('sales.price');
    }



}
