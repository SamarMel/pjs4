<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>FAQ</title>
    <link rel="stylesheet" href="/View/css/style.css">
    <link rel="stylesheet" href="/View/css/home/faq.css">
</head>
<body>

<!-- MENU -->
<?php require_once(dirname(__FILE__) . "/../modules/menu.tpl");?>
<style>#menu {background: var(--color-home-1);}</style>

<div id="page">
	<?php
	$page_name = "F.A.Q.";
	require_once(dirname(__FILE__) . "/../modules/header.php");
	?>
    <div class="section" id="SectionLogement">
        <h2>Logement</h2>
        <div id="Choix1">
            <label><input type="radio" name="optradio">Comment avoir un logement Crous ?</label>
        </div>

        <div class="rep" id ="rep1">
           <p>Il faut pour cela constituer un Dossier Social Étudiant (DSE) sur <a href="https://messervices.etudiant.gouv.fr">messervices.etudiant.gouv.fr</a> entre le 15 janvier et le 15 mai.</p>
           <p> Remarque :: Les étudiants internationaux de Campus France doivent déposer leur demande de logement au service international du Crous de Paris.
Les étudiants en mobilité doivent formuler leur demande auprès du service relations internationales de leur établissement d’enseignement.
</p>
           <p> Pour les demandes de renouvellement :
Après la constition de TON DSE, procéde à votre demande de renouvellement en vous rendant à la rubrique « Gérer son logement » puis cliquez sur la brique « Cité U »
et clique sur « Demander mon renouvellement »</p>
           <p> 
Après étude de ton dossier, une réponse conditionnelle vous te adressée par courriel avant le 12 juin 2020.
En cas d’acceptation, tu dois impérativement confirmer ton renouvellement sous 15 jours en allant sur « Cité U »</p>
        </div>
        <div id="Choix2">
            <label><input type="radio" name="optradio">Comment bénéficier de l'APL ?</label>
        </div>
        <div class="rep" id ="rep2">
            <p>Vous devez contacter la CAF (Caisse d'Allocations Familiales) de votre département, en vous rendant sur leur site.
                Vous trouverez plus d'informations dans la rubrique <a href="/?controller=home&action=articles&idCate=3">Logement</a>.</p>
        </div>
        <p class="QuestLog">
            <label for="QuestLog">Je voudrais plus d'informations sur les logements étudiant : </label>
           <a href='?controller=home&action=articles&idCate=3'> Logement </a>
        </p>
    </div>


    <div class="section" id="SectionSante">
        <h2>Santé</h2>
        <div id="Choix3">
            <label><input type="radio" name="optradio">Dispose-t-on d'un préavis pour résilier notre mutuelle santé ?</label>
        </div>

        <div class="rep" id ="rep3">
            <p>Dorénavant, les mutuelles ont pour obligation d'informer leurs assurés de la
                possibilité de résilier leur contrat, et ce avant chaque échéance annuelle de prime
                de cotisation. Les assurés disposent généralement d'un préavis de 2 mois pour résilier
                leur mutuelle santé.
            </p>
        </div>
        <div id="Choix4">
            <label><input type="radio" name="optradio">Puis-je bénéficier de la sécurité sociale ?</label>
        </div>
        <div class="rep" id ="rep4">
            <p>Depuis le 1er janvier 2016, avec la protection universelle maladie (PUMa),
                toute personne qui travaille ou réside en France de manière stable et régulière
                a droit à la prise en charge de ses frais de santé.
            </p>
        </div>
        <p class="QuestSante">
            <label for="QuestSante">Je voudrais plus d'informations sur la santé : </label>
            <a href='?controller=home&action=articles&idCate=1'> Santé </a>

        </p>
    </div>

    <div class="section" id="SectionEtudes">
        <h2>Etudes</h2>
        <div id="Choix5">
            <label><input type="radio" name="optradio">Je voudrais poser des questions à des professeurs.</label>
        </div>

        <div class="rep" id ="rep5">
            <p>Rends toi sur notre forum pour que tu puisses échanger avec des professeurs !</p>
        </div>
        <div id="Choix6">
            <label><input type="radio" name="optradio">J'ai besoin d'aide pour mes cours.</label>
        </div>
        <div class="rep" id ="rep6">
            <p>Consultez notre plateforme d'aide scolaire en ligne !</p>
        </div>
        <p class="QuestEtudes">
            <label for="QuestEtudes">Je voudrais des informations concernant les études : </label>
            <a href='?controller=home&action=articles&idCate=4'> Etudes </a>
        </p>
    </div>


    <div class="section" id="SectionAides">
        <h2>Aides</h2>
        <div id="Choix7">
            <label><input type="radio" name="optradio"> Où puis-je trouver un job étudiant ?</label>
        </div>

        <div class="rep" id ="rep7">
            <p>Il existe de nombreuses plateformes qui proposent des offres d'emploi étudiant tel que <a href="https://www.indeed.fr"> indeed.fr</a></p>
        </div>
        <div id="Choix8">
            <label><input type="radio" name="optradio"> Je ne sais pas comment ouvrir un compte bancaire </label>
        </div>
        <div class="rep" id ="rep8">
            <p>Hello Bank ne propose aucun frais de gestion et une démarche d'ouverture de compte simplifiée <br>
                qui lui permet de se distinguer de ses concurrents.L'ouverture de compte se fait en à peine 5 minutes !<br>
                Elle se fait directement en ligne et les frais sont au plus. Voici le site d'Hello Bank pour plus d'information :
                <a href="https://www.hellobank.fr"> hellobank.fr</a>
            </p>
        </div>
        <p class="QuestAides">
            <label for="QuestAides">Je voudrais des informations concernant les aides étudiantes : </label>
            <a href='?controller=home&action=articles&idCate=2'> Aides </a>

        </p>
    </div>
</div>

<!-- Chatbox -->
<?php require_once(dirname(__FILE__) . "/../modules/chatbox.html"); ?>
<!-- Footer -->
<?php require_once(dirname(__FILE__) . "/../modules/footer.tpl"); ?>
</body>
<script src="/View/js/home/faq.js"></script>
</html>