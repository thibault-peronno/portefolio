<!-- <?php dump($projects) ?> -->
<h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 sm:w-[60%] mb-5 sm:mt-12">
  back office Projets
</h1>
<section class="rounded p-2 bg-white/[0.15] sm:p-14">
  <a href="bo-ajouter-projet">
    <button class="bg-btn-sec rounded flex p-2.5 justify-center items-center gap-2 mt-5 w-full sm:w-64 font-bold text-xl">
      <img src="/assets/images/icons/add.svg" alt="" />
      <p class="text-white">Ajouter</p>
    </button>
  </a>
  <div class="sm:flex sm:gap-5 sm:flex-wrap">
    <?php foreach ($projects as $project) : ?>
      <div class="bg-white rounded border-t-2 border-primary my-5 p-5 sm:w-80">
        <a href="<?= "/bo-editer-projet/" . $project['id'] ?>">
          <div class="bg-primary rounded-full w-14 h-14 flex">
            <img src="/assets/images/icons/edit.svg" alt="" class="m-auto w-10 h-10" />
          </div>
        </a>
        <h2 class="text-2xl text-secondary uppercase my-2">
          <?= $project['title'] ?>
        </h2>
        <div class="flex justify-start gap-2">
          <?php foreach ($project['labels'] as $label) : ?>
            <img src="<?= '/assets/images/languages/' . $label['picture'] ?>" alt="" class="w-5" />
          <?php endforeach ?>
        </div>
        <p class="my-2">
          <?= $project['description'] ?>
        </p>
        <a href="<?= "bo-projet/" . $project['id'] ?>">
          <button class="bg-btn-sec rounded flex p-2.5 justify-between items-center mt-3 w-full">
            <p class="text-white">En savoir plus</p>
            <img src="/assets/images/icons/arrow-right-circle.svg" alt="" />
          </button>
        </a>
      </div>
    <?php endforeach ?>
  </div>
</section>