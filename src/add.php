<?php
require_once 'classes.php';
//calling add function from class operations and namespace user
$id = $_POST['x']; //getting id 
$obj = new user\operations;
$obj->add($id);
