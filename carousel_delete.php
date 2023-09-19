<?php
session_start();
// 權限控制：需登入
if(!isset($_SESSION["login_account"])){
    header("Location: ./");
    exit;
}

//必須有GET參數number
if(!isset($_GET["id"])){
    echo "<script type='text/javascript'> alert('error!'); </script>";
    echo "<script> history.back(); </script>";
    exit;
}

//刪除帳號
require('dbconnect.php');
$SQL = "DELETE FROM carousel
        WHERE ID='{$_GET["id"]}'";
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
        echo "<meta http-equiv='Refresh'; content='0; url=carousel.php'/>";
    }
}
?>