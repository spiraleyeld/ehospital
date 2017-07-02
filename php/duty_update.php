<?php

	include("connMysqlO.php");
	## 第一個action是確定是否存在 第二個action是確定值是否為add
	## 下方這段是建立在，當網頁中某個動作被執行的時候，function才會啟動
	if(isset($_POST["action"]) && ($_POST["action"] == "update")) {

		$sql_query="update empsite set empno =? where siteno=? and ssno=?;";
		$stmt = $db_link -> prepare($sql_query);
		$stmt -> bind_param('sss',$_POST['cEmpno'],$_POST['cSiteno'],$_POST['cSsno']);
		$stmt -> execute();
		$stmt -> close();
		$db_link -> close();

		header("Location: updateDUTY.php");
	}
	## 此段是無論如何，都一定會執行的
	## 取出來的欄位有幾個
	##!!!!!!!!!!!!!!!!!!!!!
	$sql_select = "select  siteno, ssno, empno from empsite where empno = ? ";
	$stmt = $db_link -> prepare($sql_select);
	### 此處要以變數id接
	$stmt -> bind_param('s',$_GET["id"]);
	$stmt -> execute();
	## 存進去的變數就有幾個 這裡的變數名稱將會套用到下方網頁的應用 以及資料時所用的變數
	## 這裡的順序會與sql問句的順序一致
	$stmt -> bind_result($siteno,$ssno,$empno);
	echo $gender;
	## 將變數存進陣列中
	$stmt -> fetch();
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>會員管理系統</title>
		<style>
	    	<?php include ('main.css'); ?>
	    </style>
	</head>
	<body>
		<h1 align='center'>護士管理系統-員工修改</h1>
		<p align="center"><a href='updateEMP.php'>回員工明細</a></p>	
		<form action="" method="post" name="formFix" id="formFix">
			<table border='2' align='center' cellpading='4' id='table'>
				<tr>
					<th>欄位</th><th>資料</th>
				</tr>
				<tr>
					<td>執勤區域</td><td><input readonly='value' name="Siteno" id="cssSiteno" value="<?php echo $siteno;?>"></td>
		
				</tr>
					<td>執勤時段</td><td><input readonly='value' name="cSsno" id="cssSsno" value="<?php echo $ssno;?>"></td>
				<tr>
					<td>員工編號</td><td><input type="text" name="cEmpno" id="cEmpno" value="<?php echo $empno;?>"></td>
				</tr>			
				<tr>
					<td colspan="2" align='center'>
					
						<input name="action" type="hidden" value="update">
						<!-- 
						當此處執行submit動作後，form method post 就會啟動
						post 啟動後，腳本上方if段落中的post處理相關連帶方法
						也會一併啟動．
						 -->
						<input type="submit" name="button" value="更新資料">
						<input type="reset" name="button" value="重新填寫">
					</td>
				</tr>
		</form>
	</body>
</html>
<?php
	$stmt -> close();
	$db_link -> close();
?>
