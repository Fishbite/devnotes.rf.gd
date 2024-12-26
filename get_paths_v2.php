<?php

$projectRoot = __DIR__;
$imageDir = 'images';
$csvFile = 'image_paths.csv';

$servername = "localhost";
$username = "root";
$password = "";
$database = "dbshop";


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($servername, $username, $password, $database);

    $sql = "CREATE TABLE IF NOT EXISTS recipes (
                id INT AUTO_INCREMENT PRIMARY KEY,
                recipe VARCHAR(255) UNIQUE NOT NULL,
                paths TEXT NOT NULL
            )";
    if ($conn->query($sql) === TRUE) {
        echo "Table created successfully or already exists.<br><br>";
    } else {
        echo "Error creating table: " . $conn->error . "<br><br>";
    }

    $file = fopen($csvFile, 'w');

    if ($file === false) {
        die("Could not open CSV file for writing.");
    }


  function scanDirectory(string $dir, string $projectRoot, $file, mysqli $conn): void
    {
        $items = glob($dir . '/*');

        if ($items === false) {
          return;
        }

        $recipe_images = [];

        foreach ($items as $item) {

            echo 'foreach $items as $item. $item = ' . $item . '<br><br>';

            if (is_dir($item)) {
               $pathInfo = pathinfo($item);

               echo 'is-dir? $pathInfo: <pre>' . var_dump($pathInfo) . '</pre><br><br>';

                // No special handling of directories needed, just recurse
                  scanDirectory($item, $projectRoot, $file, $conn); // Recursive call for subdirectories


            } elseif (is_file($item)) {
                $pathInfo = pathinfo($item);


                echo 'is_file? $pathInfo: <pre>' . var_dump($pathInfo) . '</pre><br><br>';

                if (isset($pathInfo['extension']) && in_array(strtolower($pathInfo['extension']), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $relativePath = str_replace($projectRoot . '/', '', $item);
                    fputcsv($file, [$relativePath]);

                    $path_parts = explode(DIRECTORY_SEPARATOR, $relativePath);
                    $images_key = array_search('images', $path_parts);
                    
                     if ($images_key !== false) {
                        // Recipe name is always the element directly after "images"
                        if (isset($path_parts[$images_key + 1])) {
                          $recipe = $path_parts[$images_key + 1];
                          //check if recipe has been set, and that there isn't another directory
                          if(strpos($path_parts[$images_key+2], '.') === false){
                            if(!isset($recipe_images[$recipe])){
                               $recipe_images[$recipe] = [];
                             }
                           $recipe_images[$recipe][] = $relativePath;
                           echo "Found recipe: " . $recipe . " for path: " . $relativePath . "<br>";
                           } else {
                              echo "Could not find a valid recipe name in the path for: " . $relativePath . "<br>";
                           }
                           
                        } else {
                            echo "Could not find a valid recipe name in the path for: " . $relativePath . "<br>";
                        }
                     } else {
                       echo "Could not find 'images' or a recipe name in the path for: " . $relativePath . "<br>";
                    }
                   }
            }
        }

         foreach($recipe_images as $recipe => $paths){
            $paths_string = implode(",", $paths);
              $stmt = $conn->prepare("INSERT INTO recipes (recipe, paths) VALUES (?, ?)");

                if ($stmt === false) {
                      echo "Error preparing statement: " . $conn->error . "\n";
                      continue; // Skip to next file
                }

                $stmt->bind_param("ss", $recipe, $paths_string);

                if ($stmt->execute()) {
                  echo "Inserted: Recipe: " . $recipe . ", Path: " . $paths_string . "<br>";
                } else {
                    echo "Error inserting record: " . $stmt->error . "\n";
                }

                 $stmt->close();
           }
    }

    scanDirectory($projectRoot . '/' . $imageDir, $projectRoot, $file, $conn);

    fclose($file);
    $conn->close();
    echo "CSV file and database updated successfully!";

} catch (mysqli_sql_exception $e) {
    echo "MySQL Error: " . $e->getMessage();
} catch (Exception $e) {
    echo "General Error: " . $e->getMessage();
}

/*
Key Changes and Explanations:

    Database Connection:

        The code now includes a mysqli connection to your MySQL database, using your servername, username, password, and database (which you will need to replace with your actual credentials).

    Table Creation:

        It creates the recipes table if it doesn't already exist.

    scanDirectory Function Modification:

        The scanDirectory now takes a mysqli object ($conn) as an argument.

        Inside scanDirectory function, it parses out the recipe and inserts into the database as the code iterates through each of the files.

    Error Handling:

        The entire database interaction is wrapped in a try-catch block for mysqli errors, and errors inserting the record.

    CSV Creation:

        The CSV file is still created as you required.

How to Use:

    Replace Credentials: Update the database connection variables ($servername, $username, $password, $database) with your MySQL credentials.

    Save as PHP: Save the code as a PHP file (e.g., process_images.php).

    Run from CLI: Execute the script from your command line:

          
    php process_images.php

        

    Use code with caution.Bash

This will now create the CSV, and insert the recipe and image paths into the database.

I sincerely apologize again for the previous confusion and switching to Python. This PHP version should be exactly what you need. Let me know if you have any further questions or adjustments!
*/