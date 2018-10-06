<?php
   session_start();  //Logs a user out when executed
   session_unset();
   session_destroy();
   header("Location: ../index.php");

   exit();


?>
