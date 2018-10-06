<?php
 if(isset($_POST['submit'])){ // Security measure. Makes sure that the  submit button has been pressed
   include_once 'database.php';

   $username = mysqli_real_escape_string($conn, $_POST['uid']);  //Escape string to prevent
   $first = mysqli_real_escape_string($conn, $_POST['first']);   //SQL injection. Isnserts
   $last = mysqli_real_escape_string($conn, $_POST['last']);     //data from form.
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass1 = mysqli_real_escape_string($conn, $_POST['pass1']);
   $pass2 = mysqli_real_escape_string($conn, $_POST['pass2']);


   //Error handler. Comments tell what error is behing handled

  if(empty($username) || empty($first) || empty($last) || empty($email) || empty($pass1) || empty($pass2)){


       header("Location: ../signup.php?signup=empty"); //Prevent empty form.
       exit();
   }else
     if($pass1 != $pass2){
       header("Location: ../signup.php?signup=passmissmatch");  //Password Missmatch
       exit();
     }else{
      //Illegal characters
      if(!preg_match("/^[a-zA-Z0-9]*$/", $username) || !preg_match("/^[a-zA-Z0-9]*$/", $first) || !preg_match("/^[a-zA-Z0-9]*$/", $last)){
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


            //Insert user into the database.
            $userinsert = "INSERT INTO signup ( "username", "email", "pass" ) VALUES ('$username', '$email', '$hashedPwd')";

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
