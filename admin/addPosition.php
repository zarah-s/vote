<?php

session_start();
include("../includes/db_conn.php");
include("../includes/functions.php");
$msg = "";
if(isset($_POST['submit'])){
    $position = sanitize_data(strtolower($_POST['position']));
    $position = mysqli_real_escape_string($conn,$position);
    $check = mysqli_query($conn,"SELECT * FROM positions WHERE position = '$position'");
    // die("here");
if(mysqli_num_rows($check)>0){
  $msg = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
  <strong class="font-bold">OOPS!</strong>
  <span class="block sm:inline">Position already exist.</span>
  <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
  </span>
</div>';
}else{

  $query = mysqli_query($conn,"INSERT INTO positions (`position`) VALUES ('$position')");
  if($query){
      header("Location: index.php?position=true");
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
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
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
      <form class="bg-white p-10 rounded-lg shadow" method="POST">
        <div class="text-2xl mb-5">Send Notification</div>
        <?=$msg?>
    
        <div class="my-4">
          <label>Position</label>
          <br />
          <input
            name="position"
            id=""
            placeholder="position..."
            cols="30"
            rows="10"
            class="outline-none border-2 px-5 py-3 w-full resize-none rounded-md"
            required
          ></textarea>

        <button type="submit" class="bg-blue-500 w-full mt-5 text-white p-2 rounded" name="submit">
          Add <i class="fa fa-plus"></i>
        </button>
       
      </form>
    </div>
  </body>
</html>
