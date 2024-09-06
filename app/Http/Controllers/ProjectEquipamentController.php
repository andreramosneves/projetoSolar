<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Answer;
use App\Models\ProjectEquipament;
use App\Models\Project;

use App\Http\Requests\ProjectEquipamentPutRequest;
use App\Http\Requests\ProjectEquipamentPostRequest;

class ProjectEquipamentController extends Controller
{
    //
    public  function add(ProjectEquipamentPostRequest $request, $idProject,$idEquip)
    {
        Project::findOrFail($idProject);
        $data = array_merge($request->all());
        $data['project_id'] = $idProject;
        $data['equipament_id'] = $idEquip;
        return Answer::json(ProjectEquipament::create($data), 'Project updated successfully');
    }


    public  function update(ProjectEquipamentPutRequest $request, $idProject,$idEquip)
    {
        $prjEquip = ProjectEquipament::where('project_id',$idProject)
        ->where('equipament_id', $idEquip);
        $data = array_merge($request->all());
        return Answer::json($prjEquip->update($data), 'Project updated successfully');
    }


    public function destroyEquipament($idProject, $idEquip)
    {
        $p = ProjectEquipament::where('project_id',$idProject)
        ->where('equipament_id', $idEquip)->delete();
        return Answer::json($p, 'Project deleted successfully');
    }    

}
