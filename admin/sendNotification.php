<?php

session_start();
include("../includes/db_conn.php");
include("../includes/functions.php");
$msg = "";
if(isset($_POST['submit'])){
    $to = sanitize_data(strtolower($_POST['to']));
    $message = sanitize_data(strtolower($_POST['message']));
    $to = mysqli_real_escape_string($conn,$to);
    $message = mysqli_real_escape_string($conn,$message);

    $query = mysqli_query($conn,"INSERT INTO notifications (`to`,`notification`) VALUES ('$to','$message')");
    if($query){
        header("Location: index.php?notification=true");
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
          <select
            name="to"
            id=""
            class="w-full bg-transparent outline-none border-2 px-5 py-3"
            required
          >
            <option value="">To</option>
           
            <option value="2">All</option>
            <option value="1">Candidates</option>
            <option value="0">Citizens</option>
          </select>
        <div class="my-4">
          <label>Message</label>
          <br />
          <textarea
            name="message"
            id=""
            placeholder="message..."
            cols="30"
            rows="10"
            class="outline-none border-2 px-5 py-3 w-full resize-none rounded-md"
            required
          ></textarea>

        <button type="submit" class="bg-blue-500 w-full mt-5 text-white p-2 rounded" name="submit">
          Send <i class="fa fa-paper-plane"></i>
        </button>
       
      </form>
    </div>
  </body>
</html>
