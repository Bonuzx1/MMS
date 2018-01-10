<?php $msg = "";
if (($_GET['asset']=='new')&&(isset($_GET["id"])))
    {
    //
        $id = $_GET['id'];
        if (isset($_GET['from']) && $_GET['from'] == "supply")
        {
//            echo "<script>alert('got supply')</script>";
            $row = $user->showone('supply','supplyid', $id);
            $supplyid = $row['supplyid'];
        }elseif (isset($_GET['from']) && $_GET['from'] == "asset")
        {
//            echo "<script>alert('got asset')</script>";
            $row = $user->showone('assets', 'assetid', $id);
            $assetid = $row['assetid'];
            $deptid = $row['departmentid'];
            $location = $row['locationid'];
        }
        $name = $row['name'];
        $status = $row['status'];
        $supplier = $row['supplierid'];
        $note = $row['notes'];
        $price = $row['purchaseprice'];
        if (isset($_GET['from']) && $_GET['from'] == "supply" && isset($_POST['saveedit']))
        {
            $name = $_POST['assetname'];
            $status = $_POST['status'];
            $supplier = $_POST['supplier'];
            $notes = $_POST['notes'];
            $purchaseprice = $_POST['purchaseprice'];
            $sql = "UPDATE supply SET name = '$name', status = $status, supplierid = '$supplier' , notes = '$notes', purchaseprice = $purchaseprice WHERE supplyid = ".$id;
            if ($user->updatetabl($sql))
            {
                $msg = "Asset edited successfully";
            }else {
                $msg = "Not edited";
            }
    }elseif (isset($_GET['from']) && $_GET['from'] == "asset" && isset($_POST['saveedit']))
    {
        $name = $_POST['assetname'];
        $status = $_POST['status'];
        $supplier = $_POST['supplier'];
        $notes = $_POST['notes'];
        $purchaseprice = $_POST['purchaseprice'];
        $department = $_POST['department'];
        $location = $_POST['location'];
        $sql = "UPDATE assets SET departmentid = '$department', locationid = '$location', name = '$name', status = $status, supplierid = '$supplier' , notes = '$notes', purchaseprice = $purchaseprice WHERE assetid = ".$id;
        if ($user->updatetabl($sql))
        {
            $msg = "Asset edited successfully";
        }else {
            $msg = "Not edited";
        }
    }

    }



// save changes
if (isset($_POST['submit'])) {
    $name = $_POST["assetname"];

    $status = $_POST['status'];

    $supplier = $_POST['supplier'];
    $notes = $_POST['notes'];
    $type = $_POST['assettype'];
    $purchaseprice = $_POST['purchaseprice'];
    if($type == 1) {
        $department = $_POST['department'];
        $location = $_POST['location'];
        $sql = "INSERT INTO assets(name, departmentid, status, locationid, supplierid, notes, purchaseprice)
        VALUES (:assetname, :department, :optradio, :location, :supplier, :notes, :purchaseprice )";
        $params = array(
            ':assetname' => $name,
            ':department' => $department,
            ':optradio' => $status,
            ':location' => $location,
            ':supplier' => $supplier,
            ':notes' => $notes,
            ':purchaseprice' => $purchaseprice);
    }elseif ($type == 2){
        $sql = "INSERT INTO supply(name, status, supplierid, notes, purchaseprice)
        VALUES (:assetname, :optradio, :supplier, :notes, :purchaseprice )";
        $params = array(
            ':assetname' => $name,
            ':optradio' => $status,
            ':supplier' => $supplier,
            ':notes' => $notes,
            ':purchaseprice' => $purchaseprice);
    }else {
        echo '<script> alert("Invalid Type")</script>';
        return;
    }
        if($user->insert($sql, $params))
        {
            $msg = "Asset added successfully";
        }else {
        $msg = "Could not add asset";
    }
}
?>

<div class="container-fluid">
  <div class="side-body padding-top">
    <div class="row">
    	<div class="col-lg-10">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"><?php if (isset($_GET['id'])) echo "Edit "; else echo "New ";?>Asset</h4>
        </div>
         <h3 style="color:green" align="center"><b> <?php echo $msg ?></b> </h3>

        <div class="panel-body">
        <div class="row">
            <form class="form-vertical" action="" method="post">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Asset Type</label>
                        <select required name="assettype" id="assettype" <?php if (isset($_GET['id'])){ echo 'disabled'; }?> class="form-control">
                            <option value=""></option>
                            <option value="1">Real Asset</option>
                            <option value="2">Ordinary Supplies</option>
                        </select>
                    </div>
                </div>
                <br><br><br><br>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="" class="control-label">Name</label>
                    <input type="text" name="assetname" id="" class="form-control col-md-5" value="<?php if (isset($_GET['id'])){ echo $name; }?>" placeholder="Asset Name" required>
                </div>
            </div>
