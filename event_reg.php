<?php require_once('Connections/eventuality.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $_SESSION['user_id'] = $_POST['user_id'];
  $insertSQL = sprintf("INSERT INTO user_table (user_id, passwd, first_name, last_name, email) VALUES (%s,SHA1(%s), %s, %s, %s)",
                       GetSQLValueString($_POST['user_id'], "text"),
                       GetSQLValueString($_POST['passwd'], "text"),
                       GetSQLValueString($_POST['first_name'], "text"),
                       GetSQLValueString($_POST['last_name'], "text"),
                       GetSQLValueString($_POST['email'], "text"));

  mysql_select_db($database_eventuality, $eventuality);
  $Result1 = mysql_query($insertSQL, $eventuality) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Registration</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link href="eventuality_css.css" rel="stylesheet" type="text/css" />

<script language="JavaScript1.2" type="text/javascript" src="images/mm_css_menu.js"></script>
<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>

</head>

<body onload="MM_preloadImages('images/already_mem_btn_s2.gif')">
<div class="tophead">
  <h1 id="eventhead">Eventuality </h1>
   <div class="topbtn"><a href="index.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('already_mem_btn','','images/already_mem_btn_s2.gif',1);"><img name="already_mem_btn" src="images/already_mem_btn.gif" width="108" height="40" border="0" id="already_mem_btn" alt="Register" /></a>    </div>
</div><br /><br /><br />
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <h1>Registration:</h1>
  <p><span id="sprytextfield1">
  <label>Enter a username:
    <input type="text" name="user_id" id="user_id" />
  </label>
  <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></p>
  <p><span id="sprypassword1">
  <label>Create a Password
    <input type="password" name="passwd" id="passwd" />
  </label>
  <span class="passwordRequiredMsg">A value is required.</span><span class="passwordMinCharsMsg">Minimum number of characters not met.</span><span class="passwordMaxCharsMsg">Exceeded maximum number of characters.</span><span class="passwordInvalidStrengthMsg">The password doesn't meet the specified strength.</span></span></p>
  <p><span id="spryconfirm1">
    <label>Confirm Password
      <input type="password" name="passwd2" id="passwd2" />
    </label>
  <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg">The values don't match.</span></span></p>
  <p><span id="sprytextfield2">
    <label>Enter First Name:
      <input type="text" name="first_name" id="first_name" />
    </label>
  <span class="textfieldRequiredMsg">A value is required.</span></span></p>
  <p><span id="sprytextfield3">
    <label>Enter Last Name:
      <input type="text" name="last_name" id="last_name" />
    </label>
  <span class="textfieldRequiredMsg">A value is required.</span></span></p>
  <p><span id="sprytextfield4">
  <label>Enter an email:
    <input type="text" name="email" id="email" />
  </label>
  <span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldRequiredMsg">A value is required.</span></span></p>
  <p>
    <input type="submit" name="button" id="button" value="Register" />
  </p>
  <p>
    <input type="hidden" name="MM_insert" value="form1" />
</p>
</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {minChars:6, maxChars:20});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {minChars:8, maxChars:15, minNumbers:2, minAlphaChars:4, minUpperAlphaChars:1});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "passwd");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "email");
</script>
</body>
</html>