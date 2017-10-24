<?php

namespace Oenstrom\Comment;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Oenstrom\User\User;
use \Oenstrom\Comment\HTMLForm\TagForm;

/**
 * A controller class.
 */
class TagController implements InjectionAwareInterface
{
    use InjectionAwareTrait;



    /**
     * Get all tags
     */
    public function getTags()
    {
        $title       = "Tags";
        $view        = $this->di->get("view");
        $pageRender  = $this->di->get("pageRender");
        $tag         = $this->di->get("tag");

        $tags = $tag->getTags();
        $view->add("comment/tag-list", [
            "tags" => $tags,
        ]);
        return $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Create a new tag.
     */
    public function getPostCreateTag()
    {
        $title       = "Create tag";
        $view        = $this->di->get("view");
        $pageRender  = $this->di->get("pageRender");
        $isAdmin     = $this->di->get("authHelper")->isAdmin();

        if (!$isAdmin) {
            $this->di->get("response")->redirect("tags");
        }

        $form = new TagForm($this->di);
        $form->check();
        $view->add("comment/tag-form", ["form" => $form->getHTML(["use_buttonbar" => false]), "title" => $title]);
        return $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Edit a tag.
     *
     * @param String $tagName the tag to edit
     *
     */
    public function getPostEditTag($tagName)
    {
        $title       = "Edit tag";
        $view        = $this->di->get("view");
        $pageRender  = $this->di->get("pageRender");
        $isAdmin     = $this->di->get("authHelper")->isAdmin();
        $tag         = new Tag($this->di->get("db"));
        $tag->find("tag", $tagName);

        if (!$isAdmin) {
            $this->di->get("response")->redirect("tags");
        }

        $form = new TagForm($this->di, $tag);
        $form->check();
        $view->add("comment/tag-form", ["form" => $form->getHTML(["use_buttonbar" => false]), "title" => $title]);
        return $pageRender->renderPage(["title" => $title]);
    }
}
