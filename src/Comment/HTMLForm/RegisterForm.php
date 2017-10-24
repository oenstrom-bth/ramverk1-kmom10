<?php

namespace Oenstrom\Comment\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Oenstrom\Comment\User;

/**
 * Form to create an item.
 */
class RegisterForm extends FormModel
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
                "legend" => "Sign up",
                "use_fieldset" => false,
                "wrapper-element" => "div",
                "br-after-label" => false,
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

                "email" => [
                    "label" => "Email",
                    // "label-class" => "mdl-textfield__label",
                    "wrapper-class" => "input",
                    // "class" => "mdl-textfield__input",
                    "type" => "email",
                    "validation" => ["email", "not_empty"],
                ],

                "password" => [
                    "label" => "Password",
                    // "label-class" => "mdl-textfield__label",
                    "wrapper-class" => "input",
                    // "class" => "mdl-textfield__input",
                    "type" => "password",
                    "validation" => ["not_empty"],
                ],

                "password-again" => [
                    "label" => "Re-type password",
                    // "label-class" => "mdl-textfield__label",
                    "wrapper-class" => "input",
                    // "class" => "mdl-textfield__input",
                    "type" => "password",
                    "validation" => ["match" => "password", "not_empty"],
                ],

                "submit" => [
                    "class" => "btn",
                    "type" => "submit",
                    "value" => "Sign Up",
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
        $username = $this->form->value("username");
        $email    = $this->form->value("email");

        $user = new User($this->di->get("db"));

        if ($user->usernameExists($username) !== null) {
            $this->form->addOutput("The username does already exist.", "error");
            return false;
        }

        if ($user->emailExists($email) !== null) {
            $this->form->addOutput("The email does already exist.", "error");
            return false;
        }

        if (empty($username) || empty($email)) {
            $this->form->addOutput("Fill in the fields.", "error");
            return false;
        }

        $user->role = "user";
        $user->username  = $this->form->value("username");
        $user->setPassword($this->form->value("password"));
        $user->email = $this->form->value("email");
        $user->save();
        $this->form->addOutput("The account has been created.", "success");
        $this->di->get("response")->redirect($this->di->get("request")->getRoute());
    }
}
