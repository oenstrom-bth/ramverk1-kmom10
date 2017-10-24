<?php

namespace Oenstrom\Comment\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Oenstrom\Comment\Post;

/**
 * Form to create and update a question.
 */
class AnswerForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di, $questionId, $post = false)
    {
        parent::__construct($di);
        $this->questionId = $questionId;
        $this->post = $post;
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Answer",
                "use_fieldset" => false,
                "wrapper-element" => "div",
                "br-after-label" => false,
            ],
            [
                "content" => [
                    "label" => "Your Answer",
                    // "label-class" => "mdl-textfield__label",
                    "wrapper-class" => "input",
                    // "class" => "mdl-textfield__input",
                    "type" => "textarea",
                    "value" => $post ? $post->content : "",
                    "validation" => ["not_empty"],
                ],

                "submit" => [
                    "class" => "btn",
                    "type" => "submit",
                    "value" => "Submit Answer",
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
        $answer      = $this->post ?: new Post($this->di->get("db"));
        $user        = $this->di->get("authHelper")->getLoggedInUser();
        $question    = new Post($this->di->get("db"));

        $answer->userId  = $answer->userId ?: $user->id;
        $answer->type    = "answer";
        $answer->parent  = $this->questionId;
        $answer->title   = $question->find("id", $this->questionId)->title;
        $answer->content = $this->form->value("content");
        $answer->save();

        $this->di->get("response")->redirect("questions/{$this->questionId}");
    }
}
