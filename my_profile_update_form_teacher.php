<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location: index.php');
    exit;
}
?>
<div class="card-header">
    <h3 class="card-title">User Details</h3>
</div>

<form action="index.php" method="POST" enctype="multipart/form-data" autocomplete="off">

    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <img id="profile_pic" style="width: 130px; height:130px;" class="img-circle">
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <div class="col-md-9">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td style="width: 30%">Index</td>
                            <td><input type="text" class="form-control" name="index_number" id="index_number"></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><input type="text" class="form-control" name="name" id="name"></td>
                        </tr>

                        <tr>
                            <td>Address</td>
                            <td><input type="text" class="form-control" name="address" id="address"></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td> 
                                <select name="gender" class="form-control" id="gender">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="text" class="form-control" name="email" id="email"> </td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><input type="text" class="form-control" name="phone" id="phone"> </td>
                        </tr>
                       
                    </tbody>
                </table>

            </div>

        </div>
        <p class="alert-primary" id="note1">Note: We get the email address for the user name.</p>
    </div>
    <!-- /.card-body -->

    <div class="card-footer text-right">
        <input type="hidden" id="id" name="id">
        <input type="hidden" name="do" value="update_teacher">
        <input type="hidden" name="user" value="Teacher">
        <button type="submit" class="btn btn-primary" id="btnUpdate">Update</button>
    </div>

</form>