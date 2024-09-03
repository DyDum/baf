<div class="container mt-5">
    <h2>Liste des Sites</h2>
    <input type="text" id="searchSitesInput" class="form-control mb-4" placeholder="Rechercher des sites...">

    <div id="sitesList">
        <!-- Les résultats de la recherche seront chargés ici via AJAX -->
    </div>
</div>
<script>
    // Vérifier le rôle de l'utilisateur dans le script
    const isAdmin = <?= json_encode($_SESSION['role'] === 'admin') ?>;
</script>
<script src="<?= $base_url ?>js/sites.js"></script>