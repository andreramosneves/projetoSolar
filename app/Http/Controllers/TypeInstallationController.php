<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Answer;
use App\Models\TypeInstallation;

use App\Http\Requests\TypeInstallationPostRequest;

class TypeInstallationController extends Controller
{
    
    /**
     * @OA\Get(
     *     path="/api/type_installation",
     *     summary="Obter lista de Tipos",
     *     description="Retorna uma lista de tipos de instalação",
     *     operationId="typeInstallationList",
     *     tags={"public"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de exemplos retornada com sucesso",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/TypeInstallation"))
     *     )
     * )
     */
    public function list()
    {
        return Answer::json(TypeInstallation::all(), 'Type Installation listed successfully');
    }

    /**
     * @OA\Post(
     *     path="/api/type_installation",
     *     summary="Inseri um tipo de intalação",
     *     description="Cria um novo recurso no banco de dados",
     *     operationId="typeInstallationStore",
     *     tags={"public"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Exemplo 1")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Exemplo criado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/TypeInstallation")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro de validação"
     *     )
     * )
     */
    public function save(TypeInstallationPostRequest $request)
    {
        return Answer::json(TypeInstallation::create($request->all()), 'Type Installation  saved successfully');
    }


    /**
     * @OA\Put(
     *     path="/api/type_installation/{id}",
     *     summary="Atualizar o Tipo de Instalação",
     *     description="Atualiza um recurso existente com base no ID",
     *     operationId="typeInstallationUpdate",
     *     tags={"public"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do Tipo de Instalação",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Novo Nome do Exemplo")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Exemplo atualizado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/TypeInstallation")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Exemplo não encontrado"
     *     )
     * )
     */
    public  function update(Request $request, $id)
    {
        $type = TypeInstallation::findOrFail($id);
        $data = array_merge($request->all());

        $type->update($data);

        return Answer::json($data, 'Type Installation listed successfully');
    }


    /**
     * @OA\Delete(
     *     path="/api/type_installation/{id}",
     *     summary="Deletar um recurso",
     *     description="Deleta um recurso baseado no ID fornecido",
     *     operationId="typeInstallationDelete",
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
        TypeInstallation::findOrFail($id)->delete();
        return Answer::json([], 'Type Installation deleted successfully');
    }


}
