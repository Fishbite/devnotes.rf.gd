<?php
#### in-page variables ####
$pageDescription = 'php playground for testing stuff';
$pageTitle = 'Forms & PHP';

$year = date(format: "Y");
$mainTitle = $pageTitle;

#### file containing the `examples` forms-basic.view.php
require_once("examples/forms-basic-example.php");

#### files to build the page ####
require_once("lib/clean.php");
require_once("includes/header.php");
require_once("views/forms-basic.view.php");
require_once("includes/footer.php");