<?php 
session_start();
?>

    <fieldset style="width:40%;text-align: center;margin-left: 420;">
    <legend>DONOR</legend>
    <?php 
        if(isset($_SESSION['username'])){
            echo "<h1> Welcome ".$_SESSION['username']."!</h1>";
        }
       ?>
    <p>Welcome to Donor Dashboard!</p>
    <a href="viewDonor.php">Donor Profile</a>
    <br>
    <a href="Logout.php">Logout</a>
    </fieldset>

