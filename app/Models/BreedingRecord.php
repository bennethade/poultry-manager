<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreedingRecord extends Model
{
    use HasFactory;

    public function sow()
    {
        return $this->belongsTo(Pig::class, 'sow_id');
    }

    public function boar()
    {
        return $this->belongsTo(Pig::class, 'boar_id');
    }


    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
