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
                        <table class="table" id="reportTable">
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
                                <tr><td><button type="button" class="btn btn-success" id="printReport"><i class="glyphicon glyphicon-print"></i> Print</button></td></tr>
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
        let genData = null;
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
                            alert('An end date should have a starting date');
                            return;
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
                            alert('An start date should have a ending date');
                            return;
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
                $.post( './process/assetReport.php', data, function (data) {
                    genData = JSON.parse(data);
                    $("#report").html('');
                    var $row = $("<tr><td></td><td></td><td></td></tr>"); //the row template
                    var $tr;
                    $.each(genData, function(i, item) {
                        $tr = $row.clone(); //create a blank row
                        $tr.find("td:nth-child(1)").text(item.asset); //fill the row
                        $tr.find("td:nth-child(2)").text(item.staff);
                        $tr.find("td:nth-child(3)").text(item.cost);
                        $("#report").append($tr); //append the row
                    });
                });
            }
        });
        $("#printReport").click(function () {
            alert(genData);
            var mywindow = window.open('', 'Maintenance Management System', 'height=400,width=600');
            mywindow.document.write('<html><head><title>Print Report</title>');
            mywindow.document.write('</head><body><table class="table"><thead>');
            mywindow.document.write('<th>Asset Name</th><th>Assigned to</th><th>Cost</th></thead>');
            mywindow.document.write('<tbody>');
            mywindow.document.write(genData);
            mywindow.document.write('</tbody></table>');
            mywindow.document.write('</body></html>');
            mywindow.print();
        })
    })
</script>