<?php


include 'functions.php'; // dd()

// let $config = anything that is returned by config.php
$config = require 'config.php';

class Database {

    // property to hold the `PDO` instance
    public $connection;

    /**
     * Summary of __construct
     * @param mixed $config
     * @param mixed $username
     * @param mixed $password
     */
    public function __construct($config, $username, $password) {

        // php's in-built function is meant to create a URL query string, but,
        // we can use it to construct our DSN string using its' parametersto change the separator
        // We can set ';' as the separator that we need in the $dsn string:
        // http_build_query($config, '', ';');

        // so now we can assign the result to our $dsn variable:
        $dsn = 'mysql:' . http_build_query($config, '', ';');
        // and everything works as before

        // $this->connection = new PDO($dsn, $user = 'root');
        $this->connection = new PDO($dsn, $username, $password, [
            'PDO::ATTR_DEFAULT_FETCH_MODE' => 'PDO::FETCH_ASSOC',
        ]);
    }

    // method to query the DB
    /**
     * Summary of query
     * @param mixed $query
     * @return bool|PDOStatement
     */
    public function query($query, $params) {

        // ceate the prepared statement (query)
        $statement = $this->connection->prepare($query);
        $statement->execute($params); // run the query

        // we've removed the fetch() method and just return
        // the result of the query
        return $statement;
    }
}

// // and everything still works
// $query9 = "SELECT * FROM recipe_cards WHERE cat = 'fish & veg'";

// // now we can pass in the username & password when we create a new instance of the class:
// $db9 = new Database($config['dbshop'], 'root', '');
// $result9 = $db9->query($query9)->fetchAll();
// // dd($result9);
// echo '<strong>$db9 results:</strong><br><br>';
// foreach($result9 as $key=>$value) {

    
//     echo "<a href='https://nuttyskitchen.co.uk/{$value['page']}.html' target='_blank'>{$value['imgTitle']}</a><br><br>";
// }


// use parameterized query
$query10 = "SELECT * FROM recipe_cards WHERE cat = :cat";

$cat = 'puddings';

// now we can pass in the username & password when we create a new instance of the class:
$db10 = new Database($config['dbshop'], 'root', '');

// now pass in the parameter $cat
$result10 = $db10->query($query10, [':cat' => $cat])->fetchAll();
// dd($result9);
echo '<strong>$db10 results:</strong><br><br>';
foreach($result10 as $key=>$value) {

    
    echo "<a href='https://nuttyskitchen.co.uk/{$value['page']}.html' target='_blank'>{$value['imgTitle']}</a><br><br>";
}

