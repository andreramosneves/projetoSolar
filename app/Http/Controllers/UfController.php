<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Answer;
use App\Models\Uf;

use App\Http\Requests\UfPostRequest;

class UfController extends Controller
{
    //

    /**
     * @OA\Get(
     *     path="/api/uf",
     *     summary="Obter lista de Ufs",
     *     description="Retorna uma lista",
     *     operationId="UfList",
     *     tags={"public"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de exemplos retornada com sucesso",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Uf"))
     *     )
     * )
     */    
    public function list()
    {
        return Answer::json(Uf::all(), 'Uf listed successfully');
    }

    /**
     * @OA\Post(
     *     path="/api/uf",
     *     summary="Inseri um objeto",
     *     description="Cria um novo recurso no banco de dados",
     *     operationId="UfStore",
     *     tags={"public"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"uf"},
     *             @OA\Property(property="uf", type="string", example="SP")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Exemplo criado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Uf")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro de validação"
     *     )
     * )
     */
    public function save(UfPostRequest $request)
    {
        return Answer::json(Uf::create($request->all()), 'Uf saved successfully');
    }


     /**
     * @OA\Put(
     *     path="/api/uf/{id}",
     *     summary="Atualizar um objeto",
     *     description="Atualiza um recurso existente com base no ID",
     *     operationId="UfUpdate",
     *     tags={"public"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do UF",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"uf"},
     *             @OA\Property(property="uf", type="string", example="Novo Nome do Exemplo")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Exemplo atualizado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Uf")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Exemplo não encontrado"
     *     )
     * )
     */    
    public  function update(Request $request, $id)
    {
        $uf = Uf::findOrFail($id);
        $data = array_merge($request->all());
        $uf->update($data);
        return Answer::json($data, 'Uf updated successfully');
    }


    /**
     * @OA\Delete(
     *     path="/api/uf/{id}",
     *     summary="Deletar um recurso",
     *     description="Deleta um recurso baseado no ID fornecido",
     *     operationId="UfDelete",
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
        Uf::findOrFail($id)->delete();
        return Answer::json([], 'Uf deleted successfully');
    }

}
