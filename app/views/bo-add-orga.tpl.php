<h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 sm:w-[60%] mb-5 sm:mt-12">
    Ajouter une organisation
</h1>
<section class="rounded p-2 bg-white/[0.15] sm:p-14">
    <form action="" id="project-form" method="post">
        <div class="mb-5">
            <label for="title" class="text-primary text-xl">Nom<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
            <input type="text" name="title" id="title" class="rounded bg-white h-12 w-full p-2" />
        </div>
        <div class="mb-5">
            <label for="description" class="text-primary text-xl">Description<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
            <textarea name="description" id="description" cols="30" rows="10" class="rounded bg-white h-24 w-full p-2"></textarea>
        </div>
        <div class="mb-5 sm:w-6/12">
            <label for="picture" class="text-primary text-xl">Image<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
            <input type="file" name="picture" id="picture" accept="image/png, image/jpeg" class="rounded bg-white h-12 w-full p-2" />
        </div>
    </form>
</section>
<button class="bg-btn-sec rounded flex p-2.5 justify-center items-center gap-2 mt-5 w-full sm:w-64 font-bold text-xl" type="submit" form="project-form">
    <img src="/assets/images/icons/add.svg" alt="" />
    <p class="text-white">Ajouter</p>
</button>