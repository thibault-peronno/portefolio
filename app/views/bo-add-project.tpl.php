<h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 sm:w-[60%] mb-5 sm:mt-12">
    Ajouter un projet
</h1>
<section class="rounded p-2 bg-white/[0.15] sm:p-14">
    <form action="" id="project-form" method="post">
        <div class="mb-5">
            <label for="name" class="text-primary text-xl">Nom<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
            <input type="text" name="name" id="name" class="rounded bg-white h-12 w-full p-2" />
        </div>
        <div class="mb-5">
            <label for="description" class="text-primary text-xl">Description<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
            <textarea name="description" id="description" cols="30" rows="10" class="rounded bg-white h-24 w-full p-2"></textarea>
        </div>
        <span class="sm:flex sm:flex-row sm:gap-5 sm:flex-nowrap">
            <div class="mb-5 sm:w-6/12">
                <label for="link" class="text-primary text-xl">URL</label>
                <input type="text" name="link" id="link" class="rounded bg-white h-12 w-full p-2" />
            </div>
            <div class="mb-5 sm:w-6/12">
                <label for="image" class="text-primary text-xl">Image<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
                <input type="file" name="image" id="image" accept="image/png, image/jpeg" class="rounded bg-white h-12 w-full p-2" />
            </div>
        </span>
        <span class="sm:flex sm:flex-row sm:gap-5 sm:flex-nowrap">
            <div class="mb-5 sm:w-6/12">
                <label for="tech" class="text-primary text-xl">Technologies<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
                <div class="block rounded bg-white h-12 w-full p-2 relative">
                    <div id="selectTechnos" class="h-full">
                        <div class="block bg-white h-full h-12 w-full flex flex-row items-center justify-between">
                            <p>Choisi les technos</p>
                            <p class="cursor-default">+</p>
                        </div>
                        <div class="hidden"></div>
                    </div>
                    <div id="checkTechnos" class="hidden absolute flex flex-col gap-2 bg-white left-0 p-2 w-full rounded h-28 overflow-y-auto">
                        <span>
                            <input type="checkbox" id="one" />
                            <label for="one">React</label>
                        </span>
                        <span>
                            <input type="checkbox" id="two" />
                            <label for="two"> Laravel</label>
                        </span>
                        <span>
                            <input type="checkbox" id="three" />
                            <label for="three"> Tailwind</label>
                        </span>
                        <span>
                            <input type="checkbox" id="three" />
                            <label for="three">Node.js</label>
                        </span>
                        <span>
                            <input type="checkbox" id="three" />
                            <label for="three">HTML</label>
                        </span>
                        <span>
                            <input type="checkbox" id="three" />
                            <label for="three">Nginx</label>
                        </span>
                    </div>
                </div>
            </div>
            <div class="mb-5 sm:w-6/12">
                <label for="tech" class="text-primary text-xl">Organisation<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
                <select name="tech" id="tech" class="block rounded bg-white h-12 w-full p-2">
                    <option value="">Choisi les technos</option>
                    <option value="dog">Dog</option>
                    <option value="cat">Cat</option>
                    <option value="hamster">Hamster</option>
                    <option value="parrot">Parrot</option>
                    <option value="spider">Spider</option>
                    <option value="goldfish">Goldfish</option>
                </select>
            </div>
        </span>
    </form>
</section>
<button class="bg-btn-sec rounded flex p-2.5 justify-center items-center gap-2 mt-5 w-full sm:w-64 font-bold text-xl" type="submit" form="project-form">
    <img src="/assets/images/icons/add.svg" alt="" />
    <p class="text-white">Ajouter</p>
</button>