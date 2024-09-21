<!-- <?php dump($projects, $languages) ?> -->
<section class="flex flex-col h-[80vh] sm:p-6 sm:items-center sm:justify-center sm:flex-row bg-white">
    <div class="sm:ml-8">
        <p class="text-7xl font-bold">Conception</p>
        <p class="text-7xl my-4 font-bold">Développement</p>
        <p class="text-7xl font-bold text-secondary">Applications & sites web</p>
    </div>
    <div class="flex flex-col sm:w-6/12">
        <!-- <img src="/assets/images/face_co.jpg" alt="" class="w-52 h-52 rounded-full self-center sm:mr-2.5 sm:self-start" /> -->
        <h1 class="text-4xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 my-5 w-max sm:mt-12 rounded">
            Thibault PERONNO
        </h1>
        <div class="flex flex-row">
        <img src="/assets/images/icons/react_mono.png" alt="" class="w-9 h-9 hover:translate-x-1.5 transition ease-in-out delay-150 duration-200" />
        <img src="/assets/images/icons/flutter_mono.svg" alt="" class="w-9 h-9 hover:translate-x-1.5 transition ease-in-out delay-150 duration-200 mx-5" />
        <img src="/assets/images/icons/laravel_mono.png" alt="" class="w-9 h-9 hover:translate-x-1.5 transition ease-in-out delay-150 duration-200" />
        </div>
        <p class="text-3xl my-7 text-secondary">Spécialité Front-end, avec du back-end</p>
        <p class="text-lg">Anciennement dans le marketing digital à cotoyer des développeurs, j'ai fini par me reconvertir.</p>
        <p>Grâce à mon parcours, j'ai acquis des compétences en gestion de projets, ce qui me permet d'aller au-delà du simplement écrire des lignes de codes.</p>
    </div>
</section>
<section class="py-28 bg-primary sm:p-14">
    <h2 class="text-3xl text-secondary uppercase mb-5">
        Mes projets
    </h2>
    <!-- For scroll works, you need add flex and shrink=0. Shrink allow to keep the width like we ask. the class to use scroll with tailwind 
        is snap on parent and snap-position on child -->
    <div class="snap-x flex overflow-x-auto my-11 gap-5 pl-0.5 sm:snap-none sm:gap-14 sm:flex-wrap">
        <?php foreach ($projects as $project) : ?>
            <div class="snap-start p-5  shrink-0 relative flex flex-col justify-between sm:w-80 sm:h-80">
                <span class="absolute w-3/12 h-0.5 bg-secondary top-[45%] left-[45%] animate-borderTop"></span>
                <span class="absolute w-3/12 h-0.5 bg-secondary top-[45%] left-[45%] origin-left rotate-90 animate-borderLeft"></span>
                <h3 class="text-xl font-bold text-btn-sec mb-2 inline-block opacity-0 scale-50 animate-projectsScale"><?= $project['title'] ?></h3>
                <p class="mb-2 opacity-0 scale-20 animate-projectsScale h-20 text-clip overflow-hidden ... text-lg">
                    <?= $project['description'] ?>
                </p>

                <div class="flex justify-start gap-2">
                    <?php foreach ($project['labels'] as $label) : ?>
                        <div class="bg-white rounded opacity-0 animate-projectsScale">
                            <img src="<?= "/assets/images/languages/" . $label['picture'] ?>" alt="<?= "icon " . $label['label'] ?>" class="w-8 h-8 m-2 opacity-0 scale-20 animate-projectsScale" />
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="flex justify-around mt-2 text-secondary">
                    <a href="<?= $project['url'] ?>">
                        <button class="text-white bg-secondary rounded p-1 text-base hover:bg-white hover:text-secondary opacity-0 scale-20 animate-projectsScale">
                            Aller sur le site
                        </button>
                    </a>
                    <a href="<?= "/projet/" . $project['id'] ?>">
                        <button class="text-white bg-secondary rounded p-1 text-base hover:bg-white hover:text-secondary opacity-0 scale-20 animate-projectsScale">
                            En savoir plus
                        </button>
                    </a>
                </div>
                <span class="absolute w-3/12 h-0.5 bg-secondary bottom-[45%] right-[45%] animate-borderRight"></span>
                <span class="absolute w-3/12 h-0.5 bg-secondary bottom-[45%] right-[45%]  animate-borderBottom rotate-90 origin-right"></span>
            </div>
        <?php endforeach ?>
    </div>
    <a href="<?php echo "/projets" ?>">
        <button class="bg-btn-sec rounded flex p-2.5 justify-between items-center mt-5 w-64">
            <p class="text-white">Voir toutes les projets</p>
            <img src="/assets/images/icons/arrow-right-circle.svg" alt="" />
        </button>
    </a>
