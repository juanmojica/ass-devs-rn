<x-app-layout>
    <div class="w-full flex">
        <h2 class="w-2/4 text-right text-lg">
            Anuidades
        </h2>
        <div class="w-1/4 text-right">
            <a href="{{  route('anuidades-criar') }}" class="hover:bg-green-500 text-green-500 font-semibold hover:text-white px-1 border border-green-500 hover:border-transparent rounded">
                <i class="fa fa-regular fa-plus"></i> Cadastrar Anuidade 
            </a>
        </div>
    </div>
    
    <div class="mt-8">
        <table class="w-2/4 ml-auto mr-auto table-auto text-center">
            <thead>
                <tr class="text-center">
                    <th class="w-4/12 px-6 py-3 text-center text-xs font-medium text-gray-500">
                        Ano
                    </th>
                    <th class="w-2/12 px-6 py-3 text-center text-xs font-medium text-gray-500">
                        Valor
                    </th>
                    <th class="w-2/12 px-6 py-3 text-center text-xs font-medium text-gray-500">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anuidades as $anuidade)
                    @if ($loop->even)
                        <tr class="bg-gray-300">
                    @else
                        <tr class="bg-gray-100">
                    @endif
                        <td class="border-b px-2 py-2">
                            {{ $anuidade->ano }}
                        </td>
                        <td class="border-b px-2 py-2">
                            {{ $anuidade->valor }}
                        </td>
                        <td class="text-center">
                            <a 
                                title="Exibir detalhes da anuidade"
                                href="{{  route('anuidades-exibir', ['id' => $anuidade->id]) }}" 
                                class="bg-transparent hover:bg-blue-500 text-blue-500 font-semibold hover:text-white px-1 border-blue-500 hover:border-transparent rounded">
                                    <i class="fa fa-regular fa-eye"></i>
                            </a>
                            <a 
                                title="Editar anuidade"
                                href="{{ route('anuidades-editar', ['id' => $anuidade->id]) }}" 
                                class="bg-transparent hover:bg-yellow-500 text-yellow-500 font-semibold hover:text-white px-1 border-yellow-500 hover:border-transparent rounded">
                                    <i class="fa fa-regular fa-edit"></i>
                            </a>
                            <a 
                                title="Deletar anuidade"
                                onclick="deletar( '{{ route('anuidades-deletar', ['id' => $anuidade->id]) }}' )" 
                                class="bg-transparent hover:bg-red-500 text-red-500 font-semibold hover:text-white px-1 border-red-500 hover:border-transparent rounded">
                                    <i class="fa fa-regular fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>  
        @if (isset($anuidades) && count($anuidades) > 0)
            <div class="mt-5">
                {{ $anuidades->links() }}
            </div>
        @endif          
    </div>
</x-app-layout>

<form id="formDeletar" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>

    $(document).ready(function() {
        $('.cpf').mask('000.000.000-00'); 
    });
    
    function deletar(rotaDeletar) {

        msg = 'Tem certeza que deseja deletar essa anuidade?'

        if ( confirm(msg) ) {

            $('#formDeletar').attr('action', rotaDeletar)
            $('#formDeletar').submit();
        }
    }

</script>
 
 
 
 
 
 
 
