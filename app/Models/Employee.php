<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'id_no',
        'fname',
        'mname',
        'lname',
        'emp_type',
        'address',
        'profile_photo_path',
    ];

    public function user()
    {
       return $this->belongsTo(User::class);
    }
}
