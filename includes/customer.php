<?php if (($_GET['customer']=='new')&&(isset($_GET["id"]))) {
    $id = $_GET['id'];
    $row = $user->showone('customer','customerid', $id);
    $customername = $row['customername'];
    $location = $row['locationid'];
    $phonenumber = $row['phonenumber'];
    $email=$row['email'];
    $status = $row['status'];

    if (isset($_POST['saveedit'])) {
        $imageFileType = ".jpg";
        $tr =  unlink("img/customer/".$id.$imageFileType);

        $target_dir = "img/customer/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;

    $name = $_POST['customername'];
    $locationid = $_POST['locationid'];
    $phonenumber = $_POST['phonenumber'];
    $email=$_POST['email'];
 
   $sql = "UPDATE customer SET customername = '$name', locationid = '$locationid', phonenumber = '$phonenumber', email = '$email' WHERE customerid = '$id' ";
    //$param = array(':customername' => $name, ':locationid' => $locationid,':phonenumber' => $phonenumber, ':email' => $email);
        if($user->updatetabl($sql))
        {
            if ($tr = move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $id . $imageFileType)){
                $msg = "customer updated successfully";
                header("Location: index.php?customer=".$msg);
            } else {
                $msg = "Updated customer but could not upload image";
                header("Location: index.php?customer=".$msg);

            }

        }else {
        $msg = "Could not update customer details";
       header("Location: index.php?customer=".$msg);
   }
}
    
    }
$msg = "";
if (isset($_POST['Save'])) {
    $target_dir = "img/customer/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = ".jpg";
    
    $customername = $_POST['customername'];
    $location = $_POST['locationid'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];

    $sql = "INSERT INTO customer (customername, locationid,phonenumber,email) VALUES (:customername,:locationid, :phonenumber, :email)";
    $param = array(':customername' => $customername, ':locationid' => $location, ':phonenumber' => $phonenumber, ':email' => $email, );
   if($newID = $user->insert($sql, $param))
        {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $newID . $imageFileType)) {
                echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
                $msg = "Customer added successfully";
            } else {
                $msg = "Inserted customer but could not upload image";
            }
        }else {
        $msg = "Could not add customer";
    }
}

?>

