<?php 
include 'dbconnection.php';
   
if(isset($_POST['b_id'])){
    $stmInsert = $db->prepare('INSERT INTO Buyer (B_ID,B_NAME,B_UNAME,B_PASSWORD,B_EMAIL) VALUES (:B_ID,:B_NAME,:B_UNAME,:B_PASSWORD,:B_EMAIL)');
    $params = [
        ':B_ID' => $_POST['b_id'],
        ':B_NAME' => $_POST['b_name'],
        ':B_UNAME' => $_POST['b_uname'],
        ':B_PASSWORD' => $_POST['b_password'],
        ':B_EMAIL' => $_POST['b_email']
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
    <input type="text" name="b_id" placeholder="ID"><br><br>
    <input type="text" name="b_name" placeholder="Name"><br><br>
    <input type="text" name="b_uname" placeholder="Username"><br><br>
    <input type="text" name="b_password" placeholder="Password"><br><br>
    <input type="text" name="b_email" placeholder="Email"><br><br>
    <button type="submit">Signup</button> 
    <a href="login.php">Login</a>
    </fieldset> 
</form>
