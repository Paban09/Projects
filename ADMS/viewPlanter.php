<?php 
include 'dbconnection.php';
session_start();
    
    try{
        $stm = $db->prepare('SELECT * FROM Planter');
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo $e->getMessage();
    }

    try{
        $stm = $db->prepare("SELECT * FROM Planter");
        $stm->execute();
        $result_admin = $stm->fetchAll(PDO::FETCH_OBJ);
    }catch(PDOException $e){
        echo $e->getMessage();
    }

    if(isset($_GET['delete_id'])){
    $stm = $db->prepare('DELETE FROM Planter WHERE P_ID = :P_ID');
    $stm->bindParam(':P_ID', $_GET['delete_id']);
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
<h1>Planter Profile</h1>
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
        <th>NAME</th>
        <th>USERNAME</th>
        <th>PASSWORD</th>
        <th>EMAIL</th>
        <th>Action</th>
    </tr>
    <?php 
      foreach ($result as $key => $value):
    ?>
    <tr>
        <td><?=$value['P_ID']?></td>
        <td><?=$value['P_NAME']?></td>
        <td><?=$value['P_UNAME']?></td>
        <td><?=$value['P_PASSWORD']?></td>
        <td><?=$value['P_EMAIL']?></td>
        <td>
            <a href="editPlanter.php?p_id=<?=$value['P_ID']?>">Edit</a>
            <a href="viewPlanter.php?delete_id=<?=$value['P_ID']?>">Delete</a>
        </td>
    </tr>
<?php endforeach; ?>
    </table>
    <h3>
    <a href="planterDashboard.php">Back to Dashboard</a>
</h3>
</fieldset>

