
<?php
require 'connection.php';
session_start();
if(isset($_SESSION['userid'])){
    $id = $_SESSION['userid'];
    $query = "SELECT * FROM registration WHERE user_id=$id";
    $user = $dbconnection->query($query);
    $getUser=$user->fetch_assoc();
    $username =  $getUser['first_name'];
    $picture = $getUser['profile'];
    // echo $picture;
}
else{
    location('header:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container shadow mt-5 p-3">
    <!-- <img src="" alt=""> -->
        <div class="d-flex justify-content-between p-2">
        <?php
             echo "<p>Welcome, <span style='color:red; font-weight:bolder'> ".$username."<span> </p>";
             echo "<img src='images/$picture' alt='profile' style='width:45px;height:45px; border-radius:50%;'> ";
        ?>
        </div>
        <!-- <img src=<?php echo "images/$picture" ?> alt='profile' > -->
        <div class="d-flex justify-content-between">
        <form action="fileupload.php" method="POST" enctype="multipart/form-data">
            <div class="upload bg-white shadow pt-3 p-1" style="position:absolute; z-index:5;">
                <p>Upload Profile</p>
                <div class="pop p-4">
                    <input type="file" name="filename" style='width:115px' class="btn">
                    <input type="submit" value="Upload profile file" name="submit" class="btn btn-success">
                </div>
            </div>
        </form>
        <form action="displayTodo.php" method="POST">
            <div onclick="seeTodo()" class="upload bg-white shadow p-1" style="position:abslute; z-index:5; left:80%">
                <button type="submit" class="btn">See todo</button>
            </div>
        </form>
    </div>
        
        <div class="pt-4">
            <div class="mt-5">
                <div class="container shadow p-2">
                    
                    <form action="submittodo.php" method="POST">
                        <p class="fw-bold">Add todo</p>
                        <div class="d-flex gap-2">
                            <div class="">
                                <label for="">Category</label>
                                <input type="text" name="category" class="border border-1 border-black w-100 form-control mt-2">
                            </div>
                            <div>
                                <label for="">Title</label>
                                <input type="text" name="title" class="border border-1 border-black w-100 form-control mt-2">
                            </div>
                            <div class="">
                                <label for="">Time</label>
                                <input type="time" name="datetime" class="border border-1 border-black w-100 form-control mt-2">
                            </div>
                            <div class="w-50">
                                <label for="">Content</label>
                                <input type="text" name="content" class="border border-1 border-black w-100 form-control mt-2">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit" class="w-50 btn btn-info mt-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <style>
            .upload{
                color:blue;
            }
            .upload:hover .pop{
                display:block;
                width:25vw
            }
            .pop{
                display:none;
                animation: popup 200ms linear 1 forwards;
            }
        </style>
       
    <div>
</body>
</html>