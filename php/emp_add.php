<?php

	## 第一個action是確定是否存在 第二個action是確定值是否為add
	if(isset($_POST["action"]) && ($_POST["action"] == "add")) {
		include("connMysqlO.php");
		$sql_query="Insert into emp values(?,?)";
		$stmt = $db_link -> prepare($sql_query);
		$stmt -> bind_param('ss',$_POST['cEmpno'],$_POST['cEname']);
		$stmt -> execute();
		$stmt -> close();
		$db_link -> close();

		header("Location: updateEMP.php");
	}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>護士管理系統</title>
	    <style>
	    	<?php include ('main.css'); ?>
	    </style>
	</head>
	<body>
		<h1 align='center'>護士管理系統-員工新增</h1>
		<p align="center"><a href='updateEMP.php'>回員工明細</a></p>		
		<form action="" method="post" name="formAdd" id="formAdd">
			<table border='1' align='center' celloadding='4' id='table'>
				<tr>
					<th>欄位</th><th>資料</th>
				</tr>
				<tr>
					<td>員工編號</td><td><input type="text" name="cEmpno" id="cEmpno"></td>
				</tr>
				<tr>
					<td>員工名字</td><td><input type="text" name="cEname" id="cEname"</td>
				</tr>		

				<tr>
					<td colspan="2" align='center'>
						<input name="action" type="hidden" value="add">
						<input type="submit" name="button" value="新增資料">
						<input type="reset" name="button" value="重新填寫">
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>