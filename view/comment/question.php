<?php
$loggedIn = $app->authHelper->isLoggedIn();
?>
<article class="question">
    <h1 class="hug"><?= $question->title ?></h1>

    <div class="content">
        <?= $question->getContentAsMarkdown() ?>
    </div>

    <footer>
        <?php foreach ($question->tags as $tag) : ?>
        <a href="<?= $this->url("questions/tagged/{$tag->tag}") ?>" class="tag"><?= $tag->tag ?></a>
        <?php endforeach; ?>
        <h4 class="hug">asked <?= $question->created ?></h4>
        <p class="hug"><a href="<?= $this->url("users/{$question->user->username}") ?>" class="card-link">
            <?= $question->user->getGravatar(true, 90) ?>
            <?= $question->user->username ?>
        </a></p>
        <p class="hug"><a href="<?= $this->url("questions/edit/{$question->id}") ?>">Edit</a>
    </footer>

    <?php if (!empty($question->comments)) : ?>
    <section class="comments">
        <?php foreach ($question->comments as $comment) : ?>
        <article class="comment">
            <p>
                <?= $comment->getContent() ?> –
                <a href="<?= $this->url("users/{$comment->username}") ?>"><?= $comment->username ?></a>
                <a href="<?= $this->url("questions/comments/{$question->id}/comment/edit/{$comment->id}") ?>"><i class="fa fa-pencil va-middle"></i></a>
            </p>
        </article>
        <?php endforeach; ?>
    </section>
    <?php endif; ?>

    <?php if ($loggedIn) : ?>
    <a href="<?= $this->url("questions/comments/{$question->id}/comment") ?>" class="btn comment">Add comment</a>
    <?php endif; ?>

</article>

<?php if (!empty($answers)) : ?>
<?php foreach ($answers as $answer) : ?>
<article class="answer">
    <div class="content answer">
        <?= $answer->getContentAsMarkdown() ?>
    </div>

    <footer>
        <h4 class="hug">answered <?= $answer->created ?></h4>
        <p class="hug"><a href="<?= $this->url("users/{$answer->user->username}") ?>" class="card-link">
            <?= $answer->user->getGravatar(true, 90) ?>
            <?= $answer->user->username ?>
        </a></p>
        <p class="hug"><a href="<?= $this->url("questions/{$question->id}/answer/edit/{$answer->id}") ?>">Edit</a>
    </footer>

    <?php if (!empty($answer->comments)) : ?>
    <section class="comments">
        <?php foreach ($answer->comments as $comment) : ?>
        <article class="comment">
            <p>
                <?= $comment->getContent() ?> –
                <a href="<?= $this->url("users/{$comment->username}") ?>"><?= $comment->username ?></a>
                <a href="<?= $this->url("questions/comments/{$answer->id}/comment/edit/{$comment->id}") ?>"><i class="fa fa-pencil va-middle"></i></a>
            </p>
        </article>
        <?php endforeach; ?>
    </section>
    <?php endif; ?>

    <?php if ($loggedIn) : ?>
    <a href="<?= $this->url("questions/comments/{$answer->id}/comment") ?>" class="btn comment">Add comment</a>
    <?php endif; ?>
</article>
<?php endforeach; ?>
<?php endif; ?>

<div class="marg-top center-text">
<?php if ($loggedIn) : ?>
    <a href="<?= $this->url("questions/{$question->id}/answer") ?>" class="btn big">Answer this question</a>
<?php else : ?>
    <a href="<?= $this->url("user/login") ?>" class="btn big">Sign in</a>
<?php endif; ?>
</div>
