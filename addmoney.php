<?php
require ('connection.php');
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Content-Type");
header("Content-Type:application/json") ;
$input=json_decode(file_get_contents('php://input'),true);

$amount=$input['amount'];
$user=$input['user'];


$query = "UPDATE `alluser` SET `balance`=`balance`+$amount WHERE username = '$user'";
// $querybalance= "SELECT balance from alluser WHERE username = $user" ;
$queryupdated = $dbconnection->query($query);
if($query){
    $result=["message"=>"You added $amount $user", "status"=>true];
    echo json_encode($result);
}
else{
    $result=["message"=>"Error while adding  money", "status"=>true];
    echo json_encode($result);
}
?>