<?php dump($language); ?>
<h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 sm:w-[60%] mb-5 sm:mt-12">
    <?= isset($language) ? "Modifier" : "Ajouter" ?> une technos
</h1>
<section class="rounded p-2 bg-white/[0.15] sm:p-14">
    <?php if (isset($succeeded) && $succeeded) : ?>
        <div class="p-2 text-center text-white font-bold fixed bg-lime-600 rounded animate-notif">
            <p>L'ajout a réussi</p>
        </div>
    <?php endif ?>
    <?php if (isset($succeeded) && !$succeeded) : ?>
        <div class="p-2 text-center text-white font-bold fixed top-10 right-10 bg-orange-600 animate-notif">
            <p><?= $message ?></p>
        </div>
    <?php endif ?>
    <!-- changer project, sur les autres aussi au moment de l'optimisation -->
    <form action="" id="project-form" method="post" enctype="multipart/form-data">
        <div class="mb-5">
            <label for="label" class="text-primary text-xl">Nom<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
            <input type="text" name="label" id="label" value="<?= isset($language) ? $language['label'] : " " ?>" class="rounded bg-white h-12 w-full p-2" />
        </div>
        <span class="sm:flex sm:flex-row sm:gap-5 sm:flex-nowrap">
            <div class="mb-5 sm:w-6/12">
                <label for="type" class="text-primary text-xl">Organisation<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
                <select name="type" id="type" class="block rounded bg-white h-12 w-full p-2">
                    <option value=""><?= isset($language) ? $language['type'] : "Type" ?></option>
                    <option value="Front-end">Front-end</option>
                    <option value="Back-end">Back-end</option>
                    <option value="DevOps">DevOps</option>
                </select>
            </div>
            <?php if (isset($language)) : ?>
                <div id="updateImageTextDiv">
                    <img class="p-2.5 bg-white w-14" src="<?= "/assets/images/languages/" . $language['picture'] ?>" alt="Image du projet" class="w-14">
                    <p class="font-bold text-white cursor-pointer" id="updateImageText">Modifier l'image</p>
                    <input type="hidden" name="picture" value="<?= $language['picture'] ?>">
                </div>
            <?php endif ?>
            <div class="mb-5 sm:w-6/12 <?= isset($language) ? 'hidden' : "" ?>">
                <label for="picture" class="text-primary text-xl">Image<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
                <input type="file" name="picture" id="picture" accept="image/png, image/jpeg" class="rounded bg-white h-12 w-full p-2" />
                <p id="cancelUpdateImageInput" class="font-bold text-white cursor-pointer <?= isset($language)? "block" : "hidden" ?>">Annuler</p>
            </div>
        </span>
    </form>
</section>
<button class="bg-btn-sec rounded flex p-2.5 justify-center items-center gap-2 mt-5 w-full sm:w-64 font-bold text-xl" type="submit" form="project-form">
    <img src="/assets/images/icons/add.svg" alt="" />
    <p class="text-white"><?= isset($language) ? "Modifier" : "Ajouter" ?></p>
</button>