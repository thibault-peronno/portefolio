<!-- <?php dump($projects) ?> -->
<section class="section">
  <h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 w-max mb-5 sm:mt-12 rounded">
    back office Projets
  </h1>
  <a href="admin-ajouter-projet">
    <button class="button-admin flex justify-center items-center gap-2 mt-5">
      <img src="/assets/images/icons/add.svg" alt="" />
      <p class="text-white">Nouveau projet</p>
    </button>
  </a>
  <div class="sm:flex sm:gap-5 sm:flex-wrap">
    <?php foreach ($projects as $project) : ?>
      <div class="rounded bg-white/[0.25] relative flex flex-col my-14 sm:w-80 h-[31rem] rounded">
        <a href="<?= "/admin-editer-projet/" . $project->get_id() ?>" class="absolute right-0 top-0">
          <div class="bg-primary rounded p-2.5 w-max flex">
            <img src="/assets/images/icons/edit.svg" alt="Button pour modifier le projet" class="m-auto w-7 h-7" />
          </div>
        </a>
        <div class="w-auto h-1/3 mb-3">
          <img src="<?= "/assets/images/projects/" . $project->get_picture() ?>" alt="Image du projet" class="h-full w-full">
        </div>
        <div class="p-5">
          <h2 class="text-2xl text-white uppercase my-2">
            <?= $project->get_title() ?>
          </h2>
          <div class="flex justify-start gap-2">
            <?php foreach ($project->get_labels() as $label) : ?>
              <img src="<?= '/assets/images/languages/' . $label['picture'] ?>" alt="" class="w-8 bg-white rounded-full p-1" />
            <?php endforeach ?>
          </div>
          <p class="my-2 text-clip overflow-hidden text-lg h-20 text-white">
            <?= $project->get_description() ?>
          </p>
          <a
            href="/admin-projet/<?= $project->get_id() ?>"
            class="bg-btn-sec rounded flex p-2.5 justify-between items-center mt-3 w-[90%] absolute bottom-5 "
            role="button"
            aria-label="En savoir plus sur le projet">
            <p class="text-white">En savoir plus</p>
            <img src="/assets/images/icons/arrow-right-circle.svg" alt="Aller à la page suivante" />
          </a>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</section>