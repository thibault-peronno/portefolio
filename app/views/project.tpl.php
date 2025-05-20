<!-- <?php dump($project) ?> -->
<div class="sm:flex w-full">
  <section class="section sm:w-6/12">
    <h1 class="heading-1">
      <?= $project->get_title() ?>
    </h1>
    <span class="flex flex-row flex-wrap gap-1 mb-2 sm:my-2">
      <?php foreach ($project->get_labels() as $label) : ?>
        <p class="badge-language"><?= $label['label'] ?></p>
      <?php endforeach ?>
    </span>
    <p class="my-8 text-lg">
      <?= $project->get_description() ?>
    </p>
    <h2 class="heading-2">Organisation</h2>
    <div class="flex flex-col justify-center gap-5 mt-2 mb-10 sm:mt-0 sm:justify-start">
      <span class="flex gap-5 items-center">
        <img src="<?= "/assets/images/organizations/" . $project->get_picture_organization() ?>" alt="<?= "icon " . $project->get_title_organization() ?>" class="w-9 h-9" />
        <h3 class="headin-3"><?= $project->get_title_organization() ?></h3>
      </span>
      <p class="text-lg"><?= $project->get_description_organization() ?></p>
    </div>
    <div class="sm:hidden">
      <img src="<?= "/assets/images/projects/" . $project->get_picture() ?>" alt="Image du projet" class="">
    </div>
    <?php if ($project->get_url()) : ?>
      <a href="<?= $project->get_url() ?>">
        <button class="button">
          <p class="text-lg">Projet en ligne</p>
          <img src="/assets/images/icons/online.svg" alt="" class="" />
        </button>
      </a>
    <?php endif ?>
    <div class="flex gap-10 my-10">
      <?php foreach ($project->get_labels() as $label) : ?>
        <span class="flex overflow-x-auto gap-5 sm:snap-none sm:gap-14 sm:flex-wrap">
          <div class="bg-white rounded-full border">
            <img src="<?= "/assets/images/languages/" . $label['picture'] ?>" alt="<?= "icon " . $label['label'] ?>" class="w-14 h-14 p-2" />
          </div>
          <!-- <p class="text-center rounded-full bg-secondary text-white p-2.5 w-36 mt-2.5"><?= $label['label'] ?></p> -->
        </span>
      <?php endforeach ?>
    </div>
  </section>
  <div class="hidden sm:w-6/12 bg-white sm:relative sm:block">
    <img src="<?= "/assets/images/projects/" . $project->get_picture() ?>" alt="Image du projet" class="sm:absolute sm:w-[80%] sm:h-[40%] sm:top-1/4 sm:left-[-5%]">
    <img src="/assets/images/systeme/background_cross.svg" alt="" class="w-full h-full object-cover">
  </div>
</div>