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
</head>
<body class="flex flex-col min-h-screen">
<header class="bg-black text-white py-[2rem] fixed w-full top-0 z-50">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <button id="open-sidebar" class="text-white">
                <i class="fas fa-bars text-[2rem]"></i>
            </button>
            <img src="/Cine-Colombia/assets/images/cinecolombia.webp" alt="Cine Colombia" class="h-16">
        </div>
        <nav class="flex space-x-4">
            <a href="#" class="nav-button text-white rounded-full px-3 py-1">Cartelera</a>
            <a href="#" class="nav-button text-white rounded-full px-3 py-1">Pronto</a>
            <a href="#" class="nav-button text-white rounded-full px-3 py-1">Cineco Alternativo</a>
            <a href="#" class="nav-button text-white rounded-full px-3 py-1">Comidas</a>
        </nav>
        <div class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" placeholder="Buscar" class="bg-gray-800 text-white rounded-full px-4 py-2">
                <button class="absolute right-0 top-0 mt-2 mr-2 text-white">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <span>Villavicencio</span>
            <div class="relative">
                <button id="user-menu" class="relative text-white focus:outline-none">
                    <i class="fas fa-user"></i>
                </button>
                <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-64 bg-white text-black rounded-lg shadow-lg z-50">
                    <?php include 'user-modal.php'; ?>
                </div>
            </div>
        </div>
    </div>
</header>

<?php include 'sidebar.php'; ?>


</body>
</html>




