<?php

namespace Oenstrom\Comment\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Oenstrom\Comment\Tag;

/**
 * Form to create and update a question.
 */
class TagForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di, $tag = false)
    {
        parent::__construct($di);
        $this->tag = $tag;
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Tag",
                "use_fieldset" => false,
                "wrapper-element" => "div",
                "br-after-label" => false,
            ],
            [
                "tag" => [
                    "label" => "Tag",
                    // "label-class" => "mdl-textfield__label",
                    "wrapper-class" => "input",
                    // "class" => "mdl-textfield__input",
                    "type" => "text",
                    "value" => $tag ? $tag->tag : "",
                    "validation" => ["not_empty"],
                ],
                "description" => [
                    "label" => "Description",
                    // "label-class" => "mdl-textfield__label",
                    "wrapper-class" => "input",
                    // "class" => "mdl-textfield__input",
                    "type" => "textarea",
                    "value" => $tag ? $tag->description : "",
                    "validation" => ["not_empty"],
                ],

                "submit" => [
                    "class" => "btn",
                    "type" => "submit",
                    "value" => "Save Tag",
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
        $tag = $this->tag ?: new Tag($this->di->get("db"));

        $tag->tag         = $this->form->value("tag");
        $tag->description = $this->form->value("description");
        $tag->save();

        $this->di->get("response")->redirect("tags");
    }
}
