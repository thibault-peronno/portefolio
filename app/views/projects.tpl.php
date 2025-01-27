<!-- <?php dump($projects); ?> -->
<main class="grow">
      <section class="sm:p-14">
        <h1 class="text-4xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 my-5 w-max sm:mt-12 rounded">Mes projets</h1>
        <div class="sm:flex sm:gap-10 sm:flex-wrap">
            <?php foreach($projects as $project) : ?>
            <div class="border-2 border-primary bg-white flex flex-col justify-between my-14 p-5 sm:w-96 sm:h-96 rounded">
              <h2 class="text-3xl text-secondary uppercase mb-10"><?= $project->getTitle() ?></h2>
              <div class="flex justify-start gap-2">
              <?php foreach($project->getLabels() as $label) : ?>
                <img
                  src="<?= "/assets/images/languages/" . $label['picture'] ?>"
                  alt="<?= "icon " . $label['label'] ?>"
                  class="w-9 h-9"
                />
                <?php endforeach ?>
              </div>
              <p class="my-5 text-clip overflow-hidden text-lg">
              <?= $project->getDescription() ?>
              </p>
              <a href="<?= "/projet/" . $project->getId() ?>">
                <button
                  class="bg-btn-sec rounded flex p-2.5 justify-between items-center mt-3 w-full "
                >
                  <p class="text-white">En savoir plus</p>
                  <img
                    src="/assets/images/icons/arrow-right-circle.svg"
                    alt=""
                  />
                </button>
              </a>
            </div>
            <?php endforeach ?>
        </div>
      </section>
    </main>