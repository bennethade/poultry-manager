<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedFormulation extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }


    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }



    static public function getRecord($request = null)
    {
        $return = self::select('feed_formulations.*');

        if ($request !== null) {
            $searchQuery = trim($request->get('name'));

            if (!empty($searchQuery)) {
                $words = preg_split('/\s+/', $searchQuery); // Split by space

                $return = $return->where(function ($query) use ($words) {
                    foreach ($words as $word) {
                        $query->where(function ($q) use ($word) {
                            $q->where('feed_formulations.formulation_date', 'like', '%' . $word . '%')
                            ->orWhere('feed_formulations.feed_stage', 'like', '%' . $word . '%')
                            ->orWhere('feed_formulations.ingredients_used', 'like', '%' . $word . '%')
                            ->orWhere('feed_formulations.quantity', 'like', '%' . $word . '%')
                            ->orWhere('feed_formulations.cost', 'like', '%' . $word . '%')
                            ->orWhere('feed_formulations.total_output', 'like', '%' . $word . '%')
                            ->orWhere('feed_formulations.remarks', 'like', '%' . $word . '%');
                        });
                    }
                });
            }

        }

        return $return->orderBy('feed_formulations.created_at', 'asc');
    }



}
