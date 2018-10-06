<?php

session_start();
    if(isset( $_POST['submit'])){
      include 'database.php';

      $uid = mysqli_real_escape_string($conn,$_POST['uid']);
      $pass = mysqli_real_escape_string($conn,$_POST['password']);
      $hasheduid = md5($uid);
      $hashedPwd= md5($pass);

      //Error handlers
      //Check if empty

      if(empty($uid) || empty($pass)){

         header("Location: ../index.php?login=empty");
         exit();
      }else{
        $sql = "SELECT * FROM userinfo WHERE user_name = '$hasheduid'";
        $result = mysqli_query($conn, $sql);
        $resultsCheck = mysqli_num_rows($result);
        if($resultsCheck < 1){
          echo $uid;
          header("Location: ../index.php?login=empty");
          exit();
        }else{
          if($row = mysqli_fetch_assoc($result)){
            //De-hashing PASSWORD


            if($hashedPwd != $row['password']){

              header("Location: ../index.php?login=missmatch");
              exit();
          } elseif($hashedPwd == $row['password']){
              //Login user here
              $_SESSION['u_id'] = $row['user_id'];
              $_SESSION['u_name'] = $uid;
              $_SESSION['u_first'] = $row['user_first'];
              $_SESSION['u_last'] = $row['user_last'];
              $_SESSION['u_email'] = $row['user_email'];

              header("Location: ../index.php?login=success");
              exit();
            }
          }
        }
      }
    }else{
      header("Location: ../index.php?login=error");
      exit();
    }

 ?>
