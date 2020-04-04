<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Qui sommes-nous ?</title>
    <link rel="stylesheet" href="/View/css/style.css">
    <link rel="stylesheet" href="/View/css/home/qui_sommes_nous.css">
</head>
<body>

<!-- MENU -->
<?php require_once(dirname(__FILE__) . "/../modules/menu.tpl");?>
<style>#menu {background: var(--color-home-1);}</style>

<div id="page">
	<?php
	$page_name = "QUI SOMMES-NOUS ?";
	require_once(dirname(__FILE__) . "/../modules/header.php");
	?>
    <h2>Présentation</h2>
    <p>
        Dans le cadre d’un projet tutoré pour les étudiants de 2ème année de DUT informatique à
        l'IUT de Paris Descartes et sous la tutelle de notre professeur référent Karim Foughali,
        nous te présentons un site web dédié à la précarité étudiante.
    </p>
    <h2>Notre équipe</h2>
    <div id="team">
        <div class="card">
            <img src="/Resources/images/bitmoji/alberic.png" alt="bitmoji-alberic"/>
            <h6>Albéric</h6>
            <p>Son calme et ses qualités techniques nous ont permis de te fournir un site de qualité !</p>
        </div>
        <div class="card">
            <img src="/Resources/images/bitmoji/andrea.png" alt="bitmoji-andrea"/>
            <h6>Andréa</h6>
            <p>Sa timidité ainsi que ses compétences t’ont fourni une application mobile d’exception !</p>
        </div>
        <div class="card">
            <img src="/Resources/images/bitmoji/anoup.png" alt="bitmoji-anoup"/>
            <h6>Anoup</h6>
            <p>Son humour et son expérience nous ont permis de travailler dans la bonne humeur et de t’offrir une page regroupant les principales bourses !</p>
        </div>
        <div class="card">
            <img src="/Resources/images/bitmoji/bintou.png" alt="bitmoji-bintou"/>
            <h6>Bintou</h6>
            <p>Sa créativité et son dévouement envers la vie étudiante nous ont permis de t’offrir une FAQ et un questionnaire complets !</p>
        </div>
        <div class="card">
            <img src="/Resources/images/bitmoji/macoura.png" alt="bitmoji-macoura"/>
            <h6>Macoura</h6>
            <p>Sa qualité rédactionnelle (oui, j’ai aussi écrit ce texte 😊), t’a permis d’avoir des pages claires et complètes !</p>
        </div>
        <div class="card">
            <img src="/Resources/images/bitmoji/samar.png" alt="bitmoji-samar"/>
            <h6>Samar</h6>
            <p>Son sens de l’organisation et sa rigueur t’ont permis d’avoir un site abouti en tout point !</p>
        </div>
        <div class="card">
            <img src="/Resources/images/bitmoji/ulysse.png" alt="bitmoji-ulysse"/>
            <h6>Ulysse</h6>
            <p>Son humilité (je plaisante 😉) et ses compétences dans la plupart des domaines ont été une aide précieuse lors de la création du site.</p>
        </div>
    </div>
</div>

<!-- Chatbox -->
<?php require_once(dirname(__FILE__) . "/../modules/chatbox.html"); ?>
<!-- Footer -->
<?php require_once(dirname(__FILE__) . "/../modules/footer.tpl"); ?>
</body>
</html>