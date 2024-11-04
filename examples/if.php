<?php
#### code to print `if` statements START ####
$example = <<<'EXAMPLE'
if (expresion) {
    // statement that makes something  happen
}
EXAMPLE;


$admin = true;
if ($admin) {
    $output = 'admin rights assigned';
    } else {
    $output = 'no admin privilages assigned';
}

$adminTrue = <<<'ADMINTRUE'
$admin = true;
if ($admin) { // evaluates to true
    $output = 'admin rights assigned';
}
ADMINTRUE;

$isAdmin = false;
if ($isAdmin) {
    $adminFalseOutput = 'admin rights assigned';
    } else {
    $adminFalseOutput = 'no admin privilages assigned';
}

$adminFalse = <<<'ADMINFALSE'
$isAdmin = false;
if ($isAdmin) { // evaluates to false
    $adminFalseOutput = 'admin rights assigned';
    } else {
    $adminFalseOutput = 'no admin privilages assigned';
}
ADMINFALSE;

$passwordEg =  <<<'PASSWORD'
if ($password === $storedPassword) {
    // Welcome the user
    // log user onto system
    } else {
    // tell user password is wrong
    // redirect back to logon screen
}
PASSWORD;

$variableValue = <<<'VARIABLE'
if ($counter === 10) {
    // do something
    } elseif ($counter < 10) {
    // continue counting
    } else {
    // display message: "something went wrong, value too high"
    // terminate the program
}
VARIABLE;


$stringsAndNumbers = <<<'STRINGS'
var_dump(0 == "a"); // expected: bool(false)

Results from PHP 7.0
bool(true)

results from PHP 8.0
bool(false)
STRINGS;

$valueToVariableValue = <<<'VARIABLE2'
// write the value to check against first
if (10 == $someVariable) {
    // do something
}

// because if we accidently write this:

if (10 = $someVariable) {
    // do something
}

// PHP will throw an exception and alert us to our error

// whereas, if had written:
if ($someVariable = 10) {
// something bad is going to happen in our program!
    function launchNuclearArsenal();
    // function sends missiles!
}
VARIABLE2;

$chainIf = <<<'CHAINIF'
if ($isAdmin) {
    // echo 'welcome administrator';
    if ($canEdit) {
        // echo 'you can edit the records';
    }
}
CHAINIF;

$a = 35;
$b = 34.99;
$z = $a - $b;

$floats = <<<FLOATS
\$a = 35;
\$b = 34.99;
\$z = \$a - \$b;  // should be 0.01

but \$z actually equals $z;

// so if we try to compare:
if (\$z === 0.01) {
    echo true // never happens
} else {
    echo false because \$z = 0.009999999999998; // actual result
}
FLOATS;

$embedBasic = <<<EMBED
<div>
  <?php if ( expression ) : ?>
  // HTML goes here
  // basically substituting our expression/s
  <?php endif; ?>
</div>
EMBED;

$isGameOver = true;
$embed = <<<EMBED
<div>
  <?php \$isGameOver = true; ?>
  <?php if ( \$isGameOver ) : ?>
  <a href="#">Start Again</a>
  <?php endif; ?>
</div>
EMBED;
#### code to print `if` statements END ####