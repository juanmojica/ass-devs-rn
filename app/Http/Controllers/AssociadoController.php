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

            $associado = Associado::findOrFail($id);

            $pagamentos = $associado->pagamentos()
                ->whereNull('pagamentos.deleted_at')
                ->whereNull('anuidades.deleted_at')
                ->orderBy('pagamentos.pago', 'desc')
                ->orderBy('anuidades.ano', 'desc')
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

    public function pagamentosEmDia()
    {
        try {

            $anoVigente = date('Y');

            $associados = Associado::whereHas('pagamentos', function ($query) use ($anoVigente) {
                $query->where('pago', true)
                    ->whereHas('anuidade', function ($query) use ($anoVigente) {
                        $query->where('ano', '<=', $anoVigente);
                    });
            })
                ->orderBy('nome')
                ->paginate(10);

            return view('associados.index', compact('associados'));

        } catch (\Exception $e) {
            return redirect()->route('home')->with('erro', $e->getMessage());
        }
        
    }

    public function pagamentosEmAtraso()
    {
        try {

            $anoVigente = date('Y');

            $associados = Associado::whereHas('pagamentos', function ($query) use ($anoVigente) {
                $query->where('pago', false)
                    ->whereHas('anuidade', function ($query) use ($anoVigente) {
                        $query->where('ano', '<=', $anoVigente);
                    });
            })
                ->orderBy('nome')
                ->paginate(10);

            return view('associados.index', compact('associados'));

        } catch (\Exception $e) {
            return redirect()->route('home')->with('erro', $e->getMessage());
        }
        
    }

    public function dashboard()
    {
        try {
           
            $anoVigente = date('Y');

            $associadosEmDia = Associado::whereHas('pagamentos', function ($query) use ($anoVigente) {
                $query->where('pago', true)
                    ->whereHas('anuidade', function ($query) use ($anoVigente) {
                        $query->where('ano', '<=', $anoVigente);
                    });
            })
                ->orderBy('nome')
                ->paginate(10);

            $associadosEmAtraso = Associado::whereHas('pagamentos', function ($query) use ($anoVigente) {
                $query->where('pago', false)
                    ->whereHas('anuidade', function ($query) use ($anoVigente) {
                        $query->where('ano', '<=', $anoVigente);
                    });
            })
                ->orderBy('nome')
                ->paginate(10);

            return view('associados.dashboard', compact('associadosEmDia', 'associadosEmAtraso'));

        } catch (\Exception $e) {
            return redirect()->route('home')->with('erro', $e->getMessage());
        }
        
    }

}
