<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Pig extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($pig) {
    //         $pig->tag_id = str_pad($pig->id, 4, '0', STR_PAD_LEFT);
    //         $pig->save();
    //     });
    // }


    protected static function boot()
    {
        parent::boot();

        static::created(function ($pig) {

            // Prefix based on sex
            $prefix = $pig->sex === 'Female' ? 'S' : 'B';

            // Get the highest numeric part used so far
            $lastNumber = DB::table('pigs')
                ->whereNotNull('tag_id')
                ->where('tag_id', '!=', '')
                ->selectRaw('MAX(CAST(SUBSTRING(tag_id, 2) AS UNSIGNED)) as max_number')
                ->value('max_number');

            $nextNumber = str_pad(($lastNumber ?? 0) + 1, 4, '0', STR_PAD_LEFT);

            $pig->updateQuietly([
                'tag_id' => $prefix . $nextNumber
            ]);
        });
    }



    public function sow()
    {
        return $this->hasMany(BreedingRecord::class, 'sow_id');
    }

    public function boar()
    {
        return $this->hasMany(BreedingRecord::class, 'boar_id');
    }
    

    static public function getRecord($request = null)
    {
        $return = self::select('pigs.*', 'updated_by.name as updated_by_name', 'updated_by.last_name as updated_by_last_name', 'updated_by.other_name as updated_by_other_name')
            ->leftJoin('users', 'pigs.staff_id', '=', 'users.id')
            ->leftJoin('users as updated_by', 'pigs.updated_by', '=', 'updated_by.id')
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
                            $q->where('pigs.tag_id', 'like', '%' . $word . '%')
                            ->orWhere('pigs.breed', 'like', '%' . $word . '%')
                            ->orWhere('pigs.source', 'like', '%' . $word . '%')
                            ->orWhere('pigs.stage', 'like', '%' . $word . '%')
                            ->orWhere('pigs.sex', 'like', '%' . $word . '%')
                            ->orWhere('pigs.status', 'like', '%' . $word . '%')
                            ->orWhere('pigs.production_stage', 'like', '%' . $word . '%')
                            ->orWhere('pigs.remarks', 'like', '%' . $word . '%')
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

        return $return
            ->where('pigs.status', true)
            ->orderBy('pigs.created_at', 'desc');
    }



    static public function getInactiveRecord($request = null)
    {
        $return = self::select('pigs.*', 'updated_by.name as updated_by_name', 'updated_by.last_name as updated_by_last_name', 'updated_by.other_name as updated_by_other_name')
            ->leftJoin('users', 'pigs.staff_id', '=', 'users.id')
            ->leftJoin('users as updated_by', 'pigs.updated_by', '=', 'updated_by.id')
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
                            $q->where('pigs.tag_id', 'like', '%' . $word . '%')
                            ->orWhere('pigs.breed', 'like', '%' . $word . '%')
                            ->orWhere('pigs.source', 'like', '%' . $word . '%')
                            ->orWhere('pigs.stage', 'like', '%' . $word . '%')
                            ->orWhere('pigs.sex', 'like', '%' . $word . '%')
                            // ->orWhere('pigs.status', 'like', '%' . $word . '%')
                            ->orWhere('pigs.production_stage', 'like', '%' . $word . '%')
                            ->orWhere('pigs.remarks', 'like', '%' . $word . '%')
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

        return $return
            ->where('pigs.status', false)
            ->orderBy('pigs.tag_id', 'asc');
    }


    public function growthRecords()
    {
        return $this->hasMany(GrowthRecord::class);
    }




}
