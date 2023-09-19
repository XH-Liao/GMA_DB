<?php
session_start();
// 權限控制：admin
if(!isset($_SESSION["login_account"]) || $_SESSION["login_account"] != "admin"){
    header("Location: ./");
    exit;
}

//必須有GET參數number
if(!isset($_GET["account"]) || $_GET["account"] == "admin"){
    echo "<script type='text/javascript'> alert('error!'); </script>";
    echo "<script> history.back(); </script>";
    exit;
}

//刪除帳號
require('dbconnect.php');
$SQL = "DELETE FROM account
        WHERE 帳號='{$_GET["account"]}'";
$result = mysqli_query($link, $SQL);
if (!$result) {
    echo "<script type='text/javascript'>alert('刪除失敗!')</script>";
    echo "<script> history.back(); </script>";
} else {
    if (mysqli_affected_rows($link) < 1) {
        echo "<script type='text/javascript'>alert('刪除失敗! (無此資料)')</script>";
        echo "<script> history.back(); </script>";
    } else {
        echo "<script type='text/javascript'>alert('刪除成功!')</script>";
        echo "<meta http-equiv='Refresh'; content='0; url=account_manage.php'/>";
    }
}
?>