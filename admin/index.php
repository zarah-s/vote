<?php
session_start();
include("../includes/db_conn.php");
$id = $_SESSION['id'];
$level = $_SESSION['level'];
// if(!$id || ($level !=1 || $level != 0)){
//   header("Location:login.php");
// }

if($level == 2 && $id){
  
}else{
  header("Location:../login.php");

}






?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vote</title>
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
          <li class="text-sm font-medium"><a href="./sendNotification.php">Send Notification</a></li>
          <li class="text-sm font-medium"><a href="./addPosition.php">Add Position</a></li>
          <li class="text-sm font-medium"><a href="./updateProfile.php">Update profile</a></li>
          <li class="text-sm font-medium"><a href="../logout.php">Logout</a></li>
            
                </ul>
              </div>  
            </div>
          </ul>
        </div>
      </div>
    </div>


<div class="my-32"></div>
<!-- <div class="my-20"></div>
<div class="mt-20"></div> -->

     <div class="container m-auto">
      <?php

if(isset($_GET['notification'])){
  echo '<div class="bg-green-100 border mb-10 border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
  <strong class="font-bold">SUCCESS!</strong>
  <span class="block sm:inline">Notification Sent.</span>
  <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
  </span>
</div>';
}

if(isset($_GET['position'])){
  echo '<div class="bg-green-100 border mb-10 border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
  <strong class="font-bold">SUCCESS!</strong>
  <span class="block sm:inline">Position Added.</span>
  <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
  </span>
</div>';
}

?>
<!-- <div class="my-20"></div> -->
    

      <div class="grid grid-cols-12 h-[80vh] gap-10">
        <div
          class="col-span-3 xl:block lg:block md:block sm:hidden xs:hidden border-black border-opacity-10 border-r-2"
        >
          <div class="sticky top-20">
            <h3 class="text-2xl">Filter by Position:</h3>

           <form method="post">
             <select
              id="position"
              class="mt-10 bg-slate p-3 outline-none rounded-lg"
            >
              <option class="position" value="0">All</option>

                          <?php
$query = mysqli_query($conn,'SELECT * FROM positions');

while($row = mysqli_fetch_assoc($query)){
  $id = $row['id'];
  $position = $row['position'];
  $filter = isset($_GET['filter']);
  if($filter == $id){

    echo "<option class='position' value='$id' selected>$position</option>";
  }else{
    echo "<option class='position' value='$id'>$position</option>";

  }
}
            ?>
              <!-- <option value="">Presidency</option>
              <option value="">Governorship</option>
              <option value="">Senate</option> -->
            </select>
           </form>


           
          </div>
        </div>
        <div class="col-span-9">
<h2 class="text-2xl mb-10">Results</h2>

<div class=" overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                    Position
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                    Score
                </th>
               
            </tr>
        </thead>
        <tbody>


        <?php
$remote_id = isset($_GET['filter']);
 if($remote_id && $remote_id != '0'){

  $query = mysqli_query($conn,"SELECT * FROM users WHERE `level` = '1' AND position = '$remote_id'");

while($row = mysqli_fetch_assoc($query)){
  $candidateId = $row['id'];
  $position = $row['position'];
  $countQuery = mysqli_query($conn,"SELECT * FROM votes WHERE voting ='$candidateId' AND position = '$position' ");
  $count = mysqli_num_rows($countQuery);
  $positionQuery = mysqli_query($conn,"SELECT * FROM positions WHERE id = '$position'");
  while($pst = mysqli_fetch_assoc($positionQuery)){
    $position = $pst['position'];
  }
  $candidateQuery = mysqli_query($conn,"SELECT * FROM users where id = '$candidateId'");
  while($cdd = mysqli_fetch_assoc($candidateQuery)){
   
    $candidate = $cdd['user_name'];
  }

  echo '<tr class="border-b border-gray-200 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                   '.$position.'
                </th>
                <td class="px-6 py-4">
                   '.$candidate.'
                </td>
                <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                   '.$count.'
                </td>
               
            </tr>';
}
 }else{
$query = mysqli_query($conn,"SELECT * FROM users WHERE `level` = '1'");

while($row = mysqli_fetch_assoc($query)){
  $candidateId = $row['id'];
  $position = $row['position'];
  $countQuery = mysqli_query($conn,"SELECT * FROM votes WHERE voting ='$candidateId' AND position = '$position' ");
  $count = mysqli_num_rows($countQuery);
  $positionQuery = mysqli_query($conn,"SELECT * FROM positions WHERE id = '$position'");
  while($pst = mysqli_fetch_assoc($positionQuery)){
    $position = $pst['position'];
  }
  $candidateQuery = mysqli_query($conn,"SELECT * FROM users where id = '$candidateId'");
  while($cdd = mysqli_fetch_assoc($candidateQuery)){
   
    $candidate = $cdd['user_name'];
  }

  echo '<tr class="border-b border-gray-200 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                   '.$position.'
                </th>
                <td class="px-6 py-4">
                   '.$candidate.'
                </td>
                <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                   '.$count.'
                </td>
               
            </tr>';
}
 }


?>


           
        </tbody>
    </table>
</div>


       

          
        </div>
      </div>
    </div>
     </div>

         <script>
const position = document.getElementById('position')

position.addEventListener('change',(e)=> {
  e.preventDefault();
window.location.href = 'index.php?filter='+e.target.value
})


    </script>
  </body>
</html>
