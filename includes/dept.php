<?php if (($_GET['dept']=='new')&&(isset($_GET["id"]))) {
    $id = $_GET['id'];
    $row = $user->showone('department','departmentid', $id);
    $name = $row['departmentname'];
    $note = $row['departmentnotes'];
    $available = $row['isfunctional'];

    if (isset($_POST['saveedit'])) {
    $name = $_POST['departmentname'];
    $note = $_POST['notes'];
    $available = $_POST['available'];
   $sql = "UPDATE department SET departmentname = :name, departmentnotes = :note, isfunctional = :available WHERE departmentid = '$id' ";
    $param = array(':name' => $name, ':note' => $note,':available' => $available);
   if($user->update($sql, $param))
        {
            header("Location: index.php?dept=edited");

        }else {
        $msg = "Could not add";
    }
}
    
    }
$msg = "";
if (isset($_POST['Save'])) {
    
    $deptname = $_POST['departmentname'];
    $deptnote = $_POST['notes'];

    $sql = "INSERT INTO department (departmentname, departmentnotes) VALUES (:deptname,:deptnote)";
    $param = array(':deptname' => $deptname, ':deptnote' => $deptnote);
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
            <?php if($_GET['dept']==''||($_GET['dept']=="deleted")||($_GET['dept']=="not deleted")||($_GET['dept']=="edited")){ ?>
<div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">
            <div class="panel-title"> Department <?php echo $_GET['dept']." Succesfully";
             ?></div>
        </div>

      <div class="panel-body">
        <!-- Table -->
        <table class="table">
          <thead>
              <th>dept No</th><th>Name</th>
          </thead>
          <tbody>
            <?php
            $count = $user->howmanyinone('department');
                    $fetch = $user->populatewith('department', 'isfunctional', '1');
                    if($count>1){
                                            foreach($fetch as $row) { ?>
              <tr>
                  <td><?php echo $row['departmentid']?></td><td><?php echo $row['departmentname']; ?></td>
                  <td><a href="index.php?dept=new&id=<?php echo $row['departmentid']?>"><button class="btn-primary" >Edit</button></a> | <a href="javascript:delset('<?php echo $row['departmentid'];?>','<?php echo $row['departmentname'];?>')"><button class="btn-danger" ">Delete</button></a></td>
</tr> 

                                    <?php } } else { ?>
                                        <td>No dept yet</td>
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
    <a href="index.php?dept=new">
  <button class="btn btn-primary" type="submit">New dept</button>
  </a>
  </div>

  </div>
</ul>
        </div><!--well-->
        </div><!--panel-->
<?php } elseif($_GET['dept']=="new") { ?>

        <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">New Department</h4>
            <h5 class="panel-title"><?php echo $msg; ?></h5>
        </div>
        <div class="panel-body">
        <div class="row">
            <form class="form-vertical" action="" method="post">

            <div class="col-lg-12">
                <div class="form-group">
                    <label for="" class="control-label">Department Name</label>
                    <input type="text" value="<?php if(isset($_GET['id'])) echo($name) ?>" name="departmentname" id="" class="form-control col-md-5" placeholder="Location Name">
                </div>
            </div>
            <div class="clearfix"></div>
            <br>
            <?php if(isset($_GET['id'])) { ?>
            <div class="col-lg-12">
                <div class="form-group">
                <label>Available?</label>
                <select required name="available" selected ="" value"" class="form-control">
                    <option value=""></option>
                    
                    <option value="1">Yes</option>
                    <option value="0">No</option> 
                </select>
                </div>
            </div>
            <?php } ?>



            <div class="col-lg-12">
            <div class="form-group">
  <label for="">Notes:</label><br>
  <textarea class="form-control" rows="4" id="comment" name="notes" placeholder="Enter Notes"><?php if(isset($_GET['id'])) echo($note) ?></textarea>
</div>
            </div>
    
            
            <div class="col-lg-12 panel-footer" >
            <div class="form-group" >
            <div class="well well-lg" >
            <button class="btn btn-success" type="submit" name="<?php if(isset($_GET['id'])){ echo 'saveedit'; }else{echo 'Save'; } ?>">Save</button> &nbsp;
            <a href="" class="btn btn-info">Cancel</a>
                
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
      window.location.href = 'index.php?dept=del&id=' + id;
    }
  }



  
    </script>
    <?php

    if (($_GET["dept"]=='del')&&(isset($_GET['id']))) {
          $stmt = 'UPDATE department SET isfunctional = :value WHERE departmentid = :deptid' ;
          $param = array(':value' => '0', ':deptid' => $_GET['id']);
          if ($user->update($stmt, $param)) {
              header('Location: index.php?dept=deleted');
              exit;
          }else{
            header('Location: index.php?dept=not deleted');
          }
          
    }
    ?>
    