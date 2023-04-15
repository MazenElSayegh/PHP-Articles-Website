<?php
require_once("./config.php");
require_once("../../models/DbHandler.php");
require_once("../../models/MySQLHandler.php");
?>


<?php

$db=new MySQLHandler("groups");

$current_index=isset($_GET["group_current"]) && is_numeric($_GET["group_current"])?$_GET["group_current"]:0;
$groups=$db->get_all_records_paginated(array(),$current_index);
$allGroups;
$next_index=$current_index + __RECORDS_PER_PAGE__ < 16?$current_index + __RECORDS_PER_PAGE__ :0;
$previous_index=$current_index - __RECORDS_PER_PAGE__ >0?$current_index - __RECORDS_PER_PAGE__:12;

if(isset($_POST['action']) && $_POST['action'] === "create") {
  $values = [
    "name" => $_POST['name'],
    "description" => $_POST['description'],
    "icon" => $_POST['icon'],
  ];
  $db->save($values);
}

if(isset($_POST['action']) && $_POST['action'] === "update") {
  $values = [
    "name" => $_POST['name'],
    "description" => $_POST['description'],
    "icon" => $_POST['icon'],
  ];
  $db->update($values, $_POST['id']);
}

if(isset($_GET['group_search'])){
  $arrOfProducts = $db->search('name' , $_GET['group_search'] );
  $groups = $arrOfProducts;
}
if(isset($_GET['group_delete'])){
  $allGroups=$db->get_all_records();
  $db->delete($allGroups[$_GET['group_delete']]['id']);
}

if(isset($_GET['group_edit'])){
  $allGroups=$db->get_all_records();
}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="style.css" />

    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
      defer
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
      integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
      crossorigin="anonymous"
      defer
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
      integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
      crossorigin="anonymous"
      defer
    ></script>
    <script src="./logic.js" defer></script>
    <title>Groups</title>
  </head>
  <body>
    <div class="container">

      <?php
      echo "<div id=container><div id=formCont><form action=".$_SERVER['PHP_SELF']." method=GET>";
      echo "<input type=search name=group_search placeholder=Product Name>";
      echo "<button type=submit>Search</button></form></div>";?>

      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Icon</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody class="groupTableBody">

        <?php
          $index=$current_index;


          foreach($groups as $group){
            echo "<tr><td>".$group["id"]."</td>";
            echo "<td><i class='fa " .$group["icon"]. "'></i></td>";
            echo "<td>".$group["name"]."</td>";
            echo "<td>".$group["description"]."</td>";
            echo "<td><a href='".$_SERVER["PHP_SELF"]."?group_edit=".$index."'>edit group</a></td>";
            echo "<td><a href='".$_SERVER["PHP_SELF"]."?group_delete=".$index."'>delete group</a></td></tr>";
            $index++;
        }

        ?>
        </tbody>
        <a href=""></a>
      </table>
      <?php
      echo "<div id=btns>";
      echo "<button type=button><a href='".$_SERVER["PHP_SELF"]."?group_current=".$previous_index."'>Previous</a></button>";
      echo "<button type=button><a href='".$_SERVER["PHP_SELF"]."?group_current=".$next_index."'>Next</a></button></div>";
      ?>
    </div>


    <div class="container">
      <form action="/projects/PHP-Articles-Website/views/groups/index.php" method="POST">

      <div class="form-group">
          <input
            type="text"
            class="form-control groupIDInput"
            id="exampleInputText1"
            aria-describedby="emailHelp"
            placeholder="Enter Group Icon Class"
            name="id"
            value = "<?php if (isset($_GET['group_edit'])) echo $allGroups[$_GET['group_edit']]['id'] ?>"
            hidden
          />
        </div>

        <div class="form-group">
          <label for="exampleInputText1">Group Icon</label>
          <input
            type="text"
            class="form-control groupIconInput"
            id="exampleInputText1"
            aria-describedby="emailHelp"
            placeholder="Enter Group Icon Class"
            name="icon"
            value = "<?php if (isset($_GET['group_edit'])) echo $allGroups[$_GET['group_edit']]['icon'] ?>"
            required
          />
        </div>

        <div class="form-group">
          <label for="exampleInputText1">Group Name</label>
          <input
            type="text"
            class="form-control groupNameInput"
            id="exampleInputText1"
            aria-describedby="emailHelp"
            placeholder="Enter Group Name"
            name="name"
            value = "<?php if (isset($_GET['group_edit'])) echo $allGroups[$_GET['group_edit']]['name'] ?>"
            required
          />
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Group Description</label>
          <textarea
            class="form-control groupDescriptionInput"
            id="exampleFormControlTextarea1"
            rows="3"
            name="description"
            required
          ><?php if (isset($_GET['group_edit'])) echo $allGroups[$_GET['group_edit']]['description'] ?></textarea>
        </div>
        <button class="btn btn-success" value="create" name="action">
          Create
        </button>
        <button class="btn btn-primary updateBtn" value="update" name="action">
          Update
        </button>
      </form>
    </div>
  </body>
</html>
