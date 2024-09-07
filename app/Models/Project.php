<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'project';

    protected $fillable = ['client_id','type_installation_id','uf_id'];


    public function uf()
    {   
        return $this->belongsTo('App\Models\Uf','uf_id');
    }
    
    public function client()
    {   
        return $this->belongsTo('App\Models\User','client_id');
    }
    public function type_installation()
    {   
        return $this->belongsTo('App\Models\TypeInstallation','type_installation_id');
    }

     public function equipaments()
    {
        return $this->belongsToMany('App\Models\Equipament', 'project_x_equipament', 'project_id', 'equipament_id')
        ->withPivot('quantity');
    }

}
