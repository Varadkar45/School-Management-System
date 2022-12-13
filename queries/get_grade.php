<?php
include_once '../config/config.php';

$id=$_GET["id"];

$sql = "SELECT * FROM grade WHERE id='$id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$res=array($row['name'],$row['admission_fee'],$row['institute_fee']);
echo json_encode($res);

?>