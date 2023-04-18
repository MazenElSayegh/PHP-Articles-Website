<?php
require_once("./config.php");
require_once("../../models/DbHandler.php");
require_once("../../models/MySQLHandler.php");


$groupsDB=new MySQLHandler("groups");
$current_index=isset($_GET["group_current"]) && is_numeric($_GET["group_current"])?$_GET["group_current"]:0;
$groups=$groupsDB->get_all_records_paginated(array(),$current_index);
$allGroups;
$groupsCount = count($groupsDB->get_all_records());
$next_index=$current_index + __RECORDS_PER_PAGE__ < $groupsCount?$current_index + __RECORDS_PER_PAGE__ :0;
$previous_index=$current_index - __RECORDS_PER_PAGE__ >0?$current_index - __RECORDS_PER_PAGE__:0;

if(isset($_POST['action']) && $_POST['action'] === "create") {
  $values = [
    "name" => $_POST['name'],
    "description" => $_POST['description'],
    "icon" => $_POST['icon'],
  ];
  $groupsDB->save($values);
  header("Refresh:0; url=groups.php");
}

if(isset($_POST['action']) && $_POST['action'] === "update") {
  $values = [
    "name" => $_POST['name'],
    "description" => $_POST['description'],
    "icon" => $_POST['icon'],
  ];
  $groupsDB->update($values, $_POST['id']);
  header("Refresh:0; url=groups.php");
}

if(isset($_GET['group_search'])){
  $arrOfProducts;
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

  $handler -> close();
}
if(isset($_GET['group_delete'])){
  $allGroups=$groupsDB->get_all_records();
  $groupsDB->delete($allGroups[$_GET['group_delete']]['id']);
  header("Refresh:0; url=groups.php");
}

if(isset($_GET['group_edit'])){
  $allGroups=$groupsDB->get_all_records();
}
?>