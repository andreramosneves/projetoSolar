<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Answer;
use App\Models\User;

use App\Http\Requests\ClientPostRequest;

class ClientController extends Controller
{
    //
    /**
     * @OA\Get(
     *     path="/api/client",
     *     summary="Obter lista de Clients",
     *     description="Retorna uma lista",
     *     operationId="ClientList",
     *     tags={"public"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de exemplos retornada com sucesso",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Client"))
     *     )
     * )
     */ 
    public function list()
    {
        return Answer::json(User::all(), 'Client listed successfully');
    }


    /**
     * @OA\Post(
     *     path="/api/client",
     *     summary="Inseri um objeto",
     *     description="Cria um novo recurso no banco de dados",
     *     operationId="ClientStore",
     *     tags={"public"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","phone","document","type_document"},
     *             @OA\Property(property="name", type="string", example="andre"),
     *             @OA\Property(property="email", type="string", example="an@gm.com"),
     *             @OA\Property(property="phone", type="string", example="231321321"),
     *             @OA\Property(property="document", type="string", example="231321321"),
     *             @OA\Property(property="type_document", type="string", example="cpf")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Exemplo criado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Client")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro de validação"
     *     )
     * )
     */
    public function save(ClientPostRequest $request)
    {
        
        return Answer::json(User::create($request->all()), 'Client saved successfully');
    }



    /**
     * @OA\Put(
     *     path="/api/client/{id}",
     *     summary="Atualizar um objeto",
     *     description="Atualiza um recurso existente com base no ID",
     *     operationId="ClientUpdate",
     *     tags={"public"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do Client",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","phone","document","type_document"},
     *             @OA\Property(property="name", type="string", example="andre"),
     *             @OA\Property(property="email", type="string", example="an@gm.com"),
     *             @OA\Property(property="phone", type="string", example="231321321"),
     *             @OA\Property(property="document", type="string", example="231321321"),
     *             @OA\Property(property="type_document", type="string", example="cpf")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Exemplo atualizado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Client")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Exemplo não encontrado"
     *     )
     * )
     */   

    public  function update(ClientPostRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = array_merge($request->all());
        $u = $user->update($data);
        return Answer::json($u, 'Client updated successfully');
    }


    /**
     * @OA\Delete(
     *     path="/api/client/{id}",
     *     summary="Deletar um recurso",
     *     description="Deleta um recurso baseado no ID fornecido",
     *     operationId="ClientDelete",
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
        User::findOrFail($id)->delete();
        return Answer::json([], 'Client deleted successfully');
    }

}
