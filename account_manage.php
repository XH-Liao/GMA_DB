<?php
session_start();
// 權限控制：admin
if(!isset($_SESSION["login_account"]) || $_SESSION["login_account"] != "admin"){
    header("Location: ./");
    exit;
}

$title = "帳號管理";
require_once("layout/head.php");
require_once("dbconnect.php");


?>

<div class="container">
    <h4 style="color:#cc9900;" id="title">
        Account Management
        <a href="register.php" class="btn btn-outline-primary" style="float: right;">Register</a>
    </h4>
    <hr style="height: 2px;border-width: 0;color:#e6e6e6;background-color:#e6e6e6 ;">
    <br>
    <div class="row" style="color:silver;text-indent: 30px;">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <table class="table table-bordered" style="background:black;text-align: center;color:#e6e6e6;">
                <tr style="color: #cc9900;">
                    <th></th>
                    <th>Account</th>
                    <th></th>
                    <th></th>
                    <th>Account</th>
                </tr>
                <tr>
                    <?php
                    $SQL = "SELECT 帳號 FROM account WHERE 帳號!='admin'";
                    $result = mysqli_query($link, $SQL);
                    $count = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        print <<< EOT
                        <td>
                            <a href="account_delete.php?account={$row['帳號']}" id="card_delete" onclick='return confirm("Warning: 確認刪除此帳號？")'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg>
                                刪除
                            </a>
                        </td>
EOT;
                        echo "<td>".$row["帳號"]."</td>";
                        
                        if($count++ >=1){
                            $count = 0;
                            echo "</tr><tr>";
                        }else{
                            echo "<td></td>";
                        }
                    }
                    if($count++ >=1){
                        echo "<td></td><td></td>";
                    }
                    ?>
                </tr>
            </table>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>

<?php


require_once("layout/foot.php");
?>