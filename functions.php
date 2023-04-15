<?php 
require_once 'config.php';
require_once 'models/DbHandler.php';
require_once 'models/MySQLHandler.php';
function login(){
    $conn= mysqli_connect(__HOST__,__USER__,__PASS__,__DB__);
// var_dump($_POST);
if(!$conn){
    echo 'conn failed';
}
if(isset($_POST['uname']) && isset($_POST['password'])){
    function validate($data){
        $data =trim($data);
        $data= stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }

    $uname= validate($_POST['uname']);
    $pass=validate($_POST['password']);
    if(empty($uname)){
        header("Location: index.php?error=User Name is req");
        exit();

    }elseif(empty($pass)){
        header("Location: index.php?error=Pass is req");
        exit();
    }else{
        $db= new MySQLHandler('users');
        $sql= "SELECT * FROM users WHERE user_name= '$uname' AND password='$pass'";
        $user=$db->get_results($sql);
        // var_dump($user);
        if(sizeof($user)==1){
            $_SESSION['user_name']=$user[0]['user_name'];
            $_SESSION['name']=$user[0]['name'];
            $_SESSION['password']=$user[0]['password'];
            // var_dump($_SESSION);
            header("Location: views/login/profile.php");
            exit();
        }else{
            header("Location: index.php?Incorrect username or password");
            exit();
        }
    }
}else{
    header("Location: login.php");
    exit();
}
}