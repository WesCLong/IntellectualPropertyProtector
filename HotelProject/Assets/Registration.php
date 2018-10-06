<?php
 if(isset($_POST['submit'])){ // Security measure. Makes sure that the  submit button has been pressed
   include_once 'database.php';

   $username = mysqli_real_escape_string($conn, $_POST['uid']);  //Escape string to prevent
   $first = mysqli_real_escape_string($conn, $_POST['first']);   //SQL injection. Isnserts
   $last = mysqli_real_escape_string($conn, $_POST['last']);     //data from form.
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);
   $card = mysqli_real_escape_string($conn, $_POST['card']);
   $pass1 = mysqli_real_escape_string($conn, $_POST['pass1']);
   $pass2 = mysqli_real_escape_string($conn, $_POST['pass2']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $state = mysqli_real_escape_string($conn, $_POST['state']);
   $zip = mysqli_real_escape_string($conn, $_POST['zip']);
   $carrier = mysqli_real_escape_string($conn, $_POST['carrier']);
   $cardexpiration = mysqli_real_escape_string($conn, $_POST['cardexpiration']);
   $cardsecurity = mysqli_real_escape_string($conn, $_POST['cardsecurity']);


   //Error handler. Comments tell what error is behing handled

  if(empty($username) || empty($first) || empty($last) || empty($email) || empty($phone) || empty($card) || empty($pass1) || empty($pass2) || empty($address) || empty($state) || empty($zip) || empty($carrier) || empty($cardexpiration) || empty($cardsecurity) ){


       header("Location: ../signup.php?signup=empty"); //Prevent empty form.
       exit();
   }else
     if($pass1 != $pass2){
       header("Location: ../signup.php?signup=passmissmatch");  //Password Missmatch
       exit();
     }else{
      //Illegal characters
      if(!preg_match("/^[a-zA-Z0-9]*$/", $username) || !preg_match("/^[a-zA-Z0-9]*$/", $first) || !preg_match("/^[a-zA-Z0-9]*$/", $last) || !preg_match("/^[0-9]*$/", $phone) || !preg_match("/^[0-9]*$/", $card)){
        header("Location: ../signup.php?signup=invalid");
        exit();
      }else {
        //Invalid email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          header("Location: ../signup.php?signup=email");
          exit();
        }else{
          //Username exists
          $sql = "SELECT * FROM userinfo WHERE user_name ='$username'";
         //Queries user_name
          $results = $conn->query($sql);
          $numrows = $results->num_rows;



          if($numrows > 0){
            header("Location: ../signup.php?signup=usertaken");
            exit();
          }else{

            //Hash Password
            $hashedPwd = md5($pass1);
            $hashedusername = md5($username);
            
            //Insert user into the database.
            $userinsert = "INSERT INTO userinfo (user_name, user_first, user_last, user_email, user_phone, user_card, card_type, card_experation, security_code, password, Home_Address, State, Zip) VALUES ('$hashedusername', '$first', '$last', '$email', '$phone', '$card', '$carrier' ,'$cardexpiration', '$cardsecurity', '$hashedPwd', '$address', '$state', '$zip')";


            mysqli_query($conn, $userinsert);

            header("Location: ../index.php?signup=success");  //User succeeded
            exit();
          }
        }
       }
      }
   }

 else{
   header("Location: ../signup.php"); //If they didn't press the button, redirect and quit.
   exit();
 }
 ?>
