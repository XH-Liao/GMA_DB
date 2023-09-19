<?php
require_once("dbconnect.php");

session_start();
// 權限控制：需登入
if(!isset($_SESSION["login_account"])){
    header("Location: ./");
    exit;
}

// 接收POST，皆為必填
if(!isset($_POST["標題"]) || !isset($_POST["內容"]) || !isset($_POST["from"])){
    echo "<script type='text/javascript'> alert('所有欄位皆為必填!'); </script>";
    echo "<script> history.back(); </script>";
    exit;
}

if($_POST["標題"]=="金曲獎"){
    $image = '';
}
else if(!isset($_POST["圖片url"])){
    echo "<script type='text/javascript'> alert('所有欄位皆為必填!'); </script>";
    echo "<script> history.back(); </script>";
    exit;
}
else{
    $image = $_POST["圖片url"];
}

$title = $_POST["標題"];
$content = $_POST["內容"];
$from = $_POST["from"];

// debug
//echo $title."<br>".$content."<br>".$image."<br>".$from; exit;

$SQL = "UPDATE title 
        SET 內容='$content', 圖片url='$image'
        WHERE 標題='$title'";
if(!mysqli_query($link, $SQL)){
    echo "<script type='text/javascript'> alert('更新資訊失敗!'); </script>";
    echo "<script> history.back(); </script>";
    exit;
}else{
    echo "<script type='text/javascript'> alert('更新資訊成功!'); </script>";
    if($title=="金曲獎"){
        echo "<meta http-equiv='Refresh' content='0; url=./'>";
    }else{
        if($from=="首頁"){
            echo "<meta http-equiv='Refresh' content='0; url=./'>";
        }else{
            echo "<meta http-equiv='Refresh' content='0; url=content.php?category=$title'>";
        }
    }
}
?>