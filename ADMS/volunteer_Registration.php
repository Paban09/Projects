<?php 
include 'dbconnection.php';
   
if(isset($_POST['v_id'])){
    $stmInsert = $db->prepare('INSERT INTO Volunteer (V_ID,V_NAME,V_UNAME,V_PASSWORD,V_EMAIL) VALUES (:V_ID,:V_NAME,:V_UNAME,:V_PASSWORD,:V_EMAIL)');
    $params = [
        ':V_ID' => $_POST['v_id'],
        ':V_NAME' => $_POST['v_name'],
        ':V_UNAME' => $_POST['v_uname'],
        ':V_PASSWORD' => $_POST['v_password'],
        ':V_EMAIL' => $_POST['v_email']
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
    <input type="text" name="v_id" placeholder="ID"><br><br>
    <input type="text" name="v_name" placeholder="Name"><br><br>
    <input type="text" name="v_uname" placeholder="Username"><br><br>
    <input type="text" name="v_password" placeholder="Password"><br><br>
    <input type="text" name="v_email" placeholder="Email"><br><br>
    <button type="submit">Signup</button> 
    <a href="login.php">Login</a>
    </fieldset> 
</form>
