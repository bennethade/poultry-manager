<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiseaseIncidence extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'pig_id',
        'symptoms_observed',
        'suspected_disease',
        'action_taken',
        'vet_name',
        'outcome',
        'staff_id',
        'updated_by'
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
