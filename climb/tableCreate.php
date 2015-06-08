<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
session_start();

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "lindenba-db", "ntVB3yI2RNUm7xHg", "lindenba-db");
  if($mysqli->connect_errno)
  {
    echo "Failed to connect to MySQL: " .$mysqli->connect_errno. " " .$mysqli->connect_error;
  }

$listing= 'CREATE TABLE IF NOT EXISTS listings (
id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
userId INT UNSIGNED,
title varchar(32),
description TEXT,
pORs INT, 
ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY(userId)
    REFERENCES users(id)
    on DELETE CASCADE
) ENGINE InnoDB';

if($mysqli->query($listing))
    {
     //echo "error creating table ";
    }
?>