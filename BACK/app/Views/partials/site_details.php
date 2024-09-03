<div>
<?php if ($canEdit): ?>
        <form id="updateSiteForm" data-site-id="<?= $site['id'] ?>" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $this->generateCSRFToken() ?>">
            <div class="form-group">
                <label for="name">Nom du site</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($site['name'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Adresse</label>
                <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($site['address'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="text" class="form-control" id="latitude" name="latitude" value="<?= htmlspecialchars($site['latitude'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="text" class="form-control" id="longitude" name="longitude" value="<?= htmlspecialchars($site['longitude'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <div class="form-group">
                <label for="url">Lien Web</label>
                <input type="text" class="form-control" id="url" name="url" value="<?= htmlspecialchars($site['url']) ?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="5"><?= htmlspecialchars($site['description'], ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    <?php else: ?>
    <p><strong>Nom du site :</strong> <?= htmlspecialchars($site['name'], ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Adresse :</strong> <?= htmlspecialchars($site['address'], ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Latitude :</strong> <?= htmlspecialchars($site['latitude'], ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Longitude :</strong> <?= htmlspecialchars($site['longitude'], ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Lien Web :</strong> <a href="<?= htmlspecialchars($site['url']) ?>" target="_blank"><?= htmlspecialchars($site['url']) ?></a></p>
    <p><strong>Description :</strong></p>
    <p><?= nl2br(htmlspecialchars($site['description'], ENT_QUOTES, 'UTF-8')) ?></p>

    <?php endif; ?>
</div>
