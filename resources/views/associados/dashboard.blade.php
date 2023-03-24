<x-app-layout>
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-wrap -mx-4">
        <div class="w-full md:w-1/2 px-4">
            <div class="bg-white shadow-md rounded-md px-6 py-4 bg-gray-100">
                <h2 class="text-2xl font-semibold mb-4">Associados em Adimplentes vs Inadimplentes</h2>
                <canvas id="associadosChart"></canvas>
            </div>
        </div>
        <div class="w-full md:w-1/2 px-4">
            <div class="bg-white shadow-md rounded-md px-6 py-4 bg-gray-100">
                <h2 class="text-2xl font-semibold mb-4">Outras informações relevantes</h2>
                <p>Total de associados cadastrados = {{ count($associadosEmDia) + count($associadosEmAtraso) }}</p>
                <p>Total de associados adimplentes = {{ count($associadosEmDia) }}</p>
                <p>Total de associados Inadimplentes = {{ count($associadosEmAtraso) }}</p>
                <br><br>
                <p>{{ (number_format( 
                        (
                            ( count($associadosEmAtraso) / (count($associadosEmDia) + count($associadosEmAtraso)) ) * 100
                        ), 
                        2, 
                        ',',
                        ''
                    ))  . '%'}} dos associados estão Inadimplentes
                </p>
            </div>
        </div>
    </div>
</div>

</x-app-layout>


<script>

    $(document).ready(function() {
        let ctx = document.getElementById('associadosChart').getContext('2d');

        let myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Adimplentes', 'Inadimplentes'],
                datasets: [{
                    label: 'Status das Anuidades dos Associados',
                    data: [{{ count($associadosEmDia) }}, {{ count($associadosEmAtraso) }}],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Status das Anuidades dos Associados'
                }
            }
        });

    });
</script>

