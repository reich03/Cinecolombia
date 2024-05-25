<div class="swiper-container swiper-container-products mt-0 mb-2 w-full px-4">
    <div class="swiper-wrapper products">
        <?php
        $products = [
            ["title" => "Matiné en Cine Colombia", "img" => "/Cine-Colombia/assets/images/c10cdeecd2dd-cc-post-matine-0201.png"],
            ["title" => "Descarga Cine Colombia", "img" => "/Cine-Colombia/assets/images/7f650afc63b9-icono-cine-colombia.png"],
            ["title" => "Cine Colombia Información", "img" => "/Cine-Colombia/assets/images/42b5b356e70e-cc-cineco-platino-2709-13.png"],
            ["title" => "Cineco Platino", "img" => "/Cine-Colombia/assets/images/DatosCineco.png"]
        ];

        foreach ($products as $product) {
            echo '<div class="swiper-slide products flex justify-center items-center ">
                    <img src="' . $product['img'] . '" alt="' . $product['title'] . '" class="w-full  object-cover rounded-md">
                  </div>';
        }
        ?>
    </div>
    
    <div class="swiper-button-next swiper-button-next-products"></div>
    <div class="swiper-button-prev swiper-button-prev-products"></div>
</div>



<script>

    var swiperProducts = new Swiper('.swiper-container-products', {
        slidesPerView: 4,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next-products',
            prevEl: '.swiper-button-prev-products',
        },
        pagination: {
            el: '.swiper-pagination-products',
            clickable: true,
        },
    });

</script>
