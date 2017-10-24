<?php

namespace Oenstrom\Comment\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Oenstrom\Comment\User;

/**
 * Form to update an user.
 */
class EditUserForm extends FormModel
{
    /**
     * @var User $user the user being edited.
     */
    public $user;



    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di, $id)
    {
        parent::__construct($di);
        $this->user = $this->hasItemDetails($id);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Redigera användare",
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
                    "value" => $this->user->username,
                    "validation" => ["not_empty"],
                ],
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
     * @param integer $id get details on user with id.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function hasItemDetails($id)
    {
        $user = new User($this->di->get("db"));
        $user->find("id", $id);
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
        $username       = $this->form->value("username");
        $email          = $this->form->value("email");
        $password       = $this->form->value("new-password");
        $isOldEmail     = $this->user->email === $email;
        $isOldUsername  = $this->user->username === $username;

        $user = new User($this->di->get("db"));

        if (!$isOldUsername && $user->usernameExists($username) !== null) {
            $this->form->addOutput("The username does already exist.", "error");
            $this->di->get("response")->redirect("user/admin/users/update/{$this->user->id}");
            return false;
        }

        if (!$isOldEmail && $user->emailExists($email) !== null) {
            $this->form->addOutput("The email does already exist.", "error");
            $this->di->get("response")->redirect("user/admin/users/update/{$this->user->id}");
            return false;
        }

        if ($password != "") {
            $this->user->setPassword($password);
        }

        $this->user->username = $username;
        $this->user->email = $email;
        $this->user->save();
        $this->form->addOutput("The user has been updated.", "success");
        $this->di->get("response")->redirect("user/admin/users/update/{$this->user->id}");
    }
}
