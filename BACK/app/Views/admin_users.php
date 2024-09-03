<div class="container mt-5">
    <h2>Gestion des Utilisateurs</h2>
    <input type="text" id="searchUsersInput" class="form-control mb-4" placeholder="Rechercher des utilisateurs...">

    <div id="usersList">
        <!-- La liste des utilisateurs sera chargée ici via AJAX -->
    </div>
</div>
<script>
// Vérifier si l'utilisateur est un administrateur
const isAdmin = <?= json_encode($_SESSION['role'] === 'admin') ?>;
</script>
<script src="<?= $base_url ?>js/admin_users.js">
</script>