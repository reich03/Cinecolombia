<?php
require_once "./views/components/head.php";
?>
<div class="pt-[8rem]">
    <main class="flex-grow mx-auto container">
        <article class="w-full pb-[4rem]">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="<?= $this->movie['img'] ?>" alt="<?= $this->movie['title'] ?>" class="w-full h-auto object-cover">
                <div class="p-4">
                    <h3 class="text-2xl font-bold"><?= $this->movie['title'] ?></h3>
                    <p class="text-gray-600"><?= $this->movie['subtitle'] ?></p>
                    <p class="text-gray-600">Estreno: <?= $this->movie['release_date'] ?></p>
                    <p class="text-gray-600">Género: <?= $this->movie['genre'] ?></p>
                    <div class="flex items-center mt-[1rem] gap-2">
                        <span class="inline-block bg-red-500 text-white text-xs rounded-xs py-[.3125rem] px-[.625rem]"><?= $this->movie['rating'] ?></span>
                        <span class="inline-block bg-gray-300 text-black text-xs rounded-xs py-[.3125rem] px-[.625rem]"><?= $this->movie['duration'] ?></span>
                    </div>
                </div>
            </div>
        </article>
    </main>
</div>
<?php
require_once "./views/components/footer.php";
?>
