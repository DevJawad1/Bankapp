<?php
    require 'connection.php';
    session_start();
    if(isset($_POST['submit'])){
        // echo 'yes';
        $name = $_FILES['filename']['name'];
        $temp = $_FILES['filename']['tmp_name'];
        $anothername = time().$name;
        echo $anothername;
        $movedfile=move_uploaded_file($temp, 'images/'.$anothername);
        
        $id = $_SESSION['userid'];
        echo $id;
        if($movedfile){
            $updateProfile = "UPDATE `registration` SET `profile`='$anothername' WHERE user_id=$id";
            $setprofile = $dbconnection->query($updateProfile);
            echo $setprofile;
            if($setprofile){
                echo "<br>";
                echo "Profile picture updated successfully";
                header('location:dashboard.php');
            }else{
                echo "<br>";
                echo "";    
            }
        }else{
            $_SESSION['error']='Upload failed!';
        }
    }
    else{
        // header('location:dashboard.php');
    }
?>