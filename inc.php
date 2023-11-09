<?php 
	$db=mysqli_connect("localhost","root","","mobile_project");
	
	
          function lookup($sql)
	  {
		  $rs=mysqli_query($GLOBALS['db'],$sql);
		  $rs=mysqli_fetch_row($rs);
		  return $rs[1];
	  }
      function MAKE_ID($prefix,$idlen,$tblName,$pk)
	      {
			 $maxID=lookup("SELECT MAX($pk) FROM $tblName WHERE $pk like CONCAT('".$prefix."','%')");
			 $len=$idlen-strlen($prefix);
			 $num=intval(substr($maxID,-$len))+1;
			 $num=str_pad($num,$len,'0',STR_PAD_LEFT);
			 $a=$prefix.$num;
			 return $a;
		  }
	function Combo($nm,$sql,$sel="")
	{
		$rs=mysqli_query($GLOBALS['db'],$sql);
		$ret="<select id='".$nm."' name='".$nm."'>\n";
		while($row=mysqli_fetch_row($rs))
		{
			if($sel == $row[0])
				$ret.="\t<option value='".$row[0]."' selected >".$row[0]."</option>\n";
			else
				$ret.="\t<option value='".$row[0]."' >".$row[0]."</option>\n";
		}
		$ret.="</select>";
		return $ret;
	}
     function phoneName($pk,$sql,$sel="")
	{
		$rs=mysqli_query($GLOBALS['db'],$sql);
		$ret="<select id='".$pk."' name='".$pk."'>\n";
		while($row=mysqli_fetch_row($rs))
		{
			if($sel == $row[0])
				$ret.="\t<option value='".$row[0]."' selected >".$row[1]."</option>\n";
			else
				$ret.="\t<option value='".$row[0]."' >".$row[1]."</option>\n";
		}
		$ret.="</select>";
		return $ret;
	}
	function SEEDATA($sql)
	{
		$db =  $GLOBALS['db'];
		$rs = mysqli_query($db,$sql);
		$column = mysqli_field_count($db);
		$result = "<table class='tbl' border='1px solid'>\n";
		$result .= "\t<tr>";
		while($colName = mysqli_fetch_field($rs))
		{
			$result .= "\t<th>".$colName->name."</th>";
			}
		$result .= "\t</tr>\n";
		while($row = mysqli_fetch_row($rs))
		{
			$result .= "\t<tr>";
			for($i = 0; $i < $column; $i++)
			{
				$result .= "<td>".$row[$i]."</td>";	
				}
			$result .= "\t</tr>\n";
			}
		$result .= "</table>\n";
		return $result;	
		}

	function showPhone($sql )
	{
		$db =  $GLOBALS['db'];
		$rs = mysqli_query($db,$sql);
		$row = mysqli_fetch_row($rs);
		$column = mysqli_field_count($db);
		$result = "<table class='tbl' border='1px solid'>\n";
		while($row = mysqli_fetch_row($rs)){
				$result .= "<tr>
						<tr><td>".$row[1]."</td></tr>
						<tr><td>".$row[3]."</td></tr>
						<tr><td>".$row[4]."</td></tr>
						<tr><td>".$row[5]."</td></tr>
					</tr>";
		}
		$result .= "</table>\n";
		return $result;	
		}
?>