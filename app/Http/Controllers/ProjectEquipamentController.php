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
    /**
     * @OA\Post(
     *     path="/api/project_equipament/{idProject}/{idEquip}",
     *     summary="Atualizar um objeto",
     *     description="Adiciona um Equipamento a um projeto",
     *     operationId="ProjectEquipamentAdd",
     *     tags={"public"},
     *     @OA\Parameter(
     *         name="idProject",
     *         in="path",
     *         description="ID do Projeto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="idEquip",
     *         in="path",
     *         description="ID do Equipamento",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"quantity"},
     *             @OA\Property(property="quantity", type="integer", example="1")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Exemplo atualizado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/ProjectEquipament")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Exemplo não encontrado"
     *     )
     * )
     */ 
    public  function add(ProjectEquipamentPostRequest $request, $idProject,$idEquip)
    {
        Project::findOrFail($idProject);
        $data = array_merge($request->all());
        $data['project_id'] = $idProject;
        $data['equipament_id'] = $idEquip;
        return Answer::json(ProjectEquipament::create($data), 'Project updated successfully');
    }


    /**
     * @OA\Put(
     *     path="/api/project_equipament/{idProject}/{idEquip}",
     *     summary="Atualizar um objeto",
     *     description="Atualiza um Equipamento a um projeto",
     *     operationId="ProjectEquipamentUpdate",
     *     tags={"public"},
     *     @OA\Parameter(
     *         name="idProject",
     *         in="path",
     *         description="ID do Projeto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="idEquip",
     *         in="path",
     *         description="ID do Equipamento",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"quantity"},
     *             @OA\Property(property="quantity", type="integer", example="1")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Exemplo atualizado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/ProjectEquipament")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Exemplo não encontrado"
     *     )
     * )
     */ 
     public  function update(ProjectEquipamentPutRequest $request, $idProject,$idEquip)
    {
        $prjEquip = ProjectEquipament::where('project_id',$idProject)
        ->where('equipament_id', $idEquip);
        $data = array_merge($request->all());
        return Answer::json($prjEquip->update($data), 'Project updated successfully');
    }

    /**
     * @OA\Delete(
     *     path="/api/project_equipament/{idProject}/{idEquip}",
     *     summary="Deletar um recurso",
     *     description="Deleta um recurso baseado no ID fornecido",
     *     operationId="ProjectEquipamentDelete",
     *     tags={"public"},
     *     @OA\Parameter(
     *         name="idProject",
     *         in="path",
     *         description="ID do Projeto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="idEquip",
     *         in="path",
     *         description="ID do Equipamento",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Recurso deletado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recurso não encontrado"
     *     ),
     * )
     */
    public function destroyEquipament($idProject, $idEquip)
    {
        $p = ProjectEquipament::where('project_id',$idProject)
        ->where('equipament_id', $idEquip)->delete();
        return Answer::json($p, 'Project deleted successfully');
    }    

}
