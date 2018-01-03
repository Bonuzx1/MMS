<?php if (($_GET['customer']=='new')&&(isset($_GET["id"]))) {
    $id = $_GET['id'];
    $row = $user->showone('customer','customerid', $id);
    $customername = $row['customername'];
    $location = $row['locationid'];
    $phonenumber = $row['phonenumber'];
    $email=$row['email'];
    $status = $row['status'];

    if (isset($_POST['saveedit'])) {
    $name = $_POST['customername'];
    $location = $_POST['locationid'];
    $phonenumber = $_POST['phonenumber'];
    $email=$_POST['email'];
    $status = $_POST['status'];
 
   $sql = "UPDATE customer SET customername = :name, locationid = :locationid, phonenumber = :phonenumber, email = :email, status = :available WHERE customerid = '$id' ";
    $param = array(':customername' => $name, ':locationid' => $locationid,':phonenumber' => $phonenumber, ':email' => $email, ':status' => $status);
   if($user->update($sql, $param))
        {
            header("Location: index.php?customer=edited");

        }else {
        $msg = "Could not add";
    }
}
    
    }
$msg = "";
if (isset($_POST['Save'])) {
    
    $customername = $_POST['customername'];
    $location = $_POST['locationid'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];

    $sql = "INSERT INTO customer (customername, locationid,phonenumber,email) VALUES (:customername,:locationid, :phonenumber, :email)";
    $param = array(':customername' => $customername, ':locationid' => $location, ':phonenumber' => $phonenumber, ':email' => $email, );
   if($user->insert($sql, $param))
        {
            $msg = "Added successfully";
        }else {
        $msg = "Could not add";
    }
}

?>

<div class="container-fluid">
  <div class="side-body padding-top">
    <div class="row">
        <div class="col-lg-10">
            <?php if($_GET['customer']==''||($_GET['customer']=="deleted")||($_GET['customer']=="not deleted")||($_GET['customer']=="edited")){ ?>
<div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">
            <div class="panel-title"> Customer <?php echo $_GET['customer'];
             ?></div>
        </div>

      <div class="panel-body">
        <!-- Table -->
        <table class="table">
          <thead>
              <th>customer No</th><th>Name</th><th>Location</th><th>Phone Number</th><th>Email</th>
          </thead>
          <tbody>
            <?php
            $count = $user->howmanyinone('customer');
                    $fetch = $user->populatewith('customer', 'status', '1');
                    if($count>=1){
                                            foreach($fetch as $row) { ?>
              <tr>
                  <td><?php echo $row['customerid']?></td>
                  <td><?php echo $row['customername']; ?></td>
                  <td><?php echo $row['locationid']; ?></td>
                  <td><?php echo $row['phonenumber']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><a href="index.php?customer=new&id=<?php echo $row['customerid']?>">
                    <button class="btn-primary" >Edit</button>
                    </a> | <a href="javascript:delset('<?php echo $row['customerid'];?>','<?php echo $row['customername'];?>')">    <button class="btn-danger" ">Delete</button>
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
<div class="well well-sm panel-footer">
        <ul class="list-group">
    <div class="row">
    <div class="col-lg-4">
        
    <div class="input-group">
      <input type="text" class="form-control" name="srchtxt" id="searchtext" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-primary" id="search1" type="button">Search</button>
      </span>
      </div><!-- /input-group -->
  </div><!--/.col-lg-4-->
  <div class="col-lg-4">
    <a href="index.php?customer=new">
  <button class="btn btn-primary" type="submit">New customer</button>
  </a>
  </div>

  </div>
</ul>
        </div><!--well-->
        </div><!--panel-->
<?php } elseif($_GET['customer']=="new") { ?>

        <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">New customer</h4>
            <h5 class="panel-title"><?php echo $msg; ?></h5>
        </div>
        <div class="panel-body">
        <div class="row">
            <form class="form-vertical" action="" method="post">

            <div class="col-lg-12">
                <div class="form-group">
                    <label for="" class="control-label">customer Name</label>
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
                <select required name="locationid" selected ="" value"" class="form-control">
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
    