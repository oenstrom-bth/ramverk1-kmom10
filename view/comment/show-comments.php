<?php if (empty($comments)) : ?>
<div class="mdl-cell mdl-cell--12-col center-text">
    <h2>Inga kommentarer hittades</h2>
</div>
<?php return; ?>
<?php endif; ?>

<?php foreach ($comments as $comment) : ?>
<div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
    <div class="mdl-card mdl-shadow--2dp full-width">
        <div class="mdl-card__supporting-text comment">
            <div class="comment-author">
                <?= getGravatar($comment->email, true, 128) ?>
                <span>Av: <?= $comment->username ?></span>
            </div>
            <div class="comment-content">
                <?= $comment->content ?>
            </div>
        </div>
        <?php if ($user && ($user->isAdmin() || $user->username === $comment->username)) : ?>
        <div class="mdl-card__menu">
            <a href="<?= $this->url("comments/edit/{$comment->id}") ?>" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                <i class="material-icons">edit</i>
            </a>
            <a href="<?= $this->url("comments/delete/{$comment->id}") ?>" onclick="return confirm('Är du säker?')" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                <i class="material-icons">delete</i>
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php endforeach; ?>
