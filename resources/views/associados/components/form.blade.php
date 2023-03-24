@php

    if ( isset($associado) ) {
       
        if (isset($acao) && $acao == 'view') {
            $rota = route('associados-exibir', ['id' => $associado->id]);
            $metodo = 'GET';
            $disabled = 'opacity-50 cursor-not-allowed';

        } else {
            $rota = route('associados-atualizar', ['id' => $associado->id]);
            $disabled = '';
            $metodo = 'PUT';
        }

    }  else {
        $rota = route('associados-salvar');
        $metodo = 'POST';   
        $disabled = '';     
    }
        
@endphp

<form id="form" action="{{ $rota }}" method="POST">
    @csrf
    @method($metodo)
   

    <div class="mb-4">
        <label 
            class="block text-gray-700 font-bold mb-2" 
            for="nome">
                Nome
        </label>
        <input 
            class="{{$disabled}} appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="nome" 
            name="nome" 
            type="text" 
            placeholder="Digite o nome" 
            value="{{ isset($associado) ? $associado->nome : old('nome') }}">
        @error('nome')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex mb-4">
        <div class="w-2/4">
            <label 
                class="block text-gray-700 font-bold mb-2" 
                for="email">
                    E-mail
            </label>
            <input 
                class="{{$disabled}} appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                id="email" 
                name="email" 
                type="email" 
                placeholder="Digite o e-mail" 
                value="{{ isset($associado) ? $associado->email : old('email') }}">
            @error('email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="w-1/4 mx-1">
            <label 
                class="block text-gray-700 font-bold mb-2" 
                for="cpf">
                 CPF
            </label>
            <input 
                class="{{$disabled}} appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                id="cpf" 
                name="cpf" 
                type="text" 
                placeholder="Digite o cpf" 
                value="{{ isset($associado) ? $associado->cpf : old('cpf') }}">
            @error('cpf')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-1/4">
            <label 
                class="block text-gray-700 font-bold mb-2" 
                for="data_filiacao">
                    Data de Filiação
            </label>
            <input 
                class="{{$disabled}} appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                id="data_filiacao" 
                name="data_filiacao" 
                type="date" 
                placeholder="Digite a data de filiação" 
                value="{{ isset($associado) ? $associado->data_filiacao : old('data_filiacao') }}">
            @error('data_filiacao')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="text-right">
            <button type="button" onclick="voltar('{{ route('associados') }}')" class="bg-transparent hover:bg-yellow-400 text-yellow-600 font-semibold hover:text-white py-1 px-4 border border-yellow-400 hover:border-transparent rounded">
                <i class="fa fa-regular fa-arrow-left"></i> Voltar
            </button>
            @if (isset($acao) && $acao != 'view')
                <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-4 border border-blue-500 hover:border-transparent rounded">
                    <i class="fa fa-regular fa-save"></i> Salvar
                </button>
            @endif
    </div>

</form>

<script>

    $(document).ready(function() {
        $('#cpf').mask('000.000.000-00')
    })

    $('#form').on('submit', function() {
        $('#cpf').unmask()
    })

    function voltar(rota) {
        window.location.href = rota
    }

</script>