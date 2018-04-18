<?php 
$id = $_GET['edit-staff'];
$_SESSION['staff-id'] = $id;
$row = $user->showone('staff','staffid',$id);
?>
<div class="container-fluid">
<div class="side-body">
		<div class="row">
				<div class="col-xs-9">
				<div class="card">
								<div class="card-header">

		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-wrench"></i> Edit User</div>
			</div> <!-- /panel-heading -->

                                    
                                              <div class="card">
                                <div class="card-body">
                                                    <form action="../process/editStaff.php" class="form-horizontal" method="post" enctype="multipart/form-data">
                                                        <div class="form-group" id="pic">
                                                            <label class="col-sm-1 control-label">Picture</label>
                                                            <div class="col-sm-12">
                                                            <input type="file" accept="image/*" class="form-control" id="FileUpload" name="imgupdate" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-1 control-label">Name: </label>
                                                            <div class="col-sm-12">
                                                            <input type="text" class="form-control" name="name" id="alltext" placeholder="name" value="<?php echo $row['name'] ?>"/>
                                                            </div>
                                                            </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 ">Date of Birth: </label>
                                                            <div class='col-sm-12' id='datetimepicker10'>
                                                            <input type='date' value="<?php echo $row['dob']?>" class="form-control" name="dob"/>
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
            <div class="col-xs-3">
                <div class="form-group" id="newpic">
                    <div id="dvPrevie" class="col-sm-12">
                        <img src="img/profile/<?=$row['staffid'].'.jpg'?>" alt="" class="img-thumbnail" style="width: 100%; height: 100%">
                    </div>
                </div>
            </div>
                        </div>
                    </div>
                </div>


                      
                                           
                                  
                                        


                                
                            
 <script>
 $(document).ready(function () {
     $("#FileUpload").change(function () {
//                        $("#dvPreview").html("");
         var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
         if (regex.test($(this).val().toLowerCase())) {
             if (typeof (FileReader) != "undefined") {
                 $("#dvPrevie").show();
//                                    $("#dvPreview").append("<img />");
                 var reader = new FileReader();
                 reader.onload = function (e) {
                     $("#dvPrevie img").attr("src", e.target.result);
                 }
                 reader.readAsDataURL($(this)[0].files[0]);
             } else {
                 alert("This browser does not support FileReader.");
             }

         } else {
             alert("Please upload a valid image file.");
         }
     });
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