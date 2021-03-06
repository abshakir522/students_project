<?php 

function redirect_to($path){
  header("Location: {$path}");
  exit();
}

function confirm_login(){
  if(!isset($_SESSION["admin_id"])){
    redirect_to("login.php");
}
}

  function test_query($result_set){
    if (!$result_set) {
		die("Database query failed.");
	}
  }

  function find_selected_page(){
    global $current_subject;
    global $current_page;

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
  }


  function get_all_subjects(){
    global $connection;
    $query  = "SELECT * ";
	$query .= "FROM subjects ";
	$query .= "WHERE visible = 1 ";
	$query .= "ORDER BY position ASC";
	$subject_set = mysqli_query($connection, $query);
	// Test if there was a query error
    test_query($subject_set);
    return $subject_set;
    
  }

  function get_all_admins(){
    global $connection;
    $query  = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "ORDER BY username ASC";
    $admin_set = mysqli_query($connection, $query);
    return $admin_set;
  }

  function find_admin_by_id($admin_id) {
		global $connection;
		
		$safe_admin_id = mysqli_real_escape_string($connection, $admin_id);
		
		$query  = "SELECT * ";
		$query .= "FROM admins ";
		$query .= "WHERE id = {$safe_admin_id} ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connection, $query);
		test_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;
		} else {
			return null;
		}
  }
  
  function attempt_login($username, $password) {
		$admin = find_admin_by_username($username);
		if ($admin) {
			// found admin, now check password
			// if (password_check($password, $admin["hashed_password"])) {
        if ($password == $admin['password']) {
				// password matches
				return $admin;
			} else {
				// password does not match
				return false;
			}
		} else {
			// admin not found
			return false;
		}
  }
  
  function find_admin_by_username($username) {
		global $connection;
		$safe_username = mysqli_real_escape_string($connection, $username);
		$query  = "SELECT * ";
		$query .= "FROM admins ";
		$query .= "WHERE username = '{$safe_username}' ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connection, $query);
    test_query($admin_set);
    $admin = mysqli_fetch_assoc($admin_set);
		if($admin) {
			return $admin;
		} else {
			return null;
		}
	}

  function get_pages_for_subject($subject_id){
    global $connection;
    $query  = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE visible = 1 ";
    $query .= "AND subject_id = {$subject_id}";
    $query .= " ORDER BY position ASC";
    $page_set = mysqli_query($connection, $query);
    // Test if there was a query error
    test_query($page_set);
    return $page_set;

  }
  

  function get_subject_by_id($subject_id){

    global $connection;
    $query  = "SELECT * ";
    $query .= "FROM subjects ";
    $query .= "WHERE id={$subject_id} ";
    $query .= "LIMIT 1";
    $subject_set = mysqli_query($connection, $query);
    test_query($subject_set);
    $subject = mysqli_fetch_assoc($subject_set);
    return $subject;

  }


  function get_page_by_id($page_id){

    global $connection;
    $query  = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE id={$page_id} ";
    $query .= "LIMIT 1";
    $pages_set = mysqli_query($connection, $query);
    test_query($pages_set);
    $page = mysqli_fetch_assoc($pages_set);
    return $page;

  }


  function navigation($subject_array, $page_array){
    $output = "<ul class=\"subjects\">";
        $subject_set = get_all_subjects();
				while($subject = mysqli_fetch_assoc($subject_set)) {
          $output .="<li ";
          $output .="class=\"";
          if($subject_array && $subject['id'] == $subject_array['id']){ 
            $output .="selected";
          }
          $output .="\">";

          $output .="<a href=\"manage_content.php?subject={$subject['id']}\">";
          $output .= $subject["menu_name"];
          $output .="</a>";
          $page_set = get_pages_for_subject($subject["id"]);
          $output .= "<ul class=\"pages\">";
          while($page = mysqli_fetch_assoc($page_set)) {
            $output .= "<li class=\"";
            if($page_array && $page['id'] == $page_array['id']){ 
              $output .= "selected";
            }
            $output .= "\">";
            $output .= "<a href=\"manage_content.php?page={$page['id']}\">";
            $output .= $page["menu_name"]; 
            $output .= "</a>";
            $output .="</li>";
          }
            
              $output .= "</ul>";
              $output .="</li>";
			} 
		    
      $output .="</ul>";
    mysqli_free_result($subject_set);
    return $output;

  }

  function public_navigation($subject_array, $page_array){
    $output = "<ul class=\"subjects\">";
        $subject_set = get_all_subjects();
				while($subject = mysqli_fetch_assoc($subject_set)) {
          $output .="<li ";
          $output .="class=\"";
          if($subject_array && $subject['id'] == $subject_array['id']){ 
            $output .="selected";
          }
          $output .="\">";

          $output .="<a href=\"index.php?subject={$subject['id']}\">";
          $output .= $subject["menu_name"];
          $output .="</a>";
          $page_set = get_pages_for_subject($subject["id"]);
          $output .= "<ul class=\"pages\">";
          while($page = mysqli_fetch_assoc($page_set)) {
            $output .= "<li class=\"";
            if($page_array && $page['id'] == $page_array['id']){ 
              $output .= "selected";
            }
            $output .= "\">";
            $output .= "<a href=\"index.php?page={$page['id']}\">";
            $output .= $page["menu_name"]; 
            $output .= "</a>";
            $output .="</li>";
          }
            
              $output .= "</ul>";
              $output .="</li>";
			} 
		    
      $output .="</ul>";
    mysqli_free_result($subject_set);
    return $output;

  }
  

  





?>