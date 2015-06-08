<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
require_once('editListing.php');
//session_start();

$ID = $_POST['ID'];

$delete = new Edit();

$delete->removeItem($host, $user, $passord, $database, $ID);

$_SESSION['success'] = true;
$_SESSION['message'] = "Delete successful";

//return to main
header('Location: main.php');

?>