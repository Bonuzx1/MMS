<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 29/03/2018
 * Time: 5:43 PM
 */
?>
<?php if($_GET['request']==''||($_GET['request']=="approved")||($_GET['request']=="notapproved")){ ?>
    <div class="container-fluid">
        <div class="side-body padding-top">
            <div class="row">
                <div class="col-lg-12">

                    <div class="panel panel-primary">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <div class="panel-title"> Request <?php if ($_GET['request']=="approved") {
                                    echo "Approved Succesfully";
                                } ?></div>
                        </div>

                        <div class="panel-body">
                            <!-- Table -->
                            <table class="table datatable">
                                <thead>
                                <th>Request No</th>
                                <th>Customer</th>
                                <th>Asset</th>
                                <th>Requested</th>
                                <th>Date Due</th>
                                <th>Option</th>
                                </thead>
                                <tbody id="table1">
                                <?php
                                $count = $user->howmanyinone('request');
                                $fetch = $user->populatewith('request', 'isactive', '1');
                                $curid = '';
                                if($count>0){
                                    foreach($fetch as $row) {
                                        $cusid = $row['customerid'];
                                        $row2 = $user->showone('customer','customerid', $cusid);
                                        $row3 = $user->showone('assets','assetid', $row['assetid']);
                                        ?>
                                        <tr id="list_group">
                                            <td><?=$row['requestid']?></td>
                                            <td><?=$row2['customername']?></td>
                                            <td><?=$row3['name']?></td>
                                            <td><?=$row['datecreated']?></td>
                                            <td><?=$row['datedue']?></td>

                                            <td><a href="javascript:approve('<?= $row['requestid']?>', '<?= $row['assetid']?>', '<?=$row['datecreated']?>','<?=$row['datedue']?>')">
                                                    <button class="btn-primary">Approve</button></a> | <a href="javascript:delset('<?php echo $row['requestid'];?>','<?php echo $row3['name'];?>')">
                                                    <button class="btn-danger">Delete</button></a>
                                            </td>
                                        </tr>

                                    <?php } } else { ?>
                                    <td>No request yet</td>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div><!--body-->

                        <div class="panel-footer">
                            <div class="row">
                            </div>
                        </div><!--well-->

                    </div><!--panel-->

                </div><!--col-10-->
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="modalForm" method="POST" action="process/addSchedule.php">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Add Schedule</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="request-id" name="req">
                        <div class="form-group">
                            <label for="color" class="col-sm-2 control-label">Assign name</label>
                            <div class="col-sm-10">
                                <select name="staff" class="form-control" id="staff">
                                    <option value="">Choose</option>
                                    <?php
                                    $all = $user->populatewith('staff', 'active', '1');
                                    foreach ($all as $item) { ?>
                                        <option value="<?php echo $item['staffid']?>"><?php echo $item['name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="color" class="col-sm-2 control-label">Priority</label>
                            <div class="col-sm-10">
                                <select name="priority" class="form-control" id="priority">
                                    <option value="">Choose</option>
                                    <option style="color:#FF0000;" value="1">High</option>
                                    <option style="color:#FFD700;" value="2">Medium</option>
                                    <option style="color:#008000;" value="3">Low</option>
                                </select>
                            </div>
                        </div>

                        <input type="hidden" id="modalAdd-assetname" name="assetname">
                        <input type="hidden" id="modalAdd-freq" name="ftype">
                        <input type="hidden" id="modalAdd-datecreated" name="start">
                        <input type="hidden" id="modalAdd-end" name="customend">


                        <div class="form-group">
                            <label for="color" class="col-sm-2 control-label">Maintenance Type</label>
                            <div class="col-sm-10">
                                <select name="mtype" class="form-control" id="color">
                                    <option value="">Choose</option>
                                    <option value="1">Preventive</option>
                                    <option value="2">Corrective</option>
                                    <option value="3">Damage</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="color" class="col-sm-2 control-label">Maintenance Cost</label>
                            <div class="col-sm-10">
                                <input type="number" name="cost" id="cost"  class="form-control" min="0" step="any"  placeholder="0.00">
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- thats all for adding -->

<?php }
if (isset($_GET['del'])&&isset($_GET['id'])){
    $stmt = 'UPDATE request SET isactive = :one WHERE requestid = :requestid';
    $param = array(':one' => '0', ':requestid' => $_GET['id']);
    $user->update($stmt, $param);
    header('Location: index.php?request=approved');
    exit;
}
?>

<script type="text/javascript">
    function delset(id, title)
    {
        if (confirm("Are you sure you want to delete '" + title + "'"))
        {
            window.location.href = 'index.php?request=del&id=' + id;
        }
    }
    function approve(reqid, id, date, due) {

        $('#modalAdd-assetname').val(id);
        $('#request-id').val(reqid);
        $('#modalAdd-freq').val('0');
        $('#modalAdd-datecreated').val(date);
        $('#modalAdd-end').val(due);
        $('#ModalAdd').modal('show');
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){

    });

</script>
