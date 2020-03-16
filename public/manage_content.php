<?php require_once("../include/sessions.php");  ?>
<?php require_once("../include/db_connection.php");  ?>
<?php require_once("../include/functions.php"); ?>
<?php 
	find_selected_page();
?>

<?php include("../include/layout/header.php") ?>
<div id="main">
    <div id="navigation">
		<?php echo navigation($current_subject ,$current_page); ?>
		<a href="new_subject.php">+ Add Subject</a>
	</div>

    <div id="page">
		<?php echo showMessage(); ?>
		<?php if ($current_subject) { ?>
				<h1>Manage Subject</h1>
		<?php 
			echo $current_subject['menu_name']; ?>
				<br />
				<br />
				<a href="edit_subject.php?subject=<?= $current_subject['id']; ?>">Edit subject</a>
				<a href="delete_subject.php?subject=<?= $current_subject['id']; ?>">Delete Subject</a>
			<?php }elseif($current_page){ ?>
			<h2>Mange Page</h2>
			<?php
			echo $current_page['menu_name'];

			}else{
				echo "Please select a subject or page";
				
			}
		?>
    </div>
</div>
<?php include("../include/layout/footer.php") ?>