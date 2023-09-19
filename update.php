<?php
require_once("dbconnect.php");

session_start();
// 權限控制：需登入
if(!isset($_SESSION["login_account"])){
    header("Location: ./");
    exit;
}

// 接收POST參數，皆為必填
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

// debug
//echo $category."<br>".$number."<br>".$win."<br>".$image."<br>".$spotify."<br>".$wiki;
//exit;

// 修改UPDATE
$SQL = "UPDATE content
        SET 得獎者='$win', 圖片url='$image', spotify_code='$spotify', 維基百科url='$wiki'
        WHERE 獎項='$category' AND 屆數=$number";
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
        echo "<meta http-equiv='Refresh'; content='0; url=content.php?category=$category'/>";
    }
}
?>