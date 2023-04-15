<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<?php

$current_index=isset($_GET["article_current"]) && is_numeric($_GET["article_current"])?$_GET["article_current"]:0;
$articles=$db->get_all_records_paginated(array(),$current_index);
$next_index=$current_index + __RECORDS_PER_PAGE__ < 16?$current_index + __RECORDS_PER_PAGE__ :0;
$previous_index=$current_index - __RECORDS_PER_PAGE__ >0?$current_index - __RECORDS_PER_PAGE__:12;
if(isset($_GET['article_search'])){
    $arrOfProducts = $db->search('title' , $_GET['article_search'] );
        $articles = $arrOfProducts;
    }
    if(isset($_GET['article_delete'])){
        $allArticles=$db->get_all_records();
        $db->delete($allArticles[$_GET['article_delete']]['id']);
        }
      /*  if(isset($_GET['update'])){
            db->update({'id'=>$id}, $id);
        }*/
if(isset($_POST['title'])){
  $db->save($_POST);
  echo "<meta http-equiv='refresh' content='0'>";
}

?>
<style>
    table, th, td {
  border: 1px solid;
  margin:5px;
  padding:20px;
}
th{
    background-color:cyan;
}
button {
    font-style: normal;
    height: 40px;
    width: 130px;
    box-sizing: border-box;
    border: transparent;
    border-radius: 60px;
    font-family: 'Raleway', sans-serif;
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.4em;
    color: #ffffff;
    background-color: black;
    margin-top: 30px;
    text-decoration: none;
    margin:10px;
  }
  input{
    height:50px;
    width:250px;
    background-color:aliceblue;
    border-radius:60px;
    border-style:solid;
    border-color:blue;
  }
  button a{
    color:white;
  }
  a:link { text-decoration: none;
          
        }
  button:hover {
    background-color: #303030;
  }
  #container{
    display:flex;
    flex-direction:column;
    justify-content:space-around;
    align-items:center;
  }
  #btns button{
    margin:30px;
  }
</style>
<?php
    echo "<div id=container><div id=formCont><form action=".$_SERVER['PHP_SELF']." method=GET>";
    echo "<input type=search name=article_search placeholder=Product Name>";
    echo "<button type=submit>Search</button></form></div>";?>
<div >
<table>
    <tr>
        <th>Title</th>
        <th>Publish Date</th>
        <th>Details</th>
        <th>Delete</th>
    </tr>
    <?php
    $index=$current_index;
    foreach($articles as $article){

        echo "<tr><td>".$article["title"]."</td>";
        echo "<td>".$article["publishing_date"]."</td>";
        echo "<td><a href='".$_SERVER["PHP_SELF"]."?article_id=".$index."'>view article</a></td>";
        echo "<td><a href='".$_SERVER["PHP_SELF"]."?article_delete=".$index."'>delete article</a></td></tr>";
        $index++;
    }
    echo "</table></div>";
    echo "<div id=btns>";
    echo "<button type=button><a href='".$_SERVER["PHP_SELF"]."?article_current=".$previous_index."'>Previous</a></button>";
    echo "<button type=button><a href='".$_SERVER["PHP_SELF"]."?article_current=".$next_index."'>Next</a></button></div></div>";
    ?>
  <h1 class="mt-5 mx-5">Create new article</h1>
  <form class='m-5' action='' method=POST enctype='multipart/form-data'>
  <div class="form-group">
    <label for="exampleFormControlInput1">Title</label>
    <input class="form-control" id="exampleFormControlInput1" placeholder="Title" name="title">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Summary</label>
    <input class="form-control" id="exampleFormControlInput1" placeholder="Summary" name="summary">
  </div>
  <div class="custom-file">
  <label class="custom-file-label" for="customFile">Choose image</label>
  <input type="file" class="custom-file-input form-control" id="customFile" name="image_path">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Article content</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="full_article" placeholder="Enter your content here"></textarea>
  </div>
  <button class="btn btn-primary" type="submit">Submit</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
