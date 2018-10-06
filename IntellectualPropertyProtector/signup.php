<?php
    include_once 'header.php';
?>
<!-- Sign up form for the user-->
   <section class = "main-container">
     <div class="main-wrapper">
       <h2>Signup</h2>
       <form class = "signup-form" action="Assets/Registration.php" method = "POST">
         <input type="text" name="uid" placeholder= "Username">
         <input type="text" name="email" placeholder= "Email">
         <input type="password" name="pass1" placeholder= "Password">
         <input type="password" name="pass2" placeholder= "Password">
         <button type="submit" name="submit">Sign up</button>
       </form>

     </div>
   </section>

<?php
   include_once 'footer.php';
?>
