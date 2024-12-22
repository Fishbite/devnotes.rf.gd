<?php

$projectRoot = __DIR__; // Assuming the script is located in PROJECT_ROOT
$imageDir = 'images'; //  images folder relative to the PROJECT_ROOT
$csvFile = 'image_paths.csv';

// Database connection details (replace with your own)
$servername = "localhost";
$username = "root";
$password = "";
$database = "dbshop";

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create table if it does not exist
    $sql = "CREATE TABLE IF NOT EXISTS recipes (
                id INT AUTO_INCREMENT PRIMARY KEY,
                recipe VARCHAR(255) UNIQUE NOT NULL,
                path TEXT NOT NULL
            )";
    if ($conn->query($sql) === TRUE) {
        echo "Table created successfully or already exists.\n";
    } else {
        echo "Error creating table: " . $conn->error . "\n";
    }

    // Open the CSV file for writing
    $file = fopen($csvFile, 'w');

    if ($file === false) {
        die("Could not open CSV file for writing.");
    }

    // Function to recursively scan directories
    function scanDirectory(string $dir, string $projectRoot, $file, mysqli $conn): void
    {
        $items = glob($dir . '/*');

        if ($items === false) {
          return;
        }

        foreach ($items as $item) {
            if (is_dir($item)) {
                scanDirectory($item, $projectRoot, $file, $conn); // Recursive call for subdirectories
            } elseif (is_file($item)) {
                $pathInfo = pathinfo($item);
                if (isset($pathInfo['extension']) && in_array(strtolower($pathInfo['extension']), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $relativePath = str_replace($projectRoot . '/', '', $item);
                    fputcsv($file, [$relativePath]); // write the file to the csv

                    //Extract recipe name from relative path:
                    $path_parts = explode(DIRECTORY_SEPARATOR, $relativePath);
                    if (count($path_parts) > 2) {
                       $recipe = $path_parts[1]; // Assumes "images/recipe_name/image.jpg" pattern.
                        // Insert data into MySQL database
                       $stmt = $conn->prepare("INSERT INTO recipes (recipe, path) VALUES (?, ?)");
                       $stmt->bind_param("ss", $recipe, $relativePath);

                       if ($stmt->execute()) {
                          echo "Inserted: Recipe: " . $recipe . ", Path: " . $relativePath . "\n";
                        } else {
                          echo "Error inserting record: " . $stmt->error . "\n";
                       }
                       $stmt->close();

                    }
                   else{
                      echo "Skipped path due to unexpected structure: " . $relativePath ."\n";
                   }


                }
            }
        }
    }

    // Start scanning from the image directory
    scanDirectory($projectRoot . '/' . $imageDir, $projectRoot, $file, $conn);

    fclose($file);

    echo "CSV file '$csvFile' created successfully.\n";

} catch (mysqli_sql_exception $e) {
    echo "MySQL Error: " . $e->getMessage() . "\n";
}
finally {
    if (isset($conn) && $conn)
    {
        $conn->close();
    }
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