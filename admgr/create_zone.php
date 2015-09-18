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
  <title>Ad Manager - Create Zone</title>
</head>
<body bgcolor="#ffffff">
<div align="center">
<table border="0" cellpadding="2" cellspacing="4" width="400">
 <tr bgcolor="#FFFFFF">
  <td><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2">
<!-- Begin Content -->
<?php
if (!$submitzone){
?>
<form action="<?=$PHP_SELF?>" name="addform" id="addform" method="post">
<table border="0" cellpadding="2" cellspacing="2" align="center">
 <tr>
  <td colspan="2" align="center"><font face="arial" color="#000000" size="4"><b>Create Zone</font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC" width="30%"><font face="arial" color="#000000" size="3"><b>Zone Name</b></font></td>
  <td width="70%"><input type="text" name="z_name" id="z_name" size="20"></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Type</b></font></td>
  <td><font face="arial" color="#000000" size="3">
   <input type="radio" name="type" id="type" value="banner" checked>Banner<br>
   <input type="radio" name="type" id="type" value="button">Button</font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Description</b></font></td>
  <td><input type="text" name="descr" id="descr" size="20"></td>
 </tr>
 <tr>
  <td colspan="2" align="center"><font face="arial" color="#000000" size="2"><b><i>Note:</b></i> Be sure to modify affected page/section to display ads properly.</font></td>
 </tr>
 <tr>
  <td colspan="2" align="center">
   <input type="submit" name="submitzone" id="submitzone" value="Create Zone">
  </td>
 </tr>
</table>
</form>
<?
}else{
  // Generate Id
  $id = md5 (uniqid (rand()));
  
  //Include Db connection script
  include 'dbconn.php';

  // Insert the record
  $sql = "INSERT INTO tbl_zone SET
		  id='$id',
		  z_name='$z_name',
		  type='$type',
		  descr='$descr'";
  if (@mysql_query($sql)) { 
    echo("<center>Your zone has been created.</center>"); 
  } else { 
    echo("<p>Error creating zone: " . mysql_error() . "</p>"); 
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
