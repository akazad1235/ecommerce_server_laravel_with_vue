<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $fillable =['name', 'email', 'phone', 'address', 'city', 'status', 'password', 'email_verified_at', 'email_verified_code'];
}
