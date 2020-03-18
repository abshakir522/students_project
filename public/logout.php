<?php require_once("../include/sessions.php");  ?>
<?php require_once("../include/functions.php"); ?>
<?php 
    $_SESSION["admin_id"] = null;
    $_SESSION["username"] = null;
    redirect_to("login.php");

?>