<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedStock extends Model
{
    use HasFactory;


    static public function getRecord($request = null)
    {
        $return = self::select('feed_stocks.*')
            ->leftJoin('users', 'feed_stocks.staff_id', '=', 'users.id')
            ->leftJoin('users as updated_by', 'feed_stocks.updated_by', '=', 'updated_by.id')
            ->addSelect('users.name as staff_name')
            ->addSelect('users.last_name as last_name')
            ->addSelect('users.other_name as other_name')
            ->addSelect('updated_by.name as updated_by_name')
            ->addSelect('updated_by.last_name as updated_by_last_name')
            ->addSelect('updated_by.other_name as updated_by_other_name');

        if ($request !== null) {
            $searchQuery = trim($request->get('name'));

            if (!empty($searchQuery)) {
                $words = preg_split('/\s+/', $searchQuery); // Split by space

                $return = $return->where(function ($query) use ($words) {
                    foreach ($words as $word) {
                        $query->where(function ($q) use ($word) {
                            $q->where('feed_stocks.feed_type', 'like', '%' . $word . '%')
                            ->orWhere('feed_stocks.feed_material', 'like', '%' . $word . '%')
                            ->orWhere('feed_stocks.quantity_received', 'like', '%' . $word . '%')
                            ->orWhere('feed_stocks.supplier', 'like', '%' . $word . '%')
                            ->orWhere('feed_stocks.cost', 'like', '%' . $word . '%')
                            ->orWhere('feed_stocks.remaining_stock', 'like', '%' . $word . '%')
                            ->orWhere('feed_stocks.notes', 'like', '%' . $word . '%')
                            ->orWhere('users.name', 'like', '%' . $word . '%')
                            ->orWhere('users.last_name', 'like', '%' . $word . '%')
                            ->orWhere('users.other_name', 'like', '%' . $word . '%')
                            ->orWhere('updated_by.name', 'like', '%' . $word . '%')
                            ->orWhere('updated_by.last_name', 'like', '%' . $word . '%')
                            ->orWhere('updated_by.other_name', 'like', '%' . $word . '% ');
                        });
                    }
                });
            }

        }

        return $return->orderBy('feed_stocks.created_at', 'desc');
    }



}
