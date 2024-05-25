<div class="swiper-container mt-0 mb-2 w-full">
    <div class="swiper-wrapper">
        <?php
        $movies = [
            ["title" => "Monkey Man", "subtitle" => "El Despertar de la Bestia", "release_date" => "23 May 2024", "genre" => "Acción, Suspenso", "img" => "/Cine-Colombia/assets/images/imagenes-prueba/387ac9bae5a3-mkm_cineco_pstr-crrs_575x805.jpg"],
            ["title" => "Capitán Avispa", "subtitle" => "", "release_date" => "23 May 2024", "genre" => "Acción, Animación, Aventura, Familiar, Fantasía, Musical", "img" => "/Cine-Colombia/assets/images/imagenes-prueba/6a72abab83d3-575805.jpg"],
            ["title" => "Furiosa: A Mad Max Saga", "subtitle" => "", "release_date" => "23 May 2024", "genre" => "Acción, Ciencia Ficción", "img" => "/Cine-Colombia/assets/images/imagenes-prueba/e06f3c52fb9b-warner_furiosa_cinecol_575x805.jpg"],
            ["title" => "Kingdom of the Planet of the Apes", "subtitle" => "Nuevo Reino", "release_date" => "09 May 2024", "genre" => "Acción, Ficción", "img" => "/Cine-Colombia/assets/images/imagenes-prueba/dd5f31c7bbaa-575x805_postercarrusel_cinecolombia_elplanetadelossimios.jpg"],
            ["title" => "My Heart Puppy", "subtitle" => "Mis Cachorros Adorables", "release_date" => "16 May 2024", "genre" => "Familiar, Infantil", "img" => "/Cine-Colombia/assets/images/imagenes-prueba/f9286e42d1b9-poster-carrusel.jpg"],
 
        ];

        foreach ($movies as $movie) {
            echo '<div class="swiper-slide relative cursor-pointer">
            <img src="' . $movie['img'] . '" alt="' . $movie['title'] . '" class="w-full h-full object-cover transition-transform duration-300 ease-in-out scale-100 rounded-[0]">
            <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black to-transparent p-4 w-full">
                <h2 class="text-white text-xl font-bold">' . $movie['title'] . '</h2>
                <p class="text-gray-300">' . $movie['subtitle'] . '</p>
                <p class="text-gray-300">Estreno: ' . $movie['release_date'] . '</p>
                <p class="text-gray-300">Género: ' . $movie['genre'] . '</p>
            </div>
        </div>';
        }
        ?>
    </div>
</div>
