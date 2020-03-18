<?php require_once("../include/sessions.php");  ?>
<?php require_once("../include/db_connection.php");  ?>
<?php require_once("../include/functions.php"); ?>

<?php
$username = "";

if (isset($_POST['submit'])) {
  // Process the form
		$username = $_POST["username"];
		$password = $_POST["password"];
		
		$found_admin = attempt_login($username, $password);

    if ($found_admin) {
      // Success
        // Mark user as logged in
        $_SESSION["admin_id"] = $found_admin["id"];
        $_SESSION["username"] = $found_admin["username"];
        redirect_to("admin.php");
    } else {
      // Failure
      $_SESSION["mess"] = "Username/password not found.";
    }
  
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>

<?php $layout_context = "admin"; ?>
<?php include("../include/layout/header.php"); ?>
<div id="main">
  <div id="navigation">
    &nbsp;
  </div>
  <div id="page">
    <?php echo showMessage(); ?>
    
    <h2>Login</h2>
    <form action="login.php" method="post">
      <p>Username:
        <input type="text" name="username" value="<?php echo htmlentities($username); ?>" />
      </p>
      <p>Password:
        <input type="password" name="password" value="" />
      </p>
      <input type="submit" name="submit" value="Submit" />
    </form>
  </div>
</div>

<?php include("../include/layout/footer.php"); ?>
