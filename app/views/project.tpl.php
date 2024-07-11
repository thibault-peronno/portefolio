<!-- <?php dump($project) ?> -->
<h1 class="text-3xl text-secondary mb-5 bg-primary text-secondary uppercase font-bold p-2.5 my-5 sm:w-max sm:mt-12">
  <?= $project['title'] ?>
</h1>
<p class="my-8">
  <?= $project['description'] ?>
</p>
<h3 class="text-xl font-bold text-btn-sec">Organisation</h3>
<div class="flex flex-col justify-center gap-5 my-10 sm:w-max sm:mt-0">
  <img src="<?= "/assets/images/organizations/" . $project['picture_organization'] ?>" alt="<?= "icon " . $project['title_organization'] ?>" class="w-28" />
  <p class="text-center rounded-full bg-secondary text-white px-2.5 text-sm"><?= $project['title_organization'] ?></p>
</div>
<h3 class="text-xl font-bold text-btn-sec">Languages</h3>
<div class="flex gap-5 my-10  sm:mt-0">
  <?php foreach ($project['labels'] as $label) : ?>
    <span class="flex flex-col content-center">
      <img src="<?= "/assets/images/languages/" . $label['picture'] ?>" alt="<?= "icon " . $label['label'] ?>" class="w-28" />
      <p class="text-center rounded-full bg-secondary text-white px-2.5 text-sm"><?= $label['label'] ?></p>
    </span>
  <?php endforeach ?>
</div>
<a href="<?= $project['url'] ?>">
  <button class="bg-btn-sec rounded flex p-2.5 items-center mt-3 w-full sm:w-64">
    <img src="/assets/images/icons/online.svg" alt="" class="pr-2" />
    <p class="text-white">Projet en ligne</p>
  </button>
</a>