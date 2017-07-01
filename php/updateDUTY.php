<?
	## 呼叫mysql連線 設定詳參connMysql.php
	include("connMysqlO.php");
	
	## 每頁筆數
	$pageRow_records = 8;

	## 預設頁數
	$num_pages = 1;
	## 若有翻頁，則將頁數更新
	if (isset($_GET['page'])){
		$num_pages = $_GET['page'];
	}

	$startRow_records = ($num_pages -1) * $pageRow_records;
	## sql dql指令
	$sql_query = "select a.siteno,c.ssname,a.empno,b.ename from empsite a left join emp b on a.empno = b.empno left join session c on a.ssno=c.ssno order by a.siteno,c.ssno";
	
	$sql_query_limit = $sql_query." Limit {$startRow_records},{$pageRow_records}";
	## 執行dql指令將結果存進變數result中

	
	$result = $db_link->query($sql_query_limit);
	$all_result = $db_link->query($sql_query);
	$total_records = $all_result->num_rows;
	$total_pages = ceil($total_records/$pageRow_records);

?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>員工明細</title>
	    <style>
	    	<?php include ('main.css'); ?>
	    </style>
	</head>
	<body>
		<h1 align='center'>執勤配置表</h1>
		<p align='center' id='count'>目前資料筆數：<?php echo $total_records; ?> <a href='hospital.php'>回主畫面</a></p>
		<table border='1' align='center' id='table'>
			<!-- 表格表頭 -->
			<tr>
				<th>執勤區域</th>
				<th>執勤時段</th>
				<th>員工編號</th>
				<th>員工名稱</th>
				<th>功能</th>
			</tr>
			<!-- 表格內容 -->
			<?php
				while($row_result=$result->fetch_assoc()){
					echo '<tr>';
					echo '<td>'.$row_result['siteno'].'</td>';
					echo '<td>'.$row_result['ssname'].'</td>';
					echo '<td>'.$row_result['empno'].'</td>';
					echo '<td>'.$row_result['ename'].'</td>';
					## 超連結會對到相對目中的update & delete 且連過去時會把id一起帶過去
					echo "<td><a href='duty_update.php?id=".$row_result["empno"]."'>修改</a>";
					
					echo "</tr>";
				}
			?>
		</table>
		<table border="0" align="center">
			<tr>
				<?php if ($num_page>1){ ?>
					<td><a href='updateDUTY.php?page=1'>第一頁</a></td>
						<td><a href="updateDUTY.php?page=<?php echo $num_page-1;?>">上一頁</a></td>
				<?php }?>
				<?php if ($num_page<total_pages) { ?>
					<td><a href='updateDUTY.php?page=<?php echo $num_pages+1?>'>下一頁</a></td>
						<td><a href="updateDUTY.php?page=<?php echo $total_pages;?>">最後一頁</a></td>
				<?php }?>
			</tr>
		</table>
		<table border='0' align='center' id='count'>
			<tr>
				<td>
					頁數：
					<?php
						for($i=1;$i<=$total_pages;$i++){
							if($i==$num_pages){
								echo $i." ";
							}else{
								echo "<a href=\"updateDUTY.php?page={$i}\">{$i}</a>";
							}
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>