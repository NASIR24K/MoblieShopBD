<?php
	$db=mysqli_connect("localhost","root","","mobile_project");
	$k=isset($_REQUEST['a']) ? $_REQUEST['a'] : 0 ;
	$msg="Welcome To Customer Information";
	$sql="SELECT COUNT(*) FROM customer_info";
	$rs=mysqli_query($db,$sql);
	$row=mysqli_fetch_row($rs);
	$totalRecord=$row[0]-1;
	if(isset($_REQUEST['butNext']))
	{
		$k=$_REQUEST['a'];
		if(++$k >=$totalRecord) $k=$totalRecord;
		$msg="Next Data Showing (".($k+1)." / ".($totalRecord+1).")";
	}
	if(isset($_REQUEST['butPrevious']))
	{
		$k=$_REQUEST['a'];
		if(--$k <=0 ) $k=0;		
		$msg="Previous Data Showing(".($k+1)." / ".($totalRecord+1).")";
	}
	if(isset($_REQUEST['butFirst']))
	{
		$k=0;
		$msg="First Data Showing(".($k+1)." / ".($totalRecord+1).")";
	}
	if(isset($_REQUEST['butLast']))
	{
		$k=$totalRecord;
		$msg="Last Data Showing(".($k+1)." / ".($totalRecord+1).")";
	}
	$sql="SELECT * FROM customer_info LIMIT $k,1";
	$rs=mysqli_query($db,$sql);
	$row=mysqli_fetch_row($rs);
?>
<!doctype html>
<html>
	<head>
	</head>
	<body>
	<form method="POST" action="<?php print $_SERVER['PHP_SELF']; ?>">
	<table border="1" cellspacing="2" cellpadding="2" align="center">
	<tr>
		<td>Customer ID : </td>
		<td>
			<input type="text" id="customer_id" name="customer_id" value="<?php print $row[0]; ?>" readonly >
		</td>
	</tr>
	<tr>
		<td>Name: </td>
		<td>
			<input type="text" id="customer_name" name="customer_name" value="<?php print $row[1]; ?>" >
		</td>
	</tr>
	<tr>
		<td>Address: </td>
		<td>
			<input type="text" id="customer_address" name="customer_address" value="<?php print $row[2]; ?>" >
		</td>
	</tr>
	<tr>
		<td>Mobile No: </td>
		<td>
			<input type="text" id="customer_mobile" name="customer_mobile" value="<?php print $row[3]; ?>" >
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<input type="submit" id="butAdd" name="butAdd" value="Add">
		<input type="submit" id="butEdit" name="butEdit" value="Edit">
		<input type="submit" id="butDelete" name="butDelete" value="Delete">
		<input type="submit" id="butShow" name="butShow" value="SHOW">
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<input type="submit" id="butFirst" name="butFirst" value="First">
		<input type="submit" id="butPrevious" name="butPrevious" value="Previous">
		<input type="submit" id="butNext" name="butNext" value="Next">
		<input type="submit" id="butLast" name="butLast" value="Last">
		</td>
	</tr>
	<tr><td colspan="2" align="center"><?php print $msg ?></td></tr>
	</table>
	<input type="hidden" id="a" name="a" value="<?php print $k ?>" >
	</form>
	</body>
</html>