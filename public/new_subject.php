<?php require_once("../include/db_connection.php");  ?>
<?php require_once("../include/functions.php"); ?>
<?php include("../include/layout/header.php") ?>
<?php 
	find_selected_page();

?>
<div id="main">
    <div id="navigation">
		<?php echo navigation($current_subject ,$current_page); ?>
		<a href="new_subject.php">+ Add Subject</a>
		

	</div>

    <div id="page">
    <h1>Create New Subject</h1>

    <form action="create_subject.php" method="POST">
    <p class="menu-name">Menu Name:
        <input type="text" name="menu_name" value="">
    </p>

    <p class="position"> Position
    <select name="position">
        <?php 
        $subject_set = get_all_subjects();
        $count = mysqli_num_rows($subject_set)+1;
        for ($i=1; $i < $count; $i++) { 
            echo "<option value=\"{$i}\">{$i}</option>";
        }
        
        ?>
        
    </select>
    </p>
    <p>Visible
      <input type="radio" name="visible" value="1">Yes
      <input type="radio" name="visible" value="0">No
    
    </p>
    <p>
    <input type="submit" name="submit" Value="Create Subject">
    </p>
    </form>
    <a href="manage_content.php">Cancel</a>
		
    </div>
</div>
<?php include("../include/layout/footer.php") ?>