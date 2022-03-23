<?php 
include 'dbconnection.php';
   
if(isset($_POST['a_id'])){
    $stmInsert = $db->prepare('INSERT INTO Planter (P_ID,P_NAME,P_UNAME,P_PASSWORD,P_EMAIL) VALUES (:P_ID,:P_NAME,:P_UNAME,:P_PASSWORD,:P_EMAIL)');
    $params = [
        ':P_ID' => $_POST['p_id'],
        ':P_NAME' => $_POST['p_name'],
        ':P_UNAME' => $_POST['p_uname'],
        ':P_PASSWORD' => $_POST['p_password'],
        ':P_EMAIL' => $_POST['p_email']
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
    <input type="text" name="p_id" placeholder="ID"><br><br>
    <input type="text" name="p_name" placeholder="Name"><br><br>
    <input type="text" name="p_uname" placeholder="Username"><br><br>
    <input type="text" name="p_password" placeholder="Password"><br><br>
    <input type="text" name="p_email" placeholder="Email"><br><br>
    <button type="submit">Signup</button> 
    <a href="login.php">Login</a>
    </fieldset> 
</form>
