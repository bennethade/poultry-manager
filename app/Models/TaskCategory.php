<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name','table_name','form_view'];

    public function tasks() {
        return $this->hasMany(Task::class);
    }

    public function staff() {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function editor() {
        return $this->belongsTo(User::class, 'updated_by');
    }


    


}
