<?php



    if(isset($_POST['send'])){
        $name = sanitize_data($_POST['name']);
        $email = sanitize_data($_POST['email']);
        $message = sanitize_data($_POST['message']);
        $message = mysqli_real_escape_string($conn,$message);
        $name = mysqli_real_escape_string($conn,$name);
        $mailto = "devvick230385@gmail.com";
        $subject = "LiqwidPay contact form";
        $body = $message;
        $headers = 'From: Name: '.$name.'; Email: '.$email.'';
      

        if(mail($mailto,$subject,$body,$headers)){
            
            
        }else{
            
        }
    }


?>