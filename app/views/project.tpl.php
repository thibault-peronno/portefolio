<!-- <?php dump($project) ?> -->
<h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 my-5 sm:mt-12 rounded w-max">
  <?= $project['title'] ?>
</h1>
<p class="my-8 text-lg">
  <?= $project['description'] ?>
</p>
<h2 class="text-2xl text-secondary uppercase mt-14 mb-5">Organisation</h2>
<div class="flex flex-col justify-center gap-5 my-10 sm:w-max sm:mt-0">
  <span class="flex gap-5 items-center">
    <img src="<?= "/assets/images/organizations/" . $project['picture_organization'] ?>" alt="<?= "icon " . $project['title_organization'] ?>" class="w-9 h-9" />
  <h3 class="text-xl font-bold text-btn-sec mb-2"><?= $project['title_organization'] ?></h3>
  </span>
  <p class="text-lg"><?= $project['description_organization'] ?></p>
</div>
<h2 class="text-2xl text-secondary uppercase mt-14 mb-5">Languages</h2>
<div class="flex gap-10 my-10  sm:mt-0">
  <?php foreach ($project['labels'] as $label) : ?>
    <span class="flex flex-col content-center">
      <img src="<?= "/assets/images/languages/" . $label['picture'] ?>" alt="<?= "icon " . $label['label'] ?>" class="w-28" />
      <p class="text-center rounded-full bg-secondary text-white p-2.5"><?= $label['label'] ?></p>
    </span>
  <?php endforeach ?>
</div>
<a href="<?= $project['url'] ?>">
  <button class="bg-btn-sec rounded flex p-2.5 items-center mt-3 w-full sm:w-64">
    <img src="/assets/images/icons/online.svg" alt="" class="pr-2" />
    <p class="text-white">Projet en ligne</p>
  </button>
</a>