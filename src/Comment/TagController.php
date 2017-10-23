<?php

namespace Oenstrom\Comment;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Oenstrom\User\User;
use \Oenstrom\Comment\HTMLForm\TagForm;
// use \Oenstrom\Comment\HTMLForm\EditCommentForm;

/**
 * A controller class.
 */
class TagController implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    public function getTags()
    {
        $title       = "Tags";
        $view        = $this->di->get("view");
        $pageRender  = $this->di->get("pageRender");
        $auth        = $this->di->get("authHelper");
        // $post        = new Post();
        //$user        = new User();
        // $user        = new User($this->di->get("db"));
        $tag         = $this->di->get("tag");

        // $post->setDb($this->di->get("db"));
        //$user->setDb($this->di->get("db"));
        //$comment->setTextfilter($this->di->get("textfilter"));
        // $questions = $post->getQuestions();
        // foreach ($questions as $question) {
        //     $question->tags = $tag->getTags($question->id);
        //     $question->user = $user->find("id", $question->userId);
        // }
        // $pag = $this->getPagination($questions);
        $tags = $tag->getTags();

        $view->add("comment/tag-list", [
            "tags" => $tags,
        ]);
        return $pageRender->renderPage(["title" => $title]);
    }

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
        $view->add("comment/tag-form", ["form" => $form->getHTML(["use_buttonbar" => false])]);
        return $pageRender->renderPage(["title" => $title]);
    }
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
        $view->add("comment/tag-form", ["form" => $form->getHTML(["use_buttonbar" => false])]);
        return $pageRender->renderPage(["title" => $title]);
    }
}
