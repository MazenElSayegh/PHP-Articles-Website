<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

<?php
    require_once("controllers/articles.php");
    echo "<div id=container class='d-inline-flex flex-column justify-content-center align-items-center m-5'><div id=formCont><form action=".$_SERVER['PHP_SELF']." method=GET>";
    echo "<input type=search name=article_search class='border border-1 border-primary rounded pl-1' placeholder=Product Name>";
    echo "<button type=submit class='bg-primary border border-1 border-primary rounded text-light mx-4'>Search</button></form></div>";
    ?>
  
<div class="d-inline-flex flex-row justify-content-around align-items-center">
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
    foreach($articles as $article){
        echo "<div class='m-4 p-7'>";
        echo "<tr class='m-4 p-5'><td>".$article["title"]."</td>";
        echo "<td>".$article["publishing_date"]."</td>";
        echo "<td><a class='bg-primary text-light border border-primary rounded text-decoration-none p-1' href='".$_SERVER["PHP_SELF"]."?article_id=".$index."'>view article</a></td>";
        echo "<td><a class='bg-danger text-light border border-danger rounded text-decoration-none p-1' href='".$_SERVER["PHP_SELF"]."?article_delete=".$index."'>delete article</a></td></tr></div>";
        $index++;
    }
    echo "</tbody></table></div>";
    echo "<div id=btns class='d-inline-flex flex-row justify-content-between align-items-center'>";
    echo "<a class='bg-dark text-light p-2 mx-4 border border-dark rounded text-decoration-none' href='".$_SERVER["PHP_SELF"]."?article_current=".$previous_index."'>Previous</a>";
    echo "<a class='bg-dark text-light p-2 mx-4 border border-dark rounded text-decoration-none' href='".$_SERVER["PHP_SELF"]."?article_current=".$next_index."'>Next</a></div></div>";
    ?>
  <h1 class="mt-5 mx-5">Create new article</h1>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
