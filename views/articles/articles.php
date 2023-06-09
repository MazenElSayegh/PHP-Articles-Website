<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<?php
session_start();
try{
if(!isset($_SESSION['user_name'])){
  header("Location: ../../");
  throw new Exception('unauthorized access for articles');
}else{
  if($_SESSION['group']=='Admins'||$_SESSION['group']=='Editors'){

    require_once ('../main/head.php');
    require_once ('../main/sidebar.php');

    require_once("../../controllers/articles.php");
  
    echo "<body class='p-5'><div id=container class= 'm-5 py-5'><div id=formCont><form action=".$_SERVER['PHP_SELF']." method=GET>";
    echo "<input type=search name=article_search class='mb-2 border border-1 border-primary rounded pl-1' placeholder=Product Name>";
    echo "<button type=submit class='bg-primary border border-1 border-primary rounded text-light mx-4'>Search</button></form></div>";
    ?>
  

<table class="table">
  <thead class="thead table-dark">
    <tr>
        <th scope="col">Title</th>
        <th scope="col">Publish Date</th>
        <th scope="col">Details</th>
        <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $index=$current_index;
    if (count($articles)>0){
    foreach($articles as $article){
        if($article["is_deleted"]==0){
        echo "<div class='m-4 p-7'>";
        echo "<tr class='m-4 p-5'><td>".$article["title"]."</td>";
        echo "<td>".$article["publishing_date"]."</td>";
        echo "<td><a class='bg-primary text-light border border-primary rounded text-decoration-none p-1' href='".$_SERVER["PHP_SELF"]."?article_id=".$index."'>view article</a></td>";
        echo "<td><a class='bg-danger text-light border border-danger rounded text-decoration-none p-1' href='".$_SERVER["PHP_SELF"]."?article_delete=".$index."'>delete article</a></td></tr></div>";
      }
      $index++;
    }
  }
    echo "</tbody></table>";
    echo "<div id=btns class='d-inline-flex flex-row justify-content-between align-items-center'>";
    echo "<a class='bg-primary text-light p-2 mx-4 border border-primary rounded text-decoration-none' href='".$_SERVER["PHP_SELF"]."?article_current=".$previous_index."'>Previous</a>";
    echo "<a class='bg-primary text-light p-2 mx-4 border border-primary rounded text-decoration-none' href='".$_SERVER["PHP_SELF"]."?article_current=".$next_index."'>Next</a></div></div>";
    ?>
  <h3 class=" text-light text-center bg-success mt-5 mx-5 py-2">Create new article</h3>
  <form class='m-5' action='' method='POST' enctype='multipart/form-data'>
  <div class="form-group mt-4">
    <label for="exampleFormControlInput1">Title</label>
    <input class="form-control" id="exampleFormControlInput1" placeholder="Title" name="title">
  </div>
  <div class="form-group mt-4">
    <label for="exampleFormControlInput1">Summary</label>
    <input class="form-control" id="exampleFormControlInput1" placeholder="Summary" name="summary">
  </div>
  <div class="form-group mt-4">
  <label class="custom-file-label" for="exampleFormControlInput1">Choose image</label>
  <input type="file" class="custom-file-input form-control" id="customFile" name="image_path">
  </div>
  <div class="form-group mt-4">
    <label for="exampleFormControlTextarea1">Article content</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="full_article" placeholder="Enter your content here"></textarea>
  </div>
  <button class="btn btn-primary mt-4" type="submit">Submit</button>
</form>
<?php
    require_once ('../main/footer.php'); 
  }
  else{
    header("Location: ../login/profile.php");
    throw new Exception('unauthorized access for articles');
  }
}
}catch(Exception $e){
  $exc=$e->getMessage();
  $date = date('d.m.Y h:i:s');
  $log = $exc."   |  Date:  ".$date."\n";
  error_log("$log",3, "../../assets/log-files/log.php");
}?>

    