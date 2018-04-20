<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 19/04/2018
 * Time: 9:20 PM
 */
?>
<div class="container-fluid">
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
                                    $row2 = $user->showone('assets', 'assetid', $row['assetid']);
                                    $row3 = $user->showone('staff', 'staffid', $row['staffid'])
                                    ?>
                                    <tr id="list_group">
                                        <td><?php echo $row['scheduleid']?></td><td><?php echo $row2['name']; ?></td>
                                        <td><?php echo $row3['name'] ?></td>
                                        <td><?php echo $row['startdate'] ?></td>
                                        <td><?php echo $row['enddate'] ?></td>
                                        <td><?php echo $row['isdone'] == 1? "Done":"Pending" ?></td>
                                        <td><a href="index.php?assignment=approve&id=<?php echo $row['assetid']?>">
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


                </div><!--panel-->

            </div><!--col-10-->
        </div>
    </div>
</div>
<script type="text/javascript" rel="script">
    $(document).ready(function () {
        function delsch(id, name) {
            if (confirm("Are you sure you want to delete the schedule for asset '"+name+"'?"))
            {
                Event = [];
                Event[0] = id;
                $.post("process/deleteSchedule", {Event:Event}, function (data) {
                    if (data == 1)
                    {
                        alert("Schedule Deleted Successfully");
                    }else{
                        alert("Error Deleting the asset");
                    }
                })
            }

        }
    })
</script>