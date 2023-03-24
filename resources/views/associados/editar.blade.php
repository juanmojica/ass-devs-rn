<x-app-layout>
    <h2 class="text-center">
        Editar Associado
    </h2>
    
    @component('associados.components.form', [
        'associado' => $associado
    ])@endcomponent

</x-app-layout>