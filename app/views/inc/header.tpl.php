<?php
$currentPage = basename($_SERVER['PHP_SELF']);
dump($currentPage);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/style/output.css" rel="stylesheet" />
    <title>"Portefolio Thibault PERONNO"</title>
    <meta name="description" content="Retrouvez mon travail de concepteur et développeur d'application. Je présente des projets qui me servent à progresser dans ma connaissance des bonnes pratiques et des languages que j'apprécie. Ceci me permet de rester à l'écoute des évolutions. Et ainsi rester compétitif.">
</head>

<body class="px-2 md:px-dpc xl:px-vpc flex flex-col min-h-screen">
    <header>
        <!-- Our menu to diplay from tablet size -->
        <nav class="flex flex-col gap-2.5 sm:flex-row sm:justify-end sm:my-5 sm:py-5 hidden sm:flex">
            <a href="/" class="<?php echo $currentPage == 'index.php' ? 'rounded-full bg-secondary text-white p-2.5' : ''; ?>">Accueil</a>
            <a href="projets" class="<?php echo $currentPage == 'projets' ? 'rounded-full bg-secondary text-white p-2.5' : ''; ?>">Projets</a>
            <a href="technos" class="<?php echo $currentPage == 'technologie' ? 'rounded-full bg-secondary text-white p-2.5' : ''; ?>">Technologies</a>
            <a href="cv" class="<?php echo $currentPage == 'cv' ? 'rounded-full bg-secondary text-white p-2.5' : ''; ?>">CV</a>
            <a href="connexion" class="<?php echo $currentPage == 'connexion' ? 'rounded-full bg-secondary text-white p-2.5' : ''; ?>">Administration</a>
        </nav>
        <!-- Our menu to display for mobil size -->
        <img src="/assets/images/nav/menu.svg" alt="" class="sm:hidden w-10 float-right mb-2.5" id="mobil-menu">
        <nav class="flex flex-col gap-5 p-5 bg-primary text-xl font-bold text-secondary w-screen h-screen sm:hidden fixed top-0 left-[1000px] z-10 transition-left duration-500 ease-out" id="menu">
            <img src="/assets/images/nav/x.svg" alt="close the menu" class="w-12 self-end" id="close-menu">
            <span class="flex flex-row">
                <img src="/assets/images/nav/home.svg" alt="" class="mr-2.5">
                <a href="home.htm">Accueil</a>
            </span>
            <span class="flex flex-row">
                <img src="/assets/images/nav/cup.svg" alt="" class="mr-2.5">
                <a href="projects.htm">Projets</a>
            </span>
            <span class="flex flex-row">
                <img src="/assets/images/nav/techs.svg" alt="" class="mr-2.5">
                <a href="#">Technologies</a>
            </span>
            <span class="flex flex-row">
                <img src="/assets/images/nav/file-text.svg" alt="" class="mr-2.5">
                <a href="cv.htm">CV</a>
            </span>
            <span class="flex flex-row">
                <img src="/assets/images/nav/sliders.svg" alt="" class="mr-2.5">
                <a href="connect.htm">Administration</a>
            </span>
        </nav>
    </header>
    <main class="grow">