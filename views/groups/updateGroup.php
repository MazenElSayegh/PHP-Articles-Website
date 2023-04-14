<?php

require_once("./index.php");

if(isset($_POST['groupID']))
{

    $updatedValues = [
        'icon' => $_POST['groupIcon'],
        'name' => $_POST['groupName'],
        'description' => $_POST['groupDescription']
    ];

    $db->update($updatedValues, $_POST['groupID']);
}

?>