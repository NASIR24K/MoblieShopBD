<?php
	require_once("inc.php");
	$tblName="category";
	$pk="cat_id";
	//print make_id('CAT-',7,'CAT-009');
	$msg="Welcome To Category Information";
	$k=isset($_REQUEST['a']) ? $_REQUEST['a'] : 0;
	$sql="SELECT COUNT(*) FROM $tblName";
	$rs=mysqli_query($db,$sql);
	$row=mysqli_fetch_row($rs);
	$totalRow=$row[0]-1;	
	if(isset($_REQUEST['butAdd']))
	{
		$id=mysqli_fetch_row(mysqli_query($db,"SELECT MAX(`cat_id`) FROM `category`"));
		$id=$id[0];
		//$rr=mysqli_query($db,"SELECT MAX(`cat_id`) FROM `category`");
		//$row=mysqli_fetch_row($rr);
		//$id=$row[0];
		$myID=make_id("CAT-",7,$id);
		$sql="INSERT INTO $tblName VALUES('".$myID."','".$_REQUEST['cat_title']."')";
		$res=mysqli_query($db,$sql);
		$msg= ($res) ? "CAtegory Insert Successfull" : "CAtegory Insert NOT Successfull" ;
	}
	if(isset($_REQUEST['butEdit']))
	{
		//$sql="REPLACE INTO $tblName VALUES('".$_REQUEST['cat_id']."','".$_REQUEST['cat_title']."')";
		$sql="UPDATE $tblName SET `cat_title`='".$_REQUEST['cat_title']."' WHERE $pk='".$_REQUEST['cat_id']."'";
		$res=mysqli_query($db,$sql);
		$msg= ($res) ? "CAtegory UPDATE Successfull" : "Category UPDATE NOT Successfull" ;
	}
	if(isset($_REQUEST['butDelete']))
	{
		$sql="DELETE FROM $tblName WHERE $pk='".$_REQUEST['cat_id']."'";
		$res=mysqli_query($db,$sql);
		$msg= ($res) ? "CAtegory DELETE Successfull" : "Category DELETE NOT Successfull" ;
		$k=0;
	}
	if(isset($_REQUEST['butShow']))
	{
		$result="<table border='1'>";
		$sql="SELECT * FROM $tblName";
		$res=mysqli_query($db,$sql);
			
		while($row=mysqli_fetch_row($res))
		{
			$result.="<tr><td>".$row[0]."</td><td>".$row[1]."</td></tr>";
		}
		$result.="</table>";
		$msg=$result;
	}
	if(isset($_REQUEST['butFirst']))
	{
		$k=0;
		$msg="First Data is Showing ($k / $totalRow)";
	}
	if(isset($_REQUEST['butPrevious']))
	{
		if(--$k <=0 ) $k=0;	
		$msg="Previous Data is Showing ($k / $totalRow)";
	}
	if(isset($_REQUEST['butNext']))
	{
		if(++$k >= $totalRow) $k=$totalRow ;
		$msg="Next Data is Showing (".($k+1)." / ".($totalRow+1).")";
	}
	if(isset($_REQUEST['butLast']))
	{
		$k=$totalRow;
		$msg="Last Data is Showing ($k / $totalRow)";
	}
	$sql="SELECT * FROM $tblName LIMIT $k,1";
	$rs=mysqli_query($db,$sql);
	$row=mysqli_fetch_row($rs);
?>
<!doctype html>
<html>
	<body>
	<form method="POST" action="<?php print $_SERVER['PHP_SELF']; ?>">
	<table border="1" cellspacing="2" cellpadding="2" align="center">
	<tr>
		<td>Category ID : </td>
		<td>
			<input type="text" id="cat_id" name="cat_id" value="<?php print $row[0]; ?>" readonly >
		</td>
	</tr>
	<tr>
		<td>Category Title : </td>
		<td>
			<input type="text" id="cat_title" name="cat_title" value="<?php print $row[1]; ?>" >
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<input type="submit" id="butAdd" name="butAdd" value="Add">
		<input type="submit" id="butEdit" name="butEdit" value="Edit">
		<input type="submit" id="butDelete" name="butDelete" value="Delete" onclick="alert('Hello World')">
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
	<input type="hidden" id="a" name="a" value="<?php print $k; ?>" >
	</form>
	</body>
</html>