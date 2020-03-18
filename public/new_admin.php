<?php require_once("../include/sessions.php");  ?>
<?php require_once("../include/db_connection.php");  ?>
<?php require_once("../include/functions.php"); ?>
<?php
if (isset($_POST['submit'])) {
    

    $username = mysqli_real_escape_string($connection, $_POST["username"]);
    $hashed_password = mysqli_real_escape_string($connection,$_POST["password"]);
    
    $query  = "INSERT INTO admins (";
    $query .= "  username, password";
    $query .= ") VALUES (";
    $query .= "  '{$username}', '{$hashed_password}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
      // Success
      $_SESSION["mess"] = "Admin created.";
      redirect_to("manage_admins.php");
    } else {
      // Failure
      $_SESSION["mess"] = "Admin creation failed.";
    }
  
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>
<?php include("../include/layout/header.php") ?>
<div id="main">
  <div id="navigation">
    &nbsp;
  </div>
  <div id="page">
    <?php echo showMessage(); ?>
    
    <h2>Create Admin</h2>
    <form action="new_admin.php" method="post">
      <p>Username:
        <input type="text" name="username" value="" />
      </p>
      <p>Password:
        <input type="password" name="password" value="" />
      </p>
      <input type="submit" name="submit" value="Create Admin" />
    </form>
    <br />
    <a href="manage_admins.php">Cancel</a>
  </div>
</div>

<?php include("../include/layout/footer.php") ?>
