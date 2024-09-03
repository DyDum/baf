<?php if (!empty($users)) : ?>
    <ul class="list-group">
        <?php foreach ($users as $user) : ?>
            <li class="list-group-item">
                <strong><?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?></strong><br>
                <?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?><br>
                <a href="#" class="btn btn-primary btn-sm edit-user-btn" data-user-id="<?= $user['id'] ?>">Modifier</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Aucun utilisateur trouvé.</p>
<?php endif; ?>