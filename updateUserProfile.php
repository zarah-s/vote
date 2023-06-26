<?php
include("includes/db_conn.php");
include("includes/functions.php");

$userName = "";
$email = "";
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $query = mysqli_query($conn,"SELECT * FROM users WHERE id = '$id'");
  while($row = mysqli_fetch_assoc($query)){
    $userName = $row['user_name'];
    $email = $row['email'];
  }
}


// if(isset($_POST['update'])){
//     $userName = sanitize_data(strtolower($_POST['userName']));
//     $email = sanitize_data(strtolower($_POST['email']));
//     $password = sanitize_data(strtolower($_POST['password']));
//     $userName = mysqli_real_escape_string($conn,$userName);
//     $email = mysqli_real_escape_string($conn,$email);
//     $password = mysqli_real_escape_string($conn,$password);

//     $query = mysqli_query($conn,"UPDATE users SET user_name = '$userName',email='$email', `password`= '$password' ");

//     if($query){
//       header("Location:index.php");
//     }

// }

if(isset($_POST['update'])){
  $id = $_GET['id'];
  if($_FILES['file']['name']){
    $userName = sanitize_data(strtolower($_POST['userName']));
    $email = sanitize_data(strtolower($_POST['email']));
    $password = sanitize_data(strtolower($_POST['password']));
    $userName = mysqli_real_escape_string($conn,$userName);
    $email = mysqli_real_escape_string($conn,$email);
    $password = mysqli_real_escape_string($conn,$password);
  $file_name = $_FILES['file']['name'];
  $file_type = $_FILES['file']['type'];
  $file_size = $_FILES['file']['size'];
  $temp_location = $_FILES['file']['tmp_name'];
  $error= $_FILES['file']['error'];
  
  $upload_path="uploads/";

   $file_extension = explode(".",$file_name );
    $file_name = uniqid();
    $new_file_name = $upload_path.$file_name.".".strtolower(end($file_extension));
  $hashed_password = password_hash($password,PASSWORD_DEFAULT);

    move_uploaded_file($temp_location, $new_file_name);
    $query = mysqli_query($conn,"UPDATE users SET user_name = '$userName',email='$email', `password`= '$hashed_password', profile_picture = '$new_file_name' WHERE id = '$id' ");

    if($query){
      header("Location:index.php");
    }
  }else{
  
 $userName = sanitize_data(strtolower($_POST['userName']));
    $email = sanitize_data(strtolower($_POST['email']));
    $password = sanitize_data(strtolower($_POST['password']));
    $userName = mysqli_real_escape_string($conn,$userName);
    $email = mysqli_real_escape_string($conn,$email);
    $password = mysqli_real_escape_string($conn,$password);
  $hashed_password = password_hash($password,PASSWORD_DEFAULT);


    $query = mysqli_query($conn,"UPDATE users SET user_name = '$userName',email='$email', `password`= '$hashed_password' WHERE id = '$id' ");

    if($query){
      header("Location:index.php");
    }
  }
}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            screens: {
              xs: "320px",
              sm: "576px",
              // => @media (min-width: 576px) { ... }

              md: "768px",
              // => @media (min-width: 768px) { ... }

              lg: "992px",
              // => @media (min-width: 992px) { ... }

              xl: "1200px",
            },
          },
        },
      };
    </script>

    <link rel="stylesheet" href="./font-awesome/css/font-awesome.min.css" />
    <!-- <style>
      .content {
        position: absolute;
        left: 50%;
        top: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
      }
    </style> -->
  </head>
  <body class="bg-gray-100 flex justify-center items-center">
    <div class="my-10">
      <form enctype="multipart/form-data" method="post" class="bg-white p-10 rounded-lg shadow">
        <div class="text-2xl mb-5">Update Profile.</div>
        <div class="my-4">
          <label>UserName</label>
          <br />
          <input
            type="text"
            value="<?=$userName?>"
            placeholder="UserName"
            name="userName"
            class="outline-none border-2 px-5 py-3 w-full"
            required
          />
        </div>
        <div class="my-4">
          <label>Email</label>
          <br />
          <input
          value="<?=$email?>"
            type="email"
            placeholder="email"
            class="outline-none border-2 px-5 py-3 w-full"
            name="email"
            required
          />
        </div>
        <div class="my-4">
          <label>Profile image</label>
          <br />
          <input
            accept="image/*"
            type="file"
            placeholder="User name"
            class="outline-none border-2 px-5 py-3 w-full"
            name="file"
          />
        </div>

        <div class="my-4">
          <label>Password</label>
          <br />
          <input
            type="password"
            placeholder="password"
            name="password"
            required
            class="outline-none border-2 px-5 py-3 w-full"
          />
        </div>

        <button name='update' type="submit" class="bg-blue-500 w-full text-white p-2 rounded">
          Update
        </button>
      </form>
    </div>
  </body>
</html>