<br><br><br><br>
<div class="col-lg-12">
                <div class="form-group">
                <label>Department</label>
                <select required name="department"  id="department" class="form-control">
                    <option value=""></option>
                    <?php
                    $fullrow = $user->populatewith('department', 'isfunctional', '1');
                    foreach ($fullrow as $row) {?>
                        <option value="<?php echo $row['departmentid']?>"><?php echo $row['departmentname'] ?></option>
                    <?php }
                    ?>
                </select>
                </div>
            </div>
            <br><br><br><br>

            <div class="col-lg-12">
            <div class="form-group">
            	<label for="" class="control-label ">Status</label> &nbsp;&nbsp;
                <label class="radio-inline"><input type="radio" id="status1" value="1" name="status">Available</label>
				<label class="radio-inline"><input type="radio" id="status" value="0" name="status">Not Available</label>
				</div>
        </div>

        <div class="col-lg-12">
                <div class="form-group">
                <label>Location</label>
                <select required name="location" id="location" class="form-control">
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
                <label>Supplier</label>
                <select required name="supplier" id="supplier" class="form-control">
                    <option value=""></option>
                    <?php
                    $fullrow = $user->populatewith('supplier', 'inpartnership', '1');
                    foreach ($fullrow as $row) {?>
                        <option value="<?php echo $row['supplierid']?>"><?php echo $row['suppliername'] ?></option>
                    <?php }
                    ?>
                </select>
                </div>
            </div>
            <div class="col-lg-12">
            <div class="form-group">
  <label for="">Notes:</label><br>
  <textarea class="form-control" rows="4" id="comment" name="notes" placeholder="Enter Notes"><?php if (isset($_GET['id'])){ echo $note; }?></textarea>
</div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="" class="control-label">Purchase Price</label>
                    <input type="number" name="purchaseprice" id="" value="<?php if (isset($_GET['id'])){ echo $price; }?>" class="form-control col-md-5" min="0" step="any"  placeholder="0.00">
                </div>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="panel-footer">
            <!-- <div class="col-lg-12" > -->
            <!-- <div class="form-group" > -->
            <!-- <div class="well well-sm" > -->
            <button class="btn btn-success" type="submit" name="<?php if (isset($_GET['id'])){ echo 'saveedit';} else{echo 'submit'; } ?>">Submit</button> &nbsp;
            <a href="index.php?asset" class="btn btn-info">Cancel</a>

            <!-- </div> -->
        <!-- </div> -->
            <!-- </div> -->
        </div>
            </form>
        </div>
    </div>
</div>
</div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function () {
        $("#department").val("<?php if (isset($_GET['id'])) echo $deptid; ?>");

        var x = 1;
        if (x == <?php if (isset($_GET['id'])){  if ($status == 1) echo '1'; else {
            echo "2";} };?>){
            $("#status1").attr('checked', true);
        }else {
            $("#status").attr('checked', true);
        }

       // alert("<?php if(isset($_GET['from'])) echo $_GET['from'];?>");
        if (window.location.search.indexOf("from=<?php if(isset($_GET['from'])) { if($_GET['from']=='supply'){
                echo "supply";} else{
                echo "asst";}} ;?>") !== -1 )
        {
//            alert('yes');
            $("#department").attr('disabled', "disabled");
            $("#location").attr('disabled', "disabled");
        }else if (window.location.search.indexOf("from=<?php if(isset($_GET['from'])) { if($_GET['from']=='supply'){
            echo "suaply";} else{
            echo "asset";}} ;?>") !== -1 )
        {
//            alert('no');
            $("#department").removeAttr('disabled');
            $("#location").removeAttr('disabled');
        }
         else {

            $("#department").attr('disabled', "disabled");
            $("#location").attr('disabled', "disabled");


            $("#assettype").change(function () {
                var val = $(this).val();
                if (val == 2) {
                    $("#department").attr('disabled', "disabled");
                    $("#location").attr('disabled', "disabled");

                } else if (val == 1) {
                    $("#department").removeAttr('disabled');
                    $("#location").removeAttr('disabled');
                } else {
                    $("#department").attr('disabled', "disabled");
                    $("#location").attr('disabled', "disabled");
                }
            })

        }
    })
</script>