<?php

namespace App\Helpers;

class Funcoes
{
    public static function removerMascaraCpf($cpf)
    {
        return str_replace(['.', '-'], '', $cpf);
    }
}