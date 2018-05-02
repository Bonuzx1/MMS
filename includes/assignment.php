<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 19/04/2018
 * Time: 8:14 PM
 */
$msg = '';
if (isset($_GET['msg']))
    $msg = $_GET['msg'];

$id = $_SESSION['id'];
?>
<div class="container-fluid">
    <div class="modal fade" id="modalSendComplain" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Give Reasons :</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="process/sendComplain.php">
                        <table class="table">
                            <tr>
                                <td>
                                    <input type="hidden" id="modalSendComplain-staffid" name="staffid">
                                    <input type="hidden" id="modalSendComplain-scheduleid" name="scheduleid">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="form-control" type="text" name="subject" placeholder="Subject">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea class="form-control" rows="4" name="complain_text" placeholder="Message text . . ."></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn btn-danger btn-sm" style="width: 100%;" name="submitcomplain"><i class="fa fa-envelope-o" style="padding-right: 5px;"></i> Send Message</button>
                                </td>
                            </tr>
                        </table>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <div class="side-body padding-top">
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-primary">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <div class="panel-title"> Assignments (<?=$msg?>)</div>
                    </div>

                    <div class="panel-body">
                        <!-- Table -->
                        <table class="table datatable">
                            <thead>
                            <th>#</th><th>Asset</th><th>Location</th><th>Start Date</th><th>End Date</th><th>Option</th>
                            </thead>
                            <tbody id="table1">
                            <?php
                            $count = $user->howmanyinone('schedule');
                            $fetch = $user->select("SELECT * FROM schedule WHERE isdone = '0' AND iscanceled = '0' AND staffid = '$id'");
                            if($count>=1){
                                foreach($fetch as $row) {
                                    $row2 = $user->showone('assets', 'assetid', $row['assetid']);
                                    $row3 = $user->showone('location', 'locationid', $row2['locationid'])
                                    ?>
                                    <tr id="list_group">
                                        <td><?php echo $row['scheduleid']?></td><td><?php echo $row2['name']; ?></td>
                                        <td><?php echo $row3['locationname'] ?></td>
                                        <td><?php echo $row['startdate'] ?></td>
                                        <td><?php echo $row['enddate'] ?></td>
                                        <td><a href="process/staffStartSchedule.php?sch=<?php echo $row['scheduleid']?>"><button class="btn-info">Started</button></a> |
                                            <a href="process/staffCompleteSchedule.php?id=<?php echo $row['scheduleid']?>">
                                                <button class="btn-primary">I'm Done</button></a> | <a href="javascript:cannot('<?php echo $row['scheduleid'];?>','<?php echo $row['staffid'];?>')">
                                                <button class="btn-danger">I Can't</button></a></td>
                                    </tr>

                                <?php } } else { ?>
                                <td>No asset yet</td>
                            <?php } ?>


                            </tbody>
                            <tbody id="table2">

                            </tbody>

                        </table>



                    </div><!--body-->



                </div><!--panel-->

            </div><!--col-10-->
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        if(window.location.href.indexOf("msg") > -1) {
            setTimeout("location.href = '?assignment'", 5000);
        }
    });

    function cannot(id, staff) {
        $("#modalSendComplain-staffid").val(staff);
        $("#modalSendComplain-scheduleid").val(id);
        $("#modalSendComplain").modal("show");
    }
</script>