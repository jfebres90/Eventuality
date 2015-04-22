<?php require_once('Connections/eventuality.php'); ?><?php require_once('logincheck.php');?>
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
if (isset($_SESSION['event_title'])) {
  $colname_Recordset1 = $_SESSION['event_title'];
}
mysql_select_db($database_eventuality, $eventuality);
$query_Recordset1 = sprintf("SELECT event_id, event_title FROM events_table WHERE event_title = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $eventuality) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php   
$target_path = "/home/students/j/j.e.febres/public_html/eventuality/event_images/";
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);


$fn =  basename( $_FILES['uploadedfile']['name']);
$eid = $row_Recordset1['event_id'];
mysql_select_db($database_eventuality, $eventuality);
mysql_query("update events_table set event_images = '$fn' where event_id = $eid");

$_FILES['uploadedfile']['tmp_name']; 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Upload Confirmation</title>
</head>
<body>

<?php 
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
echo "uploaded succesfully";

echo('<a href="main.php"> HomePage</a>')." or ".('<a href="postevent.php">Post Another Event</a>');

} else{
echo "There was an error uploading the image, please try again!";
}

?>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
