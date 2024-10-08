<div class="container mt-5">
    <h2>Connexion</h2>
    <form action="<?= $base_url ?>login" method="POST">
        <input type="hidden" name="csrf_token" value="<?= $this->generateCSRFToken() ?>">
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
        <a href="<?= $base_url ?>register" class="btn btn-link">S'inscrire</a>
    </form>
</div>
