<?php
/**
 * Routes for user.
 */
return [
    "mount" => "user",
    "routes" => [
        // Routes accessible by anyone.
        [
            "info" => "Register an user.",
            "requestMethod" => "get|post",
            "path" => "register",
            "callable" => ["userController", "getPostRegister"],
        ],
        [
            "info" => "Login an user.",
            "requestMethod" => "get|post",
            "path" => "login",
            "callable" => ["userController", "getPostLogin"],
        ],
        [
            "info" => "Logout an user.",
            "requestMethod" => "get",
            "path" => "logout",
            "callable" => ["userController", "getLogout"],
        ],



        // Routes accessible by authenticated users.
        [
            "info" => "Protect upcoming routes from un-authenticated users.",
            "requestMethod" => "get|post",
            "path" => "**",
            "callable" => ["authHelper", "authenticatedOnly"]
        ],
        [
            "info" => "Display and update an user profile.",
            "requestMethod" => "get|post",
            "path" => "profile",
            "callable" => ["userController", "getPostProfile"],
        ],



        // Routes accessible by admins only.
        [
            "info" => "Protect upcoming routes from un-authorized users.",
            "requestMethod" => "get|post",
            "path" => "admin/**",
            "callable" => ["authHelper", "adminOnly"]
        ],
        [
            "info" => "Display all users",
            "requestMethod" => "get",
            "path" => "admin/users",
            "callable" => ["adminController", "getUsers"],
        ],
        [
            "info" => "Create a new user.",
            "requestMethod" => "get|post",
            "path" => "admin/users/add",
            "callable" => ["adminController", "getPostNewUser"],
        ],
        [
            "info" => "Update an user.",
            "requestMethod" => "get|post",
            "path" => "admin/users/update/{id:digit}",
            "callable" => ["adminController", "getPostEditUser"]
        ],
        [
            "info" => "Delete an user.",
            "requestMethod" => "get",
            "path" => "admin/users/delete/{id:digit}",
            "callable" => ["adminController", "getDeleteUser"]
        ],
    ]
];
