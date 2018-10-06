
<?php
    include_once 'header.php';

?>

   <section class = "main-container">
     <div class="main-wrapper">
       <h2>Purchase room</h2>
       <form class = "signup-form" action="Assets/purchase.php" method = "POST">
          <select name = "roomselect">
            <option value="standard">Standard</option>
            <option value="plus">Plus</option>
            <option value="delux">Delux</option>
          </select>
            <h3>Arrival Date</h3><input name="adate" type="date" min = "<?php echo date('Y-m-d')?>" max = "2050-01-01">
            <h3>Depart Date</h3><input name="ddate" type="date" min = "<?php echo date('Y-m-d')?>" max = "2050-01-01">



           <button type="submit" name="submit">Purchase</button>
       </form>

     </div>
   </section>

<?php
   include_once 'footer.php';
?>
