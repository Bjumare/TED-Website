<?php 
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_pwd'])) {

    $conn = new mysqli('localhost','root','','test1');
    
    if($conn->connect_error){
        echo "$conn->connect_error";
        die("Connection Failed : ". $conn->connect_error);
    }

if (isset($_POST['op']) && isset($_POST['np'])
    && isset($_POST['cp'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$op = validate($_POST['op']);
	$np = validate($_POST['np']);
	$cp = validate($_POST['cp']);
    
    if(empty($op)){
      header("Location: TED.web.changepass.php?error=Old Password is required");
	  exit();
    }else if(empty($np)){
      header("Location: TED.web.changepass.php?error=New Password is required");
	  exit();
    }else if($np !== $cp){
      header("Location: TED.web.changepass.php?error=The confirmation password  does not match");
	  exit();
    }else {
    	// hashing the password
    	// $op = md5($op);
    	// $np = md5($np);
        $stud_id = $_SESSION['user_id'];

        $sql = "SELECT userpwd
                FROM users WHERE 
                student_id='$stud_id' AND userpwd='$op'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) === 1){
        	
        	$sql_2 = "UPDATE users
        	          SET userpwd='$np'
        	          WHERE student_id='$stud_id'";
        	mysqli_query($conn, $sql_2);
        	header("Location: TED.web.changepass.php?success=Your password has been changed successfully");
	        exit();

        }else {
        	header("Location: TED.web.changepass.php?error=Incorrect password");
	        exit();
        }

    }

    
}else{
	header("Location: TED.changepass.php");
	exit();
}

}else{
     header("Location: TED.web.php");
     exit();
}