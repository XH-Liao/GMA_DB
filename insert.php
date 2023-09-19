<?php
require_once("dbconnect.php");

session_start();
// 權限控制：需登入
if(!isset($_SESSION["login_account"])){
    header("Location: ./");
    exit;
}

// 接收POST，皆為必填
if(!isset($_POST["獎項"]) || !isset($_POST["屆數"]) || !isset($_POST["得獎者"]) || !isset($_POST["圖片"]) || !isset($_POST["Spotify"]) || !isset($_POST["Wikipedia"])){
    echo "<script type='text/javascript'> alert('所有欄位皆為必填!'); </script>";
    echo "<script> history.back(); </script>";
    exit;
}
$category = $_POST["獎項"];
$number = $_POST["屆數"];
$win = $_POST["得獎者"];
$image = $_POST["圖片"];
$spotify = $_POST["Spotify"];
$wiki = $_POST["Wikipedia"];

// 新增INSERT
$SQL = "INSERT INTO content(獎項, 屆數, 得獎者, 圖片url, spotify_code, 維基百科url) VALUES ('$category', '$number', '$win', '$image', '$spotify', '$wiki')";
if(!mysqli_query($link, $SQL)){
    echo "<script type='text/javascript'> alert('新增名單失敗!'); </script>";
    echo "<script> history.back(); </script>";
    exit;
}else{
    echo "<script type='text/javascript'> alert('新增名單成功!'); </script>";
    echo "<meta http-equiv='Refresh' content='0; url=content.php?category=$category'>";
}
?>