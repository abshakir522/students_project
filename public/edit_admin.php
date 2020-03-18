<?php require_once("../include/sessions.php");  ?>
<?php require_once("../include/db_connection.php");  ?>
<?php require_once("../include/functions.php"); ?>
<?php
  
  $admin_set = get_all_admins();
?>
<?php 
if (isset($_POST['submit'])) {
    $user_id = $_GET['id'];
    $user_name = $_POST['admin_name'];
    $password = $_POST['pass'];
    $query = "UPDATE admins set username='{$user_name}', password='{$password}' ";
    $query .= "where id={$user_id}";
    $result = mysqli_query($connection, $query);
    if($result){
       redirect_to('manage_admins.php');
    }else {
        # code...
        echo "<p>Admin not Updated. There might be some problem.</p>";
    }
}else {
    
}

?>
<?php include("../include/layout/header.php") ?>
<div id="main">
  <div id="navigation">
		<br />
  </div>
  <div id="page">
    <h2>Edit Admin</h2>
    <form action="edit_admin.php?id=<?=$_GET['id']?>" method="post">
        <p>Name:
        <input type="text" name="admin_name">
        </p>
        <p>Password:
        <input type="password" name="pass">
        </p>
        <p>
        <input type="submit" name="submit">
        </p>
    
    </form>
    <br />
    <a href="new_admin.php">Add new admin</a>
  </div>
</div>
<?php include("../include/layout/footer.php") ?>
