<!-- <?php dump($languages, $arrayNumberOfProjectDevBylanguage); ?> -->
 <section class="sm:p-14">
     <h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 my-5 w-max sm:mt-12 rounded">
         Mes technos
     </h1>
     
     <?php foreach($languages as $keyLanguage => $arrayLanguageByType) : ?>
     <h2 class="text-2xl text-secondary uppercase mt-14 mb-5"><?= $keyLanguage ?></h2>
     <div class="snap-x flex overflow-x-auto gap-5 p-2.5 sm:snap-none sm:p-0 sm:gap-10 sm:flex-wrap">
     
     <?php foreach($arrayLanguageByType as $language) : ?>
         <div class="rounded p-4 shadow-card w-max bg-white shrink-0 snap-start hover:scale-105 transition ease-in-out delay-150 duration-200">
             <span class="flex gap-2.5 items-center mb-2">
                 <img src="<?= "/assets/images/languages/" . $language->picture ?>" alt="" class="w-9 h-9" />
                 <h3 class="text-xl font-bold text-btn-sec"><?= $language->label ?></h3>
             </span>
             <p class="text-lg">Nombre de projet(s) réalisé(s) : <?= isset($arrayNumberOfProjectDevBylanguage[$language->label]) ? count($arrayNumberOfProjectDevBylanguage[$language->label]) : 0 ?></p>
         </div>
         <?php endforeach ?>
     </div>
     <?php endforeach ?>
 </section>
