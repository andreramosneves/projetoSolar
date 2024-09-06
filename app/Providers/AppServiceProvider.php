<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Validator::extend('cpf_cnpj', function ($attribute, $value, $parameters, $validator) {
            // Remova caracteres não numéricos
            $cpf_cnpj = preg_replace('/[^0-9]/', '', $value);
            
            // Verifique se tem 14 dígitos
            if (strlen($cpf_cnpj) == 14) {

                // Verifica se todos os digitos são iguais
                if (preg_match('/(\d)\1{13}/', $cpf_cnpj))
                    return false;   

                // Valida primeiro dígito verificador
                for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
                {
                    $soma += $cpf_cnpj[$i] * $j;
                    $j = ($j == 2) ? 9 : $j - 1;
                }

                $resto = $soma % 11;

                if ($cpf_cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
                    return false;

                // Valida segundo dígito verificador
                for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
                {
                    $soma += $cpf_cnpj[$i] * $j;
                    $j = ($j == 2) ? 9 : $j - 1;
                }

                $resto = $soma % 11;

                return $cpf_cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
                /*Caso seja um CPF*/
            }else if (strlen($cpf_cnpj) == 11) {
                // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
                if (preg_match('/(\d)\1{10}/', $cpf_cnpj)) {
                    return false;
                }

                // Faz o calculo para validar o CPF
                for ($t = 9; $t < 11; $t++) {
                    for ($d = 0, $c = 0; $c < $t; $c++) {
                        $d += $cpf_cnpj[$c] * (($t + 1) - $c);
                    }
                    $d = ((10 * $d) % 11) % 10;
                    if ($cpf_cnpj[$c] != $d) {
                        return false;
                    }
                }
                return true;                
            }else{

                return false;
            }
        });

    }
}
