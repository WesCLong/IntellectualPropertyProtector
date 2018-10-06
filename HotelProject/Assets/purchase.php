<?php
 session_start();
 if(isset($_POST['submit']) && isset($_SESSION['u_name']) ){ // Security measure. Makes sure that the  submit button has been pressed
   include_once 'database.php';


   $roomtype = mysqli_real_escape_string($conn, $_POST['roomselect']);  //Escape string to prevent SQL injection. Inserts data from form.
   $arrival = mysqli_real_escape_string($conn, $_POST['adate']);
   $depart = mysqli_real_escape_string($conn, $_POST['ddate']);
   $user = mysqli_real_escape_string($conn, $_SESSION['u_name']);



   //Error handler. Comments tell what error is behing handled

  if(empty($roomtype) || empty($arrival) || empty($depart) || empty($user)){

       header("Location: ../buyroom.php?buyroom=empty"); //Prevent empty form.
       exit();
   }else{
          //Username exists
          $sql = "SELECT * FROM roominfo WHERE room_type = '$roomtype' && room_booked = 0"; //Query to see if room type is available
         //Queries user_name
          $results = $conn->query($sql);
          $numrows = $results->num_rows;



          if($numrows > 0){   //Check if there is an unbooked room
            //Purchase update here
            $row = $results->fetch_assoc(); //Get the open row
            $timestamp = date('Y-m-d H:i:s', time());
            $room_id = $row['room_id'];



            $sqlupdate = "UPDATE roominfo
            SET room_booked = 1, room_bookedby = '$user', arrive_date = '$arrival', depart_date = '$depart', book_timestamp = '$timestamp'
            WHERE room_id = '$room_id'";

            mysqli_query($conn, $sqlupdate);

            header("Location: ../reciept.php?buyroom=success");
            exit();
          }else{
            //All rooms of that type are booked
            header("Location: ../buyroom.php?buyroom=roomtypebooked");
            exit();
          }
        }



 }else{
   header("Location: ../signup.php"); //If they didn't press the button, redirect and quit.
   exit();
 }
 ?>
