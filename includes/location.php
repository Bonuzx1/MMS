 <?php if($_GET['location']==''||($_GET['location']=="edited")||($_GET['location']=="deleted")||($_GET['location']=="notdeleted")){ ?>
  <div class="side-body padding-top">
    <div class="row">
        <div class="col-lg-10">

        <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">
            <div class="panel-title"> Location </div>
        </div>
  <div class="panel-body">
        <!-- Table -->
        <table class="table">
          <thead>
              <th>Location No</th><th>Location Name</th><th>Status</th>
          </thead>
          <tbody>
            <?php
            $count = $user->howmanyinone('location');
                    $fetch = $user->populatewith('location', 'isavailable', '1');
                    if($count>1){
                                            foreach($fetch as $row) { 
                                              
                                           ?>
              <tr>
                  <td><?php echo $row['locationid']?></td><td><?php echo $row['locationname']; ?></td>
                  <td><?php echo ($row['isinuse'] == 1) ? "used" : "Not Used"; ?><td><a href="index.php?location=new&id=<?php echo $row['locationid']?>"><button class="btn-primary">Edit</button> | <a href="javascript:delset('<?php echo $row['locationid'];?>','<?php echo $row['locationname'];?>')"><button class="btn-danger" ">Delete</button></a></td>
</tr> 

                                    <?php } } else { ?>
                                        <td>No asset yet</td>
                                        <?php } ?>
                
          </tbody>
        </table>

        

</div><!--body-->
<div class="well well-sm panel-footer">
        <ul class="list-group">
    <div class="row">
    <div class="col-lg-4">
        
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-primary" type="button">Search</button>
      </span>
      </div><!-- /input-group -->
  </div><!--/.col-lg-4-->
  <div class="col-lg-4">
    <a href="index.php?location=new">
  <button class="btn btn-primary" type="submit">New Location</button>
  </a>
  </div>

  </div>
</ul>
        </div><!--well-->
        </div><!--panel-->
        
      </div><!--col-10-->
    </div>
    </div>    <?php }
    if($_GET['location']=="new"){
    include 'newlocation.php';
  }

    ?>
    <script type="text/javascript">
      function delset(id, title)
  {
    if (confirm("Are you sure you want to delete '" + title + "'"))
    {
      window.location.href = 'index.php?location=del&id=' + id;
    }
  }
    </script>
    <?php

    if (($_GET["location"]=='del')&&(isset($_GET['id']))) {
          $stmt = 'UPDATE location SET isavailable = :value WHERE locationid = :assetid' ;
          $param = array(':value' => '0', ':assetid' => $_GET['id']);
          if ($user->update($stmt, $param)) {
              header('Location: index.php?location=deleted');
              exit;
          }else{
            header('Location: index.php?location=notdeleted');
          }
          
    }
    ?>