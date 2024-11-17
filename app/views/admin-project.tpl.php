<!-- <?php dump($project) ?> -->
<h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 sm:w-[60%] mb-5 sm:mt-12">
    <?= $project->title ?>
</h1>
<section class="rounded p-2 bg-white/[0.15] sm:p-14">
    <div class="rounded p-2.5 w-full grid grid-cols-4 gap-4 auto-rows-max">
        <div class="bg-white rounded p-2.5 col-span-3">
            <h3 class="text-2xl uppercase font-bold text-btn-sec">Description</h3>
            <p><?= $project->description ?></p>
        </div>
        <div class="bg-white rounded p-2.5 col-start-2 row-start-2 col-span-3">
            <h3 class="text-2xl uppercase font-bold text-btn-sec">Les languages ou frameworks</h3>
            <div class="flex flex-row gap-2.5 my-2.5">
                <?php foreach ($project->labels as $label) : ?>
                    <span class="flex flex-col gap-2.5 items-center mb-2">
                        <img src="<?php echo '/assets/images/languages/' . $label['picture'] ?>" alt="" class="w-9 h-9" />
                        <h3 class="text-xl font-bold text-btn-sec"><?= $label['label'] ?></h3>
                    </span>
    
                <?php endforeach ?>
            </div>
        </div>
        <div class="bg-white rounded p-2.5">
            <img src="<?= "/assets/images/projects/" . $project->picture ?>" alt=" ">
        </div>
        <div class="bg-white rounded p-2.5 place-content-center">
            <?php if (isset($project->title_organization, $project->picture_organization)) : ?>
                <span class="flex flex-col gap-2.5 items-center mb-2">
                    <img src="<?php echo '/assets/images/organizations/' . $project->picture_organization ?>" alt="" class="w-9 h-9" />
                    <h3 class="text-xl font-bold text-btn-sec"><?= $project->title_organization ?></h3>
                </span>
            <?php endif ?>
        </div>
        <?php if (isset($project->url)) : ?>
            <a href="<?= $project->url ?>" class="row-start-3">
                <button class="bg-btn-sec rounded flex p-2.5 justify-center items-center gap-2 mt-5 w-full sm:w-max font-bold text-xl">
                    <img src="/assets/images/icons/online.svg" alt=" ">
                    <p class="text-white">Voir le projet en ligne</p>
                </button>
            </a>
        <?php endif ?>
    </div>
</section>