<?php 
// this file holds variables used to print PHP examples
// It keeps our html clean and our app easier to manage
$ratufaCode = <<<'RATUFA'
<script>id="ratufa_id" src="path_to_ratufas_form_handler"</script>
RATUFA;

$stringsAndNumbers = <<<'STRINGS'
var_dump(0 == "a"); // expected: bool(false)

Results from PHP 7.0
bool(true)

results from PHP 8.0
bool(false)
STRINGS;

$simpleForm = <<<'SIMPLEFORM'
<form>
    <label for="name">Your name:</label>
    <input name="name" id="name" type="text">

    <label for="lname">Last Name:</label>
    <input name="lname" id="lname" type="text" />

    <label for="age">Your age:</label>
    <input name="age" id="age" type="number">

    <button type="submit">Submit</button>
</form>
SIMPLEFORM;

$formStyles = <<<'FORMSTYLES'
.form-container {
  position: relative;
  display: flex;
  flex-direction: column;
  width: 100%;
  place-items: center;
  margin: 1rem 0;
}

form {
  display: flex;
  flex-direction: column;
  width: 200px;
  justify-content: center;
}

form input {
  margin-bottom: 0.5rem;
}

form button {
  margin-top: 1rem;
  width: fit-content;
}
FORMSTYLES;

$validatedForm = <<<'VALIDFORM'
<form action="includes/formaction.php" method="post">
    <label for="fname">First Name:</label>
    <input name="fname" id="fname" type="text" required />

    <label for="lname">Last Name:</label>
    <input name="lname" id="lname" type="text" required />

    <label for="age">Your Age:</label>
    <input name="age" id="age" type="number" required min="1" max="150" />

    <button type="submit">Submit</button>
</form>
VALIDFORM;

$formAction = <<<'FORMACTION'
<?php
echo 'Thanks for submitting our form';
FORMACTION;

$validatedForm = <<<'VALIDFORM'
<form action="includes/formaction.php" method="post">
    <label for="fname">First Name:</label>
    <input name="fname" id="fname" type="text" required />

    <label for="lname">Last Name:</label>
    <input name="lname" id="lname" type="text" required />

    <label for="age">Your Age:</label>
    <input name="age" id="age" type="number" required min="1" max="150" />

    <button type="submit">Submit</button>
</form>
VALIDFORM;

$formAction2 = <<<'FORMACTION2'
<?php
echo 'Thanks for submitting our form<br/>';

echo '<pre>'; // format nicely
var_dump($_POST); // print the contents of $_POST
echo '</pre>';
FORMACTION2;

$formAction3 = <<<'FORMACTION3'
<?php
echo 'Hey '.htmlspecialchars($_POST["fname"]).', thanks for submitting our form<br><br>';

echo 'Please check the data is correct:<br><br>';

foreach($_POST as $val) {
    echo htmlspecialchars($val) .'<br>';
}
echo '<br>';
echo '<a href="../forms-basic.php">forms</a>';
FORMACTION3;

$formResult = <<<'FORMRESULT'
Thanks for submitting our form

array(3) {
  ["fname"]=>
  string(3) "jon"
  ["lname"]=>
  string(3) "doe"
  ["age"]=>
  string(2) "56"
}
FORMRESULT;

$formAction3 = <<<'FORMACTION3'
echo $_POST["fname"];
FORMACTION3;

$formAction4 = <<<'FORMACTION4'
echo htmlspecialchars($_POST["fname"]);
FORMACTION4;

$formAction5 = <<<'FORMACTION5'
<?php
echo 'Hey '. htmlspecialchars($_POST["fname"]) . ', thanks for submitting our form<br><br>';

echo 'This is the data you entered:<br><br>';

// iterate through each index in the $_POST array
foreach($_POST as $key => $val) {

    // check the index doesn't hold sensitive data
    if($_POST[$key] !== "password") {

    // print the contents safely
    echo htmlspecialchars($val) .'<br>';
    }
}

echo '<br>';
// give the user a way to get back to the form page
echo '<a href="../forms-basic.php">forms</a>';
FORMACTION5;

$formResult2 = <<<'FORMRESULT2'
Hey jon, thanks for submitting our form

This is the data you entered:

jon
doe
56

forms // link back to the form page
FORMRESULT2;


$dumpPost = <<<'DUMPPOST'
<?php
echo '<pre>'; // format nicely
var_dump($_POST); // print the contents of $_POST
echo '</pre>';
DUMPPOST;

$postData = <<<'POSTDATA'
array(3) {
  ["fname"]=>
  string(3) "jon"
  ["lname"]=>
  string(3) "doe"
  ["age"]=>
  string(2) "56"
}
POSTDATA;

$mysqliPrepdStatement = <<<'MYSQLISTATEMENT'
// you would connect to a database (DB) somewhat like this:
$mysqli = new mysqli("example.com", "user", "password", "database");
// but we'll come back to that another time

// first of all, prepare the statement to query the DB
// in this case, insert a record into the connected DB
// the placeholder "?" is used instead of each variable's name
$stmt = $mysqli->prepare("INSERT INTO test(id, label) VALUES (?, ?)")

// then bind the required variables to the query's parameters
$id = 1; // first variable to bind
$label = 'PHP'; // second variable to bind
$stmt->bind_param("is", $id, $label); // binding of variable to parameters

// and finally execute the statment
$stmt->execute();
MYSQLISTATEMENT;

$mysqliPrepdStatement2 = <<<'MYSQLISTATEMENT2'

// Prepare
$stmt = $mysqli->prepare("INSERT INTO test(id, label) VALUES (?, ?)")

// bind
$id = 1; // first variable to bind
$label = 'PHP'; // second variable to bind
$stmt->bind_param("is", $id, $label); // binding of variable to parameters

// execute
$stmt->execute();
MYSQLISTATEMENT2;

$phpVars = <<<'PHPVARS'
// create vars to store form data
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$age = $_POST["age"];
PHPVARS;

$usingFormData = <<<'MYSQLISTATEMENT2'

// Prepare
$stmt = $mysqli->prepare("INSERT INTO users(fname, lname, age) VALUES (?, ?, ?)")

// bind
$stmt->bind_param("ssi", $fname, $lname, $age); // binding of variable to parameters

// execute
$stmt->execute();
MYSQLISTATEMENT2;
