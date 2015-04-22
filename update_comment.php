<?php 
session_start(); 
$_SESSION['comment_id'] = $_POST['comment_id'];
if($_POST['action'] == "Delete")
{
header("Location: delete_comments.php");
}
if($_POST['action'] == "Edit")
{
header("Location: edit_comments.php");
}
?>