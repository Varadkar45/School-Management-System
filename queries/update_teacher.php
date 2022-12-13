<?php
if(isset($_POST["do"])&&($_POST["do"]=="update_teacher")){
	
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

    $index_number1 = 0;
    $id1 = 0;
    $email2 = '';
    $id2 = 0;

    $sql1="SELECT * FROM teacher WHERE index_number='$index_number'";
    $result1=mysqli_query($conn,$sql1);

    if (mysqli_num_rows($result1) > 0) {

        $row1=mysqli_fetch_assoc($result1);
        $index_number1=$row1['index_number'];
        $id1=$row1['id'];

    }

    $sql2="SELECT * FROM teacher WHERE email='$email'";
    $result2=mysqli_query($conn,$sql2);

    if (mysqli_num_rows($result2) > 0) {

        $row2=mysqli_fetch_assoc($result2);
        $email2=$row2['email'];
        $id2=$row2['id'];

    }

    $sql3="SELECT * FROM teacher WHERE id='$id'";
    $result3=mysqli_query($conn,$sql3);
    $row3=mysqli_fetch_assoc($result3);
    $current_email=$row3['email'];

    $msg=0;

    if($id == $id1){
        //index number not duplicate.
        if($id == $id2){
            //index number and email not duplicate. we can update the record. 

            if(!$image_name){

                $sql = "UPDATE teacher SET index_number='".$index_number."',name='".$name."',address='".$address."',gender='".$gender."',phone='".$phone."',email='".$email."' WHERE id='$id' ";
                
                if(mysqli_query($conn,$sql)){
                    
                    if($email != $current_email){

                        $sql4 = "update user set username='".$email."' where username='$current_email'";
                        mysqli_query($conn,$sql4);
                            
                    }
                    
                    $msg += 1;
                }else{
                    $msg+=2;
                }

            }else{
                if(move_uploaded_file($tmpname, $image_path)){

                    $sql = "UPDATE teacher SET index_number='" . $index_number . "',name='" . $name . "',address='" . $address . "',gender='" . $gender . "',phone='" . $phone . "',email='" . $email . "',image='" . $image_path . "' WHERE id='$id' ";

                    if (mysqli_query($conn, $sql)) {
                        if($email != $current_email){

                            $sql4 = "update user set username='".$email."' where username='$current_email'";
                            mysqli_query($conn,$sql4);
                                
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
        }else{
            if($email == $email2){
                //email duplicate.
                $msg+=4;
            }else{
                //we can update the record.
                if(!$image_name){

                    $sql = "UPDATE teacher SET index_number='".$index_number."',name='".$name."',address='".$address."',gender='".$gender."',phone='".$phone."',email='".$email."' WHERE id='$id' ";
                    
                    if(mysqli_query($conn,$sql)){
                        if($email != $current_email){

                            $sql4 = "update user set username='".$email."' where username='$current_email'";
                            mysqli_query($conn,$sql4);
                                
                        }
                        
                        $msg += 1;
                    }else{
                        $msg+=2;
                    }
        
                }else{
                    if(move_uploaded_file($tmpname, $image_path)){
        
                            $sql = "UPDATE teacher SET index_number='" . $index_number . "',name='" . $name . "',address='" . $address . "',gender='" . $gender . "',phone='" . $phone . "',email='" . $email . "',image='" . $image_path . "' WHERE id='$id' ";
        
                            if (mysqli_query($conn, $sql)) {
                                if($email != $current_email){

                                    $sql4 = "update user set username='".$email."' where username='$current_email'";
                                    mysqli_query($conn,$sql4);
                                        
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
            }
        }
    }else if($id == $id2){
        //email address not duplicate.
        if($index_number == $index_number1){
            //index number duplicate
            $msg+=5;
        }else{
            //we can update the record.
            if(!$image_name){

                $sql = "UPDATE teacher SET index_number='".$index_number."',name='".$name."',address='".$address."',gender='".$gender."',phone='".$phone."',email='".$email."' WHERE id='$id' ";
                
                if(mysqli_query($conn,$sql)){
                    if($email != $current_email){

                        $sql4 = "update user set username='".$email."' where username='$current_email'";
                        mysqli_query($conn,$sql4);
                            
                    }
                    
                    $msg += 1;
                }else{
                    $msg+=2;
                }

            }else{
                if(move_uploaded_file($tmpname, $image_path)){

                        $sql = "UPDATE teacher SET index_number='" . $index_number . "',name='" . $name . "',address='" . $address . "',gender='" . $gender . "',phone='" . $phone . "',email='" . $email . "',image='" . $image_path . "' WHERE id='$id' ";

                        if (mysqli_query($conn, $sql)) {
                            if($email != $current_email){

                                $sql4 = "update user set username='".$email."' where username='$current_email'";
                                mysqli_query($conn,$sql4);
                                    
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
        }

    }else{
        if($index_number == $index_number1){
            //index number duplicate
            $msg+=5;
        }else if($email == $email2){
            //email duplicate.
            $msg+=4;
        }else{
            //we can update the record.
            if(!$image_name){

                $sql = "UPDATE teacher SET index_number='".$index_number."',name='".$name."',address='".$address."',gender='".$gender."',phone='".$phone."',email='".$email."' WHERE id='$id' ";
                
                if(mysqli_query($conn,$sql)){
                    if($email != $current_email){

                        $sql4 = "update user set username='".$email."' where username='$current_email'";
                        mysqli_query($conn,$sql4);
                            
                    }
                    
                    $msg += 1;
                }else{
                    $msg+=2;
                }

            }else{
                if(move_uploaded_file($tmpname, $image_path)){

                        $sql = "UPDATE teacher SET index_number='" . $index_number . "',name='" . $name . "',address='" . $address . "',gender='" . $gender . "',phone='" . $phone . "',email='" . $email . "',image='" . $image_path . "' WHERE id='$id' ";

                        if (mysqli_query($conn, $sql)) {
                            if($email != $current_email){

                                $sql4 = "update user set username='".$email."' where username='$current_email'";
                                mysqli_query($conn,$sql4);
                                    
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
        }
    }


        if(isset($_POST["user"])&&($_POST["user"]=="Admin")){
            header("Location: all_teacher.php?do=alert_from_update&msg=$msg");
        }

        if(isset($_POST["user"])&&($_POST["user"]=="Teacher")){
            header("Location: teacher_profile.php?do=alert_from_update&msg=$msg");
        }




}

?>