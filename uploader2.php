<?php require_once('Connections/eventuality.php'); ?>
<?php require_once('logincheck.php');?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_Recordset1 = "-1";
if (isset($_SESSION['user_id'])) {
  $colname_Recordset1 = $_SESSION['user_id'];
}
mysql_select_db($database_eventuality, $eventuality);
$query_Recordset1 = sprintf("SELECT event_id, event_title, `description`, event_images, category_id FROM events_table WHERE user_id = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $eventuality) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<?php 


//This is the directory where images will be saved
$target = "/home/students/j/j.e.febres/public_html/eventuality/event_images/";

$_SESSION['filename'] = basename( $_FILES['event_images']['name']);

$target = $target . basename( $_FILES['event_images']['name']);



$fn = basename( $_FILES['event_images']['name']);
$eid = $row_Recordset1['event_id'];
mysql_select_db($database_eventuality, $eventuality);
mysql_query("update events_table set event_images = '$fn' where event_id = $eid");

$_FILES['event_images']['tmp_name'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>uploader 2</title>
</head>
<body>
<?php 
//Writes the photo to the server
if(move_uploaded_file($_FILES['event_images']['tmp_name'], $target))
{
//Tells you if its all ok
echo "The file ". basename( $_FILES['event_images']['name']). " has been uploaded, and your information has been added to the directory";
echo('<a href="main.php"> HomePage</a>')." or ".('<a href="postevent.php">Post Another Event</a>');
}
else {
//Gives and error if its not
echo "Sorry, there was a problem uploading your file.";
}
?>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
