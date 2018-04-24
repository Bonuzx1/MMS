       <footer class="app-footer" style="color:white">
            <div class="wrapper" >
                <?= date("h:i:sa") . "  " . date("Y-m-d");
?>
                <span class="pull-right"><a href="#"><i class="fa fa-long-arrow-up"></i></a></span> 
             <span style= "padding: 0 350px";>
                Copyright Reserved to Sandra Appiah© 2018 .
                </span>
            </div>
        </footer>

                  <!-- Javascript assets/libs -->
            

            <script type="text/javascript" src="assets/lib/js/Chart.min.js"></script>
            <script type="text/javascript" src="assets/lib/js/bootstrap-switch.min.js"></script>
            <script type="text/javascript" src="assets/lib/js/jquery.matchHeight-min.js"></script>
            <script type="text/javascript" src="assets/lib/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="assets/lib/js/dataTables.bootstrap.min.js"></script>
            <script type="text/javascript" src="assets/lib/js/select2.full.min.js"></script>
            <script type="text/javascript" src="assets/lib/js/ace/ace.js"></script>
            <script type="text/javascript" src="assets/lib/js/ace/mode-html.js"></script>
            <script type="text/javascript" src="assets/lib/js/ace/theme-github.js"></script>
            <script type="text/javascript" src="assets/js/theme-chooser.js"></script>
            <script type="text/javascript" src="assets/js/moment.min.js"></script>
            <script type="text/javascript" src="assets/js/fullcalendar.min.js"></script>
            <script type="text/javascript" src="assets/js/gcal.min.js"></script>
             <script type="text/javascript" src="assets/lib/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
            <script type="text/javascript" src="assets/js/Chart.min.js"></script>
<!--             <script type="text/javascript" src="assets/js/Chartjs.js"></script>    -->
            <script type="text/javascript" src="assets/plugins/datatables/buttons.print.min.js"></script>
            <script type="text/javascript" src="assets/plugins/datatables/dataTables.buttons.min.js"></script>

            <!-- Javascript -->
            <script type="text/javascript" src="assets/js/app.js"></script>
            <!-- <script type="text/javascript" src="js/index.js"></script>-->
       <script>
           $(document).ready(function () {
               $("table").addClass("datatable");
               $("#calendar table").removeClass("datatable");
               $("#calendar table").removeClass("datatable");
               $("#reportTable").removeClass("datatable");
               $("#staff-schedule-no-datatable").removeClass("datatable");
               $(".datatable").DataTable();
               if (!window.Notification) {
                   alert("Not Supported");
               }else{
                   Notification.requestPermission(function(e) {
                       if (e==='denied') {
                           alert("you denied the request. Go to your notification settings in the browser to enable it!");
                       }else{
                           $.get("process/assetstatus.php", function(data) {
                               frmdb = JSON.parse(data);

                               var newfrmdb;
                               for (let index = 0; index < frmdb.length; index++) {
                                   newfrmdb = frmdb[index];
                                   var notify;
                                   notify = new Notification(newfrmdb.assetname, {
                                       'body':newfrmdb.description,
                                   });
                                   notify.onclick = function() {
                                       $("#endmodal").modal('show');
                                   };
                                   $.post("process/completenotification.php", { id : newfrmdb.scheduleid });
                               }


                           })

                       }
                   })
               }
               newdata = null;
               $.post('./process/completeSchedule.php', function (data) {
                   newdata = JSON.parse(data);
                   dataarr = null;
                   for (let i = 0; i< newdata.length; i++)
                   {
                       dataarr = newdata[i];
                       console.log(dataarr);
                       $.get('./process/sendCompleteSms.php', dataarr, function (data) {
                           alert("A customer has been alerted of finished maintenance");
                        }).fail(function() {
                                alert( "An attempt to notify customer of finished maintenance failed" );
                            });
                   }
               });

           });
       </script>

           <?php
            $monthData = [];
            for($i=1; $i<=12; $i++) {
                $temp = $user->select("SELECT COUNT(*) AS count FROM schedule WHERE YEAR(startdate) = YEAR(NOW()) AND MONTH(startdate) = $i");
                $monthData[$i] = $temp[0]['count'];
            }

//            print_r($monthData); exit;
           ?>
       <script>

           if ( ctx = document.getElementById("myChart"))
           var myChart = new Chart(ctx, {
               type: 'line',
               data: {
                   labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun","July","Aug","Sep","Oct","Nov","Dec"],
                   datasets: [{
                       label: '# of Schedules',
                       data: [ <?=implode(',', $monthData)?> ],
                       backgroundColor: [
                           'rgba(0, 26, 51, 0.6)'
                       ],
                       borderColor: [
                           'rgba(0, 20, 51, 1)'
                       ],
                       borderWidth: 1
                   }]
               },
               options: {
                   scales: {
                       yAxes: [{
                           ticks: {
                               beginAtZero:true
                           }
                       }]
                   }
               }
           });
       </script>

</body>

</html>