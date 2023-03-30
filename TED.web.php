<?php
session_start();

function error($reason){
    echo "<script> alert('$reason')</script>";
}

//database connection here
if(isset($_POST['submit'])){
$conn = new mysqli('localhost','root','','test1');

	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {

        $student_id = $_POST['student_id'];
        $password = $_POST['password'];

		$stmt = $conn->prepare("select * from users where student_id = ?");
		$stmt->bind_param("s", $student_id);
		$execval = $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            if($data['userpwd'] == $password) {
                $_SESSION['user_id'] = $student_id;
                $_SESSION['user_pwd'] = $password;
                header('Location: TED.admin.php');
                // echo '<script type="text/javascript"> 
                //     const stud_num = document.getElementById("stud_id").value;
                //     const pwd = document.getElementById("pwd").value;

                //     document.getElementById("stud_num").value = "";
                //     document.getElementById("pwd").value = "";
                //     </script>';
            } else {
                error('Invalid Password or Student Id!');
            }

        } else {
            error('Invalid Password or Student Id!');
        }
    }

    function function_alert($message) {
      
        // Display the alert box 
        echo "<script>alert('$message');</script>";
    }
}

//
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    />
    <title>Home | TED</title>
    <link
      rel="shortcut icon"
      href="images/TED-logo-nobg.png"
      type="image/x-icon"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
      crossorigin="anonymous"
    />
</head>
<body>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <h1>Hello Visitor</h1>
                </div>
                <?php
                    if( !isset($_SESSION['user_id'])){
                    ?>
                <div class="col-md">
                    <a href="TED.web.studlogin.php">Student Login</a>
                </div>
                <?php
                    }
                    ?>
                <?php
                    if( !isset($_SESSION['user_id'])){
                    ?>
                <div class="col-md">
                        <a href="TED.public.php">Admin Login</a>
                </div>
                <?php
                    }
                    ?>
                <?php   
                if( isset($_SESSION['user_id'])){
                ?>
                <div class="col-md">
                        <a href="TED.web.logout.php">Logout</a>
                </div>
                <div class="col-md">
                        <a href="TED.web.changepass.php">Change Password</a>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>