<?php
  session_start();
  include("inc.php");
?>
<div id="container">
<table class="tbl_container" align="center">
		<tr>
		<div class="div_container1">
			<td align="center" colspan="2">
				<h1>MObileMBD.com</h1>
				<p>32/2, Chemelibag, Shantinagar, Dhaka-1212</p>
				<p>E-mail: nasir24k@gmail.com</p>
			</td>
			</div>
		</tr>
		
<tr>
<div class="div_container2">
<td>
<?php
 $id=isset($_REQUEST['id'])? $_REQUEST['id']:'';
		$return="<table align='left' class='tbl'>";
		$sql="SELECT  
					customer_info.`cus_name`,
					customer_info.`cus_address`,
					customer_info.`cus_phone`,
					order_info.`order_date` 
					FROM `order_info` 
					INNER JOIN 
					`customer_info` ON 
					order_info.`customer_id`=customer_info.`customer_id` WHERE order_id='".$id."'";
		$res=mysqli_query($db,$sql);
		while($row=mysqli_fetch_row($res))
		   {
			  $return.="<tr>
							<td>
								Name   : ".$row[0]."<br>
								Address: ".$row[1]."<br>
								Phone :".$row[2]."<br>
								Date  :".$row[3]."
							</td>
						</tr>";
		   }
		   print $return.="</table>";
	?>
	   
		   </td>
					   <td>
					   <table class="tbl_container1">
							   <tr>
								   <td>Date:</td>
								   <td><?php print date('d/m/Y');?></td>
							   <tr>
							   <tr>
								   <td>Time:</td>
								   <td><?php 
									   
									   print date('h:i:sa');
									   ?></td>
							   <tr>
					   </table>
					   </td>  
					    </div> 
		   </tr>
		   <tr>
	      
		      <td colspan="2">
		   <?php
            $return1="<table align='center' class='product_content' cellpadding='10'>";
		$return1.="<tr>
				 <td>SL</td>
				 <td>Product Name</td>
				 <td>Qty</td>
				 <td>Price</td>
				 <td>Total</td>
				 </tr>";
		 $sql="SELECT 
					`product_info`.`product_name`,
					`order_detail`.`quantity`,
					`order_detail`.`price`,
					(`order_detail`.`quantity`*`order_detail`.`price`) AS Total
					 FROM `order_detail`
					 INNER JOIN `product_info` 
					 ON 
					 `order_detail`.`product_id`=`product_info`.`product_id` WHERE order_id='".$id."' ";
		$res=mysqli_query($db,$sql);
        $i=1;
		while($row=mysqli_fetch_row($res))
		   {
			  
			   $return1.="<tr>
			   <td>".$i++."</td>
			   <td>".$row[0]."</td>
			   <td>".$row[1]."</td>
			   <td>".$row[2]."</td>
			   <td>".$row[3]."</td>
			   </tr>";
		   }
		   print $return1.="</table>";
			   ?>
		   </td>
		  
		   </tr>
</table>
</div>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="order_master_detail.css">
</head>

<body>
</body>
</html>