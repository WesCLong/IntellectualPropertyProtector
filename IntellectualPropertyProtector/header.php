<?php
 //Session starts if a user is logged in
 session_start();
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="master.css">
  </head>



  <style id="antiClickjack">body{display:none !important;}</style>
  <script type="text/javascript">
   if (self === top) {
       var antiClickjack = document.getElementById("antiClickjack");
       antiClickjack.parentNode.removeChild(antiClickjack);
   } else {
       top.location = self.location;
   }
 </script>


  <body>
    <header>
      <nav>
        <div class="main-wrapper">
            <ul>
              <li><a href= "index.php">Home</a></li>

              <li><a href="FindStolenItems.php">Search!</a></li>

            </ul>
            <div class="nav-login">
           <?php
            if(isset($_SESSION['u_id'])){
              echo '

              <form action="Assets/logout.php" method="POST">
                 <h3>' . $_SESSION['u_name'] . ' <h3>
                 <button type="submit" name="submit">Logout</button>
              </form>';
            }else{
              echo '   <form action = "Assets/login.php" method = "POST">
                       <input type="text" name="uid" placeholder="Username">
                       <input type="password" name="password" placeholder = "Password">
                       <button type="submit" name="submit">Sign In</button>
                       </form>
                       <a href="signup.php">Sign up!</a>';
           }



            ?>









            </div>
        </div>
      </nav>
    </header>
