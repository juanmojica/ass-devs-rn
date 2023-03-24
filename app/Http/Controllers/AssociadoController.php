<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssociadoRequest;
use App\Models\Anuidade;
use App\Models\Associado;
use App\Models\Pagamento;
use Exception;
use Illuminate\Support\Facades\DB;

class AssociadoController extends Controller
{
    public function index()
    {
        try {

            $associados = Associado::whereNull('deleted_at')
                ->orderBy('nome')
                ->paginate(10);

            return view('associados.index', compact('associados'));

        } catch (\Exception $e) {
            return redirect()->route('home')->with('erro', $e->getMessage());
        }
        
    }

    public function create()
    {
        try {
           
            return view('associados.criar');

        } catch (\Exception $e) {
            return redirect()->route('home')->with('erro', $e->getMessage());
        }
       
    }

    public function store(AssociadoRequest $request)
    {
        try {

            DB::beginTransaction();

            $associado = Associado::create(
                $request->only(
                    'nome',
                    'email',
                    'cpf',
                    'data_filiacao'
                )
            );

            $this->salvarAnuidadeInicial($associado);

            DB::commit();
            
            return redirect()->route('associados')->with('sucesso', 'Associado criado.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('erro', $e->getMessage());
        }
    }

    public function show($id)
    {
        try {

            /* $selo = Selo::with([
                'atos:id,codigo_ato,funcivil,tfj,iss,emolumentos,fundo_eletronizacao,total,selo_id', 
            ])
        ->where([['cartorio_id', $cartorio->id], ['codigo', $codigo_selo]])
        ->Join('api_selos_especialidades as e', 'e.id', 'api_selos_selos.especialidade_id')
        ->first([
            'api_selos_selos.id',
            'api_selos_selos.lote_selo_id',
            'api_selos_selos.codigo as codigo_selo',
            'api_selos_selos.codigo_validacao',
            'api_selos_selos.tipo_lote',
            'api_selos_selos.data',
            'api_selos_selos.competencia',
            'api_selos_selos.status',
            'api_selos_selos.relatorio',
            'e.especialidade'
        ]);

        if(empty($selo)){
            throw new \Exception('Selo não encontrado', 404);
        } */


           /*  $pagamentos = $associado->pagamentos()
                ->with('anuidade:id, valor, anuidade.id')
                ->whereNull('deleted_at')->paginate(10);

                dd($pagamentos); */
            /* $pagamentos = $associado->pagamentos()
                ->with('anuidade')
                ->whereNull('deleted_at')->get(); */

                $associado = Associado::findOrFail($id);

            $pagamentos = $associado->pagamentos()
                ->whereNull('pagamentos.deleted_at')
                ->join('anuidades', 'pagamentos.anuidade_id', '=', 'anuidades.id')
                ->select('pagamentos.*', 'anuidades.valor', 'anuidades.ano')
                ->paginate(10);

            return view('associados.exibir', compact('associado', 'pagamentos'));
    
        } catch (\Exception $e) {
            return redirect()->back()->with('erro', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            
            $associado = Associado::findOrFail($id);

            return view('associados.editar', compact('associado'));
    
        } catch (\Exception $e) {
            return redirect()->back()->with('erro', $e->getMessage());
        }
    }

    public function update(AssociadoRequest $request, $id)
    {
        try {
            
            $associado = Associado::findOrFail($id);

            $associado->update(
                $request->only(
                    'nome',
                    'email',
                    'cpf',
                    'data_filiacao'
                )
            );

            return redirect()->route('associados')->with('sucesso', 'Associado atualizado.');
    
        } catch (\Exception $e) {
            return redirect()->back()->with('erro', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            
            $associado = Associado::findOrFail($id);

            $associado->delete($id);

            return redirect()->route('associados')->with('sucesso', 'Associado deletado.');
    
        } catch (\Exception $e) {
            return redirect()->back()->with('erro', $e->getMessage());
        }
    }

    public function salvarAnuidadeInicial($associado)
    {
        try {
            $anuidadeVigente = Anuidade::where('ano', date('Y'))->first();

            $pagamento = new Pagamento([
                'valor' => $anuidadeVigente->valor,
                'anuidade_id' => $anuidadeVigente->id,
            ]);
            
            $associado->pagamentos()->save($pagamento);

        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}
