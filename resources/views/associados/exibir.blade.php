@php
    $somaNaoPagos = 0.00;
@endphp

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
                        Pagamento
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
                                R$ {{ number_format($pagamento->valor, 2, ',', '.') }}
                            </td>
                            <td class="border-b px-2 py-2">
                                @if ($pagamento->pago)
                                    <i 
                                        class="fa fa-regular fa-check text-green-500 border rounded border-green-500 p-0.5"
                                        title="Pago">
                                    </i>
                                    <td>
                                        -
                                    </td>
                                @else
                                    <i 
                                        title="Não Pago"
                                        class="text-red-500 border rounded border-red-500 px-1">
                                            <b>X</b>
                                    </i>
                                    <td class="text-center">
                                        <a 
                                            onclick="pagar('{{  route('pagamentos-pagar', ['id' => $pagamento->id, 'idAssociado' => $associado->id]) }}')"
                                            class="bg-transparent hover:bg-green-500 text-green-500 font-semibold hover:text-white px-1 border-green-500 hover:border-transparent rounded"
                                            title="Efetuar Pagamento">
                                                <i class="fa fa-regular fa-money-bill-wave"></i>
                                        </a>
                                    </td>
                                    @php
                                        $somaNaoPagos += $pagamento->valor;
                                    @endphp
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <td>
                        <b>Total à pagar</b>
                    </td>
                    <td>
                        <b>R$ {{ number_format($somaNaoPagos, 2, ',', '.') }}</b>
                    </td>
                </tr>
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
   
   function pagar(rotaPagar) {

        msg = 'Confirmar pagamento?'

        if ( confirm(msg) ) {
            window.location.href = rotaPagar
        }
    }

</script>

