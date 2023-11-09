<?php
session_start();
require_once('inc.php');
$tblName="card_info";
$ID=isset($_REQUEST['ID'])?$_REQUEST['ID']:"";
$sql="SELECT * FROM `product_info` WHERE `showProduct`='YES'";
 $sql=isset($_REQUEST['ID']) ? "SELECT * FROM `product_info` WHERE `cat_id`='".$ID."'": $sql;

 $Qty=isset($_REQUEST['quentity'])?$_REQUEST['quentity']:"";

if(isset($_REQUEST['add_card']))  {
	 $b="SELECT Quentity,`productID` FROM `card_info` WHERE `productID`='".$_REQUEST['hidden_ID']."'";
	 $result=mysqli_query($db,$b);
	if(mysqli_num_rows($result)==1){
		$row=mysqli_fetch_row($result);
		 $quentity=$row[0]+$Qty;
		print mysqli_query($db,"UPDATE `card_info` SET quentity='".$quentity."' WHERE`ses_id`='".$_SESSION['myID']."' AND productID='".$_REQUEST['hidden_ID']."'");

	}
	else
	{
		 $insertsql="INSERT INTO $tblName SET `ses_id`='".$_SESSION['myID']."',`productID`='".$_REQUEST['hidden_ID']."',`Quentity`='".$Qty."',`product_price`='".$_REQUEST['hid_price']."'";
	 mysqli_query($db,$insertsql);
		
	}
	
		
	
}
	$a=0;
?>
<table width='100%' cellpadding='5px;'>

  <?php 
	$res=mysqli_query($db,$sql);
	$query="SELECT COUNT(`product_id`) FROM `product_info` WHERE `showProduct`='YES'";
   $query=isset($_REQUEST['ID']) ? "SELECT COUNT(`product_id`) FROM `product_info` WHERE `cat_id`='".$ID."'": $query;
	$rows=mysqli_fetch_row(mysqli_query($db,$query));
	  for($i=1;$i<=$rows[0];$i++){
		  $row=mysqli_fetch_row($res);
		if($a==4){
		echo "<tr></tr>";
		$a=0;
  		}
		  		 $sqty=lookup("SELECT `Quentity` FROM `card_info` WHERE `ses_id`='".$_SESSION['myID']."' AND `productID`='".$row[1]."'");
		echo '<td>
		
			<form method="post" action='.$_SERVER['PHP_SELF'].'>
			 <a href="details.php?prdId='.$row[1].'">
			  <img src="image/'.$row[1].'.jpg" alt="phone" width="150" height="150"></img>
			   </a>
			   <a href="details.php?prdId='.$row[1].'">
				  <p>'.$row[2].'</p>
				   </a>
				  <p>$'.$row[4].'</p>
				  <input type="hidden" name="hidden_ID" value='.$row[1].'>
				  <input type="hidden" name="hid_price" value='.$row[4].'>
			     <input type="number" name="quentity" value="'.$sqty.'"></br>
				 <input type="submit" name="add_card" value="Add to Card" style="margin-top:px; padding:5px;">
           </form>
		</td>';
	 $a++;
	  }
	?> 
</table>
