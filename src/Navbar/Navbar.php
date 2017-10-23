<?php

namespace Oenstrom\Navbar;

use \Anax\Common\AppInjectableInterface;
use \Anax\Common\ConfigureInterface;

/**
 * Class for creating the navbar.
 */
class Navbar implements AppInjectableInterface, ConfigureInterface
{
    use \Anax\Common\AppInjectableTrait;
    use \Anax\Common\ConfigureTrait;

    /**
     * @var string         $currentRoute the current route.
     */
    private $currentRoute;



    /**
     * Inject dependency to $url..
     *
     * @param array $url object representing Url.
     *
     * @return self
     */
    public function injectUrl($url)
    {
        $this->url = $url;
        return $this;
    }



    /**
     * Get the HTML class from the navbar config.
     *
     * @return string as HTML class.
     */
    public function getClass()
    {
        return $this->config["config"]["class"];
    }



    /**
     * Sets the current route.
     *
     * @param string $route the current route.
     *
     * @return void
     */
    public function setCurrentRoute($route)
    {
        $this->currentRoute = $route;
    }



    /**
     * Get HTML for the navbar.
     *
     * @param $items array The array to generate HTML from.
     *
     * @return string as HTML with the navbar.
     */
    public function getHtml($items = null)
    {
        $items = is_null($items) ? $this->config["items"] : $items;
        $html = "<ul>";
        foreach ($items as $item) {
            //$url = call_user_func($this->createUrl, $item["route"]);
            $url = $this->url->create($item["route"]);
            $active = $this->currentRoute === $item["route"] ? ' class="active"' : "";
            $html .= "<li$active>";
            $html .= "<a href='{$url}'>{$item["text"]}</a>";
            if (isset($item["items"])) {
                $html .= $this->getHtml($item["items"]);
            }
            $html .= "</li>";
        }
        $html .= "</ul>";
        return $html;
    }



    /**
     * Get HTML for the navbar.
     *
     * @param $items array The array to generate HTML from.
     *
     * @return string as HTML with the navbar.
     */
    public function getLinksOnly($items = null)
    {
        $items = is_null($items) ? $this->config["items"] : $items;
        $html = "<ul>";
        foreach ($items as $item) {
            //$url = call_user_func($this->createUrl, $item["route"]);
            $url = $this->url->create($item["route"]);
            $active = $this->currentRoute === $item["route"] ? ' class="active"' : "";
            $html .= "<li$active>";
            $html .= "<a href='{$url}'>{$item["text"]}</a>";
            if (isset($item["items"])) {
                $html .= $this->getHtml($item["items"]);
            }
            $html .= "</li>";
        }
        $html .= "</ul>";
        return $html;
    }



    /**
     * Create the navbar HTML markup.
     *
     * @return string as navbar in HTML.
     */
    public function createNavbar()
    {
        $class = $this->getClass();
        $html = "<nav class=\"{$class}\">";
        $html .= $this->getHtml();
        $html .= "</nav>";
        return $html;
    }
}
