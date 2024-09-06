<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Answer;
use App\Helpers\Utils;

use App\Models\Project;
use App\Models\ProjectEquipament;


use App\Http\Requests\ProjectPostRequest;



class ProjectController extends Controller
{
    //

    /*Essa foi um tipo de construção Where que fiz há um tempo, o ideal e fazer os joins, e de acordo com o que passado nos parametros, a função construi a consulta sozinha, como não é especificado os filtros, deixei somente acesso a tabela base do Project, caso quisesse filtrar por equipamento também funcionaria, porém teria que fazer o join.*/
    public function list(Request $request)
    {
        $projetos = Project::select(['*']);
        $projetos = Utils::buildWhere($projetos,$request);
        $projetos = $projetos->paginate(10);
        return Answer::json($projetos, 'Project listed successfully');
    }

    public function detail($id)
    {
        $prj = Project::findOrFail($id);
        $prj['uf'] = $prj->uf;
        $prj['type_installation'] = $prj->type_installation;
        $prj['client'] = $prj->client;
        $prj['equipaments'] = $prj->equipaments;
        return Answer::json($prj, 'Project listed successfully');
    }

    public function save(ProjectPostRequest $request)
    {   
        $o_prj = $request->all();
        unset($o_prj['equipament']);

        $project = (Project::create($o_prj));
        $data_item = [];
        $item = [];
        
        foreach ($request['equipament'] as $item) {
            $data_item['equipament_id'] = $item['id'];
            $data_item['quantity'] = $item['quantity'];
            $data_item['project_id'] = $project->id;
            $item = ProjectEquipament::create($data_item);
        }
        

        return Answer::json($project, 'Project saved successfully');
    }

    public function destroy($id)
    {
        Project::findOrFail($id);
        $p = ProjectEquipament::where('project_id',$id)->delete();
        Project::findOrFail($id)->delete();
        return Answer::json([], 'Project deleted successfully');
    }    





}