</section>
<section class="bg-white sm:p-14">
    <h2 class="text-2xl text-secondary uppercase mb-5">
        Mes technos
    </h2>
    <div class="snap-x flex overflow-x-auto my-11 gap-5 pl-0.5 sm:snap-none sm:gap-14 sm:flex-wrap">
        <!-- surmement possible d'optimiser ça ! -->
        <div class="relative w-72 h-72 flex flex-wrap justify-between gap-7 snap-start shrink-0 p-7">
            <span class="absolute w-6/12 h-0.5 bg-secondary top-0 left-0"></span>
            <span class="absolute w-6/12 h-0.5 bg-secondary top-0 left-0 origin-top-left rotate-90"></span>
            <?php foreach ($languages as $language) : ?>
                <?php if ($language->type === 'Front-end') : ?>
                    <img src="<?= "/assets/images/languages/" . $language->picture ?>" alt="<?= "icon " . $language->label ?>" class="w-20 h-20" />
                <?php endif ?>
            <?php endforeach ?>
            <span class="absolute w-6/12 h-0.5 bg-secondary bottom-0 right-0"></span>
            <span class="absolute w-6/12 h-0.5 bg-secondary bottom-0 right-0 origin-top-right rotate-90"></span>
        </div>
        <div class="relative w-72 h-72 flex flex-wrap justify-between gap-7 snap-start shrink-0 p-7">
            <span class="absolute w-6/12 h-0.5 bg-secondary top-0 left-0"></span>
            <span class="absolute w-6/12 h-0.5 bg-secondary top-0 left-0 origin-top-left rotate-90"></span>
            <?php foreach ($languages as $language) : ?>
                <?php if ($language->type === 'Back-end') : ?>
                    <img src="<?= "/assets/images/languages/" . $language->picture ?>" alt="<?= "icon " . $language->label ?>" class="w-20 h-20" />
                <?php endif ?>
            <?php endforeach ?>
            <span class="absolute w-6/12 h-0.5 bg-secondary bottom-0 right-0"></span>
            <span class="absolute w-6/12 h-0.5 bg-secondary bottom-0 right-0 origin-top-right rotate-90"></span>
        </div>
        <div class="relative w-72 h-72 flex flex-wrap justify-between gap-7 snap-start shrink-0 p-7">
            <span class="absolute w-6/12 h-0.5 bg-secondary top-0 left-0"></span>
            <span class="absolute w-6/12 h-0.5 bg-secondary top-0 left-0 origin-top-left rotate-90"></span>
            <?php foreach ($languages as $language) : ?>
                <?php if ($language->type === 'DevOps') : ?>
                    <img src="<?= "/assets/images/languages/" . $language->picture ?>" alt="<?= "icon " . $language->label ?>" class="w-20 h-20" />
                <?php endif ?>
            <?php endforeach ?>
            <span class="absolute w-6/12 h-0.5 bg-secondary bottom-0 right-0"></span>
            <span class="absolute w-6/12 h-0.5 bg-secondary bottom-0 right-0 origin-top-right rotate-90"></span>
        </div>
    </div>
    <a href="<?= "/technologies" ?>">
        <button class="bg-btn-sec rounded flex p-2.5 items-center  w-64 justify-between mt-5">
            <p class="text-white">Voir toutes les technos</p>
            <img src="/assets/images/icons/arrow-right-circle.svg" alt="" />
        </button>
    </a>
</section>