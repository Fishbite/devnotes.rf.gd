<?php
echo 'Hey '.htmlspecialchars($_POST["fname"]).', thanks for submitting our form<br><br>';

echo 'This is the data you entered:<br><br>';

foreach($_POST as $key => $val) {

    if($_POST[$key] !== "password") {
    echo htmlspecialchars($val) .'<br>';
    }
}
echo '<br>';
echo '<a href="../forms-basic.php">forms</a>';