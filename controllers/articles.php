<?php

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
        $articles_table->delete($allArticles[$_GET['article_delete']]['id']);
        }
      /*  if(isset($_GET['update'])){
            db->update({'id'=>$id}, $id);
        }*/
if(isset($_POST['title'])){
  
  $articles_table->save($_POST);
  echo "<meta http-equiv='refresh' content='0'>";
}

?>