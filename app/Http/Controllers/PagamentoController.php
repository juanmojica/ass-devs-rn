<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssociadoRequest;
use App\Models\Anuidade;
use App\Models\Associado;
use App\Models\Pagamento;
use Exception;
use Illuminate\Support\Facades\DB;

class PagamentoController extends Controller
{
    public function pagar($id, $idAssociado)
    {
        try {
            
            $pagamento = Pagamento::findOrFail($id);
               
            $pagamento->pago = true;
            $pagamento->data_pagamento = now();

            $pagamento->save();

            return redirect()->route('associados-exibir', ['id' => $idAssociado])
                ->with('sucesso', 'Pagamento Efetuado.');

        } catch (\Exception $e) {
            return redirect()->route('home')->with('erro', $e->getMessage());
        }
        
    }
}