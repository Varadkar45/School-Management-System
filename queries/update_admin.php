<?php
if(isset($_POST["do"])&&($_POST["do"]=="update_admin")){
	
include_once './config/config.php';

$id = $_POST["id"];

$index_number = $_POST["index_number"];
$name = $_POST["name"];
$address = $_POST["address"];
$gender = $_POST["gender"];
$phone = $_POST["phone"];
$email = $_POST["email"];

$target_dir = "uploads/";
$image_name = $_FILES["image"]["name"];
$extention = strtolower(pathinfo($image_name,PATHINFO_EXTENSION)); 

$tmpname = $_FILES["image"]["tmp_name"];
$filename = date("Ymjhis");

$image_path =  $target_dir.$filename.".".$extention;
    // uploads/20200210011340.jpg

$sql1 = "SELECT * FROM admin WHERE id='$id'";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$current_email = $row1['email'];

$msg=0;

    if (!$image_name) {

        $sql = "UPDATE admin SET index_number='" . $index_number . "',name='" . $name . "',address='" . $address . "',gender='" . $gender . "',phone='" . $phone . "',email='" . $email . "' WHERE id='$id' ";
        
        if (mysqli_query($conn, $sql)) {

            if($email != $current_email){

				$sql2 = "update user set username='".$email."' where username='$current_email'";
				mysqli_query($conn,$sql2);
					
			}
			
            $msg += 1;

        } else {

            $msg += 2;

        }

    }else{
        if(move_uploaded_file($tmpname, $image_path)){

            $sql = "UPDATE admin SET index_number='" . $index_number . "',name='" . $name . "',address='" . $address . "',gender='" . $gender . "',phone='" . $phone . "',email='" . $email . "',image='" . $image_path . "' WHERE id='$id' ";

            if (mysqli_query($conn, $sql)) {

                if($email != $current_email){

                    $sql2 = "update user set username='".$email."' where username='$current_email'";
                    mysqli_query($conn,$sql2);
                        
                }
                
                $msg += 1;
                
            } else {
                $msg += 2;
            }

        }else{
            $msg += 3;
            //Sorry, there was an error uploading your file.
        }

    }


header("Location: admin_profile.php?do=alert_from_update&msg=$msg");

}
