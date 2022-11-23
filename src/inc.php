<?php
 require_once 'classes.php';
//calling inc function from class operations and namespace user
        $id = $_POST['x'];//getting id 
        $obj = new user\operations;
       $obj->inc($id);
?>