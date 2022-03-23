<fieldset style="width:40%;text-align: center;margin-left: 420;">
    <legend>ADMIN</legend>
    <?php 
    session_start();
        if(!empty($_SESSION['A_NAME'])){
            
            echo "<h1> Welcome ".$_SESSION['A_NAME']."!</h1>";
        }
       ?>
    <p>Welcome to Admin Dashboard!</p>
    <a href="viewAdmin.php">Admin Profile</a>
    <br>
    <a href="viewVolunteer.php">Volunteer Profile</a>
    <br>
    <a href="viewPlanter.php">Planter Profile</a>
    <br>
    <a href="viewBuyer.php">Buyer Profile</a>
    <br>
    <a href="viewDonor.php">Donor Profile</a>
    <br>
    <a href="">Total Donation</a>
    <br>
    <a href="">Planted Trees</a>
    <br>
    <a href="Logout.php">Logout</a>
    </fieldset>

