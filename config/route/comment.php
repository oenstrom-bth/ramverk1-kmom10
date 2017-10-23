<?php
/**
 * Routes for the comments.
 */
return [
    "routes" => [
        [
            "info" => "Get all comments.",
            "requestMethod" => "get|post",
            "path" => "",
            "callable" => ["commentController", "getComments"]
        ],
        [
            "info" => "Protect remaining comment routes form unauthenticated users.",
            "requestMethod" => "get|post",
            "path" => "**",
            "callable" => ["authHelper", "authenticatedOnly"]
        ],
        [
            "info" => "Edit a comment.",
            "requestMethod" => "get|post",
            "path" => "edit/{id:digit}",
            "callable" => ["commentController", "getPostEditComment"]
        ],
        [
            "info" => "Delete a comment.",
            "requestMethod" => "get",
            "path" => "delete/{id:digit}",
            "callable" => ["commentController", "getDeleteComment"]
        ],
    ]
];
