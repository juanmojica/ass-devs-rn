<x-app-layout>
    <div class="w-full flex">
        <h2 class="w-3/4 text-center text-lg">
            Associados
        </h2>
        <div class="w-1/4 text-right">
            <a href="{{  route('associados-criar') }}" class="hover:bg-green-500 text-green-500 font-semibold hover:text-white px-1 border border-green-500 hover:border-transparent rounded">
                <i class="fa fa-regular fa-plus"></i> Cadastrar Associado 
            </a>
        </div>
    </div>
    
    <div class="mt-8">
        <table class="w-full table-auto">
            <thead>
                <tr class="text-center">
                    <th class="w-4/12 px-6 py-3 text-center text-xs font-medium text-gray-500">
                        Nome
                    </th>
                    <th class="w-2/12 px-6 py-3 text-center text-xs font-medium text-gray-500">
                        E-mail
                    </th>
                    <th class="w-2/12 px-6 py-3 text-center text-xs font-medium text-gray-500">
                        CPF
                    </th>
                    <th class="w-2/12 px-6 py-3 text-center text-xs font-medium text-gray-500">
                        Data de filiação
                    </th>
                    <th class="w-2/12 px-6 py-3 text-center text-xs font-medium text-gray-500">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($associados as $associado)
                    @if ($loop->even)
                        <tr class="bg-gray-300">
                    @else
                        <tr class="bg-gray-100">
                    @endif
                        <td class="border-b px-2 py-2">
                            {{ $associado->nome }}
                        </td>
                        <td class="border-b px-2 py-2">
                            {{ $associado->email }}
                        </td>
                        <td class="cpf border-b px-2 py-2 text-center">
                            {{ $associado->cpf }}
                        </td>
                        <td class="border-b px-2 py-2 text-center">
                            {{ date('d/m/Y', strtotime($associado->data_filiacao)) }}
                        </td>
                        <td class="text-center">
                            <a 
                                href="{{  route('associados-exibir', ['id' => $associado->id]) }}" 
                                title="Exibir detalhes do associado"
                                class="bg-transparent hover:bg-blue-500 text-blue-500 font-semibold hover:text-white px-1 border-blue-500 hover:border-transparent rounded">
                                    <i class="fa fa-regular fa-eye"></i>
                            </a>
                            <a 
                                title="Editar associado"
                                href="{{ route('associados-editar', ['id' => $associado->id]) }}" 
                                class="bg-transparent hover:bg-yellow-500 text-yellow-500 font-semibold hover:text-white px-1 border-yellow-500 hover:border-transparent rounded">
                                    <i class="fa fa-regular fa-edit"></i>
                            </a>
                            <a 
                                title="Deletar associado"
                                onclick="deletar( '{{ route('associados-deletar', ['id' => $associado->id]) }}' )" 
                                class="bg-transparent hover:bg-red-500 text-red-500 font-semibold hover:text-white px-1 border-red-500 hover:border-transparent rounded">
                                    <i class="fa fa-regular fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>  
        @if (isset($associados) && count($associados) > 0)
            <div class="mt-5">
                {{ $associados->links() }}
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

        msg = 'Tem certeza que deseja deletar esse associado?'

        if ( confirm(msg) ) {

            $('#formDeletar').attr('action', rotaDeletar)
            $('#formDeletar').submit();
        }
    }

</script>

 
 
 
 
 
 
