<?php
require_once "./views/components/head.php";
?>

<div class="pt-[8rem] mx-auto container bg-contain bg-no-repeat  bg-center" style="background-image: url('<?= $this->movie['background'] ?>');">
    <main class="flex-grow mx-auto container bg-white bg-opacity-90 p-6  ">
        <article class="w-full pb-[4rem]">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/3 flex-shrink-0">
                    <img src="<?= $this->movie['img'] ?>" alt="<?= $this->movie['title'] ?>" class="w-full h-auto object-cover rounded-lg shadow-lg">
                </div>
                <div class="md:w-2/3 md:ml-6 mt-4 md:mt-0">
                    <h3 class="text-3xl font-bold text-[#1c508d]"><?= $this->movie['title'] ?></h3>
                    <p class="text-lg text-gray-600 mb-4"><?= $this->movie['subtitle'] ?></p>
                    <p class="text-gray-700 mb-2"><strong>Estreno:</strong> <?= $this->movie['release_date'] ?></p>
                    <p class="text-gray-700 mb-2"><strong>Género:</strong> <?= $this->movie['genre'] ?></p>
                    <div class="flex items-center mt-[1rem] gap-2 mb-4">
                        <span class="inline-block bg-red-500 text-white text-xs rounded-xs py-[.3125rem] px-[.625rem]"><?= $this->movie['rating'] ?></span>
                        <span class="inline-block bg-gray-300 text-black text-xs rounded-xs py-[.3125rem] px-[.625rem]"><?= $this->movie['duration'] ?></span>
                    </div>
                    <p class="text-gray-800 mb-6">Al caer el mundo, la joven Furiosa (Anya Taylor-Joy) es arrebatada del Lugar Verde de Muchas Madres y cae en manos de una gran Horda de Motoristas liderada por el Señor de la Guerra Dementus. Arrasando el Páramo, se topan con la Ciudadela presidida por El Inmortan Joe. Mientras los dos Tiranos luchan por el dominio, Furiosa debe sobrevivir a muchas pruebas mientras reúne los medios para encontrar el camino de vuelta a casa. Precuela de "Mad Max: Furia en la carretera" (2015)</p>

                    <h4 class="text-xl font-bold text-[#1c508d] mb-2">MAY</h4>
                    <div class="flex items-center space-x-2 mb-4">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded">25 SAB</button>
                        <button class="bg-gray-300 text-black px-4 py-2 rounded">26 DOM</button>
                        <button class="bg-gray-300 text-black px-4 py-2 rounded">27 LUN</button>
                        <button class="bg-gray-300 text-black px-4 py-2 rounded">28 MAR</button>
                        <button class="bg-gray-300 text-black px-4 py-2 rounded">29 MIE</button>
                        <button class="bg-gray-300 text-black px-4 py-2 rounded">...</button>
                        <button class="bg-gray-300 text-black px-4 py-2 rounded">
                            <i class="fas fa-calendar-alt"></i>
                        </button>
                    </div>
                    <button class="bg-[#1c508d] text-white px-4 py-2 rounded">Filtrar Funciones</button>
                </div>
            </div>
        </article>
    </main>
</div>

<?php
require_once "./views/components/footer.php";
?>