<div class="container-fluid">
  <div class="side-body padding-top">
    <div class="row">
        <div class="col-lg-12">
            <?php if(isset($_GET['customer']) && $_GET['customer']!='new'){ ?>
<div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">
            <div class="panel-title"> Customer (<?=$_GET['customer']?>)</div>
        </div>

      <div class="panel-body">
        <!-- Table -->
        <table class="table datatable">
          <thead>
              <th>customer No</th><th>Name</th><th>Location</th><th>Phone Number</th><th>Email</th><th>Image</th><th>Option</th>
          </thead>
          <tbody>
            <?php
            $count = $user->howmanyinone('customer');
                    $fetch = $user->populatewith('customer', 'status', '1');
                    if($count>=1){
                                            foreach($fetch as $row) { ?>
              <tr id="list_group">
                  <td><?php echo $row['customerid']?></td>
                  <td><?php echo $row['customername']; ?></td>
                  <td><?php echo $row['locationid']; ?></td>
                  <td><?php echo $row['phonenumber']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><img class="img-thumbnail" src="img/customer/<?=$row['customerid'].'.jpg?random_string'?>" style="width: 50px;" /></td>
                  <td><a href="index.php?customer=new&id=<?php echo $row['customerid']?>">
                    <button class="btn-primary" >Edit</button>
                    </a> | <a href="javascript:delset('<?php echo $row['customerid'];?>','<?php echo $row['customername'];?>')">    <button class="btn-danger ">Delete</button>
                   </a>
                  </td>
</tr> 

                                    <?php } } else { ?>
                                        <td>No customer yet</td>
                                        <?php } ?>

                
          </tbody>
          <tbody id="newdiv">
              
          </tbody>
        </table>

        

</div><!--body-->
<div class="panel-footer">
       
    <div class="row">
  <div class="col-lg-4">
    <a href="index.php?customer=new">
  <button class="btn btn-primary" type="submit"><?php if (isset($_GET['id'])) echo "Edit "; else echo "New ";?> Customer</button>
  </a>
  </div>

  </div>

        </div><!--well-->
        </div><!--panel-->
<?php } elseif($_GET['customer']=="new") { ?>
                <div class="col-xs-9">
        <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"><?php if (isset($_GET['id'])) echo "Edit "; else echo "New ";?>Customer</h4>
            <h5 class="panel-title"><?php echo $msg; ?></h5>
        </div>
        <div class="panel-body">
        <div class="row">
            <form class="form-vertical" action="" enctype="multipart/form-data" method="post">
                <div class="col-lg-12">
                <div class="form-group" id="pic">
                    <label>Picture</label>
                    <input type="file" accept="image/*" class="form-control" id="FileUpload"  name="image">
                </div>
                </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="" class="control-label">Customer Name</label>
                    <input type="text" value="<?php if(isset($_GET['id'])) echo($customername) ?>" name="customername" id="" class="form-control col-md-5" placeholder="customer Name">
                </div>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="" class="control-label">Email</label>
                    <input type="text" value="<?php if(isset($_GET['id'])) echo($email) ?>" name="email" id="" class="form-control col-md-5" placeholder="Email">
                </div>
            </div>
            <div class="clearfix"></div>
            <br>
            
            <div class="col-lg-12">
                <div class="form-group">
                <label>Location</label>
                <select name="locationid" id="locationedit" class="form-control">
                    <option value=""></option>
                    <?php
                    $fullrow = $user->populatewith('location', 'isavailable', '1');
                    foreach ($fullrow as $row) {?>
                      <option value="<?php echo $row['locationid']?>"><?php echo $row['locationname'] ?></option>
                   <?php }
                 ?>
                  
                </select>
                </div>
            </div>
            



            <div class="col-lg-12">
            <div class="form-group">
  <label for="" class="control-label">Contact</label><br>
  <input value="<?php if(isset($_GET['id'])) echo($phonenumber) ?>" class="form-control" type="tel" name="phonenumber" placeholder="Enter Number">
</div>
            </div>
    
            
            <div class="col-lg-12 panel-footer" >
            <div class="form-group" >
            <div class="well well-lg" >
            <button class="btn btn-success" type="submit" name="<?php if(isset($_GET['id'])){ echo 'saveedit'; }else{echo 'Save'; } ?>">Save</button> &nbsp;
            <a href="index.php?customer" class="btn btn-info">Cancel</a>
                
            </div>
        </div>
            </div>
            </form>
        </div>
    </div>
</div> <!-- panel -->
                </div>
                <div class="col-sm-3">
                    <div class="form-group" id="newpic">
                        <div id="dvPreview" class="col-sm-12">
                            <img src="" alt="" class="img-thumbnail" style="width: 100%; height: 100%">
                        </div>
                    </div>
                </div>
<?php } ?>


</div>
    </div>
</div>
</div>
<script type="text/javascript">

      function delset(id, title)
  {
    if (confirm("Are you sure you want to delete '" + title + "'"))
    {
      window.location.href = 'index.php?customer=del&id=' + id;
    }
  }
$(document).ready(function () {
    $("#locationedit").val('<?php if (isset($_GET["id"])) echo $row["locationid"]?>');
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
});


  
    </script>
    <?php

    if (($_GET["customer"]=='del')&&(isset($_GET['id']))) {
          $stmt = 'UPDATE customer SET status = :value WHERE customerid = :customerid' ;
          $param = array(':value' => '0', ':customerid' => $_GET['id']);
          if ($user->update($stmt, $param)) {
              header('Location: index.php?customer=deleted');
              exit;
          }else{
            header('Location: index.php?customer=not deleted');

          }
          
    }
    ?>
    