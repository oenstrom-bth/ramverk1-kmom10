<?php

namespace Oenstrom\Comment;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Oenstrom\Comment\HTMLForm\RegisterForm;
use \Oenstrom\Comment\HTMLForm\EditUserForm;

/**
 * A User controller class.
 */
class AdminController implements InjectionAwareInterface
{
    use InjectionAwareTrait;


    /**
     * Get all users.
     *
     * @return void
     */
    public function getUsers()
    {
        $title      = "Alla användare";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $user       = new User($this->di->get("db"));

        $data = [
            "users" => $user->findAll(),
        ];

        $view->add("user/admin/admin-links", $data);
        $view->add("user/admin/users-show", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Add a new user.
     */
    public function getPostNewUser()
    {
        $title       = "Skapa ny användare";
        $view        = $this->di->get("view");
        $pageRender  = $this->di->get("pageRender");
        $form        = new RegisterForm($this->di);

        $form->check();

        $data = [
            "form" => $form->getHTML(["use_buttonbar" => false]),
            "title" => $title,
        ];
        $view->add("user/admin/admin-links", $data);
        $view->add("user/admin/user-create", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Edit an user.
     *
     * @param integer $id the id of the user.
     */
    public function getPostEditUser($id)
    {
        $title       = "Redigera användare";
        $view        = $this->di->get("view");
        $pageRender  = $this->di->get("pageRender");
        $form        = new EditUserForm($this->di, $id);

        $form->check();

        $data = [
            "form" => $form->getHTML(["use_buttonbar" => false]),
            "title" => $title,
        ];
        $view->add("user/admin/admin-links", $data);
        $view->add("user/admin/user-edit", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Delete an user.
     *
     * @param integer $id the id of the user.
     */
    public function getDeleteUser($id)
    {
        $user = new User($this->di->get("db"));
        $user->find("id", $id);
        if ($user->role !== "admin") {
            $user->delete();
        }
        $this->di->get("response")->redirect("user/admin/users");
    }
}
