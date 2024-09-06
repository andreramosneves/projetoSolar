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

    /**
     * @OA\Get(
     *     path="/api/project",
     *     summary="Retornar uma lista de projetos paginada",
     *     description="Retornar uma lista de projetos paginada",
     *     operationId="projectList",
     *     tags={"public"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de exemplos retornada com sucesso",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Project"))
     *     )
     * )
     */
    /*Essa foi um tipo de construção Where que fiz há um tempo, o ideal e fazer os joins, e de acordo com o que passado nos parametros, a função construi a consulta sozinha, como não é especificado os filtros, deixei somente acesso a tabela base do Project, caso quisesse filtrar por equipamento também funcionaria, porém teria que fazer o join.*/
    public function list(Request $request)
    {
        $projetos = Project::select(['*']);
        $projetos = Utils::buildWhere($projetos,$request);
        $projetos = $projetos->paginate(10);
        return Answer::json($projetos, 'Project listed successfully');
    }



    /**
     * @OA\Get(
     *     path="/api/project/{id}",
     *     summary="Retornar o projeto e seus respecitvos itens de forma detalhada",
     *     description="Retornar o projeto e seus respecitvos itens de forma detalhada",
     *     operationId="projectDetail",
     *     tags={"public"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do Projeto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de exemplos retornada com sucesso",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Project"))
     *     )
     * )
     */
    public function detail($id)
    {
        $prj = Project::findOrFail($id);
        $prj['uf'] = $prj->uf;
        $prj['type_installation'] = $prj->type_installation;
        $prj['client'] = $prj->client;
        $prj['equipaments'] = $prj->equipaments;
        return Answer::json($prj, 'Project listed successfully');
    }

    /**
     * @OA\Post(
     *     path="/api/project",
     *     summary="Inseri um objeto",
     *     description="Cria um novo recurso no banco de dados",
     *     operationId="ProjectStore",
     *     tags={"public"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"client_id","type_installation_id","uf_id","equipament"},
     *             @OA\Property(property="client_id", type="id", example="1"),
     *             @OA\Property(property="type_installation_id", type="string", example="2"),
     *             @OA\Property(property="uf_id", type="string", example="1"),
     *             @OA\Property(property="equipament", type="array", @OA\Items(ref="#/components/schemas/ProjectEquipament")),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Exemplo criado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Project")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro de validação"
     *     )
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/project/{id}",
     *     summary="Deletar um recurso",
     *     description="Deleta um recurso baseado no ID fornecido",
     *     operationId="projectDelete",
     *     tags={"public"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do recurso que será deletado",
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
    public function destroy($id)
    {
        Project::findOrFail($id);
        $p = ProjectEquipament::where('project_id',$id)->delete();
        Project::findOrFail($id)->delete();
        return Answer::json([], 'Project deleted successfully');
    }    





}
