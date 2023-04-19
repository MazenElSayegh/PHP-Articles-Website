<?php
require_once ('../../vendor/autoload.php');
$groups_db= new MySQLHandler('groups');
$users_db=new MySQLHandler('users');
$groups=$groups_db->get_all_records();
$dataPoints=[];
$groupName="";
foreach($groups as $group){
            $users_group=$users_db->search('group_id',$group['id']);
            array_push($dataPoints,array("y" => sizeof($users_group), "label" => $group['name'] ));
}