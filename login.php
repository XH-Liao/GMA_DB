<?php

session_start();
//Check：若已登入，跳轉回首頁
if (isset($_SESSION['login_account'])) {
    header('Location: ./');
    exit();
}

$title = "登入";
require("layout/head.php");
?>

<br>
<div class="container">
    <div class="row">
        <div class="col-md-2 col-lg-3"></div>
        <div class="col-md-8 col-lg-6">
            <form action="login_confirm.php" method="POST" id="login">
                <h1 style="font-family: Vivaldi;"><img src="images/GMA.ico" alt="" width="10%"> Login</h1>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">account</label>
                    <div class="col-sm-10">
                        <input type="text" name="帳號" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">password</label>
                    <div class="col-sm-10">
                        <input type="password" name="密碼" class="form-control" required>
                    </div>
                </div>
                <input type="submit" value="Login" class="form-control btn">
            </form>
        </div>
        <div class="col-md-2 col-lg-3"></div>
    </div>
</div>

<?php
require("layout/foot.php");
?>