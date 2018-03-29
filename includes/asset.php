<?php if($_GET['asset']==''||($_GET['asset']=="deleted")||($_GET['asset']=="notdeleted")){ ?>
<div class="container-fluid">
  <div class="side-body padding-top">
    <div class="row">
        <div class="col-lg-12">

        <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">
            <div class="panel-title"> Asset <?php if ($_GET['asset']=="deleted") {
              echo "Deleted Succesfully";
            } ?></div>
        </div>

      <div class="panel-body">
        <!-- Table -->
        <table class="table datatable">
          <thead>
              <th>Asset No</th><th>Name</th><th>Status</th><th>Category</th><th>Location</th><th>Option</th>
          </thead>
          <tbody id="table1">
            <?php
            $count = $user->howmanyinone('assets');
                    $fetch = $user->populatewith('assets', 'isdeleted', '0');
                    if($count>1){
                                            foreach($fetch as $row) { 
                                              $depid = $row['departmentid'];
                                            $row2 = $user->showone('department','departmentid', $depid); 
                                            $row3 = $user->showone('location','locationid', $row['locationid']); 
                                              ?>
              <tr id="list_group">
                  <td><?php echo $row['assetid']?></td><td><?php echo $row['name']; ?></td>
                  <td><?php echo ($row['status'] == 1) ? "Available" : "Not Available"; ?></td>
                  <td><?php echo $row2['departmentname'] ?></td><td><?php echo $row3['locationname'] ?></td>
                  <td><a href="index.php?asset=edit&id=<?php echo $row['assetid']?>">
                  <button class="btn-primary">Edit</button></a> | <a href="javascript:delset('<?php echo $row['assetid'];?>','<?php echo $row['name'];?>')">
                  <button class="btn-danger">Delete</button></a></td>
</tr> 

                                    <?php } } else { ?>
                                        <td>No asset yet</td>
                                        <?php } ?>

                
          </tbody>
          <tbody id="table2">
            
          </tbody>
        </table>

        

</div><!--body-->

<div class="panel-footer">
    <div class="row">
  <div class="col-lg-4">
    <a href="index.php?asset=new">
  <button class="btn btn-primary" type="submit">New Asset</button>
  </a>
  </div>

  </div>
        </div><!--well-->
      
        </div><!--panel-->
        
      </div><!--col-10-->
    </div>
    </div>
    </div>
    <?php } elseif ($_GET['asset']=='new' || $_GET['asset']=='edit') {
      include 'newasset.php';
    } ?>

    <script type="text/javascript">
      function delset(id, title)
  {
    if (confirm("Are you sure you want to delete '" + title + "'"))
    {
      window.location.href = 'index.php?asset=del&id=' + id;
    }
  }
    </script>
    <?php

    if (($_GET["asset"]=='del')&&(isset($_GET['id']))) {


        $user->updateone('schedule', 'iscanceled', '1', 'assetid', $_GET['id']);


        $stmt = 'UPDATE assets SET status = :value, isdeleted = :one WHERE assetid = :assetid';
        $param = array(':value' => '1', ':one' => '1', ':assetid' => $_GET['id']);
        if ($user->update($stmt, $param)) {
            header('Location: index.php?asset=deleted');
            exit;
        } else {
            header('Location: index.php?asset=notdeleted');
        }
    }

          

    ?>
    <script type="text/javascript">
    $(document).ready(function(){



 function load_data(query)
 {
  $.ajax({
   url:"search.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#table1').html('');
    $('#table2').html(data);
   },
   error:function(data) {
     $('#table1').html('');
    $('#table2').html("error");
   }
  });
 }
 
 $('#searchquery').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
    // alert(search);
   load_data(search);
  }
  else
  {
   alert(search);
  }
 });
});

    </script>