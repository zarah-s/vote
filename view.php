<?php
session_start();
include("includes/db_conn.php");


if(!$_GET['id'] || !$_GET['position']){
header("Location:index.php");
}

if(isset($_POST['vote'])){
  $voting = $_GET['id'];
  $position = $_GET['position'];
$my_id = $_SESSION['id'];

$check = mysqli_query($conn,"SELECT * FROM votes  WHERE position ='$position' AND voter_id = '$my_id' ");

if(mysqli_num_rows($check)<1){
    
    $query = mysqli_query($conn,"INSERT INTO votes (voter_id,voting,position) VALUES ('$my_id','$voting','$position')");
    if($query){
      header("Location:index.php?success=true");
    }
  }else{
    
      header("Location:index.php?success=false");

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
<script src="./js/script.js" defer></script>
    <link rel="stylesheet" href="./font-awesome/css/font-awesome.min.css" />
  </head>
  <body>
 <div class="bg-black text-white fixed w-full mb-20 top-0 px-3">
      <div
        class="container m-auto xl:px-20 lg:px-20 md:px-20 sm:px-0 xs:px-0 py-5"
      >
        <div class="flex justify-between items-center">
          <h1 class="text-3xl font-semibold">Votex</h1>
<i id="sideBarToggle" class="fa fa-bars xl:hidden lg:hidden md:hidden sm:block xs:block"></i>
          <ul
            class="flex items-center gap-10 xl:flex lg:flex md:flex sm:hidden xs:hidden"
          >
            <li>
              <i id="bell" class="fa fa-bell" aria-hidden="true"></i>
            </li>
            <div class="">
              <i id="profile" class="fa fa-user" aria-hidden="true"></i>

              <!-- Dropdown menu -->
              <div
                id="dropdownHover"
                class="z-10 bg-white hidden absolute right-10 divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700"
              >
                <ul
                  class="py-2 text-sm text-gray-700 dark:text-gray-200"
                  aria-labelledby="dropdownHoverButton"
                >
                 <?php
                 $id = $_SESSION['id'];
$level = $_SESSION['level'];

if($level == 0){

  echo ' <li>
                      <a
                        href="./updateUserProfile.php?id='.$id.'"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        >Edit Profile</a
                      >
                    </li>';
}else{
  echo ' <li>
                      <a
                       href="./updateCandidateProfile.php?id='.$id.'"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        >Edit Profile</a
                      >
                    </li>';
}


?>

                  <li>
                    <a
                      href="./logout.php"
                      class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                      >Sign out</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </ul>
        </div>
      </div>
    </div>

    <aside
      id="side"
      class="fixed top-0 xl:hidden lg:hidden md:hidden sm:fixed xs:fixed hidden right-0 z-40 w-64 h-screen"
      aria-label="Sidebar"
    >
      <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <div className="flex justify-end">
          <button id="closeSidebar" >
            <i class="fa fa-times"></i>
          </button>
        </div>
        <ul className=" space-y-10 mt-10">
          <li class="mx-2 my-5" onclick="toggleNotification()">
            <i class="fa fa-bell"> </i>
            Notifications
          </li>
          <li class="mx-2 my-5" onclick="toggleDropdown('class')">
            <i class="fa fa-user"></i>
            Profile
          </li>
        </ul>

         <div
              
                class="z-10 bg-white dropdownHover hidden absolute right-10 divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700"
              >
                <ul
                  class="py-2 text-sm text-gray-700 dark:text-gray-200"
                  aria-labelledby="dropdownHoverButton"
                >
                 <?php
                 $id = $_SESSION['id'];
$level = $_SESSION['level'];

if($level == 0){

  echo ' <li>
                      <a
                        href="./updateUserProfile.php?id='.$id.'"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        >Edit Profile</a
                      >
                    </li>';
}else{
  echo ' <li>
                      <a
                       href="./updateCandidateProfile.php?id='.$id.'"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        >Edit Profile</a
                      >
                    </li>';
}


?>

                  <li>
                    <a
                      href="./logout.php"
                      class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                      >Sign out</a
                    >
                  </li>
                </ul>
              </div> 
      </div>
    </aside>

    <aside
      id="notificationDialog"
      class="fixed top-0 right-0 z-40 xl:w-1/3 lg:w-1/3 md:w-1/3 sm:w-full xs:w-full w-64 h-screen hidden"
      aria-label="Sidebar"
    >
      <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <div class="flex justify-between items-center">
          <p class="text-2xl">Notifications</p>
          <button onclick="toggleNotification()">
            <i class="fa fa-times"></i>
          </button>
        </div>

        <?php
        $level = $_SESSION['level'];
$query = mysqli_query($conn,"SELECT * FROM notifications WHERE `to` = '$level'");
if(mysqli_num_rows($query) >0){

  while($row = mysqli_fetch_assoc($query)){
    $notification = $row['notification'];
    $date = $row['date'];
  
    echo ' <div class="my-5 bg-gray-100 p-3">
          <h4 class="text-xl">Admin Message</h4>
          <p class="text-gray-500">'.$date.'</p>
          <small class="text-gray-500">'.$date.'</small>
         </div>';
  }
}else{
  echo '<p class="text-center text-gray-500 font-medium mt-10">No Notifications</p>';
}


?>
      
      
      </div>
    </aside>
    <div class="container m-auto">
      <div class="text-center mt-24">
        <a href="./competitors.php?id=<?=$_GET['id']?>&position=<?=$_GET['position']?>" class="underline">See Competitors</a>
      </div>
     <?php


$user_id = $_GET['id'];

$query = mysqli_query($conn,"SELECT * FROM users WHERE id = '$user_id'");
while($row = mysqli_fetch_assoc($query)){
  $position = $row['position'];
            $image = $row['profile_picture'];


   $check = mysqli_query($conn,"SELECT * FROM positions WHERE id = '$position'");
            while($pos = mysqli_fetch_assoc($check)){
              $position = $pos['position'];
              $position_id = $pos['id'];

            }
  echo ' <div class="flex gap-5 my-10 flex-wrap">
        <div class="grow-1">
          <img src="'.$image.'" class="w-full h-[80vh] object-cover" alt="" />
          <h4 class="text-3xl">'.$row['user_name'].'</h4>
          <p>'.$position.'</p>
          <button form="vote" type="submit" name="vote" class="bg-blue-500 text-white w-full p-2 rounded mt-5">
            Vote
          </button>
        </div>

        <div class="xl:w-1/2 lg:w-1/2 md:w-1/2 sm:w-full xs:w-full">
          <p class="font-semibold text-2xl">Bio</p>
          <p class="text-gray-500">
           '.$row['bio'].'
          </p>

          <p class="font-semibold text-2xl mt-10">Manifesto</p>
          <p class="text-gray-500">
           '.$row['manifesto'].'
          </p>
        </div>
      </div>';
}



      ?>
    </div>

    <form id="vote" method="post"></form>
  </body>
</html>
