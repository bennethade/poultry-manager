<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrowthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'pig_id',
        'measurement_date',
        'age_in_days',
        'age_in_weeks',
        'weight',
        'feed_type',
        'remarks',
        'staff_id',
        'updated_by',
    ];
    

    public function pig()
    {
        return $this->belongsTo(Pig::class);
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
