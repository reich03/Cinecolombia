<?php
$movies = [
    [
        "title" => "Furiosa: A Mad Max Saga",
        "subtitle" => "De la Saga De Mad Max",
        "release_date" => "23 May 2024",
        "genre" => "Acción, Ciencia Ficción",
        "img" => "/Cine-Colombia/assets/images/imagenes-prueba/0f45bff0c4ca-warner_furiosa_cinecol_480x670.jpg",
        "rating" => "Exclusiva para Mayores de 15 años",
        "duration" => "148 Min"
    ],
    [
        "title" => "Kingdom of the planet of the Apes",
        "subtitle" => "El Planeta de los Simios: Nuevo Reino",
        "release_date" => "09 May 2024",
        "genre" => "Acción, Ficción",
        "img" => "/Cine-Colombia/assets/images/imagenes-prueba/7ab0aa509396-elplanetadelossimios_posterweb.jpg",
        "rating" => "Recomendada para Mayores de 7 años",
        "duration" => "150 Min"
    ],
    [
        "title" => "Monkey Man",
        "subtitle" => "El Despertar de la Bestia",
        "release_date" => "23 May 2024",
        "genre" => "Acción, Suspenso",
        "img" => "/Cine-Colombia/assets/images/imagenes-prueba/bc2b2cce400d-mkm_cineco_pstr-dskp_480x670.png",
        "rating" => "Exclusiva para Mayores de 15 años",
        "duration" => "121 Min"
    ],
    [
        "title" => "Capitán Avispa",
        "subtitle" => "",
        "release_date" => "23 May 2024",
        "genre" => "Acción, Animación, Aventura, Familiar, Fantasía, Musical",
        "img" => "/Cine-Colombia/assets/images/imagenes-prueba/be2a8aef4014-480670.jpg",
        "rating" => "Para todo el Público",
        "duration" => "90 Min"
    ],
    [
        "title" => "Capitán Avispa",
        "subtitle" => "",
        "release_date" => "23 May 2024",
        "genre" => "Acción, Animación, Aventura, Familiar, Fantasía, Musical",
        "img" => "/Cine-Colombia/assets/images/imagenes-prueba/be2a8aef4014-480670.jpg",
        "rating" => "Para todo el Público",
        "duration" => "90 Min"
    ],
    [
        "title" => "Capitán Avispa",
        "subtitle" => "",
        "release_date" => "23 May 2024",
        "genre" => "Acción, Animación, Aventura, Familiar, Fantasía, Musical",
        "img" => "/Cine-Colombia/assets/images/imagenes-prueba/be2a8aef4014-480670.jpg",
        "rating" => "Para todo el Público",
        "duration" => "90 Min"
    ]
];
?>
<div class="container mx-auto mt-8">
    <h2 class="text-[20px] font-semibold pb-8 pt-6">EN CARTELERA </h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($movies as $movie) : ?>
            <div class="bg-white shadow-md rounded-lg overflow-hidden cursor-pointer	">
                <img src="<?= $movie['img'] ?>" alt="<?= $movie['title'] ?>" class="w-full h-[30rem] object-cover md:object-fill">
                <div class="p-4">
                    <h3 class="text-lg font-bold"><?= $movie['title'] ?></h3>
                    <p class="text-gray-600"><?= $movie['subtitle'] ?></p>
                    <p class="text-gray-600">Estreno: <?= $movie['release_date'] ?></p>
                    <p class="text-gray-600">Género: <?= $movie['genre'] ?></p>
                    <div class="flex items-center mt-[1rem] gap-2">
                        <span class="inline-block bg-red-500 text-white text-xs rounded-xs py-[.3125rem] px-[.625rem]"><?= $movie['rating'] ?></span>
                        <span class="inline-block bg-gray-300 text-black text-xs rounded-xs
                        py-[.3125rem] px-[.625rem]"><?= $movie['duration'] ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="flex items-center justify-end mt-4">
        <button class="button-cartelera bg-white border border-[#1c508d] hover:bg-[#1c508d] text-white py-3 px-5 rounded-full flex items-center">
            <h3 class="text-[#1c508d] ">Ver todo</h3>
            <svg class="ml-2 w-4 h-4 text-[#1c508d]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>

</div>