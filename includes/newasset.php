<?php $msg = "";
$supplyid = '';
$assetid = '';
$deptid = '';
$location = '';
$qty = '';
$name = '';
$status = '';
$supplier = '';
$note = '';
$price = '';
$paneltitle = '';
if (isset($_GET['supply']) && $_GET['supply']=='edit' && isset($_GET['id']))
{
    $paneltitle = "Edit Supply";
    $id = $_GET['id'];
    $row = $user->showone('supply','supplyid', $id);
    $supplyid = $row['supplyid'];
    $qty = $row['qtyinstock'];
    $name = $row['name'];
    $status = $row['status'];
    $supplier = $row['supplierid'];
    $note = $row['notes'];
    $price = $row['purchaseprice'];
    if(isset($_POST['saveedit']))
    {
        $name = $_POST['assetname'];
        $status = $_POST['status'];
        $supplier = $_POST['supplier'];
        $notes = $_POST['notes'];
        $qty = $_POST['qty'];
        $purchaseprice = $_POST['purchaseprice'];
        $sql = "UPDATE supply SET name = '$name', status = $status, supplierid = '$supplier' , qtyinstock = '$qty', notes = '$notes', purchaseprice = $purchaseprice WHERE supplyid = ".$id;
        if ($user->updatetabl($sql))
        {
            $msg = "Asset edited successfully";
        }else {
            $msg = "Not edited";
        }
    }
}
elseif(isset($_GET['asset']) && $_GET['asset']=='edit')
{
    $paneltitle = "Edit Asset";
    $id = $_GET['id'];
    $row = $user->showone('assets', 'assetid', $id);
    $assetid = $row['assetid'];
    $deptid = $row['departmentid'];
    $location = $row['locationid'];
    $qty = $row['qtyinstock'];
    $name = $row['name'];
    $status = $row['status'];
    $supplier = $row['supplierid'];
    $note = $row['notes'];
    $price = $row['purchaseprice'];
    if (isset($_POST['saveedit']))
    {
        $name = $_POST['assetname'];
        $status = $_POST['status'];
        $qty = $_POST['qty'];
        $supplier = $_POST['supplier'];
        $notes = $_POST['notes'];
        $purchaseprice = $_POST['purchaseprice'];
        $department = $_POST['department'];
        $location = $_POST['location'];
        $sql = "UPDATE assets SET departmentid = '$department', locationid = '$location', name = '$name', qtyinstock = '$qty', status = $status, supplierid = '$supplier' , notes = '$notes', purchaseprice = $purchaseprice WHERE assetid = ".$id;
        if ($user->updatetabl($sql))
        {
            $msg = "Asset edited successfully";
        }else {
            $msg = "Not edited";
        }
    }
}elseif(isset($_GET['asset'])){
    $paneltitle = "New Asset";
}elseif (isset($_GET['supply'])){
    $paneltitle = "New Supply";
}
// save changes
if (isset($_POST['submit'])) {
    $name = $_POST["assetname"];

    $status = $_POST['status'];
    $qty = $_POST['qty'];
    $supplier = $_POST['supplier'];
    $notes = $_POST['notes'];
    $purchaseprice = $_POST['purchaseprice'];
    if(isset($_GET['asset'])) {
        $department = $_POST['department'];
        $location = $_POST['location'];
        $sql = "INSERT INTO assets(name, departmentid, status, locationid, supplierid, notes, purchaseprice, qtyinstock)
        VALUES (:assetname, :department, :optradio, :location, :supplier, :notes, :purchaseprice, :qty )";
        $params = array(
            ':assetname' => $name,
            ':department' => $department,
            ':optradio' => $status,
            ':location' => $location,
            ':supplier' => $supplier,
            ':notes' => $notes,
            ':qty' => $qty,
            ':purchaseprice' => $purchaseprice);
    }elseif (isset($_GET['supply'])){
        $sql = "INSERT INTO supply(name, status, supplierid, notes, purchaseprice, qtyinstock)
        VALUES (:assetname, :optradio, :supplier, :notes, :purchaseprice, :qty )";
        $params = array(
            ':assetname' => $name,
            ':optradio' => $status,
            ':supplier' => $supplier,
            ':notes' => $notes,
            ':qty' => $qty,
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
            <h4 class="panel-title"><?php echo $paneltitle; ?></h4>
        </div>
         <h3 style="color:green" align="center"><b> <?php echo $msg ?></b> </h3>

        <div class="panel-body">
        <div class="row">
            <form class="form-vertical" action="" method="post">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="" class="control-label">Name</label>
                    <input type="text" name="assetname" id="" class="form-control col-md-5" value="<?php echo $name?>" placeholder=<?php echo isset($_GET['asset'])? "Asset Name":"Supply Name"; ?> required>
                </div>
            </div>
<br><br><br><br>
                <?php if(isset($_GET['asset'])){ ?>
<div class="col-lg-12">
                <div class="form-group">
                <label>Department</label>
                <select required name="department"  id="edepartment" class="form-control">
                    <option value="">Select one</option>
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
                <?php } ?>

            <div class="col-lg-12">
            <div class="form-group">
            	<label for="" class="control-label ">Status</label> &nbsp;&nbsp;
                <label class="radio-inline"><input type="radio" id="status1" value="1" name="status">Available</label>
				<label class="radio-inline"><input type="radio" id="status" value="0" name="status">Not Available</label>
				</div>
        </div>
                <?php if(isset($_GET['asset'])){ ?>
        <div class="col-lg-12">
                <div class="form-group">
                <label>Location</label>
                <select required name="location" id="location" class="form-control">
                    <option value="">Select one</option>
                    <?php
                    $fullrow = $user->populatewith('location', 'isavailable', '1');
                    foreach ($fullrow as $row) {?>
                        <option value="<?php echo $row['locationid']?>"><?php echo $row['locationname'] ?></option>
                    <?php }
                    ?>
                </select>
                </div>
            </div>
                <?php } ?>
            <div class="col-lg-12">
                <div class="form-group">
                <label>Supplier</label>
                <select required name="supplier" id="supplier" class="form-control">
                    <option value="">Select one</option>
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
                        <label for="" class="control-label">Quantity in Stock</label>
                        <input type="number" name="qty" id="" value="<?php echo $qty; ?>" class="form-control col-md-5" min="1" step="1"  placeholder="0">
                    </div>
                </div>
            <div class="col-lg-12">
            <div class="form-group">
  <label for="">Notes:</label><br>
  <textarea class="form-control" rows="4" id="comment" name="notes" placeholder="Enter Notes"><?php  echo $note; ?></textarea>
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
            <a href=<?php echo (isset($_GET['asset']))? '?asset': '?supply'?> class="btn btn-info">Cancel</a>

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
        $("#edepartment").val("<?php echo $deptid; ?>");
        $("#location").val("<?php echo $location; ?>");
        $("#supplier").val("<?php echo $supplier; ?>");

        var val = <?php echo $status ?>;
        if (val===1)
            $("#status1").prop('checked', true);
        else
            $("#status").prop('checked', true);

    })
</script>