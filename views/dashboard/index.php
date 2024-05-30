<?php
require_once "./views/components/head.php";
session_start();
$name = $_SESSION['user'];
$user = $_SESSION['user'];
$isEmployee = $user['user_type'] == 'empleado';

?>
<div class="pt-[8rem] bg-gray-100 bg-white">
    <main class="flex-grow mx-auto container  mt-[3rem] p-2 ">
        <div class="breadcrub-container mx-auto container bg-[#F5F9FF] rounded-md px-[3rem] py-[2rem] mb-[1rem] border border-[#E6F0FF]">
            <nav class="text-gray-700 mb-4">
                <ol class="list-reset flex">
                    <li><a href="/Cine-Colombia/dashboard" class="text-[#1C508D] hover:text-blue-700">Inicio</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li>Panel de Administracion</li>
                </ol>
            </nav>
            <h2 class="text-2xl font-bold mb-6">Gestion de Cine Colombia</h2>
        </div>

        <div class="container-dashboard bg-[#F5F9FF] rounded-md px-[3rem] py-[2rem] border border-[#E6F0FF] h-[20rem]">
                <h2 class="text-2xl font-bold mb-6">BIENVENIDO <?= $name['nombre']; ?>!</h2>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="/Cine-Colombia/dashboard/movies" class="flex items-center justify-center bg-blue-500 text-white p-4 rounded-lg shadow hover:bg-blue-600">
                    <i class="fas fa-film mr-2"></i> Administrar Películas
                </a>
                <a href="/Cine-Colombia/dashboard/rooms" class="flex items-center justify-center bg-green-500 text-white p-4 rounded-lg shadow hover:bg-green-600">
                    <i class="fas fa-theater-masks mr-2"></i> Administrar Salas
                </a>
                <a href="/Cine-Colombia/dashboard/users" class="flex items-center justify-center bg-yellow-500 text-white p-4 rounded-lg shadow hover:bg-yellow-600">
                    <i class="fas fa-users mr-2"></i> Administrar Usuarios
                </a>
                <a href="/Cine-Colombia/dashboard/functiones" class="flex items-center justify-center bg-indigo-500 text-white p-4 rounded-lg shadow hover:bg-indigo-600">
                    <i class="fa-regular fa-clock mr-[3px]"></i> Administrar Funciones
                </a>
                <a href="/Cine-Colombia/dashboard/statistics" class="flex items-center justify-center bg-red-500 text-white p-4 rounded-lg shadow hover:bg-red-600">
                    <i class="fas fa-chart-line mr-2"></i> Ver Estadísticas
                </a>
            </div>
        </div>
    </main>
</div>
<?php
require_once "./views/components/footer.php"
?>