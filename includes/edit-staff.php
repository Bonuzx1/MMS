<?php 
$id = $_GET['edit-staff'];
$_SESSION['id'] = $id;
$row = $user->showone('staff','staffid',$id);
?>
<div class="container-fluid">
<div class="side-body">
		<div class="row">
				<div class="col-xs-12">
				<div class="card">
								<div class="card-header">

		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-wrench"></i> Edit User</div>
			</div> <!-- /panel-heading -->

                                    
                                              <div class="card">
                                <div class="card-body">
                                                    <form action="process/editStaff.php" method="post">
                                                        <div class="form-group">
                                                            <label class="col-sm-2">Name: </label>
                                                            <input type="text" class="form-control" name="name" placeholder="name" value="<?php echo $row['name'] ?>"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2">Date of Birth: </label>
                                                            <div class='input-group date' id='datetimepicker10'>
                        <input type='date' class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2">Contact: </label>
                                                            <input value="<?php echo $row['contact'] ?>" type="tel" name="number" placeholder="Contact" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2">Email: </label>
                                                            <input value="<?php echo $row['email']; ?>" type="email" name="email" placeholder="Email" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2">status: </label>
                                                            <select name="active">
                                                                <option value=""> </option>
                                                                <option value="1">Active</option>
                                                                <option value="0">Not Active</option>
                                                                </select>

                                                    </div>
                                                    <div class="well well-sm panel-footer">
        <ul class="list-group">
    <div class="row">
  <div class="col-lg-4">
     <button class="btn btn-success" type="submit" name="submit">Submit</button> 
   
  </div>

  </div>
</ul>
        </div><!--well-->
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
 function close() {
var doc = document.getElementById("edit");
 doc.close();
  }
                                                           
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