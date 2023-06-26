<?php
session_start();

include("./includes/db_conn.php");
include("./includes/functions.php");
$msg = "";
if(isset($_POST['btnRegister'])){

  $userName = sanitize_data(strtolower($_POST['userName']));
  $email = sanitize_data(strtolower($_POST['email']));
  $level = sanitize_data(strtolower($_POST['level']));
  $password = sanitize_data(strtolower($_POST['password']));
  
  $file_name = $_FILES['file']['name'];
  $file_type = $_FILES['file']['type'];
  $file_size = $_FILES['file']['size'];
  $temp_location = $_FILES['file']['tmp_name'];
  $error= $_FILES['file']['error'];
  
  $upload_path="uploads/";

  $userName = mysqli_real_escape_string($conn,$userName);
  
  $email = mysqli_real_escape_string($conn,$email);
  $password = mysqli_real_escape_string($conn,$password);
  $hashed_password = password_hash($password,PASSWORD_DEFAULT);
  
  $query = mysqli_query($conn,"SELECT * FROM users WHERE email = '$email'");
  if(mysqli_num_rows($query) == 0){
// exit("Here");

    $file_extension = explode(".",$file_name );
    $file_name = uniqid();
    $new_file_name = $upload_path.$file_name.".".strtolower(end($file_extension));

    move_uploaded_file($temp_location, $new_file_name);
    
    $sql = mysqli_query($conn,"INSERT INTO users (user_name,email,`password`,profile_picture,`level`) VALUES ('$userName','$email','$hashed_password','$new_file_name','$level')");
    if(!$sql){

     $msg = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">OOPS!</strong>
                <span class="block sm:inline">Something went wrong.</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                  <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
              </div>';
    }else{

      $fetch = mysqli_query($conn,"SELECT * FROM users WHERE email = '$email'");
      // exit(mysqli_num_rows($fetch));
       while($row = mysqli_fetch_assoc($fetch)){
            $id = $row['id'];

        }
        if(strval($level) == '0' ){
        $_SESSION['id'] = $id;
            $_SESSION['level'] = $level;

        header("location:index.php");
      }else{
            $_SESSION['level'] = $level;

        header("location:candidateCompleteProfile.php?id=$id");
      }
    }
  }else{
    $msg = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
  <strong class="font-bold">OOPS!</strong>
  <span class="block sm:inline">User already exist.</span>
  <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
  </span>
</div>';
  
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
      <form enctype="multipart/form-data" class="bg-white p-10 rounded-lg shadow" method="POST">
        <div class="text-2xl mb-5">Sign up.</div>
        <?=$msg?>

        <div class="my-4">
          <label>UserName</label>
          <br />
          <input
            type="text"
            placeholder="Xervic"
            class="outline-none border-2 px-5 py-3 w-full"
            name="userName"
            required
          />
        </div>
        <div class="my-4">
          <label>Email</label>
          <br />
          <input
            type="email"
            placeholder="sample@email.com"
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
            placeholder=""
            class="outline-none border-2 px-5 py-3 w-full"
            name="file"
            required
          />
        </div>
        <div class="my-4">
          <label>Level</label>
          <br />
          <select
            name="level"
            id=""
            class="w-full bg-transparent outline-none border-2 px-5 py-3"
            required
          >
            <option value="0">Individual</option>
            <option value="1">Candidate</option>
          </select>
        </div>
        <div class="my-4">
          <label>Password</label>
          <br />
          <input
            type="password"
            placeholder="***********"
            class="outline-none border-2 px-5 py-3 w-full"
            name="password"
            required
          />
        </div>

        <button name="btnRegister" type="submit" class="bg-blue-500 w-full text-white p-2 rounded">
          Sign up
        </button>
         <div class="mt-2">
          <span>Already have an account?</span>
          <a href="./login.php">Login</a>
        </div>
      </form>
    </div>
  </body>
</html>
