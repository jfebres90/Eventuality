<?php 
session_start(); 
$_SESSION['event_id'] = $_POST['event_id'];
if($_POST['action'] == "Delete")
{
header("Location: delete_events.php");
}
if($_POST['action'] == "Edit")
{
header("Location: edit_events.php");
}
if($_POST['action'] == "Update Image")
{
header("Location: upload.php");
}
?>