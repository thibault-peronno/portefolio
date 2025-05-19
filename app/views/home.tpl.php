<!-- <?php dump($projects, $languages) ?> -->
<section class="flex flex-col h-[80vh] p-2 sm:p-14 sm:items-center sm:justify-center sm:flex-row bg-white">
    <div>
        <p class="text-3xl sm:text-5xl lg:text-7xl font-bold">Conception</p>
        <p class="text-3xl sm:text-5xl lg:text-7xl my-4 font-bold">Développement</p>
        <p class="text-3xl sm:text-5xl lg:text-7xl font-bold text-secondary">Applications & sites web</p>
    </div>
    <div class="flex flex-col sm:w-6/12">
        <!-- <img src="/assets/images/face_co.jpg" alt="" class="w-52 h-52 rounded-full self-center sm:mr-2.5 sm:self-start" /> -->
        <h1 class="text-2xl sm:text-4xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 my-5 w-max sm:mt-12 rounded">
            Thibault PERONNO
        </h1>
        <div class="flex flex-row">
            <img src="/assets/images/icons/react_mono.png" alt="" class="w-9 h-9 hover:translate-x-1.5 transition ease-in-out delay-150 duration-200" />
            <img src="/assets/images/icons/flutter_mono.svg" alt="" class="w-9 h-9 hover:translate-x-1.5 transition ease-in-out delay-150 duration-200 mx-5" />
            <img src="/assets/images/icons/laravel_mono.png" alt="" class="w-9 h-9 hover:translate-x-1.5 transition ease-in-out delay-150 duration-200" />
        </div>
        <p class="text-xl my-7 text-secondary">Spécialité front-end, avec du back-end</p>
        <p>Anciennement dans le marketing digital à cotoyer des développeurs, j'ai fini par me reconvertir.</p>
        <p>Grâce à mon parcours, j'ai acquis des compétences en gestion de projets, ce qui me permet d'aller au-delà du simplement écrire des lignes de codes.</p>
    </div>
</section>
<section class="sm:py-28 bg-primary p-2 sm:p-14">
    <h2 class="text-3xl text-secondary uppercase mb-5">
        Mes projets
    </h2>
    <!-- For scroll works, you need add flex and shrink=0. Shrink allow to keep the width like we ask. the class to use scroll with tailwind 
        is snap on parent and snap-position on child -->
    <div class="snap-x flex overflow-x-auto sm:my-11 gap-5 pl-0.5 sm:snap-none sm:gap-14 sm:flex-wrap sm:pt-3">
        <?php foreach ($projects as $project) : ?>
            <a href="<?= "/projet/" . $project->getId() ?>">
                <div class="bg-white h-96 w-[450px] border rounded snap-start shrink-0 lg:hover:-translate-y-1.5 transition ease-in-out duration-200">
                    <div class="w-auto h-3/4 mb-3">
                        <img src="<?= "/assets/images/projects/" . $project->getPicture() ?>" alt="Image du projet" class="h-full w-full rounded-t">
                    </div>
                    <div class="p-2">
                        <p class="text-l font-bold text-btn-sec inline-block"><?= $project->getTitle() ?></p>
                        <div class="flex justify-start gap-2">
                            <?php foreach ($project->getLabels() as $label) : ?>
                                <div class="bg-white border rounded-full">
                                    <img src="<?= "/assets/images/languages/" . $label['picture'] ?>" alt="<?= "icon " . $label['label'] ?>" class="w-4 h-4 m-2 " />
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach ?>
    </div>
    <a href="<?php echo "/projets" ?>">
        <button class="bg-btn-sec rounded flex p-2.5 justify-between items-center mt-5 w-full sm:w-64">
            <p class="text-white">Voir toutes les projets</p>
            <img src="/assets/images/icons/arrow-right-circle.svg" alt="" />
        </button>
    </a>
</section>
<section class="bg-white p-2 sm:p-14">
    <span class="snap-x flex overflow-x-auto gap-5 sm:snap-none sm:gap-14 sm:flex-wrap my-11">
        <?php foreach ($languages as $language) : ?>
            <div class="bg-white rounded-full border snap-start shrink-0">
                <img src="<?= "/assets/images/languages/" . $language->getPicture() ?>" alt="<?= "icon " . $language->getLabel() ?>" class="w-20 h-20 p-5" />
            </div>
        <?php endforeach ?>
    </span>
    <a href="<?= "/languages" ?>">
        <button class="bg-btn-sec rounded flex p-2.5 items-center  w-full sm:w-64 justify-between mt-5">
            <p class="text-white">Voir toutes les technos</p>
            <img src="/assets/images/icons/arrow-right-circle.svg" alt="" />
        </button>
    </a>
</section>