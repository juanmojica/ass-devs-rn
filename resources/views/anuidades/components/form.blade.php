@php

    if ( isset($anuidade) ) {
       
        if (isset($acao) && $acao == 'view') {
            $rota = route('anuidades-exibir', ['id' => $anuidade->id]);
            $metodo = 'GET';
            $disabled = 'opacity-50 cursor-not-allowed';

        } else {
            $rota = route('anuidades-atualizar', ['id' => $anuidade->id]);
            $disabled = '';
            $metodo = 'PUT';
        }

    }  else {
        $rota = route('anuidades-salvar');
        $metodo = 'POST';   
        $disabled = '';     
    }
        
@endphp

<form id="form" action="{{ $rota }}" method="POST">
    @csrf
    @method($metodo)
   

    <div class="w-1/4 ml-auto mr-auto">
        <div class="mb-4">
            <label 
                class="block text-gray-700 font-bold mb-2"
                for="ano">
                    Ano
            </label>
            <select id="ano" name="ano" class="{{$disabled}} appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
               
                @if (isset($anuidade))
                    
                    @for ($i = date('Y'); $i <= date('Y') + 5; $i++)
                        <option value="{{ $i }}" {{ $i == $anuidade->ano ? 'selected' : '' }} >{{ $i }}</option>
                    @endfor
                
                @endif
                <option value="">Selecione...</option>
                @for ($i = date('Y'); $i <= date('Y') + 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            @error('ano')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label 
                class="block text-gray-700 font-bold mb-2" 
                for="valor">
                    Valor R$
            </label>
            <input 
                class="{{$disabled}} appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                id="valor" 
                name="valor" 
                type="text" 
                placeholder="Digite o valor" 
                value="{{ isset($anuidade) ? $anuidade->valor : old('valor') }}">
            @error('valor')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="text-right">
                <button type="button" onclick="voltar('{{ route('anuidades') }}')" class="bg-transparent hover:bg-yellow-400 text-yellow-600 font-semibold hover:text-white py-1 px-4 border border-yellow-400 hover:border-transparent rounded">
                    <i class="fa fa-regular fa-arrow-left"></i> Voltar
                </button>
                <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-4 border border-blue-500 hover:border-transparent rounded">
                    <i class="fa fa-regular fa-save"></i> Salvar
                </button>
        </div>
    </div>

</form>

<script>

    $(document).ready(function() {
        $('#valor').mask('#.##0,00', {reverse: true});
    })

    function voltar(rota) {
        window.location.href = rota
    }

</script>