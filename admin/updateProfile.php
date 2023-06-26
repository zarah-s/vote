<?php
include("../includes/db_conn.php");
include("../includes/functions.php");



if(isset($_GET['id'])){
  // $id = $_GET['id'];
  $query = mysqli_query($conn,"SELECT * FROM users WHERE `level` = '2'");
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


// $id = $_GET['id'];
if(isset($_POST['update'])){

  $userName = sanitize_data(strtolower($_POST['userName']));
  // die("sdfds");
  $email = sanitize_data(strtolower($_POST['email']));
    $password = sanitize_data(strtolower($_POST['password']));
    $userName = mysqli_real_escape_string($conn,$userName);
    $email = mysqli_real_escape_string($conn,$email);
    $password = mysqli_real_escape_string($conn,$password);
  $hashed_password = password_hash($password,PASSWORD_DEFAULT);


    $query = mysqli_query($conn,"UPDATE users SET user_name = '$userName',email='$email', `password`= '$hashed_password' WHERE `level` = '2' ");

    if($query){
      header("Location:index.php");
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
            type="email"
            placeholder="email"
            class="outline-none border-2 px-5 py-3 w-full"
            name="email"
            required
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
