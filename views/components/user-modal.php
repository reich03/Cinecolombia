<div class="p-4">
    <h2 class="text-lg font-semibold">Iniciar Sesión</h2>
    <form action="/login" method="post">
        <div class="mb-4">
            <label for="username" class="block text-sm">Usuario</label>
            <input type="text" id="username" name="username" class="w-full px-3 py-2 border rounded">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm">Contraseña</label>
            <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Iniciar Sesión</button>
    </form>
    <div class="mt-4 text-sm">
        <a href="#" class="text-blue-500 hover:underline">¿Olvidaste tu contraseña? Recupérala aquí</a>
    </div>
    <div class="mt-2 text-sm">
        <a href="#" class="text-blue-500 hover:underline">¿No estás registrado? Regístrate aquí</a>
    </div>
</div>
