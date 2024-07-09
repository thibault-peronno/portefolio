<h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 sm:w-[60%] mb-5 sm:mt-12">
  back office Technologies
</h1>
<section class="rounded p-2 bg-white/[0.15] sm:p-14">
  <a href="bo-ajouter-technologie">
    <button class="bg-btn-sec rounded flex p-2.5 justify-center items-center gap-2 mt-5 w-full sm:w-64 font-bold text-xl">
      <img src="/assets/images/icons/add.svg" alt="" />
      <p class="text-white">Ajouter</p>
    </button>
  </a>
  <h2 class="text-2xl text-white uppercase my-5">Front-end</h2>
  <div class="snap-x flex overflow-x-auto gap-5 p-2.5 sm:snap-none sm:gap-10 sm:flex-wrap">
    <?php foreach ($languages['frontend'] as $language) : ?>
      <div class="rounded p-2.5 shadow-card w-max shrink-0 snap-start bg-white">
        <span class="flex gap-2.5 items-center mb-2">
          <img src="<?php echo '/assets/images/languages/' . $language->picture ?>" alt="" class="w-9 h-9" />
          <h3 class="text-xl font-bold text-btn-sec"><?= $language->label ?></h3>
        </span>
        <span class="flex gap-5 sm:flex-nowrap">
          <a href="<?= "/bo-editer-technologie/" . $language->id ?>">
            <button class="bg-btn-sec rounded text-center mt-5 p-2 sm:w-32 text-white font-bold text-xl">
              Editer
            </button>
          </a>
          <button class="bg-btn-sec rounded text-center mt-5 p-2 sm:w-32 text-white font-bold text-xl" id="deleteLanguages" data-label-id="<?= $language->id ?>">
            Supprimer
          </button>
        </span>
      </div>
    <?php endforeach ?>
  </div>
  <h2 class="text-2xl text-white uppercase my-5">Back-end</h2>
  <div class="snap-x flex overflow-x-auto gap-5 p-2.5 sm:snap-none sm:gap-10 sm:flex-wrap">
    <?php foreach ($languages['backend'] as $language) : ?>
      <div class="rounded p-2.5 shadow-card w-max shrink-0 snap-start bg-white">
        <span class="flex gap-2.5 items-center mb-2">
          <img src="<?= "/assets/images/languages/" . $language->picture ?>" alt="" class="w-9 h-9" />
          <h3 class="text-xl font-bold text-btn-sec"><?= $language->label ?></h3>
        </span>
        <span class="flex gap-5 sm:flex-nowrap">
          <a href="<?= "/bo-editer-technologie/" . $language->id ?>">
            <button class="bg-btn-sec rounded text-center mt-5 p-2 sm:w-32 text-white font-bold text-xl">
              Editer
            </button>
          </a>
          <button class="bg-btn-sec rounded text-center mt-5 p-2 sm:w-32 text-white font-bold text-xl">
            Supprimer
          </button>
        </span>
      </div>
    <?php endforeach ?>
    <!-- <div class="rounded p-2.5 shadow-card w-max shrink-0 bg-white">
      <span class="flex gap-2.5 items-center mb-2">
        <img src="/assets/images/icons/nodejs_mono.png" alt="" class="w-9 h-9" />
        <h3 class="text-xl font-bold text-btn-sec">Node.Js</h3>
      </span>
      <span class="flex gap-5 sm:flex-nowrap">
        <button class="bg-btn-sec rounded text-center mt-5 p-2 sm:w-32 text-white font-bold text-xl">
          Editer
        </button>
        <button class="bg-btn-sec rounded text-center mt-5 p-2 sm:w-32 text-white font-bold text-xl">
          Supprimer
        </button>
      </span>
    </div> -->
  </div>
  <h2 class="text-2xl text-white uppercase my-5">DevOps</h2>
  <div class="snap-x flex overflow-x-auto gap-5 p-2.5 sm:snap-none sm:gap-10 sm:flex-wrap">
    <?php foreach ($languages['devOps'] as $language) : ?>
      <div class="rounded p-2.5 shadow-card w-max shrink-0 snap-start bg-white">
        <span class="flex gap-2.5 items-center mb-2">
          <img src="<?= "/assets/images/languages/" . $language->picture ?>" alt="" class="w-9 h-9" />
          <h3 class="text-xl font-bold text-btn-sec"><?= $language->label ?></h3>
        </span>
        <span class="flex gap-5 sm:flex-nowrap">
          <a href="<?= "/bo-editer-technologie/" . $language->id ?>">
            <button class="bg-btn-sec rounded text-center mt-5 p-2 sm:w-32 text-white font-bold text-xl">
              Editer
            </button>
          </a>
          <button class="bg-btn-sec rounded text-center mt-5 p-2 sm:w-32 text-white font-bold text-xl">
            Supprimer
          </button>
        </span>
      </div>
    <?php endforeach ?>
  </div>
</section>