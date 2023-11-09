<?php
	session_start();
	require_once('inc.php');
	$id=$_REQUEST['id'];
	$sql="SELECT * FROM product WHERE productShow='Yes'";
	$sql=isset($_REQUEST['id']) ? "SELECT * FROM product WHERE categoryID='".$id."'" : $sql;		

	if(isset($_REQUEST['add']))
	{
		$inssql="INSERT INTO cart_info VALUES('".$_SESSION['myID']."','".$_REQUEST['pid']."','".$_REQUEST['qty']."','".$_REQUEST['price']."',NOW())";
		mysqli_query($db,$inssql);
	}
?>
<table border='1' width='100%'>
<?php
	$rs=mysqli_query($db,$sql);
	//$i=0;
	while($row=$rs->fetch_row())
	{
		print "\n".'<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
		print "<input type='hidden' name='pid' value='".$row[0]."'>
			<input type='hidden' name='price' value='".$row[4]."'>\n";		
		print "<tr>";		
		print '<td>Name : '.$row[1].'</td>';
		print '<td>Description : '.$row[3].'</td>';
		print '<td>Price : '.$row[4].'</td>';
		print '<td><input type="text" size="3" name="qty"/></td>';
		print '<td><input type="submit" name="add" value="Add To Cart" /></td>';
		print "</tr>";
		print "</form>\n";
	}
?>
</table>
