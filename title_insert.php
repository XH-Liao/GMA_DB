<?php
require_once("dbconnect.php");

session_start();
// 權限控制：需登入
if(!isset($_SESSION["login_account"])){
    header("Location: ./");
    exit;
}

// 接收POST，皆為必填
if(!isset($_POST["標題"]) || !isset($_POST["內容"]) || !isset($_POST["圖片url"])){
    echo "<script type='text/javascript'> alert('所有欄位皆為必填!'); </script>";
    echo "<script> history.back(); </script>";
    exit;
}

$title = $_POST["標題"];
$content = $_POST["內容"];
$image = $_POST["圖片url"];


// debug
//echo $title."<br>".$content."<br>".$image."<br>".$from; exit;

$SQL = "INSERT INTO title (標題, 內容, 圖片url) VALUES ('$title', '$content', '$image')";
if(!mysqli_query($link, $SQL)){
    echo "<script type='text/javascript'> alert('新增獎項失敗!'); </script>";
    echo "<script> history.back(); </script>";
    exit;
}else{
    echo "<script type='text/javascript'> alert('新增獎項成功!'); </script>";
    echo "<meta http-equiv='Refresh' content='0; url=./'>";
}
?>