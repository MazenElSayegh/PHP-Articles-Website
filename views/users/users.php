<?php
session_start();
if(!isset($_SESSION['user_name'])){
  header("Location: ../../");
  exit();
}else{
try {
    if($_SESSION['group']=='Admins') {
        require_once('../../controllers/users.php');
        $recordsNumber =($db_users->get_records_count());
        $current_index = isset($_GET["next"]) && is_numeric($_GET["next"]) ? (int)$_GET["next"] : 0;
        $next_index = (($current_index + __RECORDS_PER_PAGE__) < $recordsNumber[0]["count(*)"]) ? $current_index + __RECORDS_PER_PAGE__ : 0;
        $prev_index = (($current_index -  __RECORDS_PER_PAGE__)>0) ? ($current_index -  __RECORDS_PER_PAGE__) : 0;

        require_once('../../views/main/head.php');
        require_once('../../views/main/sidebar.php');
        ?>
<div class="mainContainer m-5">
    <div class="container">
      <div class="row">
      <form action="users.php" method="POST" class="col-4">
          <div class=" form-group mt-4  ">
              <input
                  type="text"
                  class="border border-1 border-primary rounded pl-1"
                  id="exampleInputText1"
                  aria-describedby="emailHelp"
                  placeholder="Search by name"
                  name="search_name"
              />
              <button class="bg-primary border border-1 border-primary rounded text-light" value="search" name="action">
                   Search
              </button>
          </div>
      </form>

      <form action="users.php" method="POST" class="col-4">
            <div class=" form-group mt-4  ">
                 <select name="selected_group" class=" border border-1 border-primary rounded text-secondary pl-1">
                    <?php
                             $groups = $db_groups->get_all_records_paginated(array());
        echo '<option>Filter by group name</option>';
        foreach ($groups as $group) {
            if($group["is_deleted"]==0) {
                echo "<option value=".$group["id"].">".$group["name"]."</option>";
            }
        }
        ?>
                  </select>
                  <button class="bg-primary border border-1 border-primary rounded text-light" value="filter" name="action">
                       filter
                  </button>
             </div>
      </form>

      </div> 
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">User Name</th>
            <th scope="col">Group Name</th>
            <th scope="col">Subscription Date</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody class="groupTableBody">

        <?php
          if($search && !empty($search_name)) {
              $users=$db_users->search('name', $search_name);
          } elseif($search && $selected_group!=0) {
              $users=$db_users->search('group_id', $selected_group);
          } else {
              $users =$db_users->get_all_records_paginated(array(), $current_index);
          }

          foreach($users as $user) {
              if($user["is_deleted"]==0) {
                  $group = $db_groups->get_record_by_id($user['group_id']);
                  echo '
            <tr>
              <td scope="row" class="groupID">' . $user['id'] . '</td>
              <td scope="row" class="groupID">' . $user['name'] . '</td>
              <td scope="row" class="groupID">' . $user['email'] . '</td>
              <td scope="row" class="groupID">' . $user['mobile'] . '</td>
              <td scope="row" class="groupID">' . $user['user_name'] . '</td>
              <td scope="row" class="groupID">' . $group[0]['name'] . '</td>
              <td scope="row" class="groupID">' . $user['subscription_date'] . '</td>
              <td>
              
              <a  class="bg-primary text-light p-2 border border-primary rounded" href ='.$_SERVER["PHP_SELF"].'?edit='.$user['id'].' >Edit</a>
              <a  class="bg-danger text-light p-2 border border-danger rounded" href ='.$_SERVER["PHP_SELF"].'?delete='.$user['id'].' >Delete</a>  
              </td>
            </tr>
          ';
              }
          }

        ?>
        </tbody>
      </table>
      <div class="row">
        <div class="col-5"></div>
      <div class="data">
            <a class="bg-primary text-light p-2 border border-primary rounded" href="<?php echo "users.php?next=".$prev_index  ?>" >Prev</a>
            <a  class="bg-primary text-light p-2 border border-primary rounded" href="<?php echo "users.php?next=".$next_index  ?>" >Next</a>
      </div>
      </div>
    </div>
    
    <div class="container">
      <div class="row">
      <?php
              echo '<div class = "col" >';
        if(!$update) {
            echo '<h3 class = " text-light text-center bg-success mt-4 py-2">Create New User</h3>';
        } else {
            echo '<h3 class = "text-light text-center bg-primary mt-4 py-2">Update Existing User </h3>';
        }
        echo '</div>';
        ?>

      </div>
       <?php
         if(empty(!$error)) {

             echo  '<div class="alert alert-danger w-100 p-2 my-3 text-center ">';
             echo $error;
             echo '</div>';
         }
        ?>
      <form action="users.php" method="POST">

      <div class="form-group">
          <input
            type="text"
            class="form-control groupIDInput"
            id="exampleInputText1"
            aria-describedby="emailHelp"
            placeholder="Enter Group Icon Class"
            name="user_id"
            value="<?php echo $user_id ?>"
            hidden
          />
        </div>

        <div class="form-group">
          <label for="exampleInputText1">Name</label>
          <input
            type="text"
            class="form-control groupIconInput"
            id="exampleInputText1"
            aria-describedby="emailHelp"
            placeholder="Enter Your Name"
            name="user_name"
            value="<?php echo $user_name ?>"
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
            value="<?php echo $user_phone ?>"
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
            value="<?php echo  $u_name ?>"
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
            value="<?php echo  $user_email ?>"
            required
          />
        </div>

        <div class="form-group">
          <label for="exampleInputText1">Password</label>
          <input
            type="password"
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

                
                <?php 
                  $groups = $db_groups->get_all_records_paginated(array());
                  if($user_group_id!=0) {
                    $group = $db_groups->get_record_by_id($user_group_id);
                    echo "<option value=".$user_group_id.">".$group[0]["name"]."</option>"; 
                    foreach ($groups as $group){
                      if($group["is_deleted"]==0){
                        if($user_group_id == $group["id"]) {
                            continue;
                          }
                        echo "<option value=".$group["id"].">".$group["name"]."</option>";
                        }
                    }
                  }else{
                    echo '<option></option>';
                    foreach ($groups as $group){
                      if($group["is_deleted"]==0){
                        echo "<option value=".$group["id"].">".$group["name"]."</option>";
                      } 
                    }
                  
                  }
                  
                  
                ?>
            </select>
        </div>
         <?php if(!$update) {
             echo '<button class="btn btn-success" value="create" name="action">
                   Create
                  </button>';
         } else {
             echo '<button class="btn btn-primary updateBtn" value="update" name="action">
                Update
              </button>';
         }
        ?>
           
      </form>
    </div>
</div>
    <?php
    require_once('../../views/main/footer.php');
    } else {
      throw new Exception('accessing users for unauthorized user');
    }
}catch(Exception $e){
  $exc=$e->getMessage();
  $date = date('d.m.Y h:i:s');
  $log = $exc."   |  Date:  ".$date."\n";
  error_log("$log",3, "../../assets/log-files/log.log");
  header("Location: ../login/profile.php");
}
 }
  ?>
