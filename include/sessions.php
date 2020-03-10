<?php 
session_start();
function showMessage(){
    if(isset($_SESSION['mess'])){
        $output = "<div class=\"message\">";
        $output .= $_SESSION['mess'];
        $output .="</div>";
        $_SESSION['mess'] = null;
        return $output;
    }
}

?>