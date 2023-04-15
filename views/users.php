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
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
      integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
      crossorigin="anonymous"
      defer
    ></script>
    <script src="/Articles_project/PHP-Articles-Website/Utiles/script.js" defer></script>
    <title>Users</title>
  </head>
  <body>
    <div class="container">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"
            ><i class="fa fa-search" aria-hidden="true"></i
          ></span>
        </div>
        <!-- //search -->
        <input
          type="text"
          class="form-control groupSearchInput"
          placeholder="Search by name or description"
          aria-label="Username"
          aria-describedby="basic-addon1"
        />
      </div>
      <button type="button" class="btn btn-primary editBtn " id="btn">Create</button>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody class="groupTableBody">

        <?php
          $users =$db_users->get_all_records_paginated(array());

          foreach($users as $user) {
            echo '
            <tr>
              <td scope="row" class="groupID">' . $user['id'] . '</td>
              <td scope="row" class="groupID">' . $user['name'] . '</td>
              <td scope="row" class="groupID">' . $user['email'] . '</td>
              <td scope="row" class="groupID">' . $user['mobile'] . '</td>
              <td>
              
              <a  class="bg-primary text-light p-2  border border-primary rounded" href ="#" >View</a>
              <a  class="bg-danger text-light p-2 border border-danger rounded" href ='.$_SERVER["PHP_SELF"].'?delete='.$user['id'].' >Delete</a>  
              </td>
            </tr>
          ';
        }

        ?>
        </tbody>
      </table>
    </div>

    <div class="container">
      <form action="index.php" method="POST"  id="user_form">

      <!-- <div class="form-group">
          <input
            type="text"
            class="form-control groupIDInput"
            id="exampleInputText1"
            aria-describedby="emailHelp"
            placeholder="Enter Group Icon Class"
            name="id"
            hidden
          />
        </div> -->

        <div class="form-group">
          <label for="exampleInputText1">Name</label>
          <input
            type="text"
            class="form-control groupIconInput"
            id="exampleInputText1"
            aria-describedby="emailHelp"
            placeholder="Enter Your Name"
            name="user_name"
            required
          />
        </div>

        <div class="form-group">
          <label for="exampleInputText1">Phone Number</label>
          <input
            type="text"
            class="form-control groupNameInput"
            id="exampleInputText1"
            aria-describedby="emailHelp"
            placeholder="Enter Your Phone"
            name="user_phone"
            required
          />
        </div>

        <div class="form-group">
          <label for="exampleInputText1">User Name</label>
          <input
            type="text"
            class="form-control groupNameInput"
            id="exampleInputText1"
            aria-describedby="emailHelp"
            placeholder="Enter Your User Name"
            name="user"
            required
          />
        </div>

        <div class="form-group">
          <label for="exampleInputText1">Email</label>
          <input
            type="text"
            class="form-control groupNameInput"
            id="exampleInputText1"
            aria-describedby="emailHelp"
            placeholder="Enter Your Email"
            name="user_email"
            required
          />
        </div>

        <div class="form-group">
          <label for="exampleInputText1">Password</label>
          <input
            type="text"
            class="form-control groupNameInput"
            id="exampleInputText1"
            aria-describedby="emailHelp"
            placeholder="Enter Your Password"
            name="user_password"
            required
          />
        </div>
        
        <div class="form-group">
            <label for="exampleFormControlTextarea1" class="form-label">Select Group</label>
            <select name="user_group_name" class="form-control">
                <option></option>
                <?php 
                $groups = $db_groups->get_all_records_paginated(array());
                foreach ($groups as $group){
                    echo "<option value=".$group["id"].">".$group["name"]."</option>";
                    
                }
                
                ?>
            </select>
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