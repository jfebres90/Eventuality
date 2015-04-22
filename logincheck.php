<?php
//Start session
session_start();
//Check whether the session variable
//userID is present or not
if(!isset($_SESSION["user_id"]) || (trim($_SESSION["user_id"])=="")) {
header("Location: warning.php");
exit();
}
?>