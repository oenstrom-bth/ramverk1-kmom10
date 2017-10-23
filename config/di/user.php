<?php
/**
 * Configuration file for anax-user DI container.
 */
return [
    // Services to add to the container.
    "services" => [
        "user" => [
            "shared" => false,
            "callback" => function () {
                $user = new \Oenstrom\Comment\User("r1_User");
                $user->setDb($this->get("db"));
                return $user;
            }
        ],
        "userController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Oenstrom\Comment\UserController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "adminController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Oenstrom\Comment\AdminController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "authHelper" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Oenstrom\Comment\AuthHelper();
                $obj->setDI($this);
                return $obj;
            }
        ],
    ],
];
