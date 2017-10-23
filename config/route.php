<?php
/**
 * Configuration file for routes.
 */
return [
    // Load these routefiles in order specified and optionally mount them
    // onto a base route.
    "routeFiles" => [
        [
            // These are for internal error handling and exceptions
            "mount" => null,
            "file" => __DIR__ . "/route/internal.php",
        ],
        [
            // For debugging and development details on Anax
            "mount" => "debug",
            "file" => __DIR__ . "/route/debug.php",
        ],
        [
            // To read flat file content in Markdown from content/
            "mount" => null,
            "file" => __DIR__ . "/route/flat-file-content.php",
        ],


        [
            "mount" => "remserver/api",
            "file" => __DIR__ . "/route/remserver.php",
        ],
        [
            "mount" => "comments",
            "file" => __DIR__ . "/route/comment.php",
        ],
        [
            "mount" => "book",
            "file" => __DIR__ . "/route/books.php",
        ],
        [
            // Keep this last since its a catch all
            "mount" => null,
            "sort" => 999,
            "file" => __DIR__ . "/route/404.php",
        ],
    ],

];
