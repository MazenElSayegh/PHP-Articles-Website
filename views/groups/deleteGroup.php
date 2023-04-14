<?php

require_once("./index.php");

if(isset($_POST['groupID']))
{
    $db->delete($_POST['groupID']);
}

?>