<h3>Propriétaires du site</h3>
<ul>
    <?php foreach ($owners as $owner) : ?>
        <li><?= htmlspecialchars($owner['username']) ?>
            <a href="<?= $base_url ?>admin/site/remove-owner?site_id=<?= $siteId ?>&user_id=<?= $owner['id'] ?>" class="btn btn-danger btn-sm remove-owner-btn">Supprimer</a>
        </li>
    <?php endforeach; ?>
</ul>

<hr>

<h4>Ajouter un Propriétaire</h4>
<form id="addOwnerForm" data-site-id="<?= $siteId ?>" method="POST">
    <input type="hidden" name="csrf_token" value="<?= $this->generateCSRFToken() ?>">
    <div class="form-group">
        <label for="owner_username">Nom d'utilisateur du propriétaire</label>
        <input type="text" class="form-control" id="owner_username" name="owner_username" required>
    </div>
    <button type="submit" class="btn btn-success">Ajouter Propriétaire</button>
</form>
