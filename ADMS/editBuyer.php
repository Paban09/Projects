<?php 
include 'dbconnection.php';
session_start();
   
if(isset($_POST['b_id'])){
    $sql = 'INSERT INTO Buyer (B_ID,B_NAME,B_UNAME,B_PASSWORD,B_EMAIL) VALUES (:B_ID,:B_NAME,:B_UNAME,:B_PASSWORD,:B_EMAIL)';
    if($_POST['id_for_update']){
        $sql = 'UPDATE BUYER SET B_ID = :B_ID, B_NAME= :B_NAME, B_UNAME = :B_UNAME, B_PASSWORD = :B_PASSWORD, B_EMAIL = :B_EMAIL WHERE B_ID = :B_ID';
    }
    $stmInsert = $db->prepare($sql);
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
    //echo $response;
   } 
   $result_for_update = NULL;
   if(isset($_GET['b_id'])){
    $stm = $db->prepare('SELECT * FROM Buyer WHERE B_ID = :B_ID');
    $stm->bindParam(':B_ID', $_GET['b_id']);
    $stm->execute();
    $result_for_update = $stm->fetch(PDO::FETCH_OBJ);
   }
?>

<form method="POST">
    <fieldset style="width:30%;text-align: center;margin-left: 515;">
    <h1>Edit Profile</h1>
    <input type="hidden" name="id_for_update" value="<?=$result_for_update? true : false?>">
    <input type="text" name="b_id" placeholder="ID" value="<?=$result_for_update ? $result_for_update->B_ID : ''?>"><br><br>
    <input type="text" name="b_name" placeholder="Name" value="<?=$result_for_update ? $result_for_update->B_NAME : ''?>"><br><br>
    <input type="text" name="b_uname" placeholder="Username" value="<?=$result_for_update ? $result_for_update->B_UNAME : ''?>"><br><br>
    <input type="text" name="b_password" placeholder="Password" value="<?=$result_for_update ? $result_for_update->B_PASSWORD : ''?>"><br><br>
    <input type="text" name="b_email" placeholder="Email" value="<?=$result_for_update ? $result_for_update->B_EMAIL : ''?>"><br><br>
    <button type="submit">Save</button> 
    <h3>
    <a href="viewBuyer.php">View Profile</a>
</h3>
    </fieldset> 
</form>
