<!-- <?php dump($organizations, $languages) ?> -->
<h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 w-max rounded mb-5 sm:mt-12">
<?= isset($project) ? "Modifier un projet" : "Ajouter un projet" ?>
</h1>
<section class="rounded p-2 bg-white/[0.15] sm:p-14">
    <?php if (isset($succeeded) && $succeeded == true) : ?>
        <div class="p-2 text-center text-white font-bold fixed bg-lime-600 rounded animate-notif">
            <p>L'ajout a réussi</p>
        </div>
    <?php endif ?>
    <?php if (isset($succeeded) && $succeeded == false) : ?>
        <div class="p-2 text-center text-white font-bold fixed top-10 right-10 bg-orange-600 animate-notif">
            <p>L'ajout a échoué, réssayez plus tard</p>
        </div>
    <?php endif ?>
    <form action="" id="project-form" method="post" enctype="multipart/form-data">
        <div class="mb-5">
            <label for="title" class="text-primary text-xl">Nom<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
            <input type="text" name="title" id="title" value="<?= isset($project) ? $project->getTitle() : " " ?>" class="rounded bg-white h-12 w-full p-2" />
        </div>
        <div class="mb-5">
            <label 
            for="description" 
            class="text-primary text-xl">
            Description<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
            <textarea 
            name="description" id="description" cols="30" rows="10" class="rounded bg-white h-24 w-full p-2"><?php echo isset($project) ? $project->getDescription() : " " ?></textarea>
        </div>
        <span class="sm:flex sm:flex-row sm:gap-5 sm:flex-nowrap">
            <div class="mb-5 sm:w-6/12">
                <label for="url" class="text-primary text-xl">URL</label>
                <input type="text" name="url" id="url" value="<?= isset($project) ? $project->getUrl() : " " ?>" class="rounded bg-white h-12 w-full p-2" />
            </div>
            <div class="mb-5 sm:w-6/12">
                <?php if(isset($project) && $project->getPicture() !== null) :?>
                    <div id="updateImageTextDiv">
                        <img src="<?= "/assets/images/projects/" . $project->getPicture() ?>" alt="Image du projet" class="w-14">
                        <p class="font-bold text-white cursor-pointer" id="updateImageText">Modifier l'image</p>
                        <input type="hidden" name="picture" value="<?= $project->getPicture() ?>">
                    </div>
                <?php endif ?>
                <span id="updateImageInput" class="<?= isset($project)? "hidden" : "" ?>">
                    <label for="picture" class="text-primary text-xl" >Image<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
                    <input type="file" name="picture" id="picture" accept="image/png, image/jpeg" class="rounded bg-white h-12 w-full p-2" />
                    <p id="cancelUpdateImageInput" class="font-bold text-white cursor-pointer <?= isset($project)? "block" : "hidden" ?>">Annuler</p>
                </span>
            </div>
        </span>
        <span class="sm:flex sm:flex-row sm:gap-5 sm:flex-nowrap">
            <div class="mb-5 sm:w-6/12">
                <label for="languagesId" class="text-primary text-xl">Langages<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
                <div class="block rounded bg-white h-12 w-full p-2 relative">
                    <div id="selectTechnos" class="h-full">
                        <div class="block bg-white h-full h-12 w-full flex flex-row items-center justify-between">
                            <p>Choisi les languages</p>
                            <p class="cursor-default">+</p>
                        </div>
                        <div class="hidden"></div>
                    </div>
                    <div id="checklanguages" class="hidden absolute flex flex-col gap-2 bg-white left-0 p-2 w-full rounded h-28 overflow-y-auto">
                        <?php foreach ($languages as $language) : ?>
                            <span>
                                <input type="checkbox" id="<?= htmlspecialchars($language->id) ?>" value="<?= htmlspecialchars($language->id) ?>" 
                                <?php foreach($project['labels'] as $label){
                                   echo $label['label'] == $language->getLabel() ? "checked" : "";
                                } ?>
                                name="languages[]" />
                                <label for="<?= htmlspecialchars($language->getId()) ?>"><?= htmlspecialchars($language->getLabel()) ?></label>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="mb-5 sm:w-6/12">
                <label for="organizationId" class="text-primary text-xl">Organisation<span class="text-red-900 text-[#7f1d1d] font-bold text-lg">*</span></label>
                <select name="organizationId" id="organizationId" class="block rounded bg-white h-12 w-full p-2">
                    <option value="<?= isset($project) ? $project['organization_id'] : "" ?>"><?= isset($project) ? $project['title_organization'] : "Choisi l'organisation" ?></option>
                    <?php foreach ($organizations as $organization) : ?>
                        <option 
                            value=<?= $organization->getId() ?>>
                            <?= $organization->getTitle() ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </span>
    </form>
</section>
<button class="bg-btn-sec rounded flex p-2.5 justify-center items-center gap-2 mt-5 w-full sm:w-64 font-bold text-xl" type="submit" form="project-form">
    <img src="/assets/images/icons/add.svg" alt="" />
    <p class="text-white"><?= isset($project) ? "Modifier" : "Ajouter" ?></p>
</button>