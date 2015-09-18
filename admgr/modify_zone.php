<?php
$cfgProgDir = 'phpSecurePages/';
include($cfgProgDir . "secure.php");

// Establish GET & POST variables
import_request_variables("gp");
$PHP_SELF = $_SERVER['PHP_SELF'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
  <title>Ad Manager - Modify Zone</title>
<script LANGUAGE="JAVASCRIPT" TYPE="TEXT/JAVASCRIPT">
 <!--
var win=null;
function ImgWindow(mypage,myname,w,h,pos,infocus){
if(pos=="random"){myleft=(screen.width)?Math.floor(Math.random()*(screen.width-w)):100;mytop=(screen.height)?Math.floor(Math.random()*((screen.height-h)-75)):100;}
if(pos=="center"){myleft=(screen.width)?(screen.width-w)/2:100;mytop=(screen.height)?(screen.height-h)/2:100;}
else if((pos!='center' && pos!="random") || pos==null){myleft=0;mytop=20}
settings="width=" + w + ",height=" + h + ",top=" + mytop + ",left=" + myleft + ",scrollbars=yes,location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes";win=window.open(mypage,myname,settings);
win.focus();}
// -->
</script>
<script language="javascript" type="text/javascript">
<!--
function confirmMsg(i){
var answer=confirm("WARNING!\nYou are about to delete a zone!\nAre you sure you want to do this?");
if(answer) {
var where="modify_zone.php?action=del&id=" + i;
window.location=where;
}
}
//-->
</script>
</head>
<body bgcolor="#ffffff">
<div align="center">
<table border="0" cellpadding="2" cellspacing="4" width="400">
 <tr bgcolor="#FFFFFF">
  <td><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2">
<!-- Begin Content -->
<?
//echo("action: " . $action . "<br>");
//echo("id: " . $id . "<br>");

//Include Db connection script
include 'dbconn.php';

If (!$action){
?>
<?php
  // Request the records
  $result = @mysql_query("SELECT * FROM tbl_zone ORDER BY z_name");
  if (!$result) {
    echo("<p>Error performing query: " . mysql_error() . "</p>"); 
    exit(); 
  }
?>
<table border="0" cellpadding="2" cellspacing="2" width="60%" align="center">
 <tr>
  <td align="center" width="100%" colspan="5"><font face="arial" color="#000000" size="4"><b>All Current Zones</b></font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC" width="20%"><font face="arial" color="#000000" size="2"><b>Name</b></font></td>
  <td bgcolor="#CCCCCC" width="10%"><font face="arial" color="#000000" size="2"><b>Type</b></font></td>
  <td bgcolor="#CCCCCC" width="40%"><font face="arial" color="#000000" size="2"><b>Description</b></font></td>
  <td bgcolor="#CCCCCC" width="15%"><font face="arial" color="#000000" size="2"><b>Preview/Code</b></font></td>
  <td bgcolor="#CCCCCC" width="15%"><font face="arial" color="#000000" size="2"><b>Modify</b></font></td>
 </tr>
<?
  // Display the record
  while ( $row = mysql_fetch_array($result) ) {
    echo("<tr>");
    echo("<td valign='top'><font face='arial' color='#000000' size='2'>" . $row["z_name"] . "</font></td>");
    echo("<td valign='top'><font face='arial' color='#000000' size='2'>" . $row["type"] . "</font></td>");
    echo("<td valign='top'><font face='arial' color='#000000' size='2'>" . $row["descr"] . "</font></td>");
    echo("<td valign='top' align='center'><font face='arial' color='#000000' size='2'>");
?>
  <a href="javascript:ImgWindow('preview_zone.php?id=<?php echo($row["id"])?>','ZonePreview','700','440','20','front');"><img src="images/camera.gif" border="0" height="30" width="30" alt="Click here for preview"></a>
<?
	echo("</font></td>");
    echo("<td valign='top' align='center'><a href='modify_zone.php?action=edit&id=" . $row["id"] . "'><img src='images/pencil.gif' border='0' alt='Edit'></a> ");
?>
<a href="modify_zone.php?action=del&id=<?php echo($row["id"])?>" onclick="confirmMsg('<?php echo($row["id"])?>');return false;"><img src='images/the_bomb.gif' border='0' alt='Delete'></a></td>
<?php
	echo("</tr>");
	echo("<tr>");
	echo("<td colspan='5'><hr></td>");
	echo("</tr>");
  } 
?>
</table>
<?
}Else{
switch ($action){
// *** Edit ***
	   case 'edit':
    // Request the records 
  $result = @mysql_query("SELECT * FROM tbl_zone WHERE id Like '" . $id . "'"); 
  if (!$result) {
    echo("<p>Error performing query: " . mysql_error() . "</p>");
    exit();
  }
$row = mysql_fetch_array($result);

?>
<form action="modify_zone.php?action=update" name="editform" id="editform" method="post">
<input type="hidden" name="id" id="id" value="<?echo($id)?>">
<table border="0" cellpadding="2" cellspacing="2" align="center">
 <tr>
  <td colspan="2" align="center"><font face="arial" color="#000000" size="4"><b>Update Zone</font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC" width="30%"><font face="arial" color="#000000" size="3"><b>Name</b></font></td>
  <td width="70%"><input type="text" name="z_name" id="z_name" size="20" value="<?php echo($row["z_name"]) ?>"></td>
  <input type="hidden" name="old_name" id="old_name" value="<?php echo($row["z_name"]) ?>">
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Type</b></font></td>
  <td><font face="arial" color="#000000" size="3">
   <input type="radio" name="type" id="type" value="banner" <?php if ($row["type"]=='banner')
   		  			   						   				  		   echo("checked"); ?>>Banner<br>
   <input type="radio" name="type" id="type" value="button" <?php if ($row["type"]=='button')
   		  			   						   				  		   echo("checked"); ?>>Button</font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Description</b></font></td>
  <td><input type="text" name="descr" id="descr" size="20" value="<?php echo($row["descr"]) ?>"></td>
 </tr>
 <tr>
  <td colspan="2" align="center"><font face="arial" color="#000000" size="2"><b><i>Note:</b></i> Be sure to modify affected page/section to display ads properly.</font></td>
 </tr>
 <tr>
  <td colspan="2" align="center">
   <input type="submit" name="submitzone" id="submitzone" value="Modify Zone">&nbsp;&nbsp;
   <input type="reset" name="reset" id="reset" value="Reset">
  </td>
 </tr>
</table>
</form>
<?
break;
// *** Delete ***
	  case 'del':
      $sql = "DELETE FROM tbl_zone WHERE id='" . $id . "'"; 
      if (@mysql_query($sql)) { 
        echo("<center>The zone has been deleted.<br>Be sure to delete or modify ads linked to deleted zone.</center>"); 
      } else { 
        echo("<p>Error deleting zone: " . mysql_error() . "</p>"); 
      }
break;
// *** Update ***
	  case 'update':
//  echo("id: " . $id);

// Update Zone Record
$sql = "UPDATE tbl_zone SET z_name='" . $z_name . "', descr='" . $descr . "', type='" . $type . "' ";
$sql = $sql . "WHERE id='" . $id . "'";
//echo("sql: " . $sql . "<br>"); 
if (@mysql_query($sql)) {
   		echo("<center>The zone has been updated.</center>"); 
      } else { 
        echo("<p>Error updating zone: " . mysql_error() . "</p>"); 
      }
// Update Zone's Ad Records
if ($z_name != $old_name) {
$sql2 = "UPDATE tbl_ad SET zone='".$z_name."' "; 
$sql2 = $sql2."WHERE zone='".$old_name."'";
//echo("sql2: ".$sql2."<br>"); 
if (@mysql_query($sql2)) {
   		echo("<center>The zone's ad record(s) have been updated to reflect name change.</center>"); 
      } else { 
        echo("<p>Error updating ad: " . mysql_error() . "</p>"); 
      }
}
break;
}
}
include 'footer.htm';
?>
<!-- End Content -->
   </font></td>
 </tr>
</table>
</div>
</body>
</html>
