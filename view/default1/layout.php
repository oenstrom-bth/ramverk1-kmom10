<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
    <?php foreach ($stylesheets as $stylesheet) : ?>
    <link rel="stylesheet" type="text/css" href="<?= $this->asset($stylesheet) ?>">
    <?php endforeach; ?>
    <title><?= $title ?> - Stack Underflow</title>
</head>
<body>

<div class="grid">
    <?php if ($this->regionHasContent("header")) : ?>
    <header class="site-header">
            <?php $this->renderRegion("header") ?>

        <?php if ($this->regionHasContent("navbar")) : ?>
        <nav id="navbar" class="navbar" ss-container>
            <?php $this->renderRegion("navbar") ?>

            <div class="extra-links">
                <?php if ($app->session->has("username")) : ?>
                <ul>
                    <li><a href="<?= $this->url("user/profile") ?>">
                        <?= getGravatar($app->session->get("email"), true, 32) ?>
                        <strong><?= $app->session->get("username") ?></strong>
                    </a></li>
                    <li><a href="<?= $this->url("user/logout") ?>">Sign out</a></li>
                </ul>
                <?php else : ?>
                <ul>
                    <li><a href="<?= $this->url("user/login") ?>">Sign in</a></li>
                    <li><a href="<?= $this->url("user/register") ?>">Sign up</a></li>
                </ul>
                <?php endif; ?>
            </div>

        </nav>
        <?php endif; ?>
    </header>
    <?php endif; ?>


    <?php if ($this->regionHasContent("main")) : ?>
    <main class="site-main">
        <?php $this->renderRegion("main") ?>
    </main>
    <?php endif; ?>

    <?php if ($this->regionHasContent("footer")) : ?>
    <footer class="site-footer">
        <?php $this->renderRegion("footer") ?>
    </footer>
    <?php endif; ?>
</div>
<div id="overlay" class="overlay"></div>
<!-- <div id="baseline-overlay" style="background-image: url(&quot;data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='1' height='30'><rect style='fill: rgb(196,196,196);'  width='1' height='0.25px' x='0' y='29'/></svg>&quot;); position: absolute; top: 54px; left: 0px; z-index: 9998; pointer-events: none; opacity: 1; width: 1325px; height: 8864px; display: block;"></div> -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<?php foreach ($javascripts as $javascript) : ?>
<script src="<?= $this->asset($javascript) ?>" defer></script>
<?php endforeach; ?>
</body>
</html>
