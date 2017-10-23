<div class="col-12">
    <?php if (empty($comments)) : ?>
    <h1 class="text-center">Inga kommentarer hittades</h1>
    <?php endif; ?>

    <?php foreach ($comments as $key => $value) : ?>
    <div class="comment">
        <figure class="figure left">
            <img src="<?= $value["gravatar"] ?>" alt="Gravatar for <?= htmlentities($value["email"]) ?>">
        </figure>
        <!-- <?= htmlentities($value["email"]) ?> -->
        <?= $value["text"] ?>
        <div class="clear">
            <a class="button right" href="<?= $this->url("comments/edit/$key") ?>">Ändra</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
