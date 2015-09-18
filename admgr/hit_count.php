<?php
// Establish GET & POST variables
import_request_variables("gp");
$PHP_SELF = $_SERVER['PHP_SELF'];

//open database connection
include("dbconn_ads.php");

//Gather ad info
$result = @mysql_query("SELECT * FROM tbl_ad WHERE id='".$id."'");
$row = @mysql_fetch_array($result);

//Count the Hit
		 $month = date("m");
		 switch ($month){
		   case '1':
		   		$hits_m = (($row["hits_1"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET hits_1='".$hits_m."' WHERE id='".$row["id"]."'";
				break;
		   case '2':
		   		$hits_m = (($row["hits_2"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET hits_2='".$hits_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '3':
		   		$hits_m = (($row["hits_3"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET hits_3='".$hits_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '4':
		   		$hits_m = (($row["hits_4"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET hits_4='".$hits_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '5':
		   		$hits_m = (($row["hits_5"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET hits_5='".$hits_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '6':
		   		$hits_m = (($row["hits_6"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET hits_6='".$hits_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '7':
		   		$hits_m = (($row["hits_7"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET hits_7='".$hits_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '8':
		   		$hits_m = (($row["hits_8"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET hits_8='".$hits_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '9':
		   		$hits_m = (($row["hits_9"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET hits_9='".$hits_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '10':
		   		$hits_m = (($row["hits_10"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET hits_10='".$hits_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '11':
		   		$hits_m = (($row["hits_11"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET hits_11='".$hits_m."' WHERE id='".$row["id"]."'";
		   		break;
		   case '12':
		   		$hits_m = (($row["hits_12"]) + 1);
		 		$sql2 = "UPDATE tbl_ad SET hits_12='".$hits_m."' WHERE id='".$row["id"]."'";
		   		break;
		 }
		 @mysql_query($sql2);

		 $hits = ($row["hits"] + 1);
		 $sql1 = "UPDATE tbl_ad SET hits='".$hits."' WHERE id='".$row["id"]."'";
		 if (!mysql_query($sql1)) {
		    echo("<p>Error updating ad: " . mysql_error() . "</p>");
		 }

Header( "Content-type:  image/gif" );
passthru( "cat images/ads/" . $row["src"] );
?>