<?php
    include_once 'header.php';
    include_once 'Assets/database.php'; //Include database for query

      $user = $_SESSION['u_name'];
      $sql = "SELECT * FROM roominfo WHERE room_bookedby = '$user'";
      $results = $conn->query($sql);

      $row = $results->fetch_assoc(); //Get the row of the user's purchase
?>

<div class="reciept">
<?php
      echo'We confirmed your purchase!';
      echo'You have booked room '. $row['room_number'] . ' for $' . $row['price'] . 'per day. ';
      echo'Your room will be available '. $row['arrive_date'] .' 9:00AM ';
      echo'<h2>Purchase processed on '. $row['book_timestamp']. '.';    //Echo Timestamp
 ?>
 </div>



<?php
   include_once 'footer.php';
?>
