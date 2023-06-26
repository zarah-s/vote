
<?php
session_start();

include("includes/db_conn.php");
include("includes/functions.php");


$id;
if(isset($_GET['id'])){
  $id = $_GET['id'];
}else{
  header("Location:signup.php");
}

if(isset($_POST['btnComplete'])){

    $position = sanitize_data(strtolower($_POST['position']));
    $bio = sanitize_data(strtolower($_POST['bio']));
    $manifesto = sanitize_data(strtolower($_POST['manifesto']));
    $bio = mysqli_real_escape_string($conn,$bio);
    $manifesto = mysqli_real_escape_string($conn,$manifesto);
  // die($position);

$query = mysqli_query($conn,"UPDATE users SET position ='$position', bio = '$bio', manifesto = '$manifesto' WHERE id = '$id'");
        $_SESSION['id'] = $id;



if($query){
  header("Location:index.php");
}else{
  die("sdfsdf");
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
      <form method="post" class="bg-white p-10 rounded-lg shadow">
        <div class="text-2xl mb-5">Complete Profile.</div>
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
$query = mysqli_query($conn,'SELECT * FROM positions');

while($row = mysqli_fetch_assoc($query)){
  $id = $row['id'];
  $position = $row['position'];
  echo "<option value='$id'>$position</option>";
}
            ?>
            
            <!-- <option value="candidate">Candidate</option>
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
          ></textarea>
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
          ></textarea>
        </div>

        <button type="submit" name="btnComplete" class="bg-blue-500 w-full text-white p-2 rounded">
          Complete
        </button>
      </form>
    </div>
  </body>
</html>
