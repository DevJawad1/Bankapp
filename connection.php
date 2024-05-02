<?php
    $localhost='localhost';
    $username='root';
    $passcode='';
    $database='bgapp';
    $dbconnection= new mysqli($localhost,$username,$passcode,$database);
    if($dbconnection->connect_error){
        // echo "Not connect to database",$dbconnection-> connect_error;
    }
    else{
        // echo "Database connect successfully";
        // print_r ($dbconnection);
    }
?>