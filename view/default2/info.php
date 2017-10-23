<?php
$router = $di->get("router");

$services       = $di->getServices();
$activeServices = $di->getActiveServices();



?>
<div class="mdl-cell mdl-cell--12-col mdl-cell--10-col-desktop mdl-cell--1-offset-desktop">
<h1>Anax info</h1>

<h2>Routes loaded</h2>

<p>The following routes are loaded:</p>
<div class="responsive-table-wrapper">
    <div class="responsive-table">
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
            <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">Path</th>
                    <th class="mdl-data-table__cell--non-numeric">Method</th>
                    <th class="mdl-data-table__cell--non-numeric">Description</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($router->getAll() as $route) : ?>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric"><code>"<?= $route->getRule() ?>"</code></td>
                    <td class="mdl-data-table__cell--non-numeric"><code><?= $route->getRequestMethod() ?></code></td>
                    <td class="mdl-data-table__cell--non-numeric"><?= $route->getInfo() ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<p>The following internal routes are loaded:</p>
<ul>
<?php foreach ($router->getInternal() as $route) : ?>
    <li><?= $route->getRule() ?></li>
<?php endforeach; ?>
</ul>



<h2>DI and services</h2>

<p>These services are loaded into DI and bold are currently activated.</p>
<ul>
<?php foreach ($services as $service) :
    $active = in_array($service, $activeServices); ?>
    <li><?= $active ? "<b>" : null ?><?= $service ?><?= $active ? "</b>" : null ?></li>
<?php endforeach; ?>
</ul>

</div>
