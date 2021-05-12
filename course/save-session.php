<?php
session_start();
require_once("pdo-connect-project-db.php");

$stmt=$db_host->prepare("SELECT admin_account,admin_password FROM admin_list WHERE admin_account:admin_account AND admin_password:admin_password");
$stmt->execute();
while($row=$stmt->fetch()){
    $_SESSION["admin_account"]=$row["admin_account"];
    $_SESSION["admin_password"]=["admin_password"];

}
var_dump($_SESSION["admin_account"]);

?>