<?php
require ('connection.php');
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Content-Type");
header("Content-Type:application/json") ;
$input=json_decode(file_get_contents('php://input'),true);
    $fullname=$input['fname'];
    $username= $input ['uname'];
    $phone = $input['phone'];
    $email = $input['email'];
    $password = $input['pass'];
    $isAdmin = 'false';
    // if($fullname)
    $query= "SELECT * from alluser WHERE email = ?" ;
    $prepare=$dbconnection->prepare($query);
    $prepare->bind_param('s', $email);
    $execute=$prepare->execute();
    $confirm=$prepare->get_result();
    $query2= "SELECT * from alluser WHERE username = ?" ;
    $prepare2 = $dbconnection->prepare($query2);
    $prepare2->bind_param('s', $username);
    $execute2=$prepare2->execute();
    $confirm2=$prepare2->get_result();

    if($execute || $execute2){
        if($confirm->num_rows>0){
            $result=['message'=>"email already exist", "status"=>"Email found"]; 
            echo json_encode($result);
        }
        else if($confirm2->num_rows>0){
            $result=['message'=>"username already exist", "status"=>"User   name found"];
            echo json_encode($result);
        }
        else{   
            $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
            $setdb = "INSERT INTO `alluser`( `Fullname`, `username`, `phoneNumber`, `email`, `password`, `admin`) VALUES (?,?,?,?,?,?)";
            $prep = $dbconnection->prepare($setdb);
            $prep->bind_param('ssssss', $fullname ,$username ,$phone , $email ,$hashedpassword, $isAdmin);
            $execute=$prep->execute();
            if($execute){
                $result=["message"=>"Registration successful", "status"=>true, "email"=>$email];
                echo json_encode($result);
            }
            else{
                $result=["message"=>"Registration fail", "status"=>false, "error"=>$dbconnection->error];
                echo json_encode($result);
            }
        }
    }
?>
