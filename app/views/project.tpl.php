<!-- <?php dump($project) ?> -->
 <div class="sm:flex">
   <section class="sm:p-14 sm:w-6/12">
     <h1 class="text-4xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 my-5 sm:my-0 rounded w-max">
       <?= $project->getTitle() ?>
     </h1>
     <p class="my-8 text-lg">
       <?= $project->getDescription() ?>
     </p>
     <h2 class="text-3xl text-secondary uppercase mt-14 mb-5">Languages</h2>
     <div class="flex gap-10 my-10  sm:mt-0">
       <?php foreach ($project->getLabels() as $label) : ?>
         <span class="flex flex-col items-center bg-fade-grey mb-2 w-52 h-52 p-1.5 rounded-sm ">
           <div class="bg-white rounded w-max p-2.5">
             <img src="<?= "/assets/images/languages/" . $label['picture'] ?>" alt="<?= "icon " . $label['label'] ?>" class="w-28" />
           </div>
           <p class="text-center rounded-full bg-secondary text-white p-2.5 w-36 mt-2.5"><?= $label['label'] ?></p>
         </span>
       <?php endforeach ?>
     </div>
   </section>
   <section class="bg-white sm:p-14 sm:w-6/12">
     <h2 class="text-3xl text-secondary uppercase mb-5">Organisation</h2>
     <div class="flex flex-col justify-center gap-5 my-10 sm:h-full sm:mt-0 sm:justify-start">
       <span class="flex gap-5 items-center">
         <img src="<?= "/assets/images/organizations/" . $project->getPictureOrganization() ?>" alt="<?= "icon " . $project->getTitleOrganization() ?>" class="w-9 h-9" />
         <h3 class="text-xl font-bold text-btn-sec mb-2"><?= $project->getTitleOrganization() ?></h3>
       </span>
       <p class="text-lg"><?= $project->getDescriptionOrganization() ?></p>
     </div>
     <a href="<?= $project->getUrl() ?>">
       <button class="bg-btn-sec rounded flex p-2.5 items-center mt-3 w-full sm:w-64">
         <img src="/assets/images/icons/online.svg" alt="" class="pr-2" />
         <p class="text-white">Projet en ligne</p>
       </button>
     </a>
   </section>
 </div>