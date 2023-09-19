<?php
session_start();
// 權限控制：需登入
if (!isset($_SESSION["login_account"])) {
    header("Location: ./");
    exit;
}

$title = "輪播管理";
require_once("layout/head.php");
require_once("dbconnect.php");
?>

<div class="container">
    <h4 style="display:inline;">輪播管理 </h4>
    <a href="#" class="btn btn-outline-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#modal_cards">新增圖片</a>

    <hr style="height: 2px;border-width: 0;color:#e6e6e6;background-color:#e6e6e6 ;">
    <div class="row">
        <?php
        $SQL = "SELECT * FROM carousel";
        $result = mysqli_query($link, $SQL);
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            //echo "<a href='carousel_delete.php'><img src='{$row["圖片url"]}' alt='' style='width: 30%'></a>";

            print <<< EOT
        <div class="card col-lg-3 col-sm-6 col-12" style="background:black;">
            <div class="headshot">
                <a href="carousel_delete.php?ID={$row['ID']}"><img src="{$row["圖片url"]}" alt="" class="card-img-top"></a>
            </div>
            <div class="card-body">
                <p class="card-title">
                    <a href="carousel_delete.php?id={$row['ID']}" id="card_delete" onclick='return confirm("warning: 確認刪除圖片？")'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                        </svg>
                        刪除
                    </a>
                </h5>
            </div>
           
        </div>
EOT;

            $count++;
            if ($count >= 4) {
                $count = 0;
                echo "</div><div class='row'>";
            }
        }
        ?>
    </div>
</div>
<!--Modal 新增名單-->
<div class="modal fade" id="modal_cards" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="top">新增圖片</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="carousel_insert.php" method="POST">
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">圖片url</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="圖片url" class="form-control" required rows="5"></textarea>
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


<?php
require_once("layout/foot.php")
?>