<div class="mdl-cell mdl-cell--8-col mdl-shadow--2dp padd-10">
    <h2>Din profil</h2>
    <?= $gravatar ?>
    <?= $form ?>
</div>

<div class="mdl-cell mdl-cell--4-col mdl-shadow--2dp padd-10">
    <h2>Länkar</h2>
    <ul class="mdl-list">
        <li class="mdl-list__item">
            <a href="<?= $this->url("comments") ?>" class="mdl-list__item-primary-content">
                <i class="material-icons">comment</i>
                <span>Kommentarer</span>
            </a>
        </li>
        <li class="mdl-list__item">
            <a href="<?= $this->url("user/logout") ?>" class="mdl-list__item-primary-content">
                <i class="material-icons">exit_to_app</i>
                <span>Logga ut</span>
            </a>
        </li>
    </ul>
</div>
