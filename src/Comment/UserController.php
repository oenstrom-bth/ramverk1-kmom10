<?php

namespace Oenstrom\Comment;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Oenstrom\Comment\HTMLForm\LoginForm;
use \Oenstrom\Comment\HTMLForm\RegisterForm;
use \Oenstrom\Comment\HTMLForm\ProfileForm;

// use \Anax\Book\HTMLForm\UpdateForm;
/**
 * A User controller class.
 */
class UserController implements InjectionAwareInterface
{
    use InjectionAwareTrait;



    /**
     * @var $data description
     */
    //private $data;



    /**
     * Handler with form to register an user.
     *
     * @return void
     */
    public function getPostRegister()
    {
        $title       = "Sign up";
        $view        = $this->di->get("view");
        $pageRender  = $this->di->get("pageRender");
        $form        = new RegisterForm($this->di);

        $form->check();

        $data = [
            "form" => $form->getHTML(["use_buttonbar" => false]),
            "title" => $title,
        ];
        $view->add("user/user-register", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Handler with form to login an user.
     *
     * @return void
     */
    public function getPostLogin()
    {
        $title       = "Sign in";
        $view        = $this->di->get("view");
        $pageRender  = $this->di->get("pageRender");
        $form        = new LoginForm($this->di);

        $form->check();

        $data = [
            "form" => $form->getHTML(["use_fieldset" => false, "use_buttonbar" => false]),
        ];
        $view->add("user/user-login", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Handler to logout an user.
     *
     * @return void
     */
    public function getLogout()
    {
        $session = $this->di->get("session");
        $session->destroy();
        $this->di->get("response")->redirect("");
    }



    /**
     * Get all users.
     */
    public function getUsers()
    {
        $title       = "Users";
        $view        = $this->di->get("view");
        $pageRender  = $this->di->get("pageRender");
        $user        = new User($this->di->get("db"));

        $view->add("user/user-list", ["users" => $user->findAll()]);
        return $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Handler with form to update an user profile.
     *
     * @return void
     */
    public function getPostProfile()
    {
        $title       = "Your profile";
        $view        = $this->di->get("view");
        $pageRender  = $this->di->get("pageRender");
        $auth        = $this->di->get("authHelper");
        $form        = new ProfileForm($this->di);

        $form->check();


        $data = [
            "form" => $form->getHTML(["use_buttonbar" => false]),
            "gravatar" => $this->getGravatar($this->di->get("session")->get("email"), true, 256)
        ];

        if ($auth->isAdmin()) {
            $view->add("user/admin/admin-links", []);
        }
        $view->add("user/profile", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    public function getUserActivity($username)
    {
        $title       = "{$username}'s Activity";
        $view        = $this->di->get("view");
        $pageRender  = $this->di->get("pageRender");
        $auth        = $this->di->get("authHelper");
        $post        = new Post($this->di->get("db"));
        $user        = new User($this->di->get("db"));
        $tag         = $this->di->get("tag");
        $user->find("username", $username);

        $questions = $post->getQuestions("type = ? AND userId = ?", ["question", $user->id]);
        $answered = $post->getQuestions("type = ? AND userId = ?", ["answer", $user->id]);

        $view->add("comment/user-activity", [
            "questions" => $questions,
            "answered" => $answered,
        ]);
        return $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param boole $img True to return a complete IMG tag False for just the URL
     * @param string $size Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $default Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $rating Maximum rating (inclusive) [ g | pg | r | x ]
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source https://gravatar.com/site/implement/images/php/
     */
    public function getGravatar($email, $img = false, $size = 80, $default = 'mm', $rating = 'g', $atts = array())
    {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$size&d=$default&r=$rating";
        if ($img) {
            $url = '<img src="' . $url . '" alt="' . $email . '"';
            foreach ($atts as $key => $val) {
                $url .= ' ' . $key . '="' . $val . '"';
            }
            $url .= ' />';
        }
        return $url;
    }
}
