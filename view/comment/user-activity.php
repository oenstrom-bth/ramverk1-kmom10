<div class="card marg-bot-half clear">
    <figure class="figure left no-marg"><?= $user->getGravatar(true, 150) ?></figure>
    <p class="hug">
        <?= $user->username ?>
        <br>
        <?= $user->email ?>
    </p>
</div>

<div class="user-activity-grid">
    <div class="card marg-bot">
        <h2 class="hug marg-bot-half">Asked Questions</h2>
        <ul class="no-style">
        <?php foreach ($questions as $question) : ?>
            <li><a href="<?= $this->url("questions/{$question->id}") ?>"><?= $question->title ?></a></li>
        <?php endforeach; ?>
        </ul>
    </div>

    <div class="card marg-bot">
        <h2 class="hug marg-bot-half">Answered Questions</h2>
        <ul class="no-style">
        <?php foreach ($answered as $question) : ?>
            <li><a href="<?= $this->url("questions/{$question->id}") ?>"><?= $question->title ?></a></li>
        <?php endforeach; ?>
        </ul>
    </div>
</div>
