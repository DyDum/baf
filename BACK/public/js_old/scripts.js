$(document).ready(function() {
    // Gestion de la soumission du formulaire via Ajax
    $('#addSiteForm').on('submit', function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du formulaire (rechargement de la page)

        $.ajax({
            url: '/add-site',  // Assurez-vous que l'URL est correcte
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                const res = JSON.parse(response);
                if (res.status === 'success') {
                    alert('Site ajouté avec succès');
                    location.reload();  // Recharger la page pour afficher le nouveau site
                } else {
                    alert('Erreur lors de l\'ajout');
                }
            },
            error: function() {
                alert('Une erreur est survenue lors de la soumission du formulaire.');
            }
        });
    });

     // Gestion du clic sur "Voir plus"
    $(document).on('click', '.view-site-details', function(e) {
        e.preventDefault();
        const siteId = $(this).data('site-id');

        $.ajax({
            url: `/site/details?id=${siteId}`,
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

    // Gestion de la soumission du formulaire de mise à jour via Ajax
    $(document).on('submit', '#updateSiteForm', function(e) {
        e.preventDefault();
        const siteId = $(this).data('site-id');

        $.ajax({
            url: `/site/update?id=${siteId}`,
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                const res = JSON.parse(response);
                if (res.status === 'success') {
                    alert('Site mis à jour avec succès');
                    $('#siteModal').modal('hide');
                    location.reload();
                } else {
                    alert('Erreur lors de la mise à jour');
                }
            },
            error: function() {
                alert('Une erreur est survenue lors de la mise à jour du site.');
            }
        });
    });

    // Ouvrir le modal pour éditer un site
    $(document).on('click', '.edit-site-btn', function(e) {
        e.preventDefault();
        const siteId = $(this).data('site-id');

        $.ajax({
            url: `/admin/site/edit?site_id=${siteId}`,
            type: 'GET',
            success: function(response) {
                $('#editSiteFormContent').html(response);
                $('#editSiteModal').modal('show');
            },
            error: function() {
                alert('Une erreur est survenue lors du chargement du formulaire.');
            }
        });
    });

    // Soumission du formulaire d'édition de site via AJAX
    $(document).on('submit', '#editSiteForm', function(e) {
        e.preventDefault();

        $.ajax({
            url: `/admin/site/edit?site_id=${$(this).data('site-id')}`,
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                const res = JSON.parse(response);
                if (res.status === 'success') {
                    alert('Site mis à jour avec succès');
                    $('#editSiteModal').modal('hide');
                    location.reload();
                } else {
                    alert('Erreur lors de la mise à jour');
                }
            },
            error: function() {
                alert('Une erreur est survenue lors de la mise à jour.');
            }
        });
    });

    // Ouvrir le modal pour gérer les propriétaires
    $(document).on('click', '.manage-owners-btn', function(e) {
        e.preventDefault();
        const siteId = $(this).data('site-id');

        $.ajax({
            url: `/admin/site/manage-owners?site_id=${siteId}`,
            type: 'GET',
            success: function(response) {
                $('#manageOwnersFormContent').html(response);
                $('#manageOwnersModal').modal('show');
            },
            error: function() {
                alert('Une erreur est survenue lors du chargement du formulaire.');
            }
        });
    });

    // Soumission du formulaire d'ajout de propriétaire via AJAX
    $(document).on('submit', '#addOwnerForm', function(e) {
        e.preventDefault();

        $.ajax({
            url: `/admin/site/add-owner?site_id=${$(this).data('site-id')}`,
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                const res = JSON.parse(response);
                if (res.status === 'success') {
                    alert('Propriétaire ajouté avec succès');
                    location.reload(); // Optionnel : Recharger la page ou juste le modal
                } else {
                    alert('Erreur lors de l\'ajout du propriétaire');
                }
            },
            error: function() {
                alert('Une erreur est survenue lors de l\'ajout du propriétaire.');
            }
        });
    });

    // Suppression d'un propriétaire via AJAX
    $(document).on('click', '.remove-owner-btn', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('href'),
            type: 'GET',
            success: function(response) {
                const res = JSON.parse(response);
                if (res.status === 'success') {
                    alert('Propriétaire supprimé avec succès');
                    location.reload(); // Optionnel : Recharger la page ou juste le modal
                } else {
                    alert('Erreur lors de la suppression du propriétaire');
                }
            },
            error: function() {
                alert('Une erreur est survenue lors de la suppression du propriétaire.');
            }
        });
    });
});
