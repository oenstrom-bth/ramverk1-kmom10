<?php

namespace Oenstrom\Comment\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Oenstrom\Comment\Post;
use \Oenstrom\Comment\Comment;

/**
 * Form to create and update a question.
 */
class CommentForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di, $postId, $comment = false)
    {
        parent::__construct($di);
        $this->post = new Post($this->di->get("db"));
        $this->post->find("id", $postId);
        $this->comment = $comment;
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Comment",
                "use_fieldset" => false,
                "wrapper-element" => "div",
                "br-after-label" => false,
            ],
            [
                "content" => [
                    "label" => "Your Comment",
                    "label-class" => "mdl-textfield__label",
                    "wrapper-class" => "mdl-textfield mdl-js-textfield",
                    "class" => "mdl-textfield__input",
                    "type" => "textarea",
                    "value" => $comment ? $comment->content : "",
                    "validation" => ["not_empty"],
                ],

                "submit" => [
                    "class" => "btn",
                    "type" => "submit",
                    "value" => "Submit Comment",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        $comment      = $this->comment ?: new Comment($this->di->get("db"));
        $user        = $this->di->get("authHelper")->getLoggedInUser();

        $comment->userId  = $comment->userId ?: $user->id;
        $comment->postId  = $this->post->id;
        $comment->content = $this->form->value("content");
        $comment->save();

        $redirectId = $this->post->parent ?: $this->post->id;
        $this->di->get("response")->redirect("questions/{$redirectId}");
    }
}
