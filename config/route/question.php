<?php
/**
 * Routes for user.
 */
return [
    "mount" => null,
    "routes" => [
        [
            "info" => "Get all questions.",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["postController", "getIndex"]
        ],
        [
            "info" => "Get all questions.",
            "requestMethod" => "get",
            "path" => "questions",
            "callable" => ["postController", "getQuestions"]
        ],
        [
            "info" => "Get one questions.",
            "requestMethod" => "get",
            "path" => "questions/{id:digit}",
            "callable" => ["postController", "getOneQuestion"]
        ],
        [
            "info" => "Get all questions with a specific tag.",
            "requestMethod" => "get",
            "path" => "questions/tagged/{tagName:alpha}",
            "callable" => ["postController", "getTaggedQuestions"],
        ],
        [
            "info" => "Get all tags.",
            "requestMethod" => "get",
            "path" => "tags",
            "callable" => ["tagController", "getTags"],
        ],
        [
            "info" => "Show all users",
            "requestMethod" => "get",
            "path" => "users",
            "callable" => ["userController", "getUsers"],
        ],
        [
            "info" => "Show posts made by the user",
            "requestMethod" => "get",
            "path" => "users/{username}",
            "callable" => ["userController", "getUserActivity"],
        ],



        [
            "info" => "Post a new question.",
            "requestMethod" => "get|post",
            "path" => "questions/ask",
            "callable" => ["postController", "getPostCreateQuestion"]
        ],
        [
            "info" => "Edit a question.",
            "requestMethod" => "get|post",
            "path" => "questions/edit/{id:digit}",
            "callable" => ["postController", "getPostEditQuestion"]
        ],
        [
            "info" => "Post an answer to a question.",
            "requestMethod" => "get|post",
            "path" => "questions/{id:digit}/answer",
            "callable" => ["postController", "getPostSaveAnswer"],
        ],
        [
            "info" => "Edit an answer to a question.",
            "requestMethod" => "get|post",
            "path" => "questions/{questionId:digit}/answer/edit/{answerId:digit}",
            "callable" => ["postController", "getPostSaveAnswer"],
        ],

        [
            "info" => "Post a new comment",
            "requestMethod" => "get|post",
            "path" => "questions/comments/{postId:digit}/comment",
            "callable" => ["commentController", "getPostCreateComment"],
        ],
        [
            "info" => "Edit a comment",
            "requestMethod" => "get|post",
            "path" => "questions/comments/{postId:digit}/comment/edit/{commentId:digit}",
            "callable" => ["commentController", "getPostEditComment"],
        ],
        [
            "info" => "Create a new tag",
            "requestMethod" => "get|post",
            "path" => "tags/create",
            "callable" => ["tagController", "getPostCreateTag"],
        ],
        [
            "info" => "Edit a tag",
            "requestMethod" => "get|post",
            "path" => "tags/{tag}/edit",
            "callable" => ["tagController", "getPostEditTag"],
        ],


        //
        // // Routes accessible by authenticated users.
        // [
        //     "info" => "Protect upcoming routes from un-authenticated users.",
        //     "requestMethod" => "get|post",
        //     "path" => "**",
        //     "callable" => ["authHelper", "authenticatedOnly"]
        // ],
        // [
        //     "info" => "Display and update an user profile.",
        //     "requestMethod" => "get|post",
        //     "path" => "profile",
        //     "callable" => ["userController", "getPostProfile"],
        // ],
        //
        //
        //
        // // Routes accessible by admins only.
        // [
        //     "info" => "Protect upcoming routes from un-authorized users.",
        //     "requestMethod" => "get|post",
        //     "path" => "admin/**",
        //     "callable" => ["authHelper", "adminOnly"]
        // ],
        // [
        //     "info" => "Display all users",
        //     "requestMethod" => "get",
        //     "path" => "admin/users",
        //     "callable" => ["adminController", "getUsers"],
        // ],
        // [
        //     "info" => "Create a new user.",
        //     "requestMethod" => "get|post",
        //     "path" => "admin/users/add",
        //     "callable" => ["adminController", "getPostNewUser"],
        // ],
        // [
        //     "info" => "Update an user.",
        //     "requestMethod" => "get|post",
        //     "path" => "admin/users/update/{id:digit}",
        //     "callable" => ["adminController", "getPostEditUser"]
        // ],
        // [
        //     "info" => "Delete an user.",
        //     "requestMethod" => "get",
        //     "path" => "admin/users/delete/{id:digit}",
        //     "callable" => ["adminController", "getDeleteUser"]
        // ],
    ]
];
