<?php require_once("../include/db_connection.php");  ?>
<?php require_once("../include/functions.php"); ?>
<?php 
    if(isset($_POST['submit'])){
        $menu_name = mysqli_real_escape_string($connection, $_POST['menu_name']);
        $position = $_POST['position'];
        $visible = $_POST['visible'];
        $query  = "INSERT INTO subjects (";
        $query .= "  menu_name, position, visible";
        $query .= ") VALUES (";
        $query .= "  '{$menu_name}', {$position}, {$visible}";
        $query .= ")";
        $result = mysqli_query($connection, $query);
        if($result){
            //success
            redirect_to('manage_content.php');
        }else{
            //failed
            redirect_to('new_subject.php');
            
        }


    }else{
        redirect_to('new_subject.php');

    }





?>
<?php 
 if($connection){
	mysqli_close($connection);
 }
	
?>