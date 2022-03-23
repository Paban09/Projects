<?php 
include 'dbconnection.php';
session_start();
   
if(isset($_POST['d_id'])){
    $sql = 'INSERT INTO Donor (D_ID,D_NAME,D_UNAME,D_PASSWORD,D_EMAIL) VALUES (:D_ID,:D_NAME,:D_UNAME,:D_PASSWORD,:D_EMAIL)';
    if($_POST['id_for_update']){
        $sql = 'UPDATE DONOR SET D_ID = :D_ID, D_NAME= :D_NAME, D_UNAME = :D_UNAME, D_PASSWORD = :D_PASSWORD, D_EMAIL = :D_EMAIL WHERE D_ID = :D_ID';
    }
    $stmInsert = $db->prepare($sql);
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
    //echo $response;
   } 
   $result_for_update = NULL;
   if(isset($_GET['d_id'])){
    $stm = $db->prepare('SELECT * FROM Donor WHERE D_ID = :D_ID');
    $stm->bindParam(':D_ID', $_GET['d_id']);
    $stm->execute();
    $result_for_update = $stm->fetch(PDO::FETCH_OBJ);
   }
?>

<form method="POST">
    <fieldset style="width:30%;text-align: center;margin-left: 515;">
    <h1>Edit Profile</h1>
    <input type="hidden" name="id_for_update" value="<?=$result_for_update? true : false?>">
    <input type="text" name="d_id" placeholder="ID" value="<?=$result_for_update ? $result_for_update->D_ID : ''?>"><br><br>
    <input type="text" name="d_name" placeholder="Name" value="<?=$result_for_update ? $result_for_update->D_NAME : ''?>"><br><br>
    <input type="text" name="d_uname" placeholder="Username" value="<?=$result_for_update ? $result_for_update->D_UNAME : ''?>"><br><br>
    <input type="text" name="d_password" placeholder="Password" value="<?=$result_for_update ? $result_for_update->D_PASSWORD : ''?>"><br><br>
    <input type="text" name="d_email" placeholder="Email" value="<?=$result_for_update ? $result_for_update->D_EMAIL : ''?>"><br><br>
    <button type="submit">Save</button> 
    <h3>
    <a href="viewDonor.php">View Profile</a>
</h3>
    </fieldset> 
</form>
