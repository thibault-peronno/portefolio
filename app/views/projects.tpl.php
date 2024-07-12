<!-- <?php dump($projects); ?> -->
<main class="grow">
      <section>
        <h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 my-5 sm:w-[30%] sm:mt-12 rounded">Mes projets</h1>
        <div class="sm:flex sm:gap-10 sm:flex-wrap">
            <?php foreach($projects as $project) : ?>
            <div class="border-2 border-primary flex flex-col justify-between my-14 p-5 sm:w-80 rounded">
              <h2 class="text-2xl text-secondary uppercase mb-10"><?= $project['title'] ?></h2>
              <div class="flex justify-start gap-2">
              <?php foreach($project['labels'] as $label) : ?>
                <img
                  src="<?= "/assets/images/languages/" . $label['picture'] ?>"
                  alt="<?= "icon " . $label['label'] ?>"
                  class="w-5"
                />
                <?php endforeach ?>
              </div>
              <p class="my-5">
              <?= $project['description'] ?>
              </p>
              <a href="<?= "/projet/" . $project['id'] ?>">
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