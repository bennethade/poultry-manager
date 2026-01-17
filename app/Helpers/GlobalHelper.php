<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

// Check if the user is logged in and approved (status = 0) unless they are in excluded roles
if (!function_exists('isApprovedUser')) {
    function isApprovedUser()
    {
        $user = Auth::user();

        if (!$user) {
            return false; // not logged in
        }

        $excludedRoles = ['Admin', 'Super Admin', 'School Admin', '1'];

        if (in_array($user->user_type, $excludedRoles)) {
            return $user; // return the user model (no status check)
        }

        // For all other users: must have status = 0
        return User::where('id', $user->id)
                   ->where('status', 0)  // 0 = Active
                   ->first();
    }
}


//Get the list of pending tasks for the logged in user
if (!function_exists('getUserPendingTasks')) {
    function getUserPendingTasks()
    {
        $user = Auth::user();

        if (!$user) {
            return 0; // not logged in
        }

        // return \App\Models\Task::where('assigned_to', $user->id)
        return \App\Models\Task::whereIn('status',['pending', 'in_progress'])
                               ->count();
    }
}


//Get all pending and inprogress tasks for admin view
if (!function_exists('getAllPendingTasks')) {
    function getAllPendingTasks()
    {
        $user = Auth::user();

        if (!$user) {
            return collect(); // not logged in, return empty collection
        }

        return \App\Models\Task::whereIn('status', ['pending', 'in_progress']) // include both pending and in-progress tasks
                               ->count();
    }
}
