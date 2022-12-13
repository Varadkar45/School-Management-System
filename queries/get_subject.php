<?php
include_once '../config/config.php';

$id=$_GET["id"];

$sql = "SELECT * FROM subject WHERE id='$id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$res=array($row['name']);
echo json_encode($res);

?>