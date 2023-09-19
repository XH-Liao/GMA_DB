<?php
require_once("dbconnect.php");

session_start();
// 權限控制：需登入
if(!isset($_SESSION["login_account"])){
    header("Location: ./");
    exit;
}

// 接收POST，皆為必填
if(!isset($_GET["category"])){
    echo "<script type='text/javascript'> alert('error!'); </script>";
    echo "<script> history.back(); </script>";
    exit;
}

$title = $_GET["category"];

// debug
//echo $title."<br>".$content."<br>".$image."<br>".$from; exit;

$SQL = "DELETE FROM title
        WHERE 標題='$title'";
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
        echo "<meta http-equiv='Refresh'; content='0; url=./'/>";
    }
}
?>