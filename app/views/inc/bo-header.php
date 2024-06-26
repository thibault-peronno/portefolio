<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../../style/output.css" rel="stylesheet" />
    <meta title="Portefolio Thibault PERONNO" />
    <meta
      description="Retrouvez mon travail de concepteur et développeur d'application. Je présente des projets qui me servent a progresser dans ma connaissance des bonnes pratiques et des languages que j'apprécie. Ceci me permet de rester à l'écoute des évolutions. Et ainsi rester compétitif."
    />
  </head>

  <body
    class="px-2 md:px-dpc xl:px-vpc flex flex-col min-h-screen bg-secondary"
  >
    <header>
      <!-- Our menu to diplay from tablet size -->
      <nav
        class="flex flex-col gap-2.5 sm:flex-row sm:justify-end sm:my-5 sm:py-5 hidden sm:flex text-white"
      >
        <a href="BO-home.htm">Dashboard</a>
        <a href="BO-projects.htm">Projets</a>
        <a href="BO-technos.htm">Technologies</a>
        <a href="BO-orga.htm">Organisations</a>
        <a href="home.htm">Portefolio</a>
      </nav>
      <!-- Our menu to display for mobil size -->
      <img
        src="../../public/assets/images/icons/menu.svg"
        alt=""
        class="sm:hidden w-10 float-right mb-2.5"
        id="mobil-menu"
      />
      <nav
        class="flex flex-col gap-5 p-5 bg-primary text-xl font-bold text-secondary w-screen h-screen sm:hidden fixed top-0 left-[1000px] z-10 transition-left duration-500 ease-out"
        id="menu"
      >
        <img
          src="../../public/assets/images/icons/x.svg"
          alt="close the menu"
          class="w-12 self-end"
          id="close-menu"
        />
        <span class="flex flex-row">
          <img
            src="../../public/assets/images/icons/home.svg"
            alt=""
            class="mr-2.5"
          />
          <a href="BO-home.htm">Dashboard</a>
        </span>
        <span class="flex flex-row">
          <img
            src="../../public/assets/images/icons/cup.svg"
            alt=""
            class="mr-2.5"
          />
          <a href="BO-projects.htm">Projets</a>
        </span>
        <span class="flex flex-row">
          <img
            src="../../public/assets/images/icons/techs.svg"
            alt=""
            class="mr-2.5"
          />
          <a href="BO-technos.htm">Technologies</a>
        </span>
        <span class="flex flex-row">
          <img
            src="../../public/assets/images/icons/file-text.svg"
            alt=""
            class="mr-2.5"
          />
          <a href="BO-orga.htm">Organisations</a>
        </span>
        <span class="flex flex-row">
          <img
            src="../../public/assets/images/icons/sliders.svg"
            alt=""
            class="mr-2.5"
          />
          <a href="home.htm">Portefolio</a>
        </span>
      </nav>
    </header>
    <main class="grow">