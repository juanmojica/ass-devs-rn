<x-app-layout>
    <h2 class="text-center">
        Ver detalhes do Associado
    </h2>
    
    @component('associados.components.form', [
        'associado' => $associado,
        'acao' => 'view' 
    ])@endcomponent

    <div class="mt-8">
        <h2 class="w-full text-center">
            Anuidades
        </h2>
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
                        Status
                    </th>
                    <th class="w-2/12 px-6 py-3 text-center text-xs font-medium text-gray-500">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (isset($pagamentos) && count($pagamentos) > 0)

                    @foreach ($pagamentos as $pagamento) 
                        @if ($loop->even)
                            <tr class="bg-gray-300">
                        @else
                            <tr class="bg-gray-100">
                        @endif
                            <td class="border-b px-2 py-2">
                                {{ $pagamento->ano }}
                            </td>
                            <td class="border-b px-2 py-2 valor">
                                {{ $pagamento->valor }}
                            </td>
                            <td class="border-b px-2 py-2">
                                @if ($pagamento->pago)
                                    <i class="fa fa-check"></i>
                                @else
                                    <i class="fa fa-trash"></i>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{  route('pagamentos-exibir', ['id' => $pagamento->id]) }}" class="bg-transparent hover:bg-blue-500 text-blue-500 font-semibold hover:text-white px-1 border-blue-500 hover:border-transparent rounded">
                                    <i class="fa fa-regular fa-eye"></i>
                                </a>
                                <a href="{{ route('pagamentos-editar', ['id' => $pagamento->id]) }}" class="bg-transparent hover:bg-yellow-500 text-yellow-500 font-semibold hover:text-white px-1 border-yellow-500 hover:border-transparent rounded">
                                    <i class="fa fa-regular fa-edit"></i>
                                </a>
                                <a onclick="deletar( '{{ route('pagamentos-deletar', ['id' => $pagamento->id]) }}' )" class="bg-transparent hover:bg-red-500 text-red-500 font-semibold hover:text-white px-1 border-red-500 hover:border-transparent rounded">
                                    <i class="fa fa-regular fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                
            </tbody>
        </table>  
        @if (isset($pagamentos) && count($pagamentos) > 0)
            <div class="mt-5">
                {{ $pagamentos->links() }}
            </div>
        @endif          
    </div>

</x-app-layout>

<script>
   /*  $(document).ready(function() {
        $('.valor').mask('#.##0,00', {reverse: true});
    }) */
</script>

