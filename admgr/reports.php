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
  <title>Ad Manager - Hit Reports</title>
</head>
<body bgcolor="#ffffff">
<div align="center">
<table border="0" cellpadding="2" cellspacing="4" width="400">
 <tr bgcolor="#FFFFFF">
  <td><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2">
<!-- Begin Content -->
<?php
//echo("sort: ".$sort."<br>");
//echo("month: ".$month."<br>");

//Include Db connection script
include 'dbconn.php';

If (!$sort){
?>
<form action="reports.php" name="sortreport" id="sortreport" method="post">
<table border="0" cellpadding="4" cellspacing="2" width="100%">
 <tr>
  <td align="center"><font face="arial" color="#000000" size="4"><b><u>Ad Manager - Reports</u></b></font></td>
 </tr>
 <tr>
  <td><font face="arial" color="#000000" size="3">Create Report for&nbsp;
   <select name="month" id="month">
   <option value="<?php echo(abs(date("m"))); ?>">Current Month</option>
   <option value="year">Last 12 Months</option>
   <option value="1">January</option>
   <option value="2">February</option>
   <option value="3">March</option>
   <option value="4">April</option>
   <option value="5">May</option>
   <option value="6">June</option>
   <option value="7">July</option>
   <option value="8">August</option>
   <option value="9">September</option>
   <option value="10">October</option>
   <option value="11">November</option>
   <option value="12">December</option>
   </select>&nbsp;
   Sorted by:&nbsp;
   <select name="sort" id="sort">
   <option value="name">Ad Name</option>
   <option value="adclient">Client Name</option>
   <option value="zone">Zone</option>
   </select>&nbsp;<input type="submit" name="submit" id="submit" value="GO"></font></td>
 </tr>
 </form>
</table>
<?php
} else {
  // Set month_select
  switch($month){
	case 'year':
		 $month_select = ("hits, clicks");
		 $month_title = "the Last 12 Months";
		 break;
	default:
		 $month_select = ("hits_" . $month . ", clicks_" . $month);
		 $month_title = date("F", mktime(0, 0, 0, $month,1,2002));
		 break;
  }
  // Set sort_order and header array
  switch($sort){
	case 'name':
		 $sort_order = "name, type, zone, owner";
		 $sort_order2 = "ORDER BY name";
		 $sort_title = "Ad Name";
		 $header[0] = "Ad Name";
		 $header[1] = "Type";
		 $header[2] = "Zone";
		 $header[3] = "Owner/Client Name";
		 $header[4] = "Start Date";
		 $header[5] = "Expiration";
		 $header[6] = "Hits";
		 $header[7] = "Clicks";
		 break;
	case 'adclient':
		 $sort_order = "owner, name, type, zone";
		 $sort_order2 = "ORDER BY owner";
		 $sort_title = "Client Name";
		 $header[0] = "Owner/Client Name";
		 $header[1] = "Ad Name";
		 $header[2] = "Type";
		 $header[3] = "Zone";
		 $header[4] = "Start Date";
		 $header[5] = "Expiration";
		 $header[6] = "Hits";
		 $header[7] = "Clicks";
		 break;
	case 'zone':
		 $sort_order = "zone, name, type, owner";
		 $sort_order2 = "ORDER BY zone";
		 $sort_title = "Zone";
		 $header[0] = "Zone";
		 $header[1] = "Ad Name";
		 $header[2] = "Type";
		 $header[3] = "Owner/Client Name";
		 $header[4] = "Start Date";
		 $header[5] = "Expiration";
		 $header[6] = "Hits";
		 $header[7] = "Clicks";
		 break;
  }
  // Request the records
  $sql = "SELECT $sort_order, s_date, e_date, active, $month_select FROM tbl_ad WHERE active='T' $sort_order2";
  $result = @mysql_query($sql);
  if (!$result) {
    echo("<p>Error performing query: " . mysql_error() . "</p>"); 
    exit();
  }else{
  	//echo($sql);
  }

?>
<table border="0" cellpadding="2" cellspacing="2" width="540">
 <tr>
  <td colspan="8" align="center"><font face="arial" color="#000000" size="4"><b><?php echo("Ad Manager Report for " . $month_title . " Sorted by " . $sort_title); ?></b></font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b><?php echo($header[0]); ?></b></font></td>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b><?php echo($header[1]); ?></b></font></td>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b><?php echo($header[2]); ?></b></font></td>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b><?php echo($header[3]); ?></b></font></td>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b><?php echo($header[4]); ?></b></font></td>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b><?php echo($header[5]); ?></b></font></td>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b><?php echo($header[6]); ?></b></font></td>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b><?php echo($header[7]); ?></b></font></td>
 </tr>
 <?php
  // Display the record
  while ( $row = mysql_fetch_array($result) ) {
  		echo("<tr>");
		echo("<td><font face='arial' size='2'>".$row[0]."</font></td>");
		echo("<td><font face='arial' size='2'>".$row[1]."</font></td>");
		echo("<td><font face='arial' size='2'>".$row[2]."</font></td>");
		echo("<td><font face='arial' size='2'>".$row[3]."</font></td>");
		echo("<td><font face='arial' size='2'>".$row[4]."</font></td>");
		echo("<td><font face='arial' size='2'>".$row[5]."</font></td>");
		echo("<td><font face='arial' size='2'>".$row[7]."</font></td>");
		echo("<td><font face='arial' size='2'>".$row[8]."</font></td>");
		echo("</tr>");
		echo("<tr><td colspan='8'><hr></td></tr>");
  }
?>
</table>
<form action="reports.php" name="sortreport" id="sortreport" method="post">
<table border="0" cellpadding="2" cellspacing="2" width="50%">
 <tr>
  <td><font face="arial" color="#000000" size="3">Create Report for&nbsp;
   <select name="month" id="month">
   <option value="<?php echo(abs(date("m"))); ?>">Current Month</option>
   <option value="year">Last 12 Months</option>
   <option value="1">January</option>
   <option value="2">February</option>
   <option value="3">March</option>
   <option value="4">April</option>
   <option value="5">May</option>
   <option value="6">June</option>
   <option value="7">July</option>
   <option value="8">August</option>
   <option value="9">September</option>
   <option value="10">October</option>
   <option value="11">November</option>
   <option value="12">December</option>
   </select>&nbsp;
   Sorted by:&nbsp;
   <select name="sort" id="sort">
   <option value="name">Ad Name</option>
   <option value="adclient">Client Name</option>
   <option value="zone">Zone</option>
   </select>&nbsp;<input type="submit" name="submit" id="submit" value="GO"></font></td>
 </tr>
 </form>
</table>
<?php
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
