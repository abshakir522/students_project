<?php 
  function test_query($result_set){
    if (!$result_set) {
		die("Database query failed.");
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
  

  





?>