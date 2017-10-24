<?php

namespace Oenstrom\Comment\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Oenstrom\Comment\User;

/**
 * Form to create an item.
 */
class LoginForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Sign in",
            ],
            [
                "username" => [
                    "label" => "Username",
                    // "label-class" => "mdl-textfield__label",
                    "wrapper-class" => "input",
                    // "class" => "mdl-textfield__input",
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],

                "password" => [
                    "label" => "Password",
                    // "label-class" => "mdl-textfield__label",
                    "wrapper-class" => "input",
                    // "class" => "mdl-textfield__input",
                    "type" => "password",
                    "validation" => ["not_empty"],
                ],

                "submit" => [
                    "class" => "btn",
                    "type" => "submit",
                    "value" => "Sign In",
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
        $user = new User($this->di->get("db"));

        $username  = $this->form->value("username");
        $password = $this->form->value("password");

        if (!$user->verifyPassword($username, $password)) {
            $this->form->addOutput("Invalid credentials.", "error");
            return false;
        }
        $session = $this->di->get("session");
        $session->set("username", $user->username);
        $session->set("email", $user->email);
        $this->di->get("response")->redirect("user/profile");
    }
}
