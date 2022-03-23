<?php 
include 'dbconnection.php';
session_start();
   
if(isset($_POST['p_id'])){
    $sql = 'INSERT INTO Planter (P_ID,P_NAME,P_UNAME,P_PASSWORD,P_EMAIL) VALUES (:P_ID,:P_NAME,:P_UNAME,:P_PASSWORD,:P_EMAIL)';
    if($_POST['id_for_update']){
        $sql = 'UPDATE PLANTER SET P_ID = :P_ID, P_NAME= :P_NAME, P_UNAME = :P_UNAME, P_PASSWORD = :P_PASSWORD, P_EMAIL = :P_EMAIL WHERE P_ID = :P_ID';
    }
    $stmInsert = $db->prepare($sql);
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
    //echo $response;
   } 
   $result_for_update = NULL;
   if(isset($_GET['p_id'])){
    $stm = $db->prepare('SELECT * FROM Planter WHERE P_ID = :P_ID');
    $stm->bindParam(':P_ID', $_GET['p_id']);
    $stm->execute();
    $result_for_update = $stm->fetch(PDO::FETCH_OBJ);
   }
?>

<form method="POST">
    <fieldset style="width:30%;text-align: center;margin-left: 515;">
    <h1>Edit Profile</h1>
    <input type="hidden" name="id_for_update" value="<?=$result_for_update? true : false?>">
    <input type="text" name="p_id" placeholder="ID" value="<?=$result_for_update ? $result_for_update->P_ID : ''?>"><br><br>
    <input type="text" name="p_name" placeholder="Name" value="<?=$result_for_update ? $result_for_update->P_NAME : ''?>"><br><br>
    <input type="text" name="p_uname" placeholder="Username" value="<?=$result_for_update ? $result_for_update->P_UNAME : ''?>"><br><br>
    <input type="text" name="p_password" placeholder="Password" value="<?=$result_for_update ? $result_for_update->P_PASSWORD : ''?>"><br><br>
    <input type="text" name="p_email" placeholder="Email" value="<?=$result_for_update ? $result_for_update->P_EMAIL : ''?>"><br><br>
    <button type="submit">Save</button> 
    <h3>
    <a href="viewPlanter.php">View Profile</a>
</h3>
    </fieldset> 
</form>
