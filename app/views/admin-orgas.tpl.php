<!-- <?php dump($organizations) ?> -->
<section class="section">
    <h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 w-max rounded mb-5 sm:mt-12">
        back office Organisations
    </h1>
    <a href="admin-ajouter-organisation">
        <button class="button-admin flex justify-center items-center gap-2 my-5">
            <img src="/assets/images/icons/add.svg" alt="" />
            <p class="text-white">Ajouter</p>
        </button>
    </a>
    <div class="snap-x flex overflow-x-auto gap-5 p-2.5 sm:snap-none sm:gap-10 sm:flex-wrap">
        <?php foreach ($organizations as $organization) : ?>
            <div class="rounded p-2.5 shadow-card w-max shrink-0 snap-start bg-white">
                <span class="flex gap-2.5 items-center mb-2">
                    <img src="<?= '/assets/images/organizations/' . $organization->get_picture() ?>" alt="" class="w-9 h-9" />
                    <h3 class="text-xl font-bold text-btn-sec"><?= $organization->get_title() ?></h3>
                </span>
                <span class="flex gap-5 sm:flex-nowrap">
                    <a href="<?= '/admin-editer-organisation/' . $organization->get_id() ?>">
                        <button class="button-admin text-center mt-5 sm:w-32">
                            Editer
                        </button>
                    </a>
                    <button class="button-admin text-center mt-5 p-2 sm:w-32">
                        Supprimer
                    </button>
                </span>
            </div>
        <?php endforeach ?>
    </div>
</section>