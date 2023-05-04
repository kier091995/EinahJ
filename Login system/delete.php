<?php

@include 'config.php';
session_start();


if(isset($_POST['delete_account'])){
   $email = mysqli_real_escape_string($conn, $_SESSION['email']);
   $pass = md5($_SESSION['password']);

   $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";
   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $delete = "DELETE FROM user_form WHERE email = '$email' && password = '$pass' ";
      mysqli_query($conn, $delete);
      session_unset();
      session_destroy();
      header('location:login.php');
   }else{
      $error[] = 'Invalid email or password!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>
<body>
    <h1>Delete Account</h1>
    <?php
      if(isset($error)){
         foreach($error as $error_msg){
            echo '<span class="error-msg">'.$error_msg.'</span>';
         }
      }
    ?>
    <p>Are you sure you want to delete your account?</p>
    <form method="POST">
        <input type="hidden" name="delete_account" value="true">
        <button type="submit">Yes, delete my account</button>
    </form>
</body>
</html>