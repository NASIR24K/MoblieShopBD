<?php
session_start();
include('inc.php');
?>
<div class="container" align="center" style="margin-top: 50px;">
<table>
<tr>
<td colspan="2">
	MobileMBD.com
	Address : Uttorbadda,Ali more, Gulshan-1, Dhaka-1212
	E-mail: nasir24k@gmail.com
</td>
</tr>
<tr>
<td>
	<?php 
	$my="SELECT `cus_name`,`cus_address`,`cus_phone` FROM `customer_info` WHERE `customer_id`='".$_SESSION['id']."'";
	$return="<table class='tbl'  style='margin-left: 20px;'>";
	$res=mysqli_query($db,$my);
	$row=mysqli_fetch_row($res);
	$return.="<tr>
	             <td>Name :</td><td>$row[0]</td>
	          <tr>";
	$return.="<tr>
	             <td>Address:</td><td>$row[1]</td>
			 </tr>";
	$return.="<tr>
				 <td> Phone :</td> <td>$row[2]</td>
			  </tr>";
	$return.="</table>";
	print $return;
	?>
</td>
		<td>
		  <dl class="row">
			<dt class="col-sm-3">Name</dt>
			<dd class="col-sm-8">HI</dd>
			<dl>
		</td>
</tr>
<tr>
<td>
<?php
 $sql=mysqli_query($db,"SELECT (SELECT product_name FROM product_info WHERE productID=product_id),
 Quentity,product_price,Quentity*product_price,productID FROM card_info WHERE ses_id='".$_SESSION['myID']."'");

print '<table class="table table-hover"><tr><th>Serial No</th><th>Product Name</th><th>Quentity</th><th>Price</th><th>Amount</th></tr>';
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
			   <td align="center"> <input type="text" margin="0px" name="quentity" value='.$row[1].'>
			   </td>
			   <td>'.$row[2].'</td>
			   <td align="right">'.number_format($row[3],2).'</td>
			   <td>
			   <input type="HIDDEN" name="hidden_ID" value='.$row[4].'>
			  
			   </td>
		    </tr>
			</form>'; 
	 }
    print '<tr>
			  <td colspan="2" align="right">Total Q</td>
			  <td  align="right">'.$sum1.'</td>
			  <td  align="right">Total Amount</td>
			  <td  align="right">'.number_format($sum,2).'</td>
	    </tr>';
print '</table>';
	?>
	</td>
	</tr>
	</table>
	</div>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-             Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  

<body>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-        J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-  wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<div>
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
</body>
</html>
<?php
	$tblName="order_info";
	$pk="order_id";
	if(isset($_REQUEST['submit'])){
	$myID=MAKE_ID("ORD-",10,$tblName,$pk);
	  print  $sql="INSERT INTO $tblName SET 
			 order_id='".$myID."',
		     order_date=CURDATE(),
		     customer_id='".$_SESSION['id']."'";
				mysqli_query($db,$sql);
	}
	?>