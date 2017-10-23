<?php
    $loggedIn = $app->authHelper->isLoggedIn();
    $firstDisabled = $pag["page"] === 1 ? ' class="disabled"' : "";
    $lastDisabled = $pag["page"] === $pag["last"] ? ' class="disabled"' : "";
    $dotsBefore = $pag["page"] - 2 >= 1 ? '<li class="disabled"><a href="#">...</a></li>' : "";
    $dotsAfter = $pag["page"] + 2 <= $pag["last"] ? '<li class="disabled"><a href="#">...</a></li>' : "";

?>
<!-- <h2 class="hug">Newest questions</h2> -->
<?php if ($loggedIn) : ?>
<a href="<?= $this->url("questions/ask") ?>" class="btn no-marg">Ask Question</a>
<?php endif; ?>
<div class="questions">
<?php if (empty($questions)) : ?>
    <div class="card">
        <h3 class="hug center-text">This tag does not have any questions yet.</h3>
    </div>
</div>
<?php return; ?>
<?php endif; ?>

    <?php foreach ($questions as $question) : ?>
    <!-- <?= $question->user->id ?> -->
    <section class="question">
        <h1 class="hug"><a href="<?= $this->url("questions/" . $question->id) ?>"><?= $question->title ?></a></h1>

        <div class="content">
            <p><?= strip_tags($question->getContentAsMarkdown()) ?></p>
        </div>

        <footer>
            <?php foreach ($question->tags as $tag) : ?>
            <a href="<?= $this->url("questions/tagged/{$tag->tag}") ?>" class="tag"><?= $tag->tag ?></a>
            <?php endforeach; ?>
            <h4 class="hug">Asked at <strong><?= $question->created ?></strong></h4>
            <p class="hug"><?= $question->user->getGravatar(true, 90) ?> <?= $question->user->username ?></p>
        </footer>
    </section>
    <?php endforeach; ?>
</div>

<?php
if ($pag["end"] <= 0) {
    return;
}
?>

<nav class="pagination">
    <ul>
        <li<?= $firstDisabled ?>><a href="<?= "?l={$pag["length"]}&p=1" ?>"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li>
        <?= $dotsBefore ?>

        <?php foreach (range($pag["start"], $pag["end"]) as $index) : ?>
        <li<?= $pag["page"] === $index ? ' class="active"' : "" ?>><a href="<?= "?l={$pag["length"]}&p={$index}" ?>"><?= $index ?></a></li>
        <?php endforeach; ?>

        <?= $dotsAfter ?>
        <li<?= $lastDisabled ?>><a href="<?= "?l={$pag["length"]}&p={$pag["last"]}" ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
    </ul>
</nav>
