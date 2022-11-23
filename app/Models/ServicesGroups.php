<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ServicesGroups extends Model
{
    use HasFactory;

    protected $table = 'services_groups';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

}
