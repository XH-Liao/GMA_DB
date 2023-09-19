<?php
require('dbconnect.php');

session_start();
// 權限控制：admin
if(!isset($_SESSION["login_account"]) || $_SESSION["login_account"] != "admin"){
    header("Location: ./");
    exit;
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
$pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);

// debug
//echo $account."<br>".$pwd; exit;

//註冊
$SQL = "SELECT * 
        FROM account
        WHERE 帳號='$account'";
$result = mysqli_query($link, $SQL);
if (mysqli_num_rows($result) > 0) {             // 帳號重複 => 返回
    echo "<script type='text/javascript'> alert('請勿重複註冊，此帳號已存在!'); </script>";
    echo "<script> history.back(); </script>";
    exit;
}

$SQL = "INSERT INTO account(帳號, 密碼) VALUES ('$account', '$pwd_hash')";
if (!mysqli_query($link, $SQL)) {           // 註冊error => 返回
    echo "<script type='text/javascript'> alert('註冊error!'); </script>";
    echo "<script> history.back(); </script>";
    exit;
}

// 註冊成功 => 返回
echo "<script type='text/javascript'> alert('註冊成功!'); </script>";
echo "<meta http-equiv='Refresh' content='0; url=login.php'>";
