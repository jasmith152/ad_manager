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
  <title><?php echo $sitename; ?> Ad Manager - Modify Ad</title>
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
var answer=confirm("WARNING!\nYou are about to delete an ad!\nAre you sure you want to do this?");
if(answer) {
var where="modify_ad.php?action=del&id=" + i;
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
//echo("action: ".$action."<br>");
//echo("id: ".$id."<br>");

//Include Db connection script
include 'dbconn.php';

$client_result = @mysql_query("SELECT c_name FROM tbl_adclient ORDER BY c_name");
$zone_result = @mysql_query("SELECT z_name FROM tbl_zone ORDER BY z_name");

If (!$action){
?>
<?php
  // Select view
 	echo("<font face='arial' size='2'><form action='$PHP_SELF' name='view_select' method='post'>\n");
 	echo("View Ads by <select name='zone' size='1'>\n");
 	echo("<option value=''>Zone</option>\n");
    while ( $zone_row = mysql_fetch_array($zone_result) ) {
   		  echo("<option>".$zone_row["z_name"]."</option>");
    }
 	echo("</select> \n");
 	echo("Or <select name='owner' size='1'>\n");
 	echo("<option value=''>Client</option>\n");
    while ( $client_row = mysql_fetch_array($client_result) ) {
   		  echo("<option>".$client_row["c_name"]."</option>");
    }
 	echo("</select>\n");
 	echo("<input type='submit' name='submit' value='GO'>\n");
 	echo("</form></font><hr>\n");
 if (($zone && $zone > '')||($owner && $owner > '')){
  if ($zone > '' && $owner > ''){
  	$owner = '';
  }
  if ($zone > ''){
  	$where_clause = ("zone = '" . addslashes($zone) . "'");
  }
  if ($owner > ''){
  	$where_clause = ("owner = '" . addslashes($owner) . "'");
  }

  // Request the records
  $result = @mysql_query("SELECT * FROM tbl_ad WHERE $where_clause ORDER BY name");
  if (!$result) {
    echo("<p>Error performing query: " . mysql_error() . "</p>"); 
    exit(); 
  }
	echo("<table border='0' cellpadding='2' cellspacing='2' width='80%' align='center'>\n");
 	echo("<tr>\n");
  	echo("<td align='center' width='100%' colspan='9'><font face='arial' color='#000000' size='4'><b>All Ads ");
  	if ($zone > ''){
  		echo("in $zone zone");
  	}
  	if ($owner > ''){
  		echo("for $owner");
  	}
  	echo("</b></font></td>\n");
 	echo("</tr>\n");
    echo("<tr>\n");
	echo("<td bgcolor='#CCCCCC' width='15%'><font face='arial' color='#000000' size='2'><b>Ad Name</b></font></td>\n");
	echo("<td bgcolor='#CCCCCC' width='15%'><font face='arial' color='#000000' size='2'><b>Zone</b></font></td>\n");
	echo("<td bgcolor='#CCCCCC' width='8%'><font face='arial' color='#000000' size='2'><b>Type</b></font></td>\n");
	echo("<td bgcolor='#CCCCCC' width='15%'><font face='arial' color='#000000' size='2'><b>Client</b></font></td>\n");
	echo("<td bgcolor='#CCCCCC' width='10%'><font face='arial' color='#000000' size='2'><b>Start Date</b></font></td>\n");
	echo("<td bgcolor='#CCCCCC' width='10%'><font face='arial' color='#000000' size='2'><b>End Date</b></font></td>\n");
	echo("<td bgcolor='#CCCCCC' width='5%'><font face='arial' color='#000000' size='2'><b>Preview/<br>Code</b></font></td>\n");
	echo("<td bgcolor='#CCCCCC' width='5%'><font face='arial' color='#000000' size='2'><b>Active</b></font></td>\n");
	echo("<td bgcolor='#CCCCCC' width='7%'><font face='arial' color='#000000' size='2'><b>Modify</b></font></td>\n");
	echo("</tr>");

  // Display the record
  while ( $row = mysql_fetch_array($result) ) {
    echo("<tr>\n");
    echo("<td valign='top'><font face='arial' color='#000000' size='2'>" . $row["name"] . "</font></td>\n");
    echo("<td valign='top'><font face='arial' color='#000000' size='2'>" . $row["zone"] . "</font></td>\n");
    echo("<td valign='top'><font face='arial' color='#000000' size='2'>" . $row["type"] . "</font></td>\n");
    echo("<td valign='top'><font face='arial' color='#000000' size='2'>" . $row["owner"] . "</font></td>\n");
	echo("<td valign='top'><font face='arial' color='#000000' size='2'>" . $row["s_date"] . "</font></td>\n");
	echo("<td valign='top'><font face='arial' color='#000000' size='2'>" . $row["e_date"] . "</font></td>\n");
    echo("<td valign='top' align='center'><font face='arial' color='#000000' size='2'>\n");
?>
  <a href="javascript:ImgWindow('preview.php?id=<?php echo($row["id"])?>','AdPreview','700','440','20','front');"><img src="images/camera.gif" border="0" alt="Preview"></a>
<?
	echo("</font></td>\n");
	echo("<td valign='top' align='center'><font face='arial' color='#000000' size='2'>");
	if (($row["active"])=="T") {
	   echo("<img src='images/checkmark.gif' border='0' alt='Active'>");
	} else {
	   echo("<img src='images/xmark.gif' border='0' alt='Not Active'>");
	}
	//echo(" post: '" . $row["post"] . "' ");
	echo("</font></td>\n");
    echo("<td valign='top' align='center'><a href='modify_ad.php?action=edit&id=".$row["id"]."'><img src='images/pencil.gif' border='0' alt='Edit'></a> ");
?>
  <a href="modify_ad.php?action=del&id=<?php echo($row["id"])?>" onclick="confirmMsg('<?php echo($row["id"])?>');return false;"><img src="images/the_bomb.gif" border="0" alt="Delete"></a></td>
<?
	echo("</tr>\n");
	echo("<tr>\n");
	echo("<td colspan='9'><hr></td>\n");
	echo("</tr>\n");
  }
  echo("</table>\n");
 }
}Else{
switch ($action){
// *** Edit ***
	   case 'edit':
    // Request the records 
  $result = @mysql_query("SELECT * FROM tbl_ad WHERE id Like '".$id."'"); 
  if (!$result) {
    echo("<p>Error performing query: " . mysql_error() . "</p>");
    exit();
  }
$row = mysql_fetch_array($result);

//Parse data for display
list($date_y, $date_m, $date_d) = split("-", $row["e_date"]);
 
?>

<form action="modify_ad.php?action=update" enctype="multipart/form-data" name="editform" id="editform" method="post">
<input type="hidden" name="id" id="id" value="<?echo($id)?>">
<table width="60%" border="0" cellpadding="2" cellspacing="2" align="center">
 <tr>
  <td colspan="2" align="center"><font face="arial" color="#000000" size="4"><b>Update Ad</font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC" width="30%"><font face="arial" color="#000000" size="3"><b>Ad Name</b></font></td>
  <td width="70%"><input type="text" name="name" id="name" size="20" value="<?php echo(stripslashes($row["name"])); ?>"></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Zone</b></font></td>
  <td><select name="zone" id="zone">
   <option><?php echo(stripslashes($row["zone"])); ?></option>
   <option>No Zone</option>
   <?php while ( $zone_row = mysql_fetch_array($zone_result) ) {
   		 echo("<option>".$zone_row["z_name"]."</option>");
   }?>
  </select></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Type</b></font></td>
  <td><font face="arial" color="#000000" size="3">
   <input type="radio" name="type" id="type" value="banner" <?php if ($row["type"]=='banner')
   		  			   						   				  		   echo("checked"); ?>>Banner<br>
   <input type="radio" name="type" id="type" value="button" <?php if ($row["type"]=='button')
   		  			   						   				  		   echo("checked"); ?>>Button<br>
   <input type="radio" name="type" id="type" value="text" <?php if ($row["type"]=='text')
   		  			   						   				  		   echo("checked"); ?>>Text</font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Owner</b></font></td>
  <td><select name="owner" id="owner">
   <option><?php echo(stripslashes($row["owner"])); ?></option>
   <?php while ( $client_row = mysql_fetch_array($client_result) ) {
   		 echo("<option>".$client_row["c_name"]."</option>");
   }?>
  </select></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Expiration Date</b></font></td>
  <td><input type="hidden" name="old_edate" id="old_edate" value="<?php echo($row["e_date"]);?>">
   <font face="arial" color="#000000" size="2">Month:<select name="e_date_m" id="e_date_m">
   <?php echo("<option>".$date_m."</option>");
   include 'monthlist.htm';?>
   </select>&nbsp;
   Date:<select name="e_date_d" id="e_date_d">
   <?php echo("<option>".$date_d."</option>");
   include 'datelist.htm';?>
   </select>&nbsp;
   Year:<select name="e_date_y" id="e_date_y">
   <?php echo("<option>".$date_y."</option>");
   //include 'yearlist.htm';
   for ($y=0; $y<=5; $y++) {
      echo "<option>".(date("Y")+$y)."</option>";
   }
   ?>
   </select></font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Active</b></font></td>
  <td><font face="arial" color="#000000" size="2"><select name="active" id="active">
   <?php
   echo("<option value='" . $row["active"] . "'>");
  if (($row["active"])=="T") {
	   echo("Yes");
	} else {
	   echo("No");
	} ?>
  </option>
  <option value="T">Yes</option>
  <option value="F">No</option></select></font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Image</b></font></td>
  <td><input type="text" name="src" id="src" size="20" value="<?php echo(stripslashes($row["src"])); ?>"></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>New Image</b></font></td>
  <td><input type="file" name="src_new" id="src_new" size="20"><br><font face="arial" color="#000000" size="2"><i><b>Note: </b>
   Images more than 512kb may not be used. If an uploaded image seems to be corrupt, rename the image on your computer and re-upload it.</i></font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Alt Text</b></font></td>
  <td><input type="text" name="alt" id="alt" size="20" value="<?php echo(stripslashes($row["alt"])); ?>"></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>URL</b></font></td>
  <td><input type="text" name="href" id="href" size="20" value="<?php echo($row["href"]); ?>"><br><font face="arial" color="#000000" size="2"><i><b>Note: </b>
   Must use the following format: http://www.mydomain.com</i></font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>HTML</b></font></td>
  <td><font face="arial" color="#000000" size="2"><b>Only used for HTML ads, not for additional code.</b></font><br>
   <textarea name="src_code" id="src_code" cols="40" rows="4"><?php echo(stripslashes($row["src_code"])); ?></textarea><br><font face="arial" color="#000000" size="2"><i><b>Note: </b>
    The "a href" tag will be added to the code entered above for tracking purposes. Be sure to include your URL in the URL field.</i></font></td>
 </tr>
 <tr>
  <td colspan="2" align="center">
   <input type="submit" name="submitad" id="submitad" value="Modify Ad">&nbsp;&nbsp;
   <input type="reset" name="reset" id="reset" value="Reset">
  </td>
 </tr>
</table>
</form>
<?
break;
// *** Delete ***
	  case 'del':
      $sql = "DELETE FROM tbl_ad WHERE id='".$id."'"; 
      if (mysql_query($sql)) { 
        echo("<center>The ad has been deleted.</center>");
      } else { 
        echo("<p>Error deleting ad: " . mysql_error() . "</p>"); 
      }
break;
// *** Update ***
	  case 'update':
//  echo("id: ".$id);

// Set end date
$e_date = ($e_date_y."-".$e_date_m."-".$e_date_d);

// Check for extended expiration
if ($e_date > $old_edate) {
   $active = 'T';
}

// Check for new image
  // Grab uploaded image
  if (!empty($_FILES['src_new']['name'])) {
          $upload_allowed = "1";
  	  $maxsize = "512000";
  	  if ($_FILES['src_new']['size']>$maxsize) {
  	  	$upload_allowed = "0";
  	  	echo "size: ".$_FILES['src_new']['size']."\n";
  	  }
  	  $type_allowed = strpos(($_FILES['src_new']['type']), 'image');
  	  if ($type_allowed===false) {
  	  	$upload_allowed = "0";
  	  	echo "type_allowed: $type_allowed\n";
  	  }
  	  $uploaddir = '/home/hcparade/public_html/admgr/images/ads/';
      $uploadfile = $uploaddir. $_FILES['src_new']['name'];
      $img_name = $_FILES['src_new']['name'];

      //if ((move_uploaded_file($_FILES['src_new']['tmp_name'], $uploadfile)) && ($upload_allowed=="1")) {
      if ((copy($_FILES['src_new']['tmp_name'], $uploadfile)) && ($upload_allowed=="1")) {
          //print "<pre>";
      	  //print "File is valid, and was successfully uploaded. ";
          //print "Here's some more debugging info:\n";
          //print_r($_FILES);
          //print "</pre>";
          shell_exec('chmod a+r images/ads/'.$img_name);
      } else {
          print "<pre>";
          print "Possible file upload attack!  Here's some debugging info:\n";
          print "upload_allowed: $upload_allowed\n";
          print_r($_FILES);
          print "</pre>";
          exit;
      }
      $src = $img_name;
  }

$sql = "UPDATE tbl_ad SET name='".addslashes($name)."', zone='".addslashes($zone)."', type='".$type."', ";
$sql = $sql."owner='".addslashes($owner)."', e_date='".$e_date."', src_code='".addslashes($src_code)."', ";
$sql = $sql."src='".addslashes($src)."', alt='".addslashes($alt)."', href='".$href."', ";
$sql = $sql."active='".$active."' "; 
$sql = $sql."WHERE id='".$id."'";
//echo("sql: ".$sql."<br>");
if (mysql_query($sql)) {
   		echo("<center>The ad has been updated.</center>");
      } else {
        echo("<p>Error updating ad: " . mysql_error() . "</p><p>sql: $sql</p>");
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
