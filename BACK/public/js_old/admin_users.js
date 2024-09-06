if (isAdmin) {
    // Fonction pour rechercher des utilisateurs
    function searchUsers(query) {
        $.ajax({
            url: '/admin/users/search?q=' + encodeURIComponent(query),
            type: 'GET',
            success: function(response) {
                const res = JSON.parse(response);
                if (res.status === 'success') {
                    $('#usersList').html(res.html);
                } else {
                    alert('Erreur lors de la recherche des utilisateurs.');
                }
            },
            error: function() {
                alert('Une erreur est survenue lors de la recherche des utilisateurs.');
            }
        });
    }

    // Lancer une recherche lorsque l'utilisateur tape dans la barre de recherche
    $('#searchUsersInput').on('input', function() {
        const query = $(this).val();
        searchUsers(query);
    });

    // Auto-complétion pour le champ d'ajout de propriétaire
    $('#owner_username').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: '/admin/users/autocomplete',
                data: { q: request.term },
                success: function(data) {
                    response(JSON.parse(data));
                }
            });
        },
        minLength: 2
    });
    
    // Lancer une recherche initiale pour afficher tous les utilisateurs au chargement
    searchUsers('');
}