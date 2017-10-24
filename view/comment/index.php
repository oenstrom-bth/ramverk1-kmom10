<!-- <div class="card index-card"> -->
    <h2 class="hug inline-block va-middle marg-bot marg-right-half">
        <a href="<?= $this->url("questions") ?>" class="no-style">Latest questions</a>
    </h2>
        <a href="#" class="btn no-marg marg-bot va-middle">Ask Question</a>
<!-- </div> -->
<div class="grid">
    <?= $this->renderView("comment/question-list", ["questions" => $questions, "pag" => $pag, "noButton" => true]) ?>
</div>

<div class="index-grid">
    <h2 class="hug marg-bot"><a href="<?= $this->url("users") ?>" class="no-style">Most active users</a></h2>
    <div class="marg-bot-half">
        <div class="card">
            <div class="grid half large">
                <?php foreach ($mostActive as $user) : ?>
                <div class="marg-bot clear">
                    <a href="<?= $this->url("users/{$user->username}") ?>" class="card-link">
                        <figure class="figure left no-marg"><?= $user->getGravatar(true, 60) ?></figure>
                        <p class="hug"><?= $user->username ?></p>
                        <h4 class="hug">Activity: <?= $user->activity ?></h4>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <h2 class="hug marg-bot"><a href="<?= $this->url("tags") ?>" class="no-style">Most popular tags</a></h2>
    <div class="marg-bot-half">
        <div class="card">
            <div class="grid tags">
                <?php foreach ($popularTags as $tag) : ?>
                <div class="marg-bot clear">
                    <a href="<?= $this->url("questions/tagged/{$tag->tag}") ?>" class="tag big">
                        <strong><?= $tag->tag ?></strong> &nbsp; x <?= $tag->count ?>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
