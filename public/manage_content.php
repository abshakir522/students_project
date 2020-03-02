<?php require_once("../include/db_connection.php");  ?>
<?php require_once("../include/functions.php"); ?>
<?php 
	if(isset($_GET['subject'])){
		$selected_subject = $_GET['subject'];
		$selected_page = null;

	}elseif(isset($_GET['page'])){
		$selected_page = $_GET['page'];
		$selected_subject = null;

	}else{
		$selected_subject = null;
		$selected_page = null;
	}

?>
<?php
	// 2. Perform database query
	$subject_set = get_all_subjects();
?>
<?php include("../include/layout/header.php") ?>
<div id="main">
    <div id="navigation">
		<ul class="subjects">
			<?php
				// 3. Use returned data (if any)
				while($subject = mysqli_fetch_assoc($subject_set)) {
					// output data from each row
			?>

				<li class="<?php if($subject['id'] == $selected_subject){ echo "selected";}?>">
					<a href="manage_content.php?subject=<?= $subject['id']?>"><?php echo $subject["menu_name"]; ?></a>
					
					<?php
						// 2. Perform database query
						$page_set = get_pages_for_subject($subject["id"]);
					?>
					<ul class="pages">
					<?php
						while($page = mysqli_fetch_assoc($page_set)) {
					?>
						<li class="<?php if($page['id'] == $selected_page){ echo "selected";}?>">
							<a href="manage_content.php?page=<?= $page['id']; ?>"><?php echo $page["menu_name"]; ?></a>
						</li>
					<?php } ?>
					
					</ul>
				</li>
			<?php } ?>
		    
		</ul>
		<?php mysqli_free_result($subject_set); ?>
		</div>

    <div id="page">
		<h2>Manage Content</h2>
		
		<?php echo $selected_subject; ?>
		<?php echo $selected_page; ?>
    </div>
</div>
<?php include("../include/layout/footer.php") ?>