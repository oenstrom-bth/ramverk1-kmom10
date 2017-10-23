<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToCreate = url("book/create");
$urlToDelete = url("book/delete");


?>
<div class="mdl-cell mdl-cell--12-col">
    <h1>Visa alla böcker</h1>

    <p>
        <a href="<?= $urlToCreate ?>">Skapa</a> |
        <a href="<?= $urlToDelete ?>">Ta bort</a>
    </p>

    <?php if (!$items) : ?>
        <p>Det finns inga böcker att visa.</p>
    <?php return; ?>
    <?php endif; ?>

    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
        <thead>
            <tr>
                <th class="mdl-data-table__cell--non-numeric">Id</th>
                <th class="mdl-data-table__cell--non-numeric">Titel</th>
                <th class="mdl-data-table__cell--non-numeric">Författare</th>
                <th class="mdl-data-table__cell--non-numeric">ISBN</th>
                <th class="mdl-data-table__cell--non-numeric">Länk</th>
            </tr>
        </thead>
        <?php foreach ($items as $item) : ?>
        <tbody>
            <tr>
                <td>
                    <a href="<?= url("book/update/{$item->id}"); ?>"><?= $item->id ?></a>
                </td>
                <td class="mdl-data-table__cell--non-numeric"><?= $item->title ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?= $item->author ?></td>
                <td><?= $item->isbn ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?= $app->textfilter->parse($item->link, ["clickable"])->text ?></td>
            </tr>
        </tbody>
        <?php endforeach; ?>
    </table>
</div>
