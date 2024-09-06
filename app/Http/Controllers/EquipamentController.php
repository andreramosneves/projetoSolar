<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Answer;
use App\Models\Equipament;

use App\Http\Requests\EquipamentPostRequest;


class EquipamentController extends Controller
{
    //

    /**
     * @OA\Get(
     *     path="/api/equipament",
     *     summary="Retornar uma lista de equipamentos",
     *     description="Retornar uma lista de equipamentos",
     *     operationId="equipamentList",
     *     tags={"public"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de exemplos retornada com sucesso",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Equipament"))
     *     )
     * )
     */
    public function list()
    {
        return Answer::json(Equipament::all(), 'Equipament listed successfully');
    }


    /**
     * @OA\Post(
     *     path="/api/equipament",
     *     summary="Inseri um objeto",
     *     description="Cria um novo recurso no banco de dados",
     *     operationId="EquipamentStore",
     *     tags={"public"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="uf", type="string", example="Mola")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Exemplo criado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Equipament")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro de validação"
     *     )
     * )
     */
    public function save(EquipamentPostRequest $request)
    {
        return Answer::json(Equipament::create($request->all()), 'Equipament saved successfully');
    }

    /**
     * @OA\Put(
     *     path="/api/equipamento/{id}",
     *     summary="Atualizar um objeto",
     *     description="Atualiza um recurso existente com base no ID",
     *     operationId="EquipamentUpdate",
     *     tags={"public"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do Equipamento",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"uf"},
     *             @OA\Property(property="name", type="string", example="Novo Nome do Exemplo")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Exemplo atualizado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Equipament")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Exemplo não encontrado"
     *     )
     * )
     */       
    public  function update(Request $request, $id)
    {
        $equipament = Equipament::findOrFail($id);
        $data = array_merge($request->all());
        $equipament->update($data);

        return Answer::json($data, 'Equipament updated successfully');
    }

    /**
     * @OA\Delete(
     *     path="/api/equipament/{id}",
     *     summary="Deletar um recurso",
     *     description="Deleta um recurso baseado no ID fornecido",
     *     operationId="EquipamentDelete",
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
        Equipament::findOrFail($id)->delete();
        return Answer::json([], 'Equipament deleted successfully');
    }    
}
