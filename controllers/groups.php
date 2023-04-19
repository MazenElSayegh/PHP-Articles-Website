<?php
require_once("../../vendor/autoload.php");


$groupsDB=new MySQLHandler("groups");
$current_index=isset($_GET["group_current"]) && is_numeric($_GET["group_current"])?$_GET["group_current"]:0;
$groups=$groupsDB->get_all_records_paginated(array(),$current_index);
$allGroups;
$groupsCount = count($groupsDB->get_all_records());
$next_index=$current_index + __RECORDS_PER_PAGE__ < $groupsCount?$current_index + __RECORDS_PER_PAGE__ :0;
$previous_index=$current_index - __RECORDS_PER_PAGE__ >0?$current_index - __RECORDS_PER_PAGE__:0;

if(isset($_POST['action']) && $_POST['action'] === "create") {
  try {
  $values = [
    "name" => $_POST['name'],
    "description" => $_POST['description'],
    "icon" => $_POST['icon'],
  ];
  if($_POST['name'] === '') {
    throw new Exception('Empty Group Name Field');
    }

  if($_POST['description'] === '') {
    throw new Exception('Empty Group description Field');
    }

    if($_POST['icon'] === '') {
      throw new Exception('Empty Group icon Field');
      }

      if(count($groupsDB->search("name", $_POST['name'])) > 0) {
        throw new Exception('Inserted a taken group name');
      }

  $groupsDB->save($values);
  header("Refresh:0; url=groups.php");
}
catch(Exception $e){
  $exc=$e->getMessage();
  $date = date('d.m.Y h:i:s');
  $log = $exc."   |  Date:  ".$date."\n";
  error_log("$log", 3, "../../assets/log-files/log.log");
}
}

if(isset($_POST['action']) && $_POST['action'] === "update") {
  try {

  $values = [
    "name" => $_POST['name'],
    "description" => $_POST['description'],
    "icon" => $_POST['icon'],
  ];

  if($_POST['name'] === '') {
    throw new Exception('Empty Group Name Field');
    }

  if($_POST['description'] === '') {
    throw new Exception('Empty Group description Field');
    }

    if($_POST['icon'] === '') {
      throw new Exception('Empty Group icon Field');
      }

  $groupsDB->update($values, $_POST['id']);
  header("Refresh:0; url=groups.php");
}
catch(Exception $e){
  $exc=$e->getMessage();
  $date = date('d.m.Y h:i:s');
  $log = $exc."   |  Date:  ".$date."\n";
  error_log("$log", 3, "../../assets/log-files/log.log");
}
}

if(isset($_GET['group_search'])){
  try {
    if($_GET['group_search'] === '') {
    throw new Exception('group search with empty field');
    }
  
  
  $arrOfProducts = [];
  $handler = mysqli_connect(__HOST__, __USER__, __PASS__, __DB__);
  $table = "groups";
  $column1 = "name";
  $column_value1 = $_GET['group_search'];
  $column2 = "description";
  $column_value2 = $_GET['group_search'];
  $sql = "select * from `$table` where `$column1` like  '%" . $column_value1 . "%' OR `$column2` like  '%" . $column_value2 . "%' ";
  $result = $handler -> query($sql);
  while($row = $result -> fetch_array(MYSQLI_ASSOC)) {
    $arrOfProducts[] = $row;
  }

  $groups = $arrOfProducts;
  if(count($arrOfProducts) == 0) {
    throw new Exception('group search not found');
  }

  $handler -> close();
}
  catch(Exception $e){
    $exc=$e->getMessage();
    $date = date('d.m.Y h:i:s');
    $log = $exc."   |  Date:  ".$date."\n";
    error_log("$log", 3, "../../assets/log-files/log.log");
  }
}


if(isset($_GET['group_delete'])){
  try {
    $index=isset($_GET["group_delete"])?$_GET["group_delete"]:"";
    $allGroups=$groupsDB->get_all_records();
  if($index>sizeof($allGroups)) {
    throw new Exception('Delete undefined group id');
  }
  $groupsDB->delete($allGroups[$_GET['group_delete']]['id']);
  header("Refresh:0; url=groups.php");
  }
  catch(Exception $e){
    $exc=$e->getMessage();
    $date = date('d.m.Y h:i:s');
    $log = $exc."   |  Date:  ".$date."\n";
    error_log("$log", 3, "../../assets/log-files/log.log");
  }
}

if(isset($_GET['group_edit'])){
  try {
  $index=isset($_GET['group_edit'])?$_GET['group_edit']:"";
  $allGroups=$groupsDB->get_all_records();
  if($index>sizeof($allGroups[0])) {
    throw new Exception('Edit undefined group id');
  }
  }
  catch(Exception $e){
    $exc=$e->getMessage();
    $date = date('d.m.Y h:i:s');
    $log = $exc."   |  Date:  ".$date."\n";
    error_log("$log", 3, "../../assets/log-files/log.log");
  }
}
?>