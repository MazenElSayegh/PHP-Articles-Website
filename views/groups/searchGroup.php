<?php

require_once("./config.php");
require_once("../../models/DbHandler.php");
require_once("../../models/MySQLHandler.php");

$db=new MySQLHandler("groups");

if($_POST['searchTerm'] == '')
{
    $result = $db->get_all_records();
    echo json_encode($result);
    return;
}

$nameSearch = $db->search("name",$_POST['searchTerm']);
$descriptionSearch = $db->search("description",$_POST['searchTerm']);

if(count($nameSearch) > 0) {
    echo json_encode($nameSearch);
}
else if (count($descriptionSearch) > 0) {
    echo json_encode($descriptionSearch);
}
else {
    echo "not found";
}

?>