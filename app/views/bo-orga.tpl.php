<!-- <?php dump($organizations) ?> -->
<h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 sm:w-[60%] mb-5 sm:mt-12">
    back office Organisations
</h1>
<section class="rounded p-2 bg-white/[0.15] sm:p-14">
    <a href="bo-ajouter-organisation">
        <button class="bg-btn-sec rounded flex p-2.5 justify-center items-center gap-2 mt-5 w-full sm:w-64 font-bold text-xl">
            <img src="/assets/images/icons/add.svg" alt="" />
            <p class="text-white">Ajouter</p>
        </button>
    </a>
    <div class="snap-x flex overflow-x-auto gap-5 p-2.5 sm:snap-none sm:gap-10 sm:flex-wrap">
    <?php foreach($organizations as $organization) : ?>
        <div class="rounded p-2.5 shadow-card w-max shrink-0 snap-start bg-white">
            <span class="flex gap-2.5 items-center mb-2">
                <img src="<?= '/assets/images/organizations/' . $organization->picture ?>" alt="" class="w-9 h-9" />
                <h3 class="text-xl font-bold text-btn-sec"><?= $organization->title ?></h3>
            </span>
            <span class="flex gap-5 sm:flex-nowrap">
                <a href="<?= '/bo-editer-organisation/' . $organization->id ?>">
                    <button class="bg-btn-sec rounded text-center mt-5 p-2 sm:w-32 text-white font-bold text-xl">
                        Editer
                    </button>
                </a>
                <button class="bg-btn-sec rounded text-center mt-5 p-2 sm:w-32 text-white font-bold text-xl">
                    Supprimer
                </button>
            </span>
        </div>
    <?php endforeach ?>
    </div>
</section>