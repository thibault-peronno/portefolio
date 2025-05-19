<!-- <?php dump($projects); ?> -->
<main class="grow">
      <section class="p-2 sm:p-14">
        <h1 class="text-4xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 my-5 w-max sm:mt-12 rounded">Mes projets</h1>
        <div class="sm:flex sm:gap-10 sm:flex-wrap">
        <?php foreach ($projects as $project) : ?>
            <a href="<?= "/projet/" . $project->getId() ?>">
                <div class="h-96 mb-6 border bg-white rounded snap-start shrink-0 sm:w-[450px] lg:hover:-translate-y-1.5 transition ease-in-out duration-200">
                    <div class="w-auto h-3/4 mb-3">
                        <img src="<?= "/assets/images/projects/" . $project->getPicture() ?>" alt="Image du projet" class="h-full w-full rounded-t">
                    </div>
                    <div class="p-2">
                        <p class="text-l font-bold text-btn-sec inline-block"><?= $project->getTitle() ?></p>
                        <div class="flex justify-start gap-2">
                            <?php foreach ($project->getLabels() as $label) : ?>
                                <div class="bg-white border rounded-full">
                                    <img src="<?= "/assets/images/languages/" . $label['picture'] ?>" alt="<?= "icon " . $label['label'] ?>" class="w-4 h-4 m-2 " />
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach ?>
        </div>
      </section>
    </main>