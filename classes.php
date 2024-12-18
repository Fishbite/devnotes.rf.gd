<?php

require 'functions.php';

echo 'Classes<br>';

class Person {

    public $name;
    public $age;

    public function breath() {

        // $this = the instance of this class that is calling this function
        echo $this->name . ' is breathing';
    }

}

$person = new Person(); // creates instance
$person->name = "John Doe"; // set the name
$person->age = 21; // set the age


// dd($person); // dump the whole instance

echo "$person->name, $person->age <br>"; // print the class instance property values
echo $person->breath() . '<br><br>'; // call the public function


#### CONNECTING TO A DATABASE START ####

// the following shows how to connect to a DB & execute a query
// then we'll extract this lot into a class so we don't have to write it again

// // create a data source
// $dsn = "mysql:host=127.0.0.1;port=3306;dbname=dbshop;charset=utf8mb4";
// // dd($dsn);

// // PDO = php data object
// // dsn = data source name
// $pdo = new PDO($dsn, 'root', ''); // create instance of PDO class

// // create prepared statement DB query
// $statement = $pdo->prepare("SELECT * FROM products;charset=utf8mb4;"); // prepare a query

// // execute the statement (query the DB)
// $statement->execute(); // mysql runs the query

// // fetch the results: PDO::FETCH_ASSOC - only fetch associative array
// $result = $statement->fetchAll(PDO::FETCH_ASSOC); // fetch all the results

// // loop over the results and display them as a list
// foreach($result as $key=>$value) {

//     echo '<pre>';
//     echo '<li>'. $value['title'] . '</li><br>';
//     echo '</pre>';

// }

// So we can just copy & paste everything into a method of a class
class Database {
    public function query() 
        {
            
            // create a data source
            $dsn = "mysql:host=127.0.0.1;port=3306;dbname=dbshop;charset=utf8mb4";
            // dd($dsn);

            // PDO = php data object
            // dsn = data source name
            $pdo = new PDO($dsn, 'root', ''); // create instance of PDO class

            // create prepared statement DB query
            $statement = $pdo->prepare("SELECT * FROM products;charset=utf8mb4;"); // prepare a query

            // execute the statement (query the DB)
            $statement->execute(); // mysql runs the query

            // fetch the results: PDO::FETCH_ASSOC - only fetch associative array
            return $statement->fetchAll(PDO::FETCH_ASSOC); // fetch all the results

            
        }
}

// and everything still works:
$db = new Database();
$db->query(); // call the Database class' method

// run the query method of the class:
$result = $db->query(); // store the result of the query in a variable
echo '<strong>$db results:</strong><br>';
// loop over the results and display them as a list
foreach($result as $key=>$value) {

    echo '<pre>';
    echo '<li>'. $value['category'] . ': ' . $value['title'] . '</li><br>';
    echo '</pre>';

}

// make the class' query() method accept a query parameter
class Database2 {

    public function query($query) {
        
        // create a data source
        $dsn = "mysql:host=127.0.0.1;port=3306;dbname=dbshop;charset=utf8mb4";
        // dd($dsn);

        // PDO = php data object
        // dsn = data source name
        $pdo = new PDO($dsn, 'root', ''); // create instance of PDO class

        // create prepared statement DB query
        $statement = $pdo->prepare( $query); // prepare a query

        // execute the statement (query the DB)
        $statement->execute(); // mysql runs the query

        // fetch the results: PDO::FETCH_ASSOC - only fetch associative array
        return $statement->fetchAll(PDO::FETCH_ASSOC); // fetch all the results
    }
}

$query2 = "SELECT * FROM products;charset=utf8mb4;";
$db2 = new Database2();

// NOTE: every time we run the query, we are creating a new $dsn
// and a new instance of the PDO class, so, let's fix that in Database3
$result2 = $db2->query($query2);
echo '<strong>$db2 results:</strong><br><br>';

foreach($result2 as $key=>$value) {

    echo "{$value['title']} <br><br>";
}

// make the class create a new $dsn & PDO instance
// when a new instance of teh class is created (instantiated)
class Database3 {


    // variable to hold the PDO instance that is available to the class
    // NOTE: we don't have to pass this as a parameter
    // we just use $this->$connection to access it within a method
    public $connection;
    
