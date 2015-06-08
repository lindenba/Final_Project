<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
require_once('editListing.php');
require_once("login.php");

$ID = $_POST['ID'];

$update = new Edit();

unset($_POST['type']);
unset($_POST['ID']);

$update->updateListing($host, $user, $passord, $database, $ID, $_POST);

//return to browse parts
header('Location: display.php');

?>