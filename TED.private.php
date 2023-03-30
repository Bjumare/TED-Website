<?php
session_start();

// Database connection
if(isset($_POST['insert'])){
    $conn = new mysqli('localhost','root','','test1');
    
        if($conn->connect_error){
            echo "$conn->connect_error";
            die("Connection Failed : ". $conn->connect_error);
        } else {

    $student_id = $_POST['student_id'];
    $username = $_POST['username'];
    $password1 = $_POST['password'];
    $password2 = $_POST['confirmpassword'];


    if(empty($student_id)||empty($username)||empty($password1)||empty($password2)){
        header("Location: TED.private.php?error=emptyfields&student_id=".$student_id);
        exit();
    }
    // else if(!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$username)){
    //     header("Location: ../signup.php?error=invalidmailuid");
    //     exit();
    // }
    // else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    //     header("Location: ../signup.php?error=invalidmailuid".$username);
    //     exit();
    // }
    else if (filter_has_var(INPUT_GET, $student_id)) {
        // sanitize id
        $clean_id = filter_var($_GET[$student_id], FILTER_SANITIZE_NUMBER_INT);
    
        // validate id
        $id = filter_var($clean_id, FILTER_VALIDATE_INT);
    
        // show the id if it's valid
        if($id === false) {
        header("Location: TED.private.php?error=invalidstudent_id".$id);
        exit();
        }
    } 
    else if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
        header("Location: TED.private.php?error=invalidusername:" .$username);
        exit();
    }
    else if(!preg_match("/^[0-9]*$/",$student_id)){
      header("Location: TED.private.php?error=invalidstudentid:" .$student_id);
      exit();
    }
    else if($password1 !== $password2){
        header("Location: TED.private.php?error=passworddontmatch");
        // error('Password DontX Match!');
        exit();
    }

    else{
        $sql = "SELECT student_id, username FROM users WHERE student_id = ? OR username = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: TED.private.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt,"ss",$student_id,$username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                header("Location: TED.private.php?error=usertaken&student_id=".$student_id."&username=".$username);
                exit();
            }
            else{
                $sql = "insert into users(student_id, username, userpwd) values(?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    header("Location: TED.private.php?error=sqlerror");
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($stmt,"sss",$student_id,$username,$password1);
                    mysqli_stmt_execute($stmt);
                    header("Location: TED.private.php?signup=success");
                    exit();
                }
            }
        }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
}

function error($reason){
  echo "<script> alert('$reason')</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/register.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    />
    <title>Sign Up | TED</title>
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
    <div class="wrapper">
      <div class="container main">
        <div class="row">
          <div class="container w-25 logo">
            <img
              src="images/TED-logo-nobg.png"
              alt="..."
              class="img-thumbnail"
              id="thumbnail"
            >
          </div>
          <div class="input-box">
            <header>Sign Up</header>
            <form method="post" action="">
              <div class="input-field">
                <input
                  type="text"
                  class="input"
                  id="stud_id"
                  name="student_id"
                  required
                  autocomplete="off"
                >
                <label for="stud_id">Student Id</label>
              </div>
              <div class="input-field">
                <input
                  type="text"
                  class="input"
                  id="usern"
                  name="username"
                  required
                  autocomplete="off"
                >
                <label for="username">Username</label>
              </div>
              <div class="input-field">
                <input
                  class="input"
                  type="password"
                  id="pass"
                  name="password"
                  required
                >
                <label for="password">Your Password</label>
              </div>
              <div class="input-field">
                <input
                  class="input"
                  type="password"
                  id="confirmpass"
                  name="confirmpassword"
                  required
                >
                <label for="confirmpassword">Confirm Password</label>
              </div>
              <div class="input-field">
                <input type="submit" class="submit" name="insert" value="Create User" required />
              </div>
            </form>
            <div class="signin">
              <span
                >
                <a href="TED.admin.php">Click here to Finish</a></span
              >
            </div>
          </div>
        </div>
      </div>
      <div class="container fixed-bottom footer">
        <span
          >All Rights Reserved &#169;
          <a href="https://smccnasipit.edu.ph/" id="smcc">SMCC | TED</a></span
        >
      </div>
    </div>
  </body>
</html>
