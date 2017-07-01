<?php 

	include("connMysqlO.php");
	## 第一個action是確定是否存在 第二個action是確定值是否為add
	if(isset($_POST["action"]) && ($_POST["action"] == "delete")) {

		$sql_query="Delete from emp where empno=?";
		$stmt = $db_link -> prepare($sql_query);
		$stmt -> bind_param('s',$_POST['cEmpno']);
		$stmt -> execute();
		$stmt -> close();
		$db_link -> close();

		header("Location: updateEMP.php");
	}

	## 取出來的欄位有幾個
	$sql_select = "select empno, ename from emp where empno = ?";
	$stmt = $db_link -> prepare($sql_select);
	$stmt -> bind_param('s',$_GET["id"]);
	$stmt -> execute();
	## 存進去的變數就有幾個 這裡的變數名稱將會套用到下方網頁的應用 以及資料時所用的變數
	$stmt -> bind_result($empno,$ename);
	echo $gender;
	$stmt -> fetch();


?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>護士管理系統</title>
	</head>
	<body>
		<h1 align='center'>護士管理系統-員工資料刪除</h1>
		<p align="center"><a href='updateEMP.php'>回員工明細</a></p>	
	<form action="" method='post' name='formDel' id='formDel'>
		<table border='1' align='center' cellpadding='4'>
				<tr>
					<th>欄位</th><th>資料</th>
				</tr>
				<tr>
					<td>姓名</td><td>
						<?php 
							echo $empno
						?>
					</td>
				</tr>
				<tr>
					<td>密碼</td><td>
						<?php 
							echo $ename
						?>
					</td>
				</tr>		
				<tr>
					<td colspan="2" align='center'>
						<input name='cEmpno' type="hidden" value="<?php echo $empno;?>">
						<input name="action" type="hidden" value="delete">
						<input type="submit" name="button" value="Sure?">
					</td>
				</tr>
		</table>
	</form>
	</body>
</html>
<?php
	$stmt -> close();
	$db_link -> close();
?>