    // create a contructor that runs when a new class instance is created
    public function __construct() {

        // create a data source - the vairable $dsn is the datasource name
        $dsn = "mysql:host=127.0.0.1;port=3306;dbname=dbshop;charset=utf8mb4";
        // dd($dsn);

        // PDO = php data object
        // dsn = data source name
        $this->connection = new PDO($dsn, 'root', ''); // create instance of PDO class
    }

    public function query($query) {

        // create prepared statement DB query using the $connection var
        // that holds the PDO instance
        $statement = $this->connection->prepare( $query); // prepare a query

        // execute the statement (query the DB)
        $statement->execute(); // mysql runs the query

        // fetch the results: PDO::FETCH_ASSOC - only fetch associative array
        // NOTE: FETCH_ASSOC = a PDO constant (all uppercase by convention)
        return $statement->fetchAll(PDO::FETCH_ASSOC); // fetch all the results
    }
}

$query3 = "SELECT * FROM products;charset=utf8mb4;";
$db3 = new Database3();
$result3 = $db3->query($query3);
echo '<strong>$db3 results:</strong><br><br>';

foreach($result3 as $key=>$value) {

    // echo "{$value['image']} <br><br>";
    echo "{$value['image']} <br><br>";
}

// now lets move the fetch() method out of the class
// that way we can take control of how the data is fetched
// i.e. fetch(), or, fetchAll()
// return $statement->fetchAll(PDO::FETCH_ASSOC);

class Database4 {

    public $connection;

    public function __construct() {

        $dsn = "mysql:host=localhost;port=3306;dbname=dbshop;charset=utf8mb4";

        $this->connection = new PDO($dsn, $user = 'root');
    }

    public function query($query) {

        // ceate the prepared statement (query)
        $statement = $this->connection->prepare($query);
        $statement->execute(); // run the query

        // we've removed the fetch() method and just return
        // the result of the query
        return $statement;
    }
}

$query4 = "SELECT * FROM products";
$db4 = new Database4();
$result4 = $db4->query($query4)->fetchAll(PDO::FETCH_ASSOC);
// dd($result4);
echo '<strong>$db4 results:</strong><br><br>';
foreach($result4 as $key=>$value) {

    echo $value['id'] . '<br><br>';
}

/*
    OK! So at the moment, we have a class that accepts a query as an argument
    `public function query($query)`

    Then, we moved the `fetch()` method out of the class so that we can
    define the `fetch()` / `fetchAll()` method & the data type 
    (PDO::FETCH_ASSOC) when we call the `query()` method:

    `$result4 = $db4->query($query4)->fetchAll(PDO::FETCH_ASSOC);`
    or we can now write:
    `$result4 = $db4->query($query4)->fetch(PDO::FETCH_ASSOC);`

    At the moment, our class has the `dsn` configuration parameters 
    hardcoded:

    `$dsn = "mysql:host=localhost;port=3306;dbname=dbshop;charset=utf8mb4";`
    `$this->connection = new PDO($dsn, $user = 'root');`

    This is not ideal for a production environment, so, we need to move
    those config' parameters out of the class so that we can easily switch
    the config for the appropriate environment, production/development etc.

*/

// move the `dsn` config parameters out of the $dsn string into an array, so that we can easily
// switch them to suit the current environment: development v production

class Database5 {

    // property to hold the `PDO` instance
    public $connection;

    // constructor function that runs when an instance of this class
    // is instantiated i.e. `$varName = new Database5()`
    public function __construct() {

        // move the config details into an array
        $config = [
            "host" => "localhost",
            "port" => 3306,
            "dbname" => "dbshop",
            "charset" => "utf8mb4"
        ];

        // use php's built in function to extract the config info
        // & build up a query string. Note the '&' sign as a separator, where we actually want a ';'
        // http_build_query($config) // example.com?host=localhost&port=3306&dbname=dbshop&charset=utf8mb4

        // If we ctrl+click on the `http_build_query()` we can see the arg's that the function  takes
        // & that the 3rd arg sets the separator:

        // function http_build_query(object $data, string $numeric_prefix = "", string $arg_separator = null, int $encoding_type = PHP_QUERY_RFC1738): string { /* function body is hidden */ }

        // so we can set ';' as the separator that we need in the $dsn string:
        http_build_query($config, '', ';');

        // if we dump & die our function call, we can see the result
        // dd(http_build_query($config, '', ';'));
        // `dd()` result = `string(54) "host=localhost;port=3306;dbname=dbshop;charset=utf8mb4"`

        // which matches most of our original `$dsn` string:
        // $dsn = "mysql:host=localhost;port=3306;dbname=dbshop;charset=utf8mb4";

        // were just missing the `mysql:` bit on the fron of the string
        // so let's concatenate it onto the front of it:
        // dd('mysql:' . http_build_query($config, '', ';'));
        // result: string(60) "mysql:host=localhost;port=3306;dbname=dbshop;charset=utf8mb4"

        // so now we can assign the result to our $dsn variable:
        $dsn = 'mysql:' . http_build_query($config, '', ';');
        // and everything works as before

        $this->connection = new PDO($dsn, $user = 'root');
    }

