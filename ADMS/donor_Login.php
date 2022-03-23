 <?php 

include 'dbconnection.php';
$username = '';
$password = '';

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)){
        echo "Username or Password is required.";
    }
    else{
        $stm = $db->prepare('SELECT D_ID FROM DONOR WHERE D_UNAME = :D_UNAME AND D_PASSWORD = :D_PASSWORD');
        $stm-> bindParam(':D_UNAME',$username);
        $stm-> bindParam(':D_PASSWORD',$password);  
        $stm-> execute();
        $result = $stm->fetch(PDO::FETCH_OBJ);
        if($result){
            header('location: donorDashboard.php');
        }
        else{
            echo "Login Failed";
        }
    }
}

?>

<form method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <br> <br>
    <fieldset style="width:30%;text-align: center;margin-left: 515;">
    <legend>LOGIN</legend>
    <input type="text" name="username" placeholder="username" value="<?= $username? $username:''?>"><br> <br>
    <input type="password" name="password" placeholder="password" value="<?= $password? $password:''?>"><br><br>
    <button type="submit" name="submit" value="Submit">Login</button>
    </fieldset>
</form>



