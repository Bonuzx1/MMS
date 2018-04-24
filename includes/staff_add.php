<?php

$msg = "";

// save changes
if (isset($_POST['submit'])) {
    $target_dir = "img/profile/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = ".jpg";
//    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $name = $_POST["name"];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $sectionid = $_POST['sectionid'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password =md5($_POST['password']);


    $sql = "INSERT INTO staff(name, dob, gender, departmentid, contact, email, password)
        VALUES (:name, :dob, :gender, :sectionid, :contact, :email , :password)";
    $params = array(
        ':name' => $name, 
        ':dob' => $dob, 
        ':gender' => $gender, 
        ':sectionid' => $sectionid, 
        ':contact' => $contact, 
        ':email' => $email, 
        ':password'=> $password
    );
        
        if($newID = $user->insert($sql, $params))
        {
            print_r($_FILES);
            if ($img = move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $newID . $imageFileType)) {
                $msg = "added successfully";
            } else {
                // $msg = "Inserted staff but could not upload image";
                $msg = $img;
            }
        }else {
        $msg = "could not be inserted";
    }
    header("Location: ?staff=".$msg);

}
?>
<div class="container-fluid">
<div class="side-body">
		<div class="row">
				<div class="col-xs-9">
				<div class="card">
								<div class="card-header">

		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-wrench"></i> Enter Staff Details</div>
            </div> <!-- /panel-heading -->
            <h3 style="color:green" align="center"><b> <?php echo $msg ?></b> </h3>
                   
                         <div class="card">
                                <div class="card-body">
                           <form method="POST" ENCTYPE="multipart/form-data" action="">
                                 <div class="form-group" id="pic">
                                     <label>Picture</label>
                                     <input type="file" accept="image/*" class="form-control" id="FileUpload"  name="image" required>
                                 </div>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control"  name="name" required>
                                        </div>
                
                                        <div class="form-group">
                                        
                                            <label>Date of Birth</label><br>
                                            <input type="date"  class="form-control" name="dob" required />
                                        </div>
                <br>
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select required name="gender" class="form-control">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                        <label>Sectionid</label>
                                        <select name="sectionid" class="form-control">
                                            <option value="0">Select one</option>
                                            <?php $dept = $user->populatewith('department', 'isfunctional', '1');
                                            foreach ($dept as $key ) {?>
                                            <option value="<?=$key['departmentid']?>"><?=$key['departmentname']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
            
                
                                        <div class="form-group">
                                            <label>Contact</label>
                                            <input class="form-control" type="number" name="contact" required>
                                        </div>
                
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" type="email" name="email" required>
                                        </div>
                
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control"  name="password" required>
                                        </div>
                
                                       <div class="panel-footer">
                                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                        <a href="index.php?staff" class="btn btn-info">Cancel</a>
                                       </div>
                                       
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group" id="newpic">
                    <div id="dvPreview" class="col-sm-12">
                        <img src="" alt="" class="img-thumbnail" style="width: 100%; height: 100%">
                    </div>
                </div>
            </div>

       
            <script type="text/javascript">
                $(document).ready(function () {
                    $("#FileUpload").change(function () {
//                        $("#dvPreview").html("");
                        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                        if (regex.test($(this).val().toLowerCase())) {
                                if (typeof (FileReader) != "undefined") {
                                    $("#dvPreview").show();
//                                    $("#dvPreview").append("<img />");
                                    var reader = new FileReader();
                                    reader.onload = function (e) {
                                        $("#dvPreview img").attr("src", e.target.result);
                                    }
                                    reader.readAsDataURL($(this)[0].files[0]);
                                } else {
                                    alert("This browser does not support FileReader.");
                                }

                        } else {
                            alert("Please upload a valid image file.");
                        }
                    });
                })
            </script>