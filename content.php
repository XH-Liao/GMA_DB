<?php
session_start();

// 接收GET參數
if (!isset($_GET["category"])) {
	echo "<script type='text/javascript'> alert('error!'); </script>";
	echo "<meta http-equiv='Refresh'; content='0; url=../'/>";
	exit;
}

$title = $_GET["category"];
require_once("layout/head.php");
require_once("dbconnect.php");

$SQL = "SELECT *
		FROM title
		WHERE 標題='$title'";

$result = mysqli_query($link, $SQL);
$row = mysqli_fetch_assoc($result);
?>

<div class="container">
	<h4 style="color:#cc9900;" id="title">
		<?php echo $title;
		// 權限控制：需登入
		if (isset($_SESSION["login_account"])) {
			print <<< EOT
			<a href="#" data-bs-toggle="modal" data-bs-target="#modal_title" style="float: right;">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
					<path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
				</svg>
			</a>
EOT;
		}
		?>
	</h4>
	<hr style="height: 2px;border-width: 0;color:#e6e6e6;background-color:#e6e6e6 ;">
	<p style="color:silver;text-indent: 30px;"><?php echo $row["內容"]; ?></p>
</div>

<?php
// 權限控制：需登入
if (isset($_SESSION["login_account"])) {
	print <<< EOT
	<!--edit title-->
<div class="modal fade" id="modal_title" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="top">修改內容</h3>
				<a href="title_delete.php?category={$row['標題']}" id="card_delete" onclick='return confirm("warning: 該獎項內所有的名單將一併刪除\\n確認刪除資料？")'>
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
									<path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
								</svg>
								刪除
							</a>
			</div>
			<div class="modal-body">
				<form action="title_update.php" method="POST">
					<input type="hidden" name="from" class="form-control" value="content">
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">標題</label>
						<div class="col-sm-9">
							<label class="col-form-label">{$row["標題"]}</label>
							<input type="hidden" name="標題" class="form-control" value="{$row["標題"]}">
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">圖片url</label>
						<div class="col-sm-9">
							<textarea type="text" name="圖片url" class="form-control" required rows="5">{$row['圖片url']}</textarea>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">內容</label>
						<div class="col-sm-9">
							<textarea type="text" name="內容" class="form-control" required rows="10">{$row['內容']}</textarea>
						</div>
					</div>
					<div class="mb-3 row" style="text-align: center;">
						<div class="col-1"></div>
						<div class="col-10">
							<button type="button" class="btn btn-secondary col-5" data-bs-dismiss="modal">取消</button>
							<input type="submit" value="確認修改" class="btn btn-primary col-5">
						</div>
						<div class="col-1"></div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!--Modal 新增名單-->
<div class="modal fade" id="modal_cards" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="top">新增名單 - $title</h3>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<form action="insert.php" method="POST">
					<input type="hidden" name="獎項" class="form-control" value="$title">
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">屆數</label>
						<div class="col-sm-9">
							<input type="number" name="屆數" class="form-control">
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">得獎者</label>
						<div class="col-sm-9">
							<input type="text" name="得獎者" class="form-control">
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">圖片url</label>
						<div class="col-sm-9">
							<textarea type="text" name="圖片" class="form-control" required rows="5"></textarea>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">嵌入Spotify-src</label>
						<div class="col-sm-9">
							<textarea type="text" name="Spotify" class="form-control" required rows="5"></textarea>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">維基百科url</label>
						<div class="col-sm-9">
							<textarea type="text" name="Wikipedia" class="form-control" required rows="5"></textarea>
						</div>
					</div>
					<div class="mb-3 row" style="text-align: center;">
						<div class="col-1"></div>
						<div class="col-10">
							<button type="button" class="btn btn-secondary col-5" data-bs-dismiss="modal">取消</button>
							<input type="submit" value="確認新增" class="btn btn-primary col-5">
						</div>
						<div class="col-1"></div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
EOT;
}
?>


