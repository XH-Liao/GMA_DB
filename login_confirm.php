<?php
require('dbconnect.php');

session_start();
//Check：若已登入，跳轉回首頁
if(isset($_SESSION['login_account'])){
    header('Location: ./');
    exit();
}

// 必填未填 => 返回
if (!isset($_POST["帳號"]) || !isset($_POST["密碼"])) {
    echo "<script type='text/javascript'> alert('所有欄位皆為必填!'); </script>";
    echo "<script> history.back(); </script>";
    exit;
}
// 接收POST參數
$account = $_POST['帳號'];
$pwd = $_POST['密碼'];

// 查詢帳號是否存在
$SQL = "SELECT *
        FROM account
        WHERE 帳號='$account'";
$result = mysqli_query($link, $SQL);
if (mysqli_num_rows($result) <= 0) {                //帳號不存在 => 返回
    echo "<script type='text/javascript'> alert('帳號不存在!'); </script>";
    echo "<script> history.back(); </script>";
    exit;
} else {                                            // 帳號存在 => Check 密碼  
    $row = mysqli_fetch_assoc($result);
    if (!password_verify($pwd, $row["密碼"])) {    //密碼錯誤 => 返回
        echo "<script type='text/javascript'> alert('密碼錯誤!'); </script>";
        echo "<script> history.back(); </script>";
        exit;
    }else{                                          // 密碼正確 => 前往首頁
        $_SESSION["login_account"] = $account;
        echo "<meta http-equiv='Refresh'; content='0; url=./'/>";
    }
}
