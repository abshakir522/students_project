<?php require_once("../include/sessions.php");  ?>
<?php require_once("../include/db_connection.php");  ?>
<?php require_once("../include/functions.php"); ?>
<?php find_selected_page(); ?>
<?php include("../include/layout/header.php") ?>

<div id="main">
    <div id="navigation">
		<?php echo navigation($current_subject ,$current_page); ?>
		<a href="new_subject.php">+ Add Subject</a>
	</div>


    <div id="page">
        <?= showMessage(); ?> 
    <h1>Edit Subject</h1>
    <form action="" method="POST">
    <p class="menu-name">Menu Name:
        <input type="text" name="menu_name" value="<?= $current_subject['menu_name']; ?>">
    </p>

    <p class="position"> Position
    <select name="position">
        <?php 
        $subject_set = get_all_subjects();
        $count = mysqli_num_rows($subject_set)+1;
        for ($i=1; $i < $count; $i++) { 
            echo "<option value=\"{$i}\"";
            if($i == $current_subject['position']){
                echo "selected";
            }
            echo ">{$i}</option>";
        }
        
        ?>
        
    </select>
    </p>
    <p>Visible
      <input type="radio" name="visible" value="1" <?php if($current_subject['visible'] == 1) echo "checked"; ?> >Yes
      <input type="radio" name="visible" value="0" <?php if($current_subject['visible'] == 0) echo "checked"; ?>>No
    
    </p>
    <p>
    <input type="submit" name="submit" Value="Edit Subject">
    </p>
    </form>
    <a href="manage_content.php">Cancel</a>
		
    </div>
</div>
<?php include("../include/layout/footer.php") ?>