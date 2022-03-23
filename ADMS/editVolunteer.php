<?php 
include 'dbconnection.php';
session_start();
   
if(isset($_POST['v_id'])){
    $sql = 'INSERT INTO Volunteer (V_ID,V_NAME,V_UNAME,V_PASSWORD,V_EMAIL) VALUES (:V_ID,:V_NAME,:V_UNAME,:V_PASSWORD,:V_EMAIL)';
    if($_POST['id_for_update']){
        $sql = 'UPDATE VOLUNTEER SET V_ID = :V_ID, V_NAME= :V_NAME, V_UNAME = :V_UNAME, V_PASSWORD = :V_PASSWORD, V_EMAIL = :V_EMAIL WHERE V_ID = :V_ID';
    }
    $stmInsert = $db->prepare($sql);
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
    //echo $response;
   } 
   $result_for_update = NULL;
   if(isset($_GET['v_id'])){
    $stm = $db->prepare('SELECT * FROM VOLUNTEER WHERE V_ID = :V_ID');
    $stm->bindParam(':V_ID', $_GET['v_id']);
    $stm->execute();
    $result_for_update = $stm->fetch(PDO::FETCH_OBJ);
   }
?>

<form method="POST">
    <fieldset style="width:30%;text-align: center;margin-left: 515;">
    <h1>Edit Profile</h1>
    <input type="hidden" name="id_for_update" value="<?=$result_for_update? true : false?>">
    <input type="text" name="v_id" placeholder="ID" value="<?=$result_for_update ? $result_for_update->V_ID : ''?>"><br><br>
    <input type="text" name="v_name" placeholder="Name" value="<?=$result_for_update ? $result_for_update->V_NAME : ''?>"><br><br>
    <input type="text" name="v_uname" placeholder="Username" value="<?=$result_for_update ? $result_for_update->V_UNAME : ''?>"><br><br>
    <input type="text" name="v_password" placeholder="Password" value="<?=$result_for_update ? $result_for_update->V_PASSWORD : ''?>"><br><br>
    <input type="text" name="v_email" placeholder="Email" value="<?=$result_for_update ? $result_for_update->V_EMAIL : ''?>"><br><br>
    <button type="submit">Save</button> 
    <h3>
    <a href="viewVolunteer.php">View Profile</a>
</h3>
    </fieldset> 
</form>
