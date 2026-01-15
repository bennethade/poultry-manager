<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'assigned_to',
        'priority',
        'due_date',
        'status',
        'completed_at',
        'completed_by',
        'staff_id',
        'updated_by',
    ];


    public function category() {
        return $this->belongsTo(TaskCategory::class);
    }

    public function payload() {
        return $this->hasOne(TaskPayload::class);
    }

    public function assignee() {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assignedUser() {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function creator() {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function editor() {
        return $this->belongsTo(User::class, 'updated_by');
    }


    public function completer() {
        return $this->belongsTo(User::class, 'completed_by');
    }

}
