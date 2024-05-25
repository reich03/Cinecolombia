<footer class="bg-gray-100  py-8 mt-auto">
    <div class="container mx-auto flex justify-between items-center px-4 py-2">
        <img src="/Cine-Colombia/assets/images/logo_cineco_blue.svg" alt="Cine Colombia" class="h-8">
        <div class="flex items-center space-x-8">
            <nav class="flex space-x-4 items-center justify-center">
                <a href="#" class="hover:text-gray-900 text-[12px] pr-2 border-r border-r-[#4f627b]">Información Legal</a>
                <a href="#" class="hover:text-gray-900 text-[12px] pr-2 border-r border-r-[#4f627b]">Acerca de Cineco</a>
                <a href="#" class="hover:text-gray-900 text-[12px] pr-2 border-r border-r-[#4f627b]">Contáctanos PQRS</a>
                <a href="#" class="hover:text-gray-900 text-[12px] pr-2 border-r border-r-[#4f627b]">Preguntas Frecuentes</a>
            </nav>
        </div>


        <div class="flex flex-col items-center space-x-4">
            <span class=" text-[#4f627b] text-[12px]">Síguenos en redes sociales</span>
            <div class="flex gap-x-[1rem]">
                <a href="#" class=" hover:text-gray-900">
                    <i class=" text-[#4f627b] fab fa-facebook"></i>
                </a>
                <a href="#" class=" hover:text-gray-900">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class=" hover:text-gray-900">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="text-center pt-[4rem] pb-[2rem] text-[12px]">
        <p class="text-[#4f627b]">© 2024 Cine Colombia.</p>
    </div>
</footer>



<script>
    document.getElementById('open-sidebar').addEventListener('click', function() {
        document.getElementById('sidebar').classList.remove('-translate-x-full');
    });

    document.getElementById('close-sidebar').addEventListener('click', function() {
        document.getElementById('sidebar').classList.add('-translate-x-full');
    });

    document.getElementById('user-menu').addEventListener('click', function() {
        var dropdown = document.getElementById('user-dropdown');
        dropdown.classList.toggle('hidden');

        if (!dropdown.classList.contains('hidden')) {
            document.body.classList.add('body-overlay');
        } else {
            document.body.classList.remove('body-overlay');
        }
    });

    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 5,
        spaceBetween: 0,
        loop: true,
        loopFillGroupWithBlank: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 5,
            },
        },
        on: {
            init: function() {
                var slides = document.querySelectorAll('.swiper-slide img');
                slides.forEach(img => img.classList.remove('scale-120'));
                if (slides[this.realIndex]) {
                    slides[this.realIndex].classList.add('scale-120');
                }
            },
            slideChange: function() {
                var slides = document.querySelectorAll('.swiper-slide img');
                slides.forEach(img => img.classList.remove('scale-120'));
                if (slides[this.realIndex]) {
                    slides[this.realIndex].classList.add('scale-120');
                }
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        var slides = document.querySelectorAll('.swiper-slide img');
        slides.forEach(img => img.classList.remove('scale-120'));
        if (slides[swiper.realIndex]) {
            slides[swiper.realIndex].classList.add('scale-120');
        }
    });
</script>

</body>

</html>