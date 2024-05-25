<div class="swiper-container mt-0 mb-2 w-full">
    <div class="swiper-wrapper">
        <?php
        require_once '../Cine-Colombia/assets/DataPrueba/Slider.php';


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