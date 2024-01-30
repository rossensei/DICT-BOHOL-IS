<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function edit()
    {
        $authenticatedUser = Auth::user();

        $userInfo = Employee::where('user_id', $authenticatedUser->id)
            ->select('id', 'id_no', 'fname', 'mname', 'lname', 'emp_type', 'address', 'profile_photo_path')
            ->first();
            
        $credentials = User::where('id', $authenticatedUser->id)
            ->select('id', 'username')
            ->first();
        
        return inertia('CustomProfile/Edit', [
            'userInfo' => $userInfo,
            'credentials' => $credentials
        ]);
    }
}
