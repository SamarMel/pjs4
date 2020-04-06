var resto = true;
var logement = true;
var map;
var layerGroupLogement;
var layerGroupRestauration;
var markerClustersResto; 
var markerClustersLogement; 
window.onload = function () {
	
	$("#listeResto").click(choixListeResto);
	$("#listeLogement").click(choixListeLogement);
	$("#listeResto").css("border-left", "7px solid #ff8822");
	$("#listeLogement").css("border-left", "7px solid #0077ff");
	//Chargement initial de la MAP
	map = L.map('mapid').setView([48.85602736476408, 2.3498749732061697], 1);
	layerGroupLogement = L.layerGroup();
	layerGroupRestauration = L.layerGroup();

	const restaurantIcon = L.icon({
	    iconUrl: '/View/map/images/knifefork.png',
	    iconSize: [60, 50],
	    iconAnchor: [30, 25],
	});
	const logementIcon = L.icon({
	    iconUrl: '/View/map/images/bed.png',
	    iconSize: [60, 50],
	    iconAnchor: [30, 25],
	});

	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		maxZoom: 18,
		id: 'mapbox.streets',
		accessToken: 'pk.eyJ1IjoiYWZyYWlkIiwiYSI6ImNrN25wdTFhZDAxOWczZnBnNTBwNTh1aTcifQ.JPo06ajh1i5Vshq9m1G0LQ'
	}).addTo(map);

	var coordsGPS = new Array();
	currentLocation();

	markerClustersResto = L.markerClusterGroup(); 
	markerClustersLogement = L.markerClusterGroup(); 

	$.getJSON("/View/map/donnees/fr_crous_logement_france_entiere.geojson", function(data){
		L.geoJson(data, {
					pointToLayer: function (feature, latlng) {
						var m = L.marker(latlng, {icon : logementIcon});
						var pop = "<span class=popup>Nom : </span>" + feature.properties.title + "<br>" + "<span class=popup>Adresse : </span>" + feature.properties.address + "<br>" + "<span class=popup>Infos utiles : </span>" + feature.properties.infos + "<br>" + "<img class=imgPop src=" + feature.properties.photo + ">";
						markerClustersLogement.addLayer(m.bindPopup(pop));
						return m;

					}, onEachFeature: function (feature, layer) {

						layer.bindPopup("<span class=popup>Nom : </span>" + feature.properties.title + "<br>" + "<span class=popup>Adresse : </span>" + feature.properties.address + "<br>" + "<span class=popup>Infos utiles : </span>" + feature.properties.infos + "<br>" + "<img class=imgPop src=" + feature.properties.photo + ">");
						
					}
				}).addTo(layerGroupLogement);
	});
	map.addLayer(markerClustersLogement);

	$.getJSON("/View/map/donnees/fr_crous_restauration_france_entiere.geojson", function(data){
		L.geoJson(data, {
					pointToLayer: function (feature, latlng) {
						var m = L.marker(latlng, {icon : restaurantIcon});
						var pop = "<span class=popup>Nom : </span>" + feature.properties.title + "<br>" + "<span class=popup>Adresse : </span>" + feature.properties.contact + "<br>" + "<span class=popup>Infos utiles : </span>" + feature.properties.infos + "<br>" + "<img class=imgPop src=" + feature.properties.photo + ">";
						markerClustersResto.addLayer(m.bindPopup(pop));
						return m;

					}, onEachFeature: function (feature, layer) {

						layer.bindPopup("<span class=popup>Nom : </span>" + feature.properties.title + "<br>" + "<span class=popup>Adresse : </span>" + feature.properties.contact + "<br>" + "<span class=popup>Infos utiles : </span>" + feature.properties.infos + "<br>" + "<img class=imgPop src=" + feature.properties.photo + ">");
						
					}
				}).addTo(layerGroupRestauration);
	});
	map.addLayer(markerClustersResto);
	
	map.on('popupopen', function (e) {

	});



	function currentLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition((function (position) {

				var personIcon = L.icon({
				    iconUrl: '/View/map/images/person.png',
				    iconSize: [50, 70],
				    iconAnchor: [25, 35],
				});

				var marker = L.marker([position.coords.latitude, position.coords.longitude], {icon : personIcon});
				marker.addTo(map);
				coordsGPS[0] = position.coords.latitude;
				coordsGPS[1] = position.coords.longitude;
			}));
		}	
	}
	
}

function choixListeResto(){
	if(resto){
		resto = false;
		$("#listeResto").css("border-left", "2px solid #ff8822");
		$("#listeResto").css("opacity", "0.25");
		$("#listeResto").css("transform", "translate(20px,0px)");
		$("#listeResto").css("width", "380px;");
		map.removeLayer(markerClustersResto);
	}
	else{
		resto = true;
		$("#listeResto").css("border-left", "7px solid #ff8822");
		$("#listeResto").css("opacity", "1");
		$("#listeResto").css("transform", "translate(0px,0px)");
		$("#listeResto").css("width", "400px");
		//layerGroupRestauration.addTo(map);
		map.addLayer(markerClustersResto);
	}
}

function choixListeLogement(){
	if(logement){
		logement = false;
		$("#listeLogement").css("border-left", "2px solid #0077ff");
		$("#listeLogement").css("opacity", "0.25");
		$("#listeLogement").css("transform", "translate(20px,0px)");
		$("#listeLogement").css("width", "380px;");
		map.removeLayer(markerClustersLogement);
	}
	else{
		logement = true;
		$("#listeLogement").css("border-left", "7px solid #0077ff");
		$("#listeLogement").css("opacity", "1");
		$("#listeLogement").css("transform", "translate(0px,0px)");
		$("#listeLogement").css("width", "400px");
		//layerGroupLogement.addTo(map);
		map.addLayer(markerClustersLogement)
	}
}
