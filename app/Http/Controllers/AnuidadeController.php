<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnuidadeRequest;
use App\Models\Anuidade;
use Illuminate\Http\Request;

class AnuidadeController extends Controller
{

    function __constructor() {
        $this->authorize(auth()->user()->admin);
    }

    public function index()
    {
        try {

            $anuidades = Anuidade::whereNull('deleted_at')->paginate(10);

            return view('anuidades.index', compact('anuidades'));

        } catch (\Exception $e) {
            return redirect()->route('home')->with('erro', $e->getMessage());
        }
        
    }

    public function create()
    {
        try {

            return view('anuidades.criar');

        } catch (\Exception $e) {
            return redirect()->route('home')->with('erro', $e->getMessage());
        }
       
    }

    public function store(AnuidadeRequest $request)
    {
        try {

            $dadosForm = $request->only(
                'ano',
                'valor'
            );

            $dadosForm['valor'] = str_replace('.', '', $dadosForm['valor']);
            $dadosForm['valor'] = str_replace(',', '.', $dadosForm['valor']);
    
            Anuidade::create($dadosForm);
    
            return redirect()->route('anuidades')->with('sucesso', 'Anuidade criada.');

        } catch (\Exception $e) {
            return redirect()->back()->with('erro', $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
    
            $anuidade = Anuidade::findOrFail($id);

            return view('anuidades.exibir', compact('anuidade'));
    
        } catch (\Exception $e) {
            return redirect()->back()->with('erro', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
    
            $anuidade = Anuidade::findOrFail($id);

            return view('anuidades.editar', compact('anuidade'));
    
        } catch (\Exception $e) {
            return redirect()->back()->with('erro', $e->getMessage());
        }
    }

    public function update(AnuidadeRequest $request, $id)
    {
        try {
    
            $anuidade = Anuidade::findOrFail($id);

            $dadosForm = $request->only(
                'ano',
                'valor'
            );

            $dadosForm['valor'] = str_replace('.', '', $dadosForm['valor']);
            $dadosForm['valor'] = str_replace(',', '.', $dadosForm['valor']);

            $anuidade->update($dadosForm);

            return redirect()->route('anuidades')->with('sucesso', 'Anuidade atualizada.');
    
        } catch (\Exception $e) {
            return redirect()->back()->with('erro', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {

            $anuidade = Anuidade::findOrFail($id);

            $anuidade->delete($id);
            
            return redirect()->route('anuidades')->with('sucesso', 'Anuidade deletada.');
    
        } catch (\Exception $e) {
            return redirect()->back()->with('erro', $e->getMessage());
        }
    }}
