<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 19/04/2018
 * Time: 8:14 PM
 */

$id = $_SESSION['id'];
?>
<div class="container-fluid">
    <div class="side-body padding-top">
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-primary">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <div class="panel-title"> Assignments </div>
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
                            $fetch = $user->populatewith('schedule', 'staffid', $id);
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
                                        <td><a href="process/staffCompleteSchedule.php?id=<?php echo $row['scheduleid']?>">
                                                <button class="btn-primary">I'm Done</button></a> | <a href="javascript:delset('<?php echo $row['assetid'];?>','<?php echo $row['name'];?>')">
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