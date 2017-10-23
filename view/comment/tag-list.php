<?php
$isAdmin = $app->authHelper->isAdmin();
?>
<?php if ($isAdmin) : ?>
<a href="<?= $this->url("tags/create") ?>" class="btn marg-bot">Add new tag</a>
<?php endif; ?>
<div class="tags-grid">
    <?php foreach ($tags as $tag) : ?>
    <article class="md tags">
        <a href="<?= $this->url("questions/tagged/{$tag->tag}") ?>" class="tag big"><?= $tag->tag ?></a>
        <p class="tag-description"><?= $tag->description ?></p>
        <?php if ($isAdmin) : ?>
        <a href="<?= $this->url("tags/{$tag->tag}/edit") ?>" class="tag-edit"><i class="fa fa-edit"></i></a>
        <?php endif; ?>
    </article>
    <?php endforeach; ?>
</div>
