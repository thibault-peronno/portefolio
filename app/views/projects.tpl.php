<!-- <?php dump($projects); ?> -->
<main class="grow">
      <section>
        <h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 my-5 sm:w-[30%] sm:mt-12">Mes projets</h1>
        <div class="sm:flex sm:gap-10 sm:justify-between sm:flex-wrap">
            <?php foreach($projects as $project) : ?>
            <div class="border-t-2 border-primary my-5 py-5 sm:w-80">
              <h2 class="text-2xl text-secondary uppercase mb-2"><?= $project['title'] ?></h2>
              <div class="flex justify-start gap-2">
              <?php foreach($project['labels'] as $label) : ?>
                <img
                  src="<?= "/assets/images/languages/" . $label['picture'] ?>"
                  alt="<?= "icon " . $label['label'] ?>"
                  class="w-5"
                />
                <?php endforeach ?>
              </div>
              <p class="my-2">
              <?= $project['description'] ?>
              </p>
              <a href="<?= "/projet/" . $project['id'] ?>">
                <button
                  class="bg-btn-sec rounded flex p-2.5 justify-between items-center mt-3 w-full sm:w-64"
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