<?php

namespace Oenstrom\Comment\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Oenstrom\Comment\User;

/**
 * Form to update an user.
 */
class ProfileForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di)
    {
        parent::__construct($di);
        $username = $this->di->get("session")->get("username");
        $this->user = $this->hasItemDetails($username);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Update profile",
                "use_fieldset" => false,
                "wrapper-element" => "div",
                "br-after-label" => false,
            ],
            [
                "email" => [
                    "label" => "Email",
                    // "label-class" => "mdl-textfield__label",
                    "wrapper-class" => "input",
                    // "class" => "mdl-textfield__input",
                    "type" => "text",
                    "value" => $this->user->email,
                    "validation" => ["email", "not_empty"],
                ],

                "new-password" => [
                    "label" => "New password",
                    // "label-class" => "mdl-textfield__label",
                    "wrapper-class" => "input",
                    // "class" => "mdl-textfield__input",
                    "type" => "password",
                ],

                "new-password-again" => [
                    "label" => "Re-type new password",
                    // "label-class" => "mdl-textfield__label",
                    "wrapper-class" => "input",
                    // "class" => "mdl-textfield__input",
                    "type" => "password",
                    "validation" => ["match" => "new-password"],
                ],

                "submit" => [
                    "class" => "btn",
                    "type" => "submit",
                    "value" => "Update",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Get details on item to load form with.
     *
     * @param string $username get details on item with username.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function hasItemDetails($username)
    {
        $user = new User($this->di->get("db"));
        $user->find("username", $username);
        return $user;
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        $password   = $this->form->value("new-password");
        $email      = $this->form->value("email");
        $isOldEmail = $this->user->email === $email;

        $user = new User($this->di->get("db"));

        if (!$isOldEmail && $user->emailExists($email) !== null) {
            $this->form->addOutput("The email does already exist.", "error");
            $this->di->get("response")->redirect("user/profile");
            return false;
        }

        if ($password != "") {
            $this->user->setPassword($password);
        }

        if (empty($email)) {
            return false;
        }

        $this->user->email = $email;
        $this->user->save();
        $this->di->get("session")->set("email", $email);
        $this->form->addOutput("Your profile has been updated.", "success");
        $this->di->get("response")->redirect("user/profile");
    }
}
