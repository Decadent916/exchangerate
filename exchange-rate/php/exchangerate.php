<?php
header("Content-Type:text/html;charset utf-8");
$country=json_decode(file_get_contents('php://input'));
$countryid=$country->countryid;
$num=$country->num;
$pdo = new PDO('mysql:host=localhost;dbname=exchangerate','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("set names utf8");
$sql = "select rate from exchangerate;";
$stmt = $pdo->prepare($sql);
$isright = $stmt->execute();
$arr=array();
$resultarr=array();
if ($isright) {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
       array_push($arr, $result);
    }
    $pdo = null;
    $CNY = $num/$arr[$countryid]['rate'];
    array_push($resultarr, $CNY);
    $i=1;
    while($i<count($arr)){
    	$money = $CNY*$arr[$i]['rate'];
    	$i++;
    	array_push($resultarr, $money);
    };
    echo json_encode($resultarr);
}
?>