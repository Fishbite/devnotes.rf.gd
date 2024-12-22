<?php

$projectRoot = __DIR__; // Assuming the script is located in PROJECT_ROOT
$imageDir = 'images'; //  images folder relative to the PROJECT_ROOT
$csvFile = 'image_paths.csv';

// Open the CSV file for writing
$file = fopen($csvFile, 'w');

if ($file === false) {
    die("Could not open CSV file for writing.");
}


// Function to recursively scan directories
function scanDirectory(string $dir, string $projectRoot, $file): void
{
    $items = glob($dir . '/*');

    if ($items === false) {
      return;
    }

    foreach ($items as $item) {
        if (is_dir($item)) {
            scanDirectory($item, $projectRoot, $file); // Recursive call for subdirectories
        } elseif (is_file($item)) {
          $pathInfo = pathinfo($item);
          if (isset($pathInfo['extension']) && in_array(strtolower($pathInfo['extension']), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $relativePath = str_replace($projectRoot . '/', '', $item);
                fputcsv($file, [$relativePath]);
            }

        }
    }
}

// Start scanning from the image directory
scanDirectory($projectRoot . '/' . $imageDir, $projectRoot, $file);

fclose($file);

echo "CSV file '$csvFile' created successfully.\n";

/*

Explanation:

    $projectRoot and $imageDir:

        $projectRoot is set to the directory where the PHP script is located.

        $imageDir is set to the name of the directory within $projectRoot that contains the images ( in this case 'images')

        $csvFile is set to the output filename

    fopen: Opens the CSV file in write mode ('w').

    scanDirectory Function:

        Takes the directory to scan ($dir), project root ($projectRoot) and file pointer ($file) as parameters.

        Uses glob to get a list of all files and sub directories within the current directory

        Iterates through each item (file or subdirectory).

            If it's a directory, it calls scanDirectory recursively to process it.

            If it's a file, it checks the extension to see if it is an image file, and, if it is, then:

                Calculates the relative path using str_replace

                Writes the relative path to the CSV file using fputcsv.

    Starting the Scan:

        The scanDirectory function is called initially with the $imageDir path.

    Closing the file:

        The $file handle is closed.

    Output: A success message is printed after the file is written.

How to Use:

    Save: Save this code as a .php file (e.g., generate_image_csv.php) inside your PROJECT_ROOT directory.

    Run: Execute the script from your terminal or browser: php generate_image_csv.php.

    CSV File: A file named image_paths.csv will be created in your project root directory. This file will contain the relative paths of your images, one path per line, enclosed within double quotes.

Before Running:

    Ensure that your PHP installation has read/write access to the directories where the script and image folders are located.

    Confirm that the extensions are set correctly in the $validExtensions array in the script

Important Considerations:

    Error Handling: This script includes basic error handling (checking if the CSV file could be opened), but you might want to add more robust error handling as needed.

    Image Extensions: Make sure the image extensions are set correctly in the $validExtensions array.

    Large Directories: If you have an extremely large number of images, consider using techniques like buffered reading/writing or limiting file size, if needed, to optimize resource usage.

*/