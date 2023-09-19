<?php

session_start();
// 權限控制：admin
if (!isset($_SESSION["login_account"]) || $_SESSION["login_account"] != "admin") {
    header("Location: ./");
    exit;
}

$title = "註冊";
require("layout/head.php");
?>

<br>
<div class="container">
    <div class="row">
        <div class="col-md-2 col-lg-3"></div>
        <div class="col-md-8 col-lg-6">
            <form action="register_confirm.php" method="POST" id="login">
                <h1 style="font-family: Vivaldi;"><img src="images/GMA.ico" alt="" width="10%"> Register</h1>
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
                <input type="submit" value="Register" class="form-control btn">
            </form>
        </div>
        <div class="col-md-2 col-lg-3"></div>
    </div>
</div>
<?php
require("layout/foot.php");
?>