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
  <title>Ad Manager - Modify Advertiser</title>
<script language="javascript" type="text/javascript">
<!--
function confirmMsg(i){
var answer=confirm("WARNING!\nYou are about to delete an advertiser!\nAre you sure you want to do this?");
if(answer) {
var where="modify_adclient.php?action=del&id=" + i;
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
<body>
<?
//echo("action: ".$action."<br>");
//echo("id: ".$id."<br>");

//Include Db connection script
include 'dbconn.php';

If (!$action){
?>
<?php
  // Request the records
  $result = @mysql_query("SELECT * FROM tbl_adclient ORDER BY c_name");
  if (!$result) {
    echo("<p>Error performing query: " . mysql_error() . "</p>"); 
    exit(); 
  }
?>
<table border="0" cellpadding="2" cellspacing="2" width="60%" align="center">
 <tr>
  <td align="center" width="100%" colspan="4"><font face="arial" color="#000000" size="4"><b>All Current Advertisers</b></font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="2"><b>Client Name</b></font></td>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="2"><b>Phone</b></font></td>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="2"><b>Email</b></font></td>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="2"><b>Modify</b></font></td>
 </tr>
<?
  // Display the record
  while ( $row = mysql_fetch_array($result) ) {
    echo("<tr>");
    echo("<td valign='top'><font face='arial' color='#000000' size='2'>" . $row["c_name"] . "</font></td>");
    echo("<td valign='top'><font face='arial' color='#000000' size='2'>" . $row["c_phone"] . "</font></td>");
	echo("<td valign='top'><font face='arial' color='#000000' size='2'>" . $row["c_email"] . "</font></td>");
    echo("<td valign='top' align='center'><a href='modify_adclient.php?action=edit&id=".$row["id"]."'><img src='images/pencil.gif' border='0' alt='Edit'></a> ");
?>
<a href="modify_adclient.php?action=del&id=<?php echo($row["id"])?>" onclick="confirmMsg('<?php echo($row["id"])?>');return false;"><img src='images/the_bomb.gif' border='0' alt='Delete'></a></td>
<?php
	echo("</tr>");
	echo("<tr>");
	echo("<td colspan='4'><hr></td>");
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
  $result = @mysql_query("SELECT * FROM tbl_adclient WHERE id Like '".$id."'"); 
  if (!$result) {
    echo("<p>Error performing query: " . mysql_error() . "</p>");
    exit();
  }
$row = mysql_fetch_array($result);

?>
<form action="modify_adclient.php?action=update" name="editform" id="editform" method="post">
<input type="hidden" name="id" id="id" value="<?echo($id)?>">
<table border="0" cellpadding="2" cellspacing="2" align="center">
 <tr>
  <td colspan="2" align="center"><font face="arial" color="#000000" size="4"><b>Update Ad Client</font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC" width="30%"><font face="arial" color="#000000" size="3"><b>Client Name</b></font></td>
  <td width="70%"><input type="text" name="c_name" id="c_name" size="20" value="<?php echo($row["c_name"]) ?>">
  <input type="hidden" name="old_name" id="old_name" value="<?php echo($row["c_name"]) ?>"></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Phone</b></font></td>
  <td><input type="text" name="c_phone" id="c_phone" size="20" value="<?php echo($row["c_phone"]) ?>"></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Email</b></font></td>
  <td><input type="text" name="c_email" id="c_email" size="20" value="<?php echo($row["c_email"]) ?>"></td>
 </tr>
 <tr>
  <td colspan="2" align="center">
   <input type="submit" name="submitclient" id="submitclient" value="Modify Client">&nbsp;&nbsp;
   <input type="reset" name="reset" id="reset" value="Reset">
  </td>
 </tr>
</table>
</form>
<?
break;
// *** Delete ***
	  case 'del':
      $sql = "DELETE FROM tbl_adclient WHERE id='".$id."'"; 
      if (@mysql_query($sql)) { 
        echo("<center>The client has been deleted.<br>Be sure to delete or modify ads owned by previous client.</center>"); 
      } else { 
        echo("<p>Error deleting client: " . mysql_error() . "</p>"); 
      }
break;
// *** Update ***
	  case 'update':
//  echo("id: ".$id);

// Update Client Record
$sql = "UPDATE tbl_adclient SET c_name='".$c_name."', c_phone='".$c_phone."', ";
$sql = $sql."c_email='".$c_email."' "; 
$sql = $sql."WHERE id='".$id."'";
//echo("sql: ".$sql."<br>"); 
if (@mysql_query($sql)) {
   		echo("<center>The client has been updated.</center>"); 
      } else { 
        echo("<p>Error updating ad: " . mysql_error() . "</p>"); 
      }

// Update Client's Ad Records
if ($c_name != $old_name) {
$sql2 = "UPDATE tbl_ad SET owner='".$c_name."' "; 
$sql2 = $sql2."WHERE owner='".$old_name."'";
//echo("sql2: ".$sql2."<br>"); 
if (@mysql_query($sql2)) {
   		echo("<center>The client's ad record(s) have been updated to reflect name change.</center>"); 
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
