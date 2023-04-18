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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Bentham|Playfair+Display|Raleway:400,500|Suranna|Trocchi" rel="stylesheet">
</head>

<body>
  <div class="wrapper">
    <div class="article-img">
    <?php
    try{
    $index=isset($_GET["article_id"])?$_GET["article_id"]:"";
    $articles=$articles_table->get_all_records();
    if($index>sizeof($articles)){
      throw new Exception('accessing unidentified article ID');
    }
    echo "<div class='card d-inline-flex flex-column justify-content-around align-items-start m-5 p-5 min-vw-50'>";
      echo "<div class='card-body p-2 min-vw-70'>";
        echo "<img src=./images/".$articles[$index]["image_path"]." class='img-fluid w-10'></div>";
        echo"<div class=product-info mb-4><div class=product-text mb-4><h1>".$articles[$index]["title"]."</h1>";
        echo "<p class='card-text my-5'><h4>Summary</h4>".$articles[$index]["summary"]."</p>";
        echo "<p class='card-text mb-5'><h4>Full Article</h4>".$articles[$index]["full_article"]."</p>";
        echo "<p class='card-text mb-5'><h4>Published on</h4>".$articles[$index]["publishing_date"]."</p>";
        echo "<a class='bg-primary text-light border border-primary rounded text-decoration-none p-2' href='".$_SERVER["PHP_SELF"]."?article_current=0'>Return</a></div></div>";
    }catch(Exception $e){
      $exc=$e->getMessage();
      $date = date('d.m.Y h:i:s');
      $log = $exc."   |  Date:  ".$date."\n";
      error_log("$log", 3, "assets/log-files/log.log");
    }
      ?>
    </div></div></div></body></html>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>




    