<!-- <?php dump($organization) ?> -->
<section class="section">
    <h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 w-max rounded mb-5 sm:mt-12">
        <?= isset($organization) ? "Modifier" : "Ajouter" ?> une organisation
    </h1>
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
    <form action="" id="project-form" method="post" enctype="multipart/form-data">
        <div class="mb-5">
            <label for="title" class="text-primary text-xl">Nom<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
            <input type="text" name="title" id="title" class="rounded bg-white h-12 w-full p-2" value="<?php echo isset($organization) ? $organization->get_title() : "" ?>" />
        </div>
        <div class="mb-5">
            <label for="description" class="text-primary text-xl">Description<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
            <textarea name="description" id="description" cols="30" rows="10" class="rounded bg-white h-24 w-full p-2"><?= isset($organization) ? $organization->get_description() : "" ?></textarea>
        </div>
        <div class="mb-5 sm:w-6/12">
            <?php if (isset($organization) && $organization->get_picture() !== null) : ?>
                <div id="updateImageTextDiv">
                    <img src="<?= "/assets/images/organizations/" . $organization->get_picture() ?>" alt="Image du projet" class="w-14">
                    <p class="font-bold text-white cursor-pointer" id="updateImageText">Modifier l'image</p>
                    <input type="hidden" name="picture" value="<?= $organization->get_picture() ?>">
                </div>
            <?php endif ?>
            <span id="updateImageInput" class="<?php echo isset($organization) ? 'hidden' : ""  ?>">
                <label for="picture" class="text-primary text-xl">Image<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
                <input type="file" name="picture" id="picture" accept="image/png, image/jpeg" class="rounded bg-white h-12 w-full p-2" />
                <p id="cancelUpdateImageInput" class="font-bold text-white cursor-pointer <?= isset($organization) ? "block" : "hidden" ?>">Annuler</p>
            </span>
        </div>
    </form>
    <button class="button-admin flex justify-center items-center gap-2 mt-5" type="submit" form="project-form">
        <img src="/assets/images/icons/add.svg" alt="" />
        <p class="text-white"><?= isset($organization) ? "Modifier" : "Ajouter" ?></p>
    </button>
</section>