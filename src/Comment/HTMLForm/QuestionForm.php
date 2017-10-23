<?php

namespace Oenstrom\Comment\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Oenstrom\Comment\Post;
use \Oenstrom\Comment\PostTag;
use \Oenstrom\Comment\Tag;

/**
 * Form to create and update a question.
 */
class QuestionForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di, $post = false)
    {
        parent::__construct($di);
        $this->post = $post;
        $tags = $this->di->get("tag")->getTagNames();
        if ($post) {
            $postTag = new PostTag($this->di->get("db"));
            $tag = $this->di->get("tag");
            $tagObjs = $tag->getPostTags($post->id);
            $checkedTags = array_map(function ($obj) {
                return $obj->tag;
            }, $tagObjs);
        }
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Question",
                "use_fieldset" => false,
                "wrapper-element" => "div",
                "br-after-label" => false,
            ],
            [
                "title" => [
                    "label" => "Title",
                    "label-class" => "mdl-textfield__label",
                    "wrapper-class" => "mdl-textfield mdl-js-textfield",
                    "class" => "mdl-textfield__input",
                    "type" => "text",
                    "value" => $post ? $post->title : "",
                    "validation" => ["not_empty"],
                ],

                "content" => [
                    "label" => "Question",
                    "label-class" => "mdl-textfield__label",
                    "wrapper-class" => "mdl-textfield mdl-js-textfield",
                    "class" => "mdl-textfield__input",
                    "type" => "textarea",
                    "value" => $post ? $post->content : "",
                    "validation" => ["not_empty"],
                ],

                "tags" => [
                    "type"        => "checkbox-multiple",
                    "values"      => $tags,
                    "checked"     => $post ? $checkedTags : [],
                ],

                "submit" => [
                    "class" => "btn",
                    "type" => "submit",
                    "value" => "Submit Question",
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
        $question    = $this->post ?: new Post($this->di->get("db"));
        $postTag     = new PostTag($this->di->get("db"));
        $user        = $this->di->get("authHelper")->getLoggedInUser();
        $tag         = $this->di->get("tag");

        $question->userId = $question->userId ?: $user->id;
        $question->type = "question";
        $question->title = $this->form->value("title");
        $question->content = $this->form->value("content");
        $question->save();

        $postTag->clear($question->id, $this->di->get("db"));
        foreach ($this->form->value("tags") as $tagName) {
            $tag->find("tag", $tagName);
            $postTag->postId = $question->id;
            $postTag->tagId = $tag->id;
            $postTag->save();
            unset($postTag->id);
        }

        $this->di->get("response")->redirect("questions/{$question->id}");
    }
}
