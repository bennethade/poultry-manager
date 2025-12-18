<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;


class Miscellaneous extends Model
{
    use HasFactory;


    static public function getRecord($request = null)
    {
        $return = self::select('miscellaneouses.*', 'updated_by.name as updated_by_name', 'updated_by.last_name as updated_by_last_name', 'updated_by.other_name as updated_by_other_name')
                        ->leftJoin('users', 'miscellaneouses.staff_id', '=', 'users.id')
                        ->leftJoin('users as updated_by', 'miscellaneouses.updated_by', '=', 'updated_by.id')
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
                                            $q->where('miscellaneouses.title', 'like', '%' . $word . '%')
                                            ->orWhere('miscellaneouses.category', 'like', '%' . $word . '%')
                                            ->orWhere('miscellaneouses.value', 'like', '%' . $word . '%')
                                            ->orWhere('miscellaneouses.description', 'like', '%' . $word . '%')
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


                        //SEARCH FEATURE STARTS
                        // if(!empty(Request::get('name')))
                        // {
                        //     $return = $return->where('miscellaneouses.category', 'like', '%' . Request::get('name'). '%');
                        // }
                        

                        // if(!empty(Request::get('date')))
                        // {
                        //     $return = $return->whereDate('miscellaneouses.created_at', '=', Request::get('date'));
                        // }

                        if (!empty(Request::get('date'))) {
                            $return = $return->where(function ($query) {
                                $query->whereDate('miscellaneouses.created_at', Request::get('date'))
                                    ->orWhereDate('miscellaneouses.date', Request::get('date'));
                            });
                        }

                        //SEARCH FEATURE ENDS
                        

        $return = $return->orderBy('miscellaneouses.created_at', 'desc');

        return $return;
    }



}
