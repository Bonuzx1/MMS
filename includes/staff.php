

<?php if ($_GET['staff']==''||$_GET['staff']=='edited'||$_GET['staff']=="activated"||$_GET['staff']=="deleted"||$_GET['staff']=="removed") { ?>
          <div class="container-fluid">
  <div class="side-body padding-top">
    <div class="row">
        <div class="col-lg-12">
        <div class="panel panel-primary">
        
        <div class="panel-heading">
           <div class="panel-title"> Staff <?php if ($_GET['staff']=="deleted") {
              echo "Deleted Succesfully";
            } ?></div>
           </div>
       

      <div class="panel-body">
          <table class="table datatable">
                                        <thead>
                                            <tr >
                                                <th>StaffID</th>
                                                <th>Name</th>
                                                <th>DoB</th>
                                                <th>Gender</th>
                                                <th>departmentid</th>
                                                <th>Contact</th>
                                                <th>Email</th>
                                                <th>Picture</th>
                                                <th>Status</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
										$count = $user->howmanyinone('staff');
										$fetch = $user->populatewith('staff', 'isdeleted', '0');
										if($count>0){
                                            foreach($fetch as $row) {
                                                    $row2 = $user->showone('department', 'departmentid', $row['departmentid']);
                                                    $deptname = $row2['departmentname'];
                                                ?>
                                                <tr id="list_group">
                                                <td><?php echo $row['staffid']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['dob']; ?></td>
                                            <td><?php echo $row['gender']; ?></td>
                                           <td><?php echo $deptname; ?></td> 
                                            <td><?php echo $row['contact']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><img class="img-thumbnail" src="img/profile/<?=$row['staffid'].'.jpg'?>" style="width: 50px;" alt=""></td>
                                            <td><?php echo ($row['active'] == 1) ? "ACTIVE" : "NOT ACTIVE"; ?></td>
                                            <td>
                                                <a href="index.php?edit-staff=<?php echo $row['staffid']; ?>" class="btn btn-primary btn-xs">Edit</a>
                                                <?php
                                                if ($row['active'] == 1) { ?>
                                                <a href="index.php?remove-staff=<?php echo $row['staffid']; ?>" class="btn btn-warning btn-xs">Remove</a>
                                                <?php
                                                 } else { ?>
                                                <a href="index.php?activate-staff=<?php echo $row['staffid']; ?>" class="btn btn-success btn-xs">Activate</a>
                                                <?php } ?>
                                                        <a href="index.php?delete-staff=<?php echo $row['staffid']; ?>" class="btn btn-danger btn-xs">Delete</a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                        ?>
                                        <td colspan="6">No staff yet</td>
                                        <?php
                                        }
                                        ?>
                                            
                                        </tbody>
                                    </table>
                                                                        
        </div>
           <div class="panel-footer">
    <div class="row">
    <div class="col-lg-4">
    <a href="index.php?staff=new">
  <button class="btn btn-primary" type="submit">New Staff</button>
  </a>
  </div>

  </div>
                                    </div>
                                    
                                     

        
            </div>
            </div>
            </div>
            </div>
                                
                                    <?php }
                                    elseif ($_GET['staff']=="new") {
                                        include 'staff_add.php';
                                    }
                                    
                                    ?>
                                       