<?php
require_once "./views/components/head.php"
?>
<div class="pt-[8rem] bg-gray-100 min-h-screen">
    <main class="flex-grow mx-auto container pt-6 bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6">Dashboard Administrativo</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="/Cine-Colombia/dashboard/movies" class="bg-blue-500 text-white p-4 rounded-lg shadow hover:bg-blue-600">Administrar Películas</a>
            <a href="/Cine-Colombia/dashboard/rooms" class="bg-green-500 text-white p-4 rounded-lg shadow hover:bg-green-600">Administrar Salas</a>
            <a href="/Cine-Colombia/dashboard/users" class="bg-yellow-500 text-white p-4 rounded-lg shadow hover:bg-yellow-600">Administrar Usuarios</a>
            <a href="/Cine-Colombia/dashboard/statistics" class="bg-red-500 text-white p-4 rounded-lg shadow hover:bg-red-600">Ver Estadísticas</a>
        </div>
    </main>
</div>
<?php
require_once "./views/components/footer.php"
?>
