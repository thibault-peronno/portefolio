<?php
session_start();
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
    <meta name="description" content="Retrouvez mon travail de concepteur et développeur d'application. Je présente des projets qui me servent à progresser dans ma connaissance des bonnes pratiques et des languages que j'apprécie. Ceci me permet de rester à l'écoute des évolutions. Et ainsi rester compétitif.">
</head>
<!-- header('location:/connexion') -->
<!-- px-2 md:px-dpc  -->
<body class="3xl:px-dpc flex flex-col min-h-screen text-lg bg-body-fade-grey">
    <header class="bg-white sm:p-5">
        <!-- Our menu to diplay from tablet size -->
        <nav class="flex flex-col gap-2.5 sm:flex-row sm:justify-end hidden sm:flex">
            <a href="/" class="text-xl <?php echo $currentPage == 'index.php' ? 'rounded-full bg-secondary text-white p-2.5' : ''; ?>">Accueil</a>
            <a href="/projets" class="text-xl <?php echo $currentPage == 'projets' ? 'rounded-full bg-secondary text-white p-2.5' : ''; ?>">Projets</a>
            <a href="/languages" class="text-xl <?php echo $currentPage == 'languages' ? 'rounded-full bg-secondary text-white p-2.5' : ''; ?>">Technologies</a>
            <a href="/cv" class="text-xl <?php echo $currentPage == 'cv' ? 'rounded-full bg-secondary text-white p-2.5' : ''; ?>">CV</a>
            <?php if (isset($_COOKIE['PHPSESSID']) && $_SESSION['user_id']) : ?>
                <a href="/admin-accueil">Dashboard</a>
            <?php else : ?>
                <a href="/connexion" class="text-xl <?php echo $currentPage == 'connexion' ? 'rounded-full bg-secondary text-white p-2.5' : ''; ?>">Administration</a>
            <?php endif ?>
        </nav>
        <!-- Our menu to display for mobil size -->
        <img src="/assets/images/nav/menu.svg" alt="" class="sm:hidden w-10 float-right mb-2.5" id="mobil-menu">
        <nav class="flex flex-col gap-5 p-5 bg-primary text-xl font-bold text-secondary w-screen h-screen sm:hidden fixed top-0 left-[1000px] z-10 transition-left duration-500 ease-out" id="menu">
            <img src="/assets/images/nav/x.svg" alt="close the menu" class="w-12 self-end" id="close-menu">
            <span class="flex flex-row">
                <img src="/assets/images/nav/home.svg" alt="" class="mr-2.5">
                <a href="/home.htm">Accueil</a>
            </span>
            <span class="flex flex-row">
                <img src="/assets/images/nav/cup.svg" alt="" class="mr-2.5">
                <a href="/projects.htm">Projets</a>
            </span>
            <span class="flex flex-row">
                <img src="/assets/images/nav/techs.svg" alt="" class="mr-2.5">
                <a href="/technologie.htm">Technologies</a>
            </span>
            <span class="flex flex-row">
                <img src="/assets/images/nav/file-text.svg" alt="" class="mr-2.5">
                <a href="/cv.htm">CV</a>
            </span>
            <span class="flex flex-row">
                <img src="/assets/images/nav/sliders.svg" alt="" class="mr-2.5">
                <a href="/connect.htm">Administration</a>
            </span>
        </nav>
    </header>
    <main class="grow <?php echo $currentPage == 'connexion' ? 'content-center' : ''; ?>">