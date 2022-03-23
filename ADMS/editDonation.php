<?php 
include 'dbconnection.php';
session_start();
   
if(isset($_POST['do_id'])){
    $sql = 'INSERT INTO DONATION (DO_ID, DO_AMOUNT, D_ID, TF_ID) VALUES (:DO_ID, :DO_AMOUNT, :D_ID, :TF_ID)';
    if($_POST['id_for_update']){
        $sql = 'UPDATE DONATION SET DO_ID = :DO_ID, DO_AMOUNT= :DO_AMOUNT, D_ID = :D_ID, TF_ID = :TF_ID WHERE DO_ID = :DO_ID';
    }
    $stmInsert = $db->prepare($sql);
    $params = [
        ':DO_ID' => $_POST['do_id'],
        ':DO_AMOUNT' => $_POST['do_amount'],
        ':D_ID' => $_POST['d_id'],
        ':TF_ID' => $_POST['tf_id']
 ];
    $resultInsert = $stmInsert->execute($params);
    $response = 'Not Entered';
    if($resultInsert && $stmInsert->rowCount()>0){
        $response = 'Data Entered Successfully';
    }
    //echo $response;
   } 
   $result_for_update = NULL;
   if(isset($_GET['do_id'])){
    $stm = $db->prepare('SELECT * FROM DONATION WHERE DO_ID = :DO_ID');
    $stm->bindParam(':DO_ID', $_GET['do_id']);
    $stm->execute();
    $result_for_update = $stm->fetch(PDO::FETCH_OBJ);
   }
?>

<form method="POST">
    <fieldset style="width:30%;text-align: center;margin-left: 515;">
    <h1>Edit Donation</h1>
    <input type="hidden" name="id_for_update" value="<?=$result_for_update? true : false?>">
    <input type="text" name="do_id" placeholder="ID" value="<?=$result_for_update ? $result_for_update->DO_ID : ''?>"><br><br>
    <input type="text" name="do_amount" placeholder="Amount" value="<?=$result_for_update ? $result_for_update->DO_AMOUNT : ''?>"><br><br>
    <input type="text" name="d_id" placeholder="Donor ID" value="<?=$result_for_update ? $result_for_update->D_ID : ''?>"><br><br>
    <input type="text" name="tf_id" placeholder="Transaction for ID" value="<?=$result_for_update ? $result_for_update->TF_ID : ''?>"><br><br>

    <button type="submit">Save</button> 
    <h3>
    <a href="viewDonation.php">View Profile</a>
</h3>
    </fieldset> 
</form>
