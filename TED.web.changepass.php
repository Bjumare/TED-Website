<?php 
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_pwd'])) {

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
    <title>Change Password | TED</title>
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
            <form method="post" action="TED.web.change-p.php">
              <div class="input-field">
                <input
                  type="text"
                  class="input"
                  id="oldp"
                  name="op"
                  required
                  autocomplete="off"
                >
                <label for="op">Old Password</label>
              </div>
              <div class="input-field">
                <input
                  type="text"
                  class="input"
                  id="newp"
                  name="np"
                  required
                  autocomplete="off"
                >
                <label for="np">New Password</label>
              </div>
              <div class="input-field">
                <input
                  class="input"
                  type="password"
                  id="confirmp"
                  name="cp"
                  required
                >
                <label for="cp">Confirm Password</label>
              </div>
              <div class="input-field">
                <input type="submit" class="submit" name="Update" value="Update" required />
              </div>
            </form>
            <div class="signin">
              <span
                >
                <a href="TED.web.php">Click here to Finish</a></span
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

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>