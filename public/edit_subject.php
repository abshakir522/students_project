<?php require_once("../include/sessions.php");  ?>
<?php require_once("../include/db_connection.php");  ?>
<?php require_once("../include/functions.php"); ?>
<?php find_selected_page(); ?>
<?php 
if(isset($_POST['submit'])){
    $id = $current_subject['id'];
    $menu_name = mysqli_real_escape_string($connection, $_POST['menu_name']);
    $position = $_POST['position'];
    $visible = $_POST['visible'];
    $query  = "update subjects set ";
    $query .= "menu_name = '{$menu_name}', ";
    $query .= "position = '{$position}', ";
    $query .= "visible = '{$visible}' ";
    $query .= "where id = {$id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);
    if($result &&  mysqli_affected_rows($connection) == 1){
        //success
        $message = "Subject Edited Successfully1";
        $_SESSION['mess'] = $message;
        redirect_to('manage_content.php');
    }else{
        //failure
        $message = "Subject Edition Failed!";
    }


}else{
    //it is probably a GET request
}

?>
<?php include("../include/layout/header.php") ?>

<div id="main">
    <div id="navigation">
		<?php echo navigation($current_subject ,$current_page); ?>
		<a href="new_subject.php">+ Add Subject</a>
	</div>


    <div id="page">
        <?= showMessage(); ?> 
    <h1>Edit Subject</h1>


    <form action="edit_subject.php?subject=<?= $current_subject['id']; ?>" method="POST">
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