<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?= clean($pageDescription)?>" />

    <title><?=clean($pageTitle) ?></title>

    <!-- *********************FACEBOOK START******************** -->
    <!-- facebook meta tags to ensure correct image / page is shared START-->

    <!-- set the URL that you want Facebook to point to in this tag -->
    <meta property="og:url" content="<?=clean($ogURL) ?>" />
    <meta property="og:type" content="<?=clean($ogType)?>" />
    <meta property="og:title" content="<?=clean($title)?>" />

    <!-- set a very short description of the page in this tag -->
    <meta property="og:description" content="<?=clean($ogPageDescription)?>" />

    <!-- set the image that you want Facebook to display in this tag-->
    <meta property="og:image" content="<?=clean($ogImage)?>" />
    <!-- facebook meta tags to ensure correct image / page is shared END-->
    <!-- *********************FACEBOOK END********************* -->

    <!-- Pre-load the font used on the website: "Poppins" -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="styles/styles.css" />
    <link rel="stylesheet" href="styles/prism.css" />
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <!-- <li><a href="https://devnotes.rf.gd/">home</a></li>
          <li><a href="https://devnotes.rf.gd/forms-basic.php">forms</a></li> -->
          <li><a href=".">home</a></li>
          <li><a href="forms-basic.php">forms</a></li>
        </ul>
      </nav>
    </header>
