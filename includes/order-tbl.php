<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 19/04/2018
 * Time: 9:20 PM
 */

$no_button = "";
?>
<div class="container-fluid">
<div class="modal fade" id="viewComplain" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Reasons</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="" method="GET">
                <input type="hidden" name="order" id="orderid">
                    <div class="form-group">
    <label for="exampleInputEmail1">Complain Subject</label>
    <input type="text" disabled class="form-control" id="complain-subject" aria-describedby="emailHelp">
  </div>
                    <div class="form-group basic-textarea rounded-corners">
                                        <textarea disabled class="form-control z-depth-1" id="complain-text" rows="3" ></textarea>
                                    </div>
                    <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Assign New Staff</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                </div>
                </form>
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
                        <div class="panel-title"> Schedules </div>
                    </div>

                    <div class="panel-body">
                        <!-- Table -->
                        <table class="table datatable">
                            <thead>
                            <th>#</th><th>Asset</th><th>Staff Assigned</th><th>Start Date</th><th>End Date</th><th>Status</th><th>Option</th>
                            </thead>
                            <tbody id="table1">
                            <?php
                            $count = $user->howmanyinone('schedule');
                            $fetch = $user->populatewith('schedule', 'iscanceled', '0');
                            if($count>=1){
                                foreach($fetch as $row) {
                                    $complain = explode("|", $row['complain']);

                                    $button = ' | <button id="btn-modal" onclick=\'dostuff("'.$row["scheduleid"].'", "'.$row["complain"].'")\' class="btn-info"><i class="fa fa-plus"></i></button>';
                                    $state = '';
                                    if ($row['staffid'] == '0' && $row['isdone'] == '0') {
                                        $state = 'not-done';
                                    }elseif ($row['staffid'] != '0' && $row['isdone'] == '0') {
                                        $state = 'pending';
                                    }elseif ($row['staffid'] != '0' && $row['isdone'] == '1') {
                                        $state = 'done';
                                    }elseif ($row['isdone']=='2'){
                                        $state = 'started';
                                    }
                                    $row2 = $user->showone('assets', 'assetid', $row['assetid']);
                                    $row3 = $user->showone('staff', 'staffid', $row['staffid'])
                                    ?>
                                    <tr id="list_group">
                                        <td><?php echo $row['scheduleid']?></td><td><?php echo $row2['name']; ?></td>
                                        <td><?php echo $row3['name'] ?></td>
                                        <td><?php echo $row['startdate'] ?></td>
                                        <td><?php echo $row['enddate'] ?></td>
                                        <td><?=$state=='not-done'? 'Not Done':($state == 'pending'? 'Pending': ($state == 'started'? 'In Progress':'Done')) ?><?=$state=='not-done'? $button:$no_button ?></td>
                                        <td><a href="index.php?order=<?php echo $row['scheduleid']?>">
                                                <button class="btn-primary">Edit</button></a> | <a href="javascript:delsch('<?php echo $row['scheduleid'];?>','<?php echo $row2['name'];?>')">
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
                                <a href="index.php?order">
                                    <button class="btn btn-primary" type="submit">Back</button>
                                </a>
                            </div>

                        </div>
                    </div>
                </div><!--panel-->

            </div><!--col-10-->
        </div>
    </div>
</div>
<script type="text/javascript" rel="script">
    function dostuff(i, subject) {
        var text = subject.split('|');
console.log(text);
        $("#orderid").val(i);
        $("#complain-subject").val(text[0]);
        $("#complain-text").val(text[1]);
        $("#viewComplain").modal("show");
    }
    function delsch(id, name) {
        if (confirm("Are you sure you want to delete the schedule for asset '"+name+"'?"))
        {
            Event = [];
            Event[0] = id;
            $.post("process/deleteSchedule.php", {Event:Event}, function (data) {

                    alert("Schedule Deleted Successfully");
                    window.location.reload();

            })
        }

    }
    
</script>