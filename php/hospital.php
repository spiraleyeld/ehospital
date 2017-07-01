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
	$sql_query = "select * from onduty";
	
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

		<title>護士執勤輪班表</title>
	    <style>
	    	<?php include ('main.css'); ?>
	    </style>
	</head>
	<body>
		<h1 align='center'>護士執勤輪班狀態</h1>
		<p align='center' id='count'>目前資料筆數：<?php echo $total_records; ?>， 
		   <a href='updateEMP.php'>人員資料異動</a>
		   <a href='updateDUTY.php'>人員配置異動</a>
		</p>

		<table border='1' align='center' id='table'>
			<!-- 表格表頭 -->
			<tr>
				<th>執勤區域</th>

				<th>執勤人員</th>
				<th>起始時間</th>
				<th>結束時間</th>
				<th>執勤狀態</th>
			</tr>
			<!-- 表格內容 -->
			<?php
				while($row_result=$result->fetch_assoc()){
					echo '<tr>';
					echo '<td>'.$row_result['sname'].'</td>';

					echo '<td>'.$row_result['ename'].'</td>';
					echo '<td>'.$row_result['timestart'].'</td>';
					echo '<td>'.$row_result['timeend'].'</td>';
					if ($row_result['status'] == 'on_duty') {
						echo '<td id="pacman">'.'<img src="pacman.png">'.'</td>';
						##echo '<td id="pacman">'.'執勤中'.'</td>';
					}elseif ($row_result['status'] != 'on_duty'){
						echo '<td>'.''.'</td>';
					}
				}
					
					##echo '<td align = center >'.$row_result['gender'].'</td>';
					##echo '<td align = center >'.$row_result['no'].'</td>';
					
					## 超連結會對到相對目中的update & delete 且連過去時會把id一起帶過去
					
					##echo "<td><a href='update.php?id=".$row_result["no"]."'>修改</a>";
					
					##echo "<a href='delete.php?id=".$row_result["no"]."'>刪除</a></td>";
					##echo "</tr>";
				
			?>
		</table>
		<table border="0" align="center">
			<tr>
				<?php if ($num_page>1){ ?>
					<td><a href='hospital.php?page=1'>第一頁</a></td>
						<td><a href="hospital.php?page=<?php echo $num_page-1;?>">上一頁</a></td>
				<?php }?>
				<?php if ($num_page<total_pages) { ?>
					<td><a href='hospital.php?page=<?php echo $num_pages+1?>'>下一頁</a></td>
						<td><a href="hospital.php?page=<?php echo $total_pages;?>">最後一頁</a></td>
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
								echo "<a href=\"hospital.php?page={$i}\">{$i}</a>";
							}
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>