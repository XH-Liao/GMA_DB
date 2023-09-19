<?php
require_once("dbconnect.php");

session_start();
// 權限控制：需登入
if(!isset($_SESSION["login_account"])){
    header("Location: ./");
    exit;
}

// 接收POST，皆為必填
if(!isset($_POST["圖片url"])){
    echo "<script type='text/javascript'> alert('所有欄位皆為必填!'); </script>";
    echo "<script> history.back(); </script>";
    exit;
}
$image = $_POST["圖片url"];

// 新增INSERT
$SQL = "INSERT INTO carousel(圖片url) VALUES ('$image')";
if(!mysqli_query($link, $SQL)){
    echo "<script type='text/javascript'> alert('新增名單失敗!'); </script>";
    echo "<script> history.back(); </script>";
    exit;
}else{
    echo "<script type='text/javascript'> alert('新增名單成功!'); </script>";
    echo "<meta http-equiv='Refresh' content='0; url=carousel.php'>";
}
?>