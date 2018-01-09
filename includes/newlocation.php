<?php $msg = ""; ?>
<?php if (($_GET['location']=='new')&&(isset($_GET["id"]))) {
    $id = $_GET['id'];
    $row = $user->showone('location','locationid', $id);
    $name = $row['locationname'];
    $note = $row['notes'];
    $available = $row['isavailable'];
    $available = $row['isinuse'];

    if (isset($_POST['saveedit'])) {
    $name = $_POST['locationname'];
    $note = $_POST['notes'];
    $available = $_POST['available'];
    $inuse = $_POST['used'];

    $sql = "UPDATE location SET locationname = :name, notes = :note, isavailable = :available, isinuse = :used WHERE locationid = '$id' ";
    $param = array(':name' => $name, ':note' => $note,':available' => $available, ':used' => $inuse);
   if($user->update($sql, $param))
        {
            header("Location: index.php?location=edited");
        }else {
        $msg = "Could not add";
    }
}
    
}elseif (isset($_POST['Save'])) {
    
    $name = $_POST['locationname'];
    $note = $_POST['notes'];
    // $available = $_POST['available'];
    $inuse = $_POST['used'];

    $sql = "INSERT INTO location (locationname, notes, isinuse) VALUES (:name, :note, :used)";
    $param = array(':name' => $name, ':note' => $note, ':used' => $inuse);
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
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">New Location</h4>
            <h4 class="panel-title"><?php echo $msg ?></h4>
        </div>
        <div class="panel-body">
        <div class="row">
            <form class="form-vertical" action="" method="post">

            <div class="col-lg-12">
                <div class="form-group">
                    <label for="" class="control-label">Location Name</label>
                    <input type="text" name="locationname" id="" class="form-control col-md-5" value="<?php if(isset($_GET['id'])) echo($name) ?>" placeholder="Location Name">
                </div>
            </div>
            <div class="clearfix"></div>
            <br>
            <?php if(isset($_GET['id'])) { ?>
            <div class="col-lg-12">
                <div class="form-group">
                <label>Available?</label>
                <select required name="available" class="form-control">
                    <option value=""></option>
                    <option value="1">Yes</option>
                    <option value="0">No</option> 
                </select>
                </div>
            </div>
            <?php } ?>
             <div class="clearfix"></div>
            
            <div class="col-lg-12">
                <div class="form-group">
                <label>Used?</label>
                <select required name="used" class="form-control">
                    <option value=""></option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                    
                </select>
                </div>
            </div>



            <div class="col-lg-12">
            <div class="form-group">
  <label for="">Notes:</label><br>
  <textarea class="form-control" rows="4" id="comment" value="" name="notes" placeholder="Enter Notes"><?php if(isset($_GET['id'])) echo($note) ?></textarea>
</div>
            </div>
    
           <div class="clearfix"></div>
            <div class="panel-footer" >

            <button class="btn btn-success" type="submit" name="<?php if(isset($_GET['id'])){ echo 'saveedit'; }else{echo 'Save'; } ?>">Save</button> &nbsp;
            
            <a href="index.php?location" class="btn btn-info">Cancel</a>
                
            </div>

            </form>
        </div>
    </div>
</div>
</div>
    	</div>
    </div>
</div>
