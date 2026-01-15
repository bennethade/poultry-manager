<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmInventory extends Model
{
    use HasFactory;

    protected $guarded = [];


    static public function getRecord($request = null)
    {
        $return = self::select('farm_inventories.*')
            ->leftJoin('users', 'farm_inventories.staff_id', '=', 'users.id')
            ->leftJoin('users as updated_by', 'farm_inventories.updated_by', '=', 'updated_by.id')
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
                            $q->where('farm_inventories.item_name', 'like', '%' . $word . '%')
                            ->orWhere('farm_inventories.category', 'like', '%' . $word . '%')
                            ->orWhere('farm_inventories.quantity', 'like', '%' . $word . '%')
                            ->orWhere('farm_inventories.cost', 'like', '%' . $word . '%')
                            ->orWhere('farm_inventories.remarks', 'like', '%' . $word . '%')
                            ->orWhere('farm_inventories.status', 'like', '%' . $word . '%')
                            ->orWhere('farm_inventories.source', 'like', '%' . $word . '%')
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

        return $return->orderBy('farm_inventories.created_at', 'desc');
    }



}
