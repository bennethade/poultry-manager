<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrowthMoreRecord extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function creator()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }


    public function pig()
    {
        return $this->belongsTo(Pig::class, 'pig_id');
    }



}
