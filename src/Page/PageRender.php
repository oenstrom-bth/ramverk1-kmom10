<?php

namespace Oenstrom\Page;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Page\PageRenderInterface;

/**
 * A default page rendering class.
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
class PageRender implements PageRenderInterface, InjectionAwareInterface
{
    use InjectionAwareTrait;



    /**
     * Render a standard web page using a specific layout.
     *
     * @param array   $data   variables to expose to layout view.
     * @param integer $status code to use when delivering the result.
     *
     * @return void
     */
    public function renderPage($data, $status = 200)
    {
        $data["stylesheets"] = ["css/style.min.css"];
        $data["javascripts"] = ["js/main.min.js"];//["js/material.min.js"];
        $navbar = $this->di->get("navbar")->getHTML();

        // Add layout, render it, add to response and send.
        $view = $this->di->get("view");
        $view->add("default1/header", [], "header");
        $view->add("default1/navbar", ["navbar" => $navbar], "navbar");
        $view->add("default1/footer", ["nav" => $navbar], "footer");
        $view->add("default1/layout", $data, "layout");
        $body = $view->renderBuffered("layout");
        $this->di->get("response")->setBody($body)
                                  ->send($status);
        exit;
    }
}
