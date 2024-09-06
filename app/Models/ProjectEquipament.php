<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectEquipament extends Model
{
    use HasFactory;

    protected $table = 'project_x_equipament';

    protected $fillable = ['quantity','project_id','equipament_id'];

}
