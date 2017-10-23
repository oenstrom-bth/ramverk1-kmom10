<?php

$title   = isset($title)   ? $title   : "Title not set";
$message = isset($message) ? $message : "Message not set";



?>
<article class="md center-text">
    <h1><?= $title ?></h1>

    <p><?= $message ?></p>
</article>
