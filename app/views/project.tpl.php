<!-- <?php dump($project) ?> -->
<div class="sm:flex w-full">
  <section class="p-2 sm:p-14 sm:w-6/12">
    <h1 class="text-4xl bg-primary text-secondary uppercase font-bold p-2.5 my-5 sm:my-0 rounded w-max">
      <?= $project->getTitle() ?>
    </h1>
    <p class="my-8 text-lg">
      <?= $project->getDescription() ?>
    </p>
    <h2 class="text-3xl text-secondary uppercase mb-5">Organisation</h2>
    <div class="flex flex-col justify-center gap-5 my-10 sm:mt-0 sm:justify-start">
      <span class="flex gap-5 items-center">
        <img src="<?= "/assets/images/organizations/" . $project->getPictureOrganization() ?>" alt="<?= "icon " . $project->getTitleOrganization() ?>" class="w-9 h-9" />
        <h3 class="text-xl font-bold text-btn-sec mb-2"><?= $project->getTitleOrganization() ?></h3>
      </span>
      <p class="text-lg"><?= $project->getDescriptionOrganization() ?></p>
    </div>
    <section class="sm:hidden">
    <img src="<?= "/assets/images/projects/" . $project->getPicture() ?>" alt="Image du projet" class="">
  </section>
    <a href="<?= $project->getUrl() ?>">
      <button class="bg-btn-sec rounded flex p-2.5 justify-between items-center mt-5 w-full sm:w-64">
        <p class="text-white">Projet en ligne</p>
        <img src="/assets/images/icons/online.svg" alt="" class="" />
      </button>
    </a>
    <div class="flex gap-10 mt-10">
    <?php foreach ($project->getLabels() as $label) : ?>
      <span class="flex overflow-x-auto gap-5 sm:snap-none sm:gap-14 sm:flex-wrap">
        <div class="bg-white rounded-full border">
          <img src="<?= "/assets/images/languages/" . $label['picture'] ?>" alt="<?= "icon " . $label['label'] ?>" class="w-14 h-14 p-2" />
        </div>
        <!-- <p class="text-center rounded-full bg-secondary text-white p-2.5 w-36 mt-2.5"><?= $label['label'] ?></p> -->
      </span>
    <?php endforeach ?>
  </div>
  </section>
  <section class="hidden sm:w-6/12 bg-white sm:relative sm:block">
    <img src="<?= "/assets/images/projects/" . $project->getPicture() ?>" alt="Image du projet" class="sm:absolute sm:w-[80%] sm:h-[40%] sm:top-1/4 sm:left-[-5%]">
    <img src="/assets/images/systeme/background_cross.svg" alt="" class="w-full h-full object-cover">
  </section>
</div>
<!-- <section class="bg-white p-2 sm:p-14">
   <h2 class="text-3xl text-secondary uppercase mt-14 mb-5">Langages</h2>
  <div class="flex gap-10 my-10  sm:mt-0">
    <?php foreach ($project->getLabels() as $label) : ?>
      <span class="flex overflow-x-auto gap-5 sm:snap-none sm:gap-14 sm:flex-wrap my-11">
        <div class="bg-white rounded-full border">
          <img src="<?= "/assets/images/languages/" . $label['picture'] ?>" alt="<?= "icon " . $label['label'] ?>" class="w-20 h-20 p-5" />
        </div>
         <p class="text-center rounded-full bg-secondary text-white p-2.5 w-36 mt-2.5"><?= $label['label'] ?></p>
      </span>
    <?php endforeach ?>
  </div>
</section> -->