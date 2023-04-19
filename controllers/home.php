<?php
require_once ('../../vendor/autoload.php');
session_start();
$groups_db= new MySQLHandler('groups');
$users_db=new MySQLHandler('users');
var_dump($groups_db->get_all_records());
$dataPoints = array( 
	array("y" => 3373.64, "label" => "Germany" ),
	array("y" => 2435.94, "label" => "France" ),
	array("y" => 1842.55, "label" => "China" ),
	array("y" => 1828.55, "label" => "Russia" ),
	array("y" => 1039.99, "label" => "Switzerland" ),
	array("y" => 765.215, "label" => "Japan" ),
	array("y" => 612.453, "label" => "Netherlands" )
);