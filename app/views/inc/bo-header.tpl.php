<?php
$currentPage = basename($_SERVER['PHP_SELF']);
// dump($currentPage);

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="/assets/style/output.css" rel="stylesheet" />
  <title>"Portefolio Thibault PERONNO"</title>
</head>

<body class="px-2 md:px-dpc xl:px-vpc flex flex-col min-h-screen bg-secondary text-lg">
<!-- <?php session_start(); ?> -->
  <header>
    <!-- Our menu to diplay from tablet size -->
    <nav class="flex flex-col gap-2.5 sm:flex-row sm:justify-end sm:my-5 sm:py-5 hidden sm:flex text-white">
      <a href="/bo-accueil" class="<?php echo $currentPage == 'bo-accueil' ? 'underline underline-offset-8' : ''; ?>">Dashboard</a>
      <a href="/bo-projets" class="<?php echo $currentPage == 'bo-projets' ? 'underline underline-offset-8' : ''; ?>">Projets</a>
      <a href="/bo-technos" class="<?php echo $currentPage == 'bo-technos' ? 'underline underline-offset-8' : ''; ?>">Technologies</a>
      <a href="/bo-organisation" class="<?php echo $currentPage == 'bo-organisation' ? 'underline underline-offset-8' : ''; ?>">Organisations</a>
      <a href="/" class="<?php echo $currentPage == 'index.php' ? 'underline underline-offset-8' : ''; ?>">Portefolio</a>
    </nav>
    <!-- Our menu to display for mobil size -->
    <img src="/assets/images/nav/menu.svg" alt="" class="sm:hidden w-10 float-right mb-2.5" id="mobil-menu" />
    <nav class="flex flex-col gap-5 p-5 bg-primary text-xl font-bold text-secondary w-screen h-screen sm:hidden fixed top-0 left-[1000px] z-10 transition-left duration-500 ease-out" id="menu">
      <img src="/assets/images/icons/x.svg" alt="close the menu" class="w-12 self-end" id="close-menu" />
      <span class="flex flex-row">
        <img src="/assets/images/icons/home.svg" alt="" class="mr-2.5" />
        <a href="/BO-home.htm">Dashboard</a>
      </span>
      <span class="flex flex-row">
        <img src="/assets/images/icons/cup.svg" alt="" class="mr-2.5" />
        <a href="/BO-projects.htm">Projets</a>
      </span>
      <span class="flex flex-row">
        <img src="/assets/images/icons/techs.svg" alt="" class="mr-2.5" />
        <a href="/BO-technos.htm">Technologies</a>
      </span>
      <span class="flex flex-row">
        <img src="/assets/images/icons/file-text.svg" alt="" class="mr-2.5" />
        <a href="/BO-orga.htm">Organisations</a>
      </span>
      <span class="flex flex-row">
        <img src="/assets/images/icons/sliders.svg" alt="" class="mr-2.5" />
        <a href="/home.htm">Portefolio</a>
      </span>
    </nav>
  </header>
  <main class="grow">