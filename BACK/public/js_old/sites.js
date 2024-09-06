$(document).ready(function() {
    // Charger la liste des sites avec la colonne Administration uniquement pour les administrateurs
    function searchSites(query) {
        $.ajax({
            url: '/sites/search?q=' + encodeURIComponent(query),
            type: 'GET',
            success: function(response) {
                const res = JSON.parse(response);
                if (res.status === 'success') {
                    $('#sitesList').html(res.html);
                    if (isAdmin) {
                        $('.admin-actions').show();
                    } else {
                        $('.admin-actions').hide();
                    }
                } else {
                    alert('Erreur lors de la recherche des sites.');
                }
            },
            error: function() {
                alert('Une erreur est survenue lors de la recherche des sites.');
            }
        });
    }

    // Gestion du clic sur "Voir plus"
    $(document).on('click', '.view-site-btn', function(e) {
        e.preventDefault();
        const siteId = $(this).data('site-id');

        $.ajax({
            url: `/site/details?site_id=${siteId}`,
            type: 'GET',
            success: function(response) {
                $('#siteDetailsContent').html(response);
                $('#siteModal').modal('show');
            },
            error: function() {
                alert('Une erreur est survenue lors de la récupération des détails du site.');
            }
        });
    });

    // Initialiser la recherche des sites
    searchSites('');
    $('#searchSitesInput').on('input', function() {
        searchSites($(this).val());
    });
    });