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

        $uname = $_POST['uname'];
        $password = $_POST['password'];

		$stmt = $conn->prepare("select * from admin where username = ?");
		$stmt->bind_param("s", $uname);
		$execval = $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            if($data['password'] == $password) {
                $_SESSION['admin_id'] = $uname;
                $_SESSION['admin_pwd'] = $password;
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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/login.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    />
    <title>Log in | Admin</title>
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
            />
          </div>
          <div class="input-box">
            <header>Admin Login</header>
            <form method="post" action="">
              <div class="input-field">
                <input
                  type="text"
                  class="input"
                  id="stud_id"
                  name="uname"
                  required
                  autocomplete="off"
                  maxlength="9"
                >
                <label for="stud_id">Username</label>
              </div>
              <div class="input-field">
                <svg
                  class="i"
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  fill="currentColor"
                  class="bi bi-check-square"
                  viewBox="0 0 16 16"
                  onclick="myFunction()"
                >
                  <path
                    d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"
                  />
                  <path
                    d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"
                  />
                </svg>
                <script>
                  function myFunction() {
                    var x = document.getElementById("pass");
                    if (x.type === "password") {
                      x.type = "text";
                    } else {
                      x.type = "password";
                    }
                  }
                </script>
                <input
                  class="input"
                  type="password"
                  id="pass"
                  name="password"
                  required
                  autocomplete="off"
                >
                <label for="password">Password</label>
              </div>
              <div class="input-field">
                <input type="submit" name="submit" class="submit" value="Sign In" />
              </div>
            </form>
            <div class="signin">
              <span
                >Not an admin?
                <a href="TED.web.php">Click here</a></span
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