<div class="container" id="content">
	<h4 style="color:#cc9900; display:inline;">得獎名單</h4>
	<?php
	// 權限控制：需登入
	if (isset($_SESSION["login_account"])) {
		print <<< EOT
		<a href="#" class="btn btn-outline-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#modal_cards">新增名單</a>
EOT;
	}
	?>
	<hr style="height: 2px;border-width: 0;color:#e6e6e6;background-color:#e6e6e6 ;">
	<!--列出所有名單-->
	<?php
	$SQL = "SELECT *
			FROM content
			WHERE 獎項='$title'
			ORDER BY 屆數 DESC";
	$result = mysqli_query($link, $SQL);

	echo "<div class='row'>";
	$count = 0;
	while ($row = mysqli_fetch_assoc($result)) {
		print <<< EOT
			<div class="card col-lg-3 col-sm-6 col-12" style="background:black;">
				<div class="card-body">
EOT;
		// 權限控制：需登入
		if (isset($_SESSION["login_account"])) {
			print <<< EOT
				<!--edit/delete modal連結-->
				<a href="#" data-bs-toggle="modal" data-bs-target="#modal_cards_edit_{$row['屆數']}" style="float: right;"  >
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
						<path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
					</svg>
				</a>
EOT;
		}
		print <<< EOT
				<!--得獎者-->
				<h5 class="card-title">	<a href="{$row['維基百科url']}">第{$row['屆數']}屆 - {$row['得獎者']}</a></h5>
				</div>
				<div class="headshot">
					<!--圖片-->
EOT;
		if (stripos($title, "歌手")) {
			echo "<a href='{$row['維基百科url']}'><img src='{$row['圖片url']}' alt='' class='card-img-top rounded-pill'></a>";
		} else {
			echo "<a href='{$row['維基百科url']}'><img src='{$row['圖片url']}' alt='' class='card-img-top'></a>";
		}

		echo "<!--Spotify-->";
		if (stripos($title, "專輯") || stripos($title, "歌手")) {
			echo "<iframe src='{$row['spotify_code']}' width='100%' height='180' frameBorder='0' allowfullscreen='' allow='autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture'></iframe>";
		} else {
			echo "<iframe src='{$row['spotify_code']}' width='100%' height='80' frameBorder='0' allowfullscreen='' allow='autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture'></iframe>";
		}
		echo "</div></div>";
		// Modal 編輯/刪除名單
		if (isset($_SESSION["login_account"])) {
			print <<< EOT
			<!--Modal 編輯/刪除名單-->
			<div class="modal fade" id="modal_cards_edit_{$row['屆數']}" tabindex="-1">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h3 class="modal-title" id="top">修改名單</h3>
							<a href="delete.php?獎項=$title&number={$row['屆數']}" id="card_delete" onclick='return confirm("確認刪除資料？")'>
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
									<path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
								</svg>
								刪除
							</a>
						</div>
						<div class="modal-body">
							<form action="update.php?number={$row['屆數']}" method="POST">
								<input type="hidden" name="獎項" class="form-control" value="$title">
								<div class="mb-3 row">
									<label class="col-sm-3 col-form-label">屆數</label>
									<div class="col-sm-9">
										<input type="hidden" name="屆數" class="form-control" value="{$row['屆數']}">
										<label class="col-sm-3 col-form-label">{$row['屆數']}</label>
									</div>
								</div>
								<div class="mb-3 row">
									<label class="col-sm-3 col-form-label">得獎者</label>
									<div class="col-sm-9">
										<input type="text" name="得獎者" class="form-control" value="{$row['得獎者']}">
									</div>
								</div>
								<div class="mb-3 row">
									<label class="col-sm-3 col-form-label">圖片url</label>
									<div class="col-sm-9">
										<textarea type="text" name="圖片" class="form-control" required rows="5">{$row['圖片url']}</textarea>
									</div>
								</div>
								<div class="mb-3 row">
									<label class="col-sm-3 col-form-label">嵌入Spotify-src</label>
									<div class="col-sm-9">
										<textarea type="text" name="Spotify" class="form-control" required rows="5">{$row['spotify_code']}</textarea>
									</div>
								</div>
								<div class="mb-3 row">
									<label class="col-sm-3 col-form-label">維基百科url</label>
									<div class="col-sm-9">
										<textarea type="text" name="Wikipedia" class="form-control" required rows="5">{$row['維基百科url']}</textarea>
									</div>
								</div>
								<div class="mb-3 row" style="text-align: center;">
									<div class="col-1"></div>
									<div class="col-10">
										<button type="button" class="btn btn-secondary col-5" data-bs-dismiss="modal">取消</button>
										<input type="submit" value="確認修改" class="btn btn-primary col-5">
									</div>
									<div class="col-1"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
EOT;
		}

		$count += 1;
		if ($count == 4) {
			echo "</div>";
			echo "<div class='row'>";
		}
	}
	echo "</div>";
	?>
</div>

<?php
require_once("layout/foot.php");
?>