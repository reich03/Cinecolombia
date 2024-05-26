<?php
require_once "./views/components/head.php";
?>

<div class="pt-[8rem]">
    <main class="flex-grow mx-auto container pt-6 bg-white p-8 ">
        <div class="breadcrub-container mx-auto container bg-[#F5F9FF] rounded-md px-[3rem] py-[2rem] mb-[1rem] border border-[#E6F0FF]">
            <nav class="text-gray-700 mb-4">
                <ol class="list-reset flex">
                    <li><a href="/Cine-Colombia/dashboard" class="text-[#1C508D] hover:text-blue-700">Inicio</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li>Ver Estadísticas</li>
                </ol>
            </nav>
            <h2 class="text-2xl font-bold mb-6">Estadísticas del Cine</h2>
        </div>
        <div class="container-stats mx-auto container bg-[#F5F9FF] rounded-xl px-[3rem] py-[2rem] border border-[#E6F0FF]">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white p-4 rounded-lg shadow">
                    <canvas id="moviesChart"></canvas>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <canvas id="roomsChart"></canvas>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <canvas id="usersChart"></canvas>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
    </main>
</div>

<?php
require_once "./views/components/footer.php";
?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Chart for Movies
    var ctxMovies = document.getElementById('moviesChart').getContext('2d');
    var moviesChart = new Chart(ctxMovies, {
        type: 'bar',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            datasets: [{
                label: 'Películas Estrenadas',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: 'rgba(28, 80, 141, 0.5)',
                borderColor: 'rgba(28, 80, 141, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Chart for Rooms
    var ctxRooms = document.getElementById('roomsChart').getContext('2d');
    var roomsChart = new Chart(ctxRooms, {
        type: 'pie',
        data: {
            labels: ['IMAX', '3D', '2D', 'VIP', '4DX'],
            datasets: [{
                label: 'Tipos de Salas',
                data: [5, 10, 15, 20, 10],
                backgroundColor: [
                    'rgba(28, 80, 141, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(255, 99, 132, 0.5)'
                ],
                borderColor: [
                    'rgba(28, 80, 141, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        }
    });

    // Chart for Users
    var ctxUsers = document.getElementById('usersChart').getContext('2d');
    var usersChart = new Chart(ctxUsers, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            datasets: [{
                label: 'Usuarios Registrados',
                data: [50, 60, 70, 80, 90, 100],
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: true
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Chart for Revenue
    var ctxRevenue = document.getElementById('revenueChart').getContext('2d');
    var revenueChart = new Chart(ctxRevenue, {
        type: 'doughnut',
        data: {
            labels: ['Boletos', 'Comida', 'Merchandising', 'Publicidad'],
            datasets: [{
                label: 'Ingresos',
                data: [20000, 15000, 10000, 5000],
                backgroundColor: [
                    'rgba(28, 80, 141, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(255, 206, 86, 0.5)'
                ],
                borderColor: [
                    'rgba(28, 80, 141, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        }
    });
});
</script>
