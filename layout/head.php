<?php
if (session_status() != PHP_SESSION_ACTIVE)
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title; ?> - GMA</title>
	<link rel="icon" href="images/GMA.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="images/GMA.ico" type="image/x-icon" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body style="background:black;">
	<nav class="navbar navbar-expand-sm bg-black navbar-dark" id="navbar">
		<div class="container">
			<a href="./" class="navbar-brand" style="color:#cc9900 ;font-size:30px ;font-family: Vivaldi;"><img src="images\GMA.png" width="80px" height="80px"> GMA</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar1"><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id=navbar1>
				<div class="dropdown">
					<ul class="navbar-nav">
						<li class="nav-item active"><a href="./#content" class="nav-link" style="color:#cc9900 ;">首頁 / 切換獎項</a></li>
						<li class="nav-item active"><a href="#title" class="nav-link" style="color:#cc9900 ;">內容介紹</a></li>
						<li class="nav-item"><a href="#content" class="nav-link" style="color:#cc9900 ;">查看名單</a></li>
						<?php
					    if (isset($_SESSION["login_account"])){
					        print <<<EOT
					        <li class="nav-item"><a href="carousel.php" class="nav-link" style="color:#cc9900 ;">輪播管理</a></li
EOT;
					    }
					    ?>
						>
					</ul>
				</div>
			</div>
			<div class="collapse navbar-collapse justify-content-end" id=navbar1>
				<ul class="navbar-nav">
					<?php
					if (isset($_SESSION["login_account"])) {
						print <<<EOT
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link active dropdown-toggle" role="button" data-bs-toggle="dropdown" style="color:#cc9900;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                </svg>
                                {$_SESSION['login_account']}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark"> <!-- dropdown-menu-right -->
EOT;
							if ($_SESSION["login_account"] == "admin") {
								print <<< EOT
								<li>
                                    <a href="account_manage.php" class="dropdown-item">
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
											<path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
											<path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
										</svg>
                                        帳號管理
                                    </a>
                                </li>
EOT;
							}
							print <<< EOT
                                <li>
                                    <a href="password_update.php" class="dropdown-item">
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
											<path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
											<path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
										</svg>
                                        修改密碼
                                    </a>
                                </li>
                                <li>
                                    <a href="logout.php" class="dropdown-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                        </svg>
                                        登出
                                    </a>
                                </li>
                            </ul>
                        </li>
EOT;
					} else {
						// 未登入 => 顯示登入
						print <<< EOT
						<li class="nav-item">
							<a href="login.php" class="nav-link" style="color:#cc9900;">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
									<path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
									<path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
								</svg> Login
							</a>
						</li>
EOT;
					}
					?>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
			<div class="carousel-inner">
				<?php
				require_once("dbconnect.php");
				$SQL = "SELECT * FROM carousel";
				$result = mysqli_query($link, $SQL);
				if($row = mysqli_fetch_assoc($result)){
					print <<< EOT
					<div class="carousel-item active">
						<img class="pc" src="{$row["圖片url"]}" class="d-block w-100" alt="輪播">
						<img class="mobile" src="{$row["圖片url"]}" class="d-block w-100" alt="輪播">
					</div>
EOT;
				}
				while($row = mysqli_fetch_assoc($result)){
					print <<< EOT
					<div class="carousel-item">
						<img class="pc" src="{$row["圖片url"]}" class="d-block w-100" alt="輪播">
						<img class="mobile" src="{$row["圖片url"]}" class="d-block w-100" alt="輪播">
					</div>
EOT;
				}
				
				?>
			</div>
			<a href="#myCarousel" class="carousel-control-prev" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span></a>
			<a href="#myCarousel" class="carousel-control-next" data-bs-slide="next"><span class="carousel-control-next-icon"><span class="visually-hidden">Next</span></span></a>
		</div>
	</div>
	<br>