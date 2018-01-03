
<?php

$msg = "";

// save changes
if (isset($_POST['submit'])) {
    $name = $_POST["assetname"];
    $department = $_POST['department'];
    $status = $_POST['status'];
    $location = $_POST['location'];
    $supplier = $_POST['supplier'];
    $notes = $_POST['notes'];
    $purchaseprice = $_POST['purchaseprice'];
    $sql = "INSERT INTO assets(name, departmentid, status, locationid, supplierid, notes, purchaseprice)
        VALUES (:assetname, :department, :optradio, :location, :supplier, :notes, :purchaseprice )";
    $params = array(
        ':assetname' => $name, 
        ':department' => $department, 
        ':optradio' => $status, 
        ':location' => $location, 
        ':supplier' => $supplier, 
        ':notes' => $notes,
        ':purchaseprice' => $purchaseprice );
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
            <h4 class="panel-title">New Asset</h4>
        </div>
         <h3 style="color:green" align="center"><b> <?php echo $msg ?></b> </h3>
                   
        <div class="panel-body">
        <div class="row">
            <form class="form-vertical" action="" method="post">

            <div class="col-lg-12">
                <div class="form-group">
                    <label for="" class="control-label">Name</label>
                    <input type="text" name="assetname" id="" class="form-control col-md-5" placeholder="Asset Name" required>
                </div>
            </div>
<br><br><br><br>
<div class="col-lg-12">
                <div class="form-group">
                <label>Department</label>
                <select required name="department" class="form-control">
                    <option value=""></option>
                    <option value="1">Buldings</option>
                    <option value="2">Electricals</option>
                    <option value="3">Pumbing</option>
                    <option value="4">Refrigerations&Airconditions</option>
                    <option value="5">Roads&Culverts</option>
                </select>
                </div>
            </div>
            <br><br><br><br>
            <div class="col-lg-12">
            <div class="form-group">
            	<label for="" class="control-label ">Status</label> &nbsp;&nbsp;
                <label class="radio-inline"><input type="radio" id="Available" value="1" name="status">Available</label>
				<label class="radio-inline"><input type="radio" value="0" name="status">Not Available</label>
				</div>
        </div>
        <div class="col-lg-12">
                <div class="form-group">
                <label>Location</label>
                <select required name="location" class="form-control">
                    <option value=""></option>
                    <option value="1">New Block</option>
                    <option value="2">Old Block</option>
                    <option value="3">Office1</option>
                    <option value="4">Reception</option>
                </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                <label>Supplier</label>
                <select required name="supplier" class="form-control">
                    <option value=""></option>
                    <option value="1">Nelson Cement</option>
                    <option value="2">Hisens</option>
                </select>
                </div>
            </div>
            <div class="col-lg-12">
            <div class="form-group">
  <label for="">Notes:</label><br>
  <textarea class="form-control" rows="4" id="comment" name="notes" placeholder="Enter Notes"></textarea>
</div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="" class="control-label">Purchase Price</label>
                    <input type="number" name="purchaseprice" id="" class="form-control col-md-5" min="0" step="any"  placeholder="0.00">
                </div>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="panel-footer">
            <!-- <div class="col-lg-12" > -->
            <!-- <div class="form-group" > -->
            <!-- <div class="well well-sm" > -->
            <button class="btn btn-success" type="submit" name="submit">Submit</button> &nbsp;
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