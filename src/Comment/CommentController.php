<?php

namespace Oenstrom\Comment;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Oenstrom\Comment\HTMLForm\CommentForm;

/**
 * A controller class.
 */
class CommentController implements
    ConfigureInterface,
    InjectionAwareInterface
{
    use ConfigureTrait, InjectionAwareTrait;



    /**
     * Create a comment.
     *
     * @param Integer $postId the id of the post.
     *
     */
    public function getPostCreateComment($postId)
    {
        $title      = "Post Comment";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $user       = $this->di->get("authHelper")->getLoggedInUser();
        $post       = new Post($this->di->get("db"));

        if (!$user) {
            $this->di->get("response")->redirect("user/login");
        }

        $form = new CommentForm($this->di, $postId);
        $form->check();
        $view->add("comment/comment-form", [
            "form" => $form->getHTML(["use_buttonbar" => false]),
            "postContent" => $post->find("id", $postId)->content,
        ]);
        return $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Edit a commet.
     *
     * @param Integer $postId the id of the post
     * @param Integer $commentId the id of the comment
     *
     */
    public function getPostEditComment($postId, $commentId)
    {
        $title      = "Post Comment";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $user       = $this->di->get("authHelper")->getLoggedInUser();
        $post       = new Post($this->di->get("db"));
        $comment    = new Comment($this->di->get("db"));
        $comment->find("id", $commentId);

        if ($comment->userId !== $user->id && $user->role !== "admin") {
            $post->find("id", $postId);
            $redirectId = $post->parent ?: $post->id;
            $this->di->get("response")->redirect("questions/{$redirectId}");
        }

        $form = new CommentForm($this->di, $postId, $comment);
        $form->check();
        $view->add("comment/comment-form", [
            "form" => $form->getHTML(["use_buttonbar" => false]),
            "postContent" => $post->find("id", $postId)->getContentAsMarkdown(),
        ]);
        return $pageRender->renderPage(["title" => $title]);
    }
}
