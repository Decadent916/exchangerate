<?php
header("Content-Type:text/html;charset utf-8");
$rates=json_decode(file_get_contents('php://input'));
$rate1=$rates->rate1;
$rate2=$rates->rate2;
$rate3=$rates->rate3;
$pdo = new PDO('mysql:host=localhost;dbname=exchangerate','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("set names utf8");
$rates_order = array(
1=>$rate1,
2=>$rate2,
3=>$rate3
);
$ids = implode(',', array_keys($rates_order));
$sql = "UPDATE exchangerate SET rate = CASE countryID ";
foreach ($rates_order as $id => $ordinal) {
    $sql .= sprintf("WHEN %d THEN %f ", $id, $ordinal);
}
$sql .= "END WHERE countryID IN ($ids);";
$stmt = $pdo->prepare($sql);
$isright = $stmt->execute();
if ($isright) {
    $pdo = null;
    $data=array('result'=>'true');
    echo json_encode($data);
}
?>