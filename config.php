<?php
// NB: this file is secured via .htaccess and can not be
// accessed by typing the filename into the browser address bar.
// Doing so will make the server respond with a 403 FORBIDDEN page
// $CONFIG["foo"] = "bar";

// The `return` keyword is not exclusive to functions
// When this file is `required` it will return this:
// return [
//     "host" => "localhost",
//     "port" => 3306,
//     "dbname" => "dbshop",
//     "charset" => "utf8mb4"
// ];

// how to use:
// In another file:
                // $config = require 'config.php'
                // then $config === [
                //     "host" => "localhost",
                //     "port" => 3306,
                //     "dbname" => "dbshop",
                //     "charset" => "utf8mb4"
                // ];

// now let's make it so we can store multiple configurations:

return [
    'dbshop' => [
        "host" => "localhost",
        "port" => 3306,
        "dbname" => "dbshop",
        "charset" => "utf8mb4"
    ]
];