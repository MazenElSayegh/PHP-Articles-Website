<?php
try{
  require("../../vendor/autoload.php");
  
$articles_table=new MySQLHandler("articles");
if(isset($_GET["article_id"]) && is_numeric($_GET["article_id"])){
  require_once("./single.php");
  die();
}

$current_index=isset($_GET["article_current"]) && is_numeric($_GET["article_current"])?$_GET["article_current"]:0;
$articles=$articles_table->get_all_records_paginated(array(),$current_index);
$next_index=$current_index + __RECORDS_PER_PAGE__ < 16?$current_index + __RECORDS_PER_PAGE__ :0;
$previous_index=$current_index - __RECORDS_PER_PAGE__ >0?$current_index - __RECORDS_PER_PAGE__:12;
if(isset($_GET['article_search'])){
    $arrOfProducts = $articles_table->search('title' , $_GET['article_search'] );
        $articles = $arrOfProducts;
    }
    if(isset($_GET['article_delete'])){
        $allArticles=$articles_table->get_all_records();
        if($_GET['article_delete']>sizeof($allArticles)-1){
          throw new Exception('deleting unidentified article ID');
        }
        $path=$allArticles[$_GET['article_delete']]['image_path'];
        if(isset($_GET['article_delete']['image_path'])){
          unlink("../../images/$path");
        }
        $articles_table->delete($allArticles[$_GET['article_delete']]['id']);
         header("Location: ../articles/articles.php");
        }
if(isset($_POST['title'])){
  
  $articles_table->save($_POST);
  echo "<meta http-equiv='refresh' content='0'>";
}
}catch(Exception $e){
  $exc=$e->getMessage();
  $date = date('d.m.Y h:i:s');
  $log = $exc."   |  Date:  ".$date."\n";
  error_log("$log", 3, "../../assets/log-files/log.php");
}

?>