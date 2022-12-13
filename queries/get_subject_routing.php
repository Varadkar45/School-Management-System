<?php
include_once '../config/config.php';

$id=$_GET["id"];

$sql = "SELECT * FROM subject_routing WHERE id='$id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$res=array($row['grade_id'],$row['subject_id'],$row['teacher_id'],$row['fee']);
echo json_encode($res);

?>