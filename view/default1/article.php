<?php
// namespace Anax\View;
//var_dump(get_defined_functions());
// echo showEnvironment(get_defined_vars());
// var_dump($frontmatter);
?>
<article class="md">
    <h1><?= $frontmatter["title"] ?></h1>
    <?= $content ?>
</article>
