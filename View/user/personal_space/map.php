<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Carte</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="/View/css/style.css">
	<link rel="stylesheet" type="text/css" href="/View/css/user/map.css">
	
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
	      integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
	      crossorigin=""/>
	<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

</head>
<body>
<? require(dirname(__FILE__) . "/../../modules/menu.tpl") ?>
<style>#menu {background: var(--color-action-4);}</style>
<div id="page">
	<?
	$page_name = "CARTE";
	require(dirname(__FILE__) . "/../../modules/header.php");
	?>
	<div id="mapid"></div>
	<ul id="opt-list">
		<li class="opt">
            <img src="/Resources/images/knifefork.png" class="iconeListe" alt="Icône restaurant">
            <span class="titreListe">Vous restaurer</span>
            <span>Restauration des CROUS</span>
        </li>
		<li class="opt">
            <img src="/Resources/images/bed.png" class="iconeListe" alt="Icône lit">
            <span class="titreListe">Vous loger</span>
            <span>Résidences universitaires des CROUS</span>
        </li>
	</ul>

</div>

<?
require(dirname(__FILE__) . "/../../modules/chatbox.html");
require(dirname(__FILE__) . "/../../modules/footer.tpl");
?>
</body>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
        crossorigin=""></script>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="/Resources/lib/leaflet.ajax.min.js"></script>
<script src="/View/js/personal_space/map.js"></script>
</html>