<?php

    require_once("vendor/autoload.php");
  
    $db_users = new MySQLHandler("users");
    if($db_users->connect()) {
   
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
                if(isset($_GET['delete'])) {
                    $id =(int) $_GET["delete"];
                    $db_users->delete($id);
                }
        }
        else if($_SERVER["REQUEST_METHOD"] == "POST"){
            if($_POST["action"]==="create"){
              
                $values = [
                    "name" => $_POST['user_name'],
                    "email" => $_POST['user_email'],
                    "mobile" => $_POST['user_phone'],
                    "user_name" => $_POST['user'],
                    "password" => $_POST['user_password'],
                    "group_id" => $_POST['user_group_name'],
                  ];
                $db_users->save($values);
                // $data = json_decode(file_get_contents('php://input'), true);
                // $db_users->save($data);
            }
           
        }
        $db_groups = new MySQLHandler("groups");
        if($db_groups->connect()) {
            require_once("views/users.php");
        }

    }

    else{
        die("Something went wrong please come back later");
    }
    
    