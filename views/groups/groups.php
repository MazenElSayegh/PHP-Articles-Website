<?php 
session_start();
try {
    if(isset($_SESSION['user_name'])) {
        require_once("../../controllers/groups.php");
        require_once('../main/head.php');
        require_once('../main/sidebar.php');
        ?>

<div class="mainContainer mt-5 ">
    <div class="container">

      <?php
              echo "<div id=container class= 'm-2 py-2'><div id=formCont><form action=".$_SERVER['PHP_SELF']." method=GET>";
        echo "<input class='mt-3 mb-2 border border-1 border-primary rounded pl-1' type=search name=group_search placeholder=Group Name>";
        echo "<button class='bg-primary border border-1 border-primary rounded text-light mx-4' type=submit>Search</button></form></div>";?>

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


        if(count($groups) > 0) {
            foreach($groups as $group) {
                if($group["is_deleted"]==0) {
                    echo "<tr><td>".$group["id"]."</td>";
                    echo "<td><i class='fa " .$group["icon"]. "'></i></td>";
                    echo "<td><a href='../users/users.php?group=".$group["id"]."'>".$group["name"]."</a></td>";
                    echo "<td>".$group["description"]."</td>";
                    echo "<td><a class='bg-primary text-light border border-primary rounded text-decoration-none p-1' href='".$_SERVER["PHP_SELF"]."?group_edit=".$index."'>Edit Group</a></td>";
                    echo "<td><a class='bg-danger text-light border border-danger rounded text-decoration-none p-1' href='".$_SERVER["PHP_SELF"]."?group_delete=".$index."'>Delete group</a></td></tr>";
                }
                $index++;
            }
        } else {
            echo "<tr><td>No Group found</td></tr>";
        }

        ?>
        </tbody>
        <a href=""></a>
      </table>
      <?php
      echo "<div id=btns>";
        echo "<a class='bg-primary text-light p-2 mx-4 border border-primary rounded text-decoration-none' href='".$_SERVER["PHP_SELF"]."?group_current=".$previous_index."'>Previous</a>";
        echo "<a class='bg-primary text-light p-2 mx-4 border border-primary rounded text-decoration-none' href='".$_SERVER["PHP_SELF"]."?group_current=".$next_index."'>Next</a></div>";
        ?>
    </div>


    <div class="container">
      <?php
        if (!isset($_GET['group_edit'])) {
            echo '<h3 class=" text-light text-center bg-success mt-5 mx-5 py-2">Create new Group</h3>';
        } else {
            echo '<h3 class=" text-light text-center bg-primary mt-5 mx-5 py-2">Edit Group</h3>';
        }
        ?>
      <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">

      <div class="form-group">
          <input
            type="text"
            class="form-control groupIDInput"
            id="exampleInputText1"
            aria-describedby="emailHelp"
            placeholder="Enter Group Icon Class"
            name="id"
            value = "<?php if (isset($_GET['group_edit'])  && $_GET['group_edit'] < count($groups)) {
                echo $allGroups[$_GET['group_edit']]['id'];
            } ?>"
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
            value = "<?php if (isset($_GET['group_edit'])  && $_GET['group_edit'] < count($groups)) {
                echo $allGroups[$_GET['group_edit']]['icon'];
            } ?>"
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
            value = "<?php if (isset($_GET['group_edit'])  && $_GET['group_edit'] < count($groups)) {
                echo $allGroups[$_GET['group_edit']]['name'];
            } ?>"
            required
          />
          <?php
            if(isset($_POST['name']) && count($groupsDB->search("name", $_POST['name'])) > 0) {
                echo '<p class="text-danger">Name is Taken</p>';
            }

        ?>
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Group Description</label>
          <textarea
            class="form-control groupDescriptionInput"
            id="exampleFormControlTextarea1"
            rows="3"
            name="description"
            required
          ><?php if (isset($_GET['group_edit'])  && $_GET['group_edit'] < count($groups)) {
              echo $allGroups[$_GET['group_edit']]['description'];
          } ?></textarea>
        </div>

        <?php
        if (!isset($_GET['group_edit'])) {
            echo '<button class="btn btn-success" value="create" name="action">Create</button>';
        } else {
            echo '<button class="btn btn-primary updateBtn" value="update" name="action">Update</button>';
        }

        ?>
      </form>
    </div>
    </div>

    <?php
    require_once('../main/footer.php');
    } else {
        header("Location: ../../");
        throw new Exception('unauthorized access for groups');
    }
}catch(Exception $e){
  $exc=$e->getMessage();
  $date = date('d.m.Y h:i:s');
  $log = $exc."   |  Date:  ".$date."\n";
  error_log("$log",3, "../../assets/log-files/log.log");
}?>