<?php require_once("../include/db_connection.php") ?>
<?php
	// 2. Perform database query
	$query  = "SELECT * ";
	$query .= "FROM subjects ";
	$query .= "WHERE visible = 1 ";
	$query .= "ORDER BY position ASC";
	$result = mysqli_query($connection, $query);
	// Test if there was a query error
	if (!$result) {
		die("Database query failed.");
	}
?>
<?php include("../include/layout/header.php") ?>
<div id="main">
    <div id="navigation">
		<ul>
			<?php
				// 3. Use returned data (if any)
				while($subject = mysqli_fetch_assoc($result)) {
					// output data from each row
			?>
				<li><?php echo $subject["menu_name"] . " (" . $subject["id"] . ")"; ?></li>
			<?php } ?>
		    
		</ul>
		<?php mysqli_free_result($result); ?>
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
