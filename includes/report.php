<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 20/02/2018
 * Time: 2:00 PM
 */
?>
<div class="container-fluid">
    <div class="side-body padding-top">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="glyphicon glyphicon-check"></i>	Asset Report
                    </div>
                    <!-- /panel-heading -->
                    <div class="panel-body">

                        <form class="form-horizontal" action="" method="post" id="">
                            <div class="form-group col-sm-6">
                                <label for="startDate" class="col-sm-2 control-label">Asset</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="asset" name="asset" >
                                        <option value="0">Select One</option>
                                        <?php $all = $user->populatewith('assets', 'isdeleted', '0');
                                        foreach ($all as $row){ ?>
                                        <option value="<?php echo $row['assetid'] ?>"><?php echo $row['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="startDate" class="col-sm-2 control-label">Staff Assigned</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="staff" name="staff" >
                                        <option value="0">Select One</option>
                                        <?php $all = $user->populatewith('staff', 'isdeleted', '0');
                                        foreach ($all as $row){ ?>
                                            <option value="<?php echo $row['staffid'] ?>"><?php echo $row['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="startDate" class="col-sm-2 control-label">Start Date</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start Date">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="endDate" class="col-sm-2 control-label">End Date</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="endDate" name="endDate" placeholder="End Date">
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Generate Report</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- /panel-body -->
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="glyphicon glyphicon-check"></i>	Report
                    </div>
                    <!-- /panel-heading -->
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Asset Name</th>
                                    <th>Assigned To</th>
                                    <th>Cost</th>
                                </tr>
                            </thead>
                            <tbody id="report">

                            </tbody>
                            <tfoot>
                                <tr><td><button type="button" class="btn btn-success"><i class="glyphicon glyphicon-print"></i> Print</button></td></tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /panel-body -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $( "form" ).on( "submit", function( event ) {
            event.preventDefault();
            let assetname = $('#asset').val();
            let staff = $('#staff').val();
            let start = $("#startDate").val();
            let end = $("#endDate").val();
            let data = [];
            if (assetname=='0')
            {
                alert('Please select an asset');
            }
            else {

                if (staff==='0'){
                    if (start===''){
                        if (end===''){
                            data = {"asset":assetname};
                        }
                        else {
                            data = {"asset": assetname, "end": end};
                        }
                    }
                    else {
                        if (end===''){
                            data = {"asset":assetname, "start": start};
                        }
                        else {
                            data = {"asset": assetname,"start":start, "end": end};
                        }
                    }
                }
                else {
                    if (start===''){
                        if (end===''){
                            data = {"asset":assetname, "staff": staff};
                        }
                        else {
                            data = {"asset": assetname,"staff":staff, "end": end};
                        }
                    }
                    else {
                        if (end===''){
                            data = {"asset":assetname,"staff":staff, "start": start};
                        }
                        else {
                            data = {"asset": assetname,"staff":staff, "start":start, "end": end};
                        }
                    }
                }
                console.log(data);
                $.post('./process/assetReport.php', data);
            }
        });
    })
</script>