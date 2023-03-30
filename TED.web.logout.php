<?php
//use this page to kill a PHP session
//and send the user back to the public page
session_start();
session_unset(); //clear out variables
session_destroy();  //delete the file
header('Location: TED.web.php');

//
?>