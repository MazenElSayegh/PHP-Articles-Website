<?php

    require_once("../../vendor/autoload.php");
    $user_id = 0;
    $user_name = '';
    $user_email= '';
    $user_phone= '';
    $u_name = '';
    $user_group_id = 0;
    $search_name ="";
    $selected_group=0;
    $update= false;
    $search= false;
    $error='';
    
    $db_users = new MySQLHandler("users");
    if($db_users->connect()) {
        $db_groups = new MySQLHandler("groups");
        if($db_groups->connect()) {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
                if(isset($_GET['edit'])){
                    $id=$_GET['edit'];
                    $update=true;
                   $user= $db_users->get_record_by_id($id);
                   $user_id=$user[0]['id'];
                   $user_name = $user[0]['name'];
                   $user_email= $user[0]['email'];
                   $user_phone= $user[0]['mobile'];
                   $u_name = $user[0]['user_name'];
                   $user_group_id = $user[0]['group_id'];
                }
                else if(isset($_GET['delete'])) {
                    $id =(int) $_GET["delete"];
                    $db_users->delete($id);
                }
                else if(isset($_GET['group'])) {
                    // $id =(int) $_GET["group"];
                    $selected_group = intval($_GET['group']);
                    $search=true;
                }
        }
        else if($_SERVER["REQUEST_METHOD"] == "POST"){
            if($_POST["action"]==="create"){
                $users =$db_users->get_all_records_paginated(array());
                $flag =0;
                $email = $_POST["user_email"];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email format";
}else{
    try {
        foreach($users as $user) {

            if($_POST['user']===$user['user_name']) {
                $error = "this username has already been taken";
                $flag=1;
                throw new Exception(' username has already been taken');
                break;

            } elseif($_POST['user_email']===$user['email']) {
                $error = "this email has already been taken";
                $flag=1;
                throw new Exception(' email has already been taken');
                break;
            }
        }
    } catch(Exception $e) {
        $exc=$e->getMessage();
        $date = date('d.m.Y h:i:s');
        $log = $exc."   |  Date:  ".$date."\n";
        error_log("$log", 3, "../../assets/log-files/log.log");
    }

        var_dump($flag);
    if($flag==0) {
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
            }
            elseif($_POST["action"]==="update"){
                $id = intval($_POST['user_id']);
                $values = [
                    "name" => $_POST['user_name'],
                    "email" => $_POST['user_email'],
                    "mobile" => $_POST['user_phone'],
                    "user_name" => $_POST['user'],
                    "password" => $_POST['user_password'],
                    "group_id" => $_POST['user_group_name'],
                  ];
                 $db_users->update($values,$id); 

            }
            elseif($_POST["action"]==="search"){
                $search_name = $_POST['search_name'];
                $search=true;
            }
            elseif($_POST["action"]==="filter"){
                $selected_group = intval($_POST['selected_group']);
                $search=true;
            }
           
        }
        // $db_groups = new MySQLHandler("groups");
        
       
        }

        

    }

    else{
        die("Something went wrong please come back later");
    }
    
    
