<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicationTreatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'pig_id',
        'date',
        'drug_name',
        'dosage',
        'duration',
        'next_due_date',
        'administered_by',
        'remarks',
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
