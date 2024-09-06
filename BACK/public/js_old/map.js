$(document).ready(function() {
    // Définir les coordonnées pour centrer la carte sur la France
    const franceCenter = [46.603354, 1.888334];

    // Définir les limites géographiques pour la France
    const bounds = [
        [41.333, -5.1406],
        [51.124, 9.6625]
    ];

    // Initialisation de la carte centrée sur la France avec les limites définies
    const map = L.map('map').setView(franceCenter, 6);  // Zoom initial

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        bounds: bounds,  // Définir les limites de la carte
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    map.setMaxBounds(bounds);  // Empêche l'utilisateur de sortir des limites de la France

    // Initialisation des points sur la carte
    const sites = JSON.parse(document.getElementById('map').dataset.sites);
    sites.forEach(site => {
        const marker = L.marker([site.latitude, site.longitude]).addTo(map);
        marker.bindPopup(`<b>${site.name}</b><br>${site.address}<br><a href="#" class="view-site-details" data-site-id="${site.id}">Voir plus</a>`);
    });
});