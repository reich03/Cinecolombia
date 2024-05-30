<div id="roomModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-[#1C508D] px-4 pt-5 pb-4 sm:p-6 sm:pb-4 rounded-t-lg">
                <h3 class="text-lg leading-6 font-semibold text-white text-center" id="modalTitle">Agregar/Editar Sala</h3>
            </div>
            <div class="p-4">
                <form id="roomForm">
                    <div class="mb-4">
                        <label for="roomName" class="block text-sm text-gray-600">Nombre <span class="text-red-700">*</span></label>
                        <input type="text" id="roomName" name="nombre_sala" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                    </div>
                    <div class="mb-4">
                        <label for="roomCapacity" class="block text-sm text-gray-600">Capacidad <span class="text-red-700">*</span></label>
                        <input type="number" id="roomCapacity" name="capacidad" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                    </div>
                    <div class="mb-4">
                        <label for="cantPrefe" class="block text-sm text-gray-600">Cantidad Preferencial <span class="text-red-700">*</span></label>
                        <input type="number" id="cantPrefe" name="cant_prefe" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                    </div>
                    <div class="mb-4">
                        <label for="cantGen" class="block text-sm text-gray-600">Cantidad General <span class="text-red-700">*</span></label>
                        <input type="number" id="cantGen" name="cant_gen" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                    </div>
                    <div class="mb-4">
                        <label for="roomType" class="block text-sm text-gray-600">Tipo <span class="text-red-700">*</span></label>
                        <input type="text" id="roomType" name="tipo_sala" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                    </div>
                    <div class="mb-4">
                        <label for="roomPreferential" class="block text-sm text-gray-600">Preferencial <span class="text-red-700">*</span></label>
                        <input type="checkbox" id="roomPreferential" name="preferencial" class="bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                    </div>
                    <input type="hidden" id="roomId" name="idsala">
                    <div class="flex mt-4">
                        <button type="submit" class="!bg-[#1C508D] text-white w-full px-4 py-2 !rounded-2xl">Guardar</button>
                        <button type="button" id="closeModal" class="ml-4 !bg-red-500 text-white w-full px-4 py-2 !rounded-2xl">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
