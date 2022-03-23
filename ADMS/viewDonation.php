<?php 
include 'dbconnection.php';
session_start();
    
    try{
        $stm = $db->prepare('SELECT * FROM Donation');
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo $e->getMessage();
    }

    try{
        $stm = $db->prepare("SELECT * FROM Donation");
        $stm->execute();
        $result_admin = $stm->fetchAll(PDO::FETCH_OBJ);
    }catch(PDOException $e){
        echo $e->getMessage();
    }

    if(isset($_GET['delete_id'])){
    $stm = $db->prepare('DELETE FROM Donation WHERE DO_ID = :DO_ID');
    $stm->bindParam(':DO_ID', $_GET['delete_id']);
    $stm->execute();
    // $res = $stm->fetch(PDO::FETCH_OBJ);
    // $response = 'No Data';
    // if($res){
    //     $stm = $db->prepare('DELETE FROM Admin WHERE A_ID = :A_ID');
    //     $stm->bindParam(':A_ID', $_GET['delete_id']);
    //     $stm->execute();
    //     $response = ($stm->rowCount()>0) ? 'Data Deleted' : 'Delete not Completed';
    //}
    //echo $response;
   }
?>

<fieldset style="width:35%;text-align: center;margin-left: 460;">
<h1>Donation Details</h1>
<form method="get">
    <input type="text" name="flname" placeholder="First Name/Last Name">
    <?php foreach ($result_admin as $key => $value):
        ?>
    <?php endforeach; ?>
    <button type="submit">Search</button>
</form>

    <table border="1">
    <tr>
        <th>ID</th>
        <th>AMOUNT</th>
        <th>DONOR ID</th>
        <th>Transaction For ID</th>

        <th>Action</th>
    </tr>
    <?php 
      foreach ($result as $key => $value):
    ?>
    <tr>
        <td><?=$value['DO_ID']?></td>
        <td><?=$value['DO_AMOUNT']?></td>
        <td><?=$value['D_ID']?></td>
        <td><?=$value['TF_ID']?></td>

        <td>
            <a href="editDonation.php?p_id=<?=$value['DO_ID']?>">Edit</a>
            <a href="viewDonation.php?delete_id=<?=$value['DO_ID']?>">Delete</a>
        </td>
    </tr>
<?php endforeach; ?>
    </table>
    <h3>
    <a href="donorDashboard.php">Back to Dashboard</a>
</h3>
</fieldset>

