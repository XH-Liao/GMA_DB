<?php
$link = @mysqli_connect(
    'localhost',                // host
    'id20816540_peter020104linux',                     // username
    'W0s1x04linux!',                 // password
    'id20816540_linux_finalproject'        // 資料庫名稱
);


if(!$link){
    die('DB connect error!');
}

?>