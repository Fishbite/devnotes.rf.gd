<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Demo</title>

    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php
      $books = [
        ["name" => "Do androids dream of electric sheep",
        "author" => "Jon Doe",
        "purchaseUrl" => 'http://example.com',
        "year" => "2010"
      ],
      [
        "name" => "Project Hail Mary",
        "author" => "Andy Weir",
        "purchaseUrl" => 'http://example.com',
        "year" => "2011"
      ],
      [
        "name" => "The Martian",
        "author" => "Andy Weir",
        "purchaseUrl" => "http://example.com",
        "year" => "2014"
      ]
      ];
      
      $title = "Recomended Items";
      $read = false;

      // does the same thing as PHP's `array_filter() function`
      function filter($items, $fn) {

        $filteredItems = [];

        foreach($items as $item) {

          if ($fn($item)) {
            $filteredItems[] = $item;
          }

        }

        return $filteredItems;
        
      }

      // replaced our own `filter()` function tiha PHP's `array_filter()` function
      $filteredBooks = array_filter($books, function($book) {
        return $book['author'] === "Andy Weir";
      });


    ?>
     
     <h1><?= $title ?></h1>

        <?php foreach($filteredBooks as $item) : ?>

          <li>
            <a href=<?="$item[purchaseUrl];"?>>

              <?= $item["name"];?> (<?=$item["year"];?>) - By <?= $item["author"]?>
            </a>
          </li>

        <?php endforeach?>

     </ul>
  </body>
</html>
