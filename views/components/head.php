<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cine Colombia - Villavicencio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="/Cine-Colombia/assets/images/favicon-32x32.png" sizes="32x32">
    <link rel="stylesheet" href="/Cine-Colombia/assets/css/root.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="flex flex-col min-h-screen">
    <header class="bg-black text-white py-[2rem] fixed w-full top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <button id="open-sidebar" class="text-white">
                    <i class="fas fa-bars text-[2rem]"></i>
                </button>
                <a href="/Cine-Colombia">
                    <img src="/Cine-Colombia/assets/images/cinecolombia.webp" alt="Cine Colombia" class="h-16">
                </a>
            </div>
            <nav class="flex space-x-4 md:relative md:left-[12%]">
                <a href="/Cine-Colombia/movies/" class="nav-button text-white rounded-full px-3 py-1">Cartelera</a>
                <a href="#" class="nav-button text-white rounded-full px-3 py-1">Pronto</a>
                <a href="#" class="nav-button text-white rounded-full px-3 py-1">Cineco Alternativo</a>
                <a href="#" class="nav-button text-white rounded-full px-3 py-1">Comidas</a>
            </nav>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Buscar" class="bg-gray-800 text-white rounded-full px-4 py-2">
                    <button class="absolute right-0 top-0 mt-2 mr-2 text-white">
                        <i class="fas fa-search"></i>
                    </button>
                    <div id="searchResults" class="absolute mt-12 bg-white text-black rounded-lg shadow-lg z-50 hidden"></div>
                </div>
                <span>Villavicencio</span>
                <div class="relative">
                    <button id="user-menu" class="relative text-white focus:outline-none">
                        <i class="fas fa-user"></i>
                    </button>
                    <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-[20rem] bg-white text-black rounded-lg shadow-lg z-50 !top-[2rem] !right-[-18px]">
                        <?php
                        session_start();
                        if (isset($_SESSION['user'])) {
                            include 'user-connected.php';
                        } else {
                            include 'user-modal.php';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php include 'sidebar.php'; ?>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                let query = $(this).val().toLowerCase();
                if (query.length > 0) {
                    $.ajax({
                        url: '/Cine-Colombia/getmovies/getAllMovies', 
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            let filteredMovies = data.filter(movie => movie.titulo.toLowerCase().includes(query));
                            let resultsHtml = '';
                            if (filteredMovies.length > 0) {
                                filteredMovies.forEach(movie => {
                                    resultsHtml += `
                                <a href="/Cine-Colombia/movies/view/${movie.idpeliculas}" class="buscador-element block px-4 py-2 bg-white flex items-center space-x-2 hover:bg-[#1C508D] rounded-lg mb-2">
                                    <i class="fas fa-film text-[#1C508D] "></i>
                                    <div>
                                        <h3 class="text-[#1C508D] font-semibold">${movie.titulo}</h3>
                                        <p class="text-[#1C508D] text-sm">${movie.subtitulo}</p>
                                    </div>
                                </a>`;
                                });
                            } else {
                                resultsHtml = '<div class="block px-4 py-2">No se encontraron resultados</div>';
                            }
                            $('#searchResults').html(resultsHtml).removeClass('hidden');
                        }
                    });
                } else {
                    $('#searchResults').addClass('hidden');
                }
            });

            $(document).on('click', function(event) {
                if (!$(event.target).closest('#searchInput, #searchResults').length) {
                    $('#searchResults').addClass('hidden');
                }
            });
        });
    </script>
</body>

</html>