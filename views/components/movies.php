<div class="container mx-auto mt-8 pb-6">
    <h2 class="text-[20px] font-semibold pb-8 pt-6">EN CARTELERA</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($this->movies as $movie) : ?>
            <div class="bg-white shadow-md rounded-lg overflow-hidden cursor-pointer">
                <a href="/Cine-Colombia/movies/view/<?= $movie['idpeliculas'] ?>">
                    <img src="<?= $movie['imagen'] ?>" alt="<?= $movie['titulo'] ?>" class="w-full h-[30rem] object-cover md:object-fill">
                </a>
                <div class="p-4">
                    <h3 class="text-lg font-bold"><a href="/Cine-Colombia/movies/view/<?= $movie['idpeliculas'] ?>"><?= $movie['titulo'] ?></a></h3>
                    <p class="text-gray-600"><?= $movie['subtitulo'] ?></p>
                    <p class="text-gray-600">Estreno: <?= $movie['fecha_estreno'] ?></p>
                    <p class="text-gray-600">Género: <?= $movie['genero'] ?></p>
                    <div class="flex items-center mt-[1rem] gap-2">
                        <span class="inline-block bg-red-500 text-white text-xs rounded-xs py-[.3125rem] px-[.625rem]">Disponible desde  <?= $movie['clasificacion'] ?></span>
                        <span class="inline-block bg-gray-300 text-black text-xs rounded-xs py-[.3125rem] px-[.625rem]"><?= $movie['duracion'] ?> min</span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- <div class="flex items-center justify-end mt-4">
        <a href="/Cine-Colombia/movies/">
            <button class="button-cartelera bg-white border border-[#1c508d] hover:bg-[#1c508d] text-white py-3 px-5 rounded-full flex items-center">
                <h3 class="text-[#1c508d]">Ver todo</h3>
                <svg class="ml-2 w-4 h-4 text-[#1c508d]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </a>
    </div> -->
</div>
