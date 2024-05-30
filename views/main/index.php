<?php
require_once "./views/components/head.php";
?>
<div class="pt-[8rem]">
    <main class="flex-grow mx-auto ">
        <article class="w-full pb-[4rem]">
            <?php require_once "./views/components/slider.php"; ?>
        </article>

        <article class="flex-grow mx-auto container pb-4">
            <div class="flex items-center justify-center">
                <img src="/Cine-Colombia/assets/images/1e942ca52096-warner_furiosa_cinecol_750x90.jpg" alt="Cine Colombia" class="h-[6rem]">
            </div>
            <div class="flex items-center justify-center pt-4">
                <img src="/Cine-Colombia/assets/images/b26ef88567a6-planeta-de-los-simios.png" alt="Cine Colombia" class="h-[6rem]">
            </div>
        </article>

        <div class="pb-4">
            <?php require_once "./views/components/movies-preview.php"; ?>
        </div>
        <div class="pb-4">
            <?php require_once "./views/components/pronto.php"; ?>
        </div>

        <div class="py-10 flex-grow mx-auto container">
            <?php require_once "./views/components/slider_products.php"; ?>
        </div>
    </main>
</div>
<?php
require_once "./views/components/footer.php";
?>