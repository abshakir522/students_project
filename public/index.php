<?php require_once("../include/db_connection.php");  ?>
<?php require_once("../include/functions.php"); ?>
<?php 
	find_selected_page();
?>
<?php include("../include/layout/header.php") ?>
<div id="main">
    <div id="navigation">
		<?php echo public_navigation($current_subject ,$current_page); ?>
    </div>

    <div id="page">

		<?php if ($current_subject) { ?>
            <h1><?= $current_subject['menu_name']; ?></h1>
            <?php  
            $pages = get_pages_for_subject($_GET['subject']);
            while ($row = mysqli_fetch_assoc($pages)) {
                echo $row['menu_name']."<br/>";
                # code...
            }
            ?>

			<?php }elseif($current_page){ ?>
			<h2><?= $current_page['menu_name']; ?></h2>
            <p><?= $current_page['content']; ?></p>
			<?php
			

			}else{
				echo "Please select a subject or page";
				
			}
		?>
    </div>
</div>
<?php include("../include/layout/footer.php") ?>