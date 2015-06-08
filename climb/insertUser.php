<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
require_once("addUser.php");
session_start();

// check to see if uname already exists

// if yes, redirect to register page

// if not, make new User object from $_POST fields
$person = new User;

$person->populateUser($_POST['uname'], $_POST['fname'], $_POST['lname'], $_POST['passwd']);

// and insert into 'users' table
if ($person->addToDB("oniddb.cws.oregonstate.edu", "lindenba-db", "ntVB3yI2RNUm7xHg", "lindenba-db")) {
    $_SESSION['error'] = true;
    $_SESSION['message'] = "Failed to insert person";
    
    //return to main
    header('Location: register.php');
} else {
    $_SESSION['success'] = true;
    $_SESSION['message'] = "Thank you for registering. Please log in.";
    
    //return to main
    header('Location: index.php');
}
?>