<?php
include_once '../config/config.php';

$id=$_GET["id"];

$sql = "SELECT * FROM classroom WHERE id='$id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$res=array($row['name'],$row['student_count']);
echo json_encode($res);

?>