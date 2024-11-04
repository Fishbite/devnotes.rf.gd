<?php
#### in-page variables ####
$pageDescription = 'php playground for testing stuff';
$pageTitle = 'PHP Playground';

$year = date(format: "Y");
$mainTitle = $pageTitle;

#### file containing the `if` statements printed in index.view.php
require_once("examples/if.php");

#### files to build the page ####
require_once("includes/header.php");
require_once("views/index.view.php");
require_once("includes/footer.php");
