<div class="container mt-5">
    <h2>Inscription</h2>
    <form action="<?= $base_url ?>register" method="POST">
        <input type="hidden" name="csrf_token" value="<?= $this->generateCSRFToken() ?>">
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirm">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
        </div>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
        <a href="<?= $base_url ?>login" class="btn btn-link">Se connecter</a>
    </form>
</div>
