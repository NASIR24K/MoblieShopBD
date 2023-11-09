<?php
session_start();
require_once('inc.php');
$tblName="card_info";
$prdId=isset($_REQUEST['prdId'])? $_REQUEST['prdId'] :"";
$Qty=isset($_REQUEST['quentity'])?$_REQUEST['quentity']:" ";

if(isset($_REQUEST['add_card'])){
	 $dataquery="SELECT Quentity,`productID` FROM `card_info` WHERE `productID`='".$_REQUEST['hidden_ID']."'";
	 $result=mysqli_query($db,$dataquery);
	if(mysqli_num_rows($result)==1){
		$result=mysqli_fetch_row($result);
		 $quentity=$result[0]+$Qty;
		mysqli_query($db,"UPDATE `card_info` SET quentity='".$quentity."' WHERE`ses_id`='".$_SESSION['myID']."' AND productID='".$_REQUEST['hidden_ID']."'");

	}
	 $insertsql="INSERT INTO $tblName VALUES('".$_SESSION['myID']."','".$_REQUEST['hidden_ID']."','".$Qty."','".$_REQUEST['hid_price']."')";
	  mysqli_query($db,$insertsql);
	
	}
?>
<table width='100%' cellpadding='5px;'>

  <?php 
	$query="SELECT * FROM `product_info` WHERE `product_id`='$prdId'";
	$row=mysqli_fetch_row(mysqli_query($db,$query));
	 $sqty=lookup("SELECT `Quentity` FROM `card_info` WHERE `ses_id`='".$_SESSION['myID']."' AND `productID`='".$row[1]."'");
		echo '<td>
			<form method="post" action="#">
			  <img src="image/'.$row[1].'.jpg" alt="phone" width="150" height="150"></img>
				  <p>'.$row[2].'</p>
				  <p>$'.$row[4].'</p>
				  <input type="hidden" name="hidden_ID" value='.$row[1].'>
				  <input type="hidden" name="hid_price" value='.$row[4].'>
			     <input type="number" name="quentity" value="'.$sqty.'"></br>
				 <input type="submit" name="add_card" value="Add to Card" style="margin-top:px; padding:5px;">
				<p>'.$row[3].'</p>
           </form>
		    
		</td>';
	?> 
</table>
