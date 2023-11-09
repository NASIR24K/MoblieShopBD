<?php
session_start();
include("inc.php");
$tblName="`order_details`";
$msg="";
if(isset($_REQUEST['btn_add']))
  {
	print  $sql="INSERT INTO $tblName SET 
	                                `ses_id`='".$_SESSION['myID']."',        
									`detail_id`='".$_REQUEST['detail_id']."',
									`product_name`='".$_REQUEST['product_name']."',
                                     `quentity`='".$_REQUEST['quentity']."',
									 `price`='".$_REQUEST['price']."'";
	 $res=mysqli_query($db,$sql);
	  $msg=($res)?"Insert data successful":"Not insert data success";
	  
  }
 $return="<table border='1'>";
		  $sql="SELECT `product_name`,`quentity`,`price` FROM $tblName";
 $return.="<tr>
				<td>SL</td>
				<td>Product Name</td>
				<td>Quentity</td>
				<td>Price</td>
           </tr>";
		  $res=mysqli_query($db,$sql);
		  $i=1;
		  while($row=mysqli_fetch_row($res))
		       {
				   $return.="<tr>
				             <td>".$i++."</td>
							 <td>".$row[0]."</td>
							 <td>".$row[1]."</td>
							 <td>".$row[2]."</td>
							 </tr>";
			   }
$return.="</table>";

if(isset($_REQUEST['btn_save']))
  {
	   $sql="INSERT INTO `order_infomation` SET(
	                                `info_id`='".$_REQUEST['info_id']."',
									`cus_name`='".$_REQUEST['cus_name']."',
									`mobile`='".$_REQUEST['mobile']."',
                                     `remarks`='".$_REQUEST['remarks']."',
									 `date`='".$_REQUEST['date']."')'";
	  
	 $res=mysqli_query($db,$sql);
	  $msg=($res)?"Insert data successful":"Not insert data success";
	  
  }
$return1="<table border='1px solid black;'>";
 $sq="SELECT (SELECT `cus_name`,`mobile`,`remarks`,`date` FROM `order_infomation` WHERE `info_id`='".@$_REQUEST['info_id']."'),`product_name`,`quentity`,`price`,`quentity`*`price`,`info_id` FROM `order_details` WHERE  ses_id='".$_SESSION['myID']."'";
 //$sq="SELECT (`cus_name`,`mobile`,`remarks`,`date` FROM `order_infomation` WHERE `info_id`='".@$_REQUEST['info_id']."'),`product_name`,`quentity`,`price` FROM $tblName";
$query=mysqli_query($db,$sq);
 $return1.="<tr>
                <td>SL</td>
				<td>cus_name</td>
				<td>mobile</td>
				<td>remarks</td>
				<td>Date</td>
				<td>Product Name</td>
				<td>Quentity</td>
				<td>Price</td>
				<td>Amount</td>
           </tr>";
$i=1;
while($row=mysqli_fetch_array($query))
     {
		  $return1.="<tr>
					 <td>".$i++."</td>
					 <td>".$row[0]."</td>
					 <td>".$row[1]."</td>
					 <td>".$row[2]."</td>
					 <td>".$row[3]."</td>
					 <td>".$row[4]."</td>
					 <td>".$row[5]."</td>
					 <td>".$row[6]."</td>
					 <td>".$row[7]."</td>
					 </tr>";
	 }
  $return1.="</table>";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form method="post" action="<?php $_SERVER['PHP_SELF']?>">
<table width="200" border="1px solid">
  <caption>
    order_form
  </caption>
  <tbody>
    <tr>
      <td>
        order_info
      </td>
      <td>
      	order_details
      </td>
    </tr>
    <tr>
      <td>
      	<table>
  <tbody>
    <tr>
      <th>info_id</th>
      <td><input type="text" id="info_id" name="info_id" value=""></td>
    </tr>
    <tr>
      <th>cus_name</th>
      <td><input type="text" id="cus_name" name="cus_name" value=""></td>
    </tr>
    <tr>
      <th>mobile</th>
      <td><input type="text" id="mobile" name="mobile" value=""></td>
    </tr>
    <tr>
      <th>remark</th>
      <td><input type="text" id="remarks" name="remarks" value=""></td>
    </tr>
    <tr>
      <th>datetime</th>
      <td><input type="datetime" id="date" name="date" value=""></td>
    </tr>
    <tr>
    </tbody>
     </table>
  
      </td>
      <td>
      <table>
      <tbody>
<!--     <th>info_id</th>
      <td><input type="text" id="ses_id" name="ses_id" value=""></td>
    </tr>-->
    <tr>
      <th>detail_id</th>
      <td><input type="text" id="detail_id" name="detail_id" value=""></td>
    </tr>
    <tr>
      <th>product_name</th>
      <td><input type="text" id="product_name" name="product_name" value=""></td>
    </tr>
    <tr>
      <th>quentity</th>
      <td><input type="text" id="quentity" name="quentity" value=""></td>
    </tr>
    <tr>
      <th>price</th>
      <td><input type="text" id="price" name="price" value=""></td>
    </tr>
    <tr>
      <td><input type="submit" id="btn_add" name="btn_add" value="Add Product"></td>
    </tr>
  </tbody>
</table>
      </td>
    </tr>
    <tr>
      <td colspan="2">
      <?php print $msg;?>
      <?php
		  print $return;
		  ?>
      </td>
    </tr>
    <tr>
      <td colspan="2">
      	      <input type="submit" id="btn_save" name="btn_save" value="Save">
			  <input type="submit" id="btn_edit" name="btn_edit" value="Edit">
			  <input type="submit" id="btn_delete" name="btn_delete" value="Delete">
      </td>
      
    </tr>
    <tr>
    <td colspan="2">
       <?php print $return1; ?>
    </td>
    </tr>
  </tbody>
</table>	
</form>
</body>
</html>