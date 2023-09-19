<?php
require_once("dbconnect.php");

session_start();
// 權限控制：需登入
if(!isset($_SESSION["login_account"])){
    header("Location: ./");
    exit;
}

if(!isset($_POST["密碼"])){
    echo "<script type='text/javascript'> alert('所有欄位皆為必填!'); </script>";
    echo "<script> history.back(); </script>";
    exit;
}

$account = $_SESSION["login_account"];
$pwd_hash = password_hash($_POST["密碼"], PASSWORD_DEFAULT);
$SQL = "UPDATE account
        SET 密碼='$pwd_hash'
        WHERE 帳號='$account'";
$result = mysqli_query($link, $SQL);
if (!$result) {
    echo "<script type='text/javascript'>alert('修改失敗!')</script>";
    echo "<script> history.back(); </script>";
} else {
    if (mysqli_affected_rows($link) < 1) {
        echo "<script type='text/javascript'>alert('修改失敗! (無此資料)')</script>";
        echo "<script> history.back(); </script>";
    } else {
        echo "<script type='text/javascript'>alert('修改成功!')</script>";
        echo "<meta http-equiv='Refresh'; content='0; url=./'/>";
    }
}
?>
