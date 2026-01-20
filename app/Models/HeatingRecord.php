<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeatingRecord extends Model
{
    use HasFactory;


    public function pig()
    {
        return $this->belongsTo(Pig::class, 'pig_id');
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
