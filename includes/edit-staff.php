<?php 
$id = $_GET['edit-staff'];
$_SESSION['id'] = $id;
$row = $user->showone('staff','staffid',$id);
?>
<div class="container-fluid">
<div class="side-body">
		<div class="row">
				<div class="col-xs-10">
				<div class="card">
								<div class="card-header">

		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-wrench"></i> Edit User</div>
			</div> <!-- /panel-heading -->

                                    
                                              <div class="card">
                                <div class="card-body">
                                                    <form action="process/editStaff.php" class="form-horizontal" method="post">
                                                        <div class="form-group">
                                                            <label class="col-sm-1 control-label">Name: </label>
                                                            <div class="col-sm-12">
                                                            <input type="text" class="form-control" name="name" placeholder="name" value="<?php echo $row['name'] ?>"/>
                                                            </div>
                                                            </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 ">Date of Birth: </label>
                                                            <div class='col-sm-12' id='datetimepicker10'>
                                                            <input type='date' value="<?php echo $row['dob']?>" class="form-control" />
                                                        </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-1 control-label">Contact: </label>
                                                            <div class="col-sm-12">
                                                            <input class="form-control" value="<?php echo $row['contact'] ?>" type="tel" name="number" placeholder="Contact" />
                                                        </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-1 control-label">Email: </label>
                                                            <div class="col-sm-12">
                                                            <input class="form-control" value="<?php echo $row['email']; ?>" type="email" name="email" placeholder="Email" />
                                                        </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-1 control-label">status: </label>
                                                            <div class="col-sm-12">
                                                            <select class="form-control" id="status" name="active">
                                                                <option value=""> </option>
                                                                <option value="1">Active</option>
                                                                <option value="0">Not Active</option>
                                                                </select>
                                                        </div>

                                                    </div>
                                                        <div class="panel-footer">
     <button class="btn btn-success" type="submit" name="submit">Submit</button>
      <a href="index.php?staff" class="btn btn-info">Cancel</a>
                                                        </div><!--panel footer-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                       </div>
                        </div>
                    </div>
                </div>


                      
                                           
                                  
                                        


                                
                            
 <script>
 $(document).ready(function () {
     $("#status").val('<?php echo $row['active']?>');
 })
                                                           
  </script>
<script type="text/javascript">
        $(function () {
            $('#datetimepicker10').datetimepicker({
                viewMode: 'years',
                format: 'MM/YYYY'
            });
        });
    </script>


    <button class="btn-success" name="submit" type="submit">Submit</button>