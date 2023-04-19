<?php 
require_once("../vendor/autoload.php");

try {
    session_start();
    $conn= mysqli_connect(__HOST__, __USER__, __PASS__, __DB__);
    if(!$conn) {
        echo 'Connection failed';
    } else {
        if(isset($_POST['uname']) && isset($_POST['password'])) {
            function validate($data)
            {
                $data =trim($data);
                $data= stripslashes($data);
                $data=htmlspecialchars($data);
                return $data;
            }

            $uname= validate($_POST['uname']);
            $pass=validate($_POST['password']);
            if(empty($uname)) {
                header("Location: ../?error=Username is required");
                throw new Exception("User didn't write username");
            } elseif(empty($pass)) {
                header("Location: ../?error=Password is required");
                throw new Exception("User didn't write password");
            } else {
                $users_db= new MySQLHandler('users');
                $sql= "SELECT * FROM users WHERE user_name= '$uname' AND password='$pass'";
                $user=$users_db->get_results($sql);
                if(!isset($user[0])){
                    header("Location: ../?error=Incorrect username or password");
                    throw new Exception("No such user in database");
                }else{
                    $groups_db= new MySQLHandler('groups');
                $group=$groups_db->get_record_by_id($user[0]['group_id']);
                    $_SESSION['user_name']=$user[0]['user_name'];
                    $_SESSION['name']=$user[0]['name'];
                    $_SESSION['password']=$user[0]['password'];
                    $_SESSION['email']=$user[0]['email'];
                    $_SESSION['mobile']=$user[0]['mobile'];
                    $_SESSION['group']=$group[0]['name'];
                    $_SESSION['subscription_date']=$user[0]['subscription_date'];
                    header("Location: ../views/login/profile.php");
                    exit();
            }
                
            }
        } else {
            header("Location: ../");
            exit();
        }
    }
}catch(Exception $e){
    $exc=$e->getMessage();
      $date = date('d.m.Y h:i:s');
      $log = $exc."   |  Date:  ".$date."\n";
      error_log("$log", 3, "../assets/log-files/log.log");
}