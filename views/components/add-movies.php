<div id="movieModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle  md:max-w-[65rem] h-[40rem] overflow-scroll md:w-full">
            <div class="bg-[#1C508D] px-4 pt-5 pb-4 sm:p-6 sm:pb-4 rounded-t-lg">
                <h3 class="text-lg leading-6 font-semibold text-white text-center" id="modalTitle">Agregar/Editar Película</h3>
            </div>
            <div class="p-4">
                <form id="movieForm" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="movieTitle" class="block text-sm text-gray-600">Título <span class="text-red-700">*</span></label>
                        <input type="text" id="movieTitle" name="titulo" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                    </div>
                    <div class="mb-4">
                        <label for="movieSubtitle" class="block text-sm text-gray-600">Subtítulo</label>
                        <input type="text" id="movieSubtitle" name="subtitulo" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                    </div>
                    <div class="mb-4">
                        <label for="moviesinopsis" class="block text-sm text-gray-600">Sinopsis</label>
                        <input type="text" id="moviesinopsis" name="sinopsis" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                    </div>
                    <div class="mb-4">
                        <label for="movieReleaseDate" class="block text-sm text-gray-600">Fecha de Estreno <span class="text-red-700">*</span></label>
                        <input type="date" id="movieReleaseDate" name="fecha_estreno" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                    </div>
                    <div class="mb-4">
                        <label for="movieReleaseDateEnd" class="block text-sm text-gray-600">Fecha de Retiro <span class="text-red-700">*</span></label>
                        <input type="date" id="movieReleaseDateEnd" name="fecha_retiro" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                    </div>
                    <div class="mb-4">
                        <label for="movieGenre" class="block text-sm text-gray-600">Género <span class="text-red-700">*</span></label>
                        <input type="text" id="movieGenre" name="genero" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                    </div>
                    <div class="mb-4">
                        <label for="movieRating" class="block text-sm text-gray-600">Clasificación <span class="text-red-700">*</span></label>
                        <input type="text" id="movieRating" name="clasificacion" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                    </div>
                    <div class="mb-4">
                        <label for="movieDuration" class="block text-sm text-gray-600">Duración (min) <span class="text-red-700">*</span></label>
                        <input type="number" id="movieDuration" name="duracion" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                    </div>
                    <div class="mb-4">
                        <label for="movieImage" class="block text-sm text-gray-600">Imagen</label>
                        <input type="file" id="movieImage" name="imagen" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                    </div>
                    <div class="mb-4">
                        <label for="movieBackground" class="block text-sm text-gray-600">Imagen de Fondo</label>
                        <input type="file" id="movieBackground" name="background" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                    </div>
                    <div class="mb-4">
                        <label for="movieDirector" class="block text-sm text-gray-600">Director <span class="text-red-700">*</span></label>
                        <select id="movieDirector" name="iddirector" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100">
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="movieActors" class="block text-sm text-gray-600">Actores</label>
                        <select id="movieActors" name="actores[]" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100" multiple>
                        </select>
                        <label for="actorCharacters" class="block text-sm text-gray-600">Personajes</label>
                        <input type="text" id="actorCharacters" name="personaje_name[]" class="w-full px-3 py-2 bg-[#E8F0FE] rounded-[0.65rem] bg-blue-100" multiple>
                    </div>

                    <input type="hidden" id="movieId" name="idpeliculas">
                    <div class="flex mt-4">
                        <button type="submit" class="!bg-[#1C508D] text-white w-full px-4 py-2 !rounded-2xl">Guardar</button>
                        <button type="button" id="closeModal" class="ml-4 !bg-red-500 text-white w-full px-4 py-2 !rounded-2xl">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>