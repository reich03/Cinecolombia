<div class="absolute right-4 w-0 h-0 border-l-8 border-l-transparent border-r-8 border-r-transparent border-b-8 border-b-[#1C508D] -top-2"></div>
<div class="p-4 bg-[#1C508D] rounded-t-lg">
    <h2 class="text-white text-center text-lg font-semibold">Bienvenido, <?= $_SESSION['user']['nomb_cli'] ?></h2>
    <p class="text-blue-200 text-center text-[12px]">Correo: <?= $_SESSION['user']['correo_cli'] ?></p>
</div>
<div class="p-4">
    <div class="mb-4">
        <label class="block text-sm text-gray-600">Nombre: <?= $_SESSION['user']['nomb_cli'] ?> <?= $_SESSION['user']['ape_cli'] ?></label>
    </div>
    <div class="mb-4">
        <label class="block text-sm text-gray-600">Teléfono: <?= $_SESSION['user']['telefono'] ?></label>
    </div>
    <div class="grid place-content-center">
        <button id="logoutButton" class="!bg-[#1C508D] text-white w-full px-4 py-2 !rounded-2xl">Cerrar Sesión</button>
    </div>
</div>
<div class="px-2 py-4 text-sm bg-[#1C508D] flex items-center justify-center rounded-b-md">
    <a href="/Cine-Colombia/purchases" class="text-white text-center hover:underline">Ver Mis Compras</a>
</div>

<script>
    document.getElementById('logoutButton').addEventListener('click', function() {
        $.ajax({
            url: '/Cine-Colombia/login/logout',
            method: 'POST',
            success: function() {
                window.location.reload();
            }
        });
    });
</script>