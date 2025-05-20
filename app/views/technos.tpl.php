<!-- <?php dump($languages, $arrayNumberOfProjectDevBylanguage); ?> -->
 <section class="section">
     <h1 class="heading-1 mb-5 sm:mt-12">
         Mes langages ou framworks
     </h1>
     
     <?php foreach($languages as $keyLanguage => $arrayLanguageByType) : ?>
     <h2 class="heading-2 mt-14"><?= $keyLanguage ?></h2>
     <div class="snap-x flex overflow-x-auto gap-5 p-2.5 sm:snap-none sm:p-0 sm:gap-10 sm:flex-wrap">
     
     <?php foreach($arrayLanguageByType as $language) : ?>
         <div class="rounded p-4 shadow-card w-max bg-white shrink-0 snap-start lg:hover:scale-105 transition ease-in-out delay-150 duration-200">
             <span class="flex gap-2.5 items-center mb-2">
                 <img src="<?= "/assets/images/languages/" . $language->get_picture() ?>" alt="" class="w-9 h-9" />
                 <h3 class="text-2xl font-bold text-btn-sec"><?= $language->get_label() ?></h3>
             </span>
             <p class="text-lg">Nombre de projet(s) réalisé(s) : <?= isset($arrayNumberOfProjectDevBylanguage[$language->get_label()]) ? $arrayNumberOfProjectDevBylanguage[$language->get_label()][0] : 0 ?></p>
         </div>
         <?php endforeach ?>
     </div>
     <?php endforeach ?>
 </section>
