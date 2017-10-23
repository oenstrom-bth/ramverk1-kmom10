<div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-desktop mdl-cell--2-offset-desktop mdl-shadow--2dp padd-10 center-text">
<?php if (!$isLoggedIn) : ?>
    <h3><a href="<?= $this->url("user/login") ?>">Logga in</a> för att kommentera</h3>
</div>
<?php return; ?>
<?php endif; ?>
    <h3>Lägg till ny kommentar</h3>
    <?= $form ?>
</div>
