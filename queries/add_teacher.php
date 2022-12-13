<?php
if(isset($_POST["do"])&&($_POST["do"]=="add_teacher")){
	
include_once './config/config.php';

$index_number = $_POST["index_number"];
$name = $_POST["name"];
$address = $_POST["address"];
$gender = $_POST["gender"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$current_date=date("Y-m-d");

$target_dir = "uploads/";
$image_name = $_FILES["image"]["name"];
$extention = strtolower(pathinfo($image_name,PATHINFO_EXTENSION)); 

$tmpname = $_FILES["image"]["tmp_name"];
$filename = date("Ymjhis");

$image_path =  $target_dir.$filename.".".$extention;
            // uploads/20200210011340.jpg

//;

$index_number1 = 0;
$email2 = '';

$sql1="SELECT * FROM teacher WHERE index_number='$index_number'";
$result1=mysqli_query($conn,$sql1);

if (mysqli_num_rows($result1) > 0) {

    $row1=mysqli_fetch_assoc($result1);
    $index_number1=$row1['index_number'];

}

$sql2="SELECT * FROM teacher WHERE email='$email'";
$result2=mysqli_query($conn,$sql2);

if (mysqli_num_rows($result2) > 0) {

    $row2=mysqli_fetch_assoc($result2);
    $email2=$row2['email'];

}


$msg=0;
$password = "12345";
$hash = password_hash($password, PASSWORD_DEFAULT);

if($index_number == $index_number1){
    //The index number is duplicated.
    $msg+=1;
    //$msg=$msg + 1
    //$msg = 0 + 1

    if($email == $email2){
        //Both index number and email duplicate. 
        $msg+=1;
        //$msg=$msg + 1
        //$msg = 1 + 1
    }

}else if($email == $email2){
    //The email address duplicates.
    $msg+=3;

}else{
    if(move_uploaded_file($tmpname, $image_path)){
        $sql="INSERT INTO teacher(index_number,name,address,gender,phone,email,image,reg_date)
              VALUES('".$index_number."','".$name."','".$address."','".$gender."','".$phone."','".$email."','".$image_path."','".$current_date."')";

        if(mysqli_query($conn,$sql)){
            //successfully insert the record
            $sql3="INSERT INTO user(username,password,type)
                   VALUES('".$email."','".$hash."','Teacher')";

            mysqli_query($conn,$sql3);

            $msg+=4;
        }else{
            //insert fail
            $msg+=5;
        }

    }else{
        //Sorry, there was an error uploading your file.
        $msg+=6;

    }

}


header("Location: teacher.php?do=alert_from_insert&msg=$msg");

}

?>