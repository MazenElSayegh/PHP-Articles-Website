<?php
require_once("./config.php");
require_once("../../models/DbHandler.php");
require_once("../../models/MySQLHandler.php");
?>


<?php

$db=new MySQLHandler("groups");



if(isset($_POST['action']) && $_POST['action'] === "create") {
  $values = [
    "name" => $_POST['name'],
    "description" => $_POST['description'],
    "icon" => $_POST['icon'],
  ];
  $db->save($values);
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
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"
            ><i class="fa fa-search" aria-hidden="true"></i
          ></span>
        </div>
        <input
          type="text"
          class="form-control groupSearchInput"
          placeholder="Search by name or description"
          aria-label="Username"
          aria-describedby="basic-addon1"
        />
      </div>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Icon</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody class="groupTableBody">

        <?php
          $allGroups = $db->get_all_records();

          foreach($allGroups as $group) {
            echo '
            <tr>
              <th scope="row" class="groupID">' . $group['id'] . '</th>
              <td class="groupIcon">' . '<i class="fa ' . $group['icon'] . '" aria-hidden="true"></i>' . '</td>
              <td class="groupName">' . $group['name'] . '</td>
              <td class="groupDescription">' . $group['description'] . '</td>
              <td>
                <button type="button" class="btn btn-primary editBtn">Edit</button>
                <button type="button" class="btn btn-danger deleteBtn">Delete</button>
              </td>
            </tr>
          ';
        }

        ?>
        </tbody>
      </table>
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
          ></textarea>
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
