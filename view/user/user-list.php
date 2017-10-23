<div class="users-grid">
    <?php foreach ($users as $user) : ?>
    <div class="card marg-bot-half">
        <a href="<?= $this->url("users/{$user->username}") ?>" class="card-link">
            <?= $user->getGravatar(true) ?>
            <strong><?= $user->username ?></strong>
        </a>
    </div>
    <?php endforeach; ?>
</div>
