<?php require_once "./views/components/head.php";
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
                    <canvas id="monthlyRevenueChart"></canvas>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <canvas id="topMoviesChart"></canvas>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <canvas id="roomsChart"></canvas>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <canvas id="usersChart"></canvas>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <canvas id="topUsersChart"></canvas>
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
    var monthlyRevenueData = <?= json_encode(array_column($this->monthlyRevenue, 'mes')) ?>;
    var monthlyRevenueCounts = <?= json_encode(array_column($this->monthlyRevenue, 'ingresos')) ?>;

    if (monthlyRevenueData.length === 1) {
        monthlyRevenueData.push('Next Month');
        monthlyRevenueCounts.push(0);
    }

    var ctxMonthlyRevenue = document.getElementById('monthlyRevenueChart').getContext('2d');
    var monthlyRevenueChart = new Chart(ctxMonthlyRevenue, {
        type: 'bar', 
        data: {
            labels: monthlyRevenueData,
            datasets: [{
                label: 'Ingresos Mensuales',
                data: monthlyRevenueCounts,
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                },
                x: {
                    barThickness: 30 
                }
            }
        }
    });

    var topMoviesData = <?= json_encode(array_column($this->topMovies, 'titulo')) ?>;
    var topMoviesCounts = <?= json_encode(array_column($this->topMovies, 'ingresos')) ?>;

    var ctxTopMovies = document.getElementById('topMoviesChart').getContext('2d');
    var topMoviesChart = new Chart(ctxTopMovies, {
        type: 'bar',
        data: {
            labels: topMoviesData,
            datasets: [{
                label: 'Ingresos por Película',
                data: topMoviesCounts,
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

    var roomsData = <?= json_encode(array_column($this->rooms, 'tipo_sala')) ?>;
    var roomsCounts = <?= json_encode(array_count_values(array_column($this->rooms, 'tipo_sala'))) ?>;

    var ctxRooms = document.getElementById('roomsChart').getContext('2d');
    var roomsChart = new Chart(ctxRooms, {
        type: 'pie',
        data: {
            labels: Object.keys(roomsCounts),
            datasets: [{
                label: 'Tipos de Salas',
                data: Object.values(roomsCounts),
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

    var usersData = <?= json_encode(array_column($this->users, 'nombre')) ?>;
    var usersCounts = <?= json_encode(array_fill(0, count($this->users), 1)) ?>;

    var ctxUsers = document.getElementById('usersChart').getContext('2d');
    var usersChart = new Chart(ctxUsers, {
        type: 'line',
        data: {
            labels: usersData,
            datasets: [{
                label: 'Usuarios Registrados',
                data: usersCounts,
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

    var topUsersData = <?= json_encode(array_column($this->topUsers, 'nombre')) ?>;
    var topUsersCounts = <?= json_encode(array_column($this->topUsers, 'entradas')) ?>;

    var ctxTopUsers = document.getElementById('topUsersChart').getContext('2d');
    var topUsersChart = new Chart(ctxTopUsers, {
        type: 'bar',
        data: {
            labels: topUsersData,
            datasets: [{
                label: 'Usuarios con Más Entradas',
                data: topUsersCounts,
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
});
</script>
