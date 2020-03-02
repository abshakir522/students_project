<?php require_once("../include/db_connection.php");  ?>
<?php require_once("../include/functions.php"); ?>
<?php 
	if(isset($_GET['subject'])){
		$current_subject = get_subject_by_id($_GET['subject']);
		$current_page = null;

	}elseif(isset($_GET['page'])){
		$current_page = get_page_by_id($_GET['page']);
		$current_subject = null;

	}else{
		$current_subject = null;
		$current_page = null;
		
	}

?>
<?php
	// 2. Perform database query
	$subject_set = get_all_subjects();
?>
<?php include("../include/layout/header.php") ?>
<div id="main">
    <div id="navigation">
		<?php echo navigation($current_subject ,$current_page);?>
	</div>

    <div id="page">
		<?php if ($current_subject) { ?>
				<h1>Manage Subject</h1>
		<?php 
			echo $current_subject['menu_name'];

			}elseif($current_page){ ?>
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