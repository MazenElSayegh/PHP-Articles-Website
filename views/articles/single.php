<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article view</title>
    <style>
    <?php include "style.css" ?>
    </style>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Bentham|Playfair+Display|Raleway:400,500|Suranna|Trocchi" rel="stylesheet">
</head>

<body>
  <div class="wrapper">
    <div class="article-img">
    <?php
    $index=isset($_GET["article_id"])?$_GET["article_id"]:"";
    $articles=$db->get_all_records();
    echo "<img src=./images/".$articles[$index]["image_path"]."></div>";
    echo"<div class=product-info><div class=product-text><h1>".$articles[$index]["title"]."</h1>";
    echo "<ul>";
    echo "<li>Summart: ".$articles[$index]["summary"]."</li>";
    echo "<li>Content: ".$articles[$index]["full_article"]."</li>";
    echo "<li>Publish Date: ".$articles[$index]["publishing_date"]."</li>";
    echo "<button type=button><a href='".$_SERVER["PHP_SELF"]."?article_current=0'>Return</a></button>";
    ?>
    </ul></div></div></div></body></html>



    