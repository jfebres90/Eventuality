<?php require_once('Connections/eventuality.php'); ?>
<?php require_once('logincheck.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE comments_table SET comment_title=%s, comment_txt=%s WHERE comment_id=%s",
                       GetSQLValueString($_POST['comment_title'], "text"),
                       GetSQLValueString($_POST['comment_txt'], "text"),
                       GetSQLValueString($_POST['comment_id'], "int"));

  mysql_select_db($database_eventuality, $eventuality);
  $Result1 = mysql_query($updateSQL, $eventuality) or die(mysql_error());

  $updateGoTo = "my_comments.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_SESSION['comment_id'])) {
  $colname_Recordset1 = $_SESSION['comment_id'];
}
mysql_select_db($database_eventuality, $eventuality);
$query_Recordset1 = sprintf("SELECT comment_id, comment_title, comment_txt FROM comments_table WHERE comment_id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $eventuality) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edit Comment</title>
<link href="eventuality_css.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="screen">
@import url("images/e_nav.css");


	

	@import url("images/e_nav.css");
</style>
<script language="JavaScript1.2" type="text/javascript" src="images/mm_css_menu.js"></script>
</head>

<body><br /><br />
<div class="tophead">
  <h1 id="eventhead">Eventuality </h1>
</div><br /><br />
<div id="apDiv1">
<div ><?php echo "<h3>You are logged in, ".$_SESSION['user_id'];"!</h3>;"?> </div>
<br />
<div class="content">
<div class="navbar">
<div id="FWTableContainer1760763721">
  <table style="display: inline-table;" border="0" cellpadding="0" cellspacing="0" width="900">
    <!-- fwtable fwsrc="e_nav.png" fwpage="Page 1" fwbase="e_nav.gif" fwstyle="Dreamweaver" fwdocid = "1760763721" fwnested="0" -->
    <tr>
      <td><img src="images/spacer.gif" width="158" height="1" border="0" alt="" /></td>
      <td><img src="images/spacer.gif" width="131" height="1" border="0" alt="" /></td>
      <td><img src="images/spacer.gif" width="199" height="1" border="0" alt="" /></td>
      <td><img src="images/spacer.gif" width="177" height="1" border="0" alt="" /></td>
      <td><img src="images/spacer.gif" width="235" height="1" border="0" alt="" /></td>
      <td><img src="images/spacer.gif" width="1" height="1" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><a href="main.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('e_nav_r1_c1','','images/e_nav_r1_c1_s2.gif',1);"><img name="e_nav_r1_c1" src="images/e_nav_r1_c1.gif" width="158" height="50" border="0" id="e_nav_r1_c1" alt="" /></a></td>
      <td><a href="catevent.php" onmouseout="MM_swapImgRestore();MM_menuStartTimeout(1);" onmouseover="MM_menuShowMenu('MMMenuContainer1124001401_0', 'MMMenu1124001401_0',16,50,'e_nav_r1_c2');MM_swapImage('e_nav_r1_c2','','images/e_nav_r1_c2_s2.gif',1);"><img name="e_nav_r1_c2" src="images/e_nav_r1_c2.gif" width="131" height="50" border="0" id="e_nav_r1_c2" alt="" /></a></td>
      <td><a href="postevent.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('e_nav_r1_c3','','images/e_nav_r1_c3_s2.gif',1);"><img name="e_nav_r1_c3" src="images/e_nav_r1_c3.gif" width="199" height="50" border="0" id="e_nav_r1_c3" alt="" /></a></td>
      <td><a href="my_events.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('e_nav_r1_c4','','images/e_nav_r1_c4_s2.gif',1);"><img name="e_nav_r1_c4" src="images/e_nav_r1_c4.gif" width="177" height="50" border="0" id="e_nav_r1_c4" alt="" /></a></td>
      <td><a href="my_comments.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('e_nav_r1_c5','','images/e_nav_r1_c5_s2.gif',1);"><img name="e_nav_r1_c5" src="images/e_nav_r1_c5.gif" width="235" height="50" border="0" id="e_nav_r1_c5" alt="" /></a></td>
      <td><img src="images/spacer.gif" width="1" height="50" border="0" alt="" /></td>
    </tr>
  </table>
  <div id="MMMenuContainer1124001401_0">
<div id="MMMenu1124001401_0" onmouseout="MM_menuStartTimeout(1);" onmouseover="MM_menuResetTimeout();"><a href="catevent.php? category_id=1" id="MMMenu1124001401_0_Item_0" class="MMMIFVStyleMMMenu1124001401_0" onmouseover="MM_menuOverMenuItem('MMMenu1124001401_0');">Sports/Walks/Fitness</a><a href="catevent.php? category_id=2" id="MMMenu1124001401_0_Item_1" class="MMMIVStyleMMMenu1124001401_0" onmouseover="MM_menuOverMenuItem('MMMenu1124001401_0');">Festivals&nbsp;&amp;&nbsp;Fairs</a><a href="catevent.php? category_id=3" id="MMMenu1124001401_0_Item_2" class="MMMIVStyleMMMenu1124001401_0" onmouseover="MM_menuOverMenuItem('MMMenu1124001401_0');">Performing&nbsp;Arts</a><a href="catevent.php? category_id=4" id="MMMenu1124001401_0_Item_3" class="MMMIVStyleMMMenu1124001401_0" onmouseover="MM_menuOverMenuItem('MMMenu1124001401_0');">Nightlife</a></div>    </div>
  </div>
</div>

<h1>Edit Comments</h1>
<hr />
<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
  <table align="center">
    <tr valign="baseline">
      <td height="23" align="right" nowrap="nowrap">Comment_title:</td>
      <td><input type="text" name="comment_title" value="<?php echo htmlentities($row_Recordset1['comment_title'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td height="56" align="right" nowrap="nowrap">Comment_txt:</td>
      <td><textarea name="comment_txt" cols="32" rows="7"><?php echo htmlentities($row_Recordset1['comment_txt'], ENT_COMPAT, 'UTF-8'); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form2" />
  <input type="hidden" name="comment_id" value="<?php echo $row_Recordset1['comment_id']; ?>" />
</form>
<p>&nbsp;</p>

</div>
</div>
<br />
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
