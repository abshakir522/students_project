<?php require_once("../include/sessions.php");  ?>
<?php require_once("../include/db_connection.php");  ?>
<?php require_once("../include/functions.php"); ?>
<?php
	$current_subject = get_subject_by_id($_GET["subject"]);
	if (!$current_subject) {
		// subject ID was missing or invalid or 
		// subject couldn't be found in database
		redirect_to("manage_content.php");
	}
	
	$pages_set = get_pages_for_subject($current_subject["id"]);
	if (mysqli_num_rows($pages_set) > 0) {
		$_SESSION["message"] = "Can't delete a subject with pages.";
		redirect_to("manage_content.php?subject={$current_subject["id"]}");
	}
	
	$id = $current_subject["id"];
	$query = "DELETE FROM subjects WHERE id = {$id} LIMIT 1";
	$result = mysqli_query($connection, $query);

	if ($result && mysqli_affected_rows($connection) == 1) {
		// Success
		$_SESSION["mess"] = "Subject deleted.";
		redirect_to("manage_content.php");
	} else {
		// Failure
		$_SESSION["mess"] = "Subject deletion failed.";
		redirect_to("manage_content.php?subject={$id}");
	}
	
?>
