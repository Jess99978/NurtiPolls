<!-- SESS 後臺登入 -->
<?php
session_start();
require_once "./connect.php";

if (!isset($_POST["account"])) {
    echo "請循正常管道進入";
    exit;
}

$account = $_POST["account"];
$password = $_POST["password"];
$repassword = $_POST["repassword"];
echo "$acccount,$password,$repassword";

if (empty($acccount)) {
    $_SESSION["error"]["message"] = "請輸入帳號";
    header("location:login-sess.php");
}

if (empty($password)) {
    $_SESSION["error"]["message"] = "請輸入密碼";
    header("location:login-sess.php");
}

if (empty($repassword)) {
    $_SESSION["error"]["message"] = "請輸入重複的密碼";
    header("location:login-sess.php");
}
if($password!=$repassword){
    $_SESSION["error"]["message"] = "輸入的密碼不一樣";
    header("location:login-sess.php");
}

$password = md5($password);
$sql="SELECT * FROM member account='$acccount' AND password='$password' AND valid=1";

$result=$conn->query($sql);
$userExit=$result->num_rows;

if($userExit==0){
    $_SESSION["error"]["message"]="帳號或密碼錯誤";
    if(isset($_SESSION["error"]["times"])){
        $_SESSION["error"]["times"]++;
        $times=$_SESSION["error"]["times"];
    }else{
        $times=1;
    }
    // 計算錯誤次數
    $times=$_SESSION["error"]["times"];
    header("location:");
}else{
    $row=
}