<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceSanitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'activity',
        'chemicals_tools_used',
        'area',
        'remarks',
        'staff_id',
        'updated_by',
    ];


    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }


}
