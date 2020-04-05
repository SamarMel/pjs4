<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Les cinémas et les metro d'Ile-De-France</title>


	<link rel="stylesheet" href="/View/css/map/map.css">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
	   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
	   crossorigin=""/>
	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
	   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
	   crossorigin=""></script>
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
	<script type='text/javascript' src='https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js'></script>



</head>

<body>
	<? require(dirname(__FILE__) . "/../modules/menu.tpl") ?>
	<style>#menu {background: var(--color-action-4);}</style>
	<div id="page">
	<?
	$page_name = "CARTE";
	require(dirname(__FILE__) . "/../modules/header.php");
	?>
		<div id="mapid"></div>
		<ul id="listeCROUS">
			<li id="listeResto"><img src="/View/map/images/eat.png" class="iconeListe"><span class="titreListe">Vous restaurer</span><br>Restauration des CROUS</li>
			<li id="listeLogement"><img src="/View/map/images/dormir.png" class="iconeListe"><span class="titreListe">Vous loger</span><br>Résidences universitaires des CROUS</li>
		</ul>
	</div>
	<?
	require(dirname(__FILE__) . "/../modules/chatbox.html");
	require(dirname(__FILE__) . "/../modules/footer.tpl");
	?>

	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="/View/js/map/leaflet.ajax.min.js"></script>
	<script src="/View/js/map/mapJS.js"></script>

</body>

</html>