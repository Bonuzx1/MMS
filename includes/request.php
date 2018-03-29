<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 29/03/2018
 * Time: 5:43 PM
 */
?>
<?php if($_GET['request']==''||($_GET['request']=="deleted")||($_GET['request']=="notdeleted")){ ?>
    <div class="container-fluid">
        <div class="side-body padding-top">
            <div class="row">
                <div class="col-lg-12">

                    <div class="panel panel-primary">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <div class="panel-title"> Request <?php if ($_GET['request']=="deleted") {
                                    echo "Deleted Succesfully";
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

                                            <td><a href="index.php?request=edit&id=<?php echo $row['requestid']?>">
                                                    <button class="btn-primary">Approve</button></a> | <a href="javascript:delset('<?php echo $row['requestid'];?>','<?php echo $row['name'];?>')">
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
<?php } elseif ($_GET['request']=='new' || $_GET['request']=='edit') {
    include 'newasset.php';
} ?>

<script type="text/javascript">
    function delset(id, title)
    {
        if (confirm("Are you sure you want to delete '" + title + "'"))
        {
            window.location.href = 'index.php?request=del&id=' + id;
        }
    }
</script>
<?php

if (($_GET["request"]=='del')&&(isset($_GET['id']))) {


    $user->updateone('schedule', 'iscanceled', '1', 'requestid', $_GET['id']);


    $stmt = 'UPDATE request SET isactive = :one WHERE requestid = :requestid';
    $param = array(':one' => '0', ':requestid' => $_GET['id']);
    if ($user->update($stmt, $param)) {
        header('Location: index.php?request=deleted');
        exit;
    } else {
        header('Location: index.php?request=notdeleted');
    }
}



?>
<script type="text/javascript">
    $(document).ready(function(){
    });

</script>
