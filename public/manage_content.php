<?php require_once("../include/db_connection.php");  ?>
<?php require_once("../include/functions.php"); ?>
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
				<li><?php echo $subject["menu_name"]; ?>
					
					<?php
						// 2. Perform database query
						$page_set = get_pages_for_subject($subject["id"]);
					?>
					<ul class="pages">
					<?php
						while($page = mysqli_fetch_assoc($page_set)) {
					?>
						<li><?php echo $page["menu_name"]; ?></li>
					<?php } ?>
					
					</ul>
				</li>
			<?php } ?>
		    
		</ul>
		<?php mysqli_free_result($subject_set); ?>
		</div>

    <div id="page">
        <h2>Manage Content</h2>
    </div>
</div>
<?php include("../include/layout/footer.php") ?>

<!-- <?php if(true){  ?>
	<h1><?php $var_name ?></h1>
<?php } else{ ?>
	<h1>Hi</h1>
<?php } ?> -->
