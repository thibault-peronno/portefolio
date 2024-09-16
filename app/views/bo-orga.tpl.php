<?php dump($organization) ?>
<h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 sm:w-[60%] mb-5 sm:mt-12">
    <?= $organization['title'] ?>
</h1>
<section class="rounded p-2 bg-white/[0.15] sm:p-14">
    <div class="rounded p-2.5 shadow-card w-full bg-white">
        <h3 class="text-2xl uppercase font-bold text-btn-sec mb-2.5">Description</h3>
        <p><?= $organization['description'] ?></p>
        <h3 class="text-2xl uppercase font-bold text-btn-sec mt-5 mb-2.5">Logo</h3>
        <div class="flex flex-row gap-2.5">
                    <img src="<?php echo '/assets/images/organizations/' . $organization['picture'] ?>" alt="" class="w-14 h-14" />
        </div>
    </div>
</section>