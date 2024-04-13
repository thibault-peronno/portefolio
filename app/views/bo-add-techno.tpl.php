<h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 sm:w-[60%] mb-5 sm:mt-12">
    Ajouter une technos
</h1>
<section class="rounded p-2 bg-white/[0.15] sm:p-14">
    <form action="" id="project-form" method="post">
        <div class="mb-5">
            <label for="name" class="text-primary text-xl">Nom<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
            <input type="text" name="name" id="name" class="rounded bg-white h-12 w-full p-2" />
        </div>
        <span class="sm:flex sm:flex-row sm:gap-5 sm:flex-nowrap">
            <div class="mb-5 sm:w-6/12">
                <label for="image" class="text-primary text-xl">Image<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
                <input type="file" name="image" id="image" accept="image/png, image/jpeg" class="rounded bg-white h-12 w-full p-2" />
            </div>
            <div class="mb-5 sm:w-6/12">
                <label for="tech" class="text-primary text-xl">Organisation<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
                <select name="tech" id="tech" class="block rounded bg-white h-12 w-full p-2">
                    <option value="">Type</option>
                    <option value="dog">Front-end</option>
                    <option value="cat">Back-end</option>
                    <option value="hamster">DevOps</option>
                </select>
            </div>
        </span>
    </form>
</section>
<button class="bg-btn-sec rounded flex p-2.5 justify-center items-center gap-2 mt-5 w-full sm:w-64 font-bold text-xl" type="submit" form="project-form">
    <img src="/assets/images/icons/add.svg" alt="" />
    <p class="text-white">Ajouter</p>
</button>