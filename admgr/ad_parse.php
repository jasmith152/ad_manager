<?php
// Establish GET & POST variables
import_request_variables("gp");
$PHP_SELF = $_SERVER['PHP_SELF'];

//open database connection
include '../admin/dbconn.php';

//Gather ad info
	 $result = @mysql_query("SELECT * FROM tbl_ad WHERE id='".$id."'");
	 if (mysql_num_rows($result) == 0){
	 	echo("MySQL Error: " . mysql_error());
	 }
	 $row = mysql_fetch_array($result);

//Count the Click
		 $month = date("m");
		 switch ($month){
		   case '1':
		   		$clicks_m = (($row["clicks_1"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET clicks_1='".$clicks_m."' WHERE id='".$row["id"]."'";
				break;
		   case '2':
		   		$clicks_m = (($row["clicks_2"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET clicks_2='".$clicks_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '3':
		   		$clicks_m = (($row["clicks_3"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET clicks_3='".$clicks_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '4':
		   		$clicks_m = (($row["clicks_4"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET clicks_4='".$clicks_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '5':
		   		$clicks_m = (($row["clicks_5"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET clicks_5='".$clicks_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '6':
		   		$clicks_m = (($row["clicks_6"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET clicks_6='".$clicks_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '7':
		   		$clicks_m = (($row["clicks_7"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET clicks_7='".$clicks_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '8':
		   		$clicks_m = (($row["clicks_8"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET clicks_8='".$clicks_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '9':
		   		$clicks_m = (($row["clicks_9"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET clicks_9='".$clicks_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '10':
		   		$clicks_m = (($row["clicks_10"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET clicks_10='".$clicks_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '11':
		   		$clicks_m = (($row["clicks_11"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET clicks_11='".$clicks_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '12':
		   		$clicks_m = (($row["clicks_12"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET clicks_12='".$clicks_m."' WHERE id='".$row["id"]."'";
		   		break;
		 }
		 @mysql_query($sql2);

	 $clicks = (($row["clicks_1"]) + ($row["clicks_2"]) + ($row["clicks_3"]) + ($row["clicks_4"]) + ($row["clicks_5"]) + ($row["clicks_6"]));
	 $clicks = ($clicks + ($row["clicks_7"]) + ($row["clicks_8"]) + ($row["clicks_9"]) + ($row["clicks_10"]) + ($row["clicks_11"]) + ($row["clicks_12"]));
	 $sql1 = "UPDATE tbl_ad SET clicks='".$clicks."' WHERE id='".$row["id"]."'";
	 @mysql_query($sql1);
	 //echo("<br>clicks='" . $clicks . "'");

//Redirect browser
	 @header("Location: " . $row["href"]);
?>