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
                "legend" => "Skapa konto",
                "use_fieldset" => false,
                "wrapper-element" => "div",
                "br-after-label" => false,
            ],
            [
                "username" => [
                    "label" => "Användarnamn",
                    "label-class" => "mdl-textfield__label",
                    "wrapper-class" => "mdl-textfield mdl-js-textfield mdl-textfield--floating-label",
                    "class" => "mdl-textfield__input",
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],

                "email" => [
                    "label" => "E-postadress",
                    "label-class" => "mdl-textfield__label",
                    "wrapper-class" => "mdl-textfield mdl-js-textfield mdl-textfield--floating-label",
                    "class" => "mdl-textfield__input",
                    "type" => "email",
                    "validation" => ["email", "not_empty"],
                ],

                "password" => [
                    "label" => "Lösenord",
                    "label-class" => "mdl-textfield__label",
                    "wrapper-class" => "mdl-textfield mdl-js-textfield mdl-textfield--floating-label",
                    "class" => "mdl-textfield__input",
                    "type" => "password",
                    "validation" => ["not_empty"],
                ],

                "password-again" => [
                    "label" => "Lösenord igen",
                    "label-class" => "mdl-textfield__label",
                    "wrapper-class" => "mdl-textfield mdl-js-textfield mdl-textfield--floating-label",
                    "class" => "mdl-textfield__input",
                    "type" => "password",
                    "validation" => ["match" => "password", "not_empty"],
                ],

                "submit" => [
                    "class" => "mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent",
                    "type" => "submit",
                    "value" => "Skapa konto",
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
            $this->form->addOutput("Användarnamnet är upptaget.", "error");
            return false;
        }

        if ($user->emailExists($email) !== null) {
            $this->form->addOutput("E-postadressen är upptagen.", "error");
            return false;
        }

        if (empty($username) || empty($email)) {
            $this->form->addOutput("Fyll i fälten.", "error");
            return false;
        }

        $user->role = "user";
        $user->username  = $this->form->value("username");
        $user->setPassword($this->form->value("password"));
        $user->email = $this->form->value("email");
        $user->save();
        $this->form->addOutput("Kontot har skapats.", "success");
        $this->di->get("response")->redirect($this->di->get("request")->getRoute());
    }
}