    // method to query the DB
    public function query($query) {

        // ceate the prepared statement (query)
        $statement = $this->connection->prepare($query);
        $statement->execute(); // run the query

        // we've removed the fetch() method and just return
        // the result of the query
        return $statement;
    }
}

$query5 = "SELECT * FROM products";
$db5 = new Database5();
$result5 = $db5->query($query5)->fetchAll(PDO::FETCH_ASSOC);
// dd($result5);
echo '<strong>$db5 results:</strong><br><br>';
foreach($result5 as $key=>$value) {

    echo $value['title'] . '<br><br>';
}

// so let's leave that there.
$db5 = new Database5();

// now let's move that `$config` array out of the class and accept it as an argument in the constructor
$config = [
    "host" => "localhost",
    "port" => 3306,
    "dbname" => "dbshop",
    "charset" => "utf8mb4"
];

class Database6 {

    // property to hold the `PDO` instance
    public $connection;

    // constructor function that runs when an instance of this class
    // is instantiated i.e. `$varName = new Database5()`
    public function __construct($config) {

        // move the config details into an array
        // $config = [
        //     "host" => "localhost",
        //     "port" => 3306,
        //     "dbname" => "dbshop",
        //     "charset" => "utf8mb4"
        // ];

        // use php's built in function to extract the config info
        // & build up a query string. Note the '&' sign as a separator, where we actually want a ';'
        // http_build_query($config) // example.com?host=localhost&port=3306&dbname=dbshop&charset=utf8mb4

        // If we ctrl+click on the `http_build_query()` we can see the arg's that the function  takes
        // & that the 3rd arg sets the separator:

        // function http_build_query(object $data, string $numeric_prefix = "", string $arg_separator = null, int $encoding_type = PHP_QUERY_RFC1738): string { /* function body is hidden */ }

        // so we can set ';' as the separator that we need in the $dsn string:
        http_build_query($config, '', ';');

        // if we dump & die our function call, we can see the result
        // dd(http_build_query($config, '', ';'));
        // `dd()` result = `string(54) "host=localhost;port=3306;dbname=dbshop;charset=utf8mb4"`

        // which matches most of our original `$dsn` string:
        // $dsn = "mysql:host=localhost;port=3306;dbname=dbshop;charset=utf8mb4";

        // were just missing the `mysql:` bit on the fron of the string
        // so let's concatenate it onto the front of it:
        // dd('mysql:' . http_build_query($config, '', ';'));
        // result: string(60) "mysql:host=localhost;port=3306;dbname=dbshop;charset=utf8mb4"

        // so now we can assign the result to our $dsn variable:
        $dsn = 'mysql:' . http_build_query($config, '', ';');
        // and everything works as before

        $this->connection = new PDO($dsn, $user = 'root');
    }

    // method to query the DB
    public function query($query) {

        // ceate the prepared statement (query)
        $statement = $this->connection->prepare($query);
        $statement->execute(); // run the query

        // we've removed the fetch() method and just return
        // the result of the query
        return $statement;
    }
}

// and everything still works
$query6 = "SELECT * FROM products";
$db6 = new Database6($config);
$result6 = $db6->query($query5)->fetchAll(PDO::FETCH_ASSOC);
// dd($result6);
echo '<strong>$db6 results:</strong><br><br>';
foreach($result6 as $key=>$value) {

    echo $value['id'] . '<br><br>';
}

// now let's just tweak the query execution and move the `fetchAll(PDO::FETCH_ASSOC)` args
// into the new PDO instance's args as an option parameter
$config = [
    "host" => "localhost",
    "port" => 3306,
    "dbname" => "dbshop",
    "charset" => "utf8mb4"
];

class Database7 {

    // property to hold the `PDO` instance
    public $connection;

