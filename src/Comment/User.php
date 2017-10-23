<?php

namespace Oenstrom\Comment;

use \Oenstrom\Comment\ActiveRecordModelExtender;

/**
 * A database driven model.
 */
class User extends ActiveRecordModelExtender
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "r1_User";



    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     * @var string $role not null default "user".
     * @var string $username unique not null.
     * @var string $password not null.
     * @var string $email unique not null.
     * @var timestamp $created default CURRENT_TIMESTAMP.
     * @var timestamp $deleted default null.
     */
    public $id;
    public $role;
    public $username;
    public $password;
    public $email;
    public $created;
    //public $updated;
    public $deleted;
    //public $active;



    /**
     * Set the user password.
     *
     * @param string $password the password to hash.
     *
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }



    /**
     * Check if password is correct.
     *
     * @param string $username the username of the user
     * @param string $password the password of the user
     *
     * @return boolean true if the password match the user password, else false
     */
    public function verifyPassword($username, $password)
    {
        $this->find("username", $username);
        return password_verify($password, $this->password);
    }



    /**
     * Check if the username already exists in the database.
     *
     * @return string|null the username if it exists, else null
     */
    public function usernameExists($username)
    {
        $this->find("username", $username);
        return $this->username;
    }



    /**
     * Check if the email already exists in the database.
     *
     * @return string|null the email if it exists, else null
     */
    public function emailExists($email)
    {
        $this->find("email", $email);
        return $this->email;
    }



    /**
     * Check if the user is an admin.
     *
     * @return boolean true if user is admin, else false
     */
    public function isAdmin()
    {
        return $this->role === "admin";
    }



    /**
     * Get either a Gravatar URL or complete image tag for the user email.
     *
     * @param boole $img True to return a complete IMG tag False for just the URL
     * @param string $size Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $default Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $rating Maximum rating (inclusive) [ g | pg | r | x ]
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source https://gravatar.com/site/implement/images/php/
     */
    public function getGravatar($img = false, $size = 80, $default = 'mm', $rating = 'g', $atts = array())
    {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($this->email)));
        $url .= "?s=$size&d=$default&r=$rating";
        if ($img) {
            $url = '<img src="' . $url . '" alt="' . $this->email . '"';
            foreach ($atts as $key => $val) {
                $url .= ' ' . $key . '="' . $val . '"';
            }
            $url .= ' />';
        }
        return $url;
    }
}
