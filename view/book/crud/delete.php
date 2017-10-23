<?php

namespace Anax\View;

/**
 * View to create a new book.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Create urls for navigation
$urlToViewItems = url("book");



?>
<div class="mdl-cell mdl-cell--12-col">
    <div class="mdl-card mdl-shadow--2dp margin-center">
        <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">Ta bort en bok</h2>
        </div>
        <div class="mdl-card__supporting-text">
            <?= $form ?>
            <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--accent marg-top-10" href="<?= $urlToViewItems ?>">
                <i class="material-icons">arrow_back</i>
                <span>Visa böcker</span>
            </a>
        </div>
    </div>
</div>
