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

    $sql = "INSERT INTO staff(name, dob, gender, departmentid, contact, email)
        VALUES (:name, :dob, :gender, :sectionid, :contact, :email )";
    $params = array(
        ':name' => $name, 
        ':dob' => $dob, 
        ':gender' => $gender, 
        ':sectionid' => $sectionid, 
        ':contact' => $contact, 
        ':email' => $email );
        
        if($newID = $user->insert($sql, $params))
        {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $newID . $imageFileType)) {
                echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
                $msg = "Staff added successfully";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }else {
        $msg = "Could not add staff";
    }

}
?>
<div class="container-fluid">
<div class="side-body">
		<div class="row">
				<div class="col-xs-12">
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
                                 <div class="form-group">
                                     <label>Picture</label>
                                     <input type="file" accept="image/*" class="form-control"  name="image" required>
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
                                        <select required name="sectionid" class="form-control">
                                            <option value="1">B001</option>
                                            <option value="2">E001</option>
                                            <option value="3">P001</option>
                                            <option value="4">RA01</option>
                                            <option value="5">RC01</option>
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
       
        
       
    