<?php
require ('connection.php');
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Content-Type");
header("Content-Type:application/json") ;
$input=json_decode(file_get_contents('php://input'),true);

$email =$input['email'];
$password =$input['pass'];

$query= "SELECT * from alluser WHERE email = ?" ;
$prepare=$dbconnection->prepare($query);
$prepare->bind_param('s', $email);
$execute=$prepare->execute();
if($execute){
    $confirm=$prepare->get_result();
    if($confirm->num_rows>0){
        $user = $confirm->fetch_assoc();
        $hashedpassword=$user['password'];
        $verify =password_verify($password, $hashedpassword);
        if($verify){
            $result=["message"=>"User found", "userDetails"=>$user, "status"=>true];
            echo json_encode($result);
        }
        else{
        $result=["message"=>"Password mismatch", "status"=>false];
        echo json_encode($result);
        }
    }
    else{
        $result=["message"=>"user not found", "status"=>false];
        echo json_encode($result);
    }
}
?>