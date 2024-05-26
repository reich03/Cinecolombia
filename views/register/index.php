<?php
require_once "./views/components/head.php";
?>
<div class="pt-[8rem] bg-white  min-h-screen">
    <main class="flex-grow mx-auto container pt-6 bg-white p-[30rem] pb-[4.5rem] rounded-lg">
        <h2 class="text-2xl font-bold mb-6">Registro</h2>
        <form action="/register" method="post" class="space-y-6" id="registrationForm">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo <span class="text-red-600">*</span></label>
                <input type="email" id="email" name="email" class="mt-1 w-full px-4 py-2 border rounded-md bg-blue-100 active:border-blue-200 focus-visible:border-blue-200" placeholder="Correo" required>
            </div>
            <div>
                <label for="confirm_email" class="block text-sm font-medium text-gray-700">Confirmar correo <span class="text-red-600">*</span></label>
                <input type="email" id="confirm_email" name="confirm_email" class="mt-1 w-full px-4 py-2 border rounded-md bg-blue-100" placeholder="Confirmar correo" required>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña <span class="text-red-600">*</span></label>
                <input type="password" id="password" name="password" class="mt-1 w-full px-4 py-2 border rounded-md bg-blue-100" placeholder="Contraseña" required>
                <p class="text-sm text-gray-500 mt-2">La contraseña debe tener mínimo 8 caracteres y máximo 16, estar compuesta por lo menos de una minúscula, una mayúscula, un número y un carácter especial entre *, $, ., #.</p>
            </div>
            <div>
                <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirmar contraseña <span class="text-red-600">*</span></label>
                <input type="password" id="confirm_password" name="confirm_password" class="mt-1 w-full px-4 py-2 border rounded-md bg-blue-100" placeholder="Confirmar contraseña" required>
            </div>
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">Nombres <span class="text-red-600">*</span></label>
                <input type="text" id="first_name" name="first_name" class="mt-1 w-full px-4 py-2 border rounded-md bg-blue-100" placeholder="Nombres" required>
            </div>
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700">Apellidos <span class="text-red-600">*</span></label>
                <input type="text" id="last_name" name="last_name" class="mt-1 w-full px-4 py-2 border rounded-md bg-blue-100" placeholder="Apellidos" required>
            </div>
            <div>
                <label for="id_type" class="block text-sm font-medium text-gray-700">Documento de identidad <span class="text-red-600">*</span></label>
                <div class="flex space-x-2">
                    <select id="id_type" name="id_type" class="mt-1 px-4 py-2 border rounded-md bg-blue-100" required>
                        <option value="CC">Cédula de Ciudadanía</option>
                        <option value="TI">Tarjeta de Identidad</option>
                        <option value="CE">Cédula de Extranjería</option>
                    </select>
                    <input type="text" id="id_number" name="id_number" class="mt-1 w-full px-4 py-2 border rounded-md bg-blue-100" placeholder="Documento de identidad" required>
                </div>
            </div>
            <div>
                <label for="birthdate" class="block text-sm font-medium text-gray-700">Fecha de nacimiento <span class="text-red-600">*</span></label>
                <div class="flex space-x-2">
                    <select id="birth_day" name="birth_day" class="mt-1 px-4 py-2 border rounded-md bg-blue-100 flex-grow" required>
                        <?php for ($i = 1; $i <= 31; $i++) echo "<option value='$i'>$i</option>"; ?>
                    </select>
                    <select id="birth_month" name="birth_month" class="mt-1 px-4 py-2 border rounded-md bg-blue-100 flex-grow" required>
                        <?php
                        $months = ['ene.', 'feb.', 'mar.', 'abr.', 'may.', 'jun.', 'jul.', 'ago.', 'sep.', 'oct.', 'nov.', 'dic.'];
                        foreach ($months as $index => $month) echo "<option value='" . ($index + 1) . "'>$month</option>";
                        ?>
                    </select>
                    <select id="birth_year" name="birth_year" class="mt-1 px-4 py-2 border rounded-md bg-blue-100 flex-grow" required>
                        <?php for ($i = 1950; $i <= date("Y"); $i++) echo "<option value='$i'>$i</option>"; ?>
                    </select>
                </div>
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Celular <span class="text-red-600">*</span></label>
                <input type="text" id="phone" name="phone" class="mt-1 w-full px-4 py-2 border rounded-md bg-blue-100" placeholder="Celular" required>
            </div>
            <div>
                <input type="checkbox" id="terms" name="terms" class="mt-1">
                <label for="terms" class="text-sm font-medium text-gray-700">Acepto los Términos y Condiciones de Uso del Portal. Para más información, <a href="#" class="text-blue-500">Haga Clic Aquí</a>. <span class="text-red-600">*</span></label>
            </div>
            <div>
                <input type="checkbox" id="data" name="data" class="mt-1">
                <label for="data" class="text-sm font-medium text-gray-700">En cumplimiento del Régimen de Protección Datos Personales, autorizo expresamente a Cine Colombia S.A.S. de manera directa, o a través de terceros designados, para almacenar, consultar, procesar y en general, para dar tratamiento a la información personal que suministre, y para ser incluido en sus bases de datos, recibir información de la Compañía, de conformidad con las políticas de privacidad y manejo de información. Para más información, <a href="#" class="text-blue-500">Haga Clic Aquí</a> <span class="text-red-600">*</span></label>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Autorizo recibir información por:</label>
                <div class="space-y-2">
                    <div>
                        <input type="checkbox" id="info_email" name="info_email" class="mt-1">
                        <label for="info_email" class="text-sm font-medium text-gray-700">Correo Electrónico</label>
                    </div>
                    <div>
                        <input type="checkbox" id="info_phone" name="info_phone" class="mt-1">
                        <label for="info_phone" class="text-sm font-medium text-gray-700">Llamada telefónica</label>
                    </div>
                    <div>
                        <input type="checkbox" id="info_sms" name="info_sms" class="mt-1">
                        <label for="info_sms" class="text-sm font-medium text-gray-700">Mensajes de texto SMS (sin costo al usuario)</label>
                    </div>
                    <div>
                        <input type="checkbox" id="info_whatsapp" name="info_whatsapp" class="mt-1">
                        <label for="info_whatsapp" class="text-sm font-medium text-gray-700">Mensajes de WhatsApp</label>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <button type="submit" id="registerButton" class="bg-white border-gray-400 border  text-gray-500 px-6 py-2 rounded-full disabled:opacity-50">Registrarme</button>
            </div>
        </form>
    </main>
</div>
<?php
require_once "./views/components/footer.php";
?>

<<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registrationForm');
    const registerButton = document.getElementById('registerButton');

    const inputs = Array.from(form.querySelectorAll('input[required], select[required]'));

    form.addEventListener('input', function () {
        let allFilled = inputs.every(input => input.value.trim() !== '');
        registerButton.disabled = !allFilled;
        registerButton.classList.toggle('bg-white', !allFilled);
        registerButton.classList.toggle('bg-[#1C508D]', allFilled);
        registerButton.classList.toggle('text-white', allFilled);

    });
});
</script>
