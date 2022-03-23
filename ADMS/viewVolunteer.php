<?php 
include 'dbconnection.php';
session_start();
    
    try{
        $stm = $db->prepare('SELECT * FROM Volunteer');
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo $e->getMessage();
    }

    try{
        $stm = $db->prepare("SELECT * FROM Volunteer");
        $stm->execute();
        $result_admin = $stm->fetchAll(PDO::FETCH_OBJ);
    }catch(PDOException $e){
        echo $e->getMessage();
    }

    if(isset($_GET['delete_id'])){
    $stm = $db->prepare('DELETE FROM Volunteer WHERE V_ID = :V_ID');
    $stm->bindParam(':V_ID', $_GET['delete_id']);
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
<h1>Volunteer Profile</h1>
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
        <td><?=$value['V_ID']?></td>
        <td><?=$value['V_NAME']?></td>
        <td><?=$value['V_UNAME']?></td>
        <td><?=$value['V_PASSWORD']?></td>
        <td><?=$value['V_EMAIL']?></td>
        <td>
            <a href="editVolunteer.php?v_id=<?=$value['V_ID']?>">Edit</a>
            <a href="viewVolunteer.php?delete_id=<?=$value['V_ID']?>">Delete</a>
        </td>
    </tr>
<?php endforeach; ?>
    </table>
    <h3>
    <a href="volunteerDashboard.php">Back to Dashboard</a>
</h3>
</fieldset>

