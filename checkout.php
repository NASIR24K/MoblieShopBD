<?php
 session_start();
 require_once('inc.php');
//print $_SESSION['id'];
//print $_SESSION['myID'];
if(isset($_REQUEST['add_card'])){
			 $dataquery="SELECT Quentity,`productID` FROM `card_info` WHERE `productID`='".$_REQUEST['hidden_ID']."'";
			 $result=mysqli_query($db,$dataquery);
	if(mysqli_num_rows($result)==1){
			 $result=mysqli_fetch_row($result);
			 $quentity=$result[0]+$Qty;
			 mysqli_query($db,"UPDATE `card_info` SET quentity='".$quentity."' WHERE`ses_id`='".$_SESSION['myID']."' AND productID='".$_REQUEST['hidden_ID']."'");

	}
	 $insertsql="INSERT INTO `card_info` VALUES('".$_SESSION['myID']."','".$_REQUEST['hidden_ID']."','".$Qty."','".$_REQUEST['hid_price']."')";
	  mysqli_query($db,$insertsql);
	
	}
	 if(isset($_REQUEST['btn_delete']))
	{
		$delete="DELETE FROM `card_info` WHERE `ses_id`='".$_SESSION['myID']."' AND `productID`='".$_REQUEST['hidden_ID']."'";
		mysqli_query($db,$delete);
	}

 $sql=mysqli_query($db,"SELECT (SELECT product_name FROM product_info WHERE productID=product_id),
 Quentity,product_price,Quentity*product_price,productID FROM card_info WHERE ses_id='".$_SESSION['myID']."'");

print '<table align="center" class="table table-sm"><tr><th>Serial No</th><th>Product Name</th><th>Quentity</th><th>Price</th><th>Amount</th><th colspan="2">Action</th></tr>';
 $i=1;
 $sum=0;
 $sum1=0;
  while($row=mysqli_fetch_row($sql))
     {
		 $sum1+=$row[1];
		 $sum+=$row[3];
		 print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">
		<tr>
		   <td style="padding:10px;">'.++$i.'</td>
		   <td style="margin:5px;">'.$row[0].'</td>
		   <td align="center"> <input type="text" name="quentity" value='.$row[1].'></br></td>
		   <td>'.$row[2].'</td>
		   <td align="right">'.number_format($row[3],2).'</td>
		   <td>
		   <input type="hidden" name="hidden_ID" value='.$row[4].'>
		   <input type="submit" name="btn_delete" class="btn btn-outline-danger" value="X">
		   <input type="submit" name="btn_edit" class="btn btn-outline-warning" value="Edit">
		   </td>
		    </tr>
			</form>'; 
	 }
    print '<tr>
	      <td colspan="2" align="right">Total Q</td>
		  <td  align="right">'.$sum1.'</td>
		  <td  align="right">Total Amount</td>
		  <td  align="left" colspan="2">'.number_format($sum,2).'</td>
	    </tr>';
print '</table>';
            	
?>
<html>
<head>
<title>mobile_project</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-             Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-        J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-  wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
<a href="customer_information/user_login.php" class="btn btn-outline-success" target="">ORDER</a>
<a href="home.php" class="btn btn-outline-primary" style="text-align: right;">Continue...</a>
</body>
</html>