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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
$uid = $_SESSION['user_id'];

	
  $insertSQL = sprintf("INSERT INTO events_table (event_title, `description`, category_id, user_id) VALUES (%s, %s, %s, %s, '$uid')",
                       GetSQLValueString($_POST['event_title'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
					   GetSQLValueString($_POST['event_title'], "text"),
                       GetSQLValueString($_POST['category_id'], "int"));
$eventimg= $_SESSION['event_images'];
  mysql_select_db($database_eventuality, $eventuality);
  $Result1 = mysql_query($insertSQL, $eventuality) or die(mysql_error());
  
    $insertGoTo = "uploader2.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_eventuality, $eventuality);
$query_Recordset1 = "SELECT category_id, category_name FROM category_table";
$Recordset1 = mysql_query($query_Recordset1, $eventuality) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_SESSION['user_id'])) {
  $colname_Recordset2 = $_SESSION['user_id'];
}
mysql_select_db($database_eventuality, $eventuality);
$query_Recordset2 = sprintf("SELECT user_id, event_title, `description`, event_images, category_id FROM events_table WHERE user_id = %s", GetSQLValueString($colname_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $eventuality) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Post Event 2</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form name="form" method="POST" action="<?php echo $editFormAction; ?>" enctype="multipart/form-data">
  <p>
  Post an Event  </p>
  <p>Choose A Category:
    <select name="category_id" id="category_id">
      <?php
do {  
?>
      <option value="<?php echo $row_Recordset1['category_id']?>"><?php echo $row_Recordset1['category_name']?></option>
      <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
    </select>
    <br />
  </p>
  <p><span id="sprytextfield1">Event Title:<br />
    <input type="text" name="event_title" />
    <span class="textfieldRequiredMsg">A value is required.</span></span> </p>

<p>Upload Event Photo:</p>
            <input type="file" name="event_images" id="event_images">

             
            <p>
              Event Description:
            </p>
<span id="sprytextarea1">
            <textarea name="description"  cols="45" rows="8"></textarea>
            <span class="textareaRequiredMsg">A value is required.</span></span>
            <p>
          
              <input TYPE="submit" name="upload" value="Submit"/>
            </p>
            <input type="hidden" name="MM_insert" value="form" />
</p>
</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
