       <footer class="app-footer" style="color:white">
            <div class="wrapper" ><?php
echo date("h:i:sa") . "  " . date("Y-m-d");
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
       <script type="text/javascript" src="assets/js/Chart.js"></script>
       <script type="text/javascript" src="assets/plugins/datatables/buttons.print.min.js"></script>
       <script type="text/javascript" src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
            <!-- Javascript -->
            <script type="text/javascript" src="assets/js/app.js"></script>
            <!-- <script type="text/javascript" src="js/index.js"></script>-->
       <script>
           $(document).ready(function () {
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
                       console.log(dataarr)
                   }
               })
           });


       </script>

</body>

</html>