<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
require_once('listing.php');
session_start();

if (!$_SESSION['loggedin']) {
    //redirect to login
    header("Location: "."http://".$_SERVER['HTTP_HOST']."index.php");
    die();
}

/*
echo $_POST["title"];
echo $_POST["type"];
echo $_POST["desc"];
echo $_SESSION["userId"];
*/

$listing = new Listing;

$listing->populateListing($_SESSION['userId'], $_POST['title'], $_POST['desc'], $_POST['type']);

// and insert into 'users' table
if ($listing->addToDB("oniddb.cws.oregonstate.edu", "lindenba-db", "ntVB3yI2RNUm7xHg", "lindenba-db")) {
    $_SESSION['error'] = true;
    $_SESSION['message'] = "Failed to insert listing";
} else {
    $_SESSION['success'] = true;
    $_SESSION['message'] = "Listing insertion succeeded";
}

header("refresh:0;url=main.php");
?>