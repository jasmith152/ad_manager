<html>
<head>
	<title>Reset Hit Count</title>
</head>
<body>
<?php
// Establish GET & POST variables
import_request_variables("gp");
$PHP_SELF = $_SERVER['PHP_SELF'];

//open database connection
include '../dbconn.php';

@mysql_query("UPDATE tbl_ad SET hits='0'");
@mysql_query("UPDATE tbl_ad SET hits_1='0'");
@mysql_query("UPDATE tbl_ad SET hits_2='0'");
@mysql_query("UPDATE tbl_ad SET hits_3='0'");
@mysql_query("UPDATE tbl_ad SET hits_4='0'");
@mysql_query("UPDATE tbl_ad SET hits_5='0'");
@mysql_query("UPDATE tbl_ad SET hits_6='0'");
@mysql_query("UPDATE tbl_ad SET hits_7='0'");
@mysql_query("UPDATE tbl_ad SET hits_8='0'");
@mysql_query("UPDATE tbl_ad SET hits_9='0'");
@mysql_query("UPDATE tbl_ad SET hits_10='0'");
@mysql_query("UPDATE tbl_ad SET hits_11='0'");
@mysql_query("UPDATE tbl_ad SET hits_12='0'");
@mysql_query("UPDATE tbl_ad SET reset='2002-00-00'");
echo("Reset Complete!<br>");

$result = @mysql_query("SELECT * FROM tbl_ad");
?>
<table border="1">
 <tr>
  <td><font face="arial" size="3"><b>Hits</b></font></td>
  <td><font face="arial" size="3"><b>Hits_1</b></font></td>
  <td><font face="arial" size="3"><b>Hits_2</b></font></td>
  <td><font face="arial" size="3"><b>Hits_3</b></font></td>
  <td><font face="arial" size="3"><b>Hits_4</b></font></td>
  <td><font face="arial" size="3"><b>Hits_5</b></font></td>
  <td><font face="arial" size="3"><b>Hits_6</b></font></td>
  <td><font face="arial" size="3"><b>Hits_7</b></font></td>
  <td><font face="arial" size="3"><b>Hits_8</b></font></td>
  <td><font face="arial" size="3"><b>Hits_9</b></font></td>
  <td><font face="arial" size="3"><b>Hits_10</b></font></td>
  <td><font face="arial" size="3"><b>Hits_11</b></font></td>
  <td><font face="arial" size="3"><b>Hits_12</b></font></td>
  <td><font face="arial" size="3"><b>Reset</b></font></td>
 </tr>
<?php
while ( $row = mysql_fetch_array($result) ) {
echo("<tr>");
echo("<td><font face='arial' size='2'>".$row["hits"]."</td>");
echo("<td><font face='arial' size='2'>".$row["hits_1"]."</td>");
echo("<td><font face='arial' size='2'>".$row["hits_2"]."</td>");
echo("<td><font face='arial' size='2'>".$row["hits_3"]."</td>");
echo("<td><font face='arial' size='2'>".$row["hits_4"]."</td>");
echo("<td><font face='arial' size='2'>".$row["hits_5"]."</td>");
echo("<td><font face='arial' size='2'>".$row["hits_6"]."</td>");
echo("<td><font face='arial' size='2'>".$row["hits_7"]."</td>");
echo("<td><font face='arial' size='2'>".$row["hits_8"]."</td>");
echo("<td><font face='arial' size='2'>".$row["hits_9"]."</td>");
echo("<td><font face='arial' size='2'>".$row["hits_10"]."</td>");
echo("<td><font face='arial' size='2'>".$row["hits_11"]."</td>");
echo("<td><font face='arial' size='2'>".$row["hits_12"]."</td>");
echo("<td><font face='arial' size='2'>".$row["reset"]."</td>");
echo("</tr>");
}
?>
</table>
<br>
</body>
</html>
