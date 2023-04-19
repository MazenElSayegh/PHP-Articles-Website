<?php
require_once ('../main/head.php');
require_once ('../main/sidebar.php');
require("../../vendor/autoload.php");
require_once("../../controllers/articles.php");
?>

  <div class="wrapper">
    <div class="article-img">
    <?php
    try{
    $index=isset($_GET["article_id"])?$_GET["article_id"]:"";
    var_dump($index);
    $articles=$articles_table->get_all_records();
    $art=sizeof($articles);
    var_dump($art);
    if($index>sizeof($articles)-1){
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
      error_log("$log",3, "../../assets/log-files/log.log");
      header("Location: ./articles.php");
    }
      ?>
    </div>
  </div>
</div>




<?php
    require_once ('../main/footer.php'); ?>