<?php
include_once '../config/config.php';

$id=$_GET["id"];

$sql = "SELECT * FROM student_subject WHERE student_id='$id'";
$result=mysqli_query($conn,$sql);

$res=array();

while($row=mysqli_fetch_assoc($result)){

    array_push($res,$row['sr_id']);
   
}


echo json_encode($res);

?>