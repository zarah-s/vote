<?php
include("includes/db_conn.php");
include("includes/functions.php");

$userName = "";
$email = "";
$position = "";
$bio = "";
$manifesto = "";
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $query = mysqli_query($conn,"SELECT * FROM users WHERE id = '$id'");
  while($row = mysqli_fetch_assoc($query)){
    $userName = $row['user_name'];
    $email = $row['email'];
    $bio = $row['bio'];
    $manifesto = $row['manifesto'];
    $position = $row['position'];
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
    $position = sanitize_data(strtolower($_POST['position']));
    $bio = sanitize_data(strtolower($_POST['bio']));
    $manifesto = sanitize_data(strtolower($_POST['manifesto']));
    $userName = mysqli_real_escape_string($conn,$userName);
    $email = mysqli_real_escape_string($conn,$email);
    $position = mysqli_real_escape_string($conn,$position);
    $manifesto = mysqli_real_escape_string($conn,$manifesto);
    $bio = mysqli_real_escape_string($conn,$bio);
  $file_name = $_FILES['file']['name'];
  $file_type = $_FILES['file']['type'];
  $file_size = $_FILES['file']['size'];
  $temp_location = $_FILES['file']['tmp_name'];
  $error= $_FILES['file']['error'];
  
  $upload_path="uploads/";

   $file_extension = explode(".",$file_name );
    $file_name = uniqid();
    $new_file_name = $upload_path.$file_name.".".strtolower(end($file_extension));

    move_uploaded_file($temp_location, $new_file_name);
    $query = mysqli_query($conn,"UPDATE users SET user_name = '$userName',email='$email', `position`= '$position',`bio`= '$bio',`manifesto`= '$manifesto', profile_picture = '$new_file_name' WHERE id = '$id' ");

    if($query){
      header("Location:index.php");
    }
  }else{
  
 $userName = sanitize_data(strtolower($_POST['userName']));
     $userName = sanitize_data(strtolower($_POST['userName']));
    $email = sanitize_data(strtolower($_POST['email']));
    $position = sanitize_data(strtolower($_POST['position']));
    $bio = sanitize_data(strtolower($_POST['bio']));
    $manifesto = sanitize_data(strtolower($_POST['manifesto']));
    $userName = mysqli_real_escape_string($conn,$userName);
    $email = mysqli_real_escape_string($conn,$email);
    $position = mysqli_real_escape_string($conn,$position);
    $manifesto = mysqli_real_escape_string($conn,$manifesto);
    $bio = mysqli_real_escape_string($conn,$bio);
    
    $query = mysqli_query($conn,"UPDATE users SET user_name = '$userName',email='$email', `position`= '$position',`bio`= '$bio',`manifesto`= '$manifesto', profile_picture = '$new_file_name' WHERE id = '$id' ");


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
      <form enctype="multipart/form-data" class="bg-white p-10 rounded-lg shadow" method="post">
        <div class="text-2xl mb-5">Update Profile.</div>
        <div class="my-4">
          <label>UserName</label>
          <br />
          <input
            type="text"
            placeholder="User name"
            class="outline-none border-2 px-5 py-3 w-full"
            required
            name="userName"
            value="<?=$userName?>"
          />
        </div>
        <div class="my-4">
          <label>Email</label>
          <br />
          <input
            type="email"
            placeholder="Email"
            class="outline-none border-2 px-5 py-3 w-full"
             required
            name="email"
            value="<?=$email?>"

          />
        </div>
        <div class="my-4">
          <label>Profile image</label>
          <br />
          <input
            accept="image/*"
            type="file"
            name="file"
            placeholder="User name"
            class="outline-none border-2 px-5 py-3 w-full"
          />
        </div>

        <div class="my-4">
          <label>Position</label>
          <br />
          <select
            name="position"
            id=""
            class="w-full bg-transparent outline-none border-2 px-5 py-3"
            required
          >
            <option value="">Position</option>
            <?php
$query = mysqli_query($conn,"SELECT * FROM positions");

while($row = mysqli_fetch_assoc($query)){
  $pst = $row['position'];
  $pstId = $row['id'];

  if($position == $pstId){
    echo "<option value='$pstId' selected>$pst</option>";
  }else{
    echo "<option value='$pstId'>$pst</option>";

  }
}

?>
            <!-- <option value="candidate">Candidate</option>
            <option value="candidate">Candidate</option>
            <option value="candidate">Candidate</option> -->
          </select>
        </div>
        <div class="my-4">
          <label>Bio</label>
          <br />
          <textarea
            name="bio"
            id=""
            placeholder="Bio..."
            cols="30"
            rows="10"
            class="outline-none border-2 px-5 py-3 w-full resize-none rounded-md"
            required

          ><?=$bio?></textarea>
        </div>
        <div class="my-4">
          <label>Manifesto</label>
          <br />
          <textarea
            name="manifesto"
            id=""
            placeholder="Manifesto..."
            cols="30"
            rows="10"
            class="outline-none border-2 px-5 py-3 w-full resize-none rounded-md"
            required
          ><?=$manifesto?></textarea>
        </div>

        <button type="submit" name="update" class="bg-blue-500 w-full text-white p-2 rounded">
          Update
        </button>
      </form>
    </div>
  </body>
</html>
