<?php 
include 'dbconnection.php';
   
if(isset($_POST['d_id'])){
    $stmInsert = $db->prepare('INSERT INTO Donor (D_ID,D_NAME,D_UNAME,D_PASSWORD,D_EMAIL) VALUES (:D_ID,:D_NAME,:D_UNAME,:D_PASSWORD,:D_EMAIL)');
    $params = [
        ':D_ID' => $_POST['d_id'],
        ':D_NAME' => $_POST['d_name'],
        ':D_UNAME' => $_POST['d_uname'],
        ':D_PASSWORD' => $_POST['d_password'],
        ':D_EMAIL' => $_POST['d_email']
    ];
    $resultInsert = $stmInsert->execute($params);
    $response = 'Not Entered';
    if($resultInsert && $stmInsert->rowCount()>0){
        $response = 'Data Entered Successfully';
    }
    echo $response;
} 
?>

<form method="POST">
    <fieldset style="width:30%;text-align: center;margin-left: 515;">
    <h1>Registration</h1>
    <input type="text" name="d_id" placeholder="ID"><br><br>
    <input type="text" name="d_name" placeholder="Name"><br><br>
    <input type="text" name="d_uname" placeholder="Username"><br><br>
    <input type="text" name="d_password" placeholder="Password"><br><br>
    <input type="text" name="d_email" placeholder="Email"><br><br>
    <button type="submit">Signup</button> 
    <a href="login.php">Login</a>
    </fieldset> 
</form>