    public function __construct($config) {

        // move the config details into an array
        // $config = [
        //     "host" => "localhost",
        //     "port" => 3306,
        //     "dbname" => "dbshop",
        //     "charset" => "utf8mb4"
        // ];


        // so we can set ';' as the separator that we need in the $dsn string:
        http_build_query($config, '', ';');

        // so now we can assign the result to our $dsn variable:
        $dsn = 'mysql:' . http_build_query($config, '', ';');
        // and everything works as before

        // $this->connection = new PDO($dsn, $user = 'root');
        $this->connection = new PDO($dsn, 'root', '', [
            'PDO::ATTR_DEFAULT_FETCH_MODE' => 'PDO::FETCH_ASSOC',
        ]);
    }

    // method to query the DB
    public function query($query) {

        // ceate the prepared statement (query)
        $statement = $this->connection->prepare($query);
        $statement->execute(); // run the query

        // we've removed the fetch() method and just return
        // the result of the query
        return $statement;
    }
}

// and everything still works
$query7 = "SELECT * FROM products";
$db7 = new Database7($config);
$result7 = $db7->query($query7)->fetchAll();
// dd($result7);
echo '<strong>$db7 results:</strong><br><br>';
foreach($result7 as $key=>$value) {

    echo $value['image'] . '<br><br>';
}

// now let's move the `$config` array up a level & into its own file `config.php`
// $config = [
//     "host" => "localhost",
//     "port" => 3306,
//     "dbname" => "dbshop",
//     "charset" => "utf8mb4"
// ];

// let $config = anything that is returned by config.php
$config = require 'config.php';

class Database8 {

    // property to hold the `PDO` instance
    public $connection;

    public function __construct($config) {

        // so we can set ';' as the separator that we need in the $dsn string:
        http_build_query($config, '', ';');

        // so now we can assign the result to our $dsn variable:
        $dsn = 'mysql:' . http_build_query($config, '', ';');
        // and everything works as before

        // $this->connection = new PDO($dsn, $user = 'root');
        $this->connection = new PDO($dsn, 'root', '', [
            'PDO::ATTR_DEFAULT_FETCH_MODE' => 'PDO::FETCH_ASSOC',
        ]);
    }

    // method to query the DB
    public function query($query) {

        // ceate the prepared statement (query)
        $statement = $this->connection->prepare($query);
        $statement->execute(); // run the query

        // we've removed the fetch() method and just return
        // the result of the query
        return $statement;
    }
}

// and everything still works
$query8 = "SELECT * FROM products";
$db8 = new Database8($config['dbshop']);
$result8 = $db8->query($query8)->fetchAll();
// dd($result8);
echo '<strong>$db8 results:</strong><br><br>';
foreach($result8 as $key=>$value) {

    echo $value['title'] . '<br><br>';
}

// we can also move the hard coded username & password out of the PDO construct
// and accept them as arguments when we create an instance of the Database class:
// like so: new Database9($config['dbshop'], 'root', '');

// let $config = anything that is returned by config.php
$config = require 'config.php';

class Database9 {

    // property to hold the `PDO` instance
    public $connection;

    public function __construct($config, $username, $password) {

        // so we can set ';' as the separator that we need in the $dsn string:
        http_build_query($config, '', ';');

        // so now we can assign the result to our $dsn variable:
        $dsn = 'mysql:' . http_build_query($config, '', ';');
        // and everything works as before

        // $this->connection = new PDO($dsn, $user = 'root');
        $this->connection = new PDO($dsn, $username, $password, [
            'PDO::ATTR_DEFAULT_FETCH_MODE' => 'PDO::FETCH_ASSOC',
        ]);
    }

    // method to query the DB
    public function query($query) {

        // ceate the prepared statement (query)
        $statement = $this->connection->prepare($query);
        $statement->execute(); // run the query

        // we've removed the fetch() method and just return
        // the result of the query
        return $statement;
    }
}

// and everything still works
$query9 = "SELECT * FROM products";
// now we can pass in the username & password when we create a new instance of the class:
$db9 = new Database9($config['dbshop'], 'root', '');
$result9 = $db9->query($query9)->fetchAll();
// dd($result9);
echo '<strong>$db9 results:</strong><br><br>';
foreach($result9 as $key=>$value) {

    echo $value['title'] . '<br><br>';
}

#### CONNECTING TO A DATABASE END ####