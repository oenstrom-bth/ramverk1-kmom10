<h1>Your Questions</h1>
<?php foreach ($questions as $question) : ?>
<a href="<?= $this->url("questions/{$question->id}") ?>"><?= $question->title ?></a>
<br>
<?php endforeach; ?>

<h1>Answered Questions</h1>
<?php foreach ($answered as $question) : ?>
<a href="<?= $this->url("questions/{$question->id}") ?>"><?= $question->title ?></a>
<br>
<?php endforeach; ?>
