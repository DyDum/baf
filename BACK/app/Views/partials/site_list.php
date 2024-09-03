<?php if (!empty($sites)) : ?>
    <ul class="list-group">
        <?php foreach ($sites as $site) : ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong><?= htmlspecialchars($site['name'], ENT_QUOTES, 'UTF-8') ?></strong><br>
                    <?= htmlspecialchars($site['address'], ENT_QUOTES, 'UTF-8') ?>
                </div>
                <div class="action-buttons">
                    <a href="#" class="btn btn-info btn-sm view-site-btn" data-site-id="<?= $site['id'] ?>">Voir plus</a>
                    <?php if ($_SESSION['role'] === 'admin') : ?>
                        <a href="#" class="btn btn-secondary btn-sm manage-owners-btn" data-site-id="<?= $site['id'] ?>">Changer Propriétaire</a>
                    <?php endif; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Aucun site trouvé.</p>
<?php endif; ?>