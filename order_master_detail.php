<?php
      include("inc.php");
	  $msg="";
      if(isset($_REQUEST['btn_save'])) 
             {
				 $myID=MAKE_ID("ORD-",8,'order_info', 'order_id');
				 $sql="INSERT INTO `order_info` SET
				                            order_id='".$myID."',
											order_date='".$_REQUEST['order_date']."',
											customer_id='".$_REQUEST['customer_id']."'
											";
				 $result=mysqli_query($db,$sql);
				 $msg=($result)?"ADD to order":"Do Not add";
			 }
       $return="<table>";
       $sql="SELECT * FROM `order_info`";
       $res=mysqli_query($db,$sql);
       $return.="<tr>
	                  <td>SL</td>
					  <td>order_id</td>
					  <td>order_date</td>
					  <td>customer_id</td>
				 </tr>";
        $i=1;
        while($row=mysqli_fetch_row($res))
		       {
				   $return.="<tr>
				       
							  <td><a href='invoice.php?id=".$row[0]."'>".$i++."</a></td>
							   <td>".$row[0]."</td>
							   <td>".$row[1]."</td>
							   <td>".$row[2]."</td>
							 </tr>";
			   }
         $return.="</table>";
	
		 
			 $cusID=Combo('customer_id','SELECT customer_id FROM `customer_info`',$row[2]);
            
		     $data="SELECT `cus_name` FROM `customer_info` WHERE `customer_id`='".$row[2]."'";
			$data=mysqli_query($db,$data);
			$cus_name=mysqli_fetch_row($data); 

  if(isset($_REQUEST['btn_saved'])) 
             {
				 $ID=isset($_REQUEST['order_id']) ? $_REQUEST['order_id']:'';
				 $myID1=MAKE_ID($ID."-INF-",16,'order_detail', 'detail_id');
			 $sql="INSERT INTO `order_detail` SET
				                            detail_id='".$myID1."',
											order_id='".$_REQUEST['order_id']."',
											product_id='".$_REQUEST['product_id']."',
											quantity='".$_REQUEST['quantity']."',
											price='".$_REQUEST['price']."'
											";
				 $result=mysqli_query($db,$sql);
				 $msg=($result)?"ADD to product":"Do Not add product";
			 }
       $return1="<table>";
       $sql="SELECT `product_info`.`product_name`,
					`order_detail`.`quantity`, 
					`order_detail`.`price` 
					 FROM 
					`order_detail` 
					 INNER JOIN `product_info` 
					  ON 
					`product_info`.`product_id`=`order_detail`.`product_id`";
       $res=mysqli_query($db,$sql);
       $return1.="<tr>
	                  <td>SL</td>
					  <td>product_name</td>
					  <td>quantity</td>
					  <td>price</td>
				 </tr>";
             $i=1;
         while($row=mysqli_fetch_row($res))
		       {
				   $return1.="<tr>
							   <td>".$i++."</td>
							   <td>".$row[0]."</td>
							   <td>".$row[1]."</td>
							   <td>".$row[2]."</td>
							 </tr>";
			   }
          $return1.="</table>";
	
		

    $pid=Combo('product_id','SELECT `product_id` FROM `product_info`');
    $ord=Combo('order_id','SELECT `order_id` FROM `order_info`');

  
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Untitled Document</title>
		<link href="master.css" type="text/css" rel="stylesheet">
	</head>

<body>
	<div class="content">
		<form method="post" action="<?php $_SERVER['PHP_SELF']?>">
			<table>
				<caption>
						MASTER_DETAILS_TABLE_INFORMATION
						<hr/>
				</caption>
			<tbody>
			<tr>
				<td>
				ORDER_INFORMATION
				</td>
				<td>
				ORDER_DETAILS_INFORMATION
				</td>
			</tr>
			<tr>
			<td>
			<div class="info_content">
				<table>
				<tbody>
					<tr>
						<th>order_id</th>
						<td><input type="text" id="order_id" name="order_id" value="" readonly></td>
					</tr>
					<tr>
						<th>order_date</th>
						<td><input type="date" id="order_date" name="order_date" value=""></td>
					</tr>
					<tr>
						<th>customer_id</th>
						<td><?php print $cusID;?></td>
					</tr>
                 <tr>
				     <td>
					<input type="submit" id="btn_save" name="btn_save" value="Save">
					<input type="submit" id="btn_edit" name="btn_edit" value="Edit">
					<input type="submit" id="btn_delete" name="btn_delete" value="Delete">
			        
				   </td>
			</tr>
			<tr>
			  
			   <td>
                     <?php print $return;?>
			   </td>
			</tr>
				</tbody>
				</table>
			</div>
			</td>
			<td>
				<div class="detail_content">
				<table>
					<tbody>
					     <tr>
							<th>detail_id</th>
							<td><input type="text" id="detail_id" name="detail_id" value="" readonly></td>
						</tr>
						<tr>
							<th>order_id</th>
							<td><?php print $ord;?></td>
						</tr>
						<tr>
							<th>product_id</th>
							<td><?php print $pid;?></td>
						</tr>
						<tr>
							<th>quantity</th>
							<td><input type="text" id="quantity" name="quantity" value=""></td>
						</tr>
						<tr>
							<th>price</th>
							<td><input type="text" id="price" name="price" value=""></td>
						</tr>
						<tr>
					    <td>
								<input type="submit" id="btn_save" name="btn_saved" value="Add Product">
								<input type="submit" id="btn_edit" name="btn_edited" value="Edit">
								<input type="submit" id="btn_delete" name="btn_deleted" value="Delete">
								
						 </td>  
						</tr>
						<tr>
				<td>
				<?php print $return1;?>
				</td>
				</tr>
					</tbody>
				</table>
				</div>
				<hr/>
				
			</td>
			</tr>
				<tr>
					<td colspan="2">
			       <?php 
				   print $msg;
				   ?>
					</td>
				</tr>
			</tbody>
			</table>	
		</form>
	</div>
</body>
</html>