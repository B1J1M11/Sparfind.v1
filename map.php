<?php

include("server_connexion.php");

//Interdire l'accès si non connecté 
if (!isset($_SESSION['user_id'])) {
    header("Location: ../connexion.php");
    exit();
}

include("accesMeet.php");
$meets = LireListeMeet();

// Utilisateur connecté
$user_id = $_SESSION["user_id"];



// Préparer les meets pour le JS
$js_meets = [];
foreach ($meets as $meet) {
    $meet['icon'] = 'orangeMarker'; // Par défaut en noir
    $meet['nbParticipant'] = NombreParticipantsMeet($meet["id"]) + 1;
    $meet['date'] = date("d/m/Y H:i", strtotime($meet['date']));;
    if ($meet['user_id'] == $user_id) {
        $meet['icon'] = 'blueMarker'; // Bleu si créé par l'utilisateur
    } elseif (estInscritAuMeet($user_id, $meet['id'])) {
        $meet['icon'] = 'greenMarker'; // Orange si rejoint par l'utilisateur
    } elseif ($meet['nbParticipant'] >= $meet["capacite"] && !EstInscritAuMeet($user_id, $meet['id'])) {
        continue;
    }
    $js_meets[] = $meet;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/mapStyle.css">
    <title>Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>

<body>


    <!-- Carte -->
    <div class="page">
        <?php include("menu.php"); ?>
        <div class="zone">
            <div id="map" class="forme"></div>
        </div>


        <!-- Formulaire de création de Meet -->
        <div id="meetForm" style="display: none;">
            <h3>Créer un Meet</h3>
            <form action="TraitementForm/meet_form.php" method="post">
                <div class="form-group">
                    <label for="sport">Sport</label>
                    <select id="sport" name="sport">
                        <option value="Mma">MMA</option>
                        <option value="Boxe">Boxe Anglaise</option>
                        <option value="Kick-Boxing">Kick Boxing</option>
                        <option value="Muay-Thaï">Muay Thai</option>
                        <option value="Lutte">Lutte</option>
                        <option value="Grappling">Grappling</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="datetime-local" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="capacite">Nombre max de partenaires</label>
                    <input type="number" id="capacite" name="capacite" min=2 max=6 value="2" required>
                </div>
                <div class="form-group">
                    <label for="niveau">Niveau</label>
                    <select id="niveau" name="niveau">
                        <option value="Débutant">Débutant</option>
                        <option value="Intermédiaire">Intermédiaire</option>
                        <option value="Avancé">Avancé</option>
                    </select>
                </div>
                <input type="hidden" id="coordonnees" name="coordonnees">
                <div class="btn-container">
                    <button type="button" class="btn btn-secondary" onclick="hideForm()">Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </form>
        </div>

</body>

<script>
    // Initialisation de la carte
    var map = L.map('map', {
        center: [43.529, 5.447],
        zoom: 14,
        maxBounds: [
            [43.504, 5.417], // Sud-Ouest (SW) - coin inférieur gauche
            [43.554, 5.477] // Nord-Est (NE) - coin supérieur droit
        ],
        maxBoundsViscosity: 1
    });
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        minZoom: 15,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // Légende
    var legend = L.control({
        position: 'bottomright'
    });

    legend.onAdd = function(map) {
        var div = L.DomUtil.create('div', 'legend');

        div.innerHTML += `
        <div class="legend-item">
            <img src="imports/orangeMarker.png" style="height: 35px"> 
            <span>Meet disponible</span>
        </div>
        <div class="legend-item">
            <img src="imports/blueMarker.png" style="height: 35px"> 
            <span>Meet crée</span>
        </div>
        <div class="legend-item">
            <img src="imports/greenMarker.png" style="height: 35px"> 
            <span>Meet rejoint</span>
        </div>
        <div class="legend-item">
            <i style="background: #E3CF66; width: 30px; height: 30px; border: 3.5px solid black;"></i>
            <span>Zone de parc</span>
        </div>
    `;
        return div;
    };


    legend.addTo(map);


    // Affiche coordonnées au clic
    var popup = L.popup();

    function onMapClick(e) {
        var content = "<div class='displex poppins'>" +
            "Vous avez cliqué sur la carte à " + e.latlng.toString() + "<br>" +
            "<button id='popupButton' class='leBut'>Créer un Meet</button>" +
            "</div>";
        popup.setLatLng(e.latlng).setContent(content).openOn(map);

        document.getElementById('coordonnees').value = e.latlng.lat + ", " + e.latlng.lng;
    }
    map.on('click', onMapClick);

    map.on('popupopen', function(e) {
        var popupButton = document.getElementById('popupButton');
        if (popupButton) {
            popupButton.addEventListener('click', function() {
                document.getElementById('coordonnees').value = e.popup.getLatLng().lat + ", " + e.popup.getLatLng().lng;
                document.getElementById('meetForm').style.display = 'block';
                map.closePopup();
            });
        }
    });

    function hideForm() {
        document.getElementById('meetForm').style.display = 'none';
    }

    // Gestion des Markers
    var orangeMarker = L.icon({
        iconUrl: 'imports/orangeMarker.png',
        iconSize: [45, 50],
        iconAnchor: [23, 50],
        popupAnchor: [0, -30]
    });

    var greenMarker = L.icon({
        iconUrl: 'imports/greenMarker.png',
        iconSize: [45, 50],
        iconAnchor: [23, 50],
        popupAnchor: [0, -30]
    });

    var blueMarker = L.icon({
        iconUrl: 'imports/blueMarker.png',
        iconSize: [45, 50],
        iconAnchor: [23, 50],
        popupAnchor: [0, -30]
    });

    var redMarker = L.icon({
        iconUrl: 'imports/redMarker.png',
        iconSize: [45, 50],
        iconAnchor: [23, 50],
        popupAnchor: [0, -30]
    });

    var blackMarker = L.icon({
        iconUrl: 'imports/blackMarker.png',
        iconSize: [45, 50],
        iconAnchor: [23, 50],
        popupAnchor: [0, -30]
    });

    // Ajout des markers sur la carte
    var meets = <?php echo json_encode($js_meets); ?>;
    meets.forEach(function(meet) {
        if (meet.coordonnees) {
            var coords = meet.coordonnees.split(',').map(Number);
            var markerIcon = window[meet.icon];
            var marker = L.marker(coords, {
                icon: markerIcon
            }).addTo(map);
            marker.bindPopup(
                "<div class='displex poppins'>" +
                "<b class='inter'>" + meet.sport + "</b><br>" +
                "Date: " + meet.date + "<br>" +
                "Niveau: " + meet.niveau + "<br>" +
                "Participants : " + meet.nbParticipant + " / " + meet.capacite + "<br>" +
                "<button onclick=\"location.href='meet_detail.php?id=" + meet.id + "'\" class='leBut'>Voir les détails</button>" +
                "</div>"
            );
        }
    });

    //----------- Liste des Parc -----------//

    // Parc Jourdan
    var parcJourdan = L.polygon([
        [43.519608, 5.44971],
        [43.519575, 5.449044],
        [43.519915, 5.448309],
        [43.520921, 5.447652],
        [43.521205, 5.448264],
        [43.523064, 5.448248],
        [43.523087, 5.448816],
        [43.5218, 5.448913],
        [43.521742, 5.449444],
        [43.519608, 5.44971]
    ], {
        color: 'black',
        fillColor: 'orange',
        fillOpacity: 0.5,
        weight: 3
    }).addTo(map);

    parcJourdan.bindPopup(
        "<div class='displex'><b class='inter'>Parc Jourdan</b><br><button id='popupButton' class='leBut'>Créer un Meet</button></div>"
    );

    //Parc Vendome
    var parcVendome = L.polygon([
        [43.531111, 5.441572],
        [43.531224, 5.442513],
        [43.531047, 5.442918],
        [43.530643, 5.443012],
        [43.530413, 5.44177],
        [43.531111, 5.441572]
    ], {
        color: 'black',
        fillColor: 'orange',
        fillOpacity: 0.5,
        weight: 3
    }).addTo(map);

    parcVendome.bindPopup(
        "<div class='displex'><b class='inter'>Parc Vendôme</b><br><button id='popupButton' class='leBut'>Créer un Meet</button></div>"
    );

    //Parc Saint-Mitre
    var parcSaintMitre = L.polygon([
        [43.534195, 5.421678],
        [43.534164, 5.422928],
        [43.533507, 5.423298],
        [43.533869, 5.424966],
        [43.533546, 5.425674],
        [43.532749, 5.424634],
        [43.532274, 5.424913],
        [43.532142, 5.421908],
        [43.534195, 5.421678]
    ], {
        color: 'black',
        fillColor: 'orange',
        fillOpacity: 0.5,
        weight: 3
    }).addTo(map);

    parcSaintMitre.bindPopup(
        "<div class='displex'><b class='inter'>Parc Saint-Mitre</b><br><button id='popupButton' class='leBut'>Créer un Meet</button></div>"
    );

    //Parc de la Torse
    var parcDeLaTorse = L.polygon([
        [43.522508, 5.468063],
        [43.52222, 5.465585],
        [43.520991, 5.466014],
        [43.520166, 5.465328],
        [43.519785, 5.465725],
        [43.520913, 5.466808],
        [43.520913, 5.467366],
        [43.522391, 5.468224],
        [43.522508, 5.468063]
    ], {
        color: 'black',
        fillColor: 'orange',
        fillOpacity: 0.5,
        weight: 3
    }).addTo(map);

    parcDeLaTorse.bindPopup(
        "<div class='displex'><b class='inter'>Parc de la Torse</b><br><button id='popupButton' class='leBut'>Créer un Meet</button></div>"
    );

    //Parc Rambot
    var parcRambot = L.polygon([
        [43.531558, 5.454449],
        [43.531837, 5.455264],
        [43.531624, 5.455436],
        [43.53169, 5.455731],
        [43.531157, 5.456257],
        [43.530457, 5.454953],
        [43.531558, 5.454449],
    ], {
        color: 'black',
        fillColor: 'orange',
        fillOpacity: 0.5,
        weight: 3
    }).addTo(map);

    parcRambot.bindPopup(
        "<div class='displex'><b class='inter'>Parc Rambot</b><br><button id='popupButton' class='leBut'>Créer un Meet</button></div>"
    );
</script>

</html>
