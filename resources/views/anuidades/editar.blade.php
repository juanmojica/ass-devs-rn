<x-app-layout>
    <h2 class="text-center">
        Editar Anuidade
    </h2>
    
    @component('anuidades.components.form', [
        'anuidade' => $anuidade
    ])@endcomponent

</x-app-layout>