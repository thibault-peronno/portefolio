<!-- <?php dump($projects); ?> -->
<main class="grow">
      <section class="section">
        <h1 class="heading-1 mb-5 sm:mt-12">Mes projets</h1>
        <div class="sm:flex sm:gap-10 sm:flex-wrap">
        <?php foreach ($projects as $project) : ?>
            <a href="<?= "/projet/" . $project->get_id() ?>">
                <div class="h-96 mb-6 border bg-white rounded snap-start shrink-0 sm:w-[450px] lg:hover:-translate-y-1.5 transition ease-in-out duration-200">
                    <div class="w-auto h-3/4 mb-3">
                        <img src="<?= "/assets/images/projects/" . $project->get_picture() ?>" alt="Image du projet" class="h-full w-full rounded-t">
                    </div>
                    <div class="p-2">
                        <p class="text-lg font-bold text-btn-sec inline-block"><?= $project->get_title() ?></p>
                        <div class="flex justify-start gap-2">
                            <?php foreach ($project->get_labels() as $label) : ?>
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