<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RoleUsers extends Model
{
    use HasFactory;

    protected $table = 'role_users';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'role_id']; /* The attributes that are mass assignable. @var array<int, string> */

}
