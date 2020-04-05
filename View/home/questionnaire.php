<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Questionnaire</title>
    <link rel="stylesheet" href="/View/css/style.css">
    <link rel="stylesheet" href="/View/css/home/questionnaire.css">
</head>
<body>

<!-- MENU -->
<?php require_once(dirname(__FILE__) . "/../modules/menu.tpl");?>
<style>#menu {background: var(--color-home-1);}</style>

<div id="page">
	<?php
	$page_name = "QUESTIONNAIRE";
	require_once(dirname(__FILE__) . "/../modules/header.php");
	?>
    <div id="quest">
        <label for="fname">Dans quelle ville habitez-vous ?</label><br>
        <input type="text" id="fname" name="fname"><br>
        <label for="fname">Code postal :</label><br>
        <input type="text" id="fname" name="fname"><br>
    
        <p>Votre logement est : </p>
        <input id="insalubre" type="radio" name="text" value="Insalubre"><label for="insalubre">Insalubre</label>
        <input id="non-adapte" type="radio" name="text" value="NonAdapte"><label for="non-adapte">Non adapté</label>
        <input id="non-securise" type="radio" name="text" value="NonSecurise"> <label for="non-securise">Non sécurisé</label>
    
        <div class="Insalubre msg">
            <p> J'ai des problèmes de :  </p>
            <select>
                <option></option>
                <option value="Plomberie">Plomberie</option>
                <option value="Moisissure">Moisissure</option>
                <option value="Chauffage">Chauffage</option>
            </select>
            <div class="Plomberie msgs">
                <p>Et plus précisément : </p>
                <input id="canalisations" type="checkbox" name="text" value="Canalisations"><label for="canalisations">Canalisations encombrées ou bouchées</label>
                <input id="chasse" type="checkbox" name="text" value="Chasse"><label for="chasse">La chasse d’eau ne se remplit plus</label>
                <input id="absence" type="checkbox" name="text" value="Absence"><label for="absence">Absence d'eau chaude</label>
            </div>
    
            <div class="Moisissure msgs">
                <p>Et plus précisément :   </p>
                <input id="remontee" type="checkbox" name="text" value="Remontée"> <label for="remontee">Remontée capillaire</label>
                <input id="infiltration" type="checkbox" name="text" value="Infiltration"> <label for="infiltration">Infiltration d'eau</label>
                <input id="humidite" type="checkbox" name="text" value="Humidité"> <label for="humidite">Humidité dûe aux fuites dans les conduits</label>
            </div>
    
            <div class="Chauffage msgs">
                <p>Et plus précisément :   </p>
                <input id="fonction" type="checkbox" name="text" value="Fonction"> <label for="fonction">Aucun radiateur ne fonctionne</label>
                <input id="temperature" type="checkbox" name="text" value="Temperature"> <label for="temperature">Le radiateur n'a pas la même température sur toute sa surface</label>
                <input id="bruit" type="checkbox" name="text" value="Bruit"><label for="bruit">Mon radiateur fait du bruit</label>
            </div>
    
        </div>
    
        <div class="Canalisations ms">
            Si votre canalisation de douche ou de baignoire est bouchée, <br>
            mélangez un peu de bicarbonate de soude avec du vinaigre. <br>
            Versez-le dans votre canalisation, puis placez le bouchon dessus. <br>
            Après 45-60 minutes, remplir la baignoire avec de l'eau.
        </div>
        <div class="Chasse ms">
            Le problème vient probablement du robinet-flotteur, qui est encrassé ou défectueux. <br>
            Commencez par le nettoyer et faire tremper les pièces dans du vinaigre blanc. <br>
            Vérifiez l'état de la membrane, et changez-la si elle semble abimée. Si cela ne marche pas, <br>
            il faudra sans doute changer le robinet-flotteur
        </div>
        <div class="Absence ms">
            La première chose à faire est de vérifier que votre chauffe-eau, <br>
            votre ballon ou votre chaudière soit bien alimenté. <br>
            Pour cela, rendez-vous devant votre disjoncteur : <br>
            Cherchez le fusible comportant une petite icône ressemblant à votre chauffe-eau <br>
            (c'est le fusible dédié au système d'alimentation en eau chaude). <br>
            Si celà ne marche toujours pas, vous devriez contacter un expert.
        </div>
    
        <div class="Remontée ms">
            Si vous observez des remontées capillaires dans votre maison, faites appel au plus vite à un expert. <br>
            Vous les reconnaissez avec l'apparition de tâches d'humidité sombres <br>
            à la base de vos murs et la détérioration de vos enduits. <br>
            Vous avez également d'autres signes qui vous mettent en garde : <br>
            vos sols mouillés, le décollement de votre papier-peint ou encore l'écaillage de votre peinture.<br>
            Tout cela entraîne à terme une surconsommation de votre énergie, donc de votre facture. <br>
            A ce stade, vous vous demandez surement comment traiter votre isolation et vous débarrasser de ces ennuis.
        </div>
        <div class="Infiltartion ms">
            L’hydrofugation d’un mur extérieur implique l’application d’une sorte de couche protectrice.
            Ainsi, vous évitez ou vous pouvez combattre l’infiltration d’eau. <br>
            En outre, le produit d’imprégnation rend plus difficile la fixation de saletés sur le mur; <br>
            vous pouvez donc jouir d’un mur propre plus longtemps. <br>
            Avant l’hydrofugation, le mur doit être nettoyé. <br>
            Des dégâts éventuels doivent être réparés aussi avant de pouvoir commencer le traitement.
        </div>
        <div class="Humidité ms">
            Avant toute chose, coupez l’arrivée d’eau et ouvrez tous les robinets pour vider entièrement le circuit. <br>
            A l’endroit de la fuite, essayez de sécher au maximum avec un linge sec. <br>
            Que le tuyau soit en plastique, en PVC, ou en cuivre, <br>
            il faut alors poser ou renouveler un joint, voire effectuer une soudure (sauf pour les tuyaux plastiques) <br>
            Pour boucher rapidement la fuite, <br>
            utilisez de la pâte spéciale à reboucher. Cette pâte est extrêmement résistante
        </div>
    
        <div class="Fonction ms">
    
        </div>
        <div class="Temperature ms">
    
        </div>
        <div class="Bruit ms">
    
        </div>
    
    
    
        <div class="NonAdapte msg">
            <p> De quel ordre est votre problème ? </p>
            <select>
                <option> </option>
                <option value="Nb">Famille nombreuse</option>
                <option value="Loin">Logement éloigné</option>
                <option value="Colloc">Problème avec mon/ma/mes collocataires</option>
            </select>
            <div class="Nb msgs">
                <p>Et plus précisément : </p>
                <input id="fuite" type="checkbox" name="text" value="Espace"> <label for="fuite">Fuite d'eau</label>
                <input id="inondation" type="checkbox" name="text" value="Loyer"> <label for="inondation">Inondation</label>
                <input id="conduits" type="checkbox" name="text" value="Bruit"> <label for="conduits">Conduits bouchés</label>
            </div>
    
            <div class="Loin msgs">
                <p>Et plus précisément :   </p>
                <input id="transport" type="checkbox" name="text" value="Espace"> <label for="transport">Mon immeuble n'est pas bien déservi par les transports</label>
                <input id="temps" type="checkbox" name="text" value="Loyer"> <label for="temps">Je prend beaucoup de temps à rentrer chez moi</label>
                <input id="problemes" type="checkbox" name="text" value="Bruit"><label for="problemes"> Il y a souvent des pbs de transport</label>
            </div>
    
            <div class="Colloc msgs">
                <p>Et plus précisément :   </p>
                <input id="coloc" type="checkbox" name="text" value="Espace"> <label for="coloc">J'ai trop de collocataires, je n'ai pas d'espace pour travailler</label>
                <input id="radin" type="checkbox" name="text" value="Loyer"> <label for="radin">Ils ne paient pas leur part du loyer</label>
                <input id="bruyant" type="checkbox" name="text" value="Bruit"> <label for="bruyant">Ils font beaucoup de bruit</label>
            </div>
        </div>
    
    
        <div class="Espace ms">Solution 1</div>
        <div class="Loyer ms">Solution 2</div>
        <div class="Bruit ms">Solution 3</div>
    
    
        <div class="Espace ms">Solution 1</div>
        <div class="Loyer ms">Solution 2</div>
        <div class="Bruit ms">Solution 3</div>
    
    
        <div class="Espace ms">Solution 1</div>
        <div class="Loyer ms">Solution 2</div>
        <div class="Bruit ms">Solution 3</div>
    
    
        <div class="NonSecurise msg">
            <p> J'ai des problème de :  </p>
            <select>
                <option> </option>
                <option value="Plomberie">Serrurerie</option>
                <option value="Moisissure">Moisissure</option>
                <option value="Chauffage">Chauffage</option>
            </select>
            <div class="Plomberie msgs">
                <p>Et plus précisément :   </p>
                <input id="fuite-2" type="checkbox" name="text" value="Fuite"> <label for="fuite-2">Fuite d'eau</label>
                <input id="inondation-2" type="checkbox" name="text" value="Inno"> <label for="inondation-2">Inondation</label>
                <input id="conduits-2" type="checkbox" name="text" value="Cond"><label for="conduits-2"> Conduits bouchés</label>
            </div>
    
            <div class="Moisissure msgs">
                <p>Et plus précisément :   </p>
                <input id="murs" type="checkbox" name="text" value="Fuite"><label for="murs"> murs</label>
                <input id="verdure" type="checkbox" name="text" value="Inno"> <label for="verdure">verdure</label>
                <input id="humidite-2" type="checkbox" name="text" value="Cond"> <label for="humidite-2">humidité</label>
            </div>
    
            <div class="Chauffage msgs">
                <p>Et plus précisément :   </p>
                <input id="isolation" type="checkbox" name="text" value="Fuite"> <label for="isolation">isolation</label>
                <input id="froid" type="checkbox" name="text" value="Inno"><label for="froid"> froid</label>
                <input id="chaud" type="checkbox" name="text" value="Cond"><label for="chaud"> chaud</label>
            </div>
        </div>
    
        <div class="Fuit ms">Solution 1</div>
        <div class="Inno ms">Solution 2</div>
        <div class="Cond ms">Solution 3</div>
    
        <div class="Fuit ms">Solution 1</div>
        <div class="Inno ms">Solution 2</div>
        <div class="Cond ms">Solution 3</div>
    
        <div class="Fuit ms">Solution 1</div>
        <div class="Inno ms">Solution 2</div>
        <div class="Cond ms">Solution 3</div>
    </div>
</div>

<!-- Chatbox -->
<?php require_once(dirname(__FILE__) . "/../modules/chatbox.html"); ?>
<!-- Footer -->
<?php require_once(dirname(__FILE__) . "/../modules/footer.tpl"); ?>
</body>
<script src="/View/js/home/questionnaire.js"></script>
</html>