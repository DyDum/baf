<form id="editSiteForm" data-site-id="<?= $site['id'] ?>" method="POST">
    <input type="hidden" name="csrf_token" value="<?= $this->generateCSRFToken() ?>">
    <div class="form-group">
        <label for="name">Nom du site</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($site['name']) ?>" required>
    </div>
    <div class="form-group">
        <label for="address">Adresse</label>
        <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($site['address']) ?>" required>
    </div>
    <div class="form-group">
        <label for="latitude">Latitude</label>
        <input type="text" class="form-control" id="latitude" name="latitude" value="<?= htmlspecialchars($site['latitude']) ?>" required>
    </div>
    <div class="form-group">
        <label for="longitude">Longitude</label>
        <input type="text" class="form-control" id="longitude" name="longitude" value="<?= htmlspecialchars($site['longitude']) ?>" required>
    </div>
    <div class="form-group">
        <label for="url">Lien Web</label>
        <input type="text" class="form-control" id="url" name="url" value="<?= htmlspecialchars($site['url']) ?>">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="5"><?= htmlspecialchars($site['description']) ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
</form>