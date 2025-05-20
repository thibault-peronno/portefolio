<!-- <?php dump($project) ?> -->
<section class="section">
    <h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 sm:w-[60%] mb-5 sm:mt-12">
        <?= $project->get_title() ?>
    </h1>
    <div class="rounded p-2.5 w-full grid grid-cols-4 gap-4 auto-rows-max">
        <div class="bg-white rounded p-2.5 col-span-3">
            <h3 class="text-2xl uppercase font-bold text-btn-sec">Description</h3>
            <p><?= $project->get_description() ?></p>
        </div>
        <div class="bg-white rounded p-2.5 col-start-2 row-start-2 col-span-3">
            <h3 class="text-2xl uppercase font-bold text-btn-sec">Langages ou frameworks</h3>
            <div class="flex flex-row gap-2.5 my-2.5">
                <?php foreach ($project->get_labels() as $label) : ?>
                    <span class="flex flex-col gap-2.5 items-center mb-2">
                        <img src="<?php echo '/assets/images/languages/' . $label['picture'] ?>" alt="" class="w-9 h-9" />
                        <h3 class="text-xl font-bold text-btn-sec"><?= $label['label'] ?></h3>
                    </span>

                <?php endforeach ?>
            </div>
        </div>
        <div class="bg-white rounded p-2.5">
            <img src="<?= "/assets/images/projects/" . $project->get_picture() ?>" alt=" ">
        </div>
        <div class="bg-white rounded p-2.5 place-content-center">
            <?php if ($project->get_title_organization() !== null && $project->get_picture_organization() !== null) : ?>
                <span class="flex flex-col gap-2.5 items-center mb-2">
                    <img src="<?php echo '/assets/images/organizations/' . $project->get_picture_organization() ?>" alt="" class="w-9 h-9" />
                    <h3 class="text-xl font-bold text-btn-sec"><?= $project->get_title_organization() ?></h3>
                </span>
            <?php endif ?>
        </div>
        <?php if ($project->get_url() !== null) : ?>
            <a href="<?= $project->get_url() ?>" class="row-start-3">
                <button class="button-admin flex justify-center items-center gap-2 mt-5 sm:w-max">
                    <img src="/assets/images/icons/online.svg" alt=" ">
                    <p class="text-white">Voir le projet en ligne</p>
                </button>
            </a>
        <?php endif ?>
    </div>
</section>