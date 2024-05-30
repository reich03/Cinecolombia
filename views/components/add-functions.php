<div id="functionModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-[#1C508D] px-4 pt-5 pb-4 sm:p-6 sm:pb-4 rounded-t-lg">
                <h3 class="text-lg leading-6 font-semibold text-white text-center" id="modalTitle">Agregar/Editar Función</h3>
            </div>
            <div class="p-4">
                <form id="functionForm">
                    <div class="mb-4">
                        <label for="functionStartTime" class="block text-sm text-gray-600">Hora de Inicio <span class="text-red-700">*</span></label>
                        <input type="time" id="functionStartTime" name="hora_inicio" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                    </div>
                    <div class="mb-4">
                        <label for="functionEndTime" class="block text-sm text-gray-600">Hora de Fin <span class="text-red-700">*</span></label>
                        <input type="time" id="functionEndTime" name="hora_fin" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                    </div>
                    <div class="mb-4">
                        <label for="functionDate" class="block text-sm text-gray-600">Fecha <span class="text-red-700">*</span></label>
                        <input type="date" id="functionDate" name="fecha" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                    </div>
                    <div class="mb-4">
                        <label for="functionMovie" class="block text-sm text-gray-600">Película <span class="text-red-700">*</span></label>
                        <select id="functionMovie" name="idpeliculas" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                            <?php foreach ($this->movies as $movie) : ?>
                                <option value="<?= $movie['idpeliculas'] ?>"><?= $movie['titulo'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="functionRoom" class="block text-sm text-gray-600">Sala <span class="text-red-700">*</span></label>
                        <select id="functionRoom" name="idsala" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                            <?php foreach ($this->rooms as $room) : ?>
                                <option value="<?= $room['idsala'] ?>"><?= $room['nombre_sala'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" id="functionId" name="idfuncion">
                    <div class="flex mt-4">
                        <button type="submit" class="!bg-[#1C508D] text-white w-full px-4 py-2 !rounded-2xl">Guardar</button>
                        <button type="button" id="closeModal" class="ml-4 !bg-red-500 text-white w-full px-4 py-2 !rounded-2xl">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>