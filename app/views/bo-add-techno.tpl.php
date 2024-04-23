<h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 sm:w-[60%] mb-5 sm:mt-12">
    Ajouter une technos
</h1>
<section class="rounded p-2 bg-white/[0.15] sm:p-14">
<?php if(isset($succeeded) && $succeeded == true): ?>
        <div class="p-2 text-center text-white font-bold fixed bg-lime-600 rounded animate-notif">
        <p>L'ajout a réussi</p>
    </div>
    <?php endif ?>
    <?php if(isset($succeeded) && $succeeded == false): ?>
        <div class="p-2 text-center text-white font-bold fixed top-10 right-10 bg-orange-600 animate-notif">
        <p>L'ajout a échoué, réssayez plus tard</p>
    </div>
    <?php endif ?>
    <form action="" id="project-form" method="post">
        <div class="mb-5">
            <label for="label" class="text-primary text-xl">Nom<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
            <input type="text" name="label" id="label" class="rounded bg-white h-12 w-full p-2" />
        </div>
        <span class="sm:flex sm:flex-row sm:gap-5 sm:flex-nowrap">
            <div class="mb-5 sm:w-6/12">
                <label for="picture" class="text-primary text-xl">Image<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
                <input type="file" name="picture" id="picture" accept="image/png, image/jpeg" class="rounded bg-white h-12 w-full p-2" />
            </div>
            <div class="mb-5 sm:w-6/12">
                <label for="type" class="text-primary text-xl">Organisation<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
                <select name="type" id="type" class="block rounded bg-white h-12 w-full p-2">
                    <option value="">Type</option>
                    <option value="Front-end">Front-end</option>
                    <option value="Back-end">Back-end</option>
                    <option value="DevOps">DevOps</option>
                </select>
            </div>
        </span>
    </form>
</section>
<button class="bg-btn-sec rounded flex p-2.5 justify-center items-center gap-2 mt-5 w-full sm:w-64 font-bold text-xl" type="submit" form="project-form">
    <img src="/assets/images/icons/add.svg" alt="" />
    <p class="text-white">Ajouter</p>
</button>