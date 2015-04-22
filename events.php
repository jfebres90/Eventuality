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

mysql_select_db($database_eventuality, $eventuality);
$query_event_set = "SELECT event_id, event_title, DAYNAME(date_added) as day, MONTHNAME(date_added) as month, DAY(date_added) as date, YEAR(date_added) as year, `description` FROM events_table ORDER BY date_added ASC";
$event_set = mysql_query($query_event_set, $eventuality) or die(mysql_error());
$row_event_set = mysql_fetch_assoc($event_set);


$totalRows_event_set = mysql_num_rows($event_set);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="eventuality_css.css" rel="stylesheet" type="text/css" />
<link href="images/e_nav.css" rel="stylesheet" type="text/css" />
<style type="text/css">
@import url("images/e_nav.css");
@import url("images/e_nav.css");
td img {display: block;}
	

	

</style>
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
<script type="text/javascript" src="images/mm_css_menu.js"></script>

<title>Events</title>
</head>

<body onload="MM_preloadImages('images/e_nav_r1_c1_s2.gif','images/e_nav_r1_c2_s2.gif','images/e_nav_r1_c3_s2.gif','images/e_nav_r1_c4_s2.gif','images/e_nav_r1_c5_s2.gif')">


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
      <td><a href="events.php" onmouseout="MM_swapImgRestore();MM_menuStartTimeout(1);" onmouseover="MM_menuShowMenu('MMMenuContainer1124001401_0', 'MMMenu1124001401_0',16,50,'e_nav_r1_c2');MM_swapImage('e_nav_r1_c2','','images/e_nav_r1_c2_s2.gif',1);"><img name="e_nav_r1_c2" src="images/e_nav_r1_c2.gif" width="131" height="50" border="0" id="e_nav_r1_c2" alt="" /></a></td>
      <td><a href="postevent.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('e_nav_r1_c3','','images/e_nav_r1_c3_s2.gif',1);"><img name="e_nav_r1_c3" src="images/e_nav_r1_c3.gif" width="199" height="50" border="0" id="e_nav_r1_c3" alt="" /></a></td>
      <td><a href="my_events.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('e_nav_r1_c4','','images/e_nav_r1_c4_s2.gif',1);"><img name="e_nav_r1_c4" src="images/e_nav_r1_c4.gif" width="177" height="50" border="0" id="e_nav_r1_c4" alt="" /></a></td>
      <td><a href="my_comments.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('e_nav_r1_c5','','images/e_nav_r1_c5_s2.gif',1);"><img name="e_nav_r1_c5" src="images/e_nav_r1_c5.gif" width="235" height="50" border="0" id="e_nav_r1_c5" alt="" /></a></td>
      <td><img src="images/spacer.gif" width="1" height="50" border="0" alt="" /></td>
    </tr>
  </table>
  <div id="MMMenuContainer1124001401_0">
    <div id="MMMenu1124001401_0" onmouseout="MM_menuStartTimeout(1);" onmouseover="MM_menuResetTimeout();"><a href="catevent.php? category_id=1" id="MMMenu1124001401_0_Item_0" class="MMMIFVStyleMMMenu1124001401_0" onmouseover="MM_menuOverMenuItem('MMMenu1124001401_0');">Sports/Walks/Fitness</a><a href="catevent.php? category_id=2" id="MMMenu1124001401_0_Item_1" class="MMMIVStyleMMMenu1124001401_0" onmouseover="MM_menuOverMenuItem('MMMenu1124001401_0');">Festivals&nbsp;&amp;&nbsp;Fairs</a><a href="catevent.php? category_id=3" id="MMMenu1124001401_0_Item_2" class="MMMIVStyleMMMenu1124001401_0" onmouseover="MM_menuOverMenuItem('MMMenu1124001401_0');">Performing&nbsp;Arts</a><a href="catevent.php? category_id=4" id="MMMenu1124001401_0_Item_3" class="MMMIVStyleMMMenu1124001401_0" onmouseover="MM_menuOverMenuItem('MMMenu1124001401_0');">Nightlife</a></div>
  </div>
</div>
  <h1>All Events </h1>
<hr />
<form id="form1" name="form1" method="post" action="comments.php">
  <table border="1">
    <script type="text/javascript" src="images/mm_css_menu.js"></script>
 
  <?php do { ?>
    <tr>
         
      <td height="226">
        <input name="event_id" type="radio" id= "event_id" value="<?php echo $row_event_set['event_id']; ?>" />
        <img src="event_images/<?php echo $row_event_set['event_images']; ?>" width="150" height="150" /><br />
		Title: <?php echo $row_event_set['event_title']; ?><br />
		Posted: <?php echo $row_event_set['day'].", ". $row_event_set['month']." ".$row_event_set['date'].", ".$row_event_set['year'];?><br />
		Description: <?php echo $row_event_set['description']; ?></td>
      
    </tr>
    <?php } while ($row_event_set = mysql_fetch_assoc($event_set)); ?>
</table>
<p>&nbsp;</p>
<p>
  <input type="submit" name="button" id="button" value="View Event" />
</p>
<p>&nbsp;</p>
</form>  
  
  
  
</div>

</div>
<br />

</div>


</body>
</html>
<?php
mysql_free_result($event_set);
?>
