<?php
require_once("vendor/autoload.php");
session_start();
//require_once("views/login/login.php");


$articles_table=new MySQLHandler("articles");

if(isset($_GET["article_id"]) && is_numeric($_GET["article_id"])){
    require_once("views/articles/single.php");
}else{
    require_once("views/articles/articles.php");
}
