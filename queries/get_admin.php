<?php
include_once '../config/config.php';

$id=$_GET["id"];

$sql = "SELECT * FROM admin WHERE id='$id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$res=array($row['index_number'],$row['name'],$row['address'],$row['gender'],$row['phone'],$row['email'],$row['image']);
echo json_encode($res);

?>