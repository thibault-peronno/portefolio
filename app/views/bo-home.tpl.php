<!-- <?php dump($projects, $languages, $organizations) ?> -->
<h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 sm:w-[60%] mb-5 sm:mt-12">
  back office Accueil
</h1>
<h2 class="text-2xl text-white uppercase font-bold my-10 sm:w-6/12 sm:mt-12">
  Mes projets
</h2>
<div class="bg-white p-2.5 rounded">
  <table class="w-full">
    <thead>
      <tr>
        <th scope="col" class="text-left text-btn-sec text-lg">Nom </th>
        <th scope="col" class="text-left text-btn-sec text-lg hidden sm:table-cell">Description</th>
        <th scope="col" class="text-end text-btn-sec text-lg">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($projects as $project) : ?>
        <tr class="mt-5 h-14 border-b-2 border-primary">
          <td><?= $project['title'] ?></td>
          <td class="hidden sm:table-cell"><?= $project['description'] ?></td>
          <td class="text-end">
            <img src="/assets/images/icons/view.svg" alt="" class="inline cursor-pointer " />
            <img src="/assets/images/icons/edit.svg" alt="" class="inline cursor-pointer " />
            <img src="/assets/images/icons/trash.svg" alt="" class="inline cursor-pointer" />
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
  <button class="bg-btn-sec rounded flex p-2.5 justify-between items-center mt-5 w-full sm:w-64">
    <p class="text-white">Gérer les projets</p>
    <img src="/assets/images/icons/arrow-right-circle.svg" alt="" />
  </button>
</div>

<h2 class="text-2xl text-white uppercase font-bold my-10 sm:w-6/12 sm:mt-12">
  Mes technos
</h2>
<div class="bg-white p-2.5 rounded">
  <div class="flex flex-row flex-wrap justify-evenly gap-5">
    <?php foreach ($languages as $language) : ?>
      <div>
        <img src="<?php echo "/assets/images/languages/" . $language->picture ?>" alt="" class="w-12 h-12 m-auto" />
        <p class="text-center rounded-full bg-secondary text-white px-2.5 text-sm">
          <?= $language->label ?>
        </p>
      </div>
    <?php endforeach ?>
  </div>
  <button class="bg-btn-sec rounded flex p-2.5 justify-between items-center mt-5 w-full sm:w-64">
    <p class="text-white">Gérer les technos</p>
    <img src="/assets/images/icons/arrow-right-circle.svg" alt="" />
  </button>
</div>
<h2 class="text-2xl text-white uppercase font-bold my-10 sm:w-6/12 sm:mt-12">
  Mes organisations
</h2>
<div class="bg-white p-2.5 rounded">
  <table class="w-full">
    <thead>
      <tr>
        <th scope="col" class="text-left text-btn-sec text-lg">Nom </th>
        <th scope="col" class="text-left text-btn-sec text-lg hidden sm:table-cell">Description</th>
        <th scope="col" class="text-end text-btn-sec text-lg">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($organizations as $organization) : ?>
        <tr class="mt-5 h-14 border-b-2 border-primary">
          <td><?= $organization->title ?></td>
          <td class="hidden sm:table-cell"><?= $organization->description ?></td>
          <td class="text-end">
            <img src="/assets/images/icons/view.svg" alt="" class="inline cursor-pointer " />
            <img src="/assets/images/icons/edit.svg" alt="" class="inline cursor-pointer " />
            <img src="/assets/images/icons/trash.svg" alt="" class="inline cursor-pointer" />
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
  <button class="bg-btn-sec rounded flex p-2.5 justify-between items-center mt-5 w-full sm:w-64">
    <p class="text-white">Gérer les organisations</p>
    <img src="/assets/images/icons/arrow-right-circle.svg" alt="" />
  </button>
</div>