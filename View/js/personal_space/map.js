$(document).ready(() => {
	//Chargement initial de la MAP
	let map = L.map('mapid').setView([48.85602736476408, 2.3498749732061697], 11);
	let layerGroupLogement = L.layerGroup()//.addTo(map);
	let layerGroupRestauration = L.layerGroup().addTo(map);
	let layerGroupPoleEmploi = L.layerGroup().addTo(map);
	
	const restaurantIcon = L.icon({
		iconUrl: '/Resources/images/knifefork.png',
		iconSize: [60, 50],
		iconAnchor: [30, 25],
	});
	
	const logementIcon = L.icon({
		iconUrl: '/Resources/images/bed.png',
		iconSize: [60, 50],
		iconAnchor: [30, 25],
	});
	
	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		maxZoom: 18,
		id: 'mapbox.streets',
		accessToken: 'pk.eyJ1IjoiYWZyYWlkIiwiYSI6ImNrN25wdTFhZDAxOWczZnBnNTBwNTh1aTcifQ.JPo06ajh1i5Vshq9m1G0LQ'
	}).addTo(map);
	
	let coordsGPS = [];
	currentLocation();
	
	$.getJSON("/Resources/json/fr_crous_logement_france_entiere.geojson", function(data){
		L.geoJson(data, {
			pointToLayer: function (feature, latlng) {
				return L.marker(latlng, {icon : logementIcon});
				
			}, onEachFeature: function (feature, layer) {
				
				//layer.bindPopup(feature.properties.nom + "<br>" + feature.properties.adresse+"<br>" + "Nombre d'écrans : " + feature.properties.ecrans + "<br>Nombre de places : " + feature.properties.fauteuils);
				
			}
		}).addTo(layerGroupLogement);
	});
	
	$.getJSON("/Resources/json/fr_crous_restauration_france_entiere.geojson", function(data){
		L.geoJson(data, {
			pointToLayer: function (feature, latlng) {
				return L.marker(latlng, {icon : restaurantIcon});
				
			}, onEachFeature: function (feature, layer) {
				
				//layer.bindPopup(feature.properties.nom + "<br>" + feature.properties.adresse+"<br>" + "Nombre d'écrans : " + feature.properties.ecrans + "<br>Nombre de places : " + feature.properties.fauteuils);
				
			}
		}).addTo(layerGroupRestauration);
	});
	
	map.on('popupopen', function (e) {
	
	});
	
	function currentLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition((function (position) {
				
				var personIcon = L.icon({
					iconUrl: '/Resources/images/person.png',
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
});