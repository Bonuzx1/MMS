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
                        <i class="glyphicon glyphicon-check"></i>	Customer Report
                    </div>
                    <!-- /panel-heading -->
                    <div class="panel-body">

                        <form class="form-horizontal" action="process/customerReport.php" method="post" id="creport">
                            <div class="form-group col-sm-4">
                                <label for="startDate" class="col-sm-2 control-label">Start Date</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start Date">
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="endDate" class="col-sm-2 control-label">End Date</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="endDate" name="endDate" placeholder="End Date">
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-sm-2">
                                        <button type="button" class="btn btn-success" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Generate Report</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- /panel-body -->
                </div>
                <div  class="panel panel-default">
                    <div class="panel-heading">
                        <i class="glyphicon glyphicon-"></i> <h4><span id="pTitle"></span></h4>
                    </div>
                    <!-- /panel-heading -->

                    <div class="panel-body" id="reportPanel">

                        <table border="1" style="width: 100%;" class="table" id="reportTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Contact </th>
                                    <th>Email</th>
                                    <th>Date Registered</th>
                                </tr>
                            </thead>
                            <tbody id="report">

                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="button" class="btn btn-success" id="printReport" ><i class="glyphicon glyphicon-print"></i> Print</button>
                    </div>
                    <!-- /panel-body -->
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "includes/print-header.php";?>
<?php include "includes/print-footer.php";?>
<script>
    $(document).ready(function () {
        $("#generateReportBtn").click(function () {
            console.log($("#creport").serialize());
            genData = [];
            $.post('./process/customerReport.php', $("#creport").serialize(), function (data) {
                genData = data;
                $("#report").html(genData);
            });

        });

        $("#printReport").click(function () {
            var mywindow = window.open('','self');
            mywindow.document.write('<html><head><title>Customer Report</title>');
            mywindow.document.write('</head><body>');
            mywindow.document.write($('#printHeader').html());
            mywindow.document.write($('#reportPanel').html());
            mywindow.document.write($('#printfooter').html());
//            mywindow.document.write(genData);
            //          mywindow.document.write('</body></html>');
            mywindow.print();
            mywindow.close();

        })

    });
</script>