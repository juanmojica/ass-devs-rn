<x-app-layout>
    <h2 class="text-center">
        Ver detalhes do Anuidade
    </h2>
    
    @component('anuidades.components.form', [
        'anuidade' => $anuidade,
        'acao' => 'view' 
    ])@endcomponent

</x-app-layout>