<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*Só é necessário verificar se o Header está preenchido para o tratamento de caracteres especiais automático*/
        $contentType = $request->header('Content-Type');
        if (str_contains($contentType,'application/json')) {
               $converter = mb_convert_encoding($request->getContent(), "UTF-8", "Windows-1252");
               $j = json_decode($converter, true);
               if(isset($j)){
                   $request->replace($j);
               }else{
                    $response = $next($request);   
                    return response()->json([
                        'error' => 'JSON invalido!Ocorreu um erro ao processar sua solicitação.'
                    ], $response->status());

               }
        }
       $response = $next($request);
       return $response;
    }
